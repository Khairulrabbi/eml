<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#customer_info">Customer Info</a></li>
        <li role="presentation"><a data-toggle="tab" href="#address">Address</a></li>
        <li role="presentation"><a data-toggle="tab" href="#additional_info">Additional Info</a></li>
        <li role="presentation"><a data-toggle="tab" href="#order_history">Order History</a></li>
        <li role="presentation"><a data-toggle="tab" href="#payment_history">Payment History</a></li>
    </ul>
    <div class="panel panel-default">
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body tab-content">
                <div id="customer_info" class="tab-pane fade in active">
                    <form class="form-horizontal" id="info_tab" action="" method="post">
                        <input type="hidden" id="customer_id" class="customer_id" name="customer_id" value="<?php echo @$customer_data->customer_id;?>">
                        <div class="text-center basic_info_block"></div>
                        <div class="row">
                            <div class="col-lg-12" style="padding-right: 129px;">
                                <h3 class="text-success text-right customer_name"><?php echo @$customer_data->customer_name;?></h3>
                            </div>
                            <div class="col-lg-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo label_html(BASIC_INFORMATION, 'BASIC_INFORMATION')?></h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name" class="col-lg-4 control-label"><?php echo label_html(NAME, 'NAME')?><span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" required class="form-control name" name="customer_name" value="<?php echo @$customer_data->customer_name;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_type" class="col-lg-4 control-label"><?php echo label_html(CUSTOMER_TYPE, 'CUSTOMER_TYPE');?><span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <?php echo customer_type(@$customer_data->customer_type_id,array('class' => 'customer_type_id', 'required' => 'required'));?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="company" class="col-lg-4 control-label"><?php echo label_html(COMPANY, 'COMPANY')?></label>
                                            <div class="col-lg-8">
                                                <?php echo company(@$customer_data->company_id,array('class' => 'company_id'));?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="credit_limit" class="col-lg-4 control-label"><?php echo label_html(CREDIT_LIMIT, 'CREDIT_LIMIT')?> <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" required class="form-control credit_limit" name="credit_limit" value="<?php echo @$customer_data->credit_limit;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5 ">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo label_html(CONTACT_INFORMATION, 'CONTACT_INFORMATION')?></h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="contact_person" class="col-lg-4 control-label"><?php echo label_html(CONTACT_PERSON, 'CONTACT_PERSON')?> </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control contact_person" name="contact_person" value="<?php echo @$customer_data->contact_person;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile" class="col-lg-4 control-label"><?php echo label_html(MOBILE_NUMBER, 'MOBILE_NUMBER')?> <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" required class="form-control phone" name="mobile_number" value="<?php echo @$customer_data->mobile_number;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="col-lg-4 control-label"><?php echo label_html(PHONE_NUMBER, 'PHONE_NUMBER')?></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control phone" name="phone_number" value="<?php echo @$customer_data->phone_number;?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fax" class="col-lg-4 control-label"><?php echo label_html(FAX, 'FAX')?></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control fax" name="fax_number" value="<?php echo @$customer_data->fax_number;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-lg-4 control-label"><?php echo label_html(EMAIL, 'EMAIL')?></label>
                                                <div class="col-lg-8">
                                                    <input type="email" class="form-control email" name="email" value="<?php echo @$customer_data->email;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="website" class="col-lg-4 control-label"><?php echo label_html(WEBSITE, 'WEBSITE')?></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control website" name="web_url" value="<?php echo @$customer_data->web_url;?>">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo label_html(PURCHASE_INFORMATION, 'PURCHASE_INFORMATION')?> </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="currency" class="col-lg-3 control-label"><?php echo label_html(CURRENCY, 'CURRENCY')?></label>
                                                <?php $curr = explode (',',@$customer_data->currency_id);?>
                                                <div class="col-lg-2">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <input type="checkbox" <?php echo (in_array(1, $curr)?'checked':''); ?> class="currency_id" aria-label="..." value="1" name="currency_id[]">
            
                                                        </span>
                                                        <span class="input-group-addon" id="basic-addon1">BDT</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"></div>
                                                <div class="col-lg-2">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <input type="checkbox" <?php echo (in_array(2, $curr)?'checked':''); ?> class="currency_id" aria-label="..." value="2" name="currency_id[]">
            
                                                        </span>
                                                        <span class="input-group-addon" id="basic-addon1">USD</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="discount" class="col-lg-3 control-label"><?php echo label_html(DISCOUNT, 'DISCOUNT')?></label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control discount" name="discount" aria-describedby="basic-addon1" value="<?php echo @$customer_data->discount;?>">
                                                        <span class="input-group-addon" id="basic-addon1">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_terms" class="col-lg-3 control-label"><?php echo label_html(PAYMENT_TERMS, 'PAYMENT_TERMS')?></label>
                                                <div class="col-lg-9">
                                                    <?php echo credit_note(@$customer_data->credit_note_id, array('class' => 'credit_note_id')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tax" class="col-lg-3 control-label"><?php echo label_html(TAX, 'TAX')?></label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control tax" name="tax" aria-describedby="basic-addon1" value="<?php echo @$customer_data->tax;?>">
                                                        <span class="input-group-addon" id="basic-addon1">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5 ">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo label_html(REMARKS, 'REMARKS')?> </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                        <div class="col-lg-12">
                                            <textarea class="form-control remarks" name="remarks" style="height: 120px;" placeholder="Remarks"><?php echo @$customer_data->remarks;?></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row "></div>
                        
                        <div style="padding-right: 135px;">
                            <input type="button" id="save_info"class="btn btn-primary pull-right" value="Save Info">
                        </div>
                    </form>
                </div>
                <div id="address" class="tab-pane fade">
                    <form class="form-horizontal" id="address_tab" action="" method="post">
                        <input type="hidden" id="customer_id" class="customer_id" name="customer_id" value="<?php echo @$customer_data->customer_id;?>">
                        <div class="text-center basic_info_block"></div>
                        <div class="row">
                            <div class="col-lg-12" style="padding-right: 129px;">
                                <h3 class="text-success text-right customer_name"></h3>
                            </div>
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo label_html(ADDRESS, 'ADDRESS')?></h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="text-center address_block"></div>
                                    <div class="field_wrapper">
                                        <div class="col-lg-8">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label"><?php echo label_html(TITLE, 'TITLE')?> <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control customer_address_title" name="customer_address_title">
                                                            <option>Select</option>
                                                            <option value="Business Address">Business Address</option>
                                                            <option value="Billing Address">Billing Address</option>
                                                            <option value="Shipping Address">Shipping Address</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5"> 
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label"><?php echo label_html(ADDRESS, 'ADDRESS')?> <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control address_details" name="address_details"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label"><?php echo label_html(DEFAULTS, 'DEFAULTS')?></label>
                                                    <div class="col-lg-2">
                                                        <input style="height: 20px" type="checkbox" class="form-control default_flag_address" name="default_flag" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="padding-right: 30px;">
                                                <div class="form-group customer_address_btn">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary add_address pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 address_list">
                                            <?php if(isset($customer_address)){?>
                                                <div class="scrolltable">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#Sl</th>
                                                                <th>Address Title</th>
                                                                <th>Details</th>
                                                                <th>Is Default</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; foreach ($customer_address as $value){?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><?php echo $value['customer_address_title'];?></td>
                                                                    <td><?php echo $value['address_details'];?></td>
                                                                    <td><?php echo (($value['default_flag'] == 1)?'Yes':'No');?></td>
                                                                    <td>
                                                                        <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_address" aria-hidden="true"  address_table_id="<?php echo $value['customer_address_id'];?>" ></i>
                                                                        <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_address" aria-hidden="true" address_table_id="<?php echo $value['customer_address_id'];?>"></i>
                                                                    </td>
                                                                </tr>
                                                            <?php $i++;} ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div id="additional_info" class="tab-pane fade">
                    <form class="form-horizontal" id="additional_info_tab" action="" method="post">
                        <input type="hidden" id="customer_id" class="customer_id" name="customer_id" value="<?php echo @$customer_data->customer_id;?>">
                        <div class="text-center additional_info_block"></div>
                        <div class="row">
                            <div class="col-lg-12" style="padding-right: 129px;">
                                <h3 class="text-success text-right customer_name"><?php echo @$customer_data->customer_name;?></h3>
                            </div>
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo label_html(CREDIT_CARD_INFO, 'CREDIT_CARD_INFO');?></h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="text-center adi_info_block"></div>
                                    <div class="field_wrapper">
                                        <div class="col-lg-6">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="bank" class="col-lg-4 control-label"><?php echo label_html(BANK_NAME, 'BANK_NAME');?></label>
                                                    <div class="col-lg-6">
                                                        <?php echo bank('', array('class'=>'bank_name_id'));?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank" class="col-lg-4 control-label"><?php echo label_html(CARD_TYPE, 'CARD_TYPE');?></label>
                                                    <div class="col-lg-6">
                                                        <?php echo card_type('', array('class'=>'card_type_id'));?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6"> 
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label"><?php echo label_html(CARD_NO, 'CARD_NO');?></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control card_no" name="card_no" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label"><?php echo label_html(EXPIRY_DATE , 'EXPIRY_DATE ');?></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control card_expiry_date" name="card_expiry_date" value="" placeholder="Ex: 0416">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label"><?php echo label_html(DEFAULTS, 'DEFAULTS');?></label>
                                                    <div class="col-lg-2">
                                                        <input type="checkbox" class="form-control default_flag" name="default_flag" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-right"  style="padding-right: 30px;">
                                                <div class="form-group customer_card_btn">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary add_card pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 card_list">
                                            <?php if(isset($card_info)){?>
                                                <div class="scrolltable">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo label_html(SL_NO, 'SL_NO')?></th>
                                                                <th><?php echo label_html(BANK_NAME, 'BANK_NAME')?></th>
                                                                <th><?php echo label_html(CARD_TYPE, 'CARD_TYPE')?></th>
                                                                <th><?php echo label_html(CARD_NO, 'CARD_NO')?></th>
                                                                <th><?php echo label_html(EXPIRY_DATE , 'EXPIRY_DATE ')?></th>
                                                                <th><?php echo label_html(IS_DEFAULT, 'IS_DEFAULT')?></th>
                                                                <th><?php echo label_html(ACTION, 'ACTION')?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; foreach ($card_info as $value){?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><?php echo $value['bank_name'];?></td>
                                                                    <td><?php echo $value['credit_card_type_name'];?></td>
                                                                    <td><?php echo $value['card_no'];?></td>
                                                                    <td><?php echo $value['card_expiry_date'];?></td>
                                                                    <td><?php echo (($value['default_flag'] == 1)?'Yes':'No');?></td>
                                                                    <td>
                                                                        <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_card" aria-hidden="true"  customer_credit_card_id="<?php echo $value['customer_credit_card_id'];?>" ></i>
                                                                        <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_card" aria-hidden="true" customer_credit_card_id="<?php echo $value['customer_credit_card_id'];?>"></i>
                                                                    </td>
                                                                </tr>
                                                            <?php $i++;} ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div id="order_history" class="tab-pane fade">
				<div class="panel panel-default">
                                    <div class="panel-heading"><?php echo label_html(ORDER_HISTORY, 'ORDER_HISTORY'); ?></div>
					  <div class="panel-body">
					  <?php if(@$customer_data->customer_id){?>
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="order">
                        <thead>
                            <tr>
                                <th><?php echo label_html(DATE, 'DATE')?></th>
                                <th><?php echo label_html(ORDER_NUMBER, 'ORDER_NUMBER')?></th>
                                <th><?php echo label_html(PRODUCTS, 'PRODUCTS')?></th>
                                <th><?php echo label_html(QTY, 'QTY');?></th>
                                <th><?php echo label_html(AMOUNT, 'AMOUNT')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2016-04-30</td>
                                <td>666034896</td>
                                <td>Mouse</td>
                                <td>50</td>
                                <td>6000</td>
                            </tr>
                            <tr>
                                <td>2016-05-12</td>
                                <td>882574896</td>
                                <td>Monitor</td>
                                <td>5</td>
                                <td>40000</td>
                            </tr>
                            <tr>
                                <td>2016-05-15</td>
                                <td>986325222</td>
                                <td>Laptop</td>
                                <td>10</td>
                                <td>180000</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php } ?>
					  </div>
					  </div>
                    
                </div>
                <div id="payment_history" class="tab-pane fade">
				<div class="panel panel-default">
                                    <div class="panel-heading"><?php echo label_html(PAYMENT_HISTORY, 'PAYMENT_HISTORY'); ?></div>
					  <div class="panel-body">
					  <?php if(@$customer_data->customer_id){?>
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="payment">
                        <thead>
                            <tr>
                                <th><?php echo label_html(DATE, 'DATE')?></th>
                                <th><?php echo label_html(TRANSACTION_DETAILS, 'TRANSACTION_DETAILS')?></th>
                                <th><?php echo label_html(AMOUNT, 'AMOUNT')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2016-5-26</td>
                                <td>Other Cost</td>
                                <td>5000</td>
                            </tr>
                            <tr>
                                <td>2016-5-28</td>
                                <td>Other Cost</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>2016-5-30</td>
                                <td>Products Price</td>
                                <td>12000</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php } ?>
					  </div>
					  </div>
                    
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
<script>

$(document).ready(function(){
    $('#payment').DataTable();
});

$(document).ready(function(){
    $('#order').DataTable();
});
</script>
<script>
    $(document).ready(function(){
        var customer_id = $('.customer_id').val();
        if(customer_id){
            $('#save_info').val('Update Info');
        }
    });
    $('#save_info').on('click',function(){
        var name = $('.name').val();
        var credit_limit = $('.credit_limit').val();
        var phone = $('.phone').val();
        var customer_id = $('.customer_id').val();
        if(customer_id){
            $.ajax({
                    url: '<?php echo base_url(); ?>customer/update_customer_info',
                    type: 'POST',
                    data: $("#info_tab").serialize(),
                    success: function (data) {
    //                    $(".order_id").val(data);
                         var jdata = $.parseJSON(data);
                        $('.customer_name').html(jdata.customer_name);
                        var htm ='<div class="invalid alert alert-success">';
                        htm += 'Customer Information Updated..';
                        htm +='</div>';
                        $('.basic_info_block').html(htm);
                        $('.invalid').slideUp(3000);

                    }
                });
        }else{
            if(name && credit_limit && phone){
                $.ajax({
                    url: '<?php echo base_url(); ?>customer/save_customer_info',
                    type: 'POST',
                    data: $("#info_tab").serialize(),
                    success: function (data) {
    //                    $(".order_id").val(data);
                        var jdata = $.parseJSON(data);

                        $('.customer_name').html(jdata.customer_name);
                        $('.customer_id').val(jdata.customer_id);

                        var htm ='<div class="invalid alert alert-success">';
                        htm += 'Customer Information Saved..';
                        htm +='</div>';
                        $('.basic_info_block').html(htm);
                        $('.invalid').slideUp(3000);
                        $('#save_info').val('Update');

                    }
                });
            }else{
                var htm ='<div class="invalid alert alert-danger">';
                    htm += 'Please fill the from properly..';
                    htm +='</div>';
                    $('.basic_info_block').html(htm);
                    $('.invalid').slideUp(3000);
            }
        }
        
    });
    
    $(document).on('click','.add_address',function(){
        var customer_address_title = $('.customer_address_title option:selected').val();
        var address_details = $('.address_details ').val();
        var customer_id = $('.customer_id').val();
        if(customer_id){
           if(customer_address_title && address_details){
               $.ajax({
                    url: '<?php echo base_url(); ?>customer/save_addredd',
                    type: 'POST',
                    data: $("#address_tab").serialize(),
                    success: function (data) {
                        $('.address_list').html(data);
                        
                        $('.address_details ').val('');
                        $('.customer_address_title option:selected').val('');
                        
                        var htm ='<div class="invalid alert alert-success">';
                        htm += 'Address Saved..';
                        htm +='</div>';
                        $('.basic_info_block').html(htm);
                        $('.invalid').slideUp(3000);

                    }
                });
            }else{
                var htm ='<div class="invalid alert alert-danger">';
                htm += 'Please fill Required Field..';
                htm +='</div>';
                $('.address_block').html(htm);
                $('.invalid').slideUp(3000);
            } 
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please Save Coustomer First..';
            htm +='</div>';
            $('.address_block').html(htm);
            $('.invalid').slideUp(3000);  
        }
        
        
    });
    
    $(document).on("click",'.delete_address', function () {

        var address_table_id = $(this).attr('address_table_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>customer/delete_address',
            type: 'POST',
            data: {address_table_id:address_table_id},
            success: function (data) {
                elem.parent().parent().remove();
            }
        });

    });
    
    $(document).on('click','.edit_address',function(){
        var address_table_id = $(this).attr('address_table_id');
        var elem = $(this);
        
        $.ajax({
            url: '<?php echo base_url(); ?>customer/get_edit_address',
            type: 'POST',
            data: {address_table_id:address_table_id},
            success: function (data) {
                var jdata = $.parseJSON(data);
                
                $('.address_details ').val(jdata.address_details);
                $('.customer_address_title option:selected').val(jdata.customer_address_title);
                
                var html = '<a href="javascript:void(0);" address_table_id='+address_table_id+' class="btn btn-sm btn-primary update_address_button pull-right"><span class=""></span> Update </a>';
                $('.customer_address_btn').html(html);
            }
        });
    });
    $(document).on('click','.update_address_button',function(){
        var address_table_id = $(this).attr('address_table_id');
        var customer_address_title = $('.customer_address_title option:selected').val();
        var address_details = $('.address_details ').val();
        var customer_id = $('.customer_id').val();
        var elem = $(this);
        
        $.ajax({
            url: '<?php echo base_url(); ?>customer/update_edit_address',
            type: 'POST',
            data: {customer_id:customer_id,address_table_id:address_table_id,customer_address_title:customer_address_title,address_details:address_details},
            success: function (data) {
                $('.address_list').html(data);
                var htm = '<a href="javascript:void(0);" class="btn btn-sm btn-primary add_address pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>';
                $('.customer_address_btn').html(htm);
                $('.address_details ').val('');
                $('.customer_address_title option:selected').val('');
                var htm ='<div class="invalid alert alert-success">';
                htm += 'Edited Success..';
                htm +='</div>';
                $('.address_block').html(htm);
                $('.invalid').slideUp(3000);
                
            }
        });
    });
    
    $(document).on('click','.add_card ',function(){
        var customer_id = $('.customer_id').val();
        var bank_id = $('.bank_name_id option:selected').val();
        var card_type_id = $('.card_type_id option:selected').val();
        var card_no = $('.card_no').val();
        var card_expiry_date = $('.card_expiry_date').val();
//        console.log(bank_id);
//        console.log(card_type_id);
        if(customer_id){
            if(bank_id && card_type_id && card_no && card_expiry_date){
                $.ajax({
                    url: '<?php echo base_url(); ?>customer/save_card_info',
                    type: 'POST',
                    data: $("#additional_info_tab").serialize(),
                    success: function (data) {
//                        alert(data);
                        $('.card_list').html(data);
                        $(".default_flag").prop('checked', false);
                        $('.card_no ').val(' ');
                        $('.card_expiry_date ').val(' ');
                        
                        var htm ='<div class="invalid alert alert-success">';
                        htm += 'Address Saved..';
                        htm +='</div>';
                        $('.additional_info_block').html(htm);
                        $('.invalid').slideUp(3000);

                    }
                });
            }else{
                var htm ='<div class="invalid alert alert-danger">';
                htm += 'Please fill Required Field..';
                htm +='</div>';
                $('.additional_info_block').html(htm);
                $('.invalid').slideUp(3000);
            }
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please Save Coustomer First..';
            htm +='</div>';
            $('.additional_info_block').html(htm);
            $('.invalid').slideUp(3000);  
        }
    });
    
    $(document).on("click",'.delete_card', function () {

        var customer_credit_card_id = $(this).attr('customer_credit_card_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>customer/delete_card',
            type: 'POST',
            data: {customer_credit_card_id:customer_credit_card_id},
            success: function (data) {
                elem.parent().parent().remove();
            }
        });

    });
    
    $(document).on('click','.edit_card',function(){
        var customer_credit_card_id = $(this).attr('customer_credit_card_id');
        var elem = $(this);
        
        $.ajax({
            url: '<?php echo base_url(); ?>customer/get_edit_card',
            type: 'POST',
            data: {customer_credit_card_id:customer_credit_card_id},
            success: function (data) {
                var jdata = $.parseJSON(data);
//                alert(jdata.bank_id);
//                alert(jdata.card_type_id);
                
                $('.bank_name_id option:selected').val(jdata.bank_id);
                $('.card_type_id option:selected').val(jdata.card_type_id);
                $('.card_no ').val(jdata.card_no);
                $('.card_expiry_date ').val(jdata.card_expiry_date);
//                alert(jdata.default_flag);
                if(jdata.default_flag == 1){
                    $('.default_flag').prop( 'checked', true );
                }else{
                    $(".default_flag").prop('checked', false);
                }
                
                var html = '<a href="javascript:void(0);" customer_credit_card_id='+customer_credit_card_id+' class="btn btn-sm btn-primary update_card_button pull-right"><span class=""></span> Update </a>';
                $('.add_card').html(html);
            }
        });
    });
    
    $(document).on('click','.update_card_button',function(){
        var customer_credit_card_id = $(this).attr('customer_credit_card_id');
        var customer_id = $('.customer_id').val();
        var bank_id = $('.bank_name_id option:selected').val();
        var card_type_id = $('.card_type_id option:selected').val();
        var card_no = $('.card_no').val();
        var card_expiry_date = $('.card_expiry_date').val();
        var default_flag = $('.default_flag:checkbox:checked').val();
        var elem = $(this);
        alert(default_flag);
        $.ajax({
            url: '<?php echo base_url(); ?>customer/update_card_info',
            type: 'POST',
            data: {customer_id:customer_id,customer_credit_card_id:customer_credit_card_id,bank_id:bank_id,card_type_id:card_type_id,card_no:card_no,card_expiry_date:card_expiry_date,default_flag:default_flag},
            success: function (data) {
                $('.address_list').html(data);
                var htm = '<a href="javascript:void(0);" class="btn btn-sm btn-primary add_card pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>';
                $('.customer_address_btn').html(htm);
                
                var htm ='<div class="invalid alert alert-success">';
                htm += 'Edited Success..';
                htm +='</div>';
                $('.adi_info_block').html(htm);
                $('.invalid').slideUp(3000);
                
            }
        });
    });
</script>
