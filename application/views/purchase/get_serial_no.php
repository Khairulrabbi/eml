<div class="container">
	<div class="panel panel-default">
	   <div class="panel-heading"><?php echo $title; ?></div>
		  <div class="panel-body">
             <div class="row">
			     <div class="col-md-6">
                       <button class="btn btn-primary" id="barcode" data-toggle="modal" data-target="#barcode_modal">BarCode Scan</button>				 
				 </div>
				 
				 <div class="col-md-6">
                       <button class="btn btn-primary" id="csv" data-toggle="modal" data-target="#csv_modal">CSV File Upload</button>				 
				 </div>
			</div>	 

		</div> <!--Panel body close -->
	</div> <!--Panel div close -->
</div> <!--Container div close -->

  <!-- Modal for barcode -->
  <div class="modal fade" id="barcode_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Scan Barcode For Serial Number</h4>
        </div>
        <div class="modal-body">
          <form role="form">
			  
			  <div class="form-group serial">
				<label for="serial_no">Serial No.</label>
				<input type="text" class="form-control serial_no">
			  </div>
			  
		 </form> 
		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


	
	
<script type="text/javascript">
	
    $(document).ready(function(){
		var serial_no;
		$(".serial_no").on("focusout",function(){
			alert('ok');
			serial_no = $(this).val();
			alert(serial_no);
			if(serial_no!=""){
			$(".serial").append("<br><input type='text' class='form-control serial_no'>");
			}
		});
	});

</script>
	