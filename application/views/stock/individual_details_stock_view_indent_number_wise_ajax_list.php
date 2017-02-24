<table class="table table-striped table-bordered table-hover dataTable no-footer" id="d_table">
    <thead>
        <tr>
            <th>SL No.</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <?php echo get_specification_json_type(array(), "title");?>
            <th>Indent Number</th>
            <th>WareHouse</th>
            
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
            <?php $i=1;foreach($table_data as $data){
                $ps = json_decode($data['product_details_json'],TRUE);
            ?>
              <tr>
                    <td><?php echo $i;$i++?> </td>
                    <td>
                        <a href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$data['product_id']; ?>">
                            <?php echo $data['product_name']?>
                        </a>
                    </td>
                    <td><?php echo $data['product_code']?></td>
                    <?php echo get_specification_json_type($ps, "value") ;?>
                    <td>
                        <a style="text-decoration: underline; color: #00f;"  href="<?= base_url().'purchase/proforma_invoice_details/'.$data['proforma_invoice_id']; ?>"><?php echo $data['indent_number']?></a>
                    </td>
                    <td><?php echo $data['warehouse_name']?></td>
                    <td><?php echo $data['available_quantity']?></td>
              </tr>    
            <?php }?>
    </tbody>
    
</table>

<p style="text-align: right; font-size: 16px; margin-right: 8px;">
    <b>Total :
    <?php 
    $total = 0;
        foreach ($table_data as $key => $value) {
            $total=$total+$value['available_quantity'];
        }
       echo $total ;
    ?> 
    </b>
</p>

