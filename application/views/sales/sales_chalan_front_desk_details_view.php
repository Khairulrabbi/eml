<div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title"><?php echo "Chalan Details Information"; ?></h5>
            </div>
            <div class="panel-body">
                <table class="table table-striped dataTable">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <?php echo get_specification_json_type(array(), "title"); ?>
                            <th>Qty</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($chalan_info != ""){
                            foreach ($chalan_info as $key=>$value){
                                $ps = json_decode($value['product_details_json'],TRUE);
                                ?>
                                <tr>
                                    <td><?php echo $value['product_name']; ?></td>
                                    <td><?php echo $value['product_code']; ?></td>
                                    <?php echo get_specification_json_type($ps, "value"); ?>
                                    <td><?php echo $value['quantity']; ?></td>
                                 </tr>
                            <?php } }?>
                    </tbody>
            </table>
        </div>
    </div>	
</div>
