<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Delivery Schedule List 
                </h4>
            </div>
            <div class="panel-body">
                <div class="row"></div>
                <div class="col-lg-12">
                    <h4 class="text-center text-info">Products Delivery List</h4>
                </div>
                <div style="font-size: 14px;">
                    <div class="col-lg-12">
                        Delivery Date: 28-5-2016
                    </div>
                    <div class="col-lg-12">
                        Van No: Van 1
                    </div>
                    <div class="col-lg-12">
                        Driver Name: Momin Mia
                    </div>
                    <div class="col-lg-12">
                        Location: Dhanmondi
                    </div>
                </div>
                
                <div class="row"></div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="index">Sl#</th>
                            <th>Sales Order No</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Customer Name</th>
                            <th>Contact No</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl=1; foreach ($delivery_list as $valu){?>
                        <tr>
                            <td class=""><?php echo $sl;?></td>
                            <th><?php echo $valu['order_no'];?></th>
                            <th><?php echo $valu['order_date'];?></th>
                            <th><?php echo $valu['delivery_date'];?></th>
                            <th><?php echo $valu['name'];?></th>
                            <th><?php echo $valu['contact_no'];?></th>
                            <th><?php echo $valu['address'];?></th>

                        </tr>
                        <?php $sl++;} ?>
                    </tbody>
                </table>
				<div class="row"></div>
                <div class="col-lg-12" style="margin-top: 20px;">
                    <label for="" class="control-label"></label>
                    <button class="btn btn-primary pull-right" name="print" value="print" type="submit">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>