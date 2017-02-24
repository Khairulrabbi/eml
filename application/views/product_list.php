<table class="table">
    <thead>
      <tr>
        <th>#Sl</th>
        <th>Product Name</th>
        <th>Model Name</th>
        <th>P.Code</th>
        <?php echo get_specification_json_type(array(), "title") ;?>
        <th>Current Stock</th>
        <th>Price(USD)</th>
        <th>Price(BDT)</th>
        <th style="text-align: center;"><input type="checkbox" id="select_all"></th>
      </tr>
    </thead>
    <tbody>
    
        <?php 
        $sl=1;
        foreach($list as $key=>$value){
            if(isset($module))
            {
                if($module == "purchase")
                {
                    $qtable = "purchase_order_details";
                    $qfield = "purchase_order_id";
                }
                else if($module == "requisition")
                {
                    $qtable = "stock_requisition_details";
                    $qfield = "stock_requisition_id";
                }
                else if($module == "sales" || ($module == "counter"))
                {
                    $qtable = "sales_order_details";
                    $qfield = "sales_order_id";
                }
                else if($module == "price_list")
                {
                    $qtable = "price_list_details";
                    $qfield = "price_list_id";
                }
            }
            $row = $this->db->query("SELECT product_id FROM ".$qtable." WHERE ".$qfield."=".$gorder_id." AND product_id=".$value['product_id'])->row();
            $ps = json_decode($value['product_details_json'],TRUE);
            ?>
            <tr>
                <td><?php echo $sl++;?></td>
                <td><?php echo $value['product_name'];?></td>
                <td><?php echo $value['model_name'];?></td>
                <td><?php echo $value['product_code'];?></td>
                <?php echo get_specification_json_type($ps, "value"); ?>
                <td><?php echo $value['total']; ?></td>
                <td><?php echo $value['unit_price_usd'];?></td>
                <td><?php echo $value['unit_price'];?></td>
                <td  align="center">
                    <input type="hidden" name="purchase_price_usd[<?php echo $value['product_id'];?>]" value="<?php echo $value['unit_price_usd'];?>">
                    <input type="hidden" name="purchase_price[<?php echo $value['product_id'];?>]" value="<?php echo $value['unit_price'];?>">
                    <input <?php echo (@$row->product_id)?'disabled="disabled"':''; ?> class="product_id_array" type="checkbox" name="product_id[]" value="<?php echo $value['product_id'];?>">
                </td>
                  
            </tr>
        <?php } ?>
    
    </tbody>
  </table>
<div class="row "></div>
<div class="btn-toolbar" style="padding-right: 15px;">
    <?php
        if($module == "sales" || ($module == "counter"))
        {
            $active_price_list_id = $this->common_model->get_active_price_list_id($module);
            echo "<input type='hidden' name='price_list_id' value='".$active_price_list_id->price_list_id."'>";
        }
    ?>
    <input type="submit" value="ADD" class="btn btn-primary add_product_btn pull-right" data-dismiss="modal" name="add">
</div>


<script>
    $('#select_all').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});

</script>