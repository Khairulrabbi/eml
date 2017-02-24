<div style="text-align: right; margin-bottom: 5px;">
    <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
</div>

<div class="panel panel-default " id="search_by" style="display: none;">
            <div class="panel-heading">
                <h5 class="panel-title"><?php echo label_html(SEARCH_BY, 'SEARCH_BY');?></h5>
            </div>
            <div class="panel-body">
                <?php
                    echo custom_search_panel('stock/current_stock_search/'.$type,array("region","group","warehouse_list"),array('2','3','5','6'));
                ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title"><?php echo label_html(CURRENT_PRODUCT_STOCKS, 'CURRENT_PRODUCT_STOCKS'); ?></h5>
            </div>
            <div class="panel-body show_search_data">
                <?php 
                $data['sql'] = $sql;
                $data['type'] = $type;
                $this->load->view("stock/current_stock_view_ajax_list",$data); ?>
            </div>
        </div>
  
    

<script>
    $('.panel-controller').click(function(e){
        $('#search_by').slideToggle();
    });
    

    $(document).on('click','.cart_checkbox',function(){
        var t = $(this);
        var product_id = $(this).attr('product_id');
        var list_type = $(this).attr('list_type');
        var label_text = $(this).text();
        if(label_text != 'Added')
        {
            $.ajax({
                url: '<?php echo base_url(); ?>stock/add_item_cart',
                type: 'POST',
                data: {product_id: product_id,list_type:list_type},
                success: function (data) {
                    var total = parseInt(data);
                   $('.cart_quantity').text(total);
                   t.text("Added");
                }
            });
        }
        else
        {
            $.ajax({
                url: '<?php echo base_url(); ?>stock/delete_item_cart',
                type: 'POST',
                data: {product_id: product_id,list_type:list_type},
                success: function (data) {
                    var total = parseInt(data);
                   $('.cart_quantity').text(total);
                   t.text("Add to Cart");
                }
            });
        }
    });
    
    
</script>