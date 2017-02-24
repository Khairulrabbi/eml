    <div class="container-fluid">
	<div class="panel panel-default">
	   <div class="panel-heading"><?php echo $title; ?></div>
		  <div class="panel-body">
		<table class="table" id="d_table">
			<thead>
				<tr>
					<th>Sl. No</th><th>Product Code</th> 
					<th>Serial Number</th>
					
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($table_data as $data){?>
				  <tr>
                                      <td> <?php echo $i++;?></td>
					  <td><?php echo $data['product_code']?></td>
					  <td><?php echo $data['serial_number']?></td>
				  </tr>    
				<?php }?>
			</tbody>
		</table>
		</div> <!--Panel body close -->
	</div> <!--Panel div close -->
</div>
<script>



</script>



