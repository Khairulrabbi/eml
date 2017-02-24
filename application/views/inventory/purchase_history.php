        
<!--        <div class="panel panel-default search_panel" style="display: none;">
            <div class="panel-heading">Search By</div>
            <div class="panel-body">
                    
                    <form class="form-horizontal" id="add_product" action="<?php // echo base_url().'inventory/purchase_history'; ?>" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">PO&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php // echo po_number(NULL, array('class' => 'po_number')); ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Orders&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php // echo order_number(NULL, array('class' => 'order_number')); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-4 control-label">Purchase&nbsp;Type</label>
                                    <div class="col-lg-8">
                                        <?php // echo purchase_type(NULL, array('class' => 'purchase_type_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Vendor</label>
                                    <div class="col-lg-9">
                                        <?php // echo vendor_list(NULL, array('class' => 'vendor_id')); ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">LC&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php // echo lc_number(NULL, array('class' => 'purchase_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-9">
                                        <?php // echo status(NULL, array('class' => 'status_id')); ?>
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
	</div>-->
<div class="panel panel-default">
    <div class="panel-heading"><?php echo label_html(PURCHASE_HISTORY, 'PURCHASE_HISTORY'); ?></div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
            <thead>
                <tr>
                    <th><?php echo label_html(SL, 'SL'); ?></th>
                    <th><?php echo label_html(INDENT_NO, 'INDENT_NO'); ?></th>
                    <th><?php echo label_html(LC_NUMBER, 'LC_NUMBER'); ?></th>
                    <th><?php echo label_html(PURCHASE_DATE, 'PURCHASE_DATE'); ?></th>
                    <th><?php echo label_html(RECEIVE_DATE, 'RECEIVE_DATE'); ?></th>
                    <th><?php echo label_html(RECEIVED_QUANTITY, 'RECEIVED_QUANTITY'); ?></th>
                    <th><?php echo label_html(AMOUNT_USD, 'AMOUNT_USD'); ?></th>
                    <th><?php echo label_html(AMOUNT_BDT, 'AMOUNT_BDT'); ?></th>
                    <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;foreach ($sql as $data){
                        ?>
                  <tr> 
                    <td><?php echo $i;$i++?> </td>
                    <td>
                        <a href="<?php echo base_url().'inventory/add_product_indent_number_wise/'.$data['indent_number'].'/'.$data['product_id']; ?>">
                        <?php echo $data['indent_number']?>
                        </a>
                      
                    </td>
                    <td><?php echo $data['lc_number']?></td>
                    <td><?php echo date("Y-m-d", strtotime($data['purchase_date']))?></td>
                    <td><?php echo date("Y-m-d", strtotime($data['recieve_ack_date']))?></td>
                    <td><?php echo $data['receive_quantity']?></td>
                    <td><?php echo $data['lc_value_usd']?></td>
                    <td><?php echo $data['lc_value_bdt']?></td>
                    <td></td>

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