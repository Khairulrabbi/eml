<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">Chalan Order Details</h5>
        </div>
        <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Chalan Code</th>
                            <td><?php echo $chalan_order_details->chalan_code;?></td>
                            <th>Chalan Type</th>
                            <td><?php echo $chalan_order_details->chalan_type; ?></td>
                            <th>Delivery From</th>
                            <td><?php echo $chalan_order_details->status_name; ?></td>
                        </tr> 
                        <tr>
                            <th>Chalan Status</th>
                            <td><?php echo $chalan_order_details->status_name;?></td>
                            <th>Created</th>
                            <td><?php echo date("Y-m-d",strtotime($chalan_order_details->created)); ?></td>
                            <th>Created By</th>
                            <td><?php echo $chalan_order_details->username; ?></td>
                        </tr>
                        <tr>
                            <th>Delivery Date</th>
                            <td><?php echo $chalan_order_details->delivery_date;?></td>
                            <th>Customer Name</th>
                            <td><?php echo $chalan_order_details->customer_name;?></td>
                            <th>Customer Phone Number</th>
                            <td><?php echo $chalan_order_details->phone_number;?></td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">Item List</h5>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>#Sl</td>
                        <td>Product Name</td>
                        <?php echo get_specification_json_type(array(),"title"); ?>
                        <td>Quantity</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item_list as $k=>$v){ 
                        $i = 1;
                        $ps = json_decode($v['product_details_json'],TRUE);
                        ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $v['product_name']; ?></td>
                        <?php echo get_specification_json_type($ps, "value"); ?>
                        <td><?php echo $v['quantity']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



