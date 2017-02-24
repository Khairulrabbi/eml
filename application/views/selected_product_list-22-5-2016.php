
        <?php 
        $sl=1;
        if(!empty($selected_product)){
        foreach($selected_product as $key=>$value){?>
            <tr>
              <td><?php echo $sl++;?></td>
              <td>
                  <input type="hidden">
                  <?php echo $value['product_name'];?>
              </td>
              <td><textarea class="form-control product_details" name="deatil" placeholder="Descriptions"><?php echo $value['product_details'] ;?></textarea></td>
              <td><input class="quantity form-control" order_details_id ="<?php echo $value['purchase_order_details_id'];?>" type="number" min="1" name="quantity[]" value="<?php echo $value['quantity'];?>"></td>
              <td><input class="price form-control" order_details_id ="<?php echo $value['purchase_order_details_id'];?>" type="number" step="any" min="1" name="unit_price[]" value="<?php echo $value['purchase_price'];?>"></td>
              <td class="sub_total"><?php echo number_format($value['quantity']*$value['purchase_price'],2); ?></td>
              <td>
                  <i  style=" cursor: pointer;text-align: center;" class="btn btn-info fa fa-pencil update_product" aria-hidden="true"  order_details_id="<?php echo $value['purchase_order_details_id'];?>" title="Update"></i>
                  <i  style=" cursor: pointer;text-align: center;" class="btn btn-danger fa fa-times delete_product" aria-hidden="true"  order_details_id="<?php echo $value['purchase_order_details_id'];?>" title="Delete"></i>
              </td>
            </tr>
        <?php }} ?>
    
