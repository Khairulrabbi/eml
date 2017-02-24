<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(PRODUCT_SPECIFICATION, 'PRODUCT_SPECIFICATION')?></h3>
                </div>
            <div class="panel-body">
                <div class="col-lg-12">
                        <form action="" method="post" id="sp_submit">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_id" class="control-label"><?php echo label_html(PRODUCT, 'PRODUCT')?><span class="text-danger">*</span></label>
                                        <?php echo ap_drop_down(14,NULL,array("selected_value"=>$porduct_id)); ?>
                                            <?php //echo product_list(@$porduct_id,array('class' => 'product_id', 'required' => 'required'));?>                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_model" class="control-label"><?php echo label_html(MODEL, 'MODEL')?><span class="text-danger">*</span><span class="new_model_type">New Model</span></label>
                                        <div class="product_model_area">
<!--                                            <select id="model_id" class="form-control model_id" name="model_id" required="">
                                                <option value = ''>Select Model</option>
                                            </select>-->
                                            <?php echo ap_drop_down(15,NULL,array("selected_value"=>$model_id)); ?>
                                            <?php // echo model_list(@$model_id,array('class' => 'model_id', 'required' => 'required'));?> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2" id="product_des">
                                    <div class="form-group">
                                        <label for="" class="control-label"><?php echo label_html(MODEL_DESCRIPTION, 'MODEL_DESCRIPTION')?></label>
                                        <textarea name="model_des" class="form-control"><?php echo @$model_des; ?></textarea>
                                    </div>
                                </div>
                                
                                
                                <div class="row"></div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                            if(isset($_GET['r']))
                                            {?>
                                                <div class="col-lg-6 alert alert-success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong>Success!</strong>.
                                                </div>
                                            <?php }
                                        ?>
                                    </div>
                                    <div class="col-lg-12 spec_list">
                                        <?php echo @$model_specification_list;?>
                                    </div>
                                </div>
                            </form>

                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    $(document).on('change','.product_id',function(){
        var product_id = $('.product_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_product_model_with_id',
            type: 'POST',
            data: {product_id:product_id},
            success: function (data) {
                if(data == 1)
                {
                    $('.product_model_area').html('<input type="text" placeholder="New Model" class="form-control new_model" name="product_model_name" value="">');
                    $('#product_des').show();
                    $('.spec_list').html('');
                }
                else
                {
                    $('#model_id').select2('val','');
                    $('.product_model_area').html(data);
                }
            }
        });
    });
    
    $(document).on('blur','.new_model',function(){
        var modal_val = $('.new_model').val();
        if(modal_val)
        {
            var product_id = 0;
            var model_name = '';
            spec_list_ajax(product_id,model_name,'new');
        }        
    });
    $(document).on('change','.model_id',function(){
        var product_id = $('.product_id option:selected').val();
        var model_name = $('.model_id option:selected').val();
        //alert(model_name);
        if(product_id && model_name){
            spec_list_ajax(product_id,model_name,'old');
        }else{
            alert('Please Select ');
        }
        
    });
    
    function spec_list_ajax(product_id,model_name,type)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_specification_list',
            type: 'POST',
            data: {product_id:product_id,model_name:model_name,type:type},
            success: function (data) {
                $('.spec_list').html(data);
            }
        });
    }
    
    
    $(document).on('click','.sp_submit',function(e){
        e.preventDefault();
        var product_id = $('.product_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/sp_submit',
            type: 'POST',
            data: $('#sp_submit').serialize(),
            success: function (data) {
                window.location.href = base_url+"purchase/product_specification/"+product_id+"/"+data+"/?r=s";
            }
        });
    });
    
    
    $(document).on('click','.yesno',function(e){
        e.preventDefault();
        var yesnoval = $(this).val();
        $(this).parent().find(".specification_type_id").val(yesnoval);
    });
    
   
    $('.new_model_type').click(function() { 
        $('.product_model_area').html('<input placeholder="New Model" type="text" class="form-control new_model" name="product_model_name" value="">');
    });
</script>

<style>
    .new_model_type {
    color: #f00;
    cursor: pointer;
    left: 80px;
    position: relative;
  }
</style>