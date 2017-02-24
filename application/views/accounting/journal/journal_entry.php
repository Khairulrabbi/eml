
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title" style="overflow: hidden;">
                    <div class="pull-left" style="width:40%;"><h4>Create Journal</h4></div>
                    <div class="pull-right" style="width: 40%;">
                        <form action="" method="POST">
                            <div class="input-group">
                                <input style="z-index: 2 !important;" class="form-control datepicker" type="text" name="day_close" value="<?php echo $day_closed_date; ?>" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit" style="padding: 2px 10px;" readonly>Day Close</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    
                    <form id="journal_final_submit" method="POST" action="<?php echo base_url().'accounts_configuration/journal_final_submit';?>">
                        <div class="finalSubmitMsg"></div>
                        <div class="col-lg-1">
                            <label>Journal Date</label>
                            <input type="text" name="journal_date" class="form-control datepicker" required="" value="<?php echo $day_closed_date; ?>" readonly/>
                            <div class="dr_cr_show">
                                <input value="0.00" type="hidden" id="total_dr" name="total_dr" readonly/>
                            </div>
                            <div class="dr_cr_show">
                                <input value="0.00" type="hidden" id="total_cr" name="total_cr" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Journal Type</label>
                            <select id="journal_type" name="journal_type" class="form-control" required="" readonly>
                                <option value="">Select</option>
                                <?php foreach($journal_type_list as $journal_type){
                                   echo '<option value="'.$journal_type['journal_type_name'].'">'.$journal_type['journal_type_name'].'</option>'; 
                                }?>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Voucher Number</label>
                            <input type="text" name="voucher_auto_no" class="form-control" value="<?php echo $auto_voucher_num;?>" readonly/>
                        </div>
                        <div class="col-lg-2">
                            <label>
                                <input type="checkbox" id="manual_jrnl_chk"/>
                                Manual Voucher Number
                            </label>
                            <input id="manual_jrnl" type="text" name="voucher_manual_no" class="form-control" value="" readonly/>
                        </div>
                        <div class="col-lg-5">
                            <label>Narration</label>
                            <textarea name="narration" class="form-control" rows="1" style="min-height: 26px !important;"></textarea>
                        </div>
                    </form>
                </div>
                    
                
                    <form action="" method="post" id="frm_journal">
                        <span id="jour_id" hidden=""></span>
                        <div class="col-lg-8">
                            <div class="col-lg-5">
                                <label>Account</label>
                                <input type="hidden" name="VoucherNo" class="VoucherNo" value="" autocomplete="off">
                                <input type="hidden" name="SLNo" class="SLNo" value="" autocomplete="off">
                                <select id="acc_head_id" name="acc_head_id" class="form-control" required="">
                                    <option value="">Select</option>
                                    <?php foreach($acc_head_list as $acc_head){
                                       echo '<option value="'.$acc_head['AccountCode'].'">'.$acc_head['AccountCode'].'-'.$acc_head['AccountName'].'</option>'; 
                                    }?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label>Dr. Amount</label>
                                <input step="0.01" oninvalid="this.setCustomValidity('Please fill out this field or credit amount');" type="number" name="dr_amount" id="dr_amount" class="form-control" value="" required=""/>
                            </div>
                            <div class="col-lg-2">
                                <label>Cr. Amount</label>
                                <input step="0.01" oninvalid="this.setCustomValidity('Please fill out this field or debit amount');" type="number" name="cr_amount" id="cr_amount" class="form-control" value="<?php echo @$edit_journal->cr_amount ?>" required="" />
                            </div>
                            <div class="col-lg-2">
                                <label>Currency</label>
                                <?php echo currency_without_id(); ?>
                            </div>
                            <div class="col-lg-1">
                                <label>Rate</label>
                                <input type="text" id="rate" name="currency_rate" class="form-control" />
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <label><h3>Tagged Account</h3></label>
                            </div>
                            <div class="col-lg-12" id="tagged_acc" style=""></div>
                            <div class="alert alert-danger emsg" style="display: none">
                                You can not select a parent head..
                            </div>
                        </div>
                        <div class="form-group" style="width: 96%; margin-left: 28px;">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" style="height: 40px;"></textarea>
                        </div>
                        
                        
                        <div class="col-lg-12" style="margin-left:10px;margin: 5px; margin-left: 10px;">
                            <input type="submit" value="Save" class="btn btn-primary"/>
                        </div>
                    </form>
               
                </div>
            </div>
    </div>

    <div class="col-lg-12">
                    <table id="tbl_journal" class="table table-bordered table-striped">
                        <thead>
                            <tr class="table_head_foot">
                                <th class="text-center">Account Head</th>
                                <th class="text-center" style="width:10%;">Dr. Amount</th>
                                <th class="text-center" style="width:10%;">Cr. Amount</th>
                                <th class="text-center">Currency</th>
                                <th class="text-center">Currency Rate</th>
                                <th class="text-center" style="width:30%;">Description</th>
                                <th class="text-center">Tagged Acc.</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr class="table_head_foot">
                                <th class="text-center">Total</th>
                                <th class="text-right" id="dr_tb_show"></th>
                                <th class="text-right" id="cr_tb_show"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                
                    <input style="" type="submit" id="btn_confirm" disabled="disabled" class="btn btn-primary" value="Confirm"/>
                </div>
    



<style>
    .alert {
        padding: 2px;
        margin-bottom: 5px;
    }
    .close {
        float: right;
        font-size: 19px;
        font-weight: normal;
        line-height: 12px;
        color: #FFFFFF;
        /* text-shadow: 0 1px 0 #fff; */
        filter: alpha(opacity=20);
        opacity: .8;
        background-color: red;
        border-radius: 5px;
    }
    input[type="checkbox"]{
        margin: 0;
    }
    .table_head_foot{
    background-color: #333;
    color: #fff;
}
</style>
<script>
$(document).ready(function(){
    $('#frm_journal input').keydown(function(e){
        if(e.keyCode==13){
            if($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type')=='submit'){
               // check for submit button and submit form on enter press
                return true;
            }
            $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
            return false;
        }
    });

    $('select[name="currency"]').val('BDT');
    $('input[name="currency_rate"]').val('1.00');
});
$('#manual_jrnl_chk').on('click',function(){
    if($(this).is(':checked')) {
        $('#manual_jrnl').removeAttr('readonly');
    }
    else{
        $('#manual_jrnl').attr('readonly', true);
    }
});

$('#acc_head_id').change(function(){
    var AccountCode = $(this).val();
    var id = $('#jour_id').text();
    $.ajax({
        url:'<?php echo base_url() ?>accounts_configuration/get_tagged_account',
        type:'post',
        data:{AccountCode:AccountCode,id:id},
        success:function(data){
            $('#tagged_acc').html(data);
            $('#tagged_acc select').select2();
        }
    });
});
$('#frm_journal').submit(function(e){
    e.preventDefault();
    var transaction_date = $('input[name="journal_date"]').val();
    //alert(transaction_data);
    var frm_data = $('#frm_journal').serialize();
    var tag_data = $('#frm_tag').serialize();
    var id = $('#tbl_journal tbody tr').length;
    //alert(id);
    var jour_id = $('#jour_id').text();
    //$("#journal_type").select2("readonly", true);
    if(jour_id ){
        var SLNo = $('.SLNo').val();
        $.ajax({
            url:'<?php echo base_url().'accounts_configuration/save_journal_to_temp';?>',
            type: 'post',
            data:'journal_details_id='+jour_id+'&'+frm_data+'&'+tag_data+'&edit=y&TransactionDate='+transaction_date,
            success:function(data){
                var fdata = data.replace(/(\r\n|\n|\r)/gm,"");
                var i = jour_id;
                $('#tbl_journal tbody tr:nth-child('+id+')').html(''); 
                //add_row(i,1);
                add_row(SLNo,1,fdata,"edit");
                $('#jour_id').text('');
                $('.SLNo').val('');
            }
        });
    }else{
        $.ajax({
            url:'<?php echo base_url().'accounts_configuration/save_journal_to_temp';?>',
            type: 'post',
            data:'journal_details_id='+parseInt(id+1)+'&'+frm_data+'&'+tag_data+'&TransactionDate='+transaction_date,
            success:function(data){
                if(data != 1){
                    var fdata = data.replace(/(\r\n|\n|\r)/gm,"");
                    $('.VoucherNo').val(fdata);
                    add_row(id,0,fdata,"add");
                }else{
                    $(".emsg").show().delay(5000).addClass("in").fadeOut(4000);
                }
            }
        });
    }
    
});

$('#journal_final_submit').submit(function(e){
alert("hlw");
    e.preventDefault();
    var voucherno = $('.VoucherNo').val();
    //alert();
    var form_data = $(this).serialize();
     $.ajax({
        url:'<?php echo base_url().'accounts_configuration/journal_final_submit';?>',
        type: 'post',
        data:form_data+'&voucherno='+voucherno,
        success:function(data){
            if(data == true)
            {
//                var htm ='<div class="invalid alert alert-primary">';
//                htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//                htm += 'Successfully Inserted.';
//                htm +='</div>'; 
                var htm ='<div class="invalid alert alert-success">';
                htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                htm += 'Successfully Inserted.';
                htm +='</div>';
                $('.finalSubmitMsg').html(htm);
                window.location.href = "<?php echo base_url().'accounts_configuration/journal_entry'; ?>";
            }            
        }
    });
});

$('#btn_confirm').on('click',function(){
    if($(this).is('[disabled=disabled]') === false){
        
        if($("#journal_type").val()){
            //alert("value ase");
            $('#journal_final_submit').submit();
            //$("#journal_type").select2("readonly", true);
        }
        //
    }
});
//$('#journal_type').on('change',function(){
//    if($("#journal_type").val()){
//        $("#journal_type").select2("readonly", true);
//    }
//});

$(document).on('click','.btn_rmv_tag',function(){
    var details_id = $(this).data('details_id');
    var table_name = $(this).data('table_name');
    var voucherNo = $(this).attr("vn");
    var slno = $(this).attr("slNo");
    var fnnumber = $(this).attr("fnnumber");
    $.ajax({
        url:'<?php echo base_url().'accounts_configuration/remove_tag_from_temp';?>',
        type: 'post',
        data:{details_id:details_id,table_name:table_name,voucherNo:voucherNo,slno:slno,fnnumber:fnnumber},
        success:function(data){
            
        }
    });
});

$('input[name="dr_amount"]').on('input',function(){
    $('input[name="cr_amount"]').val('');
    $('input[name="cr_amount"]').removeAttr('required');
    if($(this).val()!=''){
        document.getElementsByName('dr_amount')[0].setCustomValidity('');
        document.getElementsByName('cr_amount')[0].setCustomValidity('');
    }
    $(this).attr('required','required');
});
$('input[name="cr_amount"]').on('input',function(){
    $('input[name="dr_amount"]').val('');
    $('input[name="dr_amount"]').removeAttr('required');
    if($(this).val()!=''){
        document.getElementsByName('dr_amount')[0].setCustomValidity('');
        document.getElementsByName('cr_amount')[0].setCustomValidity('');
    }
    $(this).attr('required','required');
});

$(document).on('click','.jarnel_remove',function(){
    var elem = $(this).parent('td').parent('tr');
    var journal_details_id = (elem.index()+1);
    var voucherNo = $(this).attr("voucherNo");
    var slno = $(this).attr("id");
    check_debit_credit();
    $.ajax({
        url:'<?php echo base_url().'accounts_configuration/remove_journal_from_temp';?>',
        type: 'post',
        data:{details_id:journal_details_id,voucherNo:voucherNo,slno:slno}
    });
    elem.remove('tr');
    calculate();
});

function check_debit_credit(){
    var total_dr = $('#total_dr').val();
    var total_cr = $('#total_cr').val();
    if(total_dr !== total_cr){
        $('.dr_cr_show').addClass('has-error');
        $('.dr_cr_show').removeClass('has-success');
        $('#btn_confirm').attr('disabled','disabled');
    }else{
        //alert(total_cr);
        $('.dr_cr_show').addClass('has-success');
        $('.dr_cr_show').removeClass('has-error');
        $('#btn_confirm').removeAttr('disabled');
    }
}

function add_row(id,row_to_insert,voucherNo,type){
    if (typeof(row_to_insert)==='undefined') row_to_insert = 0;
    if(type == 'add')
    {
        var id = parseInt(id) + 1;
    }
    
    var tag_acc = '';
	var fnnumber = 1;
    $('#tagged_acc select').each(function(){
        var f_title = $(this).children("option").filter(":selected").val();
        tag_acc = tag_acc + '<div class="alert label-info"><a slNo="'+id+'" vn="'+voucherNo+'" fnnumber="'+f_title+'" href="#" data-details_id="'+parseInt(id+1)+'" data-table_name="'+f_title+'" class="close btn_rmv_tag" data-dismiss="alert" aria-label="close">&times;</a>' + $(this).children("option").filter(":selected").text() + '</div>';
		fnnumber++;
	});
    
    var tr = '';
    tr = tr + '<td>'+$('select[name="acc_head_id"] option:selected').text()+'</td>';
    tr = tr + '<td class="dr_td_am text-right">'+$('input[name="dr_amount"]').val()+'</td>';
    tr = tr + '<td class="cr_td_am text-right">'+$('input[name="cr_amount"]').val()+'</td>';
    tr = tr + '<td>'+$('select[name="currency"]').val()+'</td>';
    tr = tr + '<td class="text-right">'+$('input[name="currency_rate"]').val()+'</td>';
    tr = tr + '<td>'+$('textarea[name="description"]').val()+'</td>';
    tr = tr + '<td>'+tag_acc+'</td>';
    //tr = tr + '<td><button type="button" class ="btn btn-primary btn-sm jarnel_edit"  id = "'+ id +'" ><i class="glyphicon glyphicon-pencil"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-sm btn-remove"><span class="glyphicon glyphicon-remove"></span> </button></td>';
    tr = tr + '<td class="text-center"><i style="cursor:pointer;" id = "'+ id +'" voucherNo = "'+voucherNo+'" class="text-info glyphicon glyphicon-pencil jarnel_edit"></i>&nbsp;&nbsp;<i style="cursor:pointer;" id = "'+ id +'" voucherNo = "'+voucherNo+'" class="text-danger glyphicon glyphicon-remove jarnel_remove"></i>';
    if(row_to_insert === 0){
        $('#tbl_journal').append('<tr>'+tr+'</tr>');
    }else{
        if(type == 'add')
        {
            var row_id  = parseInt(id)-1;
        }
        else if(type == 'edit')
        {
            var row_id = id;
        }
       
       $('#tbl_journal tbody tr:nth-child('+row_id+')').html(tr); 
    }
    $('.panel-body').find("input[type=number]:not([readonly]), textarea, select[name='acc_head_id']").val("");
    $('select[name="acc_head_id"]').select2("val", "");
    $('select[name="currency"]').val('BDT');
    $('input[name="currency_rate"]').val('1.00');
    $('#tagged_acc').html('');
    calculate();
    check_debit_credit();
}

$(document).on('click','.jarnel_edit',function(){
    var id = $(this).attr("id");
    var voucherNo = $(this).attr("voucherNo");
    //alert(id);
    $.ajax({
        url:'<?php echo base_url().'accounts_configuration/edit_journal';?>',
        type: 'post',
        data:{id:id,voucherNo:voucherNo},
        dataType: 'json',
        success:function(data){
            $('#jour_id').text(data[0].VoucherLineID);
            $('#acc_head_id').val(data[0].AccountName).trigger("change");
            $('#dr_amount').val(data[0].Debit);
            $('#cr_amount').val(data[0].Credit);
            $('#rate').val(data[0].Rate);
            $('.SLNo').val(data[0].SLNo);
            //$('#description').val(data[0].description);
            
        }
    });
});

function calculate(){
    var sum=0;
    $('.dr_td_am').each(function(){
        sum = sum + parseInt($(this).text() || 0);
    });
    $('#total_dr').val(sum).bdt({bdt_sign: ''});
    $('#dr_tb_show').text(sum);
    
    var sum=0;
    $('.cr_td_am').each(function(){
        sum = sum + parseInt($(this).text() || 0);
    });
    $('#total_cr').val(sum).bdt({bdt_sign: ''});
    $('#cr_tb_show').text(sum);
    
    var total_dr = $('#total_dr').val();
    var total_cr = $('#total_cr').val();
    if(total_dr !== total_cr){
        $('.dr_cr_show').addClass('has-error');
        $('.dr_cr_show').removeClass('has-success');
        $('#btn_confirm').attr('disabled','disabled');
    }else{
        //alert(total_cr);
        $('.dr_cr_show').addClass('has-success');
        $('.dr_cr_show').removeClass('has-error');
        $('#btn_confirm').removeAttr('disabled');
    }
}
</script>