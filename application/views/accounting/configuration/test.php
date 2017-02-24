<table class="table table-bordered" id="dataTables-example">
    <thead>
        <tr>
            <td>Name</td>
        </tr>
    </thead>
    <tbody>
        <?php
        //print_r($table_data);
        foreach($table_data as $value){
            $tr = '<tr>';
            $tr .= '<td class="closemodal" data-id="'.$value[$table_name.'_id'].'">'.$value[$table_name.'_name'].'</td>';
            $tr .= '</tr>';
            echo $tr;
        } ?>
    </tbody>
</table>
<script>
$('#dataTables-example').dataTable({
    responsive: true,
    "aaSorting": []
});
</script>