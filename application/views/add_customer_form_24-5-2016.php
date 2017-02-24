<div class="container">
  <h3 style="color:#0054A6;"><center><?php echo $title;?></center></h3><br><br>
 <form class="form-horizontal" role="form">
 <fieldset id="personal_info">
    <legend><h4 style="color:#0054A6;">Personal Information</h4></legend>
  
  <div class="col-lg-6">
				<div class="form-group">
					 <label class="control-label col-lg-3" for="name">Name:</label>
					 <span style="color:#f00">*</span>
						<div class="col-lg-8">
							 <input required type="text" class="form-control" id="name" placeholder="Enter name">
						</div>
				  </div>

	
	<div class="form-group">
		<label class="control-label col-lg-3" for="name">Phone:</label>
				<div class="col-lg-8">
						 <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
					</div>
			  </div>

			
			<div class="form-group">

				 <label class="control-label col-lg-3" for="name">Mobile:</label>
				 <span style="color:#f00">*</span>
					<div class="col-lg-8">
						 <input required type="text" class="form-control" id="mobile" placeholder="Enter mobile No.">
					</div>
			  </div>

			
			<div class="form-group">

				 <label class="control-label col-lg-3" for="name">Email:</label>
					<div class="col-lg-8">
						 <input type="email" class="form-control" id="email" placeholder="Enter email id">
					</div>
			  </div>

			
		   <div class="form-group">

				 <label class="control-label col-lg-3" for="name">Website:</label>
					<div class="col-lg-8">
						 <input type="text" class="form-control" id="text" placeholder="Enter website address if any">
					</div>
			  </div>
  </div>
  
  <div class="col-lg-6">
  
  		   <div class="form-group">

				 <label class="control-label col-lg-3" for="name">Address:</label>
				 <span style="color:#f00">*</span>
					<div class="col-lg-8">
						 <input required type="text" class="form-control" id="address" placeholder="Enter address type">
					</div>
			  </div>
			  
			 <div class="form-group">
				 <label class="control-label col-lg-3" for="name"></label>  
				 <span style="color:#f00">*</span>
				 
					<div class="col-lg-8">
					   <textarea class="form-control" rows="5" id="deatil_address" placeholder="Enter Details address here"></textarea>
					
					</div>
			  </div> 

             <div class="form-group">
				 <label class="control-label col-lg-3"></label>
					<div class="col-lg-8">
					   <button class="btn btn-primary" id ="add_address">Add Address</button>
					</div>
			  </div>  			  
  </div>
 
	</fieldset>
	
	<fieldset id="remarks">
	<legend><h4 style="color:#0054A6;">Remarks</h4></legend>
	  <div class="form-group">
	  <div class="col-lg-6">
		 <label class="control-label col-lg-3">Remarks</label>
			 <div class="col-lg-8">
				 <textarea class="form-control" id="remarks" rows="5" name="remarks"></textarea>
			 </div>
	  </div>
	</div>
	</fieldset>
	
<fieldset id="pricing_info">
<legend><h4 style="color:#0054A6;"> Purchasing Information</h4></legend>

   <div class="form-group">
	  <div class="col-lg-6">
		 <label class="control-label col-lg-3" for="name">Pricing:</label>
		    <div class="col-lg-8">
				 <select class="form-control" id="pricing" >
				   <option> Option 1</option>
				 </select>
			</div>
	  </div>
   </div>
   
   <div class="form-group">
	  <div class="col-lg-6">
		 <label class="control-label col-lg-3" for="name">Currency:</label>
		    <div class="col-lg-8">
				 <select class="form-control" id="currency" >
				   <option> Option 1</option>
				 </select>
			</div>
	  </div>
   </div>
   
    <div class="form-group">
	  <div class="col-lg-6">
		 <label class="control-label col-lg-3" for="name">Discount:</label>
		    <div class="col-lg-8">
			<input type="text" class="form-control" id="discount">
			</div>
	  </div>
   </div>
   
   <div class="form-group">
	  <div class="col-lg-6">
		 <label class="control-label col-lg-3" for="name">Payment Terms:</label>
		    <div class="col-lg-8">
				 <select class="form-control" id="currency" >
				   <option> Option 1</option>
				 </select>
			</div>
	  </div>
   </div>

</fieldset>
<center>
<div class="col-lg-2">
<button class="btn btn-primary btn-lg" id="save"> Save</button>
</center>
</div>	
  </form>
</div>