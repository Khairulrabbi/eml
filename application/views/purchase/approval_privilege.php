
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo "Approval Privileges"; ?> <p class="pull-right text-danger " style="font-size: 16px; font-style: oblique;padding-right: 24px"></p></h3>
            </div>
            <div class="panel-body">
                <div class="text-center order_block"></div> 
                <form class="form-horizontal" id="approval_privilege_id" action="<?php echo base_url().'purchase/privileges_approval'?>" method="post">
                    <div class="col-lg-4">
                        
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">User Level <span class="text-danger">*</span></label>
                            <?php
                                    echo user_level($user_level_id, array('class'=>'user_level_id col-lg-7', 'required'=>'required'));
                             ?>
                            <input class="col-lg-2 btn btn-primary btn-sm" type="submit" name="user_level_search" value="Search" id="user_search_id">
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>     
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
         <div class="panel panel-default">
             <div class="panel-body">
                <form class="form-horizontal" id="previlege_for_approval_id" action="<?php echo base_url().'purchase/privilege_approval_save'?>" method="post"  >
                    <input type="hidden" name="user_level_id"  value="<?php echo $user_level_id?>">
                    <div class="col-lg-12">
                    <div class="form-group">
                    <?php 
                    if(isset($user_list)) {
                        foreach($user_list as $user) {
                    ?>
                    <!--<div class="row">-->
                      <div class="col-lg-2">
                        <div class="input-group">
                          <span class="input-group-addon">

                              <input type="checkbox" <?php echo $user['available'] == null? '':'checked';?>  name="userid[]" id="userid" class="chk" value="<?php echo $user['user_id']?>">
                          </span>
                          <input type="text" class="form-control"  value="<?php echo ($user['first_name'].' '.$user['last_name']); ?>"> 
                        </div><!-- /input-group -->
                      </div> 
                    <?php
                    }
                    ?>
                <?php
                     }
                ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                <script>
                $(".chk").click(function(){
                   var userid = $(this).val();
                   var flag;
                   if($(this).is(':checked')){
                       flag = 'insert';
                   } else {
                       flag = 'delete';
                   }
                   
//                   alert($(this).is(':checked'));
                   
                   $.ajax({
                      type: "POST",
                      url: '<?php echo base_url(); ?>purchase/delete_approval_privilige',
                      data: {userid: userid, flag:flag},
                      success: function (data) {
                          
                      }
                   });
                });
                </script>
