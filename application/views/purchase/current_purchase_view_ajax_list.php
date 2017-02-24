<table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
    <thead>
        <tr>
            <th><?php echo label_html(SL, 'SL'); ?></th>
            <th><?php echo label_html(PO_NUMBER, 'PO_NUMBER'); ?></th>
            <th><?php echo label_html(PURCHASE_TYPE, 'PURCHASE_TYPE'); ?></th> 
            <th><?php echo label_html(ORDER_DATE, 'ORDER_DATE'); ?></th>
            <th><?php echo label_html(ORDER_VALUE, 'ORDER_VALUE'); ?></th>
            <th>Current Location</th>
            <th>Current User</th>
            <th><?php echo label_html(STATUS, 'STATUS'); ?></th>
            <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
        </tr>
    </thead>
    <tbody class="">
        <?php $i = 1;
        foreach ($table_data as $key => $value) { 
            $a = $this->common_model->get_waiting_approval_list2("purchase",$value['purchase_code']);
        ?>
            <tr>
                <td><?php echo $i;
            $i++ ?> </td>
                <td>
                    <a href="<?php echo base_url() . 'purchase/order_details/' . $value['purchase_id']; ?>"><?php echo $value['purchase_code'] ?></a>
                   
                   
                    
                </td>
                <td><?php echo $value['purchase_type_name'] ?></td>
                <td><?php echo $value['order_date'] ?></td>
                <td><?php echo $value['order_value'] ?></td>
                <td><?php echo @$a->step_name; ?></td>
                <td><?php echo @$a->username; ?></td>
                <td><?php echo $value['status_name'] ?></td>
                <td>

                    <?php if (($value['status_id'] == 6 || $value['status_id'] == 5 || $value['status_id'] == 36) && ($value['purchase_type_id'] == 4)) { ?>
                        <a href="<?php echo base_url() . 'purchase/add_new/' . $value['purchase_id'].'/?p_code='.$value['purchase_code']; ?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
                    <?php } ?>
                        
                </td>
            </tr>    
        <?php } ?>
    </tbody>
</table>


<script>
    
    $(document).ready(function() {
        $('#purchase_list').DataTable();
    });

</script>



