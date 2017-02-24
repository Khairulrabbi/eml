<input type="hidden" id="p_id" class="p_id" name="panel_id" value="<?php echo $p_id;?>">

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="overflow: hidden;">
                <span style="margin-right: 20px;float: left;">Search Panel Details</span>
                <span style="float: left; width: 150px;"><?php echo ap_drop_down(1); ?></span>
                <span style="margin-left: 20px; float: left;">
                    <input style="margin-left: 20px;" type="button" id="add" class="btn btn-primary" value="Add" data-toggle="modal" data-target="#myModal">
                </span>
                
            </div>
        </div>
        <div class="panel-body">
            <!-- Modal -->
            <div class="modal fade col-lg-12" id="myModal" role="dialog">
                <div class="modal-dialog" style="width: 800px;">
                    <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Search Panel Item</h4>
                  </div>
                    <div class="modal-body" style="overflow: hidden;">
                    </div>
                </div>
                </div>
            </div>
            
            <div class="search_panel_details_show2">
                
            <?php 
                $data["details_info"] = $details_info;
                $this->load->view("panel_details_view_chield",$data); 
            ?>
            </div>
        </div>
    </div>
</div>

<script>
//    $(document).on("change",".user-success",function(){
//        var value = $('.user-success option:selected').val();
//        alert(value);
//        $.ajax({
//                url: '<?php //echo base_url(); ?>common_controller/search_panel_details',
//                type: 'POST',
//                data: {value:value},
//                success: function() {
//                  
//                }
//            });
//        });
        
       
        $(document).on("click","#add",function(){
            var value = $('.user-success option:selected').val();
//            alert(value);
            var p_id = $('.p_id').val();
//            alert(p_id);
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/search_panel_details',
                type: 'POST',
                data: {value:value,p_id:p_id},
                success: function (data) {
                    $('.modal-body').html(data);
                    $('#show_info').html(data);
//                    $('#one').val(value);
//                    $('#two').val(p_id);
                    $('select').select2();
                    $('#show_info').html(data);
                }
            });
    });
    
    $(document).on("click","#edit",function(){
           var id =$(this).attr('panel_id');
           var field_type_id =$(this).attr('fld_type_id');
           var panel_d_id = $(this).attr('p_d_id');
           var get_value= $("select[name='field_type_id']").val();
           
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/search_panel_details_edit',
                type: 'POST',
                data: {id:id,field_type_id:field_type_id,panel_d_id:panel_d_id},
                success: function (data) {
                    $('.modal-body').html(data);
                    $('#show_info').html(data);
//                    $('#two').val(id);
                    $('select').select2();
                    $('#show_info').html(data);
                }
            });
    });   
 
    
    
    
    $(document).ready(function(){
    $('#spdvaai').DataTable();
});  
</script>



       