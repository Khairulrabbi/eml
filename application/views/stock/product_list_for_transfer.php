<table class="table table-bordered">
    <thead>
      <tr>
        <th>#Sl</th>
        <th>Product Name</th>
        <th>Brand Name</th>
        <th>Category Name</th>
        <th>Sub Category Name</th>
        <th>Serial No.</th>
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
              <td><?php echo $value['product_brand_name'];?></td>
              <td><?php echo $value['product_category_name'];?></td>
              <td><?php echo $value['product_subcategory_name'];?></td>
              <td><?php echo $value['serial_number'];?></td>
              <td  align="center">
                <input class="product_id_array" type="checkbox" name="product_code[]" value="<?php echo $value['product_code'];?>"></td>
                  
            </tr>
        <?php } ?>
    
    </tbody>
  </table>
<input type="submit" value="ADD" class="btn btn-primary add_product" name="add">

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