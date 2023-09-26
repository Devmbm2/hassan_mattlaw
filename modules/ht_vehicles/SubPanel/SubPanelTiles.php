<?php

require_once('include/SubPanel/SubPanelTiles.php');

/**
 * Vehicles Subpanel tiles
 * @api
 */
class ht_VehiclesSubPanelTiles extends SubPanelTiles
{
	

    
	function display($showContainer = true, $forceTabless = false)
	{
		global $layout_edit_mode, $sugar_version, $sugar_config, $current_user, $app_strings, $modListHeader, $app_list_strings;

		if(isset($layout_edit_mode) && $layout_edit_mode){
			return;
		}

        $template = new Sugar_Smarty();
        $template_header = "";
        $template_body = "";
        $template_footer = "";

        $tabs = array();
        $tabs_properties = array();
        $tab_names = array();

        $default_div_display = 'inline';
        if(!empty($sugar_config['hide_subpanels_on_login'])){
            if(!isset($_SESSION['visited_details'][$this->focus->module_dir])){
                setcookie($this->focus->module_dir . '_divs', '',0,null,null,false,true);
                unset($_COOKIE[$this->focus->module_dir . '_divs']);
                $_SESSION['visited_details'][$this->focus->module_dir] = true;
            }
            $default_div_display = 'none';}
        $div_cookies = get_sub_cookies($this->focus->module_dir . '_divs');


        if(empty($_REQUEST['subpanels']))
        {
            $selected_group = $forceTabless?'':$this->getSelectedGroup();
            $usersLayout = $current_user->getPreference('subpanelLayout', $this->focus->module_dir);

            // we need to use some intelligence here when restoring the user's layout, as new modules with new subpanels might have been installed since the user's layout was recorded
            // this means that we can't just restore the old layout verbatim as the new subpanels would then go walkabout
            // so we need to do a merge while attempting as best we can to preserve the sense of the specified order
            // this is complicated by the different ordering schemes used in the two sources for the panels: the user's layout uses an ordinal layout, the panels from getTabs have an explicit ordering driven by the 'order' parameter
            // it's not clear how to best reconcile these two schemes; so we punt on it, and add all new panels to the end of the user's layout. At least this will give them a clue that something has changed...
            // we also now check for tabs that have been removed since the user saved his or her preferences.

            $tabs = $this->getTabs($showContainer, $selected_group) ;

            if(!empty($usersLayout))
            {
                $availableTabs = $tabs ;
                $tabs = array_intersect ( $usersLayout , $availableTabs ) ; // remove any tabs that have been removed since the user's layout was saved
                foreach (array_diff ( $availableTabs , $usersLayout ) as $tab) {
                    $tabs [] = $tab;
                }
            }
        }
        else
        {
            $tabs = explode(',', $_REQUEST['subpanels']);
        }

        // Display the group header. this section is executed only if the tabbed interface is being used.
        $current_key = '';
        if (! empty($this->show_tabs))
        {
            require_once('include/tabs.php');
            $tab_panel = new SugarWidgetTabs($tabs, $current_key, 'showSubPanel');
            $template_header .= get_form_header('Related', '', false);
            $template_header .= $tab_panel->display();
        }

        if (empty($GLOBALS['relationships'])) {
            if (!class_exists('Relationship')) {
                require('modules/Relationships/Relationship.php');
            }
            $rel= new Relationship();
            $rel->load_relationship_meta();
        }
		foreach ($tabs as $t => $tab)
        {
            // load meta definition of the sub-panel.
            $thisPanel = $this->subpanel_definitions->load_subpanel($tab);
            if ($thisPanel === false) {
                continue;
            }
            // this if-block will try to skip over ophaned subpanels. Studio/MB are being delete unloaded modules completely.
            // this check will ignore subpanels that are collections (activities, history, etc)
            if (!isset($thisPanel->_instance_properties['collection_list']) and isset($thisPanel->_instance_properties['get_subpanel_data']) ) {
                // ignore when data source is a function

                if (!isset($this->focus->field_defs[$thisPanel->_instance_properties['get_subpanel_data']])) {
                    if (stripos($thisPanel->_instance_properties['get_subpanel_data'],'function:') === false) {
                        $GLOBALS['log']->fatal("Bad subpanel definition, it has incorrect value for get_subpanel_data property " .$tab);
                        continue;
                    }
                } else {
                    $rel_name='';
                    if (isset($this->focus->field_defs[$thisPanel->_instance_properties['get_subpanel_data']]['relationship'])) {
                        $rel_name=$this->focus->field_defs[$thisPanel->_instance_properties['get_subpanel_data']]['relationship'];
                    }

                    if (empty($rel_name) or !isset($GLOBALS['relationships'][$rel_name])) {
                        $GLOBALS['log']->fatal("Missing relationship definition " .$rel_name. ". skipping " .$tab ." subpanel");
                        continue;
                    }
                }
            }

            if ($thisPanel->isCollection()) {
                // collect names of sub-panels that may contain items of each module
                $collection_list = $thisPanel->get_inst_prop_value('collection_list');
                if (is_array($collection_list)) {
                    foreach ($collection_list as $data) {
                        if (!empty($data['module'])) {
                            $module_sub_panels[$data['module']][$tab] = true;
                        }
                    }
                }
            } else {
                $module = $thisPanel->get_module_name();
                if (!empty($module)) {
                    $module_sub_panels[$module][$tab] = true;
                }
            }

            $display = 'none';
            $div_display = $default_div_display;
            $cookie_name =   $tab . '_v';

            if (isset($thisPanel->_instance_properties['collapsed']) && $thisPanel->_instance_properties['collapsed'])
            {
                $div_display = 'none';
            }

            if(isset($div_cookies[$cookie_name])){
                // If defaultSubPanelExpandCollapse is set, ignore the cookie that remembers whether the panel is expanded or collapsed.
                // To be used with the above 'collapsed' metadata setting so they will always be set the same when the page is loaded.
                if(!isset($sugar_config['defaultSubPanelExpandCollapse']) || $sugar_config['defaultSubPanelExpandCollapse'] == false)
                {
                    $div_display = 	$div_cookies[$cookie_name];
                }
            }

            if(!empty($sugar_config['hide_subpanels']) or $thisPanel->isDefaultHidden()) {
                $div_display = 'none';
            }

            if($div_display == 'none'){
                $opp_display  = 'inline';
                $tabs_properties[$t]['expanded_subpanels'] = false;
            } else{
                $opp_display  = 'none';
                $tabs_properties[$t]['expanded_subpanels'] = true;
            }

            if (!empty($this->layout_def_key) ) {
                $layout_def_key = $this->layout_def_key;
            } else {
                $layout_def_key = '';
            }

            if (empty($this->show_tabs))
            {
                ///
                /// Legacy Support for subpanels
                $show_icon_html = SugarThemeRegistry::current()->getImage('advanced_search', 'border="0" align="absmiddle"', null, null, '.gif', translate('LBL_SHOW'));
                $hide_icon_html = SugarThemeRegistry::current()->getImage('basic_search', 'border="0" align="absmiddle"', null, null, '.gif', translate('LBL_HIDE'));

                $tabs_properties[$t]['show_icon_html'] = $show_icon_html;
                $tabs_properties[$t]['hide_icon_html'] = $hide_icon_html;

                $max_min = "<a name=\"$tab\"> </a><span id=\"show_link_".$tab."\" style=\"display: $opp_display\"><a href='#' class='utilsLink' onclick=\"current_child_field = '".$tab."';showSubPanel('".$tab."',null,null,'".$layout_def_key."');document.getElementById('show_link_".$tab."').style.display='none';document.getElementById('hide_link_".$tab."').style.display='';return false;\">"
                    . "" . $show_icon_html . "</a></span>";
                $max_min .= "<span id=\"hide_link_".$tab."\" style=\"display: $div_display\"><a href='#' class='utilsLink' onclick=\"hideSubPanel('".$tab."');document.getElementById('hide_link_".$tab."').style.display='none';document.getElementById('show_link_".$tab."').style.display='';return false;\">"
                    . "" . $hide_icon_html . "</a></span>";
                $tabs_properties[$t]['title'] = $thisPanel->get_title();
                $tabs_properties[$t]['module_name'] = $thisPanel->get_module_name();
                $tabs_properties[$t]['get_form_header']  = get_form_header( $thisPanel->get_title(), $max_min, false, false);
            }

            $tabs_properties[$t]['cookie_name'] = $cookie_name;
            $tabs_properties[$t]['div_display'] = $div_display;
            $tabs_properties[$t]['opp_display'] = $opp_display;

            // Get Subpanel
            include_once('include/SubPanel/SubPanel.php');
            $subpanel_object = new SubPanel($this->module, $_REQUEST['record'], $tab, $thisPanel, $layout_def_key);

            $arr = array();
            // TODO: Remove x-template:
			$sub_panel_list = $app_list_strings['sub_insurance_panels'];
			if(in_array($tab, $sub_panel_list)){
				$dynamic_template = 'modules/ht_vehicles/SubPanel/tpls/SubPanelDynamic.tpl';
			}else{
				$dynamic_template = 'include/SubPanel/tpls/SubPanelDynamic.tpl';
			}
			$tabs_properties[$t]['subpanel_body'] = $subpanel_object->ProcessSubPanelListView($dynamic_template, $arr);
            // Get subpanel buttons
            $tabs_properties[$t]['buttons'] = $this->get_buttons($thisPanel,$subpanel_object->subpanel_query);

            array_push($tab_names, $tab);
        }

        $tab_names = '["' . join($tab_names, '","') . '"]';

        $module_sub_panels = array_map('array_keys', $module_sub_panels);
        $module_sub_panels = json_encode($module_sub_panels);

        $template->assign('layout_def_key', $this->layout_def_key);
        $template->assign('show_subpanel_tabs', $this->show_tabs);
        $template->assign('subpanel_tabs', $tabs);
        $template->assign('subpanel_tabs_properties', $tabs_properties);
        $template->assign('module_sub_panels', $module_sub_panels);
        $template->assign('sugar_config', $sugar_config);
        $template->assign('REQUEST', $_REQUEST);
        $template->assign('GLOBALS', $GLOBALS);
        $template->assign('selected_group', $selected_group);
        $template->assign('tab_names', $tab_names);
        $template->assign('module_sub_panels', $module_sub_panels);
        $template->assign('module', $this->module);
        $template->assign('APP', $app_strings);

        $template_body = $template->fetch('modules/ht_vehicles/SubPanel/tpls/SubPanelTiles.tpl');

        return $template_header . $template_body . $template_footer;
	}
}
?>
