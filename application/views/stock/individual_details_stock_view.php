<div style="text-align: right; margin-bottom: 5px;">
    <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
</div>
	                
<div class="panel panel-default" id="search_by" style="display: none;">
      <div class="panel-heading">
      <h5 class="panel-title">Search By</h5>
      </div>
      <div class="panel-body" id="search_panel">
      <?php
          echo custom_search_panel('stock/current_stock_details_search/'.$product_id.'/'.$warehouse_id,array("region","group","warehouse_list"),array('2','3','5','6'));
      ?>
      </div>
</div>
<div class="panel panel-default">
      <div class="panel-heading">
          <h5 class="panel-title">Warehouse wise Product List</h5>
      </div>
      <div class="panel-body show_search_data">
          <?php 
          $this->load->view("stock/individual_details_stock_view_ajax_list",$table_data); ?>
      </div>
</div>
   
	
<script>
$('.panel-controller').click(function(e){
$('#search_by').slideToggle();
});

$(document).ready(function(){
	$('#d_table').DataTable( );
    
    $(document).on("click","#serach_button",function(){
        $("#search_panel").toggle();
    });
});

</script>

