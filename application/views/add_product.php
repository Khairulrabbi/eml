    <?php
        $product_info = 'default';
        $purchase_history = 'default';    
        $current_stock = 'default';   
        $product_vendor = 'default';        
        if(isset($_GET['page']))
        {
            if($_GET['page'] == 'product_info')
            {
                $product_info = 'primary';
            }
            else if($_GET['page'] == 'purchase_history')
            {
                $purchase_history = 'primary';
            }
            else if($_GET['page'] == 'current_stock')
            {
                $current_stock = 'primary';
            }
            else if($_GET['page'] == 'product_vendor')
            {
                $product_vendor = 'primary';
            }
        }
        else
        {
            $product_info = 'primary';
        }
    ?>

    <div class="row">
        <div class="col-lg-12">
            <?php
            if(isset($_GET['p_id']) && $_GET['p_id']!='') {
               $p_id = $_GET['p_id'];
               $pi['product_info'] = $this->inventory_model->get_product_info($p_id);
               $btn_status = '';
            } else {
                $btn_status='disabled';
                $pi['product_info'] = array();
                $p_id = '';
                
            }
            ?>
            <a href="<?php echo base_url().'inventory/add_new_product/?page=product_info'; ?>&p_id=<?php echo $p_id;?>" class="btn btn-<?= $product_info; ?> <?php echo $btn_status;?>">Product Info</a>
            <a href="<?php echo base_url().'inventory/add_new_product/?page=purchase_history'; ?>&p_id=<?php echo $p_id;?>" class="btn btn-<?= $purchase_history; ?> <?php echo $btn_status;?>">Purchase History</a>
            <a href="<?php echo base_url().'inventory/add_new_product/?page=current_stock'; ?>&p_id=<?php echo $p_id;?>" class="btn btn-<?= $current_stock; ?> <?php echo $btn_status;?>">Current Stock</a>
            <a style="display: none;" href="<?php echo base_url().'inventory/add_new_product/?page=product_vendor'; ?>&p_id=<?php echo $p_id;?>" class="btn btn-<?= $product_vendor; ?> <?php echo $btn_status;?>">Product Vendor</a>
        </div>
    </div>
    <br/>
    
    
    <div>
        <?php
            $this->load->view($child_view,$pi);
        ?>
    </div>