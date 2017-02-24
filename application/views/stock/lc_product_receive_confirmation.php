
	<div class="container-fluid">
	<div class="panel panel-default">
	   <div class="panel-heading"><?php echo $title; ?></div>
		  <div class="panel-body">
		<table class="table" id="d_table">
			<thead>
				<tr>
				
				     
					<th><input class="check" id="check_all" type="checkbox"> &nbsp;&nbsp;Sl. No</th><th>Product Code</th> 
                                        <th>Serial Number</th><th> WareHouse</th>
									
					
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($table_data as $data){?>
				  <tr>
				     
                      <td ><input class="check" type="checkbox"> &nbsp;&nbsp; <?php echo $i++;?></td>
					  <td><?php echo $data['product_code']?></td>
					  <td><?php echo $data['serial_number']?></td>
					  <td id="<?php echo $warehouse_id;?>"><?php echo $warehouse; ?></td>
                                          
				  </tr>    
				<?php }?>
			</tbody>
		</table>
                      <div class="pull-right">
					          <button class="btn btn-primary" id="edit">Edit</button>
                              <button class="btn btn-primary" id="confirm">Confirm</button>
                      </div>
		</div> <!--Panel body close -->
	</div> <!--Panel div close -->
</div>
<script>

$(document).ready(function(){
    //$('#d_table').DataTable();
    $(document).on("click","#check_all",function(){
        var check = $('#check_all').is(':checked');

        if(check){
            $(".check").prop('checked',true);  
        }
        else{
            $(".check").prop('checked',false);  
        }
       
    });
	

    $(document).on("click","#edit",function(){
		location.href = '<?php echo base_url(); ?>stock/lc_product_recieve_list'; 
	});
	
    $(document).on("click","#confirm",function(){
		

       var data_array=[];
       var selector = $("#d_table tbody tr").filter(':has(:checkbox:checked)');
       var val;
	   var warehouse_id;
       selector.each(function(){
           val = $(this).find('td').eq(2).text();
		   warehouse_id = $(this).find('td').eq(3).attr('id');
           data_array.push({serial_no:val,warehouse_id:warehouse_id});
           
       });

       
       /*
        * Make an ajax call to change status id of selected serial no
        */
       var redirectUrl ='<?php echo base_url(); ?>stock/lc_product_recieve_list';
       var purchase_id = '<?php echo $purchase_id?>';
       $.ajax({
           url:'<?php echo base_url(); ?>stock/change_status_to_good_receive',
           type:"post",
           data:{data:data_array,purchase_id:purchase_id},
           success:function(){
               //location.href = redirectUrl;
           }
           
       });
    });
});

</script>





