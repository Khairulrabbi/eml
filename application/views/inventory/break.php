<div class="row">
<?php
$id = $_POST['id'];
for($i=1; $i<=$id; $i++) {
?>   
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php  echo "Product Split"; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"></p></h3>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>
                    <form class="form-horizontal" id="purchase_order" action="" method="post">
                        
                        <div class="col-lg-2">
                           <div class="form-group">
                                <label for="category" class="control-label">Category <span class="text-danger"></span></label>
                                <div class="">
                                   
                                    <?php echo category_list(@$order_info->category_id, array('class' => 'category_id', 'id'=>'cat_id' )); ?>
                                </div>  
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label" >Sub Category<span class="text-danger"></span></label>
                                <div class="">
                                    <?php
                                        echo sub_category_list(@$order_info->product_subcategory_id, array('class'=>'product_subcategory_id', 'id'=>'pro_subcat_id'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label" >Brand<span class="text-danger">*</span></label>
                                <div class="">
                                    <?php 
                                        echo brand_list(@$order_info->product_brand_id, array('class'=>'product_brand_id', 'required'=>'required', 'id'=>'pro_brand_id'));
                                    ?>
                                </div>
                            </div>  
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label" >Serial Numbers<span class="text-danger">*</span></label>
                                <div class="">
                                    <input required type="number" class="form-control sl_number" placeholder="Serial Number" id="sl_number" name="sl_number">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="product_name" class="control-label">Product Name <span class="text-danger">*</span></label>
                                <div class="">
                                    <?php
                                        echo product_list(@$order_info->product_id, array('class'=>'product_id', 'required'=>'required', 'id'=>'pro_id'));
                                    ?>
                                    <!--<input required type="text" class="form-control product_name"  placeholder="Product Name" id="product_name" name="product_name" value="<?php echo @$product_name; ?>">-->
                                </div>
                            </div>
                        </div>
							
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="" class="control-label ">Price(USD) <span class="text-danger">*</span></label>
                                <div class="">
                                    <input required type="number" class="form-control " id="price_usd"  name="price_usd" value="<?php echo@$price_usd; ?>" >
                                </div>
                            </div>
                        </div>
							
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="" class="control-label ">Price(BDT) <span class="text-danger">*</span></label>
                                <div class="">
                                    <input required type="number" class="form-control " id="price"  name="price" value="<?php echo@$price; ?>" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row"></div>
                        
                        <div style="padding-right: 15px;">
                            <input id="save_product" class="btn btn-primary pull-right save_product" type="button" value="Save Product">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    

<?php
}
?>
</div> 
