<ul class="nav nav-pills" style="margin: 0 0 15px 15px;">
    <li class="active"><a data-toggle="tab" href="#po_info">Price List Info</a></li>
    <li><a data-toggle="tab" href="#approve_history">Approve History</a></li>
</ul>
<div class="tab-content">
    <div id="po_info" class="tab-pane fade in active">
        <form class="form-horizontal" role="form" method="post" id="my_form" action="">
            <input type="hidden" class="main_price_list_id" name="price_list_id" value="<?php echo $order_id; ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="overflow: hidden;  ">
                                <h5 class="panel-title">
                                    <span><?php echo $title; ?> </span> 
                                    <p class="pull-right text-danger" style="font-size: 16px;font-style: oblique;padding-right: 24px;">Current Step : Current Approval User</p>
                                </h5>

                                <div class="btn-toolbar pull-right" style="padding-right: 15px;">
<!--                                    <button  id="edit" class="btn btn-primary add_item pull-right" name="Edit" value="Edit">Edit</button>-->
                                </div>

                            </div>
                            <div class="panel-body">
                                <table class="table ">

                                    <tbody>

                                        <tr>
                                           <th>Price List Name</th>
                                           <td><?php echo $order_info->price_list_name; ?></td>
                                            <th>Price List Code</th>
                                            <td><?php echo $order_info->price_list_code; ?></td>
                                            <th>&nbsp;</th>
                                            <td>&nbsp;</td>

                                        </tr>
                                        <tr>
                                            <th>Current Status</th>
                                            <td><?php echo $order_info->status_name; ?></td>
                                            <th>Budget year</th>
                                            <td><?php echo $order_info->budget_year; ?></td>
                                            <th>Type</th>
                                            <td><?php echo $order_info->list_type; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>   
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" style="overflow: hidden;">
                                <h3 class="panel-title pull-left"><?php echo "Item List"; ?> </h3>

                            </div>
                            <div>&nbsp;</div>
<!--                            <button type="button" table="product_group" field="product_group_name" class="btn btn-danger list_ordering">Group Wise</button>
                            <button type="button" table="region" field="region_name" class="btn btn-danger list_ordering">Region Wise</button>-->
                            <div class="panel-body">
                                <table class="table product_list_table">

                                    <thead>
                                        <tr>
                                            
                                            <th>#<?php echo SI; ?></th>
                                            <th style="width: 130px;"><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th>
                                            <th>P.CODE</th>
                                            <?php  echo get_specification_json_type(array(), "title");?>
                                            <th><?php echo label_html(PRICE_BDT, 'PRICE_BDT'); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        if (!empty($selected_product_group)) {

                                            $sl = 1;
                                            foreach ($selected_product_group as $k => $v) {
                                                ?>
                                                <tr>
                                                    <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+5)); ?>"><?php echo ($table == 'region') ? $v['region_name'] : $v['product_group_name']; ?></th>
                                                </tr>
        <?php
        foreach ($this->price_list_model->get_selected_product2($v['price_list_id'], ($table == 'region') ? $v['region_id'] : $v['product_group_id'], $table) as $key => $value) {
            
            $ps = json_decode($value['product_details_json'], TRUE);
            ?>
                                                    <tr>
                                                    
                                                        <td><?php echo $sl++; ?></td>
                                                        <td>
                                                            <input type="hidden" name="product_id[]" class="product_id" value="<?php echo $value['product_id']; ?>">
                                                            <input type="hidden" name="price_list_details_id[]" class="purchase_order_details_id" value="<?php echo $value['price_list_details_id']; ?>">
                                                            <a style="text-decoration: underline" target="_blank" href="<?php echo base_url() . 'inventory/add_new_product/?page=product_info&p_id=' . $value['product_id']; ?>"><?php echo $value['product_name']; ?>&nbsp;<?php echo @$value['model_name']; ?></a>
                                                        </td>
                                                        <td><?php echo $value['product_code']; ?></td>
                                                        <?php echo get_specification_json_type($ps, "value"); ?>
                                               
                                                        <td><?php echo $value['unit_price']; ?></td>
                                                        
                                                    </tr>
                                        <?php
                                   //debug(get_specification_json_type(array(),NULL,1));
                                        }
                                    }
                                    }
                                    ?>
                                    </tbody>
                                    
                                </table> 
                                

                            </div>
                        </div>
                        
                        
                        
                            
                            <!--<button  id="confirm" class="btn btn-primary add_item pull-right" name="Confirm" value="Confirm">Send For Approval</button>-->
                            
                            
                            
                            <?php 
            //debug(approval_comments_access($order_info->sales_code, $this->session->userdata("USER_ID"),"sales_order","sales_code"),1);
                                    //if (($order_info->status == '36') && (purchase_approval_comments_access($order_info->purchase_code, $this->session->userdata("USER_ID")))) { 
                                    if (($order_info->price_list_status == '58') && (approval_comments_access($order_info->price_list_code, $this->session->userdata("USER_ID"),"price_list","price_list_code"))) { 
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Approve Comment</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="comment_block"></div>
                                                <div class="row "></div>                                
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <div class="col-lg-7">
                                                            <textarea style="width: 600px;" class="approve_comment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <button style="margin-left: 10px;" id="" class="btn btn-primary approve_submit pull-right" name="" value="">Approve</button>
                                        <button  id="" class="btn btn-danger decline_submit pull-right" name="" value="">Decline</button>
                                    <?php } ?>
                            
                            
                            
                            
                            
                            
                            <?php
                                if($order_info->price_list_status == 57)
                                {
                                ?>
                                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Approval Process</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row "></div>                                
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="customer_id" class="col-lg-5 control-label">Approval Persons <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input checked="" type="radio" name="approve_person" value="0">&nbsp;Predifine Hierarchy&nbsp;&nbsp;
                                                <input type="radio" name="approve_person" value="1">&nbsp;Manually
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                                        
                            <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                <a class="btn btn-primary" id="send_for_approval" price_list_code="<?php echo $order_info->price_list_code;?>">Send for approval</a>
                            </div>
                            <?php
                                }
                            ?>
                    </div>
                </div>
            </div>


        </form>
    </div>

    

    

    <div id="approve_history" class="tab-pane fade">
        <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                        <span>Approved  List</span> 
                        <p class="pull-right text-danger" style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (!empty($current_approval_location)?"Current Step : ".$current_approval_location->step_number.", Current Approval User : ".$current_approval_location->username:""); ?></p>
                </h5>
            </div>
            <div class="panel-body">
                <table class="table table-striped dataTable approve_history">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Sales Code</th>
                            <th>Approved Date</th>
                            <th>Approved By</th>
                            <th>Reliever To</th>
                            <th>Comments</th>
                            <th>Action Type</th>
                            <th>Delegation Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $sl = 1;
                                if (!empty($approve_history)) {
                                    foreach ($approve_history as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td><?php echo $value['ref_no']; ?></td>
                                            <td><?php echo date('Y-m-d',strtotime($value['created'])); ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['comment']; ?></td>
                                            <td><?php echo $value['action_type']; ?></td>
                                            <td><?php echo date("Y-m-d",strtotime($value['delegation_start'])) ; ?></td>
                                        </tr>   

                                    <?php }
                                } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>











<script>
    
    $(document).on("click","#send_for_approval",function(e) {
        e.preventDefault();
        
        var price_list_id = "<?php echo $order_id; ?>";
        var price_list_code = $(this).attr("price_list_code");
        $.ajax({
            url: '<?php echo base_url(); ?>price_list/send_for_approval',
            type: 'POST',
            data: {price_list_id:price_list_id,price_list_code: price_list_code},
            success: function (data) {
                location.reload();
            }
        });
    });
    
    
    
    
    
    
    
    $(document).on("click", ".packing", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>purchase/packing_slip").submit();
    });

    $(document).on("click", "#edit", function (e) {
        e.preventDefault();
        var p_code = '<?php echo @$order_info->price_list_code; ?>';
        var redirectUrl = '<?php echo base_url(); ?>purchase/add_new';
        var post_value = "<?php echo $order_id; ?>";
        window.location.href = redirectUrl + '/' + post_value+'/?p_code='+p_code;
    });


//    $(document).on("click","#confirm",function(e){
//        e.preventDefault();
//         var redirectUrl ='<?php //echo base_url();  ?>purchase/purchase_history';
//            $.ajax({
//                url: '<?php //echo base_url();  ?>purchase/update_status',
//                type: 'POST',
//                data: $("#my_form").serialize(),
//                success: function (data) {
//                    if(data == true)
//                    {
//                        window.location.href = redirectUrl;
//                    }
//                    else
//                    {
//                        alert("Please set approval persons.");
//                    }
//                    
//                }
//            });
//    });

    $(document).on("click", "#confirm", function (e) {
        e.preventDefault();
        var redirectUrl = "<?php echo base_url(); ?>purchase/purchase_history";
        var purchase_id = "<?php echo $order_id; ?>";
        var purchase_type = "<?php echo @$order_info->purchase_type_id; ?>";
        var status;
        if (purchase_type == 1) {
            status = 16;
        } else {
            status = 36;
        }
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_status',
            type: 'POST',
            data: {purchase_id: purchase_id, status: status},
            success: function (data) {
                window.location.href = redirectUrl;
            }
        });
    });

    $(document).on("input", ".confirm_quantity", function () {
        var order_details_id = $(this).parent().parent().find(".order_details_id").val();
        var order_quantity = $(this).parent().parent().find(".order_quantity").text();
        var confirm_quantity = $(this).val();
        var price = $(this).parent().parent().find(".price").val();
        var subtotal = parseFloat(parseFloat(confirm_quantity) * parseFloat(price.replace(',', ''))).toFixed(2);
        if (confirm_quantity <= order_quantity)
        {
            $(this).css("border", "");
            $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
            update_order_details(order_details_id, confirm_quantity, parseFloat(price.replace(',', '')));
            calculation();
        } else
        {
            $(this).css("border", "#f00 solid 1px");
            alert("Confirm quantity must less then or equal order quantity.");
        }
    });

    $(document).on("input", ".price_usd", function () {

        var price_usd = $(this).val();
        var order_details_id = $(this).parent().parent().find(".order_details_id").val();
        var confirm_quantity = $(this).parent().parent().find(".confirm_quantity").val();
        var unit_price = $('.exchange_rate').text();

        var usdtobdtprice = parseFloat(parseFloat(unit_price) * parseFloat(price_usd)).toFixed(2);
        $(this).parent().parent().find(".price").val(usdtobdtprice);
        var price = $(this).parent().parent().find(".price").val();
        var subtotal = parseFloat(parseFloat(confirm_quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        //alert(usdtobdtprice);
        update_order_details_usd(order_details_id, confirm_quantity, price_usd);
        update_order_details(order_details_id, confirm_quantity, price);
        calculation();
    });

    $(document).on("input", ".price", function () {
        var price = $(this).val();
        var order_details_id = $(this).parent().parent().find(".order_details_id").val();
        var confirm_quantity = $(this).parent().parent().find(".confirm_quantity").val();
        var subtotal = parseFloat(parseFloat(confirm_quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(order_details_id, confirm_quantity, price);
        calculation();
    });

    function update_order_details(order_details_id, confirm_quantity, price) {
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, confirm_quantity: confirm_quantity, purchase_price: price},
            success: function (data) {
                //
            }
        });
    }
    function update_order_details_usd(order_details_id, confirm_quantity, price_usd) {
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_product_details_usd',
            type: 'POST',
            data: {order_details_id: order_details_id, confirm_quantity: confirm_quantity, purchase_price_usd: price_usd},
            success: function (data) {
                //
            }
        });
    }
    function calculation() {
        var sum = 0;
        $(".sub_total").each(function () {
            var subtotal_text = $(this).text();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);

        });
        $(".total").text(addCommas(sum));
        var translator = new T2W("EN_US");
        $(".total_inword").text('Total In Word : ' + capitalizeEachWord(translator.toWords(Math.floor(sum))) + ' Taka (Only)');
    }

    $(document).on("click", ".list_ordering", function (e) {
        e.preventDefault();
        var price_list_id = $(".main_price_list_id").val();
        var table = $(this).attr("table");
        var field = $(this).attr("field");
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_product_list_confirm_page',
            type: 'POST',
            data: {price_list_id: price_list_id, table: table, field: field},
            success: function (data) {
                $('.product_list_table tbody').html(data);
                calculation();
            }
        });
    });



    $(document).on("input", ".confirm_qty", function () {
        var order_qty = parseInt($(this).attr("order_qty"));
        var purchase_order_details_id = $(this).parent().parent().find(".purchase_order_details_id").val();
        var confirm_qty = parseInt($(this).val());
        var price_list_id = $('.main_price_list_id').val();
        var cancel_qty = order_qty - confirm_qty;
        $(this).parent().parent().find(".cancel_qty").text(cancel_qty);
        if ((confirm_qty > order_qty) || (confirm_qty < 0))
        {
            $(this).css("border", "1px solid #f00");
            $(this).parent().parent().find(".order_details_id").attr('disabled', 'disabled');
        } else
        {
            $(this).css("border", "");
            $(this).parent().parent().find(".order_details_id").removeAttr('disabled');
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/update_confirm_order',
                type: 'POST',
                data: {order_qty: order_qty, purchase_order_details_id: purchase_order_details_id, confirm_qty: confirm_qty, price_list_id: price_list_id},
                success: function (data) {
                    //$('.cancel_qty').text(cancel_qty);
                }
            });

        }
    });

    $(document).on("click", ".vendor_confirm_submit", function (e) {
        e.preventDefault();
        var price_list_id = $('.main_price_list_id').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/vendor_confirm_submit',
            type: 'POST',
            data: $("#my_form").serialize(),
            success: function (data) {
                if (data == true)
                {
                    window.location.href = "<?php echo base_url(); ?>purchase/order_details/" + price_list_id;
                }
            }
        });
    });

    $('#select_all').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });


//$(document).on("click", "#pi_create_modal", function (e) {
    $('#pi_create_modal_button').on("click", function (e) {
        e.preventDefault();
        $(this).attr("data-target", "#pi_create_modal");
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_pi_list',
            type: 'POST',
            data: $("#my_form").serialize(),
            dataType: "json",
            cache: false,
            success: function (data) {
                $('.porder_id').val(data['price_list_id']);
                $('.porder_details_id').val(data['order_details_id']);

            }
        });
    });

    $(document).on("click", ".order_details_id", function () {
        if ($('[name="order_details_id[]"]:checked').length > 0)
        {
            $(".pi_create_modal_button").removeAttr('disabled');
        } else
        {
            $(".pi_create_modal_button").attr('disabled', 'disabled');
        }
    });

    $('#save_proforma_invoice').on("click", function (e) {
        e.preventDefault();
        var price_list_id = $('.porder_id').val();
        var order_details_id = $('.porder_details_id').val();
        var indent_number = $('.indent_number').val();
        if (indent_number && order_details_id)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/save_proforma_invoice',
                type: 'POST',
                data: $("#proforma_invoice_form").serialize(),
                success: function (data) {
                    if (data == true)
                    {
                        window.location.href = "<?php echo base_url(); ?>purchase/order_details/" + price_list_id;
                    }
                }
            });
        } else
        {
            var htm = '<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Indent number can not be empty.';
            htm += '</div>';
            $('.porder_block').html(htm);
        }
    });
    
    
    $(document).on("click",".approve_submit", function (e) {
        e.preventDefault();
        var comments = $('.approve_comment').val();
        
        var ref_id = "<?php echo @$order_info->price_list_code; ?>";
        if(comments)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/approve_delegation_action',
                //url: '<?php echo base_url(); ?>purchase/approve_delegation_action',
                type: 'POST',
                data: {ref_id:ref_id,comments:comments},
                success: function (data) {
                   if(data == true)
                   {
                       window.location.href = "<?php echo base_url(); ?>common_controller/waiting_approval_list/price_list";
                   }
                }
            });
        }
        else
        {
            var htm = '<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Comments Field can not be empty.';
            htm += '</div>';
            $('.comment_block').html(htm);
        }
        
    });
    
    $(document).ready(function() {
    $('.approve_history').DataTable({
        "paging":   false
    });
} );
    
    
</script>