
<?php
// print_r($product);
// echo '<br><br>';
// echo $product[0]['service_tag'];
// echo '<br>';
// echo $product[0]['purchase_date'];

?>

<div class="row">
    <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Product Split"; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"></p></h3>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>

                    <form class="form-horizontal" id="purchase_order" action="" method="post">

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="product_name" class=" control-label">Product Name <span class="text-danger">*</span></label>
                                <div class="">
                                    <?php //debug($product[0],1); ?>
                                    <input type="hidden" id="exchange_rate" value="<?php  echo $product[0]['exchange_rate']; ?>">
                                    <input type="hidden" id="hid_product_code" value="<?php  echo $product[0]['product_code']; ?>">
                                    <input required type="text" class="form-control product_name"   id="product_name" name="product_name" value="<?php echo $product[0]['product_name']; ?>">
                                </div>
                            </div>
                        </div>
                         
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label ">Service Tag <span class="text-danger">*</span></label>
                                <div class="">
                                    <input  type="number" class="form-control " id="service_tag" placeholder="Service Tag" name="service_tag" value="<?php echo $product[0]['service_tag_number'];?>" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label" >Serial Number<span class="text-danger">*</span></label>
                                <div class="">
                                    <input required type="number" step="any" class="form-control serial_number" placeholder="Serial Number"id="serial_number" name="serial_number" value="<?php echo $product[0]['serial_number'];?>" >
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label ">Purchase Date <span class="text-danger">*</span></label>
                                <div class="">
                                    <input  type="date" class="form-control purchase_date" id="purchase_date" placeholder="Purchase Date" name="purchase_date" value="<?php echo $product[0]['purchase_date'];?>" >
                                </div>    
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="control-label">Split Into<span class="text-danger">*</span></label>
                                <div class="">
                                    <input required type="number"  class="form-control split_into" placeholder="Split Into" id="split_into" name="split_into">
                                </div>
                            </div>
                        </div>

                        <div class="row "></div>
                        <div style="padding-right: 15px;">
                            <input type="button" name="split" id="save_split"class="btn btn-primary pull-right" value="Split">
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>


<div id="div2"></div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#save_split").click(function() {
        var split_id = $("#split_into").val();
        
        $.ajax({
        url: "<?php echo base_url();?>inventory/aftersplit",
        type:"POST",
        data: { id : split_id },
            success:function(data) {
                
               $("#div2").html(data);
               $('.category_id').select2();
               $('.product_subcategory_id').select2();
               $('.product_brand_id').select2();
               $('.product_id').select2();
            }
        });
        });
    });
    
</script>

<script type="text/javascript">
    $(document).on("click",".save_product",function() {
    var product_code = $('#hid_product_code').val();
    var cat_id  = $('#cat_id').val();
    var pro_subcat_id = $("#pro_subcat_id").val();
    var pro_brand_id = $("#pro_brand_id").val();
    var price_usd = $('#price_usd').val();
    var price = $("#price").val();
    var pro_id = $("#pro_id").val();
    var sl_number = $(".sl_number").val();

    $.ajax({
       url: "<?php echo base_url();?>inventory/splitSave",
       type: "POST",
       data: { product_code:product_code, cat_id: cat_id, pro_subcat_id: pro_subcat_id, pro_brand_id: pro_brand_id, price: price,price_usd:price_usd, pro_id: pro_id, sl_number: sl_number },
       success: function(data){
           alert("Data inserted successfully");
        }
    });
});


$(document).on("input","#price_usd", function () {
    var price_usd = $(this).val();
    var unit_price = $('#exchange_rate').val();
    var usdtobdtprice = parseFloat(parseFloat(unit_price) * parseFloat(price_usd)).toFixed(2);
    $(this).parent().parent().parent().parent().find("#price").val(usdtobdtprice);
});
        
</script>

<div id="div1"></div>


