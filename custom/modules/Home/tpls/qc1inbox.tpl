<link href='modules/ht_formbuilder/css/datatables.min.css' rel='stylesheet' type='text/css' />
 {* <link href='https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css' />  *}
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />

<h3>All Documents </h3>


<div id="tablediv" class="">
    <table class="table table-bordered table-striped " id="tableid">
        <thead>
            <tr style="font-weight: bold; font-size:15px; bordered " class="thead_tr">
                <th style="text-align: left;width:300px;">Document Name</th>
                <th style="text-align: left" class="th_module">Module</th>
                <th style="text-align: left" class="created_by">Created By</th>
                {* <th style="text-align: left">Date/Time</th> *}
                <th style="text-align: left">Actions</th>


            </tr>
        </thead>
        <tbody id="documents_review_tbody">
            {foreach from=$results item=i }
                <tr>
                    {if $i.Module == 'Discovery'}
                        <td> <a href="index.php?module=DISC_Discovery&action=DetailView&record={$i.id}">{$i.document_name}</a>
                        </td>
                    {/if}
                    {if $i.Module == 'Negotiations'}
                        <td> <a href="index.php?module=NEG_Negotiations&action=DetailView&record={$i.id}">{$i.document_name}</a>
                        </td>
                    {/if}
                    {if $i.Module == 'Pleadings'}
                        <td> <a href="index.php?module=PLEA_Pleadings&action=DetailView&record={$i.id}">{$i.document_name}</a>
                        </td>
                    {/if}

                    <td>{$i.Module}</td>
                    <td>{$i.Created_By}</td>

                    {if $i.Module == 'Discovery'}
                        <td> <a href="index.php?module=DISC_Discovery&action=DetailView&record={$i.id}"
                                class="btn view ">View Record</a>
                                <button class="btn" id="remarks_btn" name="remarks_btn"
                                onclick="passaed_to_qc2(`{$i.id}`,`{$i.document_name}`,`{$i.created_by}`,`{$i.Module}`)">Pass</button>
                                </td>
                    {/if}
                    {if $i.Module == 'Negotiations'}
                        <td> <a href="index.php?module=NEG_Negotiations&action=DetailView&record={$i.id}"
                                class="btn  view"> View Record</a>
                                <button class="btn " id="remarks_btn" name="remarks_btn"
                                onclick="passaed_to_qc2(`{$i.id}`,`{$i.document_name}`,`{$i.created_by}`,`{$i.Module}`)">Pass</button>
                                </td>
                    {/if}
                    {if $i.Module == 'Pleadings'}
                        <td> <a href="index.php?module=PLEA_Pleadings&action=DetailView&record={$i.id}"
                                class="btn view ">View Record</a>
                                <button class="btn " id="remarks_btn" name="remarks_btn" 
                                onclick="passaed_to_qc2(`{$i.id}`,`{$i.document_name}`,`{$i.created_by}`,`{$i.Module}`)">Pass</button>
                                </td>
                    {/if}
                </tr>

            {/foreach}
      

        </tbody>
    </table>
</div>
<br>
{sugar_getscript file="modules/ht_formbuilder/js/sweetAlert.js"}
{* <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> *}

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
                   "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                    });
              
        function passaed_to_qc2(record_id,document_name,created_by,module_name) {

            Swal.fire({
                    title: 'Are you sure to pass document to QC2?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#edd03d',
                    cancelButtonColor: '#edd03d',
                    confirmButtonText: 'Conform',
                 
               
                })
              
                    .then((result) => {
                    
                    if (result.isConfirmed) {
                      
                        $.ajax({

                            // url: 'index.php?module=Documents&&action=getallrevieweddocuments',
                            url: 'index.php?module=Home&action=pass_document_to_qc2_from_qc1inbox',
                            type: 'POST',
                            data: { record_id: record_id,document_name:document_name,created_by:created_by,module_name:module_name },

                            success: function(result) {
                      
                                console.log(result)
                                if (result == 'success') {
                                    Swal.fire(
                                        'Success!',
                                        'Your document is successfully sent to QC2 for recheck',
                                        'success'
                                    )
                                    $('.swal2-styled.swal2-confirm').css("background", "#edd03d");
                                    $('.swal2-styled.swal2-confirm').css("color", "#111"); 
                                    $('.swal2-styled.swal2-confirm:focus').css("box-shadow"," 0 0 0 3px rgb(237 208 61)");
                                    location.reload();

                                }  if (result == 'failed')  {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                    })
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