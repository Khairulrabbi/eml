    <div class="container-fluid">
	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(RECEIVED_PACKING_SERIAL_REPORTS, 'RECEIVED_PACKING_SERIAL_REPORTS') ?></div>
		  <div class="panel-body">
		<table class="table" id="d_table">
			<thead>
				<tr>
                                    <th><?php echo label_html(PURCHASE_CODE, 'PURCHASE_CODE');?></th><th><?php echo label_html(DATE, 'DATE');?></th>
                                    <th><?php echo label_html('PRODUCT_NAME', 'PRODUCT_NAME');?></th> 
                                    <th><?php echo label_html(RECEIVE_AMOUNT, 'RECEIVE_AMOUNT');?></th>
                                    <th><?php echo label_html(ACTION, 'ACTION');?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($table_data as $data){?>
				  <tr>
                                      <td><?php echo $data['purchase_code'];?></td>
					  <td><?php echo $data['packing_slip_date']?></td>
					  <td><?php echo $data['product_name']?></td>
                                          <td><?php echo $data['total_recieve_serial']?></td>
					  
					  <td>
					  <a href="<?php echo base_url().'purchase/details_packing_serial_no/'.$data['purchase_id'].'/'.$data['product_id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a>
					  </td>
				  </tr>    
				<?php }?>
			</tbody>
		</table>
		</div> <!--Panel body close -->
	</div> <!--Panel div close -->
</div>
<script>



</script>



