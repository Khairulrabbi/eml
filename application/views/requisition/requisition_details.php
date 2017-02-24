<ul class="nav nav-pills" style="margin: 0 0 15px 15px;">
    <li class="active"><a data-toggle="tab" href="#requisition_info">Requisition Details Info</a></li>
    <li><a data-toggle="tab" href="#chalan_list">Chalan List</a></li>
    <li><a data-toggle="tab" href="#approve_history">Approve History</a></li>
</ul>
<div class="tab-content">
    <div id="requisition_info" class="tab-pane fade in active">
        <form class="form-horizontal" role="form" method="post" id="" action="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="overflow: hidden;  ">
                                <h5 class="panel-title pull-left"><?php echo "Requisition Details"; ?> </h5>
                                <?php
                                    if($table_data->requisition_status == 41)
                                    { ?>
                                        <a style="margin-left: 1020px;" target="" <?= bpa('chalan_info')?'':'disabled="disabled"'; ?> class="btn btn-primary" href="<?php echo base_url() . 'chalan/requisition_chalan_form/'.$requisition_id; ?>">Create Chalan</a>
                                   <?php }
                                ?>
                                
                            </div>
                            <div class="panel-body">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <th>Requisition Code</th>
                                            <td><?php echo $table_data->requisition_code; ?></td>
                                            <th>Created Date</th>
                                            <td><?php echo $table_data->created; ?></td>
                                            <th>Created By</th>
                                            <td><?php echo $table_data->username; ?></td>        
                                        </tr>
                                        <tr>
                                            <th>Requisition Status</th>
                                            <td><?php echo $table_data->status_name; ?></td>
                                            <th>Delivery Request Date</th>
                                            <td><?php echo $table_data->request_date_for_delivery; ?></td>
                                            <th>Deliver To</th>
                                            <td><?php echo $table_data->warehouse_name; ?></td>
                                        </tr>
                                    </tbody>
                                </table>   
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" style="overflow: hidden;">
                                <h5 class="panel-title pull-left"><?php echo "Item List"; ?> </h5>
                            </div>
                            <div>&nbsp;</div>
                            
                            <div class="panel-body">
                                <table class="table product_list_table">
                                    <thead>
                                        <tr>  
                                            <th>#SL</th>
                                            <th style="width: 130px;">Product Name</th>
                                            <th>P.CODE</th>
                                            <?php echo get_specification_json_type(array(), "title"); ?>
                                            <th>Request Qty</th>
                                            <th>Chalan Qty</th>
                                            <th>Approve Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sl=1;
                                            foreach($sql as $key=>$value){
//                                                debug($sql ,1);
                                            $ps = json_decode($value['product_details_json'],TRUE);
                                        ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td><?php echo $value['product_name']; ?></td>
                                            <td><?php echo $value['product_code']; ?></td>
                                            <?php echo get_specification_json_type($ps, "value"); ?>
                                            <td><?php echo $value['request_quantity']; ?></td>
                                            <td><?php echo ($value['chalan_quantity'])?$value['chalan_quantity']:0; ?></td>
                                            <td><?php echo $value['approved_quantity']; ?></td>
                                        </tr>
                                        <?php } ?>    
                                    </tbody>                                   
                                </table> 
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h5 class="panel-title"><?php echo "Deligation Information"; ?> </h5>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>User Name</th>
                                            <th>Step Number</th>
                                            <th>Sort Number</th>
                                            <th>Must Approve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sl=1;
                                            foreach($info as $key=>$value){
                                        ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['step_number']; ?></td>
                                            <td><?php echo $value['sort_number']; ?></td>
                                            <td>
                                                <?php if($value['must_approve'] == 0){
                                                   echo $value['must_approve'] = "No" ;
                                                }
                                                else{
                                                    echo $value['must_approve'] = "Yes" ;
                                                }?>
                                            </td>
                                        </tr>
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                            if(($table_data->requisition_status == 40) && (approval_comments_access($table_data->requisition_code, $this->session->userdata("USER_ID"),"stock_requisition","requisition_code")))
                            { ?>
                                <div class="panel panel-default">
                                    
                                    <div class="panel-heading"> 
                                        <h5 class="panel-title">Approve Comments</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="comment_block"></div>
                                            <div class="row "></div>                                
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <div class="col-lg-7">
                                                        <textarea style="width: 600px;" class="approve_comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            <button style="margin-left: 10px;" id="" class="btn btn-primary approve_submit pull-right" name="" value="">Approve</button>
                            <button  id="" class="btn btn-danger decline_submit pull-right" name="" value="">Decline</button>
                            <?php }
                        ?>
                        
                        
                    </div>
                </div>
            </div>
        </form>
    </div>

    
    
    <div id="chalan_list" class="tab-pane fade">
            <div class="panel-body">
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h5 class="panel-title"><?php echo label_html(CHALAN_LIST, 'CHALAN_LIST'); ?></h5>
               </div>
                        <div class="panel-body">
                            <div class="text-center order_block"></div>
                            <div class="row">
                                <table class="table table-striped dataTable" id="chalan_list_1">
                                    <thead>
                                    <th>Chalan Code</th>
                                    <th>Delivery From</th>
                                    <th>Delivery To</th>
                                    <th>Delivery Date</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($chalan_info != ""){
                                        foreach ($chalan_info as $k=>$v){ ?>
                                        <tr>
                                            <td><?php echo $v['chalan_code']; ?></td>
                                            <td><?php echo $v['frwarehouse']; ?></td>
                                            <td><?php echo $v['dtowarehouse']; ?></td>
                                            <td><?php echo $v['delivery_date']; ?></td>
                                            <td><a href="<?php echo base_url() . 'requisition/requisition_chalan_details_info/'.$value['stock_requisition_id']; ?>"><input type="button" class="btn btn-primary" value="View Details"></a></td>
                                                                                 </tr>
                                        
                                        <?php
                                            }
                                        }
                                   ?>
                                    </tbody>
                                </table>     
               
                         
                            </div>
                    
                             </div> <!--Panel body close -->
                        <br>
           </div> <!--Panel div close -->
       </div>
    </div>
    
    
    
    
    <div id="approve_history" class="tab-pane fade">
        <div class="panel panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <span>Approved  List</span> 
                        <p class="pull-right text-danger" style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (!empty($current_approval_location)?"Current Step : ".$current_approval_location->step_number.", Current Approval User : ".$current_approval_location->username:""); ?></p>
                    </h5>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>
                        <table class="table table-striped dataTable approve_history">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>requisition Code</th>
                                    <th>Approved Date</th>
                                    <th>Approved By</th>
                                    <th>Reliever To</th>
                                    <th>Comments</th>
                                    <th>Action Type</th>
                                    <th>Delegation Time</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = 1;
                                if (!empty($approve_history)) {
                                    foreach ($approve_history as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td><?php echo $value['ref_no']; ?></td>
                                            <td><?php echo date('Y-m-d',strtotime($value['created'])); ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['comment']; ?></td>
                                            <td><?php echo $value['action_type']; ?></td>
                                            <td><?php echo date("Y-m-d",strtotime($value['delegation_start'])) ; ?></td>
                                        </tr>   

                                    <?php }
                                } ?>
                             </tbody>
                        </table>
                  </div>
            </div> <!--Panel body close -->
        </div>
    </div>
  
</div>

  

<script>
     $(document).on("change", "#delivery_location", function (e) {
        e.preventDefault();
        var requsition_id = $('.requisition_id').val();
        var delivery_to = $(this).val();
        $.ajax({
                url: '<?php echo base_url(); ?>chalan/load_requisition_info',
                type: 'POST',
                data: {requsition_id:requsition_id,delivery_to:delivery_to},
                success: function (data) {
                    $("table tbody").html(data);
                }
            });
    });
    
    
    $(document).on("blur", ".confirm_quantity", function () {
        var t = $(this);
        var available_quantity = parseInt($(this).parent().parent().find(".taproduct").text());
        var request_quantity = parseInt($(this).parent().parent().find(".rquest_quantity").text());
        var approve_quantity = parseInt($(this).parent().parent().find(".approve_quantity").text());
        var stock_requisition_details_id = $(this).parent().parent().find(".stock_requisition_details_id").val();
        var ex_chalan = parseInt($(this).parent().parent().find(".chalan_quantity").text());
        var chalan_quantity = parseInt($(this).val());
        var total_chalan = chalan_quantity+ex_chalan;
        
        if((available_quantity >= total_chalan) && (approve_quantity >= total_chalan))
        {
            $(this).css("border","");
            $.ajax({
                url: '<?php echo base_url(); ?>chalan/update_confirm_quantity',
                type: 'POST',
                data: {chalan_quantity:chalan_quantity,stock_requisition_details_id:stock_requisition_details_id},
                success: function (data) {
                    t.parent().parent().find(".chalan_quantity").text(data);
                    t.val("");
                    if(available_quantity == data)
                    {
                        t.attr("disabled","disabled");
                    }
                }
            });
        }
        else
        {
            $(this).css("border","1px solid #f00");
        }
    });
    
    
    $(document).on("click",".approve_submit", function (e) {
        e.preventDefault();
        var comments = $('.approve_comment').val();
        
        var ref_id = "<?php echo $table_data->requisition_code; ?>";
        if(comments)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/approve_delegation_action',
                type: 'POST',
                data: {ref_id:ref_id,comments:comments},
                success: function (data) {
                   if(data == true)
                   {
                       window.location.href = "<?php echo base_url(); ?>common_controller/waiting_approval_list/requisition";
                   }
                }
            });
        }
        else
        {
            var htm = '<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Comments Field can not be empty.';
            htm += '</div>';
            $('.comment_block').html(htm);
        }
        
    });
</script>
