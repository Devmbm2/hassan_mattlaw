<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class DHA_PlantillasDocumentosViewGenerate_doc_wizard extends SugarView {


   ///////////////////////////////////////////////////////////////////////////
   public function preDisplay(){
      if(!is_admin($GLOBALS['current_user']))
         sugar_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']); 
   }
    
   ///////////////////////////////////////////////////////////////////////////
   protected function _getModuleTitleParams($browserTitle = false) {
      global $mod_strings, $app_list_strings;
       
      return array(
         "<a href='index.php?module=DHA_PlantillasDocumentos&action=index'>".$app_list_strings['moduleList']['DHA_PlantillasDocumentos']."</a>",
         'Generate Template'
      );
   } 
    
   ///////////////////////////////////////////////////////////////////////////
   public function display() {
      require_once('modules/DHA_PlantillasDocumentos/UI_Hooks.php');
      require_once('modules/DHA_PlantillasDocumentos/MassGenerateDocument.php');
      global $mod_strings;
      global $app_list_strings;
      global $app_strings;
      global $current_user;
      global $theme;
      global $currentModule;
      global $config;
      global $db;
      global $sugar_version;
      
      $configurator = new Configurator();
       

      $this->ss->assign('config', $configurator->config);
      $this->ss->assign('MOD', $GLOBALS['mod_strings']);
      $this->ss->assign('APP', $GLOBALS['app_strings']);
      $this->ss->assign('theme', $GLOBALS['theme']);
      $this->ss->assign('ATTORNEYS_LIST_VALUE', $configurator->config['DHA_templates_attorneys_list']);
     
      

  
      
      $dha_plantillasdocumentos_idiomas_dom = $app_list_strings['dha_plantillasdocumentos_idiomas_dom'];
      natcasesort($dha_plantillasdocumentos_idiomas_dom);
      if (!empty($configurator->config['DHA_templates_default_lang'])) {
          $this->ss->assign('DHA_templates_default_lang', get_select_options_with_id($dha_plantillasdocumentos_idiomas_dom, $configurator->config['DHA_templates_default_lang']));
      } else {
          $this->ss->assign('DHA_templates_default_lang', get_select_options_with_id($dha_plantillasdocumentos_idiomas_dom, ''));
      }      
       
      // A partir de la version 6.5.0 la función original getClassicModuleTitle no funciona bien, tiene un bug por el que solo saca a partir del segundo parámetro, 
      // por eso he dejado de momento LBL_MODULE_CONFIG_DESC en lugar de LBL_CONFIG ... cuando lo arreglen hay que cambiarlo
	  $emailTemplateList = get_bean_select_array(true, 'ht_doc_template_editor', 'name', '', 'name');
		$this->ss->assign('templates_list',$emailTemplateList);
      echo getClassicModuleTitle(
            "DHA_PlantillasDocumentos", 
            array(
               "<a href='index.php?module=DHA_PlantillasDocumentos&action=index'>{$app_list_strings['moduleList']['DHA_PlantillasDocumentos']}</a>",
               'Generate Template', //$mod_strings['LBL_CONFIG'],
            ), 
            false
      );
        
      echo $this->ss->fetch('modules/DHA_PlantillasDocumentos/tpls/generate_doc_wizard.tpl');
   }
   
}
