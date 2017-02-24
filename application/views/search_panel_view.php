<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="overflow: hidden;">
            <?php echo "Search Panel"; ?>
        </div>
        <div class="panel-body">
            <div class="col-lg-4">
                        <form class="form-horizontal" id="create_panel" action="" method="post">
                            <?php
                            if($id){ ?>
                                <input type="hidden" class="panel_id" name="panel_id" value="<?php echo $id; ?>">
                            <?php } ?>
                            <div class="col-lg-12">
                                <div class="form-group" >
                                    <label for="" class="col-lg-2 control-label"><?php echo "Panel Name"; ?></label>
                                    <div class="col-lg-7 col-lg-offset-2">
                                        <input type="text" class="form-control name" placeholder="Panel Name" name="panel_name" id="panel_name" style="margin-bottom: 10px;" value="<?php echo @$info->panel_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-2 control-label"><?php echo "Title";?></label>
                                    <div class="col-lg-7 col-lg-offset-2">
                                        <input type="text" class="form-control name" placeholder="" name="panel_title" id="panel_title" style="margin-bottom: 10px;" value="<?php echo @$info->panel_title; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-2 control-label"><?php echo "Sub Title" ; ?> </label>
                                    <div class="col-lg-7 col-lg-offset-2">
                                        <input type="text" class="form-control id_field" placeholder=""  name="panel_subtitle" id="panel_subtitle" style="margin-bottom: 10px;" value="<?php echo @$info->panel_subtitle; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-lg-2 control-label"><?php echo "Description";?></label>
                                    <div class="col-lg-7 col-lg-offset-2">
                                        <textarea class="form-control description" rows="1" id="description" name="description" style="margin-bottom: 10px;"><?php echo @$info->description; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-2 control-label">Status</label>
                                    <div class="col-lg-7 col-lg-offset-2">
                                        <select class="dropdown" name="status">
                                            <?php foreach ($panel_status as $k=>$v) {?>
                                            <option <?php echo ((@$v->status=='$v')?"selected='selected'":"") ?> value="<?php echo $v; ?>"><?php echo $v; ?> </option>
                                            <?php } ?>                              
                                      </select> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="datashow">
                            <?php echo $this->load->view("search_panel_ajax_view"); ?>
                        </div>
                    </div>
        </div>
        <div style="margin-left: 300px; margin-bottom: 10px;">
            <?php if(!empty($info->panel_id)){ ?>
             <input type="button" id="update"class="btn btn-primary" value="Update">
        <?php }else{ ?>
            <input type="button" id="save"class="btn btn-primary" value="Save">
        <?php } ?>
            
            
            <input type="button" id="reset" class="btn btn-primary" value="Reset">
        </div>
        <div class="text-center order_block"></div>
    </div>
</div>


<div class="text-center order_block_modal_data"></div>
<div id="panel"></div>
                


<script>
    $(document).on("click","#save",function(){
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/search_panel_ajax',
                type: 'POST',
                data: $("#create_panel").serialize(),
                success: function (data) {
                    try {
                        var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Dropdown Info successfully saved.';
                        htm +='</div>';
                        $('.order_block').html(htm);
                        $('.order_block').delay(1000).fadeOut();
                    } catch(e) {
                        var htm ='<div class="invalid alert alert-danger">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += data;
                        htm +='</div>';
                       $('.order_block').html(htm);
                    }
                    $('.datashow').html(data);
                }
            });
        
        
    });
    $(document).on("click","#update",function(){
       
            $.ajax({
                    url: '<?php echo base_url(); ?>common_controller/search_panel_ajax/',
                    type: 'POST',
                    data: $("#create_panel").serialize(),
                    Async:false,
                    success: function (data) {
                        try {
                            var htm ='<div class="invalid alert alert-success">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'Update Success.';
                            htm +='</div>';
                            $('.order_block').html(htm);
                            $('.order_block').delay(1000).fadeOut();
                        } catch(e) {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += data;
                            htm +='</div>';
                           $('.order_block').html(htm);
                        }  
                        $('.datashow').html(data);
                       
                    }
                });
        });
    
    $(document).on("click","#reset",function(){
    $("#create_panel")[0].reset();
    });
    
    
     $(document).on("click","#save_form",function(){
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/search_panel_details_ajax',
                type: 'POST',
                data: $("#details_info_save").serialize(),
                success: function (data) {
                    var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Dropdown Info successfully saved.';
                        htm +='</div>';
                        $('.order_block_modal_data').html(htm);
                        $('.order_block_modal_data').delay(1000).fadeOut();
                        
                        $(".search_panel_details_show2").load("<?php echo base_url(); ?>common_controller/search_panel_info1");
                }
            });
    });
    
    
    $(document).on("click","#update_form",function(){
    var $i = $('#get_p_d_id').val();
            $.ajax({
                    url: '<?php echo base_url(); ?>common_controller/search_panel_details_ajax/'+$i,
                    type: 'POST',
                    data: $("#details_info_save").serialize(),
                    Async:false,
                    success: function (data) {
                        try {
                            var htm ='<div class="invalid alert alert-success">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'Update Success.';
                            htm +='</div>';
                            $('.order_block').html(htm);
                            $('.order_block').delay(1000).fadeOut();
                            $(".search_panel_details_show2").load("<?php echo base_url(); ?>common_controller/search_panel_info1");
                        } catch(e) {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += data;
                            htm +='</div>';
                           $('.order_block').html(htm);
                        }  
                        
                    }
                });
        });
   
   
   
   $(document).on("click",".dlt_info",function(){
            //alert();
           var panel_d_id = $(this).attr('p_d_id');
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/details_delete',
                type: 'POST',
                data: {panel_d_id:panel_d_id},
                success: function (data) {
                    $('.modal-body').html(data);
                    $('#show_info').html(data);
                    $(".search_panel_details_show2").load("<?php echo base_url(); ?>common_controller/search_panel_info1");
                }
            });
    }); 
    
</script>


