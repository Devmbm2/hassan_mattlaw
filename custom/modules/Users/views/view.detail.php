<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once('modules/Users/UserViewHelper.php');
include_once('modules/Users/views/view.detail.php');
class CustomUsersViewDetail extends UsersViewDetail
{



    function preDisplay()
    {
        global $current_user, $app_strings, $sugar_config;

        if (!isset($this->bean->id)) {
            // No reason to set everything up just to have it fail in the display() call
            return;
        }
        /**
         *  taken from parent::preDisplay by change the template file.
         */
        $metadataFile = $this->getMetaDataFile();
        $this->dv = new DetailView2();
        $this->dv->ss =& $this->ss;
        $this->dv->setup($this->module, $this->bean, $metadataFile,
            get_custom_file_if_exists('modules/Users/tpls/DetailView.tpl'));
        /****/
        $viewHelper = new UserViewHelper($this->ss, $this->bean, 'DetailView');
        $viewHelper->setupAdditionalFields();

        $errors = "";
        $msgGood = false;
        if (isset($_REQUEST['pwd_set']) && $_REQUEST['pwd_set'] != 0) {
            if ($_REQUEST['pwd_set'] == '4') {
                require_once('modules/Users/password_utils.php');
                $errors .= canSendPassword();
            } else {
                $errors .= translate('LBL_NEW_USER_PASSWORD_3' . $_REQUEST['pwd_set'], 'Users');
                $msgGood = true;
            }
        } else {
            //IF BEAN USER IS LOCKOUT
            if ($this->bean->getPreference('lockout') == '1') {
                $errors .= translate('ERR_USER_IS_LOCKED_OUT', 'Users');
            }
        }
        $this->ss->assign("ERRORS", $errors);
        $this->ss->assign("ERROR_MESSAGE",
            $msgGood ? translate('LBL_PASSWORD_SENT', 'Users') : translate('LBL_CANNOT_SEND_PASSWORD', 'Users'));
        $buttons = array();

        if ((is_admin($current_user) || $_REQUEST['record'] == $current_user->id
            )
            && !empty($sugar_config['default_user_name'])
            && $sugar_config['default_user_name'] == $this->bean->user_name
            && isset($sugar_config['lock_default_user_name'])
            && $sugar_config['lock_default_user_name']) {
            $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' =>"<input id='edit_button' accessKey='".$app_strings['LBL_EDIT_BUTTON_KEY']."' name='Edit' title='".$app_strings['LBL_EDIT_BUTTON_TITLE']."' value='".$app_strings['LBL_EDIT_BUTTON_LABEL']."' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.return_id.value='".'{$fields.id.value}'."'; this.form.action.value='EditView'\" type='submit' value='" . $app_strings['LBL_EDIT_BUTTON_LABEL'] .  "'>");
        }
        elseif (is_admin($current_user)|| ($GLOBALS['current_user']->isAdminForModule('Users')&& !$this->bean->is_admin)
            || $_REQUEST['record'] == $current_user->id) {
            $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => "<input title='".$app_strings['LBL_EDIT_BUTTON_TITLE']."' accessKey='".$app_strings['LBL_EDIT_BUTTON_KEY']."' name='Edit' id='edit_button' value='".$app_strings['LBL_EDIT_BUTTON_LABEL']."' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.return_id.value='".'{$fields.id.value}'."'; this.form.action.value='EditView'\" type='submit' value='" . $app_strings['LBL_EDIT_BUTTON_LABEL'] .  "'>");
            if ((is_admin($current_user)|| $GLOBALS['current_user']->isAdminForModule('Users')
            )) {

                if (!$current_user->is_group) {
                    $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => "<input id='duplicate_button' title='" . $app_strings['LBL_DUPLICATE_BUTTON_TITLE'] . "' accessKey='" . $app_strings['LBL_DUPLICATE_BUTTON_KEY'] . "' class='button' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value=true; this.form.action.value='EditView'\" type='submit' name='Duplicate' value='" . $app_strings['LBL_DUPLICATE_BUTTON_LABEL'] . "'>");

                    if ($this->bean->id != $current_user->id) {
                        $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => "<input id='delete_button' type='button' class='button' onclick='confirmDelete();' value='" . $app_strings['LBL_DELETE_BUTTON_LABEL'] . "' />");
                    }

                    if (!$this->bean->portal_only && !$this->bean->is_group && !$this->bean->external_auth_only
                        && isset($sugar_config['passwordsetting']['SystemGeneratedPasswordON']) && $sugar_config['passwordsetting']['SystemGeneratedPasswordON']){
                        $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input title="'.translate('LBL_GENERATE_PASSWORD_BUTTON_TITLE','Users').'" class="button" LANGUAGE=javascript onclick="generatepwd(\'{$fields.id.value}\');" type="button" name="password" value="'.translate('LBL_GENERATE_PASSWORD_BUTTON_LABEL','Users').'">"');
                    }
                }
            }
        }


        $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input title="'.translate('LBL_RESET_PREFERENCES','Users').'" class="button" LANGUAGE=javascript onclick="if(confirm(\''.translate('LBL_RESET_PREFERENCES_WARNING_USER','Users').'\')) window.location=\'index.php?module=Users&action=resetPreferences&reset_preferences=true&record={$fields.id.value}\';" type="button" name="password" value="'.translate('LBL_RESET_PREFERENCES','Users').'">"');
        $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input title="'.translate('LBL_RESET_HOMEPAGE','Users').'" class="button" LANGUAGE=javascript onclick="if(confirm(\''.translate('LBL_RESET_HOMEPAGE_WARNING','Users').'\')) window.location=\'index.php?module=Users&action=DetailView&reset_homepage=true&record={$fields.id.value}\';" type="button" name="password" value="'.translate('LBL_RESET_HOMEPAGE','Users').'">"');
        $this->dv->defs['templateMeta']['form']['buttons'][] = array('customCode' => "<input title='Add Slack Token' accessKey='Configure Slack' name='slack_token_button' id='slack_token_button' value='Add Slack Token' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.return_id.value='".'{$fields.id.value}'."'; this.form.action.value='slack_token'\" type='submit' value='Configure Slack'>");

        $show_roles = (!($this->bean->is_group == '1' || $this->bean->portal_only == '1'));
        if (is_admin($this->bean)) {
            $show_roles = false;
        }

        $this->ss->assign('SHOW_ROLES', $show_roles);
        //Mark whether or not the user is a group or portal user
        $this->ss->assign('IS_GROUP_OR_PORTAL',
            ($this->bean->is_group == '1' || $this->bean->portal_only == '1') ? true : false);
        if ($show_roles) {
            ob_start();

            require_once('modules/ACLRoles/DetailUserAccess.php');


            $role_html = ob_get_contents();
            ob_end_clean();
            $this->ss->assign('ROLE_HTML', $role_html);
        }

    }

}
