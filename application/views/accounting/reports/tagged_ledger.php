<div class="row">
    <div class="col-lg-12">      
        <div class="panel panel-default">
            <div class="panel-heading">Ledger Reports</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="post">
                            <div class="col-lg-12" style="margin-left: -10px;">
                                <div class="col-lg-2">
                                    <label>Select Tag</label>
                                    <select name="tagField" id="tagId" class="form-control" required="">
                                        <option value="">Select</option>
                                        <?php foreach($tag_list as $tags){
                                           echo '<option value="'.$tags['acc_tag_id'].'">'.$tags['acc_tag_name'].'</option>'; 
                                        }?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Select Account</label>
                                    <div id="acc_head"></div>
                                </div>
                                <div class="col-lg-2" style="margin-left: -5px;">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" value="" class="form-control datepicker"  />
                                </div>
                                <div class="col-lg-2">
                                    <label>End Date</label>
                                    <input type="text" name="end_date" value="" class="form-control datepicker"  />
                                </div>
                                <div class="col-lg-6 text-center" >
                                    <br/>
                                    <button type="submit" name="submit" class="btn btn-success" >Search</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($get_tag_ledger)){?>
        <div class="panel panel-default">
            <div class="panel-heading"><div class="col-md-5 text-left">Ledger Report</div> <div class='row'></div></div>
            
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table id="tbl_journal" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Voucher Type</th>
                                <th>Voucher No</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            
                            <?php foreach ($get_tag_ledger['tag_ledger'] as $key => $value) {?>
                            <tr>
                                <td><?php echo $value['journal_date'];?></td>
                                <td><?php echo $get_tag_ledger['tag_user'][0]['required_field'];?></td>
                                <td><?php echo $value['journal_type'];?></td>
                                <td></td>
                                <td><?php echo $value['dr_amount'];?></td>
                                <td><?php echo $value['cr_amount'];?></td>
                                <td></td>
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-lg-2" style="margin-left: -5px;">
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Total Dr.</div>
                              <input value="<?php echo $total_dr->dr; ?>" type="text" class="form-control" id="total_dr" name="total_dr" readonly="">
                            </div>
                        </div>
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Total Cr.</div>
                              <input value="<?php echo $total_cr->cr; ?>" type="text" class="form-control" id="total_cr" name="total_cr" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>
        <div class="alert alert-warning">
            No result found !!
        </div>
        
        
        <?php } ?>
    </div>  
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
</style>
<script>
    $('#tagId').change(function(){
        var id = $(this).val();
        
        $.ajax({
            url:'<?php echo base_url().'reports/getTagsDetails'?>',
            type:'POST',
            data:{id:id},
            success:function(data){
                var tag_data = $.parseJSON(data);
                var field = tag_data.field_name;
                var id_val = tag_data.id_field;
                var data_main = tag_data.all_data;
                var html_str = '<select name="tag_id" id="tag_combo">';
                $.each(data_main,function(key, value){
                    html_str = html_str + '<option value="'+value[id_val]+'">'+ value[field] +'</option>';
                });
                html_str = html_str+'</select>';
                $('#acc_head').html(html_str);
                $('#tag_combo').select2();
            }
        });
    });
</script>