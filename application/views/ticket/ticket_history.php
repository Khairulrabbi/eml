
	<div class="panel panel-default">
	   <div class="panel-heading"><?php echo $title; ?></div>
		  <div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTable no-footer" id="ticket_list">
			<thead>
				<tr>
                                    <th>SL No.</th>
                                    <th>Ticket Code</th> 
                                    <th>Product Code</th>
                                    <th>Product Name</th> 
                                    <th>Created</th>
                                    <th>Customer Name</th>
                                    <th>Customer Address</th>
                                    <th>Customer Mobile</th>					
                                    <th>Status</th>					
                                    <th>Assigned</th>
                                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                                    //$i=1;
                                    foreach ($table_data as $data){?>
				  <tr>
					  <td>
                                              <input type="hidden" class="hidden_ticket_id" value="<?php echo $data['ticket_id']; ?>">
                                              <?php echo $data['serial_number']?>
                                          </td>
					  <td><?php echo $data['ticket_code']?></td>
					  <td><?php echo $data['product_code']?></td>
					  <td><?php echo $data['product_name']?></td>
					  <td><?php echo $data['created']?></td>
					  <td><?php echo $data['customer_name']?></td>
					  <td><?php echo $data['customer_address']?></td>
					  <td><?php echo $data['customer_mobile']?></td>
					  <td><?php echo $data['status_name']?></td>
                                          <td><?php echo $data['username']?></td>
					  <td>
					  <a href="<?php echo base_url().'ticket/new_ticket/'.$data['ticket_id'];?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
					  <a href="<?php echo base_url().'ticket/ticket_details/'.$data['ticket_id'];?>""><i class="glyphicon glyphicon-eye-open"></i></a>
					  </td>
				  </tr>    
				<?php }?>
			</tbody>
		</table>
		</div> <!--Panel body close -->
	</div> <!--Panel div close -->

<script>

$(document).ready(function(){
    $('#ticket_list').DataTable();
});



//$(document).on("change",'.servicing_engineer_list', function () {
//    var ticket_id = $(this).parent().parent().find(".hidden_ticket_id").val();
//    var user_id = $(this).val();
//    $.ajax({
//        url: '<?php //echo base_url(); ?>ticket/update_assign_user',
//        type: 'POST',
//        data: {ticket_id:ticket_id,user_id: user_id},
//        success: function (data) {
//        }
//    });
//});
</script>


