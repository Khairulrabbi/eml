
<div class="panel panel-default">
   <div class="panel-heading"><?php echo label_html(LC_SATTLEMENT_HISTORY, 'LC_SATTLEMENT_HISTORY'); ?></div>
          <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
                <thead>
                        <tr>
                            <th><?php echo label_html(SL, 'SL'); ?></th>
                          
                            <th><?php echo label_html(PURCHASE_CODE, 'PURCHASE_CODE'); ?></th> 
                            <th><?php echo label_html(PURCHASE_TYPE, 'PURCHASE_TYPE'); ?></th> 
                                <th><?php echo label_html(VENDOR, 'VENDOR'); ?></th><th><?php echo label_html(LC_NUMBER, 'LC_NUMBER'); ?></th> 
                                <th><?php echo label_html(ORDER_DATE, 'ORDER_DATE'); ?></th><th><?php echo label_html(SHIPPING_DATE, 'SHIPPING_DATE'); ?></th>
                                <th><?php echo label_html(ORDER_VALUE, 'ORDER_VALUE'); ?></th>
                                <th><?php echo label_html(STATUS, 'STATUS'); ?></th><th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                        </tr>
                </thead>
                <tbody>
                        <?php $i=1;foreach ($table_data as $data){?>
                          <tr>
                                  <td><?php echo $i;$i++?> </td>
                                  <td><?php echo $data['purchase_code']?></td>
                                  <td><?php echo $data['purchase_type_name']?></td>
                                  <td><?php echo vendor_value($data['vendor_name'], $data['mobile_number'], NULL); ?></td>
                                  <td><?php echo $data['lc_number']?></td>
                                  <td><?php echo $data['order_date']?></td>
                                  <td><?php echo $data['shipping_date']?></td>
                                  <td><?php echo $data['order_value']?></td>
                                  <td><?php echo $data['status_name']?></td>
                                  <td>
                                    <a href="<?php echo base_url().'purchase/payment_details/'.$data['purchase_id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                  </td>
                          </tr>    
                        <?php }?>
                </tbody>
        </table>
        </div> <!--Panel body close -->
</div> <!--Panel div close -->

<script>

$(document).ready(function(){
    $('#purchase_list').DataTable();
});

</script>

