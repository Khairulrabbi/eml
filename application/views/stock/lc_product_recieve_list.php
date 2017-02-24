    <div class="container-fluid">
	<div class="panel panel-default">
	   <!--<div class="panel-heading"><?php // echo $title; ?></div>-->
	   <div class="panel-heading"><?php echo label_html(LC_PRODUCT_RECEIVE, 'LC_PRODUCT_RECEIVE'); ?></div>
		  <div class="panel-body" id="error_show">
                    <table class="table" id="d_table">
			<thead>
                            <tr>
                                <th><?php echo label_html(ORDER_NUMBER, 'ORDER_NUMBER');?></th><th><?php echo label_html(DATE, 'DATE'); ?></th>
                                <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME');?></th> 
                                <th><?php echo label_html(QUANTITY, 'QUANTITY'); ?> </th>
                                <th><?php echo label_html(WAREHOUSE, 'WAREHOUSE'); ?></th>
                                <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                            </tr>
			</thead>
			<tbody>
			     
				<?php $i=1;foreach ($table_data as $data){?>
				  <tr>
                                      <td><?php echo $data['purchase_code'];?></td>
					  <td><?php echo $data['packing_slip_date']?></td>
					  <td><?php echo $data['product_name']?></td>
                      <td><?php echo $data['total_recieve_serial']?></td>
					  <td><?php echo warehouse_list(null, array('class' => 'warehouse_id'));?></td>
					  
					  <td>
					  <button class="btn btn-primary btn-sm receieve" purchase_id="<?php echo $data['purchase_id'];?>" product_id="<?php echo $data['product_id'];?>">Receive</button></a>
					  </td>
				  </tr>    
				<?php }?>
			</tbody>
		</table>
		</div> <!--Panel body close -->
	</div> <!--Panel div close -->
	
	
	<div class="modal fade" id="my_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Options</h4>
        </div>
        <div class="modal-body">
		    <div class="row">
                <div class="col-lg-12">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-3"><button class="btn btn-primary"  id="manual" name="manual">Manual</button></div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-3"><button class="btn btn-primary" id="bar_scan" name="bar_scan">BarCode Scan</button></div>
                </div>

            </div>
        </div>
        
      </div><!--modal content close-->
    </div>
  </div>
	
</div>
<script>

$(document).ready(function(){
    $('#d_table').DataTable();
	var purchase_id;
	var product_id;
	
	$(document).on("click",".receieve",function(){
		purchase_id = $(this).attr('purchase_id');
		//alert(purchase_id);
		product_id = $(this).attr('product_id');
		
        warehouse = $(this).closest('tr').find('td option:selected').text();
		
        warehouse_id = $(this).closest('tr').find('td option:selected').val();
        if(warehouse=='Select'){
            $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong>Please select a WareHouse.</center></div>").prependTo("#error_show");
        }       
        else 
        {
            $("#my_modal").modal('show');
        }	
	});
	
    var redirectUrl = '<?php echo base_url(); ?>stock/lc_product_receive_confirmation';		
        $(document).on("click","#manual",function(){
            var form = $('<form action="' + redirectUrl + '" method="post">' +
            '<input type="hidden" name="purchase_id" value="' + purchase_id + '"></input>' + 
            '<input type="hidden" name="product_id" value="' + product_id + '"></input>' + 
            '<input type="hidden" name="warehouse" value="' + warehouse + '"></input>' +
            '<input type="hidden" name="warehouse_id" value="' + warehouse_id + '"></input>' +'</form>');
            $('body').append(form);
            $(form).submit();
        });
});

</script>





