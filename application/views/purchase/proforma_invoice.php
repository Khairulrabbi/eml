        
        
        <div style="text-align: right; margin-bottom: 5px;">
            <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
        </div>


        <div class="panel panel-default search_panel" style="display: none;">
            <div class="panel-heading"><th><?php echo label_html(SEARCH_BY, 'SEARCH_BY');?></th></div>
            <div class="panel-body">
                    
                    <form class="form-horizontal" id="" action="" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    
                                    <label for="product_category_id" class="col-lg-3 control-label">PO&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php 
                                        $dd_data['selected_value'] = '';
                                        $dd_data['extra_attr'] = array('class' => 'po_number');
                                        echo ap_drop_down(16,NULL,$dd_data); 
                                        ?>
                                        <?php // echo po_number(NULL, array('class' => 'po_number')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Order&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $dd_data['selected_value'] = '';
                                        $dd_data['extra_attr'] = array('class' => 'order_number');
                                        echo ap_drop_down(17,NULL,$dd_data); 
                                        ?>
                                        <?php //echo order_number(NULL, array('class' => 'order_number')); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-4 control-label">Purchase&nbsp;Type</label>
                                    <div class="col-lg-8">
                                        <?php
                                        $dd_data['selected_value'] = '';
                                        $dd_data['extra_attr'] = array('class' => 'purchase_type_id');
                                        echo ap_drop_down(11,NULL,$dd_data); 
                                        ?>
                                        <?php //echo purchase_type(NULL, array('class' => 'purchase_type_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Vendor</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $dd_data['selected_value'] = '';
                                        $dd_data['extra_attr'] = array('class' => 'vendor_id');
                                        echo ap_drop_down(10,NULL,$dd_data); 
                                        ?>
                                        <?php //echo vendor_list(NULL, array('class' => 'vendor_id')); ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">LC&nbsp;Number</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $dd_data['selected_value'] = '';
                                        $dd_data['extra_attr'] = array('class' => 'purchase_id');
                                        echo ap_drop_down(18,NULL,$dd_data); 
                                        ?>
                                        <?php //echo lc_number(NULL, array('class' => 'purchase_id')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="product_category_id" class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-9">
                                        <?php 
                                        $dd_data['selected_value'] = '';
                                        $dd_data['extra_attr'] = array('class' => 'status_id');
                                        echo ap_drop_down(19,NULL,$dd_data);
                                        ?>
                                        <?php //echo status(NULL, array('class' => 'status_id')); ?>
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
            <div class="panel-heading"><?php echo label_html(PROFORMA_INVOICE, 'PROFORMA_INVOICE');?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(SL, 'SL');?></th>
                            <th><?php echo label_html(PURCHASE_CODE, 'PURCHASE_CODE');?></th>
                            <th><?php echo label_html(INDENT_NO, 'INDENT_NO');?></th>
                            <th><?php echo label_html(LC_NUMBER, 'LC_NUMBER');?></th>
                            <th><?php echo label_html(SHIPPING_DATE, 'SHIPPING_DATE');?></th>
                            <th><?php echo label_html(STATUS_NAME, 'STATUS_NAME');?></th>
                            <th><?php echo label_html(CREATED_BY, 'CREATED_BY');?></th>
                            <th><?php echo label_html(CREATED, 'CREATED');?></th>
                            <th><?php echo label_html(ACTION, 'ACTION');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sl=1;
                        if(!empty($proforma_invoice_info)){
                           foreach($proforma_invoice_info as $key=>$value){?>
                            <tr>
                               <td><?php echo $sl++;?></td>
                                <td><?php echo $value['purchase_code'];?></td>
                                <td><a style="text-decoration: underline; color: #00f;" class="details_proforma_invoice" href="<?= base_url().'purchase/proforma_invoice_details/'.$value['proforma_invoice_id']; ?>"><?php echo $value['indent_number'];?></a></td> 
                                <td><?php echo $value['lc_number'];?></td>
                                <td><?php echo $value['shipping_date'];?></td>
                                <td><?php echo $value['status_name'];?></td>
                                <td><?php echo $value['username'];?></td>
                                 
                                <td><?php echo date("j-n-Y", strtotime($value['created'])) ;?></td>
                                <td>
                                    <a href="<?= base_url().'purchase/local_order_details_pdf_generate/'.$value['proforma_invoice_id']; ?>"><i class="fa fa-print" aria-hidden="true"></i></a>
                                </td>
                            </tr>   

                        <?php }}?>
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