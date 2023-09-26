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


var condln = 0;
var condln_count = 0;
var report_fields =  new Array();
var flow_module = '';

var LogicalOperatorHandler = {
    //logicSelectCounter: 0.

    getLogicalOperatorSelectHTML: function(value, _condln, forcedValue) {


		if(action_sugar_grp1 == 'EditView'){
			// default set to 'AND'!!
			if(typeof forcedValue == 'undefined' || forcedValue === true) forcedValue = 'AND';
			if(!forcedValue) forcedValue = null;

			if(_condln===0)_condln = '0';

			if (typeof value === 'undefined' || !value) {
				value = forcedValue ? forcedValue : null;
			}
			var selecteds = {};
			selecteds.none = value == null ? ' selected="selected"' : '';
			selecteds.AND = value == 'AND' ? ' selected="selected"' : '';
			selecteds.OR = value == 'OR' ? ' selected="selected"' : '';
        selectHTML =
            '<select class="logic-select" name="aow_conditions_logic_op[' + (_condln ? _condln : condln) + ']" onchange="LogicalOperatorHandler.onLogicSelectChange(this, ' + (_condln ? _condln : condln) + ');" style="display:none;">' +

            (!value && !forcedValue ? ('   <option value=""' + selecteds.none + '></option>') : '')  +
            '   <option value="AND"' + selecteds.AND + '>AND</option>' +
            '   <option value="OR"' + selecteds.OR + '>OR</option>' +
            '</select>';
		}else{
			if (typeof value === 'undefined' || value == null || _condln === 0) {
				value = '';
			}
			selectHTML = '<span>'+value+'</span>';
		}
        //logicSelectCounter++;

        return selectHTML;
    },

    hideUnnecessaryLogicSelects: function() {
        var isPrevParenthesisOpen = true;
        $('#aow_conditions_body tr').each(function (i, e) {
            if ($(this).css('display') != 'none') {
                if (isPrevParenthesisOpen) {
                    $(this).find('.logic-select').val(null).prop('disabled', 'disabled').hide().trigger('change');
                }
                else {
                    $(this).find('.logic-select').prop('disabled', false).show().trigger('change');
                }
                isPrevParenthesisOpen = $(this).hasClass('parenthesis-line') && $(this).hasClass('parenthesis-open');
            }
        });
    },

    onLogicSelectChange: function(elem, counter) {
        // console.log('logic select changed... ', elem, counter);
    }

};

var ConditionOrderHandler = {

    //conditionOrderInputCounter: 0,

    getConditionOrderHiddenInput: function(value, _condln) {

        if(_condln===0)_condln = '0';

        if (typeof value === 'undefined' || !value) { value = '0'; }

        //conditionOrderInputCounter++

        inputHTML = '<input type="hidden" class="aow_condition_order_input" name="aow_conditions_order[' + (_condln ? _condln : condln) + ']" value="' + value + '">';

        return inputHTML;
    },

    setConditionOrders: function() {
        var ord = 0;
        $('#aow_conditions_body tr').each(function (i, e) {
            if ($(this).css('display') != 'none') {
                $(this).find('.aow_condition_order_input').val(ord++);
            }
            else {
                $(this).find('.aow_condition_order_input').val(-1);
            }
        });
    },

    getConditionLineByPageEvent: function(event) {
        var closest = $(document.elementFromPoint(event.pageX - window.pageXOffset, event.pageY - window.pageYOffset)).closest('tr');
        if((closest.attr('id') && closest.attr('id').search('product_line') === 0) || (closest.attr('class') && closest.attr('class').search('parenthesis-line') !== -1)) {
            return closest;
        }
        return false;
    },

    putPositionedConditionLines: function(elemTarget, elemNew) {
        elemTarget.before(elemNew);
    }

};

var ParenthesisHandler = {

    //parenthesisCounter: 0,

    getParenthesisStartHtml: function(condition_id, logic_op, condition_order, _condln) {

        if(!condition_id) condition_id = '';
        if(!logic_op) logic_op = '';
        if(!condition_order) condition_order = '';
        if(_condln===0)_condln = '0';

        var html =
            '<tr class="parenthesis-line parenthesis-open start_paranthesis"   style = "background: #f5f5f5;border: 1px solid #a5e8d6" parenthesis-counter="' + (_condln ? _condln : condln) + '" data-condition-id="' + condition_id + '">' ;
			if(action_sugar_grp1 == 'EditView'){
				html +=  '  <td>     <input type="hidden" name="aow_conditions_parenthesis[' + ((_condln ? _condln : condln)) + ']" value="START">'+
				'       <button type="button" class="button parenthesis-remove-btn" value="" onclick="ParenthesisHandler.deleteParenthesisPair(this, ' + ((_condln ? _condln : condln)) + ');">' +
				'           <img src="themes/default/images/id-ff-remove-nobg.png" alt="">' +
				'       </button>' +
				'       <input type="hidden" name="aow_conditions_deleted[' + (_condln ? _condln : condln) + ']" id="aow_conditions_deleted' + (_condln ? _condln : condln) + '" value="0" data-delete-id="' + condition_id + '">' +
				'       <input type="hidden" name="aow_conditions_id[' + (_condln ? _condln : condln) + ']" id="aow_conditions_id' + (_condln ? _condln : condln) + '" value="' + condition_id + '">' +
				'       <input type="hidden" name="aow_conditions_field[' + ((_condln ? _condln : condln)) + ']" value="">' +
				'  </td> ';
			} 
            html +=  '   <td>' + LogicalOperatorHandler.getLogicalOperatorSelectHTML(logic_op, ((_condln ? _condln : condln))) + ConditionOrderHandler.getConditionOrderHiddenInput(condition_order, ((_condln ? _condln : condln))) + '</td>' +
            '   <td colspan="6">' +
            '       <div>(</div> ' +
            '   </td>' +
            '</tr>';

        return html;
    },

    getParenthesisEndHtml: function(condition_id, condition_order, condition_parenthesis_start, _condln, _start_condln) {

        if(!condition_id) condition_id = '';
        if(!condition_order) condition_order = '';
        if(!condition_parenthesis_start || condition_parenthesis_start == 'END') condition_parenthesis_start = '';
        if(_condln===0)_condln = '0';
        if(_start_condln===0)_start_condln = '0';

        var html =
            '<tr class="parenthesis-line parenthesis-close end_paranthesis"  parenthesis-counter="' + ((_condln ? _condln : condln+1)) + '" data-condition-id="' + condition_id + '" data-parenthesis-start="' + (condition_parenthesis_start) + '" data-parenthasis-start-condln="' + (_start_condln ? _start_condln : condln) + '">' +
            '   <td>' +
            '       <input type="hidden" name="aow_conditions_parenthesis[' + ((_condln ? _condln : condln+1)) + ']" value="' + (condition_parenthesis_start ? condition_parenthesis_start : 'END') + '">' +
            '       <input type="hidden" class="parenthesis-close-deleted-input" name="aow_conditions_deleted[' + (_condln ? _condln : condln+1) + ']" id="aow_conditions_deleted' + (_condln ? _condln : condln+1) + '" value="0" data-delete-id="' + condition_id + '">' +
            '       <input type="hidden" name="aow_conditions_id[' + (_condln ? _condln : condln+1) + ']" id="aow_conditions_id' + (_condln ? _condln : condln+1) + '" value="' + condition_id + '">' +
            '       <input type="hidden" name="aow_conditions_field[' + ((_condln ? _condln : condln+1)) + ']" value="">' +
            '       &nbsp;' +
            '   </td>' +
            '   <td>' + ConditionOrderHandler.getConditionOrderHiddenInput(condition_order, ((_condln ? _condln : condln+1))) + '</td>' +
            '   <td colspan="6">' +
            '   <div>)</div> ' +
            '   </td>' +
            '</tr>';

        return html;
    },

    replaceParenthesisBtns: function() {

        $( ParenthesisHandler.getParenthesisStartHtml() + ParenthesisHandler.getParenthesisEndHtml() ).replaceAll('#aow_conditions_body .parentheses-btn');
		$( ".start_paranthesis" ).nextUntil( ".end_paranthesis" ).attr( "style", "background: #f5f5f5;border: 1px solid #a5e8d6" );
        condln+=2;
        condln_count+=2;

        //parenthesisCounter++;
    },

    deleteParenthesisPair: function(elem, counter) {
        condition_id = $('#aow_conditions_id'+counter).val();
        if(condition_id) {
            $('input[data-delete-id="' + condition_id + '"]').val(1);
            $('tr[data-condition-id="' + condition_id + '"]').hide();
            $('tr.parenthesis-line.parenthesis-close').each(function(i,e){
                if($(this).attr('data-parenthesis-start') && $(this).attr('data-parenthesis-start') == condition_id) {
                    $(this).find('input.parenthesis-close-deleted-input').val(1);
                    $(this).hide();
                }
            });
        }
        else {
            $('.parenthesis-line[parenthesis-counter=' + counter + ']').remove();
            $('.parenthesis-line[data-parenthasis-start-condln=' + counter + ']').remove();
        }
        LogicalOperatorHandler.hideUnnecessaryLogicSelects();
        ConditionOrderHandler.setConditionOrders();
        ParenthesisHandler.addParenthesisLineIdent();
    },

    deleteParenthesisPairs: function() {
        $('.parenthesis-remove-btn').click();
    },

    addParenthesisLineIdent: function() {
        var identDeep = 0;
        $('.condition-ident').remove();
        $('#aow_conditions_body tr').each(function (i, e) {
            if($(this).css('display') != 'none') {
                if ($(this).hasClass('parenthesis-close')) {
                    identDeep--;
                }
                if ($(this).css('display') != 'none') {
                    for (var i = 0; i < identDeep; i++) {
                        $(this).find('td:nth-child(3)').prepend('<span class="condition-ident">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>');
                    }
                }
                if ($(this).hasClass('parenthesis-open')) {
                    identDeep++;
                }
            }
        });
        $('.condition-ident').closest('td').css('white-space', 'nowrap');
    }

};

function loadConditionLine(condition, overrideView){

    showConditionLines();

    var prefix = 'aow_conditions_';
    var ln = 0;

    ln = insertConditionLine(condition);

    for(var a in condition){
        var elem = document.getElementById(prefix + a + ln);
        if(elem != null){
            if(elem.nodeName !== 'INPUT') {
                elem.innerHTML = condition[a];
            }else if(elem.getAttribute('type') === 'checkbox'){
                elem.checked = condition[a] == 1;
            }else {
                elem.value = condition[a];
            }
        }
    }

    if (condition['value'] instanceof Array) {
        condition['value'] = JSON.stringify(condition['value'])
    }

    if(!condition['parenthesis']) {
        showConditionModuleField(ln, condition['operator'], condition['value_type'], condition['value'],overrideView, condition['logic_op'], condition['condition_order'], condition['parenthesis']);
    }

    return $('#product_line'+ln);
}

function showConditionLines() {
    $('#detailpanel_parameters').removeClass('hidden');
}

function showConditionCurrentModuleFields(ln, value){

    if (typeof value === 'undefined') { value = ''; }

    flow_module = document.getElementById('flow_module').value;
    var rel_field = document.getElementById('aow_conditions_module_path' + ln).value;

    if(flow_module != '' && rel_field != ''){

        var callback = {
            success: function(result) {
                var fields = JSON.parse(result.responseText);

                document.getElementById('aow_conditions_field'+ln).innerHTML = '';

                var selector = document.getElementById('aow_conditions_field'+ln);
                for (var i in fields) {
                    selector.options[selector.options.length] = new Option(fields[i], i);
                }

                if(fields[value] != null ){
                    document.getElementById('aow_conditions_field'+ln).value = value;
                }

                if(value == '') showConditionModuleField(ln);

            }
        }

        YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFields&aow_module="+flow_module+"&view=JSON&rel_field="+rel_field+"&aow_value="+value,callback);

    }

}

var moduleFieldsPendingFinished = 0;
var moduleFieldsPendingFinishedCallback = null;

var setModuleFieldsPendingFinishedCallback = function(callback) {
    moduleFieldsPendingFinishedCallback = callback;
};

var testModuleFieldsPandingFinihed = function() {
    moduleFieldsPendingFinished--;
    if(moduleFieldsPendingFinished==0) {
        moduleFieldsPendingFinished = true;
        if(moduleFieldsPendingFinishedCallback) {
            moduleFieldsPendingFinishedCallback();
        }
    }
};






function showConditionModuleField(ln, operator_value, type_value, field_value, overrideView, logic_value, condition_order, parenthesis){
    if(overrideView === undefined){
        overrideView = action_sugar_grp1;
    }


    if (typeof operator_value === 'undefined') { operator_value = ''; }
    if (typeof type_value === 'undefined') { type_value = ''; }
    if (typeof field_value === 'undefined') { field_value = ''; }

    var rel_field = document.getElementById('aow_conditions_module_path'+ln).value;
    var aow_field = document.getElementById('aow_conditions_field'+ln).value;
    if(aow_field != ''){

        var callback = {
            success: function(result) {
                document.getElementById('aow_conditions_operatorInput'+ln).innerHTML = result.responseText;
                SUGAR.util.evalScript(result.responseText);
                testModuleFieldsPandingFinihed();
            },
            failure: function(result) {
                document.getElementById('aow_conditions_operatorInput'+ln).innerHTML = '';
                testModuleFieldsPandingFinihed();
            }
        }
        var callback2 = {
            success: function(result) {
                document.getElementById('aow_conditions_fieldTypeInput'+ln).innerHTML = result.responseText;
                SUGAR.util.evalScript(result.responseText);
                document.getElementById('aow_conditions_fieldTypeInput'+ln).onchange = function(){showConditionModuleFieldType(ln, undefined, overrideView);};
                testModuleFieldsPandingFinihed();
            },
            failure: function(result) {
                document.getElementById('aow_conditions_fieldTypeInput'+ln).innerHTML = '';
                testModuleFieldsPandingFinihed();
            }
        }
        var callback3 = {
            success: function(result) {
                document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = result.responseText;
                SUGAR.util.evalScript(result.responseText);
                enableQS(false);
                testModuleFieldsPandingFinihed();
            },
            failure: function(result) {
                document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = '';
                testModuleFieldsPandingFinihed();
            }
        }

        var aow_operator_name = "aow_conditions_operator["+ln+"]";
        var aow_field_type_name = "aow_conditions_value_type["+ln+"]";
        var aow_field_name = "aow_conditions_value["+ln+"]";
		$( ".start_paranthesis" ).nextUntil( ".end_paranthesis" ).attr( "style", "background: #f5f5f5;border: 1px solid #a5e8d6" );
        moduleFieldsPendingFinished++; YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleOperatorField&view="+overrideView+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_operator_name+"&aow_value="+operator_value+"&rel_field="+rel_field,callback);
		moduleFieldsPendingFinished++; YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getFieldTypeOptions&view="+overrideView+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_type_name+"&aow_value="+type_value+"&rel_field="+rel_field,callback2);
        moduleFieldsPendingFinished++; YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFieldType&view="+overrideView+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_name+"&aow_value="+field_value+"&aow_type="+type_value+"&rel_field="+rel_field,callback3);

    } else {
        document.getElementById('aow_conditions_logicInput'+ln).innerHTML = ''
        document.getElementById('aow_conditions_operatorInput'+ln).innerHTML = ''
        document.getElementById('aow_conditions_fieldTypeInput'+ln).innerHTML = '';
        document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = '';
    }
}

function showConditionModuleFieldType(ln, value, overrideView){
    if(overrideView === undefined){
        overrideView = action_sugar_grp1;
    }
    if (typeof value === 'undefined') { value = ''; }

    var callback = {
        success: function(result) {
            document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = result.responseText;
            SUGAR.util.evalScript(result.responseText);
            enableQS(false);
        },
        failure: function(result) {
            document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = '';
        }
    }

    var rel_field = document.getElementById('aow_conditions_module_path'+ln).value;
    var aow_field = document.getElementById('aow_conditions_field'+ln).value;
    var type_value = document.getElementById("aow_conditions_value_type["+ln+"]").value;
    var aow_field_name = "aow_conditions_value["+ln+"]";
	$( ".start_paranthesis" ).nextUntil( ".end_paranthesis" ).attr( "style", "background: #f5f5f5;border: 1px solid #a5e8d6" );
    YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFieldType&view="+overrideView+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_name+"&aow_value="+value+"&aow_type="+type_value+"&rel_field="+rel_field,callback);

}

/** Added by Bao
 */
function showModuleField(ln, operator_value, type_value, field_value){
    if (typeof operator_value === 'undefined') { operator_value = ''; }
    if (typeof type_value === 'undefined') { type_value = ''; }
    if (typeof field_value === 'undefined') { field_value = ''; }

    var rel_field = document.getElementById('aow_conditions_module_path'+ln).value;
    var aow_field = document.getElementById('aow_conditions_field'+ln).value;
    if(aow_field != ''){

        var callback = {
            success: function(result) {
                document.getElementById('aow_conditions_operatorInput'+ln).innerHTML = result.responseText;
                SUGAR.util.evalScript(result.responseText);
                document.getElementById('aow_conditions_operatorInput'+ln).onchange = function(){changeOperator(ln);};

            },
            failure: function(result) {
                document.getElementById('aow_conditions_operatorInput'+ln).innerHTML = '';
            }
        }
        var callback2 = {
            success: function(result) {
                document.getElementById('aow_conditions_fieldTypeInput'+ln).innerHTML = result.responseText;
                SUGAR.util.evalScript(result.responseText);
                document.getElementById('aow_conditions_fieldTypeInput'+ln).onchange = function(){showModuleFieldType(ln);};
            },
            failure: function(result) {
                document.getElementById('aow_conditions_fieldTypeInput'+ln).innerHTML = '';
            }
        }
        var callback3 = {
            success: function(result) {
                document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = result.responseText;
                SUGAR.util.evalScript(result.responseText);
                enableQS(true);
            },
            failure: function(result) {
                document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = '';
            }
        }

        var aow_operator_name = "aow_conditions_operator["+ln+"]";
        var aow_field_type_name = "aow_conditions_value_type["+ln+"]";
        var aow_field_name = "aow_conditions_value["+ln+"]";

        YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleOperatorField&view="+action_sugar_grp1+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_operator_name+"&aow_value="+operator_value+"&rel_field="+rel_field,callback);
        YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getFieldTypeOptions&view="+action_sugar_grp1+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_type_name+"&aow_value="+type_value+"&rel_field="+rel_field,callback2);
        YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFieldType&view="+action_sugar_grp1+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_name+"&aow_value="+field_value+"&aow_type="+type_value+"&rel_field="+rel_field,callback3);

    } else {
        document.getElementById('aow_conditions_operatorInput'+ln).innerHTML = ''
        document.getElementById('aow_conditions_fieldTypeInput'+ln).innerHTML = '';
        document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = '';
    }

    if(operator_value == 'is_null'){
        hideElem('aow_conditions_fieldTypeInput' + ln);
        hideElem('aow_conditions_fieldInput' + ln);
    } else {
        showElem('aow_conditions_fieldTypeInput' + ln);
        showElem('aow_conditions_fieldInput' + ln);
    }
}

function showModuleFieldType(ln, value){
    if (typeof value === 'undefined') { value = ''; }

    var callback = {
        success: function(result) {
            document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = result.responseText;
            SUGAR.util.evalScript(result.responseText);
            enableQS(false);
        },
        failure: function(result) {
            document.getElementById('aow_conditions_fieldInput'+ln).innerHTML = '';
        }
    }

    var rel_field = document.getElementById('aow_conditions_module_path'+ln).value;
    var aow_field = document.getElementById('aow_conditions_field'+ln).value;
    var type_value = document.getElementById("aow_conditions_value_type["+ln+"]").value;
    var aow_field_name = "aow_conditions_value["+ln+"]";

    YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFieldType&view="+action_sugar_grp1+"&aow_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_name+"&aow_value="+value+"&aow_type="+type_value+"&rel_field="+rel_field,callback);

}

/** End add by Bao */

/**
 * Insert Header
 */

function insertConditionHeader(){
    var nxtCell = 0;
    var view = action_sugar_grp1;
    tablehead = document.createElement("thead");
    tablehead.id = "conditionLines_head";
    document.getElementById('conditionLines').appendChild(tablehead);

    var x=tablehead.insertRow(-1);
    x.id='conditionLines_head';
	if(view === 'EditView') {
		var a=x.insertCell(nxtCell++);
		//a.style.color="rgb(68,68,68)";
	}

	var cellLogic = x.insertCell(nxtCell++);
	cellLogic.innerHTML = SUGAR.language.get('AOW_Conditions', 'LBL_LOGIC_OP');
    
    var b=x.insertCell(nxtCell++);
    b.style.color="rgb(0,0,0)";
    b.innerHTML=SUGAR.language.get('AOW_Conditions', 'LBL_MODULE_PATH');

    var c=x.insertCell(nxtCell++);
    c.style.color="rgb(0,0,0)";
    c.innerHTML=SUGAR.language.get('AOW_Conditions', 'LBL_FIELD');

    var d=x.insertCell(nxtCell++);
    d.style.color="rgb(0,0,0)";
    d.innerHTML=SUGAR.language.get('AOW_Conditions', 'LBL_OPERATOR');

    var e=x.insertCell(nxtCell++);
    e.style.color="rgb(0,0,0)";
    e.innerHTML=SUGAR.language.get('AOW_Conditions', 'LBL_VALUE_TYPE');

    var f=x.insertCell(nxtCell++);
    f.style.color="rgb(0,0,0)";
    f.innerHTML=SUGAR.language.get('AOW_Conditions', 'LBL_VALUE');

    // if(view === 'EditView') {
        // var h = x.insertCell(-1);
        // h.style.color = "rgb(0,0,0)";
        // h.innerHTML = SUGAR.language.get('AOW_Conditions', 'LBL_PARAMETER');
    // }
}

function insertConditionLine(condition){

    var nxtCell = 0;
    var view = action_sugar_grp1;
    if (document.getElementById('conditionLines_head') == null) {
        insertConditionHeader();
    } else {
        document.getElementById('conditionLines_head').style.display = '';
    }

    var tablebody = document.getElementById('aow_conditions_body');
    if(tablebody == null) {
        tablebody = document.createElement("tbody");
        tablebody.id = "aow_conditions_body";
        tablebody.className = "connectedSortableConditions ui-sortable";
        document.getElementById('conditionLines').appendChild(tablebody);
    }

    if(condition.parenthesis) {
        if(condition.parenthesis == 'START') {
            $(tablebody).append(ParenthesisHandler.getParenthesisStartHtml(condition.id, condition.logic_op, condition.condition_order, condln));
        }
        else {
            $(tablebody).append(ParenthesisHandler.getParenthesisEndHtml(condition.id, condition.condition_order, condition.parenthesis, condln));
        }
    }
    else {

        var x = tablebody.insertRow(-1);
        x.id = 'product_line' + condln;

        if(action_sugar_grp1 == 'EditView'){
			var a = x.insertCell(nxtCell++);
            a.innerHTML = "<button type='button' id='aow_conditions_delete_line" + condln + "' class='button' value='' tabindex='116' onclick='markConditionLineDeleted(" + condln + ")'><img src='themes/default/images/id-ff-remove-nobg.png' alt=''></button><br>";
            a.innerHTML += "<input type='hidden' name='aow_conditions_deleted[" + condln + "]' id='aow_conditions_deleted" + condln + "' value='0'><input type='hidden' name='aow_conditions_id[" + condln + "]' id='aow_conditions_id" + condln + "' value=''>";
			a.style.width = '5%';
        } else{
            // a.innerHTML = condln +1 + "<input class='aow_conditions_id' type='hidden' name='aow_conditions_id[" + condln + "]' id='aow_conditions_id" + condln + "' value=''>";
        }


		var cellLogic = x.insertCell(nxtCell++);
		cellLogic.id = 'aow_conditions_logicInput' + condln;
		cellLogic.innerHTML = LogicalOperatorHandler.getLogicalOperatorSelectHTML(condition.logic_op ? condition.logic_op : null, condln) + ConditionOrderHandler.getConditionOrderHiddenInput(condition.condition_order ? condition.condition_order : null, condln);

        var b = x.insertCell(nxtCell++);
        b.style.width = '15%';
        b.className = 'condition-sortable-handle';
        b.innerHTML = "<input type='hidden' name='aow_conditions_module_path[" + condln + "]' id='aow_conditions_module_path" + condln + "' value=''>";
        b.innerHTML += "<span style='width:178px;' id='aow_conditions_module_path_display" + condln + "' ></span>";


        var c = x.insertCell(nxtCell++);
        c.style.width = '20%';
        c.className = 'condition-sortable-handle';
        c.innerHTML = "<input type='hidden' name='aow_conditions_field[" + condln + "]' id='aow_conditions_field" + condln + "' value=''>";
        c.innerHTML += "<span style='width : auto !important;' id='aow_conditions_field_label" + condln + "' ></span>";


        var d = x.insertCell(nxtCell++);
        d.id = 'aow_conditions_operatorInput' + condln;
		 if (action_sugar_grp1 == 'EditView') {
			d.style = 'width : auto !important ;';
		 }
		
        var e = x.insertCell(nxtCell++);
        e.id = 'aow_conditions_fieldTypeInput' + condln;
		 if (action_sugar_grp1 == 'EditView') {
        e.style = 'auto !important';
		 }

        var f = x.insertCell(nxtCell++);
        f.id = 'aow_conditions_fieldInput' + condln;
		 if (action_sugar_grp1 == 'EditView') {
		f.style.width = 'auto !important';
		 }
		


        // if (view === 'EditView') {
            // var h = x.insertCell(-1);
            // h.innerHTML += "<input id='aow_conditions_parameter" + condln + "' name='aow_conditions_parameter[" + condln + "]' value='1' type='checkbox'>";
            // h.style.width = '10%';
        // }

    }

    condln++;
    condln_count++;

    return condln -1;
}

function markConditionLineDeleted(ln)
{
    // collapse line; update deleted value
    document.getElementById('product_line' + ln).style.display = 'none';
    document.getElementById('aow_conditions_deleted' + ln).value = '1';
    document.getElementById('aow_conditions_delete_line' + ln).onclick = '';

    condln_count--;
    if(condln_count == 0){
        document.getElementById('conditionLines_head').style.display = "none";
    }

    // remove condition header if doesn't exists any more condition in area
    var found = false;
    $('#aow_conditions_body tr').each(function(i,e){
        if($(e).css('display') != 'none') {
            found = true;
        }
    });
    if(!found) {
        //$('#conditionLines_head').remove();
		//$('#conditionLines').html('');
    }

    LogicalOperatorHandler.hideUnnecessaryLogicSelects();
    ConditionOrderHandler.setConditionOrders();
    ParenthesisHandler.addParenthesisLineIdent();
}

function clearConditionLines(){

    if(document.getElementById('conditionLines') != null){
        var cond_rows = document.getElementById('conditionLines').getElementsByTagName('tr');
        var cond_row_length = cond_rows.length;
        var i;
        for (i=0; i < cond_row_length; i++) {
            if(document.getElementById('aow_conditions_delete_line'+i) != null){
                document.getElementById('aow_conditions_delete_line'+i).click();
            }
        }
    }
    ParenthesisHandler.deleteParenthesisPairs();
}


function hideElem(id){
    if(document.getElementById(id)){
        document.getElementById(id).style.display = "none";
        document.getElementById(id).value = "";
    }
}

function showElem(id){
    if(document.getElementById(id)){
        document.getElementById(id).style.display = "";
    }
}

function date_field_change(field){
    if(document.getElementById(field + '[1]').value == 'now'){
        hideElem(field + '[2]');
        hideElem(field + '[3]');
    } else {
        showElem(field + '[2]');
        showElem(field + '[3]');
    }
}

function addNodeToConditions(node){
	return loadConditionLine(
        {
            'label' : node.name,
            'module_path' : node.module_path,
            'module_path_display' : node.module_path_display,
            'field' : node.id,
            'field_label' : node.name});
}
