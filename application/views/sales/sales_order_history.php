
	<div class="panel panel-default">
            <div class="panel-heading">
                <?php echo label_html(SALES_ORDER_HISTORY, 'SALES_ORDER_HISTORY'); ?>
            </div>
		  <div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTable no-footer" id="sales_order_list">
			<thead>
				<tr>
					<th><?php echo label_html(SL, 'SL'); ?></th>
                                        <th><?php echo label_html(SALES_CODE, 'SALES_CODE'); ?></th> 
					<th><?php echo label_html(CUSTOMER_NAME, 'CUSTOMER_NAME'); ?></th>
                                        <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th>
					<th><?php echo label_html(ORDER_DATE, 'ORDER_DATE'); ?></th>
                                        <th><?php echo label_html(DELIVERY_DATE, 'DELIVERY_DATE'); ?></th>
					<th><?php echo label_html(PAYMENT_TYPE, 'PAYMENT_TYPE'); ?></th>
                                        <th>Sales Type</th>
					<th><?php echo label_html(STATUS, 'STATUS'); ?></th>
                                        <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
                                
                                $i=1;foreach ($table_data as $data){?>
				  <tr>
					  <td><?php echo $i;$i++?> </td>
					  <td><?php echo $data['sales_code']?></td>
					  <td><?php echo $data['customer_name']?></td>
					  <td><?php echo $data['product_name']?></td>
					  <td><?php echo $data['order_date']?></td>
					  <td><?php echo $data['delivery_date']?></td>
					  <td><?php echo $data['payment_type_name']?></td>
                                          <td><?php echo $data['sales_type']; ?></td>
					  <td><?php echo $data['status_name']?></td>
					  
					  <td>
                                            <?php
                                            if(($data['sales_status'] == 1) || ($data['sales_status'] == 2))
                                            { 
                                                if($data['sales_type'] == "vendor"){ ?>
                                                    <a href="<?php echo base_url().'sales/add_new/'.$data['sales_id'].'/?s_code='.$data['sales_code'];?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
                                                <?php }else if($data['sales_type'] == "counter")
                                                { ?>
                                                    <a href="<?php echo base_url().'sales/front_desk_sale/'.$data['sales_id'].'/?s_code='.$data['sales_code'];?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
                                                <?php }                                            
                                            }
                                            ?>
                                              
                                            <?php if($data['sales_type'] == "vendor")
                                            { ?>
                                                <a href="<?php echo base_url().'sales/order_details/'.$data['sales_id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            <?php }else if($data['sales_type'] == "counter")
                                            { ?>
                                                <a href="<?php echo base_url().'sales/front_desk_order_details/'.$data['sales_id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            <?php }
                                            ?>
					  
					  </td>
				  </tr>    
				<?php }?>
			</tbody>
		</table>
		</div>
	</div>

<script>

$(document).ready(function(){
    $('#sales_order_list').DataTable();
});

</script>

