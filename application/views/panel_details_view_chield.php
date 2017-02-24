


<table class="table table-striped dataTable spdv" id="sort">
    <thead>
        <tr>
            <th>Item Title</th>
            <th>Field Type Id</th>
            <th>Item Comma Separated</th>
            <th>Field Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details_info as $k=>$v){ ?>
        <tr style="cursor: move;" panel_d_id="<?php echo $v['panel_details_id']; ?>">
            <td><?php echo $v['item_title']; ?></td>
            <td><?php echo $v['field_type_id']; ?></td>
            <td><?php echo $v['item_comma_separated']; ?></td>
            <td><?php echo $v['field_name']; ?></td>
            <td><?php echo $v['description']; ?></td>
            <td>
                
                <input style="margin-left: 20px;" type="button" id="edit" class="btn btn-primary" value="Edit" fld_type_id="<?php echo $v['field_type_id']; ?>" panel_id="<?php echo $v['panel_id']; ?>" p_d_id="<?php echo $v['panel_details_id']; ?>" data-toggle="modal" data-target="#myModal">
                <input type="button" class="btn btn-danger dlt_info" value="Delete" p_d_id="<?php echo $v['panel_details_id']; ?>">
            </td>
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
        
        var p =($.map($(this).find('tr'), function(el) {
                return $(el).attr("panel_d_id")+"_"+$(el).index();
            }));

            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/panel_list_ordering',
                type: "POST",
                data: {sort:p},
                success: function(feedback){
                    // $("#test").html(feedback);
                }
            });
            
            
            
            
    };

    $("#sort tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
    
    
    
$(document).ready(function(){
    $('.spdv').DataTable();
});  
</script>