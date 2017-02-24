<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Product Specification</h3>
                </div>
            <div class="panel-body">
                <div class="col-lg-12">
                            <form action="<?php base_url().'purchase/product_specification'?>" method="post">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_category_id" class="control-label">Category<span class="text-danger">*</span></label>
                                        
                                        <?php echo category_list(@$product_category_id,array('class' => 'product_category_id', 'required' => 'required'));?>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_id" class="control-label">Product<span class="text-danger">*</span></label>
                                        
                                        <select id="product_id" class="form-control product_id" name="product_id" required="">
                                            <option value = ''>Select</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_model" class="control-label">Model<span class="text-danger">*</span></label>
                                        <input id="product_model_id" name="model_name" class="form-control" value="<?php echo @$model_name ?>" autocomplete="off">
                                        <ul class="typeahead dropdown-menu"></ul>
                                    </div>
                                </div>
                                <div class="col-lg-2" id="spac_btn">
                                    <div class="form-group" style="margin-top: 19px;">
                                        <label for="product_model" class="control-label"></label>
                                        <a id="spec" class="btn btn-primary">
                                            Specification
                                        </a>
                                    </div>
                                </div>
                                
                                
                                <div class="row"></div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12 spec_list">
                                        <?php echo @$model_specification_list;?>
                                    </div>
                                </div>
                                
                                
                                <br>
                                
                            </form>

                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
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
    $('#spec').on('click',function(){
        var product_category_id = $('.product_category_id option:selected').val();
        var product_id = $('.product_id option:selected').val();
        var model_name = $('#product_model_id').val();
        
        if(product_category_id && product_id && model_name){
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/get_specification_list',
                type: 'POST',
                data: {product_category_id:product_category_id,product_id:product_id,model_name:model_name},
                success: function (data) {
    //                alert(data);
                    $('.spec_list').html(data);
                }
            });
        }else{
            alert('Please Select ');
        }
        
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