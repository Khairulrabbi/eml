<div class="panel panel-default">
    <div class="panel-heading"><?php echo label_html(PRODUCT_LIST, 'PRODUCT_LIST'); ?></div>
        <div style="text-align: right; margin-bottom: 5px; right: 34px; top: 85px;">
            <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i>Search</button>
         </div>
         <div class="panel-default search_panel_header" style="display: none;">
              <div class="panel-heading"><?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?></div>
                <div class="panel-body">
                    <?php
                         echo custom_search_panel('inventory/current_stock_search',array("region","group","product_id"),array('2','3','5','6'));          
                     ?>
                 </div>
           </div>
    <div class="panel-body show_search_data">
        <?php $this->load->view("inventory/detail_product_list_search_ajax_result"); ?>
    </div>
</div>

<script type="text/javascript">
    
    $('.panel-controller').click(function(e) {
        $('.search_panel_header').slideToggle();
    });   
</script>