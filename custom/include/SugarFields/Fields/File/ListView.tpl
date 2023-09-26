{*
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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
 ********************************************************************************/

*}
<script>
{literal}
function check(obj,name){
   var replace_spaces = name.replace(/\s+/g, '-');
   $(obj).attr("download",replace_spaces);
}
{/literal}
</script>

{if  $displayParams.is_valid_file}
<a href="index.php?entryPoint=download&id={$parentFieldArray.ID}&type={if empty($vardef.displayParams.module)}{$displayParams.displayParams.module}{else}{$vardef.displayParams.module}{/if}" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;color: #e56455;font-weight: bold;">
View File
</a>
<a href="index.php?entryPoint=download&id={$parentFieldArray.ID}&type=Documents&download=1" class="tabDetailViewDFLink" id="{$parentFieldArray.DOCUMENT_REVISION_ID}" name = "{$parentFieldArray.DOCUMENT_NAME}" style="border-bottom: 0px;color: #e56455;font-weight: bold; display:block;" download={$parentFieldArray.DOCUMENT_NAME} onclick = check(this,this.name)>
<img src="https://img.icons8.com/metro/50/000000/download.png" width ="22" height = "22" style="display:block;margin:auto;"/>
</a>
{/if}
