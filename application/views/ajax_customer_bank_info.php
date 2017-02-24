<div class="scrolltable">
        <table class="table">
            <thead>
                <tr>
                    <th>#Sl</th>
                    <th>Bank Name</th>
                    <th>Card Type</th>
                    <th>Card No.</th>
                    <th>Expiry Date</th>
                    <th>Is Default</th>
                    <th>Action</th>
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
                        <td><?php echo (($value['default_flag'] == 1)?'Default':'');?></td>
                        <td>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_card" aria-hidden="true"  customer_credit_card_id="<?php echo $value['customer_credit_card_id'];?>" ></i>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_card" aria-hidden="true" customer_credit_card_id="<?php echo $value['customer_credit_card_id'];?>"></i>
                        </td>
                    </tr>
                <?php $i++;} ?>
            </tbody>
        </table>

    </div>