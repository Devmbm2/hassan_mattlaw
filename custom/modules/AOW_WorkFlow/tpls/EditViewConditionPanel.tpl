{literal}
<style type="text/css">
#conditionLines td:not(:first-of-type) {
    display: inline-block;
    width: 13.667% !important;
}
#conditionLines_head_tr {
	background-color: #bfcad3;
}
    #EditView_tabs {float: left;}
	#report-editview-footer .tab-panels {
    width: 128%;
}
#conditionLines input.sqsEnabled {
    width: 150% !important;
}

#conditionLines select {
    width: auto !important;
}
</style>
{/literal}

<div id="report-editview-footer">


{literal}
    <script src="modules/AOR_Reports/js/jqtree/tree.jquery.js"></script>
    <script src="modules/AOR_Fields/fieldLines.js"></script>
 <script src="custom/modules/AOW_Conditions/conditionLines.js"></script>
    <script src="modules/AOR_Charts/chartLines.js"></script>

    <link rel="stylesheet" href="include/javascript/jquery/themes/base/jquery-ui.min.css">
    <script src="include/javascript/jquery/jquery-ui-min.js"></script>

<script>
    $(document).ready(function(){
        SUGAR.util.doWhen("typeof $('#fieldTree').tree != 'undefined'", function(){
            var $moduleTree = $('#fieldTree').tree({
                data: {},
                dragAndDrop: false,
                selectable: false,
                onDragStop: function(node, e,thing){
                },
                onCanMoveTo: function(){
                    return false;
                }
            });

        function loadTreeData(module, node){
            var _node = node;
            $.getJSON('index.php',
                    {
                        'module' : 'AOW_WorkFlow',
                        'action' : 'getModuleTreeData',
                        'aow_module' : module,
                        'view' : 'JSON'
                    },
                    function(relData){
                        processTreeData(relData, _node);
                    }
            );
        }

            var treeDataLeafs = [];

            var dropFieldLine = function(node) {
                addNodeToFields(node);
                updateChartDimensionSelects();
            };

            var dropConditionLine = function(node) {
                var newConditionLine = addNodeToConditions(node);
                LogicalOperatorHandler.hideUnnecessaryLogicSelects();
                ConditionOrderHandler.setConditionOrders();
                ParenthesisHandler.addParenthesisLineIdent();
                return newConditionLine;
            };

            var showTreeDataLeafs = function(treeDataLeafs, module, module_name, module_path_display) {
                if (typeof module_name == 'undefined' || !module_name) {
                    module_name = module;
                }
                if (typeof module_path_display == 'undefined' || !module_path_display) {
                    module_path_display = module_name;
                }
                $('#module-name').html('(<span title="' + module_path_display + '">' + module_name + '</span>)');
                $('#fieldTreeLeafs').remove();
                $('#detailpanel_fields_select').append('<div id="fieldTreeLeafs" class="dragbox aow_dragbox" title="{/literal}{$MOD.LBL_TOOLTIP_DRAG_DROP_ELEMS}{literal}"></div>');
                $('#fieldTreeLeafs').tree({
                    data: treeDataLeafs,
                    dragAndDrop: true,
                    selectable: true,
                    onCanSelectNode: function(node) {
                        if($('#report-editview-footer .toggle-detailpanel_fields').hasClass('active')) {
                            dropFieldLine(node);
                        }
                        else if($('#report-editview-footer .toggle-detailpanel_conditions').hasClass('active')) {
                            dropConditionLine(node);
                        }
                    },
                    onDragMove: function() {
                        $('.drop-area').addClass('highlighted');
                    },
                    onDragStop: function(node, e,thing){
                        $('.drop-area').removeClass('highlighted');
                        var target = $(document.elementFromPoint(e.pageX - window.pageXOffset, e.pageY - window.pageYOffset));
                        if(node.type != 'field'){
                            return;
                        }
                        if(target.closest('#fieldLines').length > 0){
                            dropFieldLine(node);
                        }else if(target.closest('#conditionLines').length > 0){
                            var conditionLineTarget = ConditionOrderHandler.getConditionLineByPageEvent(e);
                            var conditionLineNew = dropConditionLine(node);
                            if(conditionLineTarget) {
                                ConditionOrderHandler.putPositionedConditionLines(conditionLineTarget, conditionLineNew);
                                ConditionOrderHandler.setConditionOrders();
                            }
                            ParenthesisHandler.addParenthesisLineIdent();
                        }
                        else if(target.closest('.tab-toggler').length > 0) {
                            target.closest('.tab-toggler').click();
                            if(target.closest('.tab-toggler').hasClass('toggle-detailpanel_fields')) {
                                dropFieldLine(node);
                            }
                            else if (target.closest('.tab-toggler').hasClass('toggle-detailpanel_conditions')) {
                                dropConditionLine(node);
                            }
                        }

                    },
                    onCanMoveTo: function(){
                        return false;
                    }
                });
            };

        function loadTreeLeafData(node){
            var module = node.module;
            var module_name = node.name;
            var module_path_display = node.module_path_display;

            if(!treeDataLeafs[module]) {
                $.getJSON('index.php',
                        {
                            'module': 'AOW_WorkFlow',
                            'action': 'getModuleFields',
                            'aow_module': node.module,
                            'view': 'JSON'
                        },
                        function (fieldData) {
                            var treeData = [];

                            for (var field in fieldData) {
                                if (field) {
                                    treeData.push(
                                            {
                                                id: field,
                                                label: fieldData[field],
                                                'load_on_demand': false,
                                                type: 'field',
                                                module: node.module,
                                                module_path: node.module_path,
                                                module_path_display: node.module_path_display
                                            });
                                }
                            }
                            //$('#fieldTree').tree('loadData',treeData,node);
                            //node.loaded = true;
                            //$('#fieldTree').tree('openNode', node);
                            treeDataLeafs[module] = treeData;
                            showTreeDataLeafs(treeDataLeafs[module], module, module_name, module_path_display);
                        }
                );
            }
            else {
                showTreeDataLeafs(treeDataLeafs[module], module, module_name, module_path_display);
            }
        }

        function processTreeData(relData, node){
            var treeData = [];

            for(var field in relData){
			console.log(field);
                if(field) {
                    var modulePath = '';
                    var modulePathDisplay = '';
                    if(relData[field]['type'] == 'relationship') {
                        modulePath = field;
                        if (node) {
                            modulePath = node.module_path + ":" + field;
                            modulePathDisplay = node.module_path_display + " : "+relData[field]['module_label'];
                        }else{
                            modulePathDisplay = $('#flow_module option:selected').text() + ' : ' + relData[field]['module_label'];
                        }
                    }else{
                        if (node) {
                            modulePath = node.module_path;
                            modulePathDisplay = node.module_path_display;
                        }else{
                            modulePathDisplay = relData[field]['module_label'];
                        }
                    }
                    var newNode = {
                        id: field,
                        label: relData[field]['label'],
                        load_on_demand : true,
                        type: relData[field]['type'],
                        module: relData[field]['module'],
                        module_path: modulePath,
                        module_path_display: modulePathDisplay};
                    treeData.push(newNode);
                }
            }
            $('#fieldTree').tree('loadData',treeData, node);
            if(node){
                node.loaded = true;
                $('#fieldTree').tree('openNode', node);
            }
            else
            {
                if($('#fieldTree a:first').length)
                    $('#fieldTree a:first').click();
            }

        }

        $('#fieldTree').on(
                'click',
                '.jqtree-toggler, .jqtree-title', //
                function(event) {
                    if($(this).hasClass('jqtree-title')) {
                        $(this).prev().click();
                        return;
                    }
                    //console.log(event);
                    var node = $(this).closest('li.jqtree_common').data('node');
                    if(node.loaded) {

                    }else if(node.type == 'relationship'){
                        loadTreeData(node.module, node);
                    }else{
                        loadTreeLeafData(node);
                        $('#fieldTree').tree('openNode', node);
                    }

                    $('.jqtree-selected').removeClass('jqtree-selected');
                    $(this).closest('li').addClass('jqtree-selected');

                    return true;
                }
        );


            var clearTreeDataFields = function() {
                $('#module-name').html('');
                $('#fieldTreeLeafs').html('');
            }


        $('#flow_module').change(function(){
		    flow_module = $(this).val();
            loadTreeData($(this).val());
            clearTreeDataFields();
            clearFieldLines();
            clearConditionLines();
            clearChartLines();
        });


        $('#addChartButton').click(function(){
            loadChartLine({});
            updateChartDimensionSelects();

        });

        flow_module = $('#flow_module').val();
        loadTreeData($('#flow_module').val());

        $.each(fieldLines,function(key,val){
            loadFieldLine(val);
        });
        $.each(conditionLines,function(key,val){
            loadConditionLine(val);
        });
        $.each(chartLines,function(key,val){
            loadChartLine(val);
        });
        updateChartDimensionSelects();
        });
    });
</script>

{/literal}


<!-- <div class="tab-togglers">
    <div class="tab-toggler toggle-detailpanel_conditions active">
        <h4 class="button">{$MOD.LBL_AOW_CONDITIONS_SUBPANEL_TITLE}</h4>
    </div>
</div>
<div class="clear"></div> -->

<div class="tab-panels">

    <div class="edit tab-toggler toggle-detailpanel_conditions active view edit508 " id="detailpanel_fields">
        <table id="group_display_table" style="display: none;">
            <tbody>
                <tr>
                    <td>{$MOD.LBL_MAIN_GROUPS}</td>
                    <td>
                        <select id="group_display" name="aow_fields_group_display[0]"></select>
                        <select id="group_display_1" name="aow_fields_group_display[1]" style="display: none;"></select>
                        {literal}
                        <script type="text/javascript">
                            $(function(){
                                setInterval(function(){
                                    if($('#group_display').val() == -1) {
                                        $('#group_display_1').val(-1);
                                        $('#group_display_1').css('display', 'none');
                                    }
                                    else {
                                        if($('#group_display_1').val() == $('#group_display').val()) {
                                            $('#group_display_1').val(-1);
                                        }
                                        $('#group_display_1 option').show();
                                        $('#group_display_1 option[value="' + $('#group_display').val() + '"]').hide();

                                        // todo: temporary remove the secondary select for multi-group report
                                        $('#group_display_1').css('display', 'none');
                                        $('#group_display_1').val(-1);

                                        //$('#group_display_1').css('display', 'block');
                                    }

                                }, 100);
                            });
                        </script>
                        {/literal}
                    </td>
                </tr>
            </tbody>
        </table>
                <div class="drop-area" id="fieldLines" style="min-height: 450px;">
                </div>
    </div>
    <div class="edit view edit508 hidden" id="detailpanel_conditions">
        <div class="drop-area" id="conditionLines"  style="min-height: 300px;">
        </div>
        <hr>
        <table>
            <tbody id="aow_condition_parenthesis_btn" class="connectedSortableConditions">
                <tr class="parentheses-btn"><td class="condition-sortable-handle">{$MOD.LBL_ADD_PARENTHESIS}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="edit view edit508 hidden" id="detailpanel_charts">
        <div id="chartLines">
            <table>
                <thead id="chartHead" style="display: none;">
                    <tr>
                        <td></td>
                        <td>{$MOD.LBL_CHART_TITLE}</td>
                        <td>{$MOD.LBL_CHART_TYPE}</td>
                        <td>{$MOD.LBL_CHART_X_FIELD}</td>
                        <td>{$MOD.LBL_CHART_Y_FIELD}</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <button id="addChartButton" type="button">{$MOD.LBL_ADD_CHART}</button>
    </div>
</div>
{literal}
<script type="text/javascript">
        var reportToggler = function(elem) {
		
            var marker = 'toggle-';
            var classes = $(elem).attr('class').split(' ');
            //$('.tab-togglers .tab-toggler').removeClass('active');
            $(elem).addClass('active');
            $('.tab-panels .edit.view').addClass('hidden');
            $.each(classes, function(i, cls){
                if(cls.substring(0, marker.length) == marker) {
                    var panelId = cls.substring(marker.length);
                    $('#'+panelId).removeClass('hidden');
                }
            });
        };
    $(document).ready(function(){
			$( ".start_paranthesis" ).nextUntil( ".end_paranthesis" ).attr( "style", "background: #f5f5f5;border: 1px solid #f5f5f5" );
            reportToggler('<div class="tab-toggler toggle-detailpanel_conditions active"><h4 class="button">CONDITIONS</h4></div>');
       	
    setModuleFieldsPendingFinishedCallback(function(){
        var parenthesisBtnHtml;
        $( "#aow_conditions_body, #aow_condition_parenthesis_btn" ).sortable({
            handle: '.condition-sortable-handle',
            placeholder: "ui-state-highlight",
            cancel: ".parenthesis-line",
            connectWith: ".connectedSortableConditions",
            start: function(event, ui) {
                parenthesisBtnHtml = $('#aow_condition_parenthesis_btn').html();
				$( ".start_paranthesis" ).nextUntil( ".end_paranthesis" ).attr( "style", "background: #f5f5f5;border: 1px solid #a5e8d6" );
            },
            stop: function(event, ui) {
				$( ".start_paranthesis" ).nextUntil( ".end_paranthesis" ).attr( "style", "background: #f5f5f5;border: 1px solid #a5e8d6" );
                if(event.target.id == 'aow_condition_parenthesis_btn') {
                    $('#aow_condition_parenthesis_btn').html('<tr class="parentheses-btn">' + ui.item.html() + '</tr>');
                    ParenthesisHandler.replaceParenthesisBtns();
                }
                else {
                    if($(this).attr('id') == 'aow_conditions_body' && parenthesisBtnHtml != $('#aow_condition_parenthesis_btn').html()) {
                        $(this).sortable("cancel");
                    }
                }
                LogicalOperatorHandler.hideUnnecessaryLogicSelects();
                ConditionOrderHandler.setConditionOrders();
                ParenthesisHandler.addParenthesisLineIdent();
            }
        });//.disableSelection();
        LogicalOperatorHandler.hideUnnecessaryLogicSelects();
        ConditionOrderHandler.setConditionOrders();
        ParenthesisHandler.addParenthesisLineIdent();
        FieldLineHandler.makeGroupDisplaySelectOptions();
    });

    $(function(){

        $('#EditView_tabs .clear').remove();
        $('#EditView_tabs').attr('style', 'width: 78%;');

        $( '#aow_condition_parenthesis_btn' ).bind( "sortstart", function (event, ui) {
            ui.helper.css('margin-top', $(window).scrollTop() );
        });
        $( '#aow_condition_parenthesis_btn' ).bind( "sortbeforestop", function (event, ui) {
            ui.helper.css('margin-top', 0 );
        });

        $(window).resize()
        {
            $('div.panel-heading a div').css({
                width: $('div.panel-heading a').width() - 14
            });
        }
    });
    });
</script>
{/literal}

</div>

<div style="clear: both;"></div>
