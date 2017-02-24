<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
        </div>
        <div class="panel-body">
            <div class="text-center order_block"></div>
            <form class="form-horizontal" id="approve_privilege" action="" method="post">
                <div class="col-lg-4" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label for="" class="col-lg-4 control-label">Approve For <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <?php 
                            $dd_data['selected_value'] =@$token_info->product_code;
                            $dd_data['extra_attr'] =array('class' => 'approve_for_id',''=>'');
                            echo ap_drop_down(32,NULL,$dd_data) 
                            ?>
                            <?php //echo approve_for_list(@$token_info->product_code, array('class' => 'approve_for_id',''=>'')); ?>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-12 user_list_area ">
                    <div class="col-lg-6 " style="margin-left: 5px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Search by</h3>
                            </div>
                            <div class="panel-body">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Level</label>
                                    <div class="col-lg-8">
                                       <?php 
                                        $dd_data['extra_attr'] =array('class'=>'user_level_id',''=>'');
                                        echo ap_drop_down(2,NULL,$dd_data);
                                        ?>
                                    <?php //echo user_level('',array('class'=>'user_level_id',''=>'')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Department</label>
                                    <div class="col-lg-8">
                                    <?php echo user_department('', array('class' => 'user_department_id'),'user_id'); ?>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Designation</label>
                                    <div class="col-lg-8">
                                    <?php echo user_designation('', array('class' => 'user_designation_id'),'user_id'); ?>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">User</label>
                                    <div class="col-lg-8">
                                    <?php echo user('', array('class' => 'user_id',''=>'')); ?>
                                    </div>    
                                </div>
                            </div>
                        </div>
                                <input type="button" id="approve_privilege_search" class="btn large btn-primary pull-right" style="margin-top: 8px;margin-right: 40px;" value="Search"></button>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">User List</h3>
                            </div>
                            <div class="panel-body">
                        <div class="col-lg-12 user_list">
                            <table class="table" id="tb">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Lavel</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                foreach ($user_list->result() as $k=>$v)
                                { ?>
                                    <tr>
                                        <td><input class="eul" type="checkbox" value="<?= $v->user_id;?>">&nbsp; <?= $v->username; ?></td>
                                        <td><?= $v->user_level_name; ?></td>
                                        <td><?= $v->department_name; ?></td>
                                        <td><?= $v->designation_name; ?></td>
                                    </tr>
                                <?php }
                            ?>
                                </tbody>
                                    <input type="hidden" class="check_value" value="">
                            </table>
                        </div> 
                                </div>
                        </div>
                    </div>
                    
                    <div class="move_button" style="position: absolute; top: 50%; left: 49%; cursor: pointer; background: #ccc; padding: 6px; border-radius: 4px; margin-left: 25px;"><span class="glyphicon">&#xe076;</span></div>
                   
                    <div class="col-lg-5" style="margin-left:60px;">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Current List</h3>
                            </div>
                            <div class="panel-body">
                    <div class="col-lg-12 " style="margin-left: 15px;">
                        
                        <table class="table current_list">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Maximum Amount</th>
                                    <th>Avobe</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="check_list_user" id="current_list">
                                    
                            </tbody>
                        </table>
                    </div>
                            </div>
                    </div>
                        </div>
                         
                </div>
                
                
                <div class="row "></div>
                <div style="padding-right: 15px;">
                    <input type="submit" id="save_approve_privilege"class="btn large btn-primary pull-right" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#tb').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "bFilter" : false
    });
} );

    $(document).on('click','.move_button',function(){
        var check_value = $('.check_value').val();
        var check_value_array = check_value.split(",");
        $('.existing_user').each(function(){
            var eu = $(this).val();
            var index = check_value_array.indexOf(eu);
            if(index > -1)
            {
                check_value_array.splice(index, 1);
                check_value = check_value_array.toString();
            }
        });
        $.ajax({
            url: '<?php echo base_url(); ?>deligation/approval_persons',
            type: 'POST',
            data: {check_value:check_value},
            success: function (data) {
                $('.check_list_user').append(data); 
                serial();
            }
        });
        
    });
    function serial()
    {
        count = 1;
        $('.cl_serial').each(function(){
            $(this).text(count);
            count++;
        });
    }
    function updateTextArea() {         
        var allVals = [];
        $('.eul:checked').each(function() {
          allVals.push($(this).val());
        });
        $('.check_value').val(allVals);
    }
    $(function() {
      $('.user_list input').click(updateTextArea);
      updateTextArea();
    });
    
    
    $(document).on("click", "#save_approve_privilege", function (e) {
        e.preventDefault();
        var approve_for_id = $('.approve_for_id option:selected').val(); 
        //alert(approve_for_id);
        if(approve_for_id){
           
            $.ajax({
                url: '<?php echo base_url(); ?>deligation/save_approve_for',
                type: 'POST',
                data: $("#approve_privilege").serialize(),
                success: function (data) {
                   var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Successfully Saved.';
                        htm +='</div>';
                        $('.order_block').html(htm);
                }
            });
        }
        else
        {
            var htm ='<div class="invalid alert alert-danger">';
             htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
             htm += 'Star(*) marks field are required.';
             htm +='</div>';
             $('.order_block').html(htm);
        }
    });
    
    
    $(document).on('change','.approve_for_id',function(){
        //var t = $(this);
        var approve_for_id = $(this).val();
        //alert(approve_for_id);
        if(approve_for_id)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>deligation/get_current_list_by_approve_for_id',
                 type: 'POST',
                 data: {approve_for_id:approve_for_id},
                 success: function (data) {
                     $("#current_list").html(data);
                     var existing_user_list_hidden = $('.existing_user_list_hidden').val();
                     var eulh = existing_user_list_hidden.split(",");
                     $('.check_value').val('');
                     $(".eul").each(function(){
                         var user_id = $(this).val();
                         if($.inArray(user_id,eulh) != -1)
                         {
                             $(this).prop("checked",false);
                             $(this).attr('disabled',true);
                         }
                         else
                         {
                             $(this).attr('disabled',false);
                         }
                     });
                     //$('.check_value').val(existing_user_list_hidden);
                 }
            }) ;
            
        }
                
    });
    
    
    $(document).on("click", ".ex_u_remove", function (e) {
        e.preventDefault(); 
        
        var t = $(this);
        var flag = $(this).attr("flag");
        var user_id1 = $(this).attr("user_id");
        var url = $(this).attr("href");
        if(flag == 'existing')
        {
            $.ajax({
                url: url,
                type: 'POST',
                data: {flag:flag},
                success: function (data) {
                   if(data == true)
                   {
                       t.closest("tr").remove();
                       serial();
                       $(".eul").each(function(){
                            var user_id2 = $(this).val();
                            if(user_id1 == user_id2)
                            {
                                $(this).attr('disabled',false);
                            }
                        });
                   }
                }
            });
        }
        else
        {
            t.closest("tr").remove();
            serial();
            
            $(".eul").each(function(){
                var user_id2 = $(this).val();
                if(user_id1 == user_id2)
                {
                     $(this).prop("checked",false);
                }
            });
            updateTextArea();
        }
               
    });
    
    
    
    $(document).on("click", "#approve_privilege_search", function (e) {
        e.preventDefault();
        var user_level_id = $('.user_level_id option:selected').val(); 
        var user_department_id = $('.user_department_id option:selected').val(); 
        var user_designation_id = $('.user_designation_id option:selected').val(); 
        var user_id = $('.user_id option:selected').val();        
            $.ajax({
                url: '<?php echo base_url(); ?>deligation/search_user_list',
                type: 'POST',
                data: {user_level_id:user_level_id,user_department_id:user_department_id,user_designation_id:user_designation_id,user_id:user_id},
                success: function (data) {
                   $("#tb tbody").html(data);
                }
            });   
    });
    
    
    
</script>
<style>
    .user_list_area{
        border: 1px solid #ccc;
        margin-bottom: 7px;
        padding: 12px 0;
    }
</style>
  