<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title;?> </h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" role="form">
			<div class="col-lg-6">
               <div class="form-group">
                 <label for="vendor" class="col-lg-3 control-label">Vendor</label>
                 <div class="col-lg-9">
				
				   <select name="vendor" id="vendor">
				     <?php 
					 foreach($vendor as $data){
						$sel=''; // Set $sel to empty initially
						$tag = 'selected="selected"';

						if(isset($_POST["vendor"]) && $_POST["vendor"] == $data['vendor_id'])
							 { $sel = $tag; }

						echo '<option value="'.$data['vendor_id'].'" '.$sel.'>'.$data['vendor_name'].'</option>';
					}
					 ?>
				  </select>
                </div>
              </div>
			  
			  <div class="form-group">
                 <label for="order_no" class="col-lg-3 control-label">Order No.</label>
                 <div class="col-lg-9">
				  <input required type="text" class="form-control" id="order_no">
                </div>
              </div>
			  
		      <div class="form-group">
                 <label for="lc_no" class="col-lg-3 control-label">LC No.</label>
                 <div class="col-lg-9">
				  <input required type="text" class="form-control" id="lc_no">
                </div>
              </div>
			  
			 <div class="form-group">
			     <div class="col-lg-3"></div>
                 <div class="col-lg-9">
				  <button type="button" id="add_item_button"class="btn btn-primary" data-toggle="modal" data-target="#add_item">Add Item</button>
                </div>
              </div>
		   </div>
		   
			<div class="col-lg-6">
			  
			  <div class="form-group">
                 <label for="order_no" class="col-lg-3 control-label">Order Date</label>
                 <div class="col-lg-9">
				  <input required type="date" class="form-control" id="order_date" >
                </div>
              </div>
			  
		      <div class="form-group">
                 <label for="lc_no" class="col-lg-3 control-label">Shipping Date</label>
                 <div class="col-lg-9">
				  <input required type="date" class="form-control" id="shipping_date" >
                </div>
              </div>
			  
			  <div class="form-group">
                 <label for="status" class="col-lg-3 control-label">Status</label>
                 <div class="col-lg-9">
				  <input required type="text" class="form-control" id="status" >
                </div>
              </div>
			  
			</div>

            </form>
			
						  <!-- Modal for adding item-->
			  
			  <div id="add_item" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg" id="add_item_modal">

					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add item</h4>
					  </div>
					  <div class="modal-body">
					   <form class="form-horizontal" role="form" id="details_data">
						  <div class="form-group">
							  <label for="item" class="col-lg-3 control-label">Items</label>
							 <div class="col-lg-9">
							  	<select name="product" id="product">
									 <?php 
									 foreach($product as $data){
										$sel=''; // Set $sel to empty initially
										$tag = 'selected="selected"';

										if(isset($_POST["product"]) && $_POST["product"] == $data['product_id'])
											 { $sel = $tag; }

										echo '<option value="'.$data['product_id'].'" '.$sel.'>'.$data['product_name'].'</option>';
									}
									 ?>
								  </select>
							 </div>
						  </div>
						  
				 <div class="form-group">
					 <label for="quantity" class="col-lg-3 control-label">Quantity</label>
					 <div class="col-lg-9">
					  <input required type="number" min= 1 class="form-control" id="quantity">
					</div>
				  </div>
						
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="add">Add</button>
					  </div>
		    </form>
					</div>

				  </div>
			</div>
			  
			  <!-- End of modal-->
			
			<div class="col-lg-12">
			   <div class="scrolltable">
					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
							  <th>SL No.</th><th>Item Name</th><th>Quantity</th><th>Unit Price</th><th>Discount</th><th>Sub-Total</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>

				</div>
			</div>
			
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>

    $('#add_item').click(function(){
		alert('click');
        var vendor = $("#vendor").val();
		var order_no=$("#order_no").val();
		var lc_no =$("#lc_no").val();
		var order_date =$("#order_date").val();
		var shipping_date = $("#shipping_date").val();
		alert(order_date);
		
	 $.ajax({
            url:'<?php echo base_url('purchase/purchase_summary'); ?>',
			data:{vendor:vendor,order_no:order_no,lc_no:lc_no,
			      order_date:order_date,shipping_date:shipping_date},
           
        });  

		
      
    });
</script>