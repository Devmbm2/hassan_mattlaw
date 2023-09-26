<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2017 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */


class MEDP_Medical_Providers extends Basic
{
    public $new_schema = true;
    public $module_dir = 'MEDP_Medical_Providers';
    public $object_name = 'MEDP_Medical_Providers';
    public $table_name = 'medp_medical_providers';
    public $importable = true;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $account_id_c;
    public $medical_facility;
    public $contact_id_c;
    public $medical_doctor;
    public $lop_lien;
    public $type;
	
    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }
	function create_new_list_query($order_by, $where, $filter = array(), $params = array(), $show_deleted = 0, $join_type = '', $return_array = false, $parentbean = null, $singleSelect = false, $ifListForExport = false)
    {
        /* $_REQUEST['parent_id'] = '4391e830-e6dd-46d1-3c9c-5a68ad3343a5'; */
        if (isset($_REQUEST['parent_id']) && empty($_REQUEST['parent_id'])) {
            return  false;
        }
        
        $Ids = $this->updateRelatedAssignedAttorney();
        if (empty($Ids) && isset($_REQUEST['parent_id'])) {
            return false;
        } else if (!empty($Ids) && isset($_REQUEST['parent_id'])) {
            $where .= " medp_medical_providers.id IN $Ids ";
        }
         // echo $where;die; 
        $ret_array =  parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect, $ifListForExport);
        return $ret_array;
        
    }
    
    function updateRelatedAssignedAttorney($parent_id = '')
    {
        $id = '';
        if(empty($parent_id)){
            $id = $_REQUEST['parent_id'];
        }else{
            $id = $parent_id;
        }
        if (empty($id)) {
            return;
        }
        
        $userBean = BeanFactory::getBean('Contacts', $id);
        $RelatedIds = array();
        if ($userBean->load_relationship('contacts_medp_medical_providers_1')) {
            $relatedBeans = $userBean->contacts_medp_medical_providers_1->getBeans();
            foreach ($relatedBeans as $user) {
                $RelatedIds[] = $user->id;
            }
        }
        
        if (empty($RelatedIds)) {
            return '';
        }
        
        $IdsStr = implode("' , '", $RelatedIds);
        return "('" . $IdsStr . "')";
    }
}
