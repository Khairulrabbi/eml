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
                                        <h3 class="panel-title">Basic Information </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name" class="col-lg-4 control-label">Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" required class="form-control name" name="customer_name" value="<?php echo @$customer_data->customer_name;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_type" class="col-lg-4 control-label">Customer Type <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <?php echo customer_type(@$customer_data->customer_type_id,array('class' => 'customer_type_id', 'required' => 'required'));?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="company" class="col-lg-4 control-label">Company </label>
                                            <div class="col-lg-8">
                                                <?php echo company(@$customer_data->company_id,array('class' => 'company_id'));?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="credit_limit" class="col-lg-4 control-label">Credit Limit <span class="text-danger">*</span></label>
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
                                        <h3 class="panel-title">Contact Information </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="contact_person" class="col-lg-4 control-label">Contact Person </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control contact_person" name="contact_person" value="<?php echo @$customer_data->contact_person;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile" class="col-lg-4 control-label">Mobile Number <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" required class="form-control phone" name="mobile_number" value="<?php echo @$customer_data->mobile_number;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="col-lg-4 control-label">Phone Number </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control phone" name="phone_number" value="<?php echo @$customer_data->phone_number;?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fax" class="col-lg-4 control-label">Fax </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control fax" name="fax_number" value="<?php echo @$customer_data->fax_number;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-lg-4 control-label">Email </label>
                                                <div class="col-lg-8">
                                                    <input type="email" class="form-control email" name="email" value="<?php echo @$customer_data->email;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="website" class="col-lg-4 control-label">Website </label>
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
                                        <h3 class="panel-title">Purchase Information </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="currency" class="col-lg-3 control-label">Currency </label>
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
                                                <label for="discount" class="col-lg-3 control-label">Discount </label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control discount" name="discount" aria-describedby="basic-addon1" value="<?php echo @$customer_data->discount;?>">
                                                        <span class="input-group-addon" id="basic-addon1">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_terms" class="col-lg-3 control-label">Payment Terms </label>
                                                <div class="col-lg-9">
                                                    <?php echo credit_note(@$customer_data->credit_note_id, array('class' => 'credit_note_id')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tax" class="col-lg-3 control-label">Tax </label>
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
                                        <h3 class="panel-title">Remarks </h3>
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
                        <input type="hidden" id="customer_id" class="customer_id" name="customer_id" value="">
                        <div class="text-center basic_info_block"></div>
                        <div class="row">
                            <div class="col-lg-12" style="padding-right: 129px;">
                                <h3 class="text-success text-right customer_name"></h3>
                            </div>
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Address </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="text-center address_block"></div>
                                    <div class="field_wrapper">
                                        <div class="col-lg-8">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label">Title <span class="text-danger">*</span></label>
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
                                                    <label for="" class="col-lg-4 control-label">Address <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control address_details" name="address_details"></textarea>
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
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; foreach ($customer_address as $value){?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><?php echo $value['customer_address_title'];?></td>
                                                                    <td><?php echo $value['address_details'];?></td>
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
                        <input type="hidden" id="customer_id" class="customer_id" name="customer_id" value="">
                        <div class="text-center additional_info_block"></div>
                        <div class="row">
                            <div class="col-lg-12" style="padding-right: 129px;">
                                <h3 class="text-success text-right customer_name"><?php echo @$customer_data->customer_name;?></h3>
                            </div>
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Credit Card Info </h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="text-center adi_info_block"></div>
                                    <div class="field_wrapper">
                                        <div class="col-lg-6">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="bank" class="col-lg-4 control-label">Bank Name</label>
                                                    <div class="col-lg-6">
                                                        <?php echo bank('', array('class'=>'bank_name_id'));?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank" class="col-lg-4 control-label">Card Type</label>
                                                    <div class="col-lg-6">
                                                        <?php echo card_type('', array('class'=>'card_type_id'));?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6"> 
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label">Card No.</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control card_no" name="card_no" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label">Expiry Date</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control card_expiry_date" name="card_expiry_date" value="" placeholder="Ex: 0416">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-lg-4 control-label">Default</label>
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
                                            <?php if(isset($customer_address)){?>
                                                <div class="scrolltable">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#Sl</th>
                                                                <th>Address Title</th>
                                                                <th>Details</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; foreach ($customer_address as $value){?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><?php echo $value['customer_address_title'];?></td>
                                                                    <td><?php echo $value['address_details'];?></td>
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
                <div id="order_history" class="tab-pane fade">
                    <div id="sales" style="min-width: 1250px; height: 400px; margin: 0 auto"></div>
                </div>
                <div id="payment_history" class="tab-pane fade">
                    <div id="warranty" style="min-width: 1250px; height: 400px; margin: 0 auto"></div>
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
