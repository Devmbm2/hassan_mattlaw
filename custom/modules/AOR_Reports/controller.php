<?php

/**
 * Advanced OpenReports, SugarCRM Reporting.
 * @package Advanced OpenReports for SugarCRM
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

require_once("modules/AOW_WorkFlow/aow_utils.php");
require_once("modules/AOR_Reports/aor_utils.php");

class AOR_ReportsController extends SugarController
{

    protected function action_getModuleFields()
    {
		// echo "test";
		// die();
        if (!empty($_REQUEST['aor_module']) && $_REQUEST['aor_module'] != '') {
            if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
                $module = getRelatedModule($_REQUEST['aor_module'], $_REQUEST['rel_field']);
            } else {
                $module = $_REQUEST['aor_module'];
            }
            $val = !empty($_REQUEST['aor_value']) ? $_REQUEST['aor_value'] : '';
            // echo getModuleFields($module, $_REQUEST['view'], $val);
            echo getModuleFields($module, $_REQUEST['view'], $val);
        }
        die;

    }

    public function action_getVarDefs()
    {
		// global $app_list_strings, $mod_strings; 
		// print"<pre>"; print_r($mod_strings["fieldTypes"]);
		// print"<pre>"; print_r($app_list_strings["fieldTypes"]);
		// die();
        if ($_REQUEST['aor_module']) {
            $bean = BeanFactory::getBean($_REQUEST['aor_module']);
			// print('<pre>');print_r($bean->field_defs);
			// die();
            echo json_encode((array)$bean->field_defs[$_REQUEST['aor_request']]);
            die();
        }
    }

    protected function action_getModuleTreeData()
    {
        if (!empty($_REQUEST['aor_module']) && $_REQUEST['aor_module'] != '') {
            ob_start();
            $data = getModuleTreeData($_REQUEST['aor_module']);
            ob_clean();
            echo $data;
        }
        die;
    }

    protected function action_getModuleRelationships()
    {
        if (!empty($_REQUEST['aor_module']) && $_REQUEST['aor_module'] != '') {
            echo getModuleRelationships($_REQUEST['aor_module']);
        }
        die;
    }

    protected function action_changeReportPage()
    {
        $offset = !empty($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
        if (!empty($this->bean->id)) {
            $this->bean->user_parameters = requestToUserParameters();
            echo $this->bean->build_group_report($offset, true);
        }

        die();
    }

    protected function action_getParametersForReport()
    {
        if (empty($_REQUEST['record'])) {
            echo json_encode(array());

            return;
        }
        $report = BeanFactory::getBean('AOR_Reports', $_REQUEST['record']);
        if (!$report) {
            echo json_encode(array());

            return;
        }
        if (empty($report->id)) {
            echo json_encode(array());

            return;
        }
        $conditions = getConditionsAsParameters($report);
        echo json_encode($conditions);
    }

    protected function action_getChartsForReport()
    {
        if (empty($_REQUEST['record'])) {
            echo json_encode(array());

            return;
        }
        $report = BeanFactory::getBean('AOR_Reports', $_REQUEST['record']);
        if (!$report) {
            echo json_encode(array());

            return;
        }
        $charts = array();
        foreach ($report->get_linked_beans('aor_charts', 'AOR_Charts') as $chart) {
            $charts[$chart->id] = $chart->name;
        }
        echo json_encode($charts);
    }

    protected function action_addToProspectList()
    {
        global $beanList;

        require_once('modules/Relationships/Relationship.php');
        require_once('modules/ProspectLists/ProspectList.php');

        $prospectList = new ProspectList();
        $prospectList->retrieve($_REQUEST['prospect_id']);

        $module = new $beanList[$this->bean->report_module]();

        $key = Relationship::retrieve_by_modules($this->bean->report_module, 'ProspectLists', $GLOBALS['db']);
        if (!empty($key)) {

            $sql = $this->bean->build_report_query();
            $result = $this->bean->db->query($sql);
            $beans = array();
            while ($row = $this->bean->db->fetchByAssoc($result)) {
                if (isset($row[$module->table_name . '_id'])) {
                    $beans[] = $row[$module->table_name . '_id'];
                }
            }
            if (!empty($beans)) {
                foreach ($prospectList->field_defs as $field => $def) {
                    if ($def['type'] == 'link' && !empty($def['relationship']) && $def['relationship'] == $key) {
                        $prospectList->load_relationship($field);
                        $prospectList->$field->add($beans);
                    }
                }
            }
        }
        die;
    }

    protected function action_chartReport()
    {
        $this->bean->build_report_chart(null, AOR_Report::CHART_TYPE_CHARTJS);

        die;
    }

    protected function action_export()
    {
        $this->bean->user_parameters = requestToUserParameters();
        $this->bean->build_report_csv();
        die;
    }

    protected function action_downloadPDF()
    {
        error_reporting(0);
        require_once('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');

        $d_image = explode('?', SugarThemeRegistry::current()->getImageURL('company_logo.png'));
        $graphs = $_POST["graphsForPDF"];
        $graphHtml = "<div class='reportGraphs' style='width:100%; text-align:center;'>";

        $chartsPerRow = $this->bean->graphs_per_row;
        $countOfCharts = count($graphs);
        if ($countOfCharts > 0) {
            $width = ((int)100 / $chartsPerRow);

            $modulusRemainder = $countOfCharts % $chartsPerRow;

            if ($modulusRemainder > 0) {
                $modulusWidth = ((int)100 / $modulusRemainder);
                $itemsWithModulus = $countOfCharts - $modulusRemainder;
            }


            for ($x = 0; $x < $countOfCharts; $x++) {
                if (is_null($itemsWithModulus) || $x < $itemsWithModulus) {
                    $graphHtml .= "<img src='.$graphs[$x].' style='width:$width%;' />";
                } else {
                    $graphHtml .= "<img src='.$graphs[$x].' style='width:$modulusWidth%;' />";
                }
            }

            /*            foreach($graphs as $g)
                        {
                            $graphHtml.="<img src='.$g.' style='width:$width%;' />";
                        }*/
            $graphHtml .= "</div>";
        }

        /* $head = '<table style="width: 100%; font-family: Arial; text-align: center;" border="0" cellpadding="2" cellspacing="2">
                <tbody style="text-align: left;">
                <tr style="text-align: left;">
                <td style="text-align: left;">
                <p><img src="' . $d_image[0] . '" style="float: left;"/>&nbsp;</p>
                </td>
                <tr style="text-align: left;">
                <td style="text-align: left;"></td>
                </tr>
                 <tr style="text-align: left;">
                <td style="text-align: left;">
                </td>
                <tr style="text-align: left;">
                <td style="text-align: left;"></td>
                </tr>
                <tr style="text-align: left;">
                <td style="text-align: left;">
                <b>' . strtoupper($this->bean->name) . '</b>
                </td>
                </tr>
                </tbody>
                </table><br />' . $graphHtml; */
		$head = '<b>' . strtoupper($this->bean->name) . '</b>';

        $this->bean->user_parameters = requestToUserParameters();

        $printable = $this->bean->build_group_report(-1, false);
        $stylesheet = file_get_contents(SugarThemeRegistry::current()->getCSSURL('style.css', false));
        ob_clean();
        try {
            $pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed');
            $pdf->setAutoFont();
            $pdf->WriteHTML($stylesheet, 1);
            $pdf->WriteHTML($head, 2);
            $pdf->WriteHTML($printable, 3);
            $pdf->Output($this->bean->name . '.pdf', "D");

        } catch (mPDF_exception $e) {
            echo $e;
        }

        die;
    }

    protected function action_getModuleFunctionField()
    {
        global $app_list_strings;

        $view = $_REQUEST['view'];
        $value = $_REQUEST['aor_value'];
        $module = $_REQUEST['aor_module'];
        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if ($view == 'EditView') {
            echo "<select type='text' style='width:100px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . get_select_options_with_id($app_list_strings['aor_function_list'],
                    $value) . "</select>";
        } else {
            echo $app_list_strings['aor_function_list'][$value];
        }
        die;
    }


    protected function action_getModuleOperatorField()
    {

        global $app_list_strings, $beanFiles, $beanList;

        if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
            $module = getRelatedModule($_REQUEST['aor_module'], $_REQUEST['rel_field']);
        } else {
            $module = $_REQUEST['aor_module'];
        }
        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }


        require_once($beanFiles[$beanList[$module]]);
        $focus = new $beanList[$module];
        $vardef = $focus->getFieldDefinition($fieldname);

        switch ($vardef['type']) {
            case 'double':
            case 'decimal':
            case 'float':
            case 'currency':
                $valid_opp = array(
                    'Equal_To',
                    'Not_Equal_To',
                    'Greater_Than',
                    'Less_Than',
                    'Greater_Than_or_Equal_To',
                    'Less_Than_or_Equal_To'
                );
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
            case 'int':
                $valid_opp = array(
                    'Equal_To',
                    'Not_Equal_To',
                    'Greater_Than',
                    'Less_Than',
                    'Greater_Than_or_Equal_To',
                    'Less_Than_or_Equal_To'
                );
                break;
            case 'date':
            case 'datetime':
            case 'datetimecombo':
                $valid_opp = array(
                    'Equal_To',
                    'Not_Equal_To',
                    'Greater_Than',
                    'Less_Than',
                    'Greater_Than_or_Equal_To',
                    'Less_Than_or_Equal_To'
                );
                break;
            case 'enum':
            case 'multienum':
                $valid_opp = array('Equal_To', 'Not_Equal_To');
                break;
            default:
                $valid_opp = array('Equal_To', 'Not_Equal_To', 'Contains', 'Starts_With', 'Ends_With',);
                break;
        }

        foreach ($app_list_strings['aor_operator_list'] as $key => $keyValue) {
            if (!in_array($key, $valid_opp)) {
                unset($app_list_strings['aor_operator_list'][$key]);
            }
        }


        $app_list_strings['aor_operator_list'];
        if ($view == 'EditView') {
            echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . get_select_options_with_id($app_list_strings['aor_operator_list'],
                    $value) . "</select>";
        } else {
            echo $app_list_strings['aor_operator_list'][$value];
        }
        die;

    }

    protected function action_getFieldTypeOptions()
    {

        global $app_list_strings, $beanFiles, $beanList;

        if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
            $module = getRelatedModule($_REQUEST['aor_module'], $_REQUEST['rel_field']);
        } else {
            $module = $_REQUEST['aor_module'];
        }
        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }


        require_once($beanFiles[$beanList[$module]]);
        $focus = new $beanList[$module];
        $vardef = $focus->getFieldDefinition($fieldname);

        switch ($vardef['type']) {
            case 'double':
            case 'decimal':
            case 'float':
            case 'currency':
                $valid_opp = array('Value', 'Field');
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
            case 'int':
                $valid_opp = array('Value', 'Field');
                break;
            case 'date':
            case 'datetime':
            case 'datetimecombo':
                $valid_opp = array('Value', 'Field', 'Date', 'Period');
                break;
            case 'enum':
            case 'dynamicenum':
            case 'multienum':
                $valid_opp = array('Value', 'Field', 'Multi');
                break;
            default:
                // Added to compare fields like assinged to with the current user
                if ((isset($vardef['module']) && $vardef['module'] == "Users") || $vardef['name'] = 'id') {
                    $valid_opp = array('Value', 'Field', 'CurrentUserID');
                } else {
                    $valid_opp = array('Value', 'Field');
                }

                break;
        }

        foreach ($app_list_strings['aor_condition_type_list'] as $key => $keyValue) {
            if (!in_array($key, $valid_opp)) {
                unset($app_list_strings['aor_condition_type_list'][$key]);
            }
        }

        if ($view == 'EditView') {
            echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . get_select_options_with_id($app_list_strings['aor_condition_type_list'],
                    $value) . "</select>";
        } else {
            echo $app_list_strings['aor_condition_type_list'][$value];
        }
        die;

    }

    protected function action_getActionFieldTypeOptions()
    {

        global $app_list_strings, $beanFiles, $beanList;

        if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
            $module = getRelatedModule($_REQUEST['aor_module'], $_REQUEST['rel_field']);
        } else {
            $module = $_REQUEST['aor_module'];
        }

        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }


        require_once($beanFiles[$beanList[$module]]);
        $focus = new $beanList[$module];
        $vardef = $focus->getFieldDefinition($fieldname);

        switch ($vardef['type']) {
            case 'double':
            case 'decimal':
            case 'float':
            case 'currency':
                $valid_opp = array('Value', 'Field');
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
            case 'int':
                $valid_opp = array('Value', 'Field');
                break;
            case 'date':
            case 'datetime':
            case 'datetimecombo':
                $valid_opp = array('Value', 'Field', 'Date');
                break;
            case 'enum':
            case 'multienum':
                $valid_opp = array('Value', 'Field');
                break;
            case 'relate':
                $valid_opp = array('Value', 'Field');
                if ($vardef['module'] == 'Users') {
                    $valid_opp = array('Value', 'Field', 'Round_Robin', 'Least_Busy', 'Random');
                }
                break;
            default:
                $valid_opp = array('Value', 'Field');
                break;
        }

        foreach ($app_list_strings['aor_action_type_list'] as $key => $keyValue) {
            if (!in_array($key, $valid_opp)) {
                unset($app_list_strings['aor_action_type_list'][$key]);
            }
        }

        if ($view == 'EditView') {
            echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . get_select_options_with_id($app_list_strings['aor_action_type_list'],
                    $value) . "</select>";
        } else {
            echo $app_list_strings['aor_action_type_list'][$value];
        }
        die;

    }

    protected function action_getModuleFieldType()
    {
        if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
            $rel_module = getRelatedModule($_REQUEST['aor_module'], $_REQUEST['rel_field']);
        } else {
            $rel_module = $_REQUEST['aor_module'];
        }
        $module = $_REQUEST['aor_module'];

        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }

        switch ($_REQUEST['aor_type']) {
            case 'Field':
                if (isset($_REQUEST['alt_module'])
                    && $_REQUEST['alt_module'] != ''
                ) {
                    $module = $_REQUEST['alt_module'];
                }
                if ($view == 'EditView') {
                    echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . getModuleFields($module,
                            $view, $value) . "</select>";
                } else {
                    echo getModuleFields($module, $view, $value);
                }
                break;
            case 'Date':
                echo getDateField($module, $aor_field, $view, $value, false);
                break;
            case 'Multi':
                echo getModuleField($rel_module, $fieldname, $aor_field, $view, $value, 'multienum');
                break;
            case 'Period':
                if ($view == 'EditView') {
                    echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . getDropdownList('date_time_period_list',
                            $_REQUEST['aor_value']) . "</select>";
                } else {
                    echo getDropdownList('date_time_period_list', $_REQUEST['aor_value']);
                }

                break;
            case 'CurrentUserID':
                break;
            case 'Value':
            default:
                echo getModuleField($rel_module, $fieldname, $aor_field, $view, $value);
                break;
        }
        die;

    }

    protected function action_getModuleFieldTypeSet()
    {
        $module = $_REQUEST['aor_module'];
        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }

        switch ($_REQUEST['aor_type']) {
            case 'Field':
                if (isset($_REQUEST['alt_module']) && $_REQUEST['alt_module'] != '') {
                    $module = $_REQUEST['alt_module'];
                }
                if ($view == 'EditView') {
                    echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . getModuleFields($module,
                            $view, $value) . "</select>";
                } else {
                    echo getModuleFields($module, $view, $value);
                }
                break;
            case 'Date':
                if (isset($_REQUEST['alt_module']) && $_REQUEST['alt_module'] != '') {
                    $module = $_REQUEST['alt_module'];
                }
                echo getDateField($module, $aor_field, $view, $value);
                break;
            Case 'Round_Robin';
            Case 'Least_Busy';
            Case 'Random';
                echo getAssignField($aor_field, $view, $value);
                break;
            case 'Value':
            default:
                echo getModuleField($module, $fieldname, $aor_field, $view, $value);
                break;
        }
        die;

    }

    protected function action_getModuleField()
    {
        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }

        echo getModuleField($_REQUEST['aor_module'], $_REQUEST['aor_fieldname'], $_REQUEST['aor_newfieldname'], $view,
            $value);
        die;
    }

    protected function action_getRelFieldTypeSet()
    {
        $module = $_REQUEST['aor_module'];
        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }

        switch ($_REQUEST['aor_type']) {
            case 'Field':
                if (isset($_REQUEST['alt_module']) && $_REQUEST['alt_module'] != '') {
                    $module = $_REQUEST['alt_module'];
                }
                if ($view == 'EditView') {
                    echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . getModuleFields($module,
                            $view, $value) . "</select>";
                } else {
                    echo getModuleFields($module, $view, $value);
                }
                break;
            case 'Value':
            default:
                echo getModuleField($module, $fieldname, $aor_field, $view, $value);
                break;
        }
        die;

    }

    protected function action_getRelActionFieldTypeOptions()
    {

        global $app_list_strings, $beanFiles, $beanList;

        $module = $_REQUEST['aor_module'];
        $alt_module = $_REQUEST['alt_module'];
        $fieldname = $_REQUEST['aor_fieldname'];
        $aor_field = $_REQUEST['aor_newfieldname'];

        if (isset($_REQUEST['view'])) {
            $view = $_REQUEST['view'];
        } else {
            $view = 'EditView';
        }

        if (isset($_REQUEST['aor_value'])) {
            $value = $_REQUEST['aor_value'];
        } else {
            $value = '';
        }


        require_once($beanFiles[$beanList[$module]]);
        $focus = new $beanList[$module];
        $vardef = $focus->getFieldDefinition($fieldname);


        /*if($vardef['module'] == $alt_module){
            $valid_opp = array('Value','Field');
        }
        else{
            $valid_opp = array('Value');
        }*/
        $valid_opp = array('Value');

        foreach ($app_list_strings['aor_rel_action_type_list'] as $key => $keyValue) {
            if (!in_array($key, $valid_opp)) {
                unset($app_list_strings['aor_rel_action_type_list'][$key]);
            }
        }

        if ($view == 'EditView') {
            echo "<select type='text' style='width:178px;' name='$aor_field' id='$aor_field' title='' tabindex='116'>" . get_select_options_with_id($app_list_strings['aor_rel_action_type_list'],
                    $value) . "</select>";
        } else {
            echo $app_list_strings['aor_rel_action_type_list'][$value];
        }
        die;

    }
	function action_tasksPerStatus(){
		/* ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL); */
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		echo "  <script type='text/javascript' src='cache/include/javascript/sugar_grp1_jquery.js'></script>
				<script type='text/javascript' src='https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js'></script>
				<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script>
				<link href='custom/include/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>
				<link href='custom/include/select2/css/select2.css' rel='stylesheet' type='text/css'/>
				<script type='text/javascript' src='https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
				<script type='text/javascript' src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js'></script>
				<link href='https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'/>
			  
			  ";
		$this->view = '';
		$date_time = $GLOBALS['timedate']->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		/* $header = '<table id = "tasks_report" style="table-layout: fixed;height: 60px; width: 800px;" border="0">
			
				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 430px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Case Status, The number of Tasks that are to be Done</b></span></td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td  style="width: 200px; height: 51px;border:none;"><span style="color:black;float:right;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
				
			
				
					  
			
		</table>'; */
		$multiple_assigned_users_list= '';
		$user_initials = get_user_initials_custom();
		$sql = "SELECT tasks.id as 'task_id', tasks.name as 'task_name',tasks.date_due, tasks.status as 'task_status', tasks.description as 'task_description', tasks.multiple_assigned_users as 'task_multiple_assigned_to', cases.id as 'case_id', cases.name as 'case_name', cases.status
						as 'case_status', cases.type as 'case_type', CONCAT_WS(' ', assistant.first_name, assistant.last_name) as 'assistant_name', CONCAT_WS(' ', attorney.first_name, attorney.last_name) as 'attorney_name'
						FROM tasks
						LEFT JOIN cases ON(cases.deleted = 0 AND tasks.parent_type = 'Cases' AND cases.id = tasks.parent_id) 
						LEFT JOIN users assistant ON(cases.deleted = 0 AND cases.default_assistant_lawyer_id = assistant.id) 
						LEFT JOIN users attorney ON(cases.deleted = 0 AND cases.assigned_user_id = attorney.id) 
						WHERE tasks.deleted = 0 AND tasks.parent_type = 'Cases' AND tasks.status != 'Done'
						";
		/* $result = $GLOBALS['db']->query($sql);
		$data = array();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$data[$row['case_status']][] = $row;
		} */
		$html = '';
		/* foreach($data as $case_status => $task_data){ */
			/* $html .= '<br><span style="font-size: 14px;"><strong>'.$GLOBALS['app_list_strings']['case_status_dom'][$case_status].'</strong></span><br><br>'; */
			$html .= '<span style="color:black;font-size:17px;"><b>Case Status, The number of Tasks that are to be Done</b></span><br>
					<table id = "tasks_report"  border="1">
					<thead>
					<tr>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Due Date</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Task name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Task Status</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Case Name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Case Status </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Case Type </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Attorney </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Assistant </strong></span></td>
					</tr>
					</thead><tbody>';
				/* $multiple_assigned_users_list = ''; */
			$result = $GLOBALS['db']->query($sql);
			while($task = $GLOBALS['db']->fetchByAssoc($result)){
				/* print"<pre>";print_r($task_data);die;  */
				/* $multiple_assigned_users = unencodeMultienum($task['task_multiple_assigned_to']);
				foreach($multiple_assigned_users as $id){
					$multiple_assigned_users_list .= $user_initials[$id].', ';
				} */
				
				$html .='<tr>
							<td>'. $GLOBALS['timedate']->to_display_date_time($task['date_due']) . '</td>
							<td>'. $task['task_name'] . '</td>
							<td>'. $task['task_status'] . '</td>
							<td>'. $task['case_name'] . '</td>
							<td>'. $GLOBALS['app_list_strings']['case_status_dom'][$task['case_status']] . '</td>
							<td>'. $GLOBALS['app_list_strings']['case_type_list'][$task['case_type']] . '</td>
							<td>'. $task['attorney_name'] . '</td>
							<td>'. $task['assistant_name'] . '</td>
							
						</tr>';
			}
			$html .='</tbody></table>'; 
			$html .='<script type="text/javascript">
						$(document).ready(function() {
							$("#tasks_report").DataTable( {
								 					
								columnDefs : [
										 {
										"searchable": false,
										"orderable": true,
										}
									],
									
									"searching": true,
									"paging":false,
									"info":false,
									initComplete: function () {
									   this.api().columns().every( function () {
											$(this.header()).css("padding-bottom", "bottom")
										});
										this.api().columns([4]).every( function () {
											var column = this;
											var select = $(\'<select multiple   id = "case_status" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()));
												

												
											column.data().unique().sort().each( function ( d, j ) {
												
												if(d != "" && d != "&nbsp;"){
													select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
												
											  $("#case_status").on("change", function(){
													var search = [];

												  $.each($("#case_status option:selected"), function(){
														search.push($(this).val());
												  });

												  search = search.join("|");
												  column.search(search, true, false).draw();
												});
										});
										this.api().columns([5]).every( function () {
											var column = this;
											var select = $(\'<select multiple   id = "case_type" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()));
												

												
											column.data().unique().sort().each( function ( d, j ) {
												
												if(d != "" && d != "&nbsp;"){
													select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
												
											  $("#case_type").on("change", function(){
													var search = [];

												  $.each($("#case_type option:selected"), function(){
														search.push($(this).val());
												  });

												  search = search.join("|");
												  column.search(search, true, false).draw();
												});
										});
										this.api().columns([6]).every( function () {
											var column = this;
											var select = $(\'<select name = "attorney" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()))
												.on( "change", function () {
													var val = $.fn.dataTable.util.escapeRegex(
														$(this).val()
													);
													column
														.search( val ? val : "", true, false )
														.draw();
												});
												
												column.data().unique().sort().each( function ( d, j ) {
												   if(d != "" && d != "&nbsp;"){
													   select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
										});	
										this.api().columns([7]).every( function () {
											var column = this;
											var select = $(\'<select name = "attorney" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()))
												.on( "change", function () {
													var val = $.fn.dataTable.util.escapeRegex(
														$(this).val()
													);
													column
														.search( val ? val : "", true, false )
														.draw();
												});
												
												column.data().unique().sort().each( function ( d, j ) {
												   if(d != "" && d != "&nbsp;"){
													   select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
										});
										
											
									}


								} );
								$("#case_status").select2();
								$("#case_type").select2();
								$("#case_status").hide();
								$("#case_type").hide();
						} );
						</script>';
						$html .= '<style>
									#tasks_report_filter{
									float:left;
									}
									.select2-container{ width: 150px !important; }
									{/literal}
								</style>';
		/* } */
		echo $html;

		/* $pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '6', '6', '6','6');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage('L');
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Case Status, The number of Tasks that are to be Done.pdf", 'I'); */
	}
	function action_tasksPerCaseNotDone(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		$this->view = '';
		$date_time = $GLOBALS['timedate']->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
			
				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 430px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Tasks by Case that are not Done</b></span></td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td  style="width: 200px; height: 51px;border:none;"><span style="color:black;float:right;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
				
			
				
					  
			
		</table>';
		$multiple_assigned_users_list= '';
		$user_initials = get_user_initials_custom();
		$sql = "SELECT tasks.id as 'task_id', tasks.name as 'task_name',tasks.date_due, tasks.status as 'task_status', tasks.description as 'task_description', tasks.multiple_assigned_users as 'task_multiple_assigned_to', cases.id as 'case_id', cases.name as 'case_name', cases.status
						as 'case_status', CONCAT_WS(' ', assistant.first_name, assistant.last_name) as 'assistant_name', CONCAT_WS(' ', attorney.first_name, attorney.last_name) as 'attorney_name' 
						FROM tasks
						LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = tasks.parent_id) 
						LEFT JOIN users assistant ON(cases.deleted = 0 AND cases.default_assistant_lawyer_id = assistant.id) 
						LEFT JOIN users attorney ON(cases.deleted = 0 AND cases.assigned_user_id = attorney.id) 
						WHERE tasks.deleted = 0 AND tasks.parent_type = 'Cases' AND tasks.parent_id != '' AND tasks.status != 'Done'
						ORDER BY case_name ASC";
		$result = $GLOBALS['db']->query($sql);
		$data = array();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$data[$row['case_name']][] = $row;
		}
		$html = '';
		foreach($data as $case_name => $task_data){
			$name = empty($case_name) ? '<b>Tasks Which are not Assigned to any Case</b>' : $case_name;
			$html .= '<br><span style="font-size: 12px;"><strong>'. $name . '</strong></span><br>';
			$html .= '<br><table style="border-collapse:collapse; table-layout:fixed;width:100%word-wrap:break-word;" border="1">
					<thead>
					<tr>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Due Date</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task Status</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Status </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Attorney </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Assistant </strong></span></td>
					</tr>
					</thead><tbody>';
				/* $multiple_assigned_users_list = ''; */
			foreach($task_data as $no => $task){
				/* print"<pre>";print_r($task_data);die;  */
				/* $multiple_assigned_users = unencodeMultienum($task['task_multiple_assigned_to']);
				foreach($multiple_assigned_users as $id){
					$multiple_assigned_users_list .= $user_initials[$id].', ';
				} */
				$html .='<tr>
							<td ><span style="font-size: 12px;">'. $GLOBALS['timedate']->to_display_date_time($task['date_due']) . '</span></td>
							<td ><span style="font-size: 12px;">'. $task['task_name'] . '</span></td>
							<td ><span style="font-size: 12px;">'. $task['task_status'] . '</span></td>
							<td ><span style="font-size: 12px;">'. $task['case_name'] . '</span></td>
							<td ><span style="font-size: 12px;">'. $GLOBALS['app_list_strings']['case_status_dom'][$task['case_status']] . '</span></td>
							<td>'. $task['attorney_name'] . '</td>
							<td>'. $task['assistant_name'] . '</td>
						</tr>';
			}
			$html .='</tbody></table>'; 
		}

		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '6', '6', '6','6');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage('L');
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Tasks by Case that are not Done.pdf", 'I');
	}
	function action_tasksPerAttorneyNotDone(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
			echo "  <script type='text/javascript' src='cache/include/javascript/sugar_grp1_jquery.js'></script>
				<script type='text/javascript' src='https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js'></script>
				<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script>
				<link href='custom/include/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>
				<link href='custom/include/select2/css/select2.css' rel='stylesheet' type='text/css'/>
				<script type='text/javascript' src='https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
				<script type='text/javascript' src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js'></script>
				<link href='https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'/>
			  ";
		$this->view = '';
		$date_time = $GLOBALS['timedate']->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		/* $header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
			
				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 430px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Tasks by Attorney Assigned Not Done</b></span></td>
					<td></td><td></td><td></td>
					<td  style="width: 250px; height: 51px;border:none;"><span style="color:black;float:right;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
				
			
				
					  
			
		</table>'; */
		$multiple_assigned_users_list= '';
		$user_initials = get_user_initials_custom();
		$html = '';
		/* foreach($data as $attorney=> $task_data){ */
			$html .= '<span style="color:black;font-size:20px;"><b>Tasks by Attorney Assigned Not Done</b></span><br>
					<table id = "tasks_report" style="border-collapse:collapse; table-layout:fixed;width:100%word-wrap:break-word;" border="1">
					<thead>
					<tr>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Due Date</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Task name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Task Status</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Case Name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Case Status </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 14px;"><strong>Case Type </strong></span></td>
					<td  style="font-size: 14px;font-weight: bold; "><strong>Attorney </strong></td>
					<td  style="font-size: 14px;font-weight: bold; "><strong>Assistant </strong></td>
					</tr>
					</thead><tbody>';
		$sql = "SELECT tasks.id as 'task_id', tasks.name as 'task_name',tasks.date_due, tasks.status as 'task_status', tasks.description as 'task_description', tasks.multiple_assigned_users as 'task_multiple_assigned_to', cases.id as 'case_id', cases.name as 'case_name', cases.status
						as 'case_status', cases.type as 'case_type', CONCAT_WS(' ', assistant.first_name, assistant.last_name) as 'assistant_name', CONCAT_WS(' ', attorney.first_name, attorney.last_name) as 'attorney_name' 
						FROM tasks
						LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = tasks.parent_id) 
						LEFT JOIN users assistant ON(cases.deleted = 0 AND cases.default_assistant_lawyer_id = assistant.id) 
						LEFT JOIN users attorney ON(cases.deleted = 0 AND cases.assigned_user_id = attorney.id)  
						WHERE tasks.deleted = 0 AND tasks.parent_type = 'Cases' AND tasks.parent_id != '' AND tasks.status != 'Done' AND cases.assigned_user_id != ''";
		$result = $GLOBALS['db']->query($sql);
		$data = array();
		$all_users = User::getAllUsers();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$multiple_assigned_users_list = '';
			$multiple_assigned_users = unencodeMultienum($row['task_multiple_assigned_to']);
			foreach($multiple_assigned_users as $id){
				$multiple_assigned_users_list .= $all_users[$id].', ';
			}
			/* echo $multiple_assigned_users_list;die; */
			/* $data[$multiple_assigned_users_list][] = $row; */
		
		/* print"<pre>";print_r($data);die; */
		
			/* foreach($task_data as $no => $task){ */
				$multiple_assigned_users_list = '';
				/* print"<pre>";print_r($task_data);die;  */
				$multiple_assigned_users = unencodeMultienum($task['task_multiple_assigned_to']);
				foreach($multiple_assigned_users as $id){
					$multiple_assigned_users_list .= $user_initials[$id].', ';
				}
				$html .='<tr>
							<td >'. $GLOBALS['timedate']->to_display_date_time($row['date_due']) . '</td>
							<td >'. $row['task_name'] . '</td>
							<td >'. $row['task_status'] . '</td>
							<td >'. $row['case_name'] . '</td>
							<td >'. $GLOBALS['app_list_strings']['case_status_dom'][$row['case_status']] . '</td>
							<td>'. $GLOBALS['app_list_strings']['case_type_list'][$row['case_type']] . '</td>
							<td>'. $row['attorney_name'] . '</td>
							<td>'. $row['assistant_name'] . '</td>
							
						</tr>';
			/* } */
		}
			$html .='</tbody></table>';
$html .='<script type="text/javascript">
						$(document).ready(function() {
							$("#tasks_report").DataTable( {
								 					
								columnDefs : [
										 {
										"searchable": false,
										"orderable": true,
										}
									],
									
									"searching": true,
									"paging":false,
									"info":false,
									initComplete: function () {
									   this.api().columns().every( function () {
											$(this.header()).css("padding-bottom", "bottom")
										});
										this.api().columns([4]).every( function () {
											var column = this;
											var select = $(\'<select multiple   id = "case_status" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()));
												

												
											column.data().unique().sort().each( function ( d, j ) {
												
												if(d != "" && d != "&nbsp;"){
													select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
												
											  $("#case_status").on("change", function(){
													var search = [];

												  $.each($("#case_status option:selected"), function(){
														search.push($(this).val());
												  });

												  search = search.join("|");
												  column.search(search, true, false).draw();
												});
										});
										this.api().columns([5]).every( function () {
											var column = this;
											var select = $(\'<select multiple   id = "case_type" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()));
												

												
											column.data().unique().sort().each( function ( d, j ) {
												
												if(d != "" && d != "&nbsp;"){
													select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
												
											  $("#case_type").on("change", function(){
													var search = [];

												  $.each($("#case_type option:selected"), function(){
														search.push($(this).val());
												  });

												  search = search.join("|");
												  column.search(search, true, false).draw();
												});
										});
										this.api().columns([6,7]).every( function () {
											var column = this;
											var select = $(\'<select name = "attorney" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()))
												.on( "change", function () {
													var val = $.fn.dataTable.util.escapeRegex(
														$(this).val()
													);
													column
														.search( val ? val : "", true, false )
														.draw();
												});
												
												column.data().unique().sort().each( function ( d, j ) {
												   if(d != "" && d != "&nbsp;"){
													   select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
										});
										
											
									}


								} );
								$("#case_status").select2();
								$("#case_type").select2();
								$("#case_status").hide();
								$("#case_type").hide();
						} );
						</script>';
						$html .= '<style>
									#tasks_report_filter{
									float:left;
									}
									.select2-container{ width: 150px !important; }
									{/literal}
								</style>';			
		/* } */
		
		echo $html;
	/* 	$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '6', '6', '6','6');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage('L');
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Tasks by Attorney Assigned Not Done.pdf", 'I'); */
	}
	function action_tasksDueDays(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		echo "  <script type='text/javascript' src='cache/include/javascript/sugar_grp1_jquery.js'></script>
				<script type='text/javascript' src='https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js'></script>
				<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script>
				<link href='custom/include/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>
				<link href='custom/include/select2/css/select2.css' rel='stylesheet' type='text/css'/>
				<script type='text/javascript' src='https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
				<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
				<script type='text/javascript' src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js'></script>
				<link href='https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'/>";
		$this->view = '';
		$date_time = $GLOBALS['timedate']->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		/* $header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
			
				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 430px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Tasks, Number of days they are over due, due, or soon to be due</b></span></td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td  style="width: 200px; height: 51px;border:none;"><span style="color:black;float:right;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
				
			
				
					  
			
		</table>'; */
		$html = '';
		$html .= '	<span style="color:black;font-size:18px;"><b>Tasks, Number of days they are over due, due, or soon to be due</b></span>
					<table style="color:black;font-size:18px;" id = "tasks_report"  border="1">
					<thead>
					<tr>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Due Date</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task Status</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Status </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Over Due </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Due </strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Soon To Due </strong></span></td>
					</tr>
					</thead><tbody>';
		$multiple_assigned_users_list= '';
		$user_initials = get_user_initials_custom();
		$sql = "SELECT tasks.id as 'task_id', tasks.name as 'task_name',tasks.date_due, tasks.status as 'task_status', tasks.description as 'task_description', tasks.multiple_assigned_users as 'task_multiple_assigned_to', cases.id as 'case_id', cases.name as 'case_name', cases.status
				as 'case_status' FROM tasks 
				LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = tasks.parent_id) 
				WHERE tasks.deleted = 0 AND tasks.parent_type = 'Cases' AND tasks.status != 'Done' AND tasks.status != 'Completed' ";
						
		$result = $GLOBALS['db']->query($sql);
		$data = array();
		$today = $GLOBALS['timedate']->nowDbDate();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$date_due = $row['date_due'];
			// No of days Over Due
			/* $dd = $GLOBALS['timedate']->to_db_date($date_due, false); */
			$over_due_days = '';
			$due_days = '';
			$dd = '';
			if(!empty($date_due)){
				$dd = date("Y-m-d", strtotime($date_due));				
			}
			/* echo $dd;die; */
			if(!empty($dd)){
				$over_due_days_diff = strtotime($today) - strtotime($dd);
				$over_due_days = round($over_due_days_diff / (60 * 60 * 24));
				$row['over_due_days'] = $over_due_days < 0 ? 0 : $over_due_days;
			}
			
			// No of days Due
			if(!empty($dd)){
				$due_days_diff = strtotime($dd) - strtotime($today) ;
				$due_days = round($due_days_diff / (60 * 60 * 24));
				$row['due_days'] = $due_days < 0 ? 0 : $due_days;
			}
			
			// Soon to Due
			if( in_array($due_days, array('0', '1' , '2', '3'))){
				$row['soon_due_days'] = 'Yes';
			}else{
				$row['soon_due_days'] = 'NO';
			}
			/* $data[] = $row; */
		
		/* print"<pre>";print_r($data);die; */
		
		
				/* $multiple_assigned_users_list = ''; */
			/* foreach($data as $no => $task){ */
				/* print"<pre>";print_r($task_data);die;  */
				/* $multiple_assigned_users = unencodeMultienum($task['task_multiple_assigned_to']);
				foreach($multiple_assigned_users as $id){
					$multiple_assigned_users_list .= $user_initials[$id].', ';
				} */
				$html .='<tr>
						<td>'. $GLOBALS['timedate']->to_display_date_time($row['date_due']) . '</td>
						<td>'. $row['task_name'] . '</td>
						<td>'. $row['task_status'] . '</td>
						<td>'. $row['case_name'] . '</td>
						<td>'. $GLOBALS['app_list_strings']['case_status_dom'][$row['case_status']] . '</td>
						<td>'. $row['over_due_days'] . '</td>
						<td>'. $row['due_days'] . '</td>
						<td>'. $row['soon_due_days'] . '</td>
						
					</tr>';
			}
			$html .='</tbody></table>'; 
						$html .='<script type="text/javascript">
						$(document).ready(function() {
							$("#tasks_report").DataTable( {
								 					
								columnDefs : [
										 {
										"searchable": false,
										"orderable": true,
										}
									],
									
									"searching": true,
									"paging":false,
									"info":false,
									initComplete: function () {
									   this.api().columns().every( function () {
											$(this.header()).css("padding-bottom", "bottom")
										});
										this.api().columns([4]).every( function () {
											var column = this;
											var select = $(\'<select multiple   id = "case_status" class="dt-search-select"><option value="">(No filter applied)</option></select>\')
												.prependTo( $(column.header()));
												

												
											column.data().unique().sort().each( function ( d, j ) {
												
												   if(d != "" && d != "&nbsp;"){
													select.append( "<option value=\'"+d+"\'>"+d+"</option>" )
													}
												});
												
												  $("#case_status").on("change", function(){
														var search = [];

													  $.each($("#case_status option:selected"), function(){
															search.push($(this).val());
													  });

													  search = search.join("|");
													  column.search(search, true, false).draw();
													});
										});
						
										
											
									}


								} );
								$("#case_status").select2();
								$("#case_status").hide();
						} );
						</script>';
						$html .= '<style>
									#tasks_report_filter{
									float:left;
									}
									.select2-container{ width: 150px !important; }
									{/literal}
								</style>';
			echo $html;
		/* $pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '6', '6', '6','6');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage('L');
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Tasks, Number of days they are over due, due, or soon to be due", 'I'); */
	}
	function action_tasksPerTeamNotDone(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		$this->view = '';
		$date_time = $GLOBALS['timedate']->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
					<tr border="0" style="height: 51px; color: white;border:none;">
						<td  style="width: 430px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Tasks Per Team that are Un Done</b></span></td>
						<td></td><td></td><td></td>
						<td  style="width: 250px; height: 51px;border:none;"><span style="color:black;float:right;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
					</tr>
		</table>';
		$multiple_assigned_users_list= '';
		$user_initials = get_user_initials_custom();
		$sql = "SELECT tasks.id as 'task_id', tasks.name as 'task_name',tasks.date_due, tasks.status as 'task_status', tasks.description as 'task_description', tasks.multiple_assigned_users as 'task_multiple_assigned_to', cases.id as 'case_id', cases.name as 'case_name', cases.status
				as 'case_status', tasks_cstm.securitygroup_id_c
				FROM tasks
				LEFT JOIN tasks_cstm ON(tasks.deleted = 0 AND tasks_cstm.id_c = tasks.id) 
				LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = tasks.parent_id) 
				WHERE tasks.deleted = 0 AND tasks.parent_type = 'Cases' AND tasks.status != 'Done' ";
		$result = $GLOBALS['db']->query($sql);
		$data = array();
		$all_users = User::getAllUsers();
		/* print"<pre>";print_r($all_users);die; */
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$multiple_assigned_users_list = '';
			$multiple_assigned_users = unencodeMultienum($row['task_multiple_assigned_to']);
			foreach($multiple_assigned_users as $id){
				$multiple_assigned_users_list .= $all_users[$id].', ';
			}
			/* echo $multiple_assigned_users_list;die; */
			$data[$row['securitygroup_id_c']][] = $row;
		}
		$sql = "SELECT * FROM securitygroups";
		$result = $GLOBALS['db']->query($sql);
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$securitygroups[$row['id']] = $row['name'];
		}
		/* print"<pre>";print_r($data);die; */
		$html = '';
		foreach($data as $securitygroups_id => $task_data){
			$html .= '<br><span style="font-size: 12px;"><strong>'. $securitygroups[$securitygroups_id] . '</strong></span><br><br>';
			$html .= '<table style="border-collapse:collapse; table-layout:fixed;width:100%word-wrap:break-word;" border="1">
					<thead>
					<tr>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Due Date</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task Status</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Status </strong></span></td>
					<td  style="width:25%;font-size: 11px;font-weight: bold; "><strong>Multiple Assigned To</strong></td>
					</tr>
					</thead><tbody>';
			foreach($task_data as $no => $task){
				$multiple_assigned_users_list = '';
				/* print"<pre>";print_r($task_data);die;  */
				$multiple_assigned_users = unencodeMultienum($task['task_multiple_assigned_to']);
				foreach($multiple_assigned_users as $id){
					$multiple_assigned_users_list .= $user_initials[$id].', ';
				}
				$html .='<tr>
							<td ><span style="font-size: 12px;">'. $GLOBALS['timedate']->to_display_date_time($task['date_due']) . '</span></td>
							<td ><span style="font-size: 12px;">'. $task['task_name'] . '</span></td>
							<td ><span style="font-size: 12px;">'. $task['task_status'] . '</span></td>
							<td ><span style="font-size: 12px;">'. $task['case_name'] . '</span></td>
							<td ><span style="font-size: 12px;">'. $GLOBALS['app_list_strings']['case_status_dom'][$task['case_status']] . '</span></td>
							<td><span style="font-size: 15px;">'. $multiple_assigned_users_list . '</span></td>
							
						</tr>';
			}
			$html .='</tbody></table>'; 
		}
		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '6', '6', '6','6');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage('L');
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Tasks Per Team that are Un Done.pdf", 'I');
	}
	function action_WhoDidTasks(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		$this->view = '';
		$date_time = $GLOBALS['timedate']->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
			
				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 430px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Last Week Tasks Done And Assigned Days</b></span></td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td  style="width: 200px; height: 51px;border:none;"><span style="color:black;float:right;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
				
			
				
					  
			
		</table>';
		$multiple_assigned_users_list= '';
		$user_initials = get_user_initials_custom();
		$all_users = User::getAllUsers();
		$sql = "SELECT DISTINCT tasks.id, tasks.name as task_name, tasks.status as task_status, tasks.multiple_assigned_users as task_multiple_assigned_to, tasks.date_due, tasks.date_entered, tasks.date_modified
				FROM `tasks` 
				LEFT JOIN tasks_audit ON (tasks_audit.field_name = 'status' AND tasks.deleted = 0 AND tasks.id = tasks_audit.parent_id)
				WHERE  (tasks.status = 'Done' AND tasks.date_entered = tasks.date_modified AND DATE(tasks.date_modified) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()) || (tasks_audit.after_value_string = 'Done' AND DATE(tasks_audit.date_created) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE())
				 ";						
		$result = $GLOBALS['db']->query($sql);
		$data = array();
		$today = $GLOBALS['timedate']->nowDbDate();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$date_due = $row['date_due'];
			
			// No of days Due
			$due_days_diff = strtotime($row['date_modified']) - strtotime($date_due);
			$due_days = round($due_days_diff / (60 * 60 * 24));
			$row['diff_days'] = $due_days < 0 ? 0 : $due_days;

			$data[] = $row;
		}
		/* print"<pre>";print_r($data);die; */
		$html = '';
		$html .= '<table style="border-collapse:collapse; table-layout:fixed;width:100%word-wrap:break-word;" border="1">
					<thead>
					<tr>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Due Date</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task name</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task Status</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task Status Modifed</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Assigned TO</strong></span></td>
					<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Task Assigned Days </strong></span></td>
					</tr>
					</thead><tbody>';
		
			foreach($data as $no => $task){
				$multiple_assigned_users_list = '';
				/* print"<pre>";print_r($task_data);die;  */
				$multiple_assigned_users = unencodeMultienum($task['task_multiple_assigned_to']);
				foreach($multiple_assigned_users as $id){
					$multiple_assigned_users_list .= $all_users[$id].', ';
				}
				$html .='<tr>
						<td ><span style="font-size: 12px;">'. $GLOBALS['timedate']->to_display_date_time($task['date_due']) . '</span></td>
						<td ><span style="font-size: 12px;">'. $task['task_name'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $task['task_status'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $GLOBALS['timedate']->to_display_date_time($task['date_modified']) . '</span></td>
						<td ><span style="font-size: 12px;">'. $multiple_assigned_users_list . '</span></td>
						<td ><span style="font-size: 12px;">'. $task['diff_days'] . '</span></td>
						
					</tr>';
			}
			$html .='</tbody></table>'; 
		

		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '6', '6', '6','6');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage('L');
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Last Week Tasks Done And Assigned Days.pdf", 'I');
	}
}