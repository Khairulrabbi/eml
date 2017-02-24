<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo "Defined Delegation"; ?> <p class="pull-right text-danger " style="font-size: 16px; font-style: oblique;padding-right: 24px"></p></h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="text-center order_block"></div> 
                    <form class="form-horizontal" id="defined_delegation_id" action="" method="post">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="" class="col-lg-3 control-label">User Level <span class="text-danger">*</span></label>
                                <?php
                                $user_level_id = '';
                                        echo user_level($user_level_id, array('class'=>'user_level_id col-lg-9', 'required'=>'required', 'id'=>'u_level_id'));
                                 ?>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-lg-3 control-label">User<span class="text-danger">*</span></label>
                                <?php
                                $user_id = '';
                                echo user( $user_id, array('class'=>'user_id col-lg-9', 'required'=>'required', 'id'=>'u_id', 'value'=>$user_id) );
                                ?>
                            </div>
                            <button type="button" id="user_add_id" class="col-lg-2 btn btn-primary btn-sm" style="float: right" name="add_user_delegation">Add</button>
                        </div>

                        <div class="col-lg-1">
                        </div>
                        <!--

                        <div class="col-lg-4">

                        </div>-->

                    </form>
                </div>
                
                <div class="col-lg-6">
                    <form class="form-horizontal" id="user_lists_id" action="<?php echo base_url().'purchase/add_define_delegation'?>" method="post">
                         <button type="button" id="user_list_id" class="col-lg-2 btn btn-primary"  name="show_user_list">List</button><br><br>
                        <div class="form-group">
                            <div id="div2"></div>
                        </div>
                    </form>
                    
                </div>
           </div>
        </div>     
    </div>
</div>

<!--<div id="div2"></div>-->
<div id="div3"></div>


<script>
    $('#user_add_id').click(function() {
//        var u_level_id = $("#u_level_id").val();
        var u_id = $(".user_id :selected").val();
        $.ajax({
           type: 'POST',
           url: '<?php echo base_url();?>purchase/add_define_delegation',
           data: { u_id: u_id },
           success: function(data) {
//               $('#div2').html(data);
//           alert(data);
           }
        });
    });
</script>

<script>
    $('#user_list_id').click(function() {
        $.ajax({
           type: 'POST',
           url: '<?php echo base_url();?>purchase/add_define_delegation',
           success: function(result) {
               $('#div2').html(result);
           }
        });
    });
</script>

