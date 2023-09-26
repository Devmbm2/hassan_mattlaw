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

require_once('include/SugarObjects/templates/file/File.php');

class MTS_Medical_Treatment_Summary extends File
{
    public $new_schema = true;
    public $module_dir = 'MTS_Medical_Treatment_Summary';
    public $object_name = 'MTS_Medical_Treatment_Summary';
    public $table_name = 'mts_medical_treatment_summary';
    public $importable = true; 

    public $id;
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
    public $document_name;
    public $filename;
    public $file_ext;
    public $file_mime_type;
    public $uploadfile;
    public $active_date;
    public $exp_date;
    public $category_id;
    public $subcategory_id;
    public $status_id;
    public $status;
    public $treatment_date;
    public $account_id_c;
    public $medical_provider_organization;
    public $contact_id_c;
    public $medical_provider_person;
    public $treatment_description_summary;
    public $treatment_work_product_note;
    public $cpt_codes_treatment;
    public $icd_codes;
    public $symptom_1;
    public $pain_scale;
    public $symptom_other;
    public $symptom_2;
    public $symptom_3;
    public $symptom_4;
    public $symptom_5;
    public $symptom_6;
    public $symptom_7;
    public $symptom_8;
    public $symptom_9;
    public $symptom_10;
    public $pain_scale_2;
    public $pain_scale_3;
    public $pain_scale_4;
    public $pain_scale_5;
    public $pain_scale_6;
    public $pain_scale_7;
    public $pain_scale_8;
    public $pain_scale_9;
    public $pain_sclae_10;
    public $pain_scale_other;
    public $missing_record_we_need_to_get;
	
    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }
	
}
