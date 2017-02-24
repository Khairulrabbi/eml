
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            
            <div class="panel-title" style="overflow:hidden">
                <span class="pull-left">Chalan For</span>
                <span class="pull-right">
                    <a href="<?= base_url().'chalan/chalan_details_pdf_generate/'.$requisition_id;?>">
                        <input class="btn btn-primary " value="print" type="button">
                    </a>
                </span>
            </div>
            
        </div>
        <div class="panel-body">
            <div class="text-center adi_info_block"></div>
            <form class="form-horizontal" id="requisition_chalan_frm" action="" method="post">
            <div class="row">
                <table class="table ">
                        <tbody>
                            <tr>
                                <th>Requisition Code</th>
                                <td><?php echo $requisition_info->requisition_code; ?></td>
                                <th>Delivery To</th>
                                <td><?php echo $requisition_info->warehouse_to; ?></td>
                                <th>Delivery From</th>
                                <td><?php echo $requisition_info->warehouse_from; ?></td>
                                <th>Delivery Date</th>
                                <td><?php echo $requisition_info->delivery_date; ?></td>
                            </tr>
                        </tbody>
                    </table>
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
</div>


