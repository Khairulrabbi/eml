<table class="table">
    <thead>
      <tr>
        <th>#Sl</th>
        <th>Product Name</th>
        <th>Price(USD)</th>
        <th>Price(BDT)</th>
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
                <td><?php echo $value['unit_price_usd'];?></td>
                <td><?php echo $value['unit_price'];?></td>
                <td  align="center">
                    <input type="hidden" name="purchase_price_usd[<?php echo $value['product_id'];?>]" value="<?php echo $value['unit_price_usd'];?>">
                    <input type="hidden" name="purchase_price[<?php echo $value['product_id'];?>]" value="<?php echo $value['unit_price'];?>">
                    <input class="product_id_array" type="checkbox" name="product_id[]" value="<?php echo $value['product_id'];?>">
                </td>
                  
            </tr>
        <?php } ?>
    
    </tbody>
  </table>
<div class="row "></div>
<div class="btn-toolbar" style="padding-right: 15px;">
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