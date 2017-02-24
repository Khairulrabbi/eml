
	<div class="panel panel-default">
	   <div class="panel-heading"><?php echo $title; ?></div>
		  <div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
			<thead>
				<tr>
					<th>SL No.</th><th>Purchase Code</th> 
					<th>Vendor</th><th>Lc Number</th> 
					<th>Order Date</th><th>Shipping Date</th>
					<th>Order value</th>
					<th>Status</th><th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($table_data as $data){?>
				  <tr>
					  <td><?php echo $i;$i++?> </td>
					  <td><?php echo $data['purchase_code']?></td>
					  <td><?php echo $data['vendor_name']?></td>
					  <td><?php echo $data['lc_number']?></td>
					  <td><?php echo $data['order_date']?></td>
					  <td><?php echo $data['shipping_date']?></td>
					  <td><?php echo $data['order_value']?></td>
					  <td><?php echo $data['status_name']?></td>
					  <td>
					  <a href="<?php echo base_url().'purchase/add_new/'.$data['purchase_id'];?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
					  <a href="<?php echo base_url().'purchase/order_details/'.$data['purchase_id'];?>""><i class="glyphicon glyphicon-eye-open"></i></a>
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

