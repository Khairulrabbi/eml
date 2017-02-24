<div class="row">
                      <div class='col-lg-12'>
                          
                         <div class='col-lg-2'> 
                            <div class="row">
                             <div class="col-lg-12">
                            <div class="panel panel-default">
                               <div class="panel-heading">Ordered Product List</div>
                                      <div class="panel-body">
                             <ul class="list-group product">
                                 <?PHP
                                    $a1 = array();
                                    foreach($product_list as $val){
                                        $a1[] = $val['quantity'];
                                ?>     
                                       <li p_id='<?php echo $val['product_id']?>' product="<?php echo $val['product_name'];?>" class="list-group-item"><a class="check" href='javascript:void(0)'><span class='badge'><?php echo $val['quantity'];?></span><?php echo $val['product_name'];?>
                                        </li></a>
                                 <?php }
                                    //debug($a1,1);
                                 ?>
                              </ul>
                            </div>
                            </div>
                             </div>     
                     <div class='col-lg-12'>
                            <div class="panel panel-default">
                               <div class="panel-heading">Product Allocation</div>
                                      <div class="panel-body">
                             <ul class="list-group allocate_product">
                                 <?PHP 
                                 $a2 = array();
                                 foreach($allocation_array as $key=> $val){
                                     $a2[] = $val['qty'];
                                     ?>     
                                       <li p_id='<?php echo $val['p_id'];?>' product="<?php echo $val['name'];?>" class="list-group-item"><a class="check_allocation" href='javascript:void(0)'>  <span class='badge'><?php echo $val['qty'];?></span> <?php echo $val['name'];?>
                                      </li></a>
                                 <?php }?>
                              </ul>
                              
                            </div>
                            </div>
                    </div>
                            </div>
                             
                         </div>
                          
                          <div class='col-lg-10'>
                                          
                            <div class="panel panel-default">
                               <div class="panel-heading" id="heading"></div>
                                      <div class="panel-body" id='product_list'>

                                    </div> <!--Panel body close -->
                            </div> <!--Panel div close -->
                              
                          </div>
                          
                          
                          
                          <?php
                            if(($a1 == $a2) && ($approval_position->sales_status == "10"))
                            {
                            ?>
                                <div class='col-lg-10'>                                         
                                    <div class="panel panel-default">
                                       <div class="panel-heading">Send for Approval</div>
                                            <div class="panel-body">
                                                <div class="text-center adi_info_block"></div>
                                                <form id="approval_persons_form" action="" method="post">
                                                    <div class="col-lg-12">
                                                        <label for="remarks" class="col-lg-2 control-label ">Approval Persons Type</label>
                                                            <div class="col-lg-2">
                                                                <input type="hidden" name="order_id" value="<?php echo @$order_id; ?>">
                                                               
                                                                Auto <input <?php echo (@$order_info->approval_type == "1")?'checked':''; ?> type="radio" value="1" name="remark_type" class="auto_remarks"> 
                                                                Manually <input <?php echo (@$order_info->approval_type == "2")?'checked':''; ?> type="radio" value="2" name="remark_type" class="manual_remarks">
                                                            <?php
                                                                    if(@$order_info->approval_type == 2)
                                                                    {
                                                                        echo "<script>";
                                                                        echo "jQuery(function(){";
                                                                        echo "jQuery('.manual_remarks').click();";
                                                                        echo "});";
                                                                        echo "</script>";
                                                                    }
                                                                ?>
                                                            </div>
                                                        
                                                    </div>
                                                    <br/><br/>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-12 approve_persons_parrent" style="display: none; margin-bottom: 10px;">
                                                            <label for="remarks" class="col-lg-3 control-label ">Approval Persons</label>
                                                            <div class="col-lg-9">
                                                                <?php echo approval_privilege_multiselect(explode(',',@$level_array),array('multiple'=>'multiple','class'=>'form-control multiple_user_value'),'userid[]',array("privilege_for_approval.approve_for_id"=>3,"user.status = Active")); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row "></div>
                                                    <div class="" style="padding-right: 15px;">
                                                        <input type="submit" class="approval_submit btn btn-primary pull-right" value="Send">
                                                    </div>
                                                    </form>
                                            </div>
                                    </div>
                                </div>
                            <?php
                            }
                            else if($approval_position->sales_status == "3")
                            {
                            ?>
                                <div class='col-lg-10'>                                         
                                    <div class="panel panel-default">
                                       <div class="panel-heading">Send for Approval</div>
                                            <div class="panel-body">
                                                <div class="text-center adi_info_block"></div>
                                                <div class="invalid alert alert-success">Waiting For Approval</div>
                                            </div>
                                    </div>
                                </div>
                            <?php
                            }
                          ?>
                          
                           
                        </div>

    </div>

<script>
    
    function load_avail_data(id){
        //alert(house);
          $.ajax({
            url: '<?php echo base_url(); ?>sales/load_available_product',
            type: 'POST',
            data:{product_id:id},
            success: function (data) {
                //alert("ok");
                $("#product_list").html(data);
            }
        });
    }


        function load_allocated_data(p_id,order_id){
          $.ajax({
            url: '<?php echo base_url(); ?>sales/load_allocated_product',
            type: 'POST',
            data:{product_id:p_id,order_id:order_id},
            success: function (data) {
                //alert("ok");
                $("#product_list").html(data);
            }
        });
    }
    
          function validate_product_allocation_number(p_id){
              var order_qty = $(".product li[p_id="+p_id+"]").find('span').text();
              //alert(order_qty);
              var allocated_qty = $(".allocate_product li[p_id="+p_id+"]").find('span').text();
              //alert(allocated_qty);
              var remaining = order_qty-allocated_qty;
              return remaining;
          }

$(document).ready(function(){
    //$('#d_table').DataTable();
    /*Initially load items 
     * for first product
     */
     var order_id = '<?php echo $order_id;?>';
     
     var p_id = $('.product li').first().attr('p_id');
     //alert(p_id);
     var p_name = $('.product li').first().attr('product');
     $('.product li').first().addClass('list-group-item-info');
     $("#heading").html('Available Product List  <small class="pull-right" style="color:#337ab7;">'+'    '+p_name+'</small>');
     load_avail_data(p_id);
      
     /*
      * On click of product change 
      * Table content also changed according to selected product
      * avail product list
      */ 
    $(document).on("click",".check",function(){
        var p_id = $(this).parent().attr('p_id');
        //alert(p_id);
        //var order_id = '<?php //echo $order_id;?>'
        var name = $(this).parent().attr('product');
        //alert(name);
        //var house = $('select[name=warehouse_id] option:selected').val();
        //alert(house);
        $('.product li.list-group-item-info').removeClass('list-group-item-info');
        $(this).parent().addClass('list-group-item-info');
        $("#heading").html('Available Product List  <small class="pull-right" style="color:#337ab7;">'+'    '+name+'</small>');
         load_avail_data(p_id);
    });
    
    /*     /*
      * On click of product change 
      * Table content also changed according to selected product
      * allocated product list
      */ 
    
    $(document).on("click",".check_allocation",function(){
        
        var p_id = $(this).parent().attr('p_id');
        //alert(p_id);
        var name = $(this).parent().attr('product');
        var order_id = '<?php echo $order_id;?>'

        $('.product li.list-group-item-info').removeClass('list-group-item-info');
        $(this).parent().addClass('list-group-item-info');
        $("#heading").html('Allocated Product List  <small class="pull-right>'+'   '+name+'</small>');
        load_allocated_data(p_id,order_id);
    });
    
    /* If check all is selected check 
     * all table rows
     */
    $(document).on("click","#check_all",function(){
        var check = $('#check_all').is(':checked');

        if(check){
            $(".c_box").prop('checked',true);  
        }
        else{
            $(".c_box").prop('checked',false);  
        }
       
    });
    
    /*
     * allocate product item 
     * for the order id
     * change sale status to allocated
     */
        $(document).on("click","#allocate",function(){
            
            var p_id = $(this).attr('p_id');
            //alert(p_id);
            var remaining = validate_product_allocation_number(p_id)
            
            var data_array=[];
            var selector = $("#d_table tbody tr").filter(':has(:checkbox:checked)');
            
        if(selector.length>0)
        {
            var selected_qty = selector.length;
            var p_code;
            var serial_no;

            if(selected_qty <= remaining)
            {
            selector.each(function(){
                p_code = $(this).find('td').eq(1).text();
                serial_no = $(this).find('td').eq(2).text();
                data_array.push({p_code:p_code,serial_no:serial_no,order_id:order_id});
            });
       
       $.ajax({
           url:'<?php echo base_url(); ?>sales/sales_status_change/17',
           type:"post",
           data:{data:data_array},
           success:function(){
               location.reload();
           }
           
       });
    }
    else{
    $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error! </strong>You are trying to allocate more than order quantity!!! Check Allocation List.</center></div>").prependTo("#product_list");
   // alert('select proper amount of item');
    }
 }
 else{
 $("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>Error! </strong>Please select any Item first.</center></div>").prependTo("#product_list");
;
 }
    
    
 });
        /*
     * release allocated product item 
     * for the order id
     * change sale status to release
     */
    
    $(document).on("click","#release",function(){
       var data_array=[];
       var selector = $("#d_table tbody tr").filter(':has(:checkbox:checked)');
       var p_code;
       var serial_no;
       selector.each(function(){
           p_code = $(this).find('td').eq(1).text();
           serial_no = $(this).find('td').eq(2).text();
           data_array.push({p_code:p_code,serial_no:serial_no,order_id:order_id});
       });
       
       $.ajax({
           url:'<?php echo base_url(); ?>sales/sales_status_change/19',//release status 19
           type:"post",
           data:{data:data_array},
           success:function(){
               location.reload();
           }
           
       });
    });
});


$(document).on('click','.manual_remarks',function(){
        $('.approve_persons_parrent').show();
    });
    $(document).on('click','.auto_remarks',function(){
        $('.approve_persons_parrent').hide();
    });

$(".approval_submit").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: '<?php echo base_url(); ?>sales/send_for_sales_order_approve',
        type: 'POST',
        data: $('#approval_persons_form').serialize(), 
        success: function (data) {
           var str = data.replace(/\n|\r/g, "");
           if(str != "done")
           {
                var htm ='<div class="invalid alert alert-danger">';
                htm += str;
                htm +='</div>';
                $('.adi_info_block').html(htm);
                $('.invalid').slideUp(4000);
           }
           else
           {
                var htm ='<div class="invalid alert alert-success">';
                htm += 'Successfully Send....';
                htm +='</div>';
                $('.adi_info_block').html(htm);
                //$('.invalid').slideUp(4000);
           }
        }
    });
});
</script>



