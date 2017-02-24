<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#manual_stock_tab">Manuel Stock Entry</a></li>
        <li role="presentation"><a data-toggle="tab" href="#barcode_scanner_tab">Barcoad Scanner</a></li>
    </ul>
    <div class="panel panel-default">
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body tab-content">
                <div id="manual_stock_tab" class="tab-pane fade in active">
                    <form class="form-horizontal"  id="my_form" method="post" action="#">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="vendor" class="col-lg-4 control-label">Product Category</label>
                                        <div class="col-lg-8">
                                           <?php echo category_list(null, array('class' => 'category_id get_product')); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Brand</label>
                                        <div class="col-lg-8">
                                            <?php echo brand_list(null, array('class' => 'brand_id get_product')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Description </label>
                                        <div class="col-lg-8">
                                            <textarea class="col-lg-12" name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Purchase Type</label>
                                        <div class="col-lg-8">
                                            <?php echo purchase_type();?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Warranty Start Date</label>
                                        <div class="col-lg-8">
                                            <input required type="date" class="form-control warranty_start_date" id="" name="warranty_start_date" value="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Packing Slip</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control " id="" name="packing_slip" value="" >
                                        </div>
                                    </div>


                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Product Sub-Category</label>
                                        <div class="col-lg-8">
                                            <?php echo sub_category_list(null, array('class' => 'sub_category_id get_product')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label ">Products</label>
                                        <div class="col-lg-8">
                                            <?php echo product_list(null, array('class' => 'product_id')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Supplier</label>
                                        <div class="col-lg-8">
                                            <?php echo vendor_list();?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Order Number</label>
                                        <div class="col-lg-8">
                                            <input required type="number" step="any" class="form-control " id="" name="order_number" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Warranty Period</label>
                                        <div class="col-lg-8">
                                            <input required type="number" class="form-control " id="" name="warranty_period" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Serial Number</label>
                                        <div class="col-lg-8">
                                            <input  type="number" class="form-control " id="" name="serial_number" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-4 control-label">Price</label>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control " id="" name="price" value="" >
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row"></div>

                                <div class="form-group">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <button type="button" id=""class="btn btn-primary " >Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </form>

                </div>
                <div id="barcode_scanner_tab" class="tab-pane fade">
                    <h1>Barcoad Scanner</h1>
                    <img src="<?php echo base_url()?>images/barcoad.jpg" alt="" style="width: 250px;"/>
                    <div class="row"></div>
                    <br>
                    <textarea class="col-lg-3"></textarea>
                </div>
                
            </div>
        </div>
    </div>
</div>
<style>
    .mid_font{
        font-size: 20px;
    }
</style>