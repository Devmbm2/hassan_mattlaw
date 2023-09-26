<?php
require_once "modules/Alerts/controller.php";

class CustomAlertsController extends AlertsController
{
    public function action_get()
    {
        global $current_user, $app_strings;
        $bean = BeanFactory::getBean('Alerts');

        $this->view_object_map['Flash'] = '';
        $this->view_object_map['Results'] = $bean->get_full_list("alerts.date_entered","is_read != '1'");
        if($this->view_object_map['Results'] == '') {
            $this->view_object_map['Flash'] =$app_strings['LBL_NOTIFICATIONS_NONE'];
        }
        $this->view = 'default';
    }

    public function action_add()
    {
        global $current_user;
        $name = null;
        $description = null;

        $assigned_user_id = $current_user->id;
        $is_read = 0;
        $url_redirect = null;
        $target_module = null;
        $type = 'info';


        if(isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        if(isset($_POST['description'])) {
            $description = $_POST['description'];
        }
        if(isset($_POST['is_read'])) {
            $is_read = $_POST['is_read'];
        }
        if(isset($_POST['url_redirect'])) {
            $url_redirect = $_POST['url_redirect'];
        } else {
            $url_redirect = null;
        }

        if($url_redirect == null) {
            $url_redirect = 'index.php?fakeid='. uniqid('fake_', true);
        }

        if(isset($_POST['target_module'])) {
            $target_module = $_POST['target_module'];
        }
        if(isset($_POST['type'])) {
            $type = $_POST['type'];
        }

        if(isset($_POST)) {
            $bean = BeanFactory::getBean('Alerts');
            $result = $bean->get_full_list("","alerts.assigned_user_id = '".$current_user->id."' AND url_redirect = '".$_POST['url_redirect']."' AND is_read != 1");
            if(empty($result)) {
                $bean = BeanFactory::newBean('Alerts');
                $bean->name = $name;
                $bean->description = $description;
                $bean->url_redirect = $url_redirect;
                $bean->target_module = $target_module;
                $bean->is_read = $is_read;
                $bean->assigned_user_id = $assigned_user_id;
                $bean->type = $type;
                $bean->save();
            }
        }

        $this->view_object_map['Flash'] = '';
        $this->view_object_map['Result'] = '';
        $this->view = 'json';
    }

    public function action_markAsRead()
    {
        $bean = BeanFactory::getBean('Alerts', $_GET['record']);
        $bean->is_read = 1;
        $bean->save();

        $this->view = 'json';
    }
    public function action_redirect()
    {
        $bean = BeanFactory::getBean('Alerts', $_GET['record']);
        $bean->is_read = 1;
        $bean->save();

        if(empty($bean->url_redirect)) {
            if (!empty($_SERVER['HTTP_REFERER'])){
                SugarApplication::redirect($_SERVER['HTTP_REFERER']);
            }
            SugarApplication::redirect('index.php');
        }

        $url_redirect=$bean->url_redirect;
        $custom_changed_redirect_url = str_replace('&amp;', '&', $url_redirect);

        SugarApplication::redirect($custom_changed_redirect_url);

    }
}
?>