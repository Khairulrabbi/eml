<div class="container-fluid">
<!--        <div class="pull-left">
        <a><i id="back" class="fa fa-arrow-left">&nbsp;&nbsp;</i></a>
    </div>-->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Purchase Info</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Product Info</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Warranty & Manufacture Info</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Sales Info</a></li>
                    </ul>
    <!-- Tab header-->
    <div class="panel panel-default">
        <div class="panel-body">
     <div class="tab-content">
	<div class="tab-pane active" id="tab_1">
           <div class="col-lg-12">
                    
                    <button id='ticket' class="btn btn-primary btn-sm pull-right">Create Ticket</button><br><br>
		<table class="table table-hover" id="current_stock_list">
                        <tbody>
				<tr>
                                        <th>PO Number</th>
                                    <td><?php echo $table_data[0]['purchase_code'];?></td>
					<th>Purchase Type</th>
                                     <td><?php echo $table_data[0]['purchase_type_name'];?></td> 
                                        <th>Purchase Price</th>
                                    <td><?php echo number_format($table_data[0]['purchase_price'],2);?></td> 
                                </tr>
                                <tr>
   
                                        <th>PO Date</th>
                                    <td><?php echo $table_data[0]['purchase_date'];?></td>    
                                        <th>Receive Date </th>
                                    <td><?php echo $table_data[0]['good_recieve_date'];?></td>
                                        <th>LC Number</th> 
                                   <td><?php echo $table_data[0]['lc_number'];?></td>
				</tr>
                                
                                <tr>
                                    <th>LC Value</th> 
                                    <td><?php echo number_format($table_data[0]['lc_value'],2);?></td>
                                    <th></th><td></td>
                                    <th></th><td></td>
                                </tr>
			</tbody>
		</table>
</div></div>
     
            <!--2nd panel -->
            <div class="tab-pane"  id="tab_2">
            <div class="col-lg-12">
                <br><br>
		<table class="table table-hover" id="current_stock_list">
		    <tbody>
				<tr>
                                        <th>Product Name</th>
                                    <td><?php echo $table_data[0]['product_name'];?></td>    
					<th>Product Code</th>
                                    <td class='p_code'><?php echo $table_data[0]['product_code'];?></td>    
                                        <th>Serial Number</th> 
                                    <td > <?php echo $table_data[0]['serial_number'];?></td> 
                                </tr>
                                
                                <tr>
                                        <th>Product Price Code</th>
                                    <td><?php echo $table_data[0]['product_price_code'];?></td>    
                                        <th>WareHouse</th>
                                    <td><?php echo $table_data[0]['warehouse_name'];?></td> 
                                    <th></th><td></td>
				</tr>
  
			</tbody>
		</table>
         </div>         
</div>

    
    <!--T -->
    
    	<div class="tab-pane"  id="tab_3">
           <div class="col-lg-12">
               <br><br>
		<table class="table table-hover" id="current_stock_list">
                    <tbody>
				<tr>
                                        <th>Manufacture Date</th> 
                                        <td><?php if(isset($table_data))?></td>
					<th>Warranty Start</th>
                                    <td><?php echo $table_data[0]['warranty_start_date'];?></td>
                                        <th>Warranty Period</th> 
                                    <td><?php echo $table_data[0]['warranty_period'].' Month(s)';?></td>    
				</tr>  
			</tbody>
		</table>
         </div>
        </div>        
     
            <!--2nd panel -->
           <div class="tab-pane"  id="tab_4"> 
            <div class="col-lg-12">
                <br><br>
                <table class="table table-hover">
                    <tbody>
				<tr>

				
                                </tr>
			</tbody>
		</table>
         </div>          
</div>
     </div>
        </div></div></div>
<script>
  $(document).on("click","#back",function(){
      parent.history.back();
      return false;
  });
  
  $(document).on("click","#ticket",function(e){
        e.preventDefault();
        //alert('ok');
        var p_code =$(".p_code").text();
        //alert(p_code);
	
	$('<form action="<?php echo base_url().'ticket/new_ticket';?>" method="post">'+
        '<input type="hidden" name="p_code" value="'+p_code+'">'+
        '<input type="hidden" name="flag" value="'+1+'">'+
        '</form>').appendTo('body').submit();
		
  });
</script>


