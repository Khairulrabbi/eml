<?php
    if(!empty($selected_product_group))
    {
        $sl=1;
        foreach ($selected_product_group as $k=>$v)
        {?>
            <tr>
                <th colspan="11"><?php echo ($table=='region')?$v['region_name']:$v['product_group_name']; ?></th>
            </tr>
            <?php 
            
            //if(!empty($selected_product)){
            foreach($this->purchase_model->get_selected_product2($v['purchase_order_id'],($table=='region')?$v['region_id']:$v['product_group_id'],$table) as $key=>$value){
                $ps = json_decode($value['product_details_json'],TRUE);
                ?>
                <tr>
                    <?php echo ($purchase_order_status->status == 12)?'<th><input '.((($value['proforma_invoice_id'] != NULL) || ($value['confirm_quantity'] < 1))?"disabled='disabled'":"").' class="order_details_id" name="order_details_id[]" value="'.$value['purchase_order_details_id'].'" type="checkbox"></th>':''; ?>
                  <td><?php echo $sl++;?></td>
                    <td>
                        <input type="hidden" name="product_id[]" class="product_id" value="<?php echo $value['product_id'];?>">
                        <input type="hidden" name="purchase_order_details_id[]" class="purchase_order_details_id" value="<?php echo $value['purchase_order_details_id'];?>">
                        <a style="text-decoration: underline" target="_blank" href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$value['product_id']; ?>"><?php echo $value['product_name'];?>&nbsp;<?php echo @$value['model_name'];?></a>
                    </td>
                    <td><?php echo $value['product_code'];?></td>
                    <?php echo ($purchase_order_status->status == 12)?'<td>'.$value['pindent_number'].'</td>':''; ?>
                    <td><?php echo @$ps[1];?></td>
                    <td><?php echo @$ps[5];?></td>
                    <td><?php echo @$ps[12];?></td>
                    <td><?php echo @$ps[13];?></td>
                    <td><?php echo @$ps[14];?></td>
                    <td><?php echo $value['quantity'];?></td>
                    <?php
                        if(($purchase_order_status->status == 6) || ($purchase_order_status->status == 12))
                        {
                            echo '<td><input '.(($value['proforma_invoice_id'] != NULL)?"readonly='readonly'":"").' style="width:100px;" type="number" class="form-control confirm_qty" order_qty="'.$value['quantity'].'" value="'.$value['confirm_quantity'].'"></td>';
                            echo '<td class="cancel_qty">'.($value['quantity']-$value['confirm_quantity']).'</td>';
                        }
                    ?>
                    <td><?php echo $value['purchase_price_usd'];?></td>
                    <td><?php echo $value['purchase_price'];?></td>
                    <td class="sub_total"><?php echo number_format($value['quantity']*$value['purchase_price'],2); ?></td>
                    
                </tr>
            <?php }

            //} 
            ?>
        <?php }
    }

?>











        
    
