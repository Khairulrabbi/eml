
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Product Code</th>
                                    <th>Serial Number</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $sl=1;
                                        foreach($products_data as $key=>$value){?>
                                     
                                            <tr>
                                              <td><?php echo $sl++;?></td>
                                              <td>
                                                  <?php echo $value['product_code'];?>
                                              </td><td><input type="number" class="form-control user-success " name="serial_number" value="" placeholder="Serial Number"></td>
                                            </tr>
                                        <?php } ?>
                            </tbody>
                        </table>   
                    </div>
                </div>
                
            </div>
        </div>
    </div>

