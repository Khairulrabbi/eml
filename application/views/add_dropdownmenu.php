
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="overflow: hidden;">
            <?php echo "Dropdown List Create"; ?>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" id="dropdown_info" action="" method="post">
                <?php
                 if($id){ ?>
                     <input type="hidden" class="dropdown_id" name="dd_id" value="<?php echo $id; ?>">
                 <?php } ?>
                
                <div class="col-lg-6">
                    <div class="form-group" >
                        <label for="" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <input type="text" class="form-control name" placeholder="Dropdown Name" name="dd_name" id="name" style="margin-bottom: 10px;" value="<?php echo @$info->dd_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label"><?php echo "Details";?></label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <textarea class="form-control details" rows="2" id="details" name="details" style="margin-bottom: 10px;"><?php echo @$info->details; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label"><?php echo "Option ID-Field" ; ?> </label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <input type="text" class="form-control id_field" placeholder=""  name="option_id" id="id_field" value="<?php echo @$info->option_id; ?>"  style="margin-bottom: 10px;">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label"><?php echo "Option Value-Field" ; ?> </label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <input type="text" class="form-control option_value" placeholder=""  name="option_value" id="option_value" value="<?php echo @$info->option_value; ?>"  style="margin-bottom: 10px;">
                            <p class="pull-right"><span class="danger">*</span>Which Field You want to add as option value</p>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Select Type</label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <select class="dropdown" name="multiselect">
                                <option <?php echo ((@$info->multiselect==0)?"selected='selected'":"") ?> value="0">Single Select</option>
                                <option <?php echo ((@$info->multiselect==1)?"selected='selected'":"") ?> value="1">Multiple Select</option>                               
                          </select> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Select Status</label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <select class="dropdown" name="status">
                                <?php foreach ($dropdown_status as $k=>$v) {?>
                                <option <?php echo ((@$v->status=='$v')?"selected='selected'":"") ?> value="<?php echo $v; ?>"><?php echo $v; ?> </option>
                                <?php  }  ?>                              
                          </select> 
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label"><?php echo "HTML Tag Id" ; ?> </label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <input type="text" class="form-control field_id" placeholder=""  name="field_id" id="field_id" value="<?php echo @$info->field_id; ?>"  style="margin-bottom: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label"><?php echo "HTML Tag Name" ; ?> </label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <input type="text" class="form-control field_name" placeholder=""  name="field_name" id="field_name" value="<?php echo @$info->field_name; ?>"  style="margin-bottom: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Option Concat</label>
                        <div class="col-lg-7 col-lg-offset-2">
                            <input type="text" class="form-control concat_item" placeholder=""   id="concat_item" name="concat_item" value="<?php echo @$info->concat_item; ?>" style="margin-bottom: 10px;">
                            <p class="pull-right"><span class="danger">*</span>Comma Separate field name if you want to concat any value.</p> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-1 control-label">Query</label>
                        <div class="col-lg-8 ">
                            <textarea class="form-control query" rows="4" id="query" name="query" style="height: 140px; width: 550px;"><?php echo @$info->query; ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    <div style="margin-left: 600px; margin-bottom: 10px;">
        <?php if(!empty($info->dd_id)){ ?>
             <input type="button" id="update"class="btn btn-primary" value="Update">
        <?php }else{ ?>
            <input type="button" id="save"class="btn btn-primary" value="Save">
        <?php } ?>
       
        <input type="button" id="reset" class="btn btn-primary" value="Reset">
    </div>
    <div class="text-center order_block"></div>
    
    
    <div class="panel panel-default">
        <div class="panel-heading"  style="overflow: hidden;">
            <?php echo "Dropdown List View" ?>
        </div>
        <div class="panel-body">
            <div class="datashow"><?php echo $this->load->view("dropdown_info_ajax_view"); ?></div>
            
        </div> <!--Panel body close -->
    </div> <!--Panel div close -->
</div>

<script>
    
   
    $(document).on("click","#save",function(){
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/add_dropdownmenu_ajax',
                type: 'POST',
                data: $("#dropdown_info").serialize(),
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
                    url: '<?php echo base_url(); ?>common_controller/add_dropdownmenu_ajax/',
                    type: 'POST',
                    data: $("#dropdown_info").serialize(),
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
    $("#dropdown_info")[0].reset();
    });
    
    
</script>


