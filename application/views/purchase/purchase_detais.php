<ul class="nav nav-pills" style="margin: 0 0 15px 15px;">
    <li class="active"><a data-toggle="tab" href="#po_info">PO Info</a></li>
    <li><a data-toggle="tab" href="#proforma_invoice_info">Proforma Invoice List</a></li>
    <li><a data-toggle="tab" href="#approve_history">Approve History</a></li>
</ul>
<div class="tab-content">
    <div id="po_info" class="tab-pane fade in active">
        <form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url(); ?>purchase/update_order/<?php echo $order_id; ?>">
            <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="overflow: hidden;  ">
                                <h5 class="panel-title">
                                    <span><?php echo $title; ?> </span> 
                                    <p class="pull-right text-danger" style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (!empty($current_approval_location)?"Current Step : ".$current_approval_location->step_number.", Current Approval User : ".$current_approval_location->username:""); ?></p>
                                </h5>

                                <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                    <?php if ($order_info->status == '5') { ?>
                                        <button  id="edit" class="btn btn-primary add_item pull-right" name="Edit" value="Edit">Edit</button>
                                        <!--                            <button id="edit" class="btn btn-primary add_item" name="Edit" value="Edit">Edit</button>
                                                                    <button  id="confirm" class="btn btn-primary add_item" name="confirm" value="Confirm">Confirm</button>-->
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="panel-body">
                                <table class="table ">

                                    <tbody>

                                       
                                        <tr>
                                            <th>PO Number</th>
                                            <td><?php echo $order_info->purchase_code; ?></td>
                                            <th>LC Value.</th>
                                            <td><?php echo number_format($order_info->lc_value, 2); ?></td>
                                            <th>LC Settlement Date</th>
                                            <td><?php echo $order_info->lc_settlement_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>PO Date</th>
                                            <td><?php echo $order_info->order_date; ?></td>
                                            <th>Bill Of Entry</th>
                                            <td><?php echo $order_info->bill_of_entry; ?></td>
                                            <th>Currency</th>
                                            <td><?php echo $order_info->currency_name; ?></td>

                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php echo $order_info->status_name; ?></td>
                                            <th>Bill Of Lading</th>
                                            <td><?php echo $order_info->bill_of_lading; ?></td>
                                            <th>Exchange Rate</th>
                                            <td class="exchange_rate"><?php echo $order_info->exchange_rate; ?></td>
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
                            <button type="button" table="product_group" field="product_group_name" class="btn btn-danger list_ordering">Group Wise</button>
                            <button type="button" table="region" field="region_name" class="btn btn-danger list_ordering">Region Wise</button>
                            <div class="panel-body">
                                <table class="table product_list_table">

                                    <thead>
                                        <tr>
                                            <?php echo ($purchase_order_status->status == 49) ? '<th><input class="order_details_id" id="select_all" type="checkbox"></th>' : ''; ?>
                                            <th>#<?php echo SI; ?></th>
                                            <th style="width: 130px;"><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th>
                                            <th>P.CODE</th>
                                            <?php echo ($purchase_order_status->status == 49) ? '<th>Indent Number</th>' : ''; ?>
                                            <?php  echo get_specification_json_type(array(), "title");?>
                                            <th><?php echo label_html(INDENT_NO, 'INDENT_NO'); ?></th>
                                            <th><?php echo label_html(ORDER_QTY, 'ORDER_QTY'); ?></th>
                                            <?php
                                            if (($purchase_order_status->status == 6) || ($purchase_order_status->status == 49)) {
                                                echo "<th>" . label_html(CONFIRM_QTY, 'CONFIRM_QTY') . "</th>";
                                                echo "<th>" . label_html(CANCEL_QTY, 'CANCEL_QTY') . "</th>";
                                            }
                                            ?>
                                            <th><?php echo label_html(PRICE_USD, 'PRICE_USD'); ?></th>
                                            <th><?php echo label_html(PRICE_BDT, 'PRICE_BDT'); ?></th>
                                            <th><?php echo label_html(TOTAL, 'TOTAL'); ?></th>

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
                                                    <th colspan="11"><?php echo ($table == 'region') ? $v['region_name'] : $v['product_group_name']; ?></th>
                                                </tr>
        <?php
        foreach ($this->purchase_model->get_selected_product2($v['purchase_order_id'], ($table == 'region') ? $v['region_id'] : $v['product_group_id'], $table) as $key => $value) {
            $total += ($value['confirm_quantity'] * $value['purchase_price']);
            $ps = json_decode($value['product_details_json'], TRUE);
            ?>
                                                    <tr>
                                                    <?php echo ($purchase_order_status->status == 49) ? '<th><input ' . ((($value['proforma_invoice_id'] != NULL) || ($value['confirm_quantity'] < 1)) ? "disabled='disabled'" : "") . ' class="order_details_id" name="order_details_id[]" value="' . $value['purchase_order_details_id'] . '" type="checkbox"></th>' : ''; ?>
                                                        <td><?php echo $sl++; ?></td>
                                                        <td>
                                                            <input type="hidden" name="product_id[]" class="product_id" value="<?php echo $value['product_id']; ?>">
                                                            <input type="hidden" name="purchase_order_details_id[]" class="purchase_order_details_id" value="<?php echo $value['purchase_order_details_id']; ?>">
                                                            <a style="text-decoration: underline" target="_blank" href="<?php echo base_url() . 'inventory/add_new_product/?page=product_info&p_id=' . $value['product_id']; ?>"><?php echo $value['product_name']; ?>&nbsp;<?php echo @$value['model_name']; ?></a>
                                                        </td>
                                                        <td><?php echo $value['product_code']; ?></td>
            <?php echo ($purchase_order_status->status == 49) ? '<td>' . $value['pindent_number'] . '</td>' : ''; ?>
                                                        <?php echo get_specification_json_type($ps, "value"); ?>
                                                        <td><?php echo $value['pindent_number']; ?></td>
                                                        <td class="order_qty"><?php echo $value['quantity']; ?></td>
                                                <?php
                                                if ($purchase_order_status->status == 6) {
                                            echo '<td><input ' . (($value['proforma_invoice_id'] != NULL) ? "readonly='readonly'" : "") . ' style="width:100px;" type="number" class="form-control confirm_qty" order_qty="' . $value['quantity'] . '" value="' . $value['confirm_quantity'] . '"></td>';
                                            echo '<td class="cancel_qty">' . ($value['quantity'] - $value['confirm_quantity']) . '</td>';
                                                    }
                                                    else if($purchase_order_status->status == 49)
                                                    { ?>
                                                        <td class="confirm_qty"><?php echo $value['confirm_quantity']; ?></td>
                                                        <td class="cancel_qty"><?php echo ($value['quantity'] - $value['confirm_quantity']); ?></td>
                                                    <?php }
                                                   ?>
                                                        <td><?php echo $value['purchase_price_usd']; ?></td>
                                                        <td><?php echo $value['purchase_price']; ?></td>
                                                        <td class="sub_total"><?php echo number_format($value['quantity'] * $value['purchase_price'], 2); ?></td>

                                                    </tr>
                                        <?php
                                   //debug(get_specification_json_type(array(),NULL,1));
                                        }
                                    }
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="<?= ccsbsid($order_info->status, 'one',(get_specification_json_type(array(),NULL,1))); ?>" style="text-align: right;">Total :</th>
                                            <th class="total" colspan="2" style="text-align: right;"><?php echo number_format($total, 2); ?></th>
                                        </tr>
                                        <tr>
                                            <th class="total_inword" colspan="<?= ccsbsid($order_info->status, 'two',(get_specification_json_type(array(),NULL,1))); ?>" style="text-align: right;">Total : <?php echo convert_number_to_words($total) . " Taka(Only)"; ?></th>
                                        </tr>
                                    </tfoot>
                                </table> 
                                <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                    <?php if ($order_info->status == '6') { ?>
                                        <button type="submit" class="vendor_confirm_submit btn btn-primary btn-sm">Vendor Confirm</button>
                                    <?php } else if ($order_info->status == 49) { ?>
                                        <button disabled="disabled" type="submit" id="pi_create_modal_button" class="pi_create_modal_button btn btn-primary btn-sm"  data-toggle="modal">PI Create</button>
                                    <?php } else if ($order_info->status == '5') { ?>
                                        <!--                                <div class="form-group">
                                                                            <label for="remarks" class="col-lg-12 control-label ">Approval Persons</label>
                                                                            <div class="col-lg-12">
                                        <?php //echo approval_privilege_multiselect(explode(',',@$level_array),array('multiple'=>'multiple','class'=>'form-control multiple_user_value'),'userid[]',array("privilege_for_approval.approve_for_id"=>1,"user.status = Active")); ?>
                                                                            </div>
                                                                        </div>-->
<!--                                        <button  id="confirm" class="btn btn-primary add_item pull-right" name="Confirm" value="Confirm">Send For Approval</button>
                                        <button  id="edit" class="btn btn-primary add_item pull-right" name="Edit" value="Edit">Edit</button>-->

                                    <?php } ?>

                                </div>

                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo "Documents"; ?> </h3>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Document Name</th>
                                            <th>URL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sl3 = 1;
                                        if (!empty($support_doc)) {
                                            foreach ($support_doc as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $sl3; ?></td>
                                                <td><?php echo $value['purchase_supporting_doc_name']; ?></td>
                                                <td><a target="_blank" href='<?php echo base_url() . $value['purchase_supporting_doc_url']; ?>' > <?php echo $value['purchase_supporting_doc_url']; ?> </a></td>
                                            </tr>
                                            <?php $sl3++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                            </div>
                            <div class="panel-body">
                                <table class="table ">

                                    <tbody>

                                        <tr>
                                            <th>Request Ship Date</th>
                                            <td><?php echo $order_info->request_ship_date; ?></td>
                                            <th>Shipping Method</th>
                                            <td><?php echo $order_info->shipping_method_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Advice</th>
                                            <td><?php echo $order_info->shipping_advice; ?></td>
                                            <th>Remarks</th>
                                            <td><?php echo $order_info->remarks; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row "></div>





                            </div>
                            <br>
                        </div>



                        <?php if ($order_info->status == '5') { ?>
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
                            <button  id="confirm" class="btn btn-primary add_item pull-right" name="Confirm" value="Confirm">Send For Approval</button>
                        <?php } ?>
                            
                          
                        <?php 
                        //if (($order_info->status == '36') && (purchase_approval_comments_access($order_info->purchase_code, $this->session->userdata("USER_ID")))) { 
                        if (($order_info->status == '36') && (approval_comments_access($order_info->purchase_code, $this->session->userdata("USER_ID"),"purchase_order","purchase_code"))) { 
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
                            
                            
                            
                            
                            
                            
                    </div>
                </div>
            </div>


        </form>
    </div>

    <div id="adjustment_info" class="tab-pane fade">
        <h1>Adjustment info</h1>
    </div>

    <div id="proforma_invoice_info" class="tab-pane fade">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Proforma Invoice List </h3>
                        </div>
                        <div class="panel-body">
                            <div class="field_wrapper">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Purchase Code</th>
                                            <th>Indent Number</th>
                                            <th>Created By</th>
                                            <th>Created</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sl = 1;
                                        if (!empty($proforma_invoice_info)) {
                                            foreach ($proforma_invoice_info as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $sl++; ?></td>
                                                    <td><?php echo $value['purchase_code']; ?></td>
                                                    <td><a style="text-decoration: underline; color: #00f;" class="details_proforma_invoice" href="<?= base_url().'purchase/proforma_invoice_details/'.$value['proforma_invoice_id']; ?>"><?php echo $value['indent_number']; ?></a></td> 
                                                    <td><?php echo $value['username']; ?></td>
                                                    <td><?php echo $value['created']; ?></td>
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
        </div>
    </div>

    <div id="approve_history" class="tab-pane fade">
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
                                            <th>Purchase Code</th>
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




<div id="pi_create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" id="add_item_modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Proforma Invoice</h4>
            </div>
            <div class="modal-body" style="overflow: hidden">
                <div class="text-center porder_block"></div>
                <form id="proforma_invoice_form" class="form-horizontal" action="">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="purchase_code" class="col-lg-4 control-label">Indent Number <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input class="porder_id" type="hidden" name="porder_id" value="">
                                <input class="porder_details_id" type="hidden" name="porder_details_id" value="">
                                <input required="required" type="text" class="form-control indent_number" id="indent_number" name="indent_number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="button" id="save_proforma_invoice"class="btn btn-primary pull-right" value="Save">
                            </div>
                        </div>

                    </div>
                </form>
            </div>     
        </div>

    </div>
</div>






<script>
    $(document).on("click", ".packing", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>purchase/packing_slip").submit();
    });

    $(document).on("click", "#edit", function (e) {
        e.preventDefault();
        var p_code = "<?= $order_info->purchase_code; ?>";
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
        var redirectUrl = '<?php echo base_url(); ?>purchase/purchase_history';
        var purchase_id = "<?php echo $order_id; ?>";
        var purchase_type = "<?php echo $order_info->purchase_type_id; ?>";
        var status;
        if (purchase_type == 1) {
            status = 16;
        } else {
            status = 36; //when create approval process then open this status and comments the following status
            //status = 6;
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
        var order_id = $(".main_order_id").val();
        var table = $(this).attr("table");
        var field = $(this).attr("field");
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_product_list_confirm_page',
            type: 'POST',
            data: {order_id: order_id, table: table, field: field},
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
        var order_id = $('.main_order_id').val();
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
                data: {order_qty: order_qty, purchase_order_details_id: purchase_order_details_id, confirm_qty: confirm_qty, order_id: order_id},
                success: function (data) {
                    //$('.cancel_qty').text(cancel_qty);
                }
            });

        }
    });

    $(document).on("click", ".vendor_confirm_submit", function (e) {
        e.preventDefault();
        var order_id = $('.main_order_id').val();
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/vendor_confirm_submit',
            type: 'POST',
            data: $("#my_form").serialize(),
            success: function (data) {
                if (data == true)
                {
                    window.location.href = "<?php echo base_url(); ?>purchase/order_details/" + order_id;
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
                $('.porder_id').val(data['order_id']);
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
        var order_id = $('.porder_id').val();
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
                        window.location.href = "<?php echo base_url(); ?>purchase/order_details/" + order_id;
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
        
        var ref_id = "<?php echo $order_info->purchase_code; ?>";
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
                       window.location.href = "<?php echo base_url(); ?>common_controller/waiting_approval_list/purchase";
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