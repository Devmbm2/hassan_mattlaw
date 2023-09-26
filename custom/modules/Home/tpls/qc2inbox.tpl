<link href='modules/ht_formbuilder/css/datatables.min.css' rel='stylesheet' type='text/css' />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />
<h3>All Documents Passed By QC1 Inbox Or QC1 Repaired</h3>

<div id="tablediv" class="">
    <table class="table table-bordered table-responsive " id="tableid">
        <thead>
            <tr style="font-weight: bold; font-size:15px; bordered " class="thead_tr">
                <th style="text-align: left;width:450px;">Document Name</th>
                <th style="text-align: left" class="th_module">Module</th>
                <th style="text-align: left" class="created_by">Created By</th>
                {* <th style="text-align: left">Date/Time</th> *}
                <th style="text-align: left">Actions</th>


            </tr>
        </thead>
        <tbody id="documents_review_tbody">
            {foreach from=$results item=i }
                <tr>
                    {if $i.module_name == 'Discovery'}
                        <td> <a href="index.php?module=DISC_Discovery&action=DetailView&record={$i.record_id}">{$i.document_name}</a>
                        </td>
                    {/if}
                    {if $i.module_name == 'Negotiations'}
                        <td> <a href="index.php?module=NEG_Negotiations&action=DetailView&record={$i.record_id}">{$i.document_name}</a>
                        </td>
                    {/if}
                    {if $i.module_name == 'Pleadings'}
                        <td> <a href="index.php?module=PLEA_Pleadings&action=DetailView&record={$i.record_id}">{$i.document_name}</a>
                        </td>
                    {/if}

                    <td>{$i.module_name}</td>
                    <td>{$i.Created_By}</td>

                    {if $i.module_name == 'Discovery'}
                        <td> <a href="index.php?module=DISC_Discovery&action=DetailView&record={$i.record_id}"
                                class="btn view">View Record</a>
                                <button class="btn " id="remarks_btn" name="remarks_btn"
                                onclick="remarks(`{$i.remarks}`)">Corrective Notes</button></td>
                    {/if}
                    {if $i.module_name == 'Negotiations'}
                        <td> <a href="index.php?module=NEG_Negotiations&action=DetailView&record={$i.record_id}"
                                class="btn view"> View Record</a>
                                <button class="btn " id="remarks_btn" name="remarks_btn"
                                onclick="remarks(`{$i.remarks}`)">Corrective Notes</button></td>
                    {/if}
                    {if $i.module_name == 'Pleadings'}
                        <td> <a href="index.php?module=PLEA_Pleadings&action=DetailView&record={$i.record_id}"
                                class="btn view">View Record</a>
                                <button class="btn" id="remarks_btn" name="remarks_btn"
                                onclick="remarks(`{$i.remarks}`)">Corrective Notes</button></td>
                    {/if}
                </tr>

            {/foreach}
      

        </tbody>
    </table>
</div>
<br>
{sugar_getscript file="modules/ht_formbuilder/js/sweetAlert.js"}
{sugar_getscript file="modules/ht_formbuilder/js/datatables.min.js"}

{literal}
    <style>
    button{
        background-color: #edd03d;
        color: #111111;

        }
         .view{
            width: fit-content;
            
            background-color: #edd03d;
            color: #111111;
        }
    </style>
{/literal}

{literal}
    <script type="text/javascript">
        $('#tableid').DataTable({
        'searching': true,
        'paging':true,
        'info':false,
        'pageLength':100,
        });
        function remarks(data) {
            console.log(data);
            YAHOO.SUGAR.MessageBox.show({ msg: '', height: '70px', width: '50px', position: 'centre', title: 'Corrective Notes' });
            $(".bd").append(`<div class="container" style="width: 600px;font-size:15px; background-color:white;">
                <div class="form-group" >
                <label for="remarks">Corrective Notes </label>
                <div id="parse_result" style="overflow:scroll; height:400px;" ></div>
                
                </div>
                </div> `);
htmls = $.parseHTML( data )
$('#parse_result').html(htmls);
        }
    </script>
{/literal}