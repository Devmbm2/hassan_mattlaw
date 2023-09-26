<link href='modules/ht_formbuilder/css/datatables.min.css' rel='stylesheet' type='text/css' />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />

<h3>All documents failed by QC1</h3>
<input type="hidden" id="user_id" value="{$user_id}">

<div id="tablediv" class="" style="overflow:scroll; ">
    <table class="table table-bordered table-responsive " id="tableid">
        <thead>
            <tr style="font-weight: bold; font-size:15px; ">
                <th style="text-align: left;width:450px;">Document Name</th>
                <th style="text-align: left">Module</th>
                <th style="text-align: left" class="created_by">Created By</th>
                <th style="text-align: left">Actions</th>
            </tr>
        </thead>
        <tbody id="qc_failed1_table">
            {foreach from=$results item=i }
                <tr>
                    {if $i.module_name == 'Discovery'}
                        <td> <a
                                href="index.php?module=DISC_Discovery&action=DetailView&record={$i.record_id}">{$i.document_name}</a>
                        </td>
                    {/if}
                    {if $i.module_name == 'Negotiations'}
                        <td> <a
                                href="index.php?module=NEG_Negotiations&action=DetailView&record={$i.record_id}">{$i.document_name}</a>
                        </td>
                    {/if}
                    {if $i.module_name == 'Pleadings'}
                        <td> <a
                                href="index.php?module=PLEA_Pleadings&action=DetailView&record={$i.record_id}">{$i.document_name}</a>
                        </td>
                    {/if}

                    <td>{$i.module_name}</td>
                    <td>{$i.Created_By}</td>

                    {if $i.module_name == 'Discovery'}
                        <td> <a href="index.php?module=DISC_Discovery&action=DetailView&record={$i.record_id}"
                                class="btn view">View Record</a>
                            <button class="btn " id="remarks_btn" name="remarks_btn"
                                onclick="remarks(`{$i.remarks}`)">Corrective Notes</button>
                            <button class="btn " id="repair_btn" name="repair_btn"
                                onclick="repaired(`{$i.record_id}`,`{$i.module_name}`,`{$i.users_id}`)">Repaired</button>
                        </td>
                    {/if}
                    {if $i.module_name == 'Negotiations'}
                        <td> <a href="index.php?module=NEG_Negotiations&action=DetailView&record={$i.record_id}"
                                class="btn view"> View Record</a>
                            <button class="btn " id="remarks_btn" name="remarks_btn"
                                onclick="remarks(`{$i.remarks}`)">Corrective Notes</button>
                            <button class="btn " id="repair_btn" name="repair_btn"
                                onclick="repaired(`{$i.record_id}`,`{$i.module_name}`,`{$i.users_id}`)">Repaired</button>
                        </td>
                    {/if}
                    {if $i.module_name == 'Pleadings'}
                        <td> <a href="index.php?module=PLEA_Pleadings&action=DetailView&record={$i.record_id}"
                                class="btn view">View Record</a>
                            <button class="btn " id="remarks_btn" name="remarks_btn"
                                onclick="remarks(`{$i.remarks}`)">Corrective Notes</button>
                            <button class="btn " id="repair_btn" name="repair_btn"
                                onclick="repaired(`{$i.record_id}`,`{$i.module_name}`,`{$i.users_id}`)">Repaired</button>
                        </td>
                    {/if}
                </tr>

            {/foreach}


        </tbody>
    </table>
</div>

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

        function replyToQc(record_id, module_name, users_id) {
            YAHOO.SUGAR.MessageBox.show({ msg: '', height: '70px', width: '50px', position: 'centre', title: 'Corrective Notes' });
            $(".bd").append(`<div class="container" style="width: 600px;font-size:15px; background-color:white;">
    <form action="index.php?module=Documents&action=submit_user_reply_remarks" method ="POST" id="form_id">
<input type="hidden" id="record_id" name="record_id" value="${record_id}">
<input type="hidden" id="users_id" name="users_id" value="${users_id}">
<input type="hidden" id="module_name" name="module_name" value="${module_name}">
        <div class="form-group">
            <label for="remarks">Reply to QC</label>
            <textarea style="overflow:scroll;" class="form-control" id="remarks" name="remarks" rows="10" cols="5" required></textarea>
        </div>
        <div class="form-group"> 
            <input type="submit" class="btn btn-info" id="save_btn" name="save_btn">
        </div>
   </form></div> `);
        }
        $(document).on('submit', '#form_id', function(e) {
            $('#sugarMsgWindow').hide();

            Swal.fire(
                'Sended!',
                'Your reply for this document is sended to QC!',
                'success'
            )
        });

        function repaired(record_id, module_name, users_id) {
            console.log(record_id);
            Swal.fire({
                    title: 'Have your check document properly?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#edd03d',
                    cancelButtonColor: '#edd03d',
                    confirmButtonText: 'Conform'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({

                            // url: 'index.php?module=Documents&&action=getallrevieweddocuments',
                            url: 'index.php?module=Home&action=update_user_repaired_status',
                            type: 'POST',
                            data: { record_id: record_id, module_name: module_name },

                            success: function(result) {
                                if (result == 'success') {
                                    Swal.fire(
                                        'Success!',
                                        'Your document is successfully sent to QC1 for recheck',
                                        'success'
                                    )
                                    $('.swal2-styled.swal2-confirm').css("background", "#edd03d");
                                    $('.swal2-styled.swal2-confirm').css("color", "#111"); 
                                    $('.swal2-styled.swal2-confirm:focus').css("box-shadow"," 0 0 0 3px rgb(237 208 61)");
                                    location.reload();

                                }
                            }
                        });
                    }
                });
                $('.swal2-styled.swal2-confirm:focus').css("box-shadow"," 0 0 0 3px rgb(237 208 61)");
                $('.swal2-styled.swal2-confirm').css("color", "#111");
                $('.swal2-styled.swal2-cancel').css("color", "#111");
        }
    </script>
{/literal}