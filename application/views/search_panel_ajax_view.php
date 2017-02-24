<table class="table table-striped table-bordered table-hover dataTable no-footer panel_tb">
    <thead>
        <tr>
            <th><?php echo label_html(SL, 'SL'); ?></th>
            <th><?php echo "Panel Name"; ?></th>
            <th><?php echo "Panel Title"; ?></th>
            <th><?php echo "Created By"; ?></th>
            <th><?php echo "Action"; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
            foreach ($panel_info as $key => $value) { ?>
                <tr>
                    <td><?php echo $i++; ?> </td>
                    <td><?php echo $value['panel_name']; ?></td>
                    <td><?php echo $value['panel_title']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <td>
                        <a href="<?php echo base_url() ?>common_controller/search_panel/<?php echo $value['panel_id']; ?>" class="glyphicon glyphicon-pencil"></a>
                        <a class="panel view" href=""  pnl_id="<?php  echo $value['panel_id'];?>">
                            <i class="fa fa-eye" ></i>
                        </a>
                    </td>
                </tr>    
            <?php } ?>
    </tbody>
</table>
<script>
$(document).on("click",'.view', function (e) {
        e.preventDefault();
       var panel_id = $(this).attr('pnl_id');
       
        $.ajax({
                url: '<?php echo base_url(); ?>common_controller/panel_details/'+panel_id,
                type: 'POST',
                data: {panel_id:panel_id },
                success: function (data) {
                    $('#panel').html(data);
                    $('select').select2();
                } 
        });
    });  
    
    
$(document).ready(function(){
    $('.panel_tb').DataTable();
});   
</script>