<table class="table table-striped table-bordered table-hover dataTable no-footer" id="requisition_list">
    <thead>
        <tr>
            <th><?php echo label_html(SL, 'SL'); ?></th>
            <th><?php echo label_html(REQUISITION_CODE, 'REQUISITION_CODE'); ?></th>
            <th><?php echo label_html(REQUESTED_DATE, 'REQUESTED_DATE'); ?></th> 
            <th><?php echo label_html(STATUS_NAME, 'STATUS_NAME'); ?></th>
            <th><?php echo label_html(WAREHOUSE_NAME, 'WAREHOUSE_NAME'); ?></th>
            <th><?php echo label_html(ACTION, 'ACTION'); ?></th> 

        </tr>
    </thead>
    <tbody class="show_search_data">
        <?php $i = 1;
        foreach ($table_data as $key => $value) { ?>
            <tr>
                <td><?php echo $i;
            $i++ ?> </td>
                <td>
                    <a href="<?php echo base_url() . 'requisition/requisition_details/'.$value['stock_requisition_id']; ?>">
                     <?php echo $value['requisition_code'] ?>
                    </a>
                </td>
                <td><?php echo $value['request_date_for_delivery'] ?></td>     
                <td><?php echo $value['status_name'] ?></td>
                <td><?php echo $value['warehouse_name'] ?></td>
                <td>
                    
                    <?php if (($value['requisition_status'] == 39) || ($value['requisition_status'] == 40)) { ?>
                            <a  target="" 
                                href="<?php echo base_url() . 'requisition/product_requisition/'.$value['stock_requisition_id'].'/?r_code='.$value['requisition_code']; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            
                    <?php } ?>

                </td>
            </tr>    
        <?php } ?>
    </tbody>
</table>


<script>

    $(document).ready(function() {
        $('#requisition_list').DataTable();
    });

</script>



