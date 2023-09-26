<?php
require_once('modules/AOW_WorkFlow/AOW_WorkFlow.php');
class ht_AOW_WorkFlow extends AOW_WorkFlow {
	function get_flow_beans(){
        global $beanList;

        if($beanList[$this->flow_module]){
            $module = new $beanList[$this->flow_module]();

            $query = '';
            $query_array = array();

            $query_array['select'][] = $module->table_name.".id AS id";
            $query_array = $this->build_flow_query_where($query_array);

            if(!empty($query_array)){
                foreach ($query_array['select'] as $select){
                    $query .=  ($query == '' ? 'SELECT ' : ', ').$select;
                }

                $query .= ' FROM '.$module->table_name.' ';

                if(isset($query_array['join'])){
                    foreach ($query_array['join'] as $join){
                        $query .= $join;
                    }
                }
				if(isset($query_array['where'])){
                    $query_where = ' WHERE ';
                    foreach ($query_array['where'] as $where){
                        $query_where .= ' '.$where;
                    }
                    $query .= ' '.$query_where;
                }
				/* if(isset($query_array['where'])){
                    $query_where = '';
                    foreach ($query_array['where'] as $where){
                        $query_where .=  ($query_where == '' ? 'WHERE ' : '  ').$where;
                    }
					// $query_where = $this->queryWhereRepair($query_where);
                    $query .= ' '.$query_where;
                } */
				/* if (isset($query_array['where'])) {
					$query_where = '';
					$query_array['where'] = array_reverse($query_array['where']);
					foreach ($query_array['where'] as $where) {
						$query_where .= ($query_where == '' ? 'WHERE ' : ' AND ') . $where;
					}

					$query .= ' ' . $query_where;
				} */
                // pre($query);
				return $module->process_full_list_query($query);
            }


        }
        return null;
    }

	function build_flow_query_where($query = array()){
        global $beanList;

        if($beanList[$this->flow_module]){
            $module = new $beanList[$this->flow_module]();

            $sql = "SELECT id FROM aow_conditions WHERE aow_workflow_id = '".$this->id."' AND deleted = 0 ORDER BY condition_order ASC";
            $result = $this->db->query($sql);

            while ($row = $this->db->fetchByAssoc($result)) {
                $condition = new AOW_Condition();
                $condition->retrieve($row['id']);
                $query = $this->build_query_where($condition,$module,$query);
                if(empty($query)){
                    return $query;
                }
            }
			// print"<pre>";print_r($query);die;
            if($this->flow_run_on){
                switch($this->flow_run_on){

                    case'New_Records':
                        $query['where'][] = ' AND '.$module->table_name . '.' . 'date_entered' . ' > ' . "'" .$this->date_entered."'";
                        Break;

                    case'Modified_Records':
                        $query['where'][] = ' AND '.$module->table_name . '.' . 'date_modified' . ' > ' . "'" .$this->date_entered."'" . ' AND ' . $module->table_name . '.' . 'date_entered' . ' <> ' . $module->table_name . '.' . 'date_modified';
                        Break;

                }
            }

            if(!$this->multiple_runs){
                $query['where'][] .= " AND NOT EXISTS (SELECT * FROM aow_processed WHERE aow_processed.aow_workflow_id='".$this->id."' AND aow_processed.parent_id=".$module->table_name.".id AND aow_processed.status = 'Complete' AND aow_processed.deleted = 0)";
            }

			$query['where'][] = ' AND '.$module->table_name .".deleted = 0 ";

        }

        return $query;
    }
}
