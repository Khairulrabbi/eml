<table class="table table-bordered">
    <thead>
      <tr>
        <th>#Sl</th>
        <th>Product Name</th>
        <th>Price</th>
        <th style="text-align: center;"><input type="checkbox" id="select_all"></th>
      </tr>
    </thead>
    <tbody>
    
        <?php 
        $sl=1;
        //echo "<pre>";
        //print_r($selected_product);
        foreach($list as $key=>$value){?>
            <tr>
              <td><?php echo $sl++;?></td>
              <td><?php echo $value['product_name'];?></td>
              <td><?php echo $value['unit_price'];?></td>
              <td  align="center">
                  <?php if(!in_array($value['product_id'], $selected_product)){?>
                    <input type="hidden" name="purchase_price[]" value="<?php echo $value['unit_price'];?>">
                    <input class="product_id_array" type="checkbox" name="product_id[]" value="<?php echo $value['product_id'];?>"></td>
                  <?php }else{ ?>
                        <span style="color: red; text-align: center;display: block;">Already Selected</span>
                  <?php } ?>
            </tr>
        <?php } ?>
    
    </tbody>
  </table>
<input type="submit" value="ADD" class="add_product" name="add">

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