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

$dictionary['ht_doc_temp_multi_letterhead'] = array(
    'table' => 'ht_doc_temp_multi_letterhead',
    'audited' => true,
    'inline_edit' => true,
    'fields' => array (
	'document_name' => array (
         'name' => 'document_name',
         'vname' => 'LBL_NAME',
         'type' => 'name',
         'link' => true,
         'dbType' => 'varchar',
         'len' => '255',
         'required' => true,
         'unified_search' => true,
         'full_text_search' => array('enabled' => true, 'searchable' => true, 'boost' => 1.10),
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'required',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'size' => '20',
      ),
      'name' => array(
         'name' => 'name',
         'vname' => 'LBL_NAME',
         'source' => 'non-db',
         'type' => 'varchar',
         'fields' => array('document_name'),
         'sort_on' => 'name',
      ),      
      'filename' => array (
         'name' => 'filename',
         'vname' => 'LBL_FILENAME',
         'type' => 'varchar',
         'required' => true,
         'importable' => 'required',
         'len' => '255',
         'studio' => 'false',
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'size' => '20',
      ),
      'file_ext' => array (
         'name' => 'file_ext',
         'vname' => 'LBL_FILE_EXTENSION',
         'type' => 'varchar',
         'len' => '100',
         'required' => false,
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'size' => '20',
      ),
      'file_mime_type' => array (
         'name' => 'file_mime_type',
         'vname' => 'LBL_MIME',
         'type' => 'varchar',
         'len' => '100',
         'required' => false,
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'size' => '20',
      ),
      'uploadfile' => array (
         'name' => 'uploadfile',
         'vname' => 'LBL_FILE_UPLOAD',
         'type' => 'file',
         //'noChange' => true,      // si quitamos esta propiedad nos da la opcion de quitar el fichero (aparece un boton de "Quitar")
         'required' => false, //true,
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'len' => '255',
         'size' => '20',
         'allowEapm' => true,  // De momento si no se pone en el editview no indica el tamaño maximo del archivo
		'docType' => 'doc_type',
		'docUrl' => 'doc_url',
		'docId' => 'doc_id',   
      ),
      // 'file_url' => array(
         // 'name' => 'file_url',
         // 'source' => 'non-db',
         // 'vname' => 'URL',
         // 'type' => 'varchar',
         // 'len' => '2000',
         // 'comment' => '',
         // 'importable' => false,
         // 'massupdate' => false,
         // 'studio' => 'false',
      // ), 
      'active_date' => array (
         'name' => 'active_date',
         'vname' => 'LBL_DOC_ACTIVE_DATE',
         'type' => 'date',
         'required' => false,
         'importable' => 'required',
         'display_default' => 'now',
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'size' => '20',
         'enable_range_search' => false,
      ),
      'exp_date' => array (
         'name' => 'exp_date',
         'vname' => 'LBL_DOC_EXP_DATE',
         'type' => 'date',
         'required' => false,
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'size' => '20',
         'enable_range_search' => false,
      ),
      'category_id' => array (
         'name' => 'category_id',
         'vname' => 'LBL_SF_CATEGORY',
         'type' => 'enum',
         'len' => 100,
         'options' => 'dha_plantillasdocumentos_category_dom',
         'reportable' => true,
         'required' => false,
         'massupdate' => 1,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'size' => '20',
         'studio' => 'visible',
         'dependency' => false,
      ),
      'subcategory_id' => array (
         'name' => 'subcategory_id',
         'vname' => 'LBL_SF_SUBCATEGORY',
         'type' => 'enum',
         'len' => 100,
         'options' => 'dha_plantillasdocumentos_subcategory_dom',
         'reportable' => true,
         'required' => false,
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'size' => '20',
         'studio' => 'visible',
         'dependency' => false,
      ),
      'status_id' => array (
         'name' => 'status_id',
         'vname' => 'LBL_DOC_STATUS',
         'type' => 'enum',
         'len' => 100,
         'options' => 'dha_plantillasdocumentos_status_dom',
         'reportable' => true,
         'required' => false,
         'massupdate' => 1,
         'default' => '',
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'size' => '20',
         'studio' => 'visible',
         'dependency' => false,
      ),
      'status' => array (
         'name' => 'status',
         'vname' => 'LBL_DOC_STATUS',
         'type' => 'varchar',
         'Comment' => '',
         'required' => false,
         'massupdate' => 0,
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => false,
         'reportable' => true,
         'len' => '255',
         'size' => '20',
      ),
      'modulo' => array (
         'name' => 'modulo',
         'vname' => 'LBL_MODULO',
         'type' => 'enum',
         'len' => 100,
         'options' => 'dha_plantillasdocumentos_module_dom',  // esta lista se rellena dinamicamente !!!
         'reportable' => true,
         'required' => true,
         'massupdate' => 0,
         'default' => '',
         'comments' => '',
         'help' => '',
         'importable' => 'required',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => true,
         'size' => '20',
         'studio' => 'visible',
         'dependency' => false,
         'bold' => true,
      ),  
      'idioma' => array (
         'name' => 'idioma',
         'vname' => 'LBL_IDIOMA_PLANTILLA',
         'type' => 'enum',
         'len' => 50,
         'options' => 'dha_plantillasdocumentos_idiomas_dom',
         'reportable' => true,
         'required' => true,
         'massupdate' => 0,
         'default' => $sugar_config['DHA_templates_default_lang'], //'es',
         'comments' => '',
         'help' => '',
         'importable' => 'required',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => true,
         'size' => '20',
         'studio' => 'visible',
         'dependency' => false,
      ),
      'aclroles' => array (
         'required' => false,
         'name' => 'aclroles',
         'vname' => 'LBL_ROLES_WITH_ACCESS',
         'type' => 'multienum',
         'massupdate' => 0,
         'default' => '^^',    
         'comments' => '',
         'help' => '',
         'importable' => 'true',
         'duplicate_merge' => 'disabled',
         'duplicate_merge_dom_value' => '0',
         'audited' => true,
         'reportable' => true,
         'size' => '20',
         'options' => 'dha_plantillasdocumentos_roles_dom',  // esta lista se rellena dinamicamente !!!
         'studio' => 'visible',
         'isMultiSelect' => true,
      ), 

	'doc_type' => 
			array (
			  'name' => 'doc_type',
			  'vname' => 'LBL_DOC_TYPE',
			  'type' => 'enum',
			  'function' => 'getTemplatesExternalApiDropDown',
			  'len' => '100',
			  'comment' => 'Document type (ex: Google, box.net, IBM SmartCloud)',
			  'popupHelp' => 'LBL_DOC_TYPE_POPUP',
			  'massupdate' => false,
			  'options' => 'eapm_list',
			  'default' => 'Sugar',
			  'studio' => 
			  array (
				'wirelesseditview' => false,
				'wirelessdetailview' => false,
				'wirelesslistview' => false,
				'wireless_basic_search' => false,
			  ),
    ),
    'doc_url' => 
		array (
		  'name' => 'doc_url',
		  'vname' => 'LBL_DOC_URL',
		  'type' => 'varchar',
		  'len' => '255',
		  'comment' => 'Document URL from documents web server provider',
		  'importable' => false,
		  'massupdate' => false,
		  'studio' => 'false',
		),
),
    'relationships' => array (
),
    'optimistic_locking' => true,
    'unified_search' => true,
);
if (!class_exists('VardefManager')) {
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_doc_temp_multi_letterhead', 'ht_doc_temp_multi_letterhead', array('basic','assignable','security_groups','file'));