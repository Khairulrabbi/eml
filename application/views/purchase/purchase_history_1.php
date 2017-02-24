        
        
        <div style="text-align: right; margin-bottom: 5px;">
            <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
        </div>


        <div class="panel panel-default search_panel" style="display: none;">
            <div class="panel-heading">Search By</div>
            <div class="panel-body">
                    
                    <form class="form-horizontal" id="add_product" action="<?php echo base_url().'purchase/purchase_history'; ?>" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">PO&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php echo po_number(NULL, array('class' => 'po_number')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Order&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php echo order_number(NULL, array('class' => 'order_number')); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-4 control-label">Purchase&nbsp;Type</label>
                                    <div class="col-lg-8">
                                        <?php echo purchase_type(NULL, array('class' => 'purchase_type_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Vendor</label>
                                    <div class="col-lg-9">
                                        <?php echo vendor_list(NULL, array('class' => 'vendor_id')); ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">LC&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php echo lc_number(NULL, array('class' => 'purchase_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-9">
                                        <?php echo status(NULL, array('class' => 'status_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div style="padding-right: 30px;">
                                    <input type="submit" id="search_purchase_history"class="btn btn-primary pull-right" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>
                
            </div>
	</div>



	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(PURCHASE_HISTORY, 'PURCHASE_HISTORY'); ?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(SL_NO, 'SL_NO'); ?></th>
                            <th><?php echo label_html(PO_NUMBER, 'PO_NUMBER'); ?></th>
                            <th><?php echo label_html(PURCHASE_TYPE, 'PURCHASE_TYPE'); ?></th> 
                            <th><?php echo label_html(VENDOR, 'VENDOR'); ?></th>
                            <th><?php echo label_html(LC_NUMBER, 'LC_NUMBER'); ?></th> 
                            <th><?php echo label_html(ORDER_DATE, 'ORDER_DATE'); ?></th>
                            <th><?php echo label_html(SHIPPING_DATE, 'SHIPPING_DATE'); ?></th>
                            <th><?php echo label_html(ORDER_VALUE, 'ORDER_VALUE'); ?></th>
                            <th><?php echo label_html(STATUS, 'STATUS'); ?></th>
                            <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach ($table_data as $data){?>
                          <tr>
                            <td><?php echo $i;$i++?> </td>
                            <td><?php echo $data['purchase_code']?></td>
                            <td><?php echo $data['purchase_type_name']?></td>
                            <td><?php echo vendor_value($data['vendor_name'], $data['mobile_number'], NULL); ?></td>
                            <td><?php echo $data['lc_number']?></td>
                            <td><?php echo $data['order_date']?></td>
                            <td><?php echo $data['shipping_date']?></td>
                            <td><?php echo $data['order_value']?></td>
                            <td><?php echo $data['status_name']?></td>
                            <td>
                            
                            <?php 
                                if(($data['status_id']==6 || $data['status_id']==5 || $data['status_id']==36) && ($data['purchase_type_id'] == 4)){?>
                                    <a href="<?php echo base_url().'purchase/add_new/'.$data['purchase_id'];?>"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp; &nbsp;
                            <?php } ?>
                            <?php 
                                if(($data['status_id']==6 || $data['status_id']==5 || $data['status_id']==12 || $data['status_id']==36) && ($data['purchase_type_id'] == 4)){?>
                                        <a href="<?php echo base_url().'purchase/order_details/'.$data['purchase_id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <?php }elseif (($data['status_id']==12)&& ($data['purchase_type_id'] == 1)) {?>
                                        <a href="<?php echo base_url().'purchase/local_order_details/'.$data['purchase_id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a>          
                              <?php }?>
                            </td>
                          </tr>    
                        <?php }?>
                    </tbody>
                </table>
            </div> <!--Panel body close -->
	</div> <!--Panel div close -->

<script>

$(document).ready(function(){
    $('#purchase_list').DataTable();
});
$('.panel-controller').click(function(e){
    $('.search_panel').slideToggle();
});

</script>