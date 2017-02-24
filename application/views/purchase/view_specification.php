<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(PRODUCT_SPECIFICATION, 'PRODUCT_SPECIFICATION'); ?></h3>
                </div>
            <div class="panel-body">
                <div class="col-lg-12">
                            <form action="<?php base_url().'purchase/view_specification'?>" method="post">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_category_id" class="control-label"><?php echo label_html(CATEGORY, 'CATEGORY');?><span class="text-danger">*</span></label>
                                        <div class="">
                                            <?php echo ap_drop_down(21,NULL,array("selected_value"=>'')); ?>
                                            <?php //echo category_list(@$product_category_id,array('class' => 'product_category_id', 'required' => 'required'));?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_id" class="control-label"><?php echo label_html(PRODUCT, 'PRODUCT');?><span class="text-danger">*</span></label>
                                        <div class="">
                                            <select id="product_id" class="form-control product_id" name="product_id" required="">
                                                <option value = ''>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_model" class="control-label"><?php echo label_html(MODEL, 'MODEL');?><span class="text-danger">*</span></label>
                                        <input id="product_model_id" name="model_name" class="form-control" value="<?php echo @$model_name ?>" autocomplete="off">
                                        <ul class="typeahead dropdown-menu"></ul>
                                    </div>
                                </div>
                                <div class="col-lg-2" id="spac_btn">
                                    <div class="form-group" style="margin-top: 19px;">
                                        <label for="product_model" class="control-label"></label>
                                        <button type="submit" class="btn btn-primary">View</button>
                                    </div>
                                </div>
                                
                                
                            </form>

                </div>
                
            </div>
        </div>
    </div>
    <?php if(!empty($specification_list)){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo label_html(DETAIL_SPECIFICATION, 'DETAIL_SPECIFICATION'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="" class="control-label col-lg-2">Name</label>
                        <div class="col-lg-2">
                            <?php echo $specification_list[0]['product_name'];?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="" class="control-label col-lg-2">Model</label>
                        <div class="col-lg-2">
                            <?php echo $specification_list[0]['product_model_name'];?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <br>
                </div>
                <div class="col-lg-12" style="padding-left: 28px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($specification_list as $val){?>
                            <tr>
                                <td style=""><?php echo $val['specification_type_name'];?></td>
                                <td><?php echo $val['specification_details'];?></td>
                            </tr>  
                            <?php }?>

                        </tbody>
                    </table>
                </div>
				<br>
                <div class="row" style="padding-right: 30px;">
                    <a href="<?php echo base_url().'purchase/product_specification/'.$specification_list[0]['product_category_id'].'/'.$specification_list[0]['product_id'].'/'.$specification_list[0]['model_id'];?>" class="btn btn-primary pull-right">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <?php }else{?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(DETAIL_SPECIFICATION, 'DETAIL_SPECIFICATION'); ?></h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <p class="col-lg-12 text-danger">
                            No Specification for this product.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
        

</div>

<script>
    $(document).on('change','.product_id',function(){
        var product_id = $('.product_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_product_model',
            type: 'POST',
            data: {product_id:product_id},
            success: function (data) {
//                $('#product_model_id').select2('val','');
                $('#product_model_id').html(data);
            }
        });
    });
    $(document).on('change','.product_category_id',function(){
        var product_category_id = $('.product_category_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_products',
            type: 'POST',
            data: {product_category_id:product_category_id},
            success: function (data) {
                $('#product_id').select2('val','');
                $('#product_id').html(data);
            }
        });
    });
    $(document).ready(function(){
        var product_category_id = $('.product_category_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_products',
            type: 'POST',
            data: {product_category_id:product_category_id},
            success: function (data) {
//                $('#product_id').select2('val','');
                $('#product_id').html(data);
                
                var product_id = <?php echo @$porduct_id?$porduct_id:0; ?>;
//        alert(product_id);
                $('.product_id').select2('val',product_id);
            }
        });
		
		if(product_category_id){
            $('.product_category_id').prop('readonly', true);
            $('#product_id').prop('readonly', true);
            $('#product_model_id').prop('readonly', true);
            $('#product_model_id').prop('readonly', true);
            $('#spac_btn').hide();
        }
        
    });
    
    $(document).ready(function() {
     var url  = '<?php echo base_url()."purchase/get_product_model";?>';
//        $( "#product_model_id" ).autocomplete({
//            source: url
//        });
        $('#product_model_id').typeahead({
            ajax: { 
                url: url,
                triggerLength: 1 
              }
        });
    });
    
</script>