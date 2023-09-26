<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class UsersActivityLogicHooks
{
    function after_ui_frame($event, $arguments)
    {
        global $current_user, $beanList;
        if( isset($_REQUEST['record']) && $_REQUEST['record'] != '' )
        {
            $exclude = UsersActivity::checkExcludeTraking($_SERVER['REMOTE_ADDR'],$current_user->id,$_REQUEST['action'],$_REQUEST['module']);
            if (!$exclude)
            {
                $name = $current_user->name. " (".$current_user->user_name.")";
                // Check is new item saved
                if ($_REQUEST['action'] == 'DetailView')
                {
                    $db = DBManagerFactory::getInstance();
                    $ret = $db->query("SELECT id FROM usersactivity WHERE session_id='".session_id()."' "
                            . " AND action_name='EditView' AND module_name='{$_REQUEST['module']}'  AND deleted='0' AND (item_id IS NULL OR item_id='')"
                            . " ORDER BY date_entered DESC LIMIT 0,1");	
						
                    if ($db->getRowCount($ret) > 0)
                    {
                        $data = $db->fetchByAssoc($ret);
                        $module = $_REQUEST['module'];
                        if(isset($beanList[$module]) && $beanList[$module])
                        {
                            $item = new $beanList[$module]();
                            $item->retrieve($_REQUEST['record']);
                            if($date['item_id']==null || $date['item_id']=='')
                            {
                            $db->query("UPDATE usersactivity SET action_name='Create', item_id='{$_REQUEST['record']}', "
                            . " item_name='{$item->name}' WHERE id='{$data['id']}' ");
                            }
                        }
                    }
                }
                
                $activity = new UsersActivity();
                $activity->name = $name;
                $activity->assigned_user_id = $current_user->id;
                $activity->ip_address = $_SERVER['REMOTE_ADDR'];
                $activity->session_id = session_id();
                $activity->action_name = $_REQUEST['action'];
                $activity->module_name = $_REQUEST['module'];
                $activity->item_id = $_REQUEST['record'];
                if (isset($_REQUEST['module']))
                {
                    $module = $_REQUEST['module'];
                    if(isset($beanList[$module]) && $beanList[$module])
                    {
                        $item = new $beanList[$module]();
                        $item->retrieve($_REQUEST['record']);
                        $activity->item_name = $item->name;
                    }
                }
                unset($activity->module_dir);
                $activity->save();
			}
        }
        elseif( isset($_REQUEST['action']) && $_REQUEST['action'] == 'EditView' )
        {
            $exclude = UsersActivity::checkExcludeTraking($_SERVER['REMOTE_ADDR'],$current_user->id,$_REQUEST['action'],$_REQUEST['module']);
            if (!$exclude)
            {
                $activity = new UsersActivity();
                $activity->name =  $current_user->name. " (".$current_user->user_name.")";
                $activity->assigned_user_id = $current_user->id;
                $activity->ip_address = $_SERVER['REMOTE_ADDR'];
                $activity->session_id = session_id();
                $activity->action_name = $_REQUEST['action'];
                $activity->module_name = $_REQUEST['module'];
                unset($activity->module_dir);
                $activity->save();
            }
        }
    }
    
    function after_delete($bean, $event, $arguments)
    {        
        global $current_user, $beanList;
        $exclude = UsersActivity::checkExcludeTraking($_SERVER['REMOTE_ADDR'],$current_user->id,'Delete',$_REQUEST['module']);
        if (!$exclude)
        {
            $activity = new UsersActivity();
            $activity->name =  $current_user->name. " (".$current_user->user_name.")";
            $activity->assigned_user_id = $current_user->id;
            $activity->ip_address = $_SERVER['REMOTE_ADDR'];
            $activity->session_id = session_id();
            $activity->action_name = 'Delete';
            $activity->module_name = $bean->module_dir;
            $activity->item_id = $bean->id;
            $activity->item_name = $bean->name;
            unset($activity->module_dir);
            $activity->save();
        }
    }
}

?>