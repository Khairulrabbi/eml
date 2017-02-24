<div class="row" style="width: 100%; margin-left: 5px 5px 0px 0px;">
    <div class="col-lg-12">
        <h4 style="text-decoration: underline;"><?php echo date("Y-m-d", strtotime($sum->created));?> CONFIRMATION SHEET</h4>
                    <div class="panel panel-default">
                            <div class="panel-body">
                               
                                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="list" style="margin-left: 20px 0px 0px 0px; ">
                                            <thead>
                                               
                                                <tr>
                                                    <th colspan="2"><?php echo $sum->region_name; ?></th>
                                                    <th colspan="11" style="text-align: left"><?php echo $sum->indent_number; ?></th>
                                                </tr>
                                                <tr>
                                                    <th>DO</th>
                                                    <th>LINE</th>
                                                    <th>P&nbsp;CODE</th> 
                                                    <th>SIZE</th> 
                                                    <th>Pattern</th> 
                                                    <th>Unit</th> 
                                                    <th>Order</th> 
                                                    <th>CNFM</th> 
                                                    <th>Cancel</th> 
                                                    <th>FOB</th> 
                                                    <th>Amount</th> 
                                                    <th>Unit&nbsp;M3</th> 
                                                    <th>Total M3</th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  <?php foreach ($pdf_info as $v){ 
                                        $ps = json_decode($v['product_details_json'],TRUE);
                                                    ?>
                                                <tr>
                                                    <td><?php echo $v['do_product']; ?></td>
                                                    <td><?php echo $v['line']; ?></td>
                                                    <td><?php echo $v['product_code']; ?></td>
                                                    <td><?php echo @$ps[3]; ?></td>
                                                    <td><?php echo @$ps[11]; ?></td>
                                                    <td><?php echo $v['unit']; ?></td>
                                                    <td><?php echo $v['quantity']; ?></td>
                                                    <td><?php echo $v['confirm_quantity']; ?></td>
                                                    <td><?php echo ($v['quantity']-$v['confirm_quantity']); ?></td>
                                                    <td><?php echo ($v['unit_price']*$v['confirm_quantity']); ?></td>
                                                    <td><?php echo '$'." ".$v['unit_price_usd']; ?></td>
                                                    <td><?php echo $v['unit_m3']; ?></td>
                                                    <td><?php
                                                    $total = ($v['unit_m3']*$v['confirm_quantity']);
                                                    echo  $total;?></td>    
                                                </tr>
                                                 <?php } ?>
                                                
                                            </tbody>
                                        
                                     </table>
                                   
                                        <table class="table table-bordered" style="width: 40%;margin-left: 35%;">
                                            <thead>
                                            <tr>
                                                <td style="text-align: center;">T</td>
                                                <td style="text-align: center;">TCF</td>
                                                <td style="text-align: center;">TF</td>
                                                <td style="text-align: center;">TO</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                      
                                                <tr>
                                                <td style="text-align: center;"><?php  echo  $sum->total_quantity;?></td>
                                                <td style="text-align: center;"><?php  echo  $sum->order_quantity;?></td>
                                                <td style="text-align: center;">0</td>
                                                <td style="text-align: center;">0</td>
                                            </tr>
                                            
                                        
                                            </tbody>
                                        </table>   
                                <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <table class="table table-bordered" style="width: 60%; margin-left: 30%;">
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $sum->region_name; ?> Total</td>
                                                        <td style="text-align: center;"><?php echo $sum->total_m3; ?></td>
                                                        <td style="text-align: center;"><?php echo $sum->usd_price; ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-3"></div>
                                   </div>
                                
                               
                                 </div>
                          </div>
                          
                
                
                
                <div>
                    <table>
                        <tr>
                            <td style="margin-left: 20px;">Grand Total :<?php echo ($sum->total_m3+$sum->usd_price); ?> </td>
                        </tr>
                    </table>
               
                    
                </div>
                  
      </div>    
</div>


<style>
    tr,th,td{   
        text-align:center;
        margin: 2px 1px 2px 1px;
        padding: 5px;
    }
</style>

<script>
$(document).ready(function() {
    $('#list').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "bFilter": false
    });
});
</script>

