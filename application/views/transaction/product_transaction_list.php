<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Selected Product for Purchase</h3>
                </div>
                <div class="panel-body">
                    <?php
                        $type = "purchase";
                        $data['type'] = $type;
                        $data['url'] = base_url().'purchase/purchase_order_from_cart/'.$type;
                        $data['url_name'] = "Create Purchase Order";
                        $data['sql'] = $this->stock_model->current_stock_data(1, $type);
                        $this->load->view("transaction/product_transaction_list_body",$data);
                    ?>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Selected Product for Requisition</h3>
                </div>
                <div class="panel-body">
                    <?php
                        $type = "requisition";
                        $data['type'] = $type;
                        $data['url'] = base_url().'requisition/requisition_order_from_cart/'.$type;
                        $data['url_name'] = "Create Product Requisition";
                        $data['sql'] = $this->stock_model->current_stock_data(1, $type);
                        $this->load->view("transaction/product_transaction_list_body",$data);
                    ?>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Selected Product for Sales</h3>
                </div>
                <div class="panel-body">
                    <?php
                        $type = "sale";
                        $data['type'] = $type;
                        $data['url'] = base_url();
                        $data['url_name'] = "Create Sales Order";
                        $data['sql'] = $this->stock_model->current_stock_data(1, $type);
                        $this->load->view("transaction/product_transaction_list_body",$data);
                    ?>
                </div>
            </div>
        </div>
    </div>    
</div>


<script>
    $(document).on('click','#delete_from_transaction_list',function(e){
        e.preventDefault();
        var t = $(this);
        var product_id = $(this).attr('product_id');
        var list_type = $(this).attr('list_type');
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/delete_from_transaction_list',
            type: 'POST',
            data: {product_id: product_id,list_type:list_type},
            success: function (data) {
                if(data == true)
                {
                   // t.closest("tr").hide();
                    window.location.href = "<?php echo base_url(); ?>common_controller/product_transaction_list";
                }
            }
        });
    });
    
    
</script>
