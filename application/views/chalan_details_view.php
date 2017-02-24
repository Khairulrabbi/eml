

<div class="col-lg-12">    
    
    <div class="panel panel-default">
        <div class="panel-heading" style="overflow: hidden;  ">
            <h5 class="panel-title pull-left"><?php echo "Chalan Details"; ?> </h5>
        </div>
        <div class="panel-body">
            <table class="table ">
                <tbody>
                    <tr>
                        <th>Chalan Code</th>
                        <td><?php echo $chalan_details->chalan_code; ?></td>
                        <th>Created Date</th>
                        <td><?php echo $chalan_details->created; ?></td>
                        <th>Delivery From</th>
                        <td><?php echo $chalan_details->username; ?></td>
                    </tr>
                    <tr>

                        <th>Chalan Status</th>
                        <td><?php echo $chalan_details->status_name; ?></td>    
                        <th>Created By</th>
                        <td><?php echo $this->session->userdata("USER_ID"); ?></td> 
                        <th>Delivery To</th>
                        <td><?php echo date("Y-m-d",  strtotime($chalan_details->delivery_date)); ?></td>   
                    </tr>
                </tbody>
            </table>   
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" style="overflow: hidden;">
            <h5 class="panel-title pull-left"><?php echo "Item List"; ?> </h5>
        </div>
        <div class="panel-body">
            <table class="table product_list_table">
                <thead>
                    <tr>  

                        <td>Product Name</td>
                        <td>Product Code</td>
                        <?php echo get_specification_json_type(array(),"title"); ?>
                        <td>Qty</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item_list as $k=>$v) { ?>
                    <tr>
                        <td><?php echo $v['product_name']; ?></td>
                        <td><?php echo $v['product_code']; ?></td>
                        <?php echo get_specification_json_type(array(),"value"); ?>
                        <td><?php echo $v['quantity']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>                                   
            </table> 
        </div>
    </div>
    
    <a class="receieve_info" chalan_id="<?php  echo $chalan_details->chalan_id;?>">
        <input type="button" id="" class="btn btn-primary  pull-right"  value="Receive">
       </a>
       
    
</div> 
<div id="vv">
    
</div>

<script>
    $(document).on("click", ".receieve_info", function () {
        var redirectUrl = '<?php echo base_url(); ?>chalan/chalan_list';
        var chalan_id = $(this).attr('chalan_id');
        
        $.ajax({
            url: '<?php echo base_url(); ?>chalan/update_chalan_purchase_good_receive',
            type: 'POST',
            data: {chalan_id: chalan_id},
            success: function (data) {
//                $('#vv').html(data);
                window.location.href = redirectUrl;
            }
        });
    });
</script>