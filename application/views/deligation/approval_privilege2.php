<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
        </div>
        <div class="panel-body">
            <div class="text-center order_block"></div>
            <form class="form-horizontal" id="approve_privilege" action="" method="post">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="col-lg-4 control-label">Approve For <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <?php echo approve_for_list(@$token_info->product_code, array('class' => 'approve_for_id',''=>'')); ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 user_list_area">
                    <div class="col-lg-6 user_list_area" style="margin-left: 5px;">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Level</label>
                                    <div class="col-lg-8">
                                    <?php echo user_level('', array('class' => 'user_level_id',''=>'')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Department</label>
                                    <div class="col-lg-8">
                                    <?php echo user_department('', array('class' => 'user_department_id',''=>'')); ?>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Designation</label>
                                    <div class="col-lg-8">
                                    <?php echo user_designation('', array('class' => 'user_designation_id',''=>'')); ?>
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
                        
                        <div class="col-lg-12 user_list">
                            <table class="table">
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
                                        <td><input type="checkbox" value="<?= $v->user_id;?>">&nbsp; <?= $v->username; ?></td>
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
                    
                    <div class="move_button" style="position: absolute; top: 50%; left: 49%; cursor: pointer; background: #ccc; padding: 6px; border-radius: 4px; margin-left: 25px;"><span class="glyphicon">&#xe076;</span></div>
                    <div class="col-lg-5 user_list_area" style="margin-left: 50px;">
                        <h3>Current List</h3>
                        <table class="table current_list">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Maximum Amount</th>
                                    <th>Avobe</th>
                                </tr>
                            </thead>
                            <tbody class="check_list_user">
<!--                                <tr>
                                    <td>1</td>
                                    <td>Jakir</td>
                                    <td><input type="text" value="100,000"></td>
                                    <td><input type="text" value="200,000"></td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                <div class="row "></div>
                <div style="padding-right: 15px;">
                    <input type="submit" id="save_approve_privilege"class="btn btn-primary pull-right" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('click','.move_button',function(){
        var check_value = $('.check_value').val();
        $.ajax({
            url: '<?php echo base_url(); ?>deligation/approval_persons',
            type: 'POST',
            data: {check_value:check_value},
            success: function (data) {
                $('.check_list_user').html(data);
            }
        });
        
    });
    function updateTextArea() {         
        var allVals = [];
        $('.user_list :checked').each(function() {
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
        
        if(approve_for_id)
        {
            $.ajax({
            url: '<?php echo base_url(); ?>deligation/save_approve_for',
            type: 'POST',
            data: $("#approve_privilege").serialize(),
            success: function (data) {
                if(data == true)
                   {
                        var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Successfully Saved.';
                        htm +='</div>';
                        $('.order_block').html(htm);
                   }
//               alert(data);
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
    
    
</script>
<style>
    .user_list_area{
        border: 1px solid #ccc;
        margin-bottom: 7px;
        padding: 12px 0;
    }
</style>
  