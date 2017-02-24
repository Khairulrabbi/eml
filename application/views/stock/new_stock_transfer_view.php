<form class="form-horizontal"  id="my_form" method="post" 
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?> </h3>
                </div>
                <div class="panel-body">


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="transfer_from" class="col-lg-3 control-label">Transfer From</label>
                            <div class="col-lg-9">
                                <select name="transfer_from" class="transfer_from">
                                    <option>Select</option>
                                    <?php $i=0; foreach ($warehouse_list as $value){?>
                                    <option value="<?php echo $value['warehouse_id'];?>" <?php echo( @$transfer_data[0]['transfromFromId']==$value['warehouse_id']? 'selected':'')?>><?php echo $value['warehouse_name'];?></option> 
                                    <?php $i++;}?>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="transfer_to" class="col-lg-3 control-label">Transfer To</label>
                            <div class="col-lg-9">
                                 <select name="transfer_to" class="transfer_to">
                                     <option>Select</option>
                                    <?php $j=0; foreach ($warehouse_list as $value){?>
                                    <option value="<?php echo $value['warehouse_id'];?>" <?php echo( @$transfer_data[0]['transferToId']==$value['warehouse_id']? 'selected':'')?>><?php echo $value['warehouse_name'];?></option> 
                                    <?php $j++; }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="transfer_requerst" value="<?php echo @$transfer_requerst_number;?>">
                    <div class="col-lg-2"></div>
                    <button type="button" id="add_item_button"class="btn btn-primary add_item" data-toggle="modal" >Add Item</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Item List"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="scrolltable">
                        <div id="mydiv">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Product Serial No</th>
                                    <th>Warehouse From</th>
                                    <th>Warehouse To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                if(!empty($transfer_data)){
                                foreach($transfer_data as $key=>$value){?>
                                    <tr>
                                      <td><?php echo $sl++;?></td>
                                      <td><?php echo $value['product_name'];?></td>
                                      <td><?php echo $value['product_code'];?></td>
                                      <td><?php echo $value['serial_no'];?></td>
                                      <td><?php echo $value['transfromFrom'];?></td>
                                      <td><?php echo $value['transferTo'];?></td>

                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                            </div>

                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-4"></div>
                        <a href="" class="" data-toggle="modal" data-target="#preview">
                            <button class="btn btn-primary">Preview</button>
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <div id="add_item" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add item</h4>
                    </div>
                    <div class="modal-body">


                        <input type="hidden" id="transfer_from_warehouse_id" class="transfer_from_warehouse_id" name="transfer_from_warehouse_id" value="">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <div class="col-lg-4">
                                    Category
                                </div>
                                <div class="col-lg-8">
                                    <?php echo category_list(null, array('class' => 'category_id get_product')); ?>
                                </div>

                                <div class="col-lg-4" style="margin-top: 5px;">
                                    Brand
                                </div>
                                <div class="col-lg-8" style="margin-top: 5px;">
                                    <?php echo brand_list(null, array('class' => 'brand_id get_product')); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-lg-4">
                                    Sub Category
                                </div>
                                <div class="col-lg-8 sub_category_list">
                                    <?php echo sub_category_list(null, array('class' => 'sub_category_id get_product')); ?>
                                </div>
                                <div class="col-lg-4" style="margin-top: 5px;">
                                    Product
                                </div>
                                <div class="col-lg-8 product_list" style="margin-top: 5px;">
                                    <?php echo product_list(null, array('class' => 'product_id')); ?>
                                </div>
                            </div>
                            <div class="col-lg-6" style="margin-right: 15px;">
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-primary search" style="padding-right: 15px;" >Search</button>
                            </div>
                            <div class="col-lg-12 product_list_item" style="margin-right: 15px;">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="add">Close</button>
                        </div>
                        <br>

                    </div>     
                </div>

            </div>
        </div>
        
        <div id="preview" class="modal fade"  role="dialog">
            <div class="modal-dialog modal-lg" id="preview">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Product Transfer List</h4>
                    </div>
                    <div class="modal-body">
                        <div id="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <label class="text-info">Transfer From: <?php echo(@$transfer_data[0]['transfromFrom'])?></label>

                                </div>
                                <div class="col-lg-2">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-info">Transfer To: <?php echo(@$transfer_data[0]['transferTo'])?></label>
                                </div>
                            </div>
                        </div>
                        <br>
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Product Code</th>
                                        <th>Product Serial No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sl=1;
                                    if(!empty($transfer_data)){
                                    foreach($transfer_data as $key=>$value){?>
                                        <tr>
                                          <td><?php echo $sl++;?></td>
                                          <td><?php echo $value['product_code'];?></td>
                                          <td><?php echo $value['serial_no'];?></td>

                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="" onclick="PrintElem('#mydiv')">Print</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="">Close</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>    
</form>
<script>
    $(".category_id").on("change", function () {
        var category_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_sub_category',
            type: 'POST',
            data: {category_id: category_id},
            success: function (data) {
                //alert(data);
                $(".sub_category_list").html(data);
                $('select').select2();
            }
        });
    })


    $(document).on("change", '.get_product', function () {
        get_product_list();

    })
    function get_product_list() {
        var category_id = $(".category_id option:selected").val();
        ;
        //alert(category_id);
        var brand_id = $(".brand_id option:selected").val();
        var sub_category_id = $(".sub_category_id option:selected").val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_combo',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id},
            success: function (data) {
                //alert(data);
                $(".product_list").html(data);
                $('select').select2();
            }
        });
    }


    $(".search").on("click", function (e) {
        e.preventDefault();
        var category_id = $(".category_id option:selected").val();

        var brand_id = $(".brand_id option:selected").val();
        var sub_category_id = $(".sub_category_id option:selected").val();
        //var sub_category_id = $(".sub_category_id option:selected").val();
        var product_id = $(".product_id option:selected").val();
        var transfer_from = $("#transfer_from_warehouse_id").val();

        $.ajax({
            url: '<?php echo base_url(); ?>stock/get_product_list_view_for_transfer',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id, transfer_from: transfer_from},
            success: function (data) {
                $(".product_list_item").html(data);
            }
        });
    });
    $(".add_item").click(function () {
        $(".product_list_item").html('');
        var warehouse_from = $('select[name=transfer_from]').val();
        var warehouse_to = $('select[name=transfer_to]').val();
        if (warehouse_from && warehouse_to ) {
            $(this).attr("data-target", "#add_item");
            $('#transfer_from_warehouse_id').val(warehouse_from);

//            $.ajax({
//                url: '<?php echo base_url(); ?>purchase/save_purchase_order',
//                type: 'POST',
//                data: $("#my_form").serialize(),
//                success: function (data) {
//                    //alert(data);
//                    $(".order_id").val(data);
//                    //$('select').select2();
//                }
//            });
        } else {
            alert("Please fill all field currectly");
        }
    });

   

    $(document).on("click", ".add_product", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>stock/save_transfer_products");
        $("#my_form").submit();
    })
</script>

<script type="text/javascript">

    function PrintElem(elem){
        Popup($(elem).html());
    }
    function Popup(data){
        var mywindow = window.open('', 'Btrac', 'width=200');
        /*optional stylesheet*/ //
        mywindow.document.write('<head>');
        mywindow.document.write('<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url(); ?>css/apsis_style.css" rel="newest stylesheet">');
//        mywindow.document.write('<?php echo base_url()?>css/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url(); ?>css/sb-admin-2.css" rel="stylesheet">');

        mywindow.document.write('</head><body>');
        
        mywindow.document.write('<div style="text-align: center; float: left;">\n\
            <p style="font-size:25px; color: #01aeee;"><img src="<?php echo base_url()?>images/logo/btrac_logo.png" alt="" style="width: 80px;"/></p>\n\
            <p style="font-size:15px; color: #01aeee;">Products Transfer List</p>');
        mywindow.document.write('<div class="row"></div>');
        mywindow.document.write(data);
        mywindow.document.write('<div style="float: right; text-align: center; padding: 20px 20px 10px 20px; width: 50%;">\n\
            <div style="width: 100%; border-bottom:2px solid #000;"></div>Signature</div>');
        mywindow.document.write('<div class="row"></div>\n\
            </div>');
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>