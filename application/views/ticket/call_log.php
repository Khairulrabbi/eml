<div class="container-fluid">
	<div class="panel panel-default"> 
            <div style="position: relative;" class="panel-heading">
                   <?php echo $title; ?>
	<!-- <button style="position:absolute; transition: .5s ease;top:-17px;right: 25px;;" id="serach_button" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>             
          -->
            </div>
		  <div class="panel-body">                  
                        
                      <div class="row">
                            <div class="col-lg-12" id="search_panel">             
                                 <?php echo generate_search_panel($action=NULL,6, $data_array = array(
                                    'text_field1'=>array(0,0,'','sales_order','Sales Order No.'),
                                    'text_field2'=>array(0,0,'','product_code','Product Code'),
                                    'text_field3'=>array(0,0,'','serial_number','Serial Number'),
                                    'text_field4'=>array(0,0,'','customer_name','Customer Name'),
                                    'text_field5'=>array(0,0,'','contact_no','Contact Number'),
                                    'date_from'=>array(0,0,'','sales_date','Sales Date')
                                    //'product_id'=>array(0,1,1)
                                  )
                                ); ?>            
                            </div>
                        </div>
            </div> <!--Panel body close -->
	</div> <!--Panel div close --> 
                    
        <div id="table_div" style="display:none;" class="panel panel-default"> 
            <div style="position: relative;" class="panel-heading">
                   All Product Sales History
	<!-- <button style="position:absolute; transition: .5s ease;top:-17px;right: 25px;;" id="serach_button" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>             
          -->
            </div>
		  <div class="panel-body">                  
                        
                      <div class="row">
        
		<table class="table">
			<thead>
				<tr>
				    <th>Product Name</th>
					<th>Product Code</th>
					<th>Serial Number</th>
					<th>Sales Code</th> 
					<th>Sales Date</th>
					<th>Customer Name</th>
					<th>Contact No.</th>

					<th>Sales Person</th>
					<th> Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($table_data as $data){?>
				  <tr>
				      <td><?php echo $data['product_name'];?></td>
					  <td><?php echo $data['product_code'];?></td>
					  <td><?php echo $data['serial_number'];?></td>
					  <td><?php echo $data['sales_code'];?> </td>
					  <td><?php echo $data['delivery_date'];?></td>
                                          <td><?php echo $data['customer_name']; ?>
					  <td><?php echo $data['mobile_number'];?></td>

                                          <td><?php echo $data['first_name'];?></td>
		<td> <a href="<?php echo base_url().'stock/product_details_information/'.$data['product_code'];?>"><span class="label label-info" STYLE="background-color:#0054A6;font-size: 8pt;">view</span></a></td>
					  
				  </tr>    
				<?php }?>
			</tbody>
		</table>
                      </div>
                  </div>
       </div>

    </div>
<script>

$(document).ready(function(){
	//$('#current_stock_list').DataTable( );
        $('.search_panel').on("click",function(e){
            e.preventDefault();
//            var data = $("#serach_form :input[value!='']").serialize();
//            alert(data);
//            if(data!='')
//            {
           $("#table_div").removeAttr('style'); 
//            }
//            else{
//               alert('Provide atleast one input to search'); 
//            }
//           
        });
});

</script>



