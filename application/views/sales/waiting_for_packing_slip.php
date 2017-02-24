<?php
    echo get_grid_list(
            array(
                'title'=>'Waiting for Packing Slip',
                'search_panel'=>FALSE,
                'search_action'=>'',
                'custom_search_column'=>4, 
                'custom_search_panel'=>array(),
                'tboday'=>TRUE,
                'columns'=>$columns,
                'sql'=>$sql,
                'action'=>$action
            )
        );
?>


<div class="panel panel-default">
    <div class="panel-heading" style="overflow: hidden;">
        <span class="pull-left"><?php echo label_html(CURRENTLY_ACTIVE_SCHEDULE, 'CURRENTLY_ACTIVE_SCHEDULE')?></span>
        <span class="pull-right btn btn-primary create_schedule_button" data-toggle="modal" schedule_id="" sales_id="">Create Schedule</span>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            foreach ($active_schedules->result() as $ac)
            {
            ?>
                <div class="col-md-3">
                    <div class="sg">
                        <div class="sg_no">Schedule No. - <?php echo $ac->schedule_code; ?></div>
                        <div class="s_info">
                            Location Zone - <?php echo $ac->address; ?><br/>
                            Schedule Time - <?php echo $ac->schedule_time; ?><br/>
                            Van No - <?php echo $ac->van_no; ?><br/>
                            Driver - <?php echo $ac->driver_name; ?>
                        </div>
                        <div class="o_info">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th><?php echo label_html(SL, 'SL'); ?></th>
                                        <td><?php echo label_html(ORDER_NUMBER, 'ORDER_NUMBER'); ?></td>
                                        <th><?php echo label_html(ADDRESS, 'ADDRESS') ?></th>
                                    </tr>
                                    <?php
                                        $sales_order_info = $this->db->query("SELECT sales_code, address FROM sales_order WHERE sales_id IN(".implode(',',json_decode($ac->sales_id)).")");
                                        $osl = 1;
                                        foreach ($sales_order_info->result() as $soi)
                                        {
                                        ?>
                                            <tr>
                                                <th><?php echo $osl; ?></th>
                                                <td><?php echo $soi->sales_code; ?></td>
                                                <th><?php echo $soi->address; ?></th>
                                            </tr>
                                        <?php
                                        $osl++;
                                        }
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="s_action">
                            <span class="btn btn-success delivery_confirm" schedule_id="<?php echo $ac->delivery_schedule_id; ?>">Confirm</span>
                            <span class="btn btn-danger">Print Chalan</span>
                            <span 
                                class="btn btn-primary create_schedule_button" 
                                data-toggle="modal" 
                                schedule_id="<?php echo $ac->delivery_schedule_id; ?>"
                                sales_id="<?php echo implode(',',json_decode($ac->sales_id)); ?>">Edit Schedule
                            </span>
                        </div>
                    </div>
                </div>
            <?php                
            }
            ?>
        </div>
    </div>
</div>


<!--Start create schedule modal-->
<div id="create_schedule_button" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" id="add_item_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create New Schedule</h4>
            </div>
            <div class="modal-body">
                <form id="schedule_order_form" class="form-horizontal" action="" method="post">
                    <div class="text-center adi_info_block"></div>
                    <input type="hidden" id="" class="edit_schedule_id" name="schedule_id" value="<?php echo @$schedule_id; ?>">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="schedule_no">Schedule No.</label>  
                        <div class="col-md-3">
                            <input readonly="" id="schedule_no" name="schedule_no" type="text" placeholder="Schedule No." class="form-control input-md" value="">
                        </div>
                        <label class="col-md-2 control-label" for="delivery_time">Delivery Time</label>  
                        <div class="col-md-2">
                            <input type="date" class="form-control delivery_time" id="delivery_time" name="delivery_time" value="" >
                        </div>
                        <div class="col-md-2">
                            <input type="time" class="form-control time" id="time" name="time" value="" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="schedule_no">Location</label>  
                        <div class="col-md-3">
                            <?php echo delivery_location_list((@$order_info->sales_person_id?$order_info->sales_person_id:$this->user_id), array('class' => 'delivery_location', 'required' => 'required')); ?>
                        </div>
                        <label class="col-md-3 control-label" for="delivery_time">Delivery Van</label>  
                        <div class="col-md-3">
                            <?php echo delivery_van_list((@$order_info->sales_person_id?$order_info->sales_person_id:$this->user_id), array('class' => 'delivery_van', 'required' => 'required')); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="schedule_no">Sales Orders</label>  
                        <div class="col-md-12 show_sales_order">
                            <!--here show sales order list-->
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary pull-right create_schedule_submit_button" value="Create">
                        </div>                        
                    </div>
                    
                </form>

            </div>     
        </div>

    </div>
</div>
<!--end create schedule modal-->

<script>
$(".create_schedule_button").click(function () {
    var schedule_id = $(this).attr('schedule_id');
    var sales_id = $(this).attr('sales_id');
    $('.edit_schedule_id').val(schedule_id);  
    $(this).attr("data-target", "#create_schedule_button");
    $.ajax({
        url: '<?php echo base_url(); ?>sales/order_list_for_create_schedule',
        type: 'POST',
        data: {schedule_id:schedule_id,sales_id:sales_id},
        success: function (data) {
            if(schedule_id)
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>sales/selected_value_from_schedule_table',
                    type: 'POST',
                    data: {schedule_id:schedule_id},
                    dataType: "json",
                    success: function (data) {
                        var dtime = data['schedule_time'].split(' ');
                        $('#schedule_no').val(data['schedule_code']);
                        $('#delivery_time').val(dtime[0]);
                        $('#time').val(dtime[1]);
                        $(".delivery_location").select2("val",data['delivery_address_id']);
                        $(".delivery_van").select2("val",data['van_id']);
                    }
                });                
            }
            else 
            {
                $('#schedule_no').val("<?php echo $schedule_code; ?>");
                $('#delivery_time').val("");
                $('#time').val("");
                $(".delivery_location").val("");
                $(".delivery_van").val("");
            }
           $('.show_sales_order').html(data);
           
        }
    });
});


$(".delivery_confirm").click(function () {
    var schedule_id = $(this).attr('schedule_id');
    if (confirm('Are you sure you want to confirm this? There is no undo.')) {
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delivery_confirm',
            type: 'POST',
            data: {schedule_id:schedule_id},
            success: function (data) {
                if(data == true)
                {
                    window.location.href = "<?php echo base_url(); ?>sales/waiting_for_packing_slip/";
                }
                else
                {
                    var htm ='<div class="invalid alert alert-danger">';
                    htm += 'Something wrong! Try again.';
                    htm +='</div>';
                    $('.adi_info_block').html(htm);
                    $('.invalid').slideUp(4000);
                }
            }
        });
    }
});

$(document).on("click","#select_all", function (e) {
    if(this.checked) {
      $(':checkbox').each(function() {
          this.checked = true;
      });
    }
    else {
      $(':checkbox').each(function() {
          this.checked = false;
      });
    }
});



$(document).on("click",".create_schedule_submit_button", function (e) {
    e.preventDefault();
    $.ajax({
        url: '<?php echo base_url(); ?>sales/create_delivery_schedule',
        type: 'POST',
        data: $('#schedule_order_form').serialize(),
        success: function (data) {
            if(data == true)
            {
                window.location.href = "<?php echo base_url(); ?>sales/waiting_for_packing_slip/";
            }
            else
            {
                var htm ='<div class="invalid alert alert-danger">';
                htm += data;
                htm +='</div>';
                $('.adi_info_block').html(htm);
                $('.invalid').slideUp(4000);
            }
        }
    });
});
</script>

<style>
    .sg{
        border: 1px solid #b9def0;
        margin-bottom: 12px;
    }
    .sg_no {
  background: #f5f5f5 none repeat scroll 0 0;
  font-size: 14px;
  font-weight: bold;
  padding: 5px;
  text-align: center;
}
      .s_info {
  padding: 9px;
  text-align: left;
  font-size: 14px;
}
      .s_action {
        padding: 0 4px 8px;
        text-align: right;
      }
</style>