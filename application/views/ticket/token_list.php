<?php
//    echo get_grid_list(
//            array(
//                'title'=>'Token List',
//                'search_panel'=>FALSE,
//                'search_action'=>'',
//                'custom_search_column'=>4, 
//                'custom_search_panel'=>array( 
//                    "product_id" => array(0,1,0), 
//                    "vendor_id" => array(0,1,0), 
//                    "order_number" => array(0,1,0), 
//                    "serial_number" => array(0,1,0) 
//                    ),
//                'tboday'=>TRUE,
//                'columns'=>$columns,
//                'sql'=>$sql,
//                'action'=>$action)
//            );
?>



	<div class="panel panel-default">
	   <div class="panel-heading">Token List</div>
		  <div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTable no-footer" id="sales_order_list">
			<thead>
				<tr>
					<th>SL No.</th>
                                        <th>Token Code</th> 
					<th>Date</th>
                                        <th>Sales Code</th>                                       
					<th>Sales Person</th>
                                        <th>Customer Name</th>
					<th>Customer Mobile</th>
					<th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Token Status</th>
                                        <th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                                
                                $i=1;foreach ($table_data as $data){?>
				  <tr>
					  <td><?php echo $i; ?> </td>
					  <td><?php echo $data['token_code']; ?></td>
					  <td><?php echo $data['date']; ?></td>
					  <td><?php echo $data['sales_code']; ?></td>
					  <td><?php echo $data['sales_person']; ?></td>
					  <td><?php echo $data['customer_name']; ?></td>
					  <td><?php echo $data['customer_mobile']; ?></td>
					  <td><?php echo $data['product_name']; ?></td>
					  <td><?php echo $data['product_code']; ?></td>
					  <td><?php echo $data['token_status']; ?></td>
					  
					  <td>
                                              <?php
                                              if($data['ts'] == "0")
                                              {
                                            ?>
                                              <a href="<?php echo base_url().'ticket/new_token/'.$data['id'];?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
                                              <a href="<?php echo base_url().'ticket/token_to_ticket/'.$data['id'];?>"><i class="fa fa-cog fa-fw"></i></a>
                                              <?php
                                              }
                                              ?>
					  
					  
					  </td>
				  </tr>    
				<?php $i++; }?>
			</tbody>
		</table>
		</div> <!--Panel body close -->
	</div> <!--Panel div close -->

<script>

$(document).ready(function(){
    $('#sales_order_list').DataTable();
});

</script>

