<?php

require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');
require_once('include/TemplateHandler/TemplateHandler.php');

		
class SugarFieldFileUpload extends SugarFieldBase {
	function SugarFieldFileUpload($type) {
    	$this->type = $type;
        $this->ss = new Sugar_Smarty();
    }
   function fetch($path){
    	$additional = '';
    	if(!$this->hasButton && !empty($this->button)){
    		$additional .= '<input type="button" class="button" ' . $this->button . '>';
    	}
        if(!empty($this->buttons)){
            foreach($this->buttons as $v){
                $additional .= ' <input type="button" class="button" ' . $v . '>';
            }

        }
        if(!empty($this->image)){
            $additional .= ' <img ' . $this->image . '>';
        }
    	return $this->ss->fetch($path) . $additional;
    }	
	// function getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
        // return parent::getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
    // }
     function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
       return $this->getSmartyView($parentFieldArray, $vardef, $displayParams, $tabindex, 'EditView');
    }
  function findTemplate($view){
        static $tplCache = array();

        if ( isset($tplCache[$this->type][$view]) ) {
            return $tplCache[$this->type][$view];
        }

        $lastClass = get_class($this);
        $classList = array($this->type,str_replace('SugarField','',$lastClass));
        while ( $lastClass = get_parent_class($lastClass) ) {
            $classList[] = str_replace('SugarField','',$lastClass);
        }

        $tplName = '';
        foreach ( $classList as $className ) {
            global $current_language;
            if(isset($current_language)) {
                $tplName = 'include/SugarFields/Fields/'. $className .'/'. $current_language . '.' . $view .'.tpl';
                if ( file_exists('custom/'.$tplName) ) {
                    $tplName = 'custom/'.$tplName;
                    break;
                }
                if ( file_exists($tplName) ) {
                    break;
                }
            }
            $tplName = 'include/SugarFields/Fields/'. $className .'/'. $view .'.tpl';
            if ( file_exists('custom/'.$tplName) ) {
                $tplName = 'custom/'.$tplName;
                break;
            }
            if ( file_exists($tplName) ) {
                break;
            }
        }

        $tplCache[$this->type][$view] = $tplName;

        return $tplName;
    }	
    function getSmartyView($parentFieldArray, $vardef, $displayParams, $tabindex = -1, $view){
    	$this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
    	return $this->fetch($this->findTemplate($view));
    }
    
}

