    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" id="outgoing_cheque_entry_frm" action="" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Outgoing Cheque Management
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>
                    
                        <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Receipt No.</label>
                                <div class="col-lg-8">
                                    <div class="col-lg-7" style="padding: 0px">
                                        <input type="text" class="form-control ChqRcptNo" name="ChqRcptNo" value="" required="required">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="button" class="btn btn-default pull-right" value="Browse">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Entry Date</label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="address" class="col-lg-4 control-label ">Branch Name</label>
                                <div class="col-lg-8">
                                    <select class="DepositBank" name="DepositBank" required="required">
                                        <option value="1001">Dhaka</option>
                                        <option value="1002">Khulna</option>
                                        <option value="1003">Rajshahi</option>
                                        <option value="1004">Comilla</option>
                                      </select> 
                                </div>
                            </div>                            
                        </div>
                        
<!--                        <div class="col-lg-12" style="margin-left: 12px;">
                            <span class="btn btn-primary">New Receipt</span>                            
                        </div>-->
                        
                        <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Cheque No.</label>
                                <div class="col-lg-8">
                                    <div class="col-lg-7"style="padding: 0px">
                                        <input type="text" class="form-control ChequeNo" name="ChequeNo" value="" required="required">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="button" class="btn btn-default pull-right" value="Browse">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4" style="margin-left: 4px;">
                                <input type="checkbox"> Is Multiple
                                <input type="checkbox"> Split Cheque
                            </div>
                            <div class="form-group col-lg-4">
                                &nbsp;
                            </div>                            
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Name On Cheque</label>
                                <div class="col-lg-8"><input type="text" class="form-control Name" name="Name" value="" required="required"></div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Bank</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control DepositBank" name="DepositBank" value="" required="required">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="address" class="col-lg-4 control-label ">Total No. of Cheque</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control customerMobile" value="1" readonly="">
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="col-lg-12" style="height: 50px;">
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label pull-left">Amount</label>
                                <div class="col-lg-8">
                                    <div class="col-lg-8" style="padding: 0px">
                                        <input type="hidden" class="TotalAmount" name="TotalAmount" value="">
                                        <input type="text" class="form-control Amount" name="Amount" value="" required="required">
                                    </div>
                                    <div class="col-lg-4" style="padding: 0px">
                                            <input type="button" class="btn btn-default pull-right" value="Get Fund">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Currency</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control Currency" value="BDT">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="address" class="col-lg-4 control-label ">Conversion Rate</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control ConversionRate" value="1">
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Reference Type</label>
                                <div class="col-lg-8">
                                    <select name="ChequeReferenceType" class="ChequeReferenceType" required="required">
                                    <option value="">Select Ref.</option>
                                    <?php
                                        foreach ($ref_name as $ref)
                                        {
                                            echo '<option value="'.$ref.'">'.$ref.'</option>';
                                        }
                                    ?>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Check Date</label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control ChequeDate" placeholder="Cheque Date" id="" name="ChequeDate" value="" required="required">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="address" class="col-lg-4 control-label ">Issue Date</label>
                                
                                <div class="col-lg-8">
                                    <input type="date" class="form-control IssueDate" placeholder="Issue Date" id="" name="IssueDate" value="" required="required">
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label for="" class="col-lg-4 control-label">Check Head</label>
                                <div class="col-lg-8">
                                    <div class="col-lg-8" style="padding: 0px">
                                        <input type="hidden" class="Ref1" name="Ref1" value="">
                                        <input type="hidden" class="Ref2" name="Ref2" value="">
                                        <input type="text" class="form-control checkHead" placeholder="Check Head" id="" name="ChequeHead" value="" required="required">
                                    </div>
                                    <div class="col-lg-4" style="padding: 0px">
                                            <input type="button" class="btn btn-default pull-right Get_cheque_Head" value="Get Head">
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-lg-1">
                                    <label for="address" class="control-label" style="float: left; padding: 15px;">Remaks</label>
                                </div>
                                <div class="col-lg-11">
                                    <textarea class="form-control" style="width: 88%; margin-left: 40px;"></textarea>
                                </div>
                            </div>                         
                        </div>
                   
            </div>
        </div>
            <div class="pull-left">
                <input type="button" id="delete"class="btn btn-danger pull-right" value="delete" style="margin:3px;">
                <input type="button" id="new"class="btn btn-primary pull-right" value="New" style="margin:3px;">
                <input type="submit" id="OutGoingChequeSave" class="btn btn-primary pull-right" value="Save" style="margin:3px;">
                <input type="button" id="Modify"class="btn btn-primary pull-right" value="Modify" style="margin:3px;">
                <input type="button" id="Print"class="btn btn-primary pull-right" value="Print" style="margin:3px;">
            </div>
        </form>
    </div>
        
        
        
        
        <!-- get cheque head modal -->
	<div id="add_product_m" class="modal fade " role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal" style="width: 980px;">
                <!-- Modal content-->
                <div class="modal-content" style="overflow:hidden; padding-bottom:15px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Payment Approval Info</h3>
                    </div>
                    <div class="modal-body show_payment_approval_preview" style="overflow: hidden">
                        
                    </div>
                </div>

            </div>
        </div>
        <style>
            .cheque_head_html tr td{
                cursor: pointer;
            }
            .cheque_value_html:hover{
                background: #428bca;
            }
        </style>
<script>
    $(document).on("click","#OutGoingChequeSave", function (e) {
        e.preventDefault();
        alert();
        $.ajax({
            url: '<?php echo base_url(); ?>accounts_cheque_management/out_going_cheque_save',
            type: 'POST',
            data: $('#outgoing_cheque_entry_frm').serialize(),
            success: function (data) {
                if(data == true)
                {
                    var htm ='<div class="invalid alert alert-success">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += 'Successfully saved.';
                    htm +='</div>';
                    $('.order_block').html(htm);
                }
            }
        });
    });
    
    $(document).on("click",".cheque_value_html", function () {
        var amount = $(this).attr("cc_amount");
        var pand_id = $(this).attr("pand_id"); 
        var pan_code = $(this).attr("pan_code");
        var cc_name = $(this).attr("cc_name");
        $('.Amount').val(amount);
        $('.checkHead').val(cc_name);
        $('.Ref1').val(pan_code);
        $('.Ref2').val(pand_id);
        $('#add_product_m').modal("hide");
    });
    
    $(".Get_cheque_Head").on("click", function () {
        var ChequeReferenceType = $('.ChequeReferenceType option:selected').val(); 
        $('.Amount').val("");
        $('.checkHead').val("");
        $('.Ref1').val("");
        $('.Ref2').val("");
        if(ChequeReferenceType)
        {            
            $.ajax({
                url: '<?php echo base_url(); ?>accounts_cheque_management/get_cheque_head',
                type: 'POST',
                data: {ChequeReferenceType: ChequeReferenceType},
                success: function (data) {
                    $('#add_product_m').modal("show");
                    $('.show_payment_approval_preview').html(data);
                }
            });
        }
        else
        {
            alert("Please Select Ref. Type");
        }
    });
</script>