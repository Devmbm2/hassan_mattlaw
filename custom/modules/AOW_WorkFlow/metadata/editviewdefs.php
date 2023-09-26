<?php
/**
 * Advanced OpenWorkflow, Automating SugarCRM.
 * @package Advanced OpenWorkflow for SugarCRM
 * @copyright SalesAgility Ltd http://www.salesagility.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SalesAgility <info@salesagility.com>
 */
global $current_user;
      if(is_admin($current_user) || ACLAction::getUserAccessLevel($current_user->id,"SecurityGroups", 'access') == ACL_ALLOW_ENABLED) {

      require_once('modules/SecurityGroups/SecurityGroup.php');
      $groupFocus = new SecurityGroup();
      $security_modules = $groupFocus->getSecurityModules();
      //if(in_array($module,$security_modules)) {
      if(in_array($module,array_keys($security_modules))) {

        global $app_strings;

        global $current_language;
        $current_module_strings = return_module_language($current_language, 'SecurityGroups');

        $form_header = get_form_header($current_module_strings['LBL_MASS_ASSIGN'], '', false);

        $groups = $groupFocus->get_list("name","",0,-99,-99);
        $options = array(""=>"Select Team");
        foreach($groups['list'] as $group) {
          $options[$group->id] = $group->name;
        }
        $group_options =  get_select_options_with_id($options, "");
        // print_r($group_options);die;

}
}
$viewdefs ['AOW_WorkFlow'] =
    array (
        'EditView' =>
        array (
            'templateMeta' =>
            array (
			'form' => 
			  array (
			  'buttons' => 
				array (
				  0 => 'SAVE',
				  1 => 'CANCEL',
				),
			  ),
              'includes' => 
                  array (
                    0 => 
                    array (
                      'file' => 'custom/modules/AOW_WorkFlow/js/edit.js',
                    ),
                  ),
                'maxColumns' => '2',
                'widths' =>
                array (
                    0 =>
                    array (
                        'label' => '10',
                        'field' => '30',
                    ),
                    1 =>
                    array (
                        'label' => '10',
                        'field' => '30',
                    ),
                ),
                'useTabs' => false,
				'form' => array(
					'headerTpl' => 'custom/modules/AOW_WorkFlow/tpls/EditViewHeader.tpl',
					'footerTpl' => 'custom/modules/AOW_WorkFlow/tpls/EditViewFooter.tpl',
				),
                'tabDefs' =>
                array (
                    'DEFAULT' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'CONDITIONS' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'ACTIONS' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                ),
                'syncDetailEditViews' => false,
            ),
            'panels' =>
            array (
                'default' =>
                array (
                    0 =>
                    array (
                        0 => 'name',
                        1 => 
                        array (
                            'name' => 'assigned_type',
                             'label' => 'LBL_ASSIGNED_TYPE', 
                        ),
                    ),
                    1 => 
                    array (
                        0 => 
                        array (
                              'name' => 'assigned_team',
                             'label' => 'LBL_ASSIGNED_TEAM',  
                            'customCode' => '<select name="assigned_team" id="assigned_team" tabindex="1">'.$group_options.'</select><input type = "hidden" value = {$fields.assigned_team.value} id = "assigned_team_id" name = "assigned_team_id">',
                        ),
                        1 => 'assigned_user_name',
                        ),
                    2 =>
                    array (
                        0 =>
                        array (
                            'name' => 'flow_module',
                            'studio' => 'visible',
                            'label' => 'LBL_FLOW_MODULE',
                        ),
                        1 =>
                        array (
                            'name' => 'status',
                            'studio' => 'visible',
                            'label' => 'LBL_STATUS',
                        ),
                    ),
                    3 =>
                    array (
                        0 =>
                        array (
                            'name' => 'run_when',
                            'label' => 'LBL_RUN_WHEN',
                        ),
                        1 =>
                            array (
                                'name' => 'flow_run_on',
                                'studio' => 'visible',
                                'label' => 'LBL_FLOW_RUN_ON',
                            ),
                    ),
                    4 =>
                    array (
                        0 =>
                        array (
                            'name' => 'multiple_runs',
                            'label' => 'LBL_MULTIPLE_RUNS',
                        ),
                        1 =>
                        array (
                            'name' => 'workflow_type',
                            'label' => 'LBL_WORKFLOW_TYPE',
                        ),
                    ),
                    5 =>
                    array (
                        0 => 'description',
                    ),
                    6 =>
                    array (
                        0 => 'workflow_score',
                    ),
                ),
                'LBL_CONDITION_LINES' =>
                array (
                ),
                'LBL_ACTION_LINES' =>
                array (
                    0 =>
                    array (
                        0 => 'action_lines',
                    ),
                ),
            ),
        ),
    );
?>
