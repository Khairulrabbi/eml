
    
        <?php 
        $sl=1;
        if(!empty($selected_product)){
        foreach($selected_product as $key=>$value){?>
            <tr>
              <td><?php echo $sl++;?></td>
              <td>
                  <input type="hidden" name="product_id" class="product_id" value="<?php echo $value['product_id'];?>">
                  <?php echo $value['product_name'];?>
              </td>
              <td><input class="quantity form-control updates" field_name="quantity" quotation_details_id ="<?php echo $value['quotation_details_id'];?>" type="number" min="1" name="quantity[]" value="<?php echo $value['quantity'];?>"></td>
              <td><input class="price_usd form-control updates" field_name="quotation_price_usd" quotation_details_id ="<?php echo $value['quotation_details_id'];?>" type="number" step="any" min="1" name="unit_price_usd[]" value="<?php echo $value['quotation_price_usd'];?>"></td>
              <td><input class="price form-control updates" field_name="quotation_price" quotation_details_id ="<?php echo $value['quotation_details_id'];?>" type="number" step="any" min="1" name="unit_price[]" value="<?php echo $value['quotation_price'];?>"></td>
              <td class="sub_total"><?php echo number_format(($value['quantity']*$value['quotation_price']),2); ?></td>
              <td>
                  <i  style=" cursor: pointer;text-align: center;" class="fa fa-times delete_product" aria-hidden="true"  quotation_details_id="<?php echo $value['quotation_details_id'];?>"></i>
              </td>
            </tr>
        <?php }} ?>
    