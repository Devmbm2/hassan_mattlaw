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


require_once('modules/AOW_Actions/actions/actionCreateRecord.php');
class actionCreateUpdateRecord extends actionCreateRecord {
	
    function run_action(SugarBean $bean, $params = array(), $in_save=false){
        global $beanList;

        if(isset($params['record_type']) && $params['record_type'] != ''){
            if($beanList[$params['record_type']]){
                $record = new $beanList[$params['record_type']]();
				$record_already_exist  = $this->check_record($record, $bean, $params);
				$record->update_modified_by = false;
				$this->set_record($record, $bean, $params);
				$this->set_relationships($record, $bean, $params);
                if(isset($params['relate_to_workflow']) && $params['relate_to_workflow']){
                    require_once('modules/Relationships/Relationship.php');
                    $key = Relationship::retrieve_by_modules($bean->module_dir, $record->module_dir, $GLOBALS['db']);
                    if (!empty($key)) {
                        foreach($bean->field_defs as $field=>$def){
                            if($def['type'] == 'link' && !empty($def['relationship']) && $def['relationship'] == $key){
                                $bean->load_relationship($field);
                                $bean->$field->add($record->id);
                                break;
                            }
                        }
                    }
                }
				if(!$record_already_exist){
					$sql = "INSERT INTO `aow_action_records` (`id`, `parent_bean_id`, `aow_action_id`, `action_record_id`, `action_record_module`, `date_modified`) VALUES (UUID(), '{$bean->id}', '{$this->id}', '{$record->id}','{$record->module_dir}', NOW())";
					$bean->db->query($sql);
				}
                return true;
            }
        }
        return false;
    }
	
	function check_record(&$record, &$bean, &$params){
		$join_mapping = array(
			'Tasks' => 'INNER JOIN tasks ON (aowar.action_record_id = tasks.id AND tasks.deleted = 0)',
			'FP_events' => 'INNER JOIN fp_events ON (aowar.action_record_id = fp_events.id AND fp_events.deleted = 0)',
		);
		$join = isset($join_mapping[$record->module_dir]) ? $join_mapping[$record->module_dir] : '';
		$sql = "SELECT
			aowar.action_record_id AS id
		FROM
			aow_action_records aowar
			{$join}
		WHERE
			aowar.deleted = 0 AND aowar.parent_bean_id = '{$bean->id}' AND aowar.aow_action_id = '{$this->id}' ";
			// die($sql);
		$result = $bean->db->query($sql);

        while ($row = $bean->db->fetchByAssoc($result)) {
			$record->retrieve($row['id']);
			if(isset($record->id)){
				$params['record_already_exist'] = true;
				return true;
			}
		}
		return false;
	}
}
