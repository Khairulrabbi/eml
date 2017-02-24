<div style="text-align: right; margin-bottom: 5px;">
    <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
</div>
<div class="panel panel-default " style="display: none;" id="search_by">
    <div class="panel-heading "><?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?></div>
    <div class="panel-body">
        <?php
            echo custom_search_panel('purchase/current_purchase_search',array("po_number","status","purchase_type"),array('2','3','5','6'));
        ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo label_html(PURCHASE_HISTORY, 'PURCHASE_HISTORY'); ?></div>
    <div class="panel-body show_search_data">
        <?php $this->load->view("purchase/current_purchase_view_ajax_list",$table_data); ?>      
    </div> <!--Panel body close -->
</div> <!--Panel div close -->

<script>
$('.panel-controller').click(function(e){
$('#search_by').slideToggle();
});
$(document).ready(function(){
    $('#purchase_list').DataTable();
});

</script>