<?php if(!empty($table_data)){?>

<table class="table" id="d_table">
			<thead>
				<tr>
                                    <th>
                                        <input class="c_box" id="check_all" type="checkbox">
                                    </th>
                                    <th>Product Code</th>
                                    <th>Serial Number</th>
                                    <th>Vendor Name</th>
                                    <th> Warranty Start date</th>
                                    <th>WareHouse</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($table_data as $data){?>
                            <tr>
					  <td><input class="c_box" type="checkbox"></td><td><?php echo $data['product_code']?></td>
					  <td><?php echo $data['serial_number']?></td>
					  <td><?php echo $data['vendor_name']?></td>
					  <td><?php echo $data['warranty_start_date']?></td>
					  <td><?php echo $data['warehouse_name'];?></td>
					  
				  </tr>    
				<?php }?>
			</tbody>

</table>

<div class="pull-right">
    <button id="allocate" p_id ="<?php echo $product_id;?>" class="btn btn-primary btn-sm">Allocate</button>&nbsp;
	<a class='btn btn-primary btn-sm pull-right' href='<?php echo base_url().'purchase/add_local_purchase'?>'>Purchase</a>
</div>
<?php } 
else {
?>
<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <center><strong>Sorry!!!</strong> The product is not available in stock now!</center></div>
	<a class='btn btn-primary btn-sm pull-right' href='<?php echo base_url().'purchase/add_local_purchase'?>'>Purchase</a>
<?php } ?>
