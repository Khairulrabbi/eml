<div class="panel panel-default">
    <div class="panel-body">
        <div class="text-center adi_info_block"></div>
        <form class="form-horizontal" id="requisition_chalan_frm" action="" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table ">
                        <tbody>
                            <tr>
                                <th>Sales Code</th>
                                <td><?php echo $sales_info->sales_code; ?></td>
                                <th>Delivery To</th>
                                <td><?php echo $sales_info->warehouse_to; ?></td>
                                <th>Delivery From</th>
                                <td><?php echo $sales_info->warehouse_from; ?></td>
                                <th>Delivery Date</th>
                                <td><?php echo $sales_info->delivery_date; ?></td>
                            </tr>
                        </tbody>
                    </table> 

                </div>
                <div class="col-lg-12">
                    <table class="table" style="">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>P.CODE</th>
                                <?php echo get_specification_json_type(array(), "title"); ?>
                                <th>Chalan Qty</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl = 1;
                            foreach ($product_info as $k => $v) {
                                $ps = json_decode($v['product_details_json'], TRUE);
                                ?>
                                <tr>
                                    <td><?php echo $sl++; ?></td>
                                    <td><?php echo $v['product_name']; ?></td>
                                    <td><?php echo $v['product_code']; ?></td>
                                    <?php echo get_specification_json_type($ps, "value"); ?>
                                    <td><?php echo $v['chalan_quantity']; ?></td>
                                </tr>
                            <?php }
                            ?>                          
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div> <!--Panel body close -->
</div> <!--Panel div close -->



