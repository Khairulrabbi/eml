<?php //print_r($voucher_info);?>
<div class="col-lg-12">
    <form action="<?php echo base_url().'accounts_configuration/voucher_pdf'; ?>" method="post">
        <input type="hidden" value="45" name="journal_id" />
        <div class="form-group col-lg-4 no_print">
            <label>Select Address</label>
            <?php echo company_address('',array('id'=>'address_combo','class'=>'no_print')); ?>

        </div>
        <div class="col-lg-12">
            <div class="col-lg-4 pull-left" style="padding-top: 15px;" id="address"></div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr class="table_head_foot">
                    <th class="text-center" style="width: 1%;">SL</th>
                    <th class="text-center" style="width: 5%;">ACCOUNT</th>
                    <th class="text-center">PARTICULAR</th>
                    <th class="text-center" style="width: 7%;">DEBIT</th>
                    <th class="text-center" style="width: 7%;">CREDIT</th>
                    <th class="text-center">GROUP</th>
                    <th class="text-center">COST</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n=0;
                    foreach ($voucher_info as $value) {
                        $n++;
                ?>
                <tr>
                    <td class="text-center"><?php echo $n; ?></td>
                    <td><?php echo $value['acc_head_number']; ?></td>
                    <td>
                        <b><?php echo $value['acc_head_name']; ?></b><br/>
                        &emsp;<?php echo $value['description']; ?>
                    </td>
                    <td class="text-right dr_amount"><?php echo $value['dr_amount']; ?></td>
                    <td class="text-right cr_amount"><?php echo $value['cr_amount']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="table_head_foot">
                    <th class="text-right" colspan="3">Total</th>
                    <th class="text-right"><u class="doubleUnderline" id="dr_total"></u></th>
                    <th class="text-right"><u class="doubleUnderline" id="cr_total"></u></th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
        </table>
        <a class="no_print btn btn-primary" onclick="window.print()">Print</a>
        <input type="submit" class="no_print btn btn-primary" value="PDF"/>
    </form>
</div>
<script>
    $(document).ready(function(){
        var sum=0;
        $('.dr_amount').each(function(){
            sum = sum + parseInt($(this).text() || 0);
        });
        $('#dr_total').text(parseFloat(sum).toFixed(2)).bdt({bdt_sign: ''});
        var sum=0;
        $('.cr_amount').each(function(){
            sum = sum + parseInt($(this).text() || 0);
        });
        $('#cr_total').text(parseFloat(sum).toFixed(2)).bdt({bdt_sign: ''});
    });
    
    $('#address_combo').change(function(e){
        var address_id = $(this).val();
        if(address_id != ''){
            $.ajax({
                url:'<?php echo base_url().'accounts_configuration/get_address'; ?>/'+address_id,
                type:'post',
                data:{},
                success:function(data){
                    $('#address').html(data);
                }
            });
        }
    });
</script>