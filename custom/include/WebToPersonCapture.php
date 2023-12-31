<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'include/formbase.php';

require_once 'modules/Campaigns/utils.php';

$moduleDir = '';
if (isset($_REQUEST['moduleDir']) && $_REQUEST['moduleDir'] != null) {
    $moduleDir = $_REQUEST['moduleDir'];
} else {
    die('Not a valid module directory');
}
$GLOBALS['log']->fatal('MATTLAW LEADS');
$GLOBALS['log']->fatal(print_r($_REQUEST, true));
global $app_strings, $sugar_config, $timedate, $current_user;

$mod_strings = return_module_language($sugar_config['default_language'], $moduleDir);

if (isset($_POST['campaign_id']) && !empty($_POST['campaign_id'])) {
    //adding the client ip address
    $_POST['client_id_address'] = query_client_ip();
    $campaign = new Campaign();
    $campaign_id = $campaign->db->quote($_POST['campaign_id']);
    if(!isValidId($campaign_id)) {
        throw new RuntimeException('Invalid ID requested in Person Capture');
    }
    $camp_query = "select name,id from campaigns where id='$campaign_id'";
    $camp_query .= ' and deleted=0';
    $camp_result = $campaign->db->query($camp_query);
    $camp_data = $campaign->db->fetchByAssoc($camp_result);
    // Bug 41292 - have to select marketing_id for new lead
    $db = DBManagerFactory::getInstance();
    $marketing = new EmailMarketing();
    $marketing_query = $marketing->create_new_list_query(
        'date_start desc, date_modified desc',
        "campaign_id = '{$campaign_id}' and status = 'active' and date_start < ".$db->convert('', 'today'),
        array('id')
    );
    $marketing_result = $db->limitQuery($marketing_query, 0, 1, true);
    $marketing_data = $db->fetchByAssoc($marketing_result);
    // .Bug 41292
    if (isset($_REQUEST['assigned_user_id']) && !empty($_REQUEST['assigned_user_id'])) {
        $current_user = new User();
        $current_user->retrieve($_REQUEST['assigned_user_id']);
    }

    if (isset($camp_data) && $camp_data != null) {
        //$personForm = new $formBase();
        $person = BeanFactory::getBean($moduleDir);
        $prefix = '';
        if (!empty($_POST['prefix'])) {
            $prefix = $_POST['prefix'];
        }
        if (empty($person->id)) {
            $person->id = create_guid();
            $person->new_with_id = true;
        }
        $GLOBALS['check_notify'] = true;

        //bug: 47574 - make sure, that webtolead_email1 field has same required attribute as email1 field
        if (isset($person->required_fields['email1'])) {
            $person->required_fields['webtolead_email1'] = $person->required_fields['email1'];
        }

        //bug: 42398 - have to unset the id from the required_fields since it is not populated in the $_POST
        unset($person->required_fields['id']);
        unset($person->required_fields['team_name']);
        unset($person->required_fields['team_count']);

        // Bug #52563 : Web to Lead form redirects to Sugar when duplicate detected
        // prevent duplicates check
        $_POST['dup_checked'] = true;

        // checkRequired needs a major overhaul before it works for web to lead forms.
        //$person = $personForm->handleSave($prefix, false, false, false, $person);

        //As form base items are not necessarily in place for the custom classes that extend Person, cannot use
        //the hendleSave method of the formbase
		
        if (!empty($person)) {

            $filteredFieldsFromPersonBean = filterFieldsFromBeans(array($person));
            $possiblePersonCaptureFields = array('campaign_id');
            foreach($filteredFieldsFromPersonBean[0]->fields as $field) {
                $possiblePersonCaptureFields[] = $field[1];
            }
            unset($_POST['assigned_user_id']);
			foreach ($_POST as $k => $v) {
                //Skip the admin items that are not part of the bean
                if ($k === 'client_id_address' || $k === 'req_id'
                    || $k === 'moduleDir' || $k === 'dup_checked') {
                    continue;
                }
                if (array_key_exists($k, $person) || array_key_exists($k, $person->field_defs)) {
                    if (in_array($k, $possiblePersonCaptureFields)) {
                        $person->$k = $v;
                    } else {
                        $GLOBALS['log']->warn('Trying to set a non-valid field via WebToPerson Form: ' . $k);
                    }
                }

            }
        }
		// $person->lead_source = 'Website_Form';
		
		/* print"<pre>";print_r($person);die; */
        if (!empty($person)) {

            //create campaign log
            $camplog = new CampaignLog();
            $camplog->campaign_id = $campaign_id;
            $camplog->related_id = $person->id;
            $camplog->related_type = $person->module_dir;
            $camplog->activity_type = $person->object_name;
            $camplog->target_type = $person->module_dir;
            $camplog->activity_date = $timedate->now();
            $camplog->target_id = $person->id;
            if (isset($marketing_data['id'])) {
                $camplog->marketing_id = $marketing_data['id'];
            }
            $camplog->save();

            //link campaignlog and lead

            if (isset($_POST['email1']) && $_POST['email1'] != null) {
                $person->email1 = $_POST['email1'];
            }
            //in case there are old forms used webtolead_email1
            elseif (isset($_POST['webtolead_email1']) && $_POST['webtolead_email1'] != null) {
                $person->email1 = $_POST['webtolead_email1'];
            }

            if (isset($_POST['email2']) && $_POST['email2'] != null) {
                $person->email2 = $_POST['email2'];
            }
            //in case there are old forms used webtolead_email2
            elseif (isset($_POST['webtolead_email2']) && $_POST['webtolead_email2'] != null) {
                $person->email2 = $_POST['webtolead_email2'];
            }

            $person->load_relationship('campaigns');
            if (isset($person->campaigns)) {
                $person->campaigns->add($camplog->id);
            }

            if (!empty($GLOBALS['check_notify'])) {
                $person->save($GLOBALS['check_notify']);
            } else {
                $person->save(false);
            }
        }

        //in case there are forms out there still using email_opt_out
        if (isset($_POST['webtolead_email_opt_out']) || isset($_POST['email_opt_out'])) {
            if (isset($person->email1) && !empty($person->email1)) {
                $sea = new SugarEmailAddress();
                $sea->AddUpdateEmailAddress($person->email1, 0, 1);
            }
            if (isset($person->email2) && !empty($person->email2)) {
                $sea = new SugarEmailAddress();
                $sea->AddUpdateEmailAddress($person->email2, 0, 1);
            }
        }
        if (isset($_POST['redirect_url']) && !empty($_POST['redirect_url'])) {
            // Get the redirect url, and make sure the query string is not too long
            $redirect_url = $_POST['redirect_url'];
            $query_string = '';
            $first_char = '&';
            if (strpos($redirect_url, '?') === false) {
                $first_char = '?';
            }
            $first_iteration = true;
            $get_and_post = array_merge($_GET, $_POST);
            foreach ($get_and_post as $param => $value) {
                if ($param == 'redirect_url' && $param == 'submit') {
                    continue;
                }

                if ($first_iteration) {
                    $first_iteration = false;
                    $query_string .= $first_char;
                } else {
                    $query_string .= '&';
                }
                $query_string .= "{$param}=".urlencode($value);
            }
            if (empty($person)) {
                if ($first_iteration) {
                    $query_string .= $first_char;
                } else {
                    $query_string .= '&';
                }
                $query_string .= 'error=1';
            }

            $redirect_url .= $query_string;

            // Check if the headers have been sent, or if the redirect url is greater than 2083 characters (IE max URL length)
            //   and use a javascript form submission if that is the case.
            if (headers_sent() || strlen($redirect_url) > 2083) {
                echo '<html '.get_language_header().'><head><title>SugarCRM</title></head><body>';
                echo '<form name="redirect" action="'.$_POST['redirect_url'].'" method="GET">';

                foreach ($_POST as $param => $value) {
                    if ($param != 'redirect_url' || $param != 'submit') {
                        echo '<input type="hidden" name="'.$param.'" value="'.$value.'">';
                    }
                }
                if (empty($person)) {
                    echo '<input type="hidden" name="error" value="1">';
                }
                echo '</form><script language="javascript" type="text/javascript">document.redirect.submit();</script>';
                echo '</body></html>';
            } else {
                $header_URL = "Location: {$redirect_url}";

                SugarApplication::headerRedirect($header_URL);

                die();
            }
        } else {
            if (isset($mod_strings['LBL_THANKS_FOR_SUBMITTING'])) {
                echo $mod_strings['LBL_THANKS_FOR_SUBMITTING'];
            } else {
                //If the custom module does not have a LBL_THANKS_FOR_SUBMITTING label, default to this general one
                header("Location: https://mattlaw.com/thank-you");die();
				die(); 
				/* echo 'Success'; */
            }
            header($_SERVER['SERVER_PROTOCOL'].'201', true, 201);
        }
        sugar_cleanup();
        // die to keep code from running into redirect case below
        die();
    } else {
        echo $mod_strings['LBL_SERVER_IS_CURRENTLY_UNAVAILABLE'];
    }
}

if (!empty($_POST['redirect'])) {
    if (headers_sent()) {
        echo '<html '.get_language_header().'><head><title>SugarCRM</title></head><body>';
        echo '<form name="redirect" action="'.$_POST['redirect'].'" method="GET">';
        echo '</form><script language="javascript" type="text/javascript">document.redirect.submit();</script>';
        echo '</body></html>';
    } else {
        $header_URL = "Location: {$_POST['redirect']}";
        SugarApplication::headerRedirect($header_URL);
        die();
    }
}

echo $mod_strings['LBL_SERVER_IS_CURRENTLY_UNAVAILABLE'];
