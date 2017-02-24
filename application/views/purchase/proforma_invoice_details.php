<ul class="nav nav-pills" style="margin: 0 0 15px 15px;">
    <li class="active"><a data-toggle="tab" href="#proforma_invoice_info">Proforma Invoice Info</a></li>
    <li><a data-toggle="tab" href="#goods_recieve_history">Goods Recieve History</a></li>
    <li><a data-toggle="tab" href="#adjustment_info">Adjustment Info</a></li>
    <li><a data-toggle="tab" href="#fob_details">FOB Settings</a></li>
</ul>

<div class="tab-content">
    <div id="proforma_invoice_info" class="tab-pane fade in active">
            <div class="panel panel-default">
                <div class="panel-heading"">
                    
                    <div class="panel-title" style="overflow:hidden">
                        <span class="pull-left">Proforma Invoice</span>
                        <span class="pull-right"><a href="<?= base_url().'purchase/local_order_details_pdf_generate/'.$pidid;?>"><input class="btn btn-primary " value="print" type="button"></a></span>
                        <span class="pull-right" style="margin-right:15px; color:green"><?php echo @$pi_info->status_name; ?></span>
                    </div>
                        
                </div>
                
                <div class="panel-body">
                        <div class="text-center pi_save_block"></div>
                        <form class="form-horizontal" id="proforma_invoice" action="" method="post">
                            <input type="hidden" id="" class="proforma_invoice_id" name="proforma_invoice_id" value="<?php echo @$pi_info->proforma_invoice_id; ?>">
                            <input type="hidden" id="" class="purchase_order_id" name="purchase_order_id" value="<?php echo @$pi_info->purchase_order_id; ?>">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">Purchase Order Id</label>
                                    <div class="col-lg-7">
                                        <label>
                                            <a href="<?= base_url().'purchase/order_details/'.$pi_info->purchase_id; ?>"><?php echo $pi_info->purchase_code; ?></a>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">Indent Number</label>
                                    <div class="col-lg-7">
                                        <input type="text" readonly="" class="form-control proforma_invoice_name" value="<?php echo @$pi_info->indent_number; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lc_number" class="col-lg-5 control-label">LC Number <span class="text-danger">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control lc_number" name="lc_number" value="<?php echo @$pi_info->lc_number; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">LC Value(USD) <span class="text-danger">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control lc_value_usd" name="lc_value_usd" value="<?php echo ((@$pi_info->lc_number!=NULL)?$pi_info->lc_value_usd:$purchase_prices->total_price_usd); ?>">
                                    </div>
                                </div>
                                
                            </div>	

                            <div class="col-lg-4">                            

                                <div class="form-group">
                                    <label for="lc_value_bdt" class="col-lg-5 control-label ">LC Value(BDT)</label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" name="lc_value_bdt" value="<?php echo ((@$pi_info->lc_number!=NULL)?$pi_info->lc_value_bdt:$purchase_prices->total_purchase_price); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">LC Settlement Duration</label>
                                    <div class="col-lg-7">
                                        <input type="number" class="form-control" name="lc_settlement_duration" value="<?php echo @$pi_info->lc_settlement_duration; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">Shipping Advise</label>
                                    <div class="col-lg-7">
                                        <textarea name="shipping_advice" class="form-control"><?php echo @$pi_info->shipping_advise; ?></textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label ">LC Settlement Date</label>
                                    <div class="col-lg-7">
                                        <input  type="date" class="form-control" name="lc_settlement_date" value="<?php echo @$pi_info->lc_settlement_date;?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label ">Shipping Date</label>
                                    <div class="col-lg-7">
                                        <input  type="date" class="form-control" name="shipping_date" value="<?php echo @$pi_info->shipping_date;?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">Remarks</label>
                                    <div class="col-lg-7">
                                        <textarea name="remarks" class="form-control"><?php echo @$pi_info->remarks; ?></textarea>
                                    </div>
                                </div>
    <!--                            <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">Proforma Invoice</label>
                                    <div class="col-lg-7">
                                        <input type="file" name="userfile" id="imgInp">
                                    </div>
                                </div>-->

                            </div>



                            <div class="row "></div>
                            <div style="padding-right: 15px;">
                                <input <?= bpa('save_proforma')?'':'disabled="disabled"'; ?> type="button" id="save_proforma_submit"class="btn btn-primary pull-right" value="Save">
                            </div>
                        </form>
                    </div>
                </div>










                <div class="panel panel-default">
                    <div class="panel-heading">Product List</div>
                        <div class="panel-body">

                        <div class="col-lg-12">
                            <div>&nbsp;</div>
                            <button type="button" table="product_group" field="product_group_name" class="btn btn-danger list_ordering">Group Wise</button>
                            <button type="button" table="region" field="region_name" class="btn btn-danger list_ordering">Region Wise</button>
                        </div>

                        <div class="panel-body" id="error_show">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="">
                            <thead>
                                <tr>
                                    <th>#<?php echo SI; ?></th>
                                    <th style="width: 130px;"><?php echo label_html(PRODUCT_NAME,'PRODUCT_NAME'); ?></th>
                                    <th>P.CODE</th>
                                    <?php echo get_specification_json_type(array(), "title"); ?>
                                    <th><?php echo label_html(PRICE_USD,'PRICE_USD'); ?></th>
                                    <th><?php echo label_html(PRICE_BDT,'PRICE_BDT'); ?></th>
                                    <th>Order QTY</th>
                                    <th>Received QTY</th>
                                    <th>Received Date</th>
                                    <th>Receive Now</th>
                                    <th>Action</th>
                                    <th><?php echo label_html(TOTAL,'TOTAL'); ?></th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(!empty($selected_product_group))
                                {
                                    $total = 0;
                                    $sl=1;
                                    foreach ($selected_product_group as $k=>$v)
                                    {?>
                                        <tr>
                                            <th colspan="15">
                                                <input type="hidden" class="proforma_invoice_id" value="<?= $v['proforma_invoice_id']; ?>">
                                                <?php echo ($table=='region')?$v['region_name']:$v['product_group_name']; ?>
                                            </th>
                                        </tr>
                                        <?php 

                                        //if(!empty($selected_product)){
                                        foreach($this->purchase_model->get_selected_product2($v['purchase_order_id'],($table=='region')?$v['region_id']:$v['product_group_id'],$table,$pidid) as $key=>$value){
                                            $max = $value['quantity']-$value['total_received'];
                                            $read_only="";
                                              $disable_button="";
                                              if($value['quantity']==$value['total_received']){
                                                $read_only ="readonly='readonly'"; 
                                                $disable_button =' disabled="disabled" ';
                                              }
                                            $ps = json_decode($value['product_details_json'],TRUE);
                                            $total += ($value['confirm_quantity']*$value['purchase_price']);
                                            $receibeble_quantity = $value['confirm_quantity']-($value['total_received']?$value['total_received']:0);
                                            ?>
                                        <form class="form-horizontal" role="form" method="post" id="my_form_<?php echo $value['product_id'] ?>" action="<?php echo base_url();?>purchase/add_local_purchase_serial_number/<?php //echo $order_id; ?>">
                                            <tr>
                                              <td><?php echo $sl++;?></td>
                                                <td>
                                                    <input type="hidden" name="product_id" class="product_id" value="<?php echo $value['product_id'];?>">
                                                    <input type="hidden" name="purchase_order_details_id" class="purchase_order_details_id" value="<?php echo $value['purchase_order_details_id'];?>">
                                                    <input type="hidden" name="purchase_id" class="purchase_id" value="<?= $value['purchase_order_id']; ?>">
                                                    <input type="hidden" name="proforma_invoice_id" class="proforma_invoice_id" value="<?= $value['proforma_invoice_id']; ?>">
                                                    <input type="hidden" name="hi_order_quantity" class="hi_order_quantity" value="<?= $value['quantity']; ?>">
                                                    <input type="hidden" name="hi_lc_number" class="hi_lc_number" value="<?= $value['lc_number']; ?>">
                                                    <a style="text-decoration: underline" target="_blank" href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$value['product_id']; ?>"><?php echo $value['product_name'];?>&nbsp;<?php echo @$value['model_name'];?></a>
                                                </td>
                                                <td><?php echo $value['product_code'];?></td>
                                                <?php echo get_specification_json_type($ps, "value"); ?>
                                                <td><?php echo $value['purchase_price_usd'];?></td>
                                                <td><?php echo $value['purchase_price'];?></td>
                                                <td class="tota_qt"><?php echo $value['confirm_quantity'];?></td>
                                                <td class="total_rec"><?php echo $value['total_received']?$value['total_received']:0;?></td>
                                                <td><input type="date" id="mydate" class="form-control user-success recieve_ack_date" value="<?php echo date("Y-m-d"); ?>" ></td>
                                                <td><input type="number"  class="form-control user-success total_new_rec check" name="new_received" value="<?php echo $receibeble_quantity; ?>" min=1 max="<?php echo $max?>" placeholder="Received Now" <?php echo $read_only;?>></td>
                                                <td><button <?= bpa('receive_order')?'':'disabled="disabled"'; ?> type="submit" class="btn btn-primary options"  btn-form="my_form_<?php echo $value['product_id'] ?>" <?php echo $disable_button; ?> >Receive</button></td>
                                                <td class="sub_total"><?php echo number_format($value['quantity']*$value['purchase_price'],2); ?></td>
                                                
                                                
                                            </tr>
                                        </form>
                                        <?php }

                                        //} 
                                        ?>
                                    <?php }
                                }

                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="total" colspan="<?= ccsbsid($pi_info->status_name, 'one',(get_specification_json_type(array(),NULL,1)+11)); ?>" style="text-align: right;">Total :<?php echo number_format($total, 2); ?></th>
                                    <th colspan="5" style="text-align: right;"></th>
                                </tr>
                                <tr>
                                    <th class="total_inword" colspan="<?= ccsbsid($pi_info->status_name, 'two',(get_specification_json_type(array(),NULL,1)+11)); ?>" style="text-align: right;">Total : <?php echo convert_number_to_words($total) . " Taka(Only)"; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                            </div>
                    </div>
                </div>




                <div class="panel panel-default">
                    <div class="panel-heading">Support Documents</div>
                    <div class="panel-body">
                        <div class="text-center pi_upload_block"></div>
                        <form  class="" id="add_document" action="" method="post" enctype="multipart/formdata">
                            <input type="hidden" id="" class="proforma_invoice_id" name="proforma_invoice_id" value="<?php echo @$pi_info->proforma_invoice_id; ?>">
                            <input type="hidden" id="" class="purchase_order_id" name="purchase_order_id" value="<?php echo @$pi_info->purchase_order_id; ?>">
                            <div class="col-lg-6">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="" class="col-lg-5 control-label"><?= label_html(FILE_NAME,'FILE_NAME'); ?> <span class="text-danger">*</span></label>
                                        <div class="col-lg-7">
                                            <input class="form-control file_name data" type="text" name="purchase_supporting_doc_name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <input type="file" name="userfile" id="imgInp" class="upload" /> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input class="btn btn-primary pi_upload" type="submit" name="upload" value="<?= UPLOAD; ?>"/>
                                </div>
                            </div>
                            <div class="col-lg-6 upporting_doc_list">
                                <?php if(isset($supporting_doc_list)){?>
                                    <div class="scrolltable">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#<?= label_html(SI,'SI'); ?></th>
                                                    <th><?= label_html(NAME,'NAME'); ?></th>
                                                    <th><?= label_html(URL,'URL'); ?></th>
                                                    <th><?= label_html(ACTION,'ACTION'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; 
                                                foreach ($supporting_doc_list as $val){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $val['purchase_supporting_doc_name'];?></td>
                                                        <td><a target="_blank" href='<?php echo base_url().$val['purchase_supporting_doc_url'];?>' > <?php echo $val['purchase_supporting_doc_url'];?> </a></td>
                                                        <td>
                                                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_doc" aria-hidden="true" puchase_supporting_doc_id="<?php echo $val['puchase_supporting_doc_id'];?>" ></i>
                                                        </td>
                                                    </tr>

                                                <?php $i++;} ?>
                                            </tbody>
                                        </table>

                                    </div>
                               <?php  }?>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    
            <div id="goods_recieve_history" class="tab-pane fade">
                <div class="panel-body">                   
                      <div class="panel panel-default">
                            <div class="panel-heading">
                            <h5 class="panel-title">Good Receive History</h5>
                            </div>
                            <div class="panel-body" id="search_panel">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="good_receive">
                                <thead>
                                    <tr>
                                        <th>#<?php echo SI; ?></th>
                                        <th><?php echo label_html(PRODUCT_NAME,'PRODUCT_NAME'); ?></th>
                                        <th><?php echo label_html(RECEIVED_QUANTITY,'RECEIVED_QUANTITY'); ?></th>
                                        <th><?php echo label_html(RECEIVE_DATE,'RECEIVE_DATE'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; 
                                    foreach ($good_receive as $val){
                                       
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                               
                                                <a href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$val['product_id']; ?>">
                                                <?php echo $val['product_name'];?>
                                                </a>
                                            </td>
                                            <td><?php echo $val['receive_quantity'];?></td>
                                            <td>
                                               
                                                <?php echo date("Y/m/d",strtotime($val['recieve_ack_date']));?>
                                            </td>
                                        </tr>

                                    <?php $i++;} ?>
                                </tbody>
                            </table>
                            </div>
                     </div>
                </div>
            </div>
           
            <div id="adjustment_info" class="tab-pane fade">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow: hidden;  ">
                        <div class="panel-title pull-left ">
                            Payable Payment
                        </div>
                    </div>
                        <div class="panel-body">
                            <div class="text-center pi_save_block"></div>
                                <form class="form-horizontal" id="payable_form" action="" method="post">
                                                                <input type="hidden" name="ref_name" value="Proforma">
                                                                <input type="hidden" id="" name="ref_name_id" value="<?php echo $pidid; ?>">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="" class="col-lg-5 control-label">Cost Component</label>
                                            <div class="col-lg-7">
                                                <?php echo ap_drop_down(12,array("cost_for"=>"Purchase","status"=>"Active"),array("selected_value"=>"")); ?>
                                            </div>
                                        </div>
                                    </div>	
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="width:50px;">#SL</th>
                                                    <th style="width:150px;">Component</th>
                                                    <th style="width:100px;">Amount</th>
                                                    <th style="width:50px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="append_acc_head_purpus" id="append_acc_head_purpus">
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-right" colspan="2">Total : </td>
                                                    <td class="total" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2">Total In Word : </td>
                                                    <td class="total_inword" colspan="2"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row "></div>
                                    <div style="padding-right: 15px;">
                                        <input <?= bpa('save_proforma')?'':'disabled="disabled"'; ?> type="button" id="payable_form_submit" class="btn btn-primary pull-right" value="Create Payable">
                                    </div>
                                </form>
                        </div>
                    </div>
                    
                    <div class="payable_payment_list">
                        <div class="panel panel-default">
                            <div class="panel-heading " style="overflow: hidden;">Payable Payment List</div>
                            <div class="panel-body">
                                <table class="table table-striped dataTable" id="payable_list">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all">&nbsp;&nbsp;<?php echo label_html(SL, 'SL'); ?></th>
                                            <th><?php echo "Payment Code"; ?></th>
                                            <th><?php echo "Cost Component Name"; ?></th>
                                            <th><?php echo "Amount"; ?></th>
                                            <th><?php echo "Status"; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="payable_ajax_list">
                                        <?php echo $this->load->view('purchase/proforma_invoice_details_payable_payment_ajax_view');?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
    
            
    
            <div id="fob_details" class="tab-pane fade">
                <div class="panel panel-default">
                <div class="panel-heading" style="overflow: hidden;  ">
                    <div class="panel-title pull-left ">
                        FOB Details
                    </div>
                </div>
                    <div class="panel-body">
                        <div class="col-lg-6">
                            <table class="table table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>Group</th>
                                        <th>number Of Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($fob_group->result() as $fg)
                                        { ?>
                                            <tr>
                                                <td><?php echo $fg->product_group_name; ?></td>
                                                <td><a 
                                                        class="fob_product_details" 
                                                        href=""
                                                        p_invoice="<?php echo $fg->proforma_invoice_id; ?>"
                                                        p_group_id="<?php echo $fg->product_group_id; ?>"
                                                        p_group_name="<?php echo $fg->product_group_name; ?>">
                                                            <?php echo $fg->total_product; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a 
                                                            p_invoice="<?php echo $fg->proforma_invoice_id; ?>"
                                                            p_group_id="<?php echo $fg->product_group_id; ?>" 
                                                            p_group_name="<?php echo $fg->product_group_name; ?>"
                                                            class="btn btn-primary fob_costing_setting" 
                                                            href="">
                                                            Process
                                                        </a>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php }
                                    ?>                                
                                </tbody>                      
                            </table>
                        </div> 
                        
                        
                    </div>
                </div>
                
                <div class="fob_product_details_ajax">
                    
                </div>
            </div>
            
	</div>



	<!-- payment preview modal -->
	<div id="add_product_m" class="modal fade " role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal" style="width: 980px;">
                <!-- Modal content-->
                <div class="modal-content" style="overflow:hidden; padding-bottom:15px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Send Approval Preview</h3>
                    </div>
                    <div class="modal-body show_payment_approval_preview" style="overflow: hidden">
                        
                    </div>
                        <div class="col-lg-12 text-right">
                            <span class="sendApprovalButton btn btn-primary">Send For Approval</span>
                        </div>
                </div>

            </div>
        </div>





<?php
    if(isset($_GET['pg_id']))
    { ?>
        <script>
            $('a[href="#fob_details"]').tab('show');
        </script>  
    <?php }
?>


<script>


    $(document).on("click", ".list_ordering", function (e) {
        e.preventDefault();
        var table = $(this).attr("table");
        var field = $(this).attr("field");
        var proforma_invoice_id = $('.proforma_invoice_id').val();
        window.location.href = "<?php echo base_url(); ?>purchase/proforma_invoice_details/"+proforma_invoice_id+"/"+table+"/"+field; 
    });
    
    
    $('#save_proforma_submit').click(function(e){
        e.preventDefault();
        var lc_number = $('.lc_number').val();
        var lc_value_usd = $('.lc_value_usd').val();
        if(lc_number && lc_value_usd)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/save_proforma_details',
                type: 'POST',
                data: $("#proforma_invoice").serialize(),
                success: function (response) {
                   if(response == true)
                   {
//                        var htm ='<div class="invalid alert alert-success">';
//                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//                        htm += 'Successfully Updated.';
//                        htm +='</div>';
                        $('.hi_lc_number').val(lc_number);
                        $('.pi_save_block').html(htm);
                        location.reload();
                   }
                }
            });
        }
        else
        {
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Star(*) Marks field are required.';
            htm +='</div>';
           $('.pi_save_block').html(htm);
        }
    });
    
    
    $('.pi_upload').click(function(e){
        e.preventDefault();
        var input_file = $('#imgInp').val();
        var file_name = $('.file_name').val();
        var id = document.getElementById("add_document");
        var formdata = false;
        if (window.FormData) {
                formdata = new FormData(id);
        }                    
 
        var file = document.getElementById("imgInp").files[0];
        if (formdata) {
                formdata.append("imgInp[]", file);
        }
        if(input_file && file_name)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/proforma_invoice_ajax_upload',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('.upporting_doc_list').html(response);
                }
            });
        }
        else
        {
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Star(*) Marks field are required.';
            htm +='</div>';
           $('.pi_upload_block').html(htm);
        }
                
    });
    
    
    $(document).ready(function(){
        $(".options").click(function(e){
            e.preventDefault();
                var new_recieve = $(this).parents('tr').find('.total_new_rec').val();
                var qty = $(this).parents('tr').find('.tota_qt').text();
                var recieve = $(this).parents('tr').find('.total_rec').text();
                var product_id = $(this).parents('tr').find('.product_id').val();
                var podid = $(this).parents('tr').find('.purchase_order_details_id').val();
                var purchase_id = $(this).parents('tr').find('.purchase_id').val();
                var proforma_invoice_id = $(this).parents('tr').find('.proforma_invoice_id').val();
                var recieve_ack_date = $(this).parents('tr').find('.recieve_ack_date').val();
                var hi_order_quantity = $(this).parents('tr').find('.hi_order_quantity').val();
                var hi_lc_number = $(this).parents('tr').find('.hi_lc_number').val();
                var proforma_invoice_name = $('.proforma_invoice_name').val();
                var max = qty-recieve;
                if(new_recieve>max){
                    $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong>  Please Give correct recieve amount</center></div>").prependTo("#error_show");                    
                    return;
                }
                else if(new_recieve==0){
                    $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong> Recieve amount cannot be zero.</center></div>").prependTo("#error_show");                  
                    return;
                }
                else if(new_recieve == "")
                {
                    $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong> Recieve amount cannot be null.</center></div>").prependTo("#error_show");                  
                    return;
                }
                else if(qty == recieve)
                {
                    $(".check").attr('readOnly');                  
                    return;
                }
                else if(hi_lc_number == "")
                {
                    $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong> Please update lc information.</center></div>").prependTo("#error_show");                  
                    return;
                }
                else
                {
                   $.ajax({
                        url: '<?php echo base_url(); ?>purchase/purchase_goods_receive',
                        type: 'POST',
                        data: {recieve:recieve,hi_order_quantity:hi_order_quantity,new_recieve:new_recieve,product_id:product_id,podid:podid,purchase_id:purchase_id,proforma_invoice_id:proforma_invoice_id,proforma_invoice_name:proforma_invoice_name,recieve_ack_date:recieve_ack_date},
                        success: function (response) {
                            if(response == true)
                            {
                                window.location.href = "<?php echo base_url(); ?>purchase/proforma_invoice_details/"+proforma_invoice_id; 
                            }
                        }
                    });
                }
            
           });
    });
    
    
    
$('.fob_product_details').click(function(e){
    e.preventDefault();
    var p_invoice = $(this).attr("p_invoice");
    var p_group_id = $(this).attr("p_group_id");
    var p_group_name = $(this).attr("p_group_name");
    $.ajax({
        url: '<?php echo base_url(); ?>purchase/fob_product_details_view_ajax_page',
        type: 'POST',
        data: {p_invoice:p_invoice,p_group_id:p_group_id,p_group_name:p_group_name},
        success: function (response) {
            $('.fob_product_details_ajax').html(response);
        }
    });
});


$('.fob_costing_setting').click(function(e){
    e.preventDefault();
    var p_invoice = $(this).attr("p_invoice");
    var p_group_id = $(this).attr("p_group_id");
    var p_group_name = $(this).attr("p_group_name");
    $.ajax({
        url: '<?php echo base_url(); ?>purchase/fob_costing_setting_view_ajax_page',
        type: 'POST',
        data: {p_invoice:p_invoice,p_group_id:p_group_id,p_group_name:p_group_name},
        success: function (response) {
            $('.fob_product_details_ajax').html(response);
        }
    });
});


$(document).on("click",".fob_confirm",function(e){
    e.preventDefault();    
    var p_group_id = $(this).attr("p_group");
    var p_invoice_id = $(this).attr("p_invoice_id");
    $.ajax({
        url: '<?php echo base_url(); ?>purchase/purchase_product_fob_details_save',
        type: 'POST',
        data: {p_group_id:p_group_id,p_invoice_id:p_invoice_id},
        beforeSend: function() {
            //$("#loading-image").show();
        },
        success: function (data) {
            var htm ='<div class="invalid alert alert-success">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'successfully saved.';
            htm +='</div>';
           $('.order_block_save').html(htm);
        }
    }) ;
});
    
    
    $(document).on('click','.individual_product_fob_costing',function(e){
        e.preventDefault();
        var purchase_order_details_id = $(this).attr("purchase_order_details_id");
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/individual_product_fob_costing',
            type: 'POST',
            data: {purchase_order_details_id:purchase_order_details_id},
            success: function (data) {
                $('.individual_product_fob_costing_details').html(data);
            }
        });        
    });
    
    
    $(document).ready(function(){
        $('#payable_list').DataTable();
    });
    
    
    $(document).ready(function(){
        $('#good_receive').DataTable();
    });
    $(document).on("change","select[name='cost_component_id']",function(){
        var acc_head_id = $(this).val();
        var acc_head_name = $("select[name='cost_component_id'] option:selected").text(); 
        var sl = $(".append_acc_head_purpus tr").length;
        var htm = "<tr class='"+acc_head_id+"'>";
            htm += "<td>"+(sl+1)+"</td>";
            htm += "<td>"+acc_head_name+"</td>";
            htm += "<td><input style='width:100px;' class='form-control amount' type='number' name='account_amount["+acc_head_id+"]'></td>";
            htm += "<td><i class='btn btn-danger fa fa-times remove_item' style='cursor: pointer; text-align: center;'></i></td>";
            htm += "</tr>";
        var check = 0;
        $(".append_acc_head_purpus tr").each(function () {
            check += $('.'+acc_head_id).length;                                                    
        });
        
        if (acc_head_id && (check < 1)) {
            $('.append_acc_head_purpus').append(htm);
        }
    });

    $(document).on("input",".amount", function () {
        calculation();
    });

    $(document).on("click",".remove_item", function () {
        $(this).parent().parent().remove();
        calculation();
    });
    function calculation() {
        var sum = 0;
        $(".amount").each(function () {
            var subtotal_string = $(this).val()||0;
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);
        });
        $(".total").text(addCommas(sum));
        var translator = new T2W("EN_US");
        $(".total_inword").text(capitalizeEachWord(translator.toWords(Math.floor( sum )))+' Taka (Only)');
    }
    
   $(document).on("click","#payable_form_submit", function () {
    $.ajax({
        url: '<?php echo base_url(); ?>common_controller/payable_payment_create',
        type: 'POST',
        data: $('#payable_form').serialize(),
        success: function (data) {
            $('#add_product_m').modal("show");
            $('.show_payment_approval_preview').html(data);
        }
        });
    });
    
    
    $(document).on("click",".sendApprovalButton", function () {
        var payment_approval_hid_code = $('.payment_approval_hid_code').val();
        var payment_approval_note_hid_id = $('.payment_approval_note_hid_id').val();
        $.ajax({
            url: '<?php  echo base_url(); ?>common_controller/send_for_payment_approval_note',
            type: 'POST',
            data: {payment_approval_hid_code:payment_approval_hid_code,payment_approval_note_hid_id:payment_approval_note_hid_id},
            success: function (data) {
                $('.payable_ajax_list').load("<?php echo base_url().'purchase/proforma_invoice_details_load_view/'.$pidid; ?>");
                $("#add_product_m").modal("hide"); 
                $("#append_acc_head_purpus").html("");
                calculation();
                $("select[name='cost_component_id']").val("").change();
            }
        });
    });
</script>
