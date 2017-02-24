<form class="form-horizontal"  id="my_formM" method="post" action="">
<input type="hidden" name="purchase_type_id" value="<?php echo $order_info->purchase_type_id;?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
               <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo 'Purchase Order Details'; ?> </h3>
                    </div>
                    <div class="panel-body">
                       
                        <table class="table">

                            <tbody>

                                <tr>
                                    <th>Vendor</th>
                                    <td><?php echo $order_info->vendor_name;?></td>
                                    <th>Order No.</th>
                                    <td><?php echo $order_info->purchase_code; ?></td>
                                </tr>
                                <tr>
                                    <th>LC No.</th>
                                    <td><?php echo $order_info->lc_number;?></td>
                                    <th>LC Value.</th>
                                    <td><?php echo $order_info->lc_value; ?></td>
                                </tr>
                                <tr>
                                    <th>Bill Of Entry</th>
                                    <td><?php echo $order_info->bill_of_entry;?></td>
                                    <th>Bill Of Lading</th>
                                    <td><?php echo $order_info->bill_of_lading; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo $order_info->status_name;?></td>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>   
                    </div>
                </div>
                
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Serial Number</th>

                                </tr>
                            </thead>
                            <tbody>
                            <input type="hidden" name="new_received" value="<?php echo $insert_array['new_received'];?>">
                            <input type="hidden" name="serviceTag" value="<?php echo $insert_array['serviceTag'];?>">
                            <input type="hidden" name="vendor_id" value="<?php echo $insert_array['vendor_id'];?>">
                            <input type="hidden" name="product_id" value="<?php echo $insert_array['product_id'];?>">
                            <input type="hidden" name="purchase_id" value="<?php echo $insert_array['purchase_id'];?>">
                            <input type="hidden" name="purchase_price_usd" value="<?php echo $insert_array['purchase_price_usd'];?>">
                            <input type="hidden" name="purchase_price" value="<?php echo $insert_array['purchase_price'];?>">
                            <input type="hidden" name="warranty_start_date" value="<?php echo $insert_array['warranty_start_date'];?>">
                            <input type="hidden" name="warranty_period" value="<?php echo $insert_array['warranty_period'];?>">
                            <input type="hidden" name="warranty_expired_on" value="<?php echo $insert_array['warranty_expired_on'];?>">
                           <input type="hidden" name="packing_slip_date" value="<?php echo $insert_array['packing_slip_date'];?>"> 
							 						   
                                <?php 
                                        
                                        $sl=1;
                                        
                                        foreach($product_code as $key=>$value){?>
                                            
                                            <tr>
                                              <td><?php echo $sl++;?></td>
                                              <td><?php echo $insert_array['product_name'];?></td>
                                              <td>
                                                  <?php echo $value;
                                                  ?>
                                                  <input type="hidden" name="product_code[]" value="<?php echo $value;?>">  
                                                  
                                              </td>
                                              <td><input type="number" class="form-control user-success sl_no " name="serial_number[]" placeholder="Serial Number"></td>
                                            </tr>
                                        <?php } ?>
                            </tbody>
                        </table>    
                        <div class="pull-right"><button class="btn btn-primary" id="save">Save</button></div>
                    </div>
                   
                 </div>
                </div>
                
            </div>
        </div>
</form>
<script> 
    var serial_no = [];
    $(document).on("click", "#save", function (e) {
        e.preventDefault();
        //var data = $("#insert_serial_no").serialize();
         var redirectUrl ='<?php echo base_url(); ?>purchase/packing_slip';
         var post_field ='order_id';
         var post_value = "<?php echo $insert_array['purchase_id'];?>";
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/insert_serial_no',
            type: 'POST',
            data: $("#my_formM").serialize(),
            success: function (data) {
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                '<input type="hidden" name="'+ post_field +'" value="' + post_value + '"></input>' + '</form>');
                $('body').append(form);
                $(form).submit();
            }
        });

    });
  
</script> 


