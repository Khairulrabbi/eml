<div class="panel panel-default">
    <div class="panel-heading" style="overflow: hidden;  ">
        <div class="panel-title pull-left ">
            Details of <?php echo $p_group_name; ?> Group
        </div>
    </div>
        <div class="panel-body">
            <div class="col-lg-6">
                <table class="table table-bordered" id="">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Prodcut Code</th>
                            <th>Region</th>
                            <th>SDTA</th>
                            <th>Size Of Tyre</th>
                            <th>PR</th>
                            <th>Pattern</th>
                            <th>FOB</th>
                            <th>Landed Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($sql->result() as $row)
                            { 
                                $ps = json_decode($row->product_details_json,TRUE);
                                ?>
                                <tr>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo $row->product_code; ?></td>
                                    <td><?php echo $row->region_name; ?></td>
                                    <td><?php echo $row->sdta; ?></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo $row->purchase_price_usd; ?></td>
                                    <td><?php echo $row->landed_cost; ?></td>
                                    <td>
                                        <a 
                                            href="" 
                                            class="individual_product_fob_costing" 
                                            id="individual_product_fob_costing" 
                                            purchase_order_details_id="<?php echo $row->purchase_order_details_id; ?>">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        ?>                                
                    </tbody>                      
                </table>
            </div> 
            
            
            <div class="col-lg-6 individual_product_fob_costing_details">
               
            </div> 


        </div>
    </div>