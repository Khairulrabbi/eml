
<table class="table table-striped dataTable" id="sort">
    <thead>
        <tr>
            <th>Item Title</th>
            <th>Field Type Id</th>
            <th>Item Comma Separated</th>
            <th>Field Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details_info as $k=>$v){ ?>
        <tr style="cursor: move;">
            <td><?php echo $v['item_title']; ?></td>
            <td><?php echo $v['field_type_id']; ?></td>
            <td><?php echo $v['item_comma_separated']; ?></td>
            <td><?php echo $v['field_name']; ?></td>
            <td><?php echo $v['description']; ?></td>
            
        </tr>
        <?php } ?>
    </tbody>
    
</table>
     
<script>
    
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

    $("#sort tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
    
$(document).ready(function(){
    $('.spdvaai').DataTable();
});   
</script>
