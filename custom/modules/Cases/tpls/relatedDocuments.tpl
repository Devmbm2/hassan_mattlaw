<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" />
<h1>Related Documents</h1>
{*========Show Records of Soft Documents in jQuery Datatable========*}
<table id="all_birthday_templates" class="display">
    <thead>
    <tr>
        <th>Document Module</th>
        <th>Court Stamped Document</th>
        <th>Hard Document</th>
        <th>Soft Document</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$document_records item=item key=key}
        <tr style="text-align:center;">
            <td>{$item.doc_module}</td>
            {if $item.hard_category_id1 eq 'Incoming' && $item.hard_category_id2 eq 'Outgoing'}
                <td><a target="_blank" rel="noopener noreferrer" href="index.php?module=Documents&action=DetailView&record={$item.document_id1}">{$item.document_name1}</a></td>
                <td><a target="_blank" rel="noopener noreferrer" href="index.php?module=Documents&action=DetailView&record={$item.document_id2}">{$item.document_name2}</a></td>
            {elseif $item.hard_category_id1 eq 'Outgoing' && $item.hard_category_id2 eq 'Incoming'}
                <td><a target="_blank" rel="noopener noreferrer" href="index.php?module=Documents&action=DetailView&record={$item.document_id2}">{$item.document_name2}</a></td>
                <td><a target="_blank" rel="noopener noreferrer" href="index.php?module=Documents&action=DetailView&record={$item.document_id1}">{$item.document_name1}</a></td>
            {/if}
            <td><a target="_blank" rel="noopener noreferrer" href="index.php?module={$item.doc_module}&action=DetailView&record={$item.soft_record}">{$item.soft_name}</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>


{literal}
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('#all_birthday_templates').DataTable();
        });
    </script>
{/literal}