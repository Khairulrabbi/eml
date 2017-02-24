
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo 'Purchase Order Details'; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
                    </div>
                    <div class="panel-body">
                       
                        <table class="table">

                            <tbody>

                                <tr>
                                    <th>Order No.</th>
                                    <td><?php echo $purchase_code; ?></td>
                                    <th>&nbsp;</th>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <th>LC No.</th>
                                    <td><?php echo $lc_number;?></td>
                                    <th>LC Value.</th>
                                    <td><?php echo $lc_value; ?></td>
                                </tr>
                                <tr>
                                    <th>Bill Of Entry</th>
                                    <td><?php echo $bill_of_entry;?></td>
                                    <th>Bill Of Lading</th>
                                    <td><?php echo $bill_of_lading; ?></td>
                                </tr>
                                <tr>
                                    <th>Exchange Rate</th>
                                    <td><?php echo $exchange_rate; ?></td>
                                    <th>&nbsp;</th>
                                    <td>&nbsp;</td>
                                </tr>

                            </tbody>
                        </table>   
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Packing Slip List"; ?> </h3>
                    </div>
                    <div class="panel-body" id="error_show">
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Ordered Qty</th>
                                    <th>Received Qty</th>
                                    <th>Received Now</th>
                                    <th>Service Tag</th>
                                    <th>Unit Price(USD)</th>
                                    <th>Unit Price(BDT)</th>
                                    <th>Warranty Start Date </th>
                                    <th>Warranty Period(Month) </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $sl=1;
                                        foreach($product as $key=>$value){
                                            $max = $value['quantity']-$value['total_received'];?>
                                <form class="form-horizontal" role="form" method="post" id="my_form_<?php echo $value['product_id'] ?>" action="<?php echo base_url();?>purchase/get_serial_number/<?php echo $order_id; ?>">
                                    <input type="hidden" name="type_of_options" class="type_option" value="">        
                                    <input type="hidden" name="order_id"  value="<?php echo $order_id; ?>"> 
                                    <input type="hidden" name="exchange_rate" class="exchange_rate" value="<?php echo $exchange_rate; ?>">
                                            <tr>
                                              <td><?php echo $sl++;?></td>
                                              <td>
                                                  <?php echo $value['product_name'];?>
                                                  <input type="hidden" name="product_id" class="product_ids" value="<?php echo $value['product_id'];?>">
                                              </td>
                                               <input type="hidden" name="product_name" class="product_name" value="<?php echo $value['product_name'];?>">
                                               <td>
                                                  <?php echo $value['product_details'];?>
                                                  <input type="hidden" name="product_details" class="product_details" value="<?php echo $value['product_details'];?>">
                                                  <input type="hidden" name="vendor_id" class="vendor_id" value="<?php echo $vendor_id;?>">
                                               </td>
                                              <td class="tota_qt"><?php 
                                              $read_only="";
                                              $disable_button="";
                                              if($value['quantity']==$value['total_received']){
                                                $read_only ="readonly='readonly'"; 
                                                $disable_button =' disabled="disabled" ';
                                              }
                                               echo $value['quantity'];?></td>
                                              <td class="total_rec"><?php echo $value['total_received']?$value['total_received']:0;?></td>
                                              <td><input type="number"  class="form-control user-success total_new_rec check" name="new_received" value="" min=1 max="<?php echo $max?>" placeholder="Received Now" <?php echo $read_only;?>></td>
                                              <td><input type="text"  class="form-control user-success serviceTag" name="serviceTag" value="" placeholder="Service Tag" <?php echo $read_only;?>></td>
                                              <td><input type="number"   class="form-control user-success check unit_price_usd" name="unit_price_usd" value="" placeholder="Unit Price(USD)" <?php echo $read_only;?> ></td>
                                              <td><input type="number"   class="form-control user-success check unit_price_bdt" name="unit_price" value="" placeholder="Unit Price(BDT)" <?php echo $read_only;?> ></td>
                                              <td><input  type="date"  class="form-control user-success check" name="warranty_start_date" value="" <?php echo $read_only;?> ></td>
                                              <td><input type="number"   class="form-control user-success check" name="warranty_period" value="" placeholder="Warranty Period" <?php echo $read_only;?>></td>
                                              <td><button type="submit" class="btn btn-primary options"  btn-form="my_form_<?php echo $value['product_id'] ?>" <?php echo $disable_button; ?> >Packing Slip</button></td>
                                            </tr>
                                </form>
                                        <?php } ?>
                            </tbody>
                        </table>   
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<div class="modal fade" id="my_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Options</h4>
        </div>
        <div class="modal-body">
            <form role="form">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" class="pr_f" value="">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-3"><button type="submit" class="btn btn-primary btn-save" value="1" name="csv">CSV Upload</button></div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-3"><button type="submit" class="btn btn-primary btn-save" value="2" name="bar_scan">BarCode Scan</button></div>
                    </div>

                </div>
            </form>
            
            
		  
        </div>
        
      </div>
    </div>
  </div>


<script>
    
    $(document).ready(function(){
        
        
        // validation if all input field is given
        
            $(".options").click(function(){
                //alert("click");
         // show Modal
                var check =1;
                var new_recieve = $(this).parents('tr').find('.total_new_rec').val();
                var qty = $(this).parents('tr').find('.tota_qt').text();
                var recieve = $(this).parents('tr').find('.total_rec').text();
                var max = qty-recieve;
                if(new_recieve>max){
                 $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong>  Please Give correct recieve amount</center></div>").prependTo("#error_show");
                    
                   return;
                }
                else if(new_recieve===0){
                $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong> Recieve amount cannot be zero.</center></div>").prependTo("#error_show");
                  
                  return;
                }
                $(this).parents('tr').find('.check').each(function(){
                   if($(this).val()===''){
                       check=0;  
                   }; 
                });
                if(check){
                $('#my_modal').modal('show');
               }
               else {
                $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error!</strong>Please provide all inputs first.</center></div>").prependTo("#error_show");
               
                 return;
               }
            
           });
 
          
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
                });

            $(document).on("click", ".options", function (e) {
                e.preventDefault();
                var id = $(this).attr('btn-form');
                $('.pr_f').val(id);

            });
            $(document).on("click", ".btn-save", function (e) {
                e.preventDefault();
                var option_val = $(this).closest('.btn-save').val();
                var form_action_id = $('.pr_f').val();
                $('.type_option').val(option_val);

                $("#"+form_action_id).submit();

            });
    });
</script> 
