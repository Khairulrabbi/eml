<div class="panel panel-default">
    <div class="panel-heading">
        Create Journal
    </div>
    <div class="panel-body">
        <div class="row">
            <div style="display:none;" class="alert alert-success msg">Voucher Entry Successful with number <strong><span id="v_num"></span></strong></div>
            <div class="col-lg-12">
                <form id="journal_final_submit" method="POST" action="<?php echo base_url().'accounts_configuration/journal_final_submit';?>">
                    <div class="col-lg-1">
                        <label>Entry Date</label>
                        <input type="text" name="entry_date" class="form-control" required="" value="<?php echo date('Y-m-d'); ?>" readonly/>
                        <div class="dr_cr_show">
                            <input value="0.00" type="hidden" id="total_dr" name="total_dr" readonly/>
                        </div>
                        <div class="dr_cr_show">
                            <input value="0.00" type="hidden" id="total_cr" name="total_cr" readonly/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Voucher Date</label>
                        <input type="date" name="voucher_date" class="form-control" required=""/>
                    </div>
                    <div class="col-lg-2">
                        <label>Journal Type</label>
                        <?php echo voucher_type();  ?>
                    </div>
                    <div class="col-lg-2">
                        <label>Voucher Number</label>
                        <input type="text" name="voucher_number_auto" class="form-control" value="<?php echo $auto_voucher_num;?>" readonly/>
                    </div>
                    <div class="col-lg-2">
                        <label>
                            <input type="checkbox" id="manual_jrnl_chk"/>
                            Manual Voucher Number
                        </label>
                        <input id="manual_jrnl" type="text" name="voucher_number" class="form-control" value="" readonly/>
                    </div>
                    <div class="col-lg-3">
                        <label>Narration</label>
                        <textarea name="narration" class="form-control" rows="1" style="min-height: 26px !important;"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" id="frm_journal">
                <span id="jour_id" hidden=""></span>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="col-lg-5">
                            <label>Account</label>
                            <select id="acc_head_id" name="acc_head_id" class="form-control" required="">
                                <option value="">Select</option>
                                <?php foreach($acc_head_list as $acc_head){
                                   echo '<option value="'.$acc_head['acc_head_id'].'">'.$acc_head['acc_head_number'].'-'.$acc_head['acc_head_name'].'</option>'; 
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
                            <select name="currency" class="form-control">
                                <option value="BDT">BDT</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label>Rate</label>
                            <input type="text" id="rate" name="currency_rate" class="form-control" />
                        </div>
                        <div class="col-lg-12">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" style="height: 40px;"></textarea>
                        </div>
                    </div>
                
                    <div class="col-lg-4">
                        <div class="text-center">
                            <label><h3>Tracked Account</h3></label>
                        </div>
                        <div class="col-lg-12" id="tagged_acc" style="">
                            <div class="row">
                                <div class="col-lg-6 no_show track_agreement"> <!-- Track agreement -->
                                    <div class="input-group" style="margin-bottom: 10px;">
                                        <input id="agreement_id" type="text" class="form-control tracking_input" placeholder="Search for Agreement" readonly>
                                        <span class="input-group-btn">
                                          <a href="show_table/agreement" data-target="#myModal" style="background:#CACACA;" class="btn btn-secondary launch_list">...</a>
                                        </span>
                                    </div>
                                    <input name="agreement_id" type="hidden" />
                                </div>
                                <div class="col-lg-6 no_show track_customer"> <!-- Track Customer -->
                                    <div class="input-group" style="margin-bottom: 10px;">
                                        <input id="customer_id" type="text" class="form-control tracking_input" placeholder="Search for customer" readonly>
                                        <span class="input-group-btn">
                                          <a href="show_table/customer" data-target="#myModal" style="background:#CACACA;" class="btn btn-secondary launch_list">...</a>
                                        </span>
                                    </div>
                                    <input name="customer_id" type="hidden" />
                                </div>
                                <div class="col-lg-6 no_show track_employee"> <!-- Track Employee -->
                                    <div class="input-group" style="margin-bottom: 10px;">
                                        <input id="employee_id" type="text" class="form-control tracking_input" placeholder="Search for Employee" readonly>
                                        <span class="input-group-btn">
                                          <a href="show_table/employee" data-target="#myModal" style="background:#CACACA;" class="btn btn-secondary launch_list">...</a>
                                        </span>
                                    </div>
                                    <input name="employee_id" type="hidden" />
                                </div>
                                <div class="col-lg-6 no_show track_vendor"> <!-- Track Vendor -->
                                    <div class="input-group" style="margin-bottom: 10px;">
                                        <input id="vendor_id" type="text" class="form-control tracking_input" placeholder="Search for vendor" readonly>
                                        <span class="input-group-btn">
                                          <a href="show_table/vendor" data-target="#myModal" style="background:#CACACA;" class="btn btn-secondary launch_list">...</a>
                                        </span>
                                    </div>
                                    <input name="vendor_id" type="hidden" />
                                </div>
                                <div class="col-lg-6 no_show track_bill"> <!-- Track Bill -->
                                    <div class="input-group" style="margin-bottom: 10px;">
                                        <input id="bill_id" type="text" class="form-control tracking_input" placeholder="Search for Bill" readonly>
                                        <span class="input-group-btn">
                                          <a href="show_table/bill" data-target="#myModal" style="background:#CACACA;" class="btn btn-secondary launch_list">...</a>
                                        </span>
                                    </div>
                                    <input name="bill_id" type="hidden" />
                                </div>
                                <div class="col-lg-6 no_show track_bank bank_id"> <!-- Track Bank -->
                                    <div class="input-group" style="margin-bottom: 10px;">
                                        <input id="bank_id" type="text" class="form-control tracking_input" placeholder="Search for Bank" readonly>
                                        <span class="input-group-btn">
                                          <a href="show_table/bank" data-target="#myModal" style="background:#CACACA;" class="btn btn-secondary launch_list">...</a>
                                        </span>
                                    </div>
                                    <input name="bank_id" type="hidden">
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger emsg" style="display: none">
                            You can not select a parent head..
                        </div>
                    </div>
                </div>
                    <div class="col-lg-12" style="margin-top:5px;">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>
            </form>
        </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="col-lg-12">
            <table id="tbl_journal" class="table table-bordered table-striped">
                <thead>
                    <tr class="table_head_foot">
                        <th class="text-center">Account Head</th>
                        <th class="text-center">Dr. Amount</th>
                        <th class="text-center">Cr. Amount</th>
                        <th class="text-center">Currency</th>
                        <th class="text-center">Currency Rate</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Customer ID</th>
                        <th class="text-center">Vendor ID</th>
                        <th class="text-center">Employee ID</th>
                        <th class="text-center">Agreement ID</th>
                        <th class="text-center">Bank ID</th>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-lg-12">
            <input style="" type="submit" id="btn_confirm" disabled="disabled" class="btn btn-primary" value="Confirm"/>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Modal title</h4>

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<style>
    .no_show{
        display: none;
    }
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
</style>
<script>
var form_obj = [];
$(document).ready(function(){
    
    var modal_launcher;
    $(document).on('click','.launch_list',function(ev){
        ev.preventDefault();
        modal_launcher = $(this);
        var target = $(this).attr("href");
        // load the url and show modal on success
        $("#myModal .modal-body").load(target, function() { 
             $("#myModal").modal("show"); 
        });
    });
    
    $(document).on('click','.closemodal',function(){
        var target_elm = modal_launcher.parent().parent();
        target_elm.find('input').val($(this).text());
        target_elm.siblings('input').val($(this).data('id'));
        $('#myModal').modal('hide');
    });
    
    /*$('#myModal').on('hidden.bs.modal', function () {
        alert('sdsd');
    });*/
    
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
    $('.tracking_input').val('');
    $('.no_show').css('display','none');
    var acc_head_id = $(this).val();
    var id = $('#jour_id').text();
    $.ajax({
        url:'<?php echo base_url() ?>accounts_configuration/get_tagged_account',
        type:'post',
        data:{acc_head_id:acc_head_id,id:id},
        success:function(data){
            var name;
            var p  = $.parseJSON(data);
            for(name in p){
                $('.'+name).css('display','block');
            }
        }
    });
});
$('#frm_journal').submit(function(e){
    e.preventDefault();
    var frm_data = $('#frm_journal').serializeArray();
    //var tag_data = $('#frm_tag').serialize();
    form_obj.push(frm_data);
    var count = Object.keys(form_obj).length;
    //alert(count);
    var edit = 0;
    if($('#jour_id').text() != '') {
        alert('I have received an update command.');
        count = $('#jour_id').text();
        form_obj.splice(count-1,1);
        edit = 1;
    }
    add_row(count,edit,frm_data);
    return alert(JSON.stringify(form_obj));
    
    
    var id = $('#tbl_journal tbody tr').length;
    var jour_id = $('#jour_id').text();
    if(jour_id ){
        $.ajax({
            url:'<?php echo base_url().'accounts_configuration/save_journal_to_temp';?>',
            type: 'post',
            data:'journal_details_id='+jour_id+'&'+frm_data+'&'+tag_data,
            success:function(data){
                var i = jour_id;
                $('#tbl_journal tbody tr:nth-child('+i+')').html(''); 
                add_row(i,1);
                $('#jour_id').text('');
            }
        });
        
    }else{
        $.ajax({
            url:'<?php echo base_url().'accounts_configuration/save_journal_to_temp';?>',
            type: 'post',
            data:'journal_details_id='+parseInt(id+1)+'&'+frm_data+'&'+tag_data,
            success:function(data){
                if(data != 1){
                    add_row(id);
                }else{
                    $(".emsg").show().delay(5000).addClass("in").fadeOut(4000);
                }
            }
        });
    }
});

$('#frm_main').submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
     $.ajax({
        url:'<?php echo base_url().'accounts_configuration/journal_final_submit';?>',
        type: 'post',
        data:form_data,
        success:function(){
            location.reload();
        }
    });
});

$('#btn_confirm').on('click',function(){
    if($(this).is('[disabled=disabled]') === false){
        //$('#journal_final_submit').submit();
        var form_data = $('#journal_final_submit').serializeArray();
        $.ajax({
           url:'<?php echo base_url().'accounts_configuration/journal_final_submit';?>',
           type: 'post',
           data:{form_main:form_data,details_data:form_obj},
           success:function(data){
               $('#v_num').text(data);
               $('.msg').show();
               setTimeout(function(){location.reload();},3000);
           }
       });
    }
})

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
    var id = $(this).siblings('.voucher_edit').attr("id");
    form_obj.splice(id-1,1);
    check_debit_credit();
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
function add_row(id,row_to_insert,json_data){
    
    if (typeof(row_to_insert)==='undefined') row_to_insert = 0;
       
    var tr = '';
    tr = tr + '<td>'+$('select[name="acc_head_id"] option:selected').text()+'</td>';
    tr = tr + '<td class="dr_td_am text-right">'+$('input[name="dr_amount"]').val()+'</td>';
    tr = tr + '<td class="cr_td_am text-right">'+$('input[name="cr_amount"]').val()+'</td>';
    tr = tr + '<td>'+$('select[name="currency"]').val()+'</td>';
    tr = tr + '<td class="text-right">'+$('input[name="currency_rate"]').val()+'</td>';
    tr = tr + '<td>'+$('textarea[name="description"]').val()+'</td>';
    tr = tr + '<td data-id="customer_id">'+$('input[id="customer_id"]').val()+'</td>';
    tr = tr + '<td data-id="vendor_id">'+$('input[id="vendor_id"]').val()+'</td>';
    tr = tr + '<td data-id="employee_id">'+$('input[id="employee_id"]').val()+'</td>';
    tr = tr + '<td data-id="agreement_id">'+$('input[id="agreement_id"]').val()+'</td>';
    tr = tr + '<td data-id="bank_id">'+$('input[id="bank_id"]').val()+'</td>';
    //tr = tr + '<td><button type="button" class ="btn btn-primary btn-sm jarnel_edit"  id = "'+ id +'" ><i class="glyphicon glyphicon-pencil"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-sm btn-remove"><span class="glyphicon glyphicon-remove"></span> </button></td>';
    tr = tr + '<td class="text-center"><i style="cursor:pointer;" id = "'+ id +'" class="text-info glyphicon glyphicon-pencil voucher_edit"></i>&nbsp;&nbsp;<i style="cursor:pointer;" class="text-danger glyphicon glyphicon-remove jarnel_remove"></i>';
    if(row_to_insert == 0){
        alert('fd');
        $('#tbl_journal').append('<tr>'+tr+'</tr>');
    }else{
       var row_id  = parseInt(id)-1;
       alert('#tbl_journal tbody tr:nth-child('+row_id+')');
       $('#tbl_journal tbody tr:nth-child('+id+')').html(tr); 
    }
    $('.panel-body').find("input[type=number]:not([readonly]), textarea, select[name='acc_head_id']").val("");
    $('select[name="acc_head_id"]').select2("val", "");
    $('select[name="currency"]').select2('val','BDT');
    $('input[name="currency_rate"]').val('1.00');
    $('#jour_id').text('');
    $('.no_show').css('display','none');
    $('.no_show').find('input').val('');
    calculate();
    check_debit_credit();
}

$(document).on('click','.voucher_edit',function(){
    var id = $(this).attr("id");
    //alert($(this).parent().parent().html());
    $(this).parent().parent().children("td:gt(5)").not(":last").each(function(){
        var elem_id = $(this).data('id');
        $('#'+elem_id).val($(this).text());
    });
    //return;
    $('#jour_id').text(id);
    //alert(JSON.stringify(form_obj[id-1]));
    var json_data = form_obj[id-1]
    for(k in json_data) {
       /* As we know after 6 object tracking information will come 
       * We set some css rule for track account
       */
       if(k > 5 && json_data[k].value != ''){
            $('.'+json_data[k].name).css('display','block');
        }
        $('[name="'+json_data[k].name+'"]').val(json_data[k].value);
    }
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
}


</script>