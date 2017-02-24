<div class="col-lg-12">
    <table class="table">
        <tbody>
            <tr>
                <th>Customer Name</th>
                <td><?php echo $chalan_order_details->customer_name;?></td>
            </tr>
            <tr>
                <th>Customer Address</th>
                <td><?php echo $chalan_order_details->address_details;?></td>
                <th>Chalan Code</th>
                <td><?php echo $chalan_order_details->chalan_code;?></td>
            </tr>
            <tr>
                <th>Delivery Date</th>
                <td><?php echo $chalan_order_details->delivery_to;?></td>
                <th>Chalan Date</th>s
                <td><?php echo date("Y-m-d",strtotime($chalan_order_details->created)); ?></td>
            </tr>
            <tr>
                <th>Transfort Name & Number</th>
                <td><?php echo "Hello";?></td>
            </tr>
        </tbody>
    </table>
</div>
        

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Supplementary Tax Charge Amount</th>
                        <th>Supplementary Tax Amount</th>
                        <th>Tax Amount Added with value column</th>
                        <th>Value Added Tax Amount</th>
                        <th>(Supplementary + Vat): Total Amount</th>
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
                        <td><?php echo $v['quantity']; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-8">
            <p>1. During Service Time Only registered Customers Name And address should be noted.During Chalan time Product Final destination , Vehicles character & Product Removal date,time is required for services</p>
            
            <p>2.If Product Delivery Location and and Customer address is different then it should be applied</p>
            <p>3.During Chalan Transfer time product actual date & time should be written</p>
            <p>4.During Directly or hidden Export export Bond or Internal bank to bank  bond or International Tenders time Work order number and date should be added with existing documents</p>
            
        </div>
        <div style="margin-left: 850px;">
            <hr>
            <p style="font-size: 14px;">Customer Signature</p>
        </div>
        
    </div>
    
    <p style="font-size: 14px;text-align: right;">ON BEHALF OF EASTERN MOTORS LTD.</p>
       
</div>







































