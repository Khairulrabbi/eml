<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
        </div>
        <div class="panel-body">
            
            <div class="col-lg-12" style="padding:0;">
                    <div class="col-lg-4" style="margin-bottom:10px;">
                        <div class="form-group">
                            <label for="product_code" class="col-lg-4 control-label">Hierarchy For <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <?php echo approve_for_list('', array('class' => 'approve_for_id','required' => 'required')); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 approval_person_info">
                    <!--here existing list show-->
                </div>
        </div>
    </div>
</div>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"  style="width:75%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create New Step</h4>
        </div>
          <div class="modal-body" style="overflow: hidden;">
          
        </div>
<!--        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>
      
    </div>
  </div>


<script>
    $(document).on("change",".approve_for_id", function () {
        var approve_for_id = $(this).val();
        if(approve_for_id)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>deligation/common_info_approval_persons',
                type: 'POST',
                data:{approve_for_id:approve_for_id},
                success: function (data) {
                   $('.approval_person_info').html(data);
                }
            });
        }
        else
        {
            $('.approval_person_info').html("");
        }
        
     });
     
     
     $(document).on("click",".create_step", function () {
        var approve_for_id = $('.approve_for_id option:selected').val();
        //alert(approve_for_id);
        $.ajax({
            url: '<?php echo base_url(); ?>deligation/open_modal_create_step',
            type: 'POST',
            data:{approve_for_id:approve_for_id},
            success: function (data) {
                $(".modal-body").html(data);
                $('#myModal').modal('show');  
            }
        });             
     });
     
     
     $(document).on("click",".edit_step", function () {
        var approve_for_id = $('.approve_for_id option:selected').val();
        var step_no = $(this).attr("step_number");
        $.ajax({
            url: '<?php echo base_url(); ?>deligation/open_modal_edit_step',
            type: 'POST',
            data:{approve_for_id:approve_for_id,step_no:step_no},
            success: function (data) {
                $(".modal-body").html(data);
                $('#myModal').modal('show');  
            }
        });             
     });
     
     
     
    
    

    $(document).on("click","#save_hirarchy", function (e) {
        e.preventDefault();      
        var obj=[];
        var stepAction = $(".stepAction").val();
        var approveForId = $(".approveForId").val();
        var stepNo = $(".stepNo").val();
        var step_name = $(".step_name").val();
        var same_sort = '';
        if ($(".approve_all_for_step1").is(":checked"))
        {
            same_sort = $(".approve_all_for_step1").val();
        }
        var approve_priority = $(".approve_priority option:selected").val();
        var approve_by = $(".approve_by option:selected").val();
        sort=1;
        $('#enough').find('.jak').each(function(){
            var userid = $(this).find('input[name=user_id]').val();
            var max_limit = $(this).find('input[name=max_limit]').val();
            var limit_type = $(this).find('input[name=limit_type]').val();
            var must_approve = $(this).find('input:checked').val();
            var decline_logic = $(this).find('.decline_logic option:selected').val();
            obj.push({'stepAction':stepAction,'approve_for_id':approveForId,'step_number':stepNo,'step_name':step_name,'same_sort':same_sort,'approve_priority':approve_priority,'manage_by':approve_by,'user_id':userid,'max_limit':max_limit,'limit_type':limit_type,'must_approve':must_approve,'sort_number':sort,'decline_logic':decline_logic});
            sort++;
        });
        
        if(obj.length > 0)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>deligation/save_hirarchy_define',
                type: 'POST',
                data:{obj:obj},
                async: false,
                success: function (data) {
                   if(data == true)
                   {
                        $.ajax({
                            url: '<?php echo base_url(); ?>deligation/common_info_approval_persons',
                            type: 'POST',
                            data:{approve_for_id:approveForId},
                            success: function (data) {
                               $('.approval_person_info').html(data);
                            }
                        });
                        $('#myModal').modal('hide');  
                   }
                }
            });
        }
        else
        {
             var htm ='<div class="invalid alert alert-danger">';
             htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
             htm += 'Star(*) marks field are required.';
             htm +='</div>';
             $('.msg_block').html(htm);
        }
        
    });
    
    $(document).on("click",".stepRemove", function () {
        var approve_for_id = $(this).attr('approve_for_id');
        var stepNumber = $(this).attr("stepNumber");
        $.ajax({
            url: '<?php echo base_url(); ?>deligation/delete_step_number',
            type: 'POST',
            data:{approve_for_id:approve_for_id,stepNumber:stepNumber},
            success: function (data) {
                $.ajax({
                    url: '<?php echo base_url(); ?>deligation/common_info_approval_persons',
                    type: 'POST',
                    data:{approve_for_id:approve_for_id},
                    success: function (data) {
                       $('.approval_person_info').html(data);
                    }
                });  
            }
        });             
     });
     
      $(document).on("click",".UserRemove", function () {
        var approve_for_id = $(this).attr('approve_for_id');
        var stepNumber = $(this).attr("stepNumber");
        var userId = $(this).attr("userId");
        $.ajax({
            url: '<?php echo base_url(); ?>deligation/delete_user_id',
            type: 'POST',
            data:{approve_for_id:approve_for_id,stepNumber:stepNumber,userId:userId},
            success: function (data) {
                $.ajax({
                    url: '<?php echo base_url(); ?>deligation/common_info_approval_persons',
                    type: 'POST',
                    data:{approve_for_id:approve_for_id},
                    success: function (data) {
                       $('.approval_person_info').html(data);
                    }
                });  
            }
        });             
     });
     
     $(document).on("click",".approve_all_for_step1",function(){
        if ($(this).prop("checked"))
        {
            $(this).parent().next(".approve_priority_parrent").show();
        }else{
            $(this).parent().next(".approve_priority_parrent").hide();
            $(this).parent().next().find('#approve_priority').val("").change();
        }
     });
</script>











<style>
    
    fieldset {
    border: 0;
    margin: 0;
    min-width: 0;
    border: 1px solid #ccc;
    padding: 10px;
  }
legend {
  padding: 0!important;
  border: none;
  margin: 0;
  width: auto;
  font-size: 17px;
}
.dtitle tr th{
    border: none !important;
}
</style>

