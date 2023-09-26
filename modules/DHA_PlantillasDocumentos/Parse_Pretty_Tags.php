<?php
class clsParsePrettyTags {
	
	public $Source = '';
	public $_ChrOpen = '!{';
	public $_ChrClose = '}';
	public $tag_mapping = array();
	
	function __construct($Source){
		$this->Source = $Source;   
	}
	
	function findPrettyTags(){
		global $db;
		$reg_exp = "/\!{([^}]+)\}/";
		$header_str = ''; 
		if (preg_match_all($reg_exp, $this->Source, $coincidencias)) {
			$fields = array_unique($coincidencias[1]);
			$sql = "SELECT name, header, template_code, tag_type FROM ht_pretty_tags WHERE name IN ('".implode("','", $fields)."')";
			$rs = $db->query($sql);
			while($row = $db->fetchByAssoc($rs)){
				$this->tag_mapping[$row['name']] = $row;
			}
			preg_match_all($reg_exp, $this->Source, $fields_list, PREG_OFFSET_CAPTURE);
			$sub_count = 1;
			$NewEnd = 0; // Useful when mtype='m+m'
			$table_start = 0;
			foreach($fields_list[1]  AS $fields){
				$field_name = $fields[0];
				$start_pos = $NewEnd + $fields[1] - 2;
				$end_pos = strlen($fields[0]) + 3;
				$field_val  = '';
				if($field_name == 'table_start'){
					$table_start = 1;
				} elseif ($field_name == 'table_end') {
					$table_start = 0;
				}
				if(isset($this->tag_mapping[$field_name])){
					$fld_pro = $this->tag_mapping[$field_name];
					
					if($fld_pro['tag_type'] == 'subpanel_field'){
						if($table_start == 1){
							$field_val = "[a_sub".$sub_count.";block=w:tr]";
							$header_str .= "sub".$sub_count."=".$fld_pro['header'].";";
							$table_start++;
						}elseif($table_start < 1){
							$field_val = "[a_sub".$sub_count.";block=w:p]";
							$header_str .= "sub".$sub_count."=".$fld_pro['header'].";";
						}
						$field_val .= "[a_sub".$sub_count.".".$fld_pro['template_code']."]";
						if($table_start <= 1){
							$sub_count++;
						}
					}else if($fld_pro['tag_type'] == 'module_field'){
						$field_val = "[a.".$fld_pro['template_code']."]";
					}else if($fld_pro['tag_type'] == 'related_field'){
						$field_val = "[a.".$fld_pro['header']."@@".$fld_pro['template_code']."]";
					}else if($fld_pro['tag_type'] == '3rd_level_relation'){
						$relationships  = explode(":",$fld_pro['header']);
						$field_val = "[a.".$relationships[0]."@@".$relationships[1]."@@".$fld_pro['template_code']."]";
					}
				}				
				$NewEnd += strlen($field_val) - $end_pos;
				$this->Source = substr_replace($this->Source,$field_val,$start_pos,$end_pos);
			}
			
			$body_tag = isset($_REQUEST['template_html']) ? '' : '<w:body>';
			
			$header_str = "[a;block=w:body;{$header_str}]";
			$header_pos = strpos($this->Source, $body_tag) + strlen($body_tag);
			$this->Source = substr_replace($this->Source, $header_str, $header_pos, 0);
			if($_REQUEST['template_html']){
				$this->Source = '<w:body><w:p>'.$this->Source.'</w:p></w:body>';
				
			}
			
			return $fields;
		}
	}
	
	function mergeTagsVar(){
		$Pref = &$this->VarPrefix;
		$PrefL = strlen($Pref);
		$PrefOk = ($PrefL>0);

		if ($ConvStr===false) {
			$Charset = $this->Charset;
			$this->Charset = false;
		}

		// Then we scann all fields in the model
		$x = '';
		$Pos = 0;
		while ($Loc = $this->meth_Locator_FindTbs($Txt,$Id,$Pos,'.')) {
			if ($Loc->SubNbr==0) $Loc->SubLst[0]=''; // In order to force error message
			if ($Loc->SubLst[0]==='') {
				$Pos = $this->meth_Merge_AutoSpe($Txt,$Loc);
			} elseif ($Loc->SubLst[0][0]==='~') {
				if (!isset($ObjOk)) $ObjOk = (is_object($this->ObjectRef) || is_array($this->ObjectRef));
				if ($ObjOk) {
					$Loc->SubLst[0] = substr($Loc->SubLst[0],1);
					$Pos = $this->meth_Locator_Replace($Txt,$Loc,$this->ObjectRef,0);
				} elseif (isset($Loc->PrmLst['noerr'])) {
					$Pos = $this->meth_Locator_Replace($Txt,$Loc,$x,false);
				} else {
					$this->meth_Misc_Alert($Loc,'property ObjectRef is neither an object nor an array. Its type is \''.gettype($this->ObjectRef).'\'.',true);
					$Pos = $Loc->PosEnd + 1;
				}
			} elseif ($PrefOk && (substr($Loc->SubLst[0],0,$PrefL)!==$Pref)) {
				if (isset($Loc->PrmLst['noerr'])) {
					$Pos = $this->meth_Locator_Replace($Txt,$Loc,$x,false);
				} else {
					$this->meth_Misc_Alert($Loc,'does not match the allowed prefix.',true);
					$Pos = $Loc->PosEnd + 1;
				}
			} elseif (isset($this->VarRef[$Loc->SubLst[0]])) {
				$Pos = $this->meth_Locator_Replace($Txt,$Loc,$this->VarRef[$Loc->SubLst[0]],1);
			} else {
				if (isset($Loc->PrmLst['noerr'])) {
					$Pos = $this->meth_Locator_Replace($Txt,$Loc,$x,false);
				} else {
					$Pos = $Loc->PosEnd + 1;
					$msg = (isset($this->VarRef['GLOBALS'])) ? 'VarRef seems refers to $GLOBALS' : 'VarRef seems refers to a custom array of values';
					$this->meth_Misc_Alert($Loc,'the key \''.$Loc->SubLst[0].'\' does not exist or is not set in VarRef. ('.$msg.')',true);
				}
			}
		}

		if ($ConvStr===false) $this->Charset = $Charset;

		return false; // Useful for properties PrmIfVar & PrmThenVar
	}
	function getPrettyTag(){
		$reg_exp = "/\[a;block={$this->BloqueFormatoFichero($this->template_file_ext, 'body')};([^]]*)\]/i";
		// Find a TBS Locator

		$PosEnd = false;
		$PosMax = strlen($Txt) -1;
		$Start = $this->_ChrOpen.$Name;

		do {
			// Search for the opening char
			if ($Pos>$PosMax) return false;
			$Pos = strpos($Txt,$Start,$Pos);

			// If found => next chars are analyzed
			if ($Pos===false) {
				return false;
			} else {
				$Loc = new clsTbsLocator;
				$ReadPrm = false;
				$PosX = $Pos + strlen($Start);
				$x = $Txt[$PosX];

				if ($x===$this->_ChrClose) {
					$PosEnd = $PosX;
				} elseif ($x===$ChrSub) {
					$Loc->SubOk = true; // it is no longer the false value
					$ReadPrm = true;
					$PosX++;
				} elseif (strpos(';',$x)!==false) {
					$ReadPrm = true;
					$PosX++;
				} else {
					$Pos++;
				}

				$Loc->PosBeg = $Pos;
				if ($ReadPrm) {
					self::f_Loc_PrmRead($Txt,$PosX,false,'\'',$this->_ChrOpen,$this->_ChrClose,$Loc,$PosEnd);
					if ($PosEnd===false) {
						$this->meth_Misc_Alert('','can\'t found the end of the tag \''.substr($Txt,$Pos,$PosX-$Pos+10).'...\'.');
						$Pos++;
					}
				}

			}

		} while ($PosEnd===false);

		$Loc->PosEnd = $PosEnd;
		if ($Loc->SubOk) {
			$Loc->FullName = $Name.'.'.$Loc->SubName;
			$Loc->SubLst = explode('.',$Loc->SubName);
			$Loc->SubNbr = count($Loc->SubLst);
		} else {
			$Loc->FullName = $Name;
		}
		if ( $ReadPrm && ( isset($Loc->PrmLst['enlarge']) || isset($Loc->PrmLst['comm']) ) ) {
			$Loc->PosBeg0 = $Loc->PosBeg;
			$Loc->PosEnd0 = $Loc->PosEnd;
			$enlarge = (isset($Loc->PrmLst['enlarge'])) ? $Loc->PrmLst['enlarge'] : $Loc->PrmLst['comm'];
			if (($enlarge===true) || ($enlarge==='')) {
				$Loc->Enlarged = self::f_Loc_EnlargeToStr($Txt,$Loc,'<!--' ,'-->');
			} else {
				$Loc->Enlarged = self::f_Loc_EnlargeToTag($Txt,$Loc,$enlarge,false);
			}
		}

		return $Loc;
	}
	
	function parsePrettyTags(){
		$tagsList = $this->findPrettyTags();
		return $this->Source;
	}
}