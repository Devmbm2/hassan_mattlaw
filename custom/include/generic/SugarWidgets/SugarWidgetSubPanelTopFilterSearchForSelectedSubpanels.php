<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class SugarWidgetSubPanelTopFilterSearchForSelectedSubpanels  extends SugarWidgetSubPanelTopButton{

    function display($defines, $additionalFormFields = NULL, $nonbutton = false)
    {
        global $app_strings, $sugar_config;

        // $button = "<script src='custom/include/SubPanel/SubPanel.js'></script>
        $button = "<script>
        if(window.DisplaySearch==1){
            showSearchPanel('".$defines['subpanel_definition']->name."');
        }
        </script>
        ";
        $button .= "<img src = '{$sugar_config['site_url']}/themes/Honey/images/p_list_search.png' onclick = \"showSearchPanel('" .$defines['subpanel_definition']->name. "');return false;\" style = 'cursor:pointer;'>";
        return $button;
    }

}
