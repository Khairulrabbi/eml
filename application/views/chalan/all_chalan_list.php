<div class="panel panel-default">
    <div class="panel-heading">
        <span class="">Chalan List (Waiting for delivery shedule)</span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $data["all_chalan_list"] = $all_chalan_list;
                    $data['sales_id_array'] = $sales_id_array;
                    $data['flag'] ='list';
                    $this->load->view("chalan/all_chalan_list_ajax_view",$data);
                ?>                
            </div>
        </div>
    </div>
</div>
        <div class="panel panel-default">
            <div class="panel-heading" style="overflow: hidden;">
                <span class="pull-left">Delivery Schedule List &nbsp;&nbsp;&nbsp;  <span style="font-size: 15px">(Drag and drop to rearrange the schedule)</span></span>
                <span class="pull-right btn btn-primary create_schedule_button" data-toggle="modal" schedule_id="" chalan_id="">Create Schedule</span>                
            </div>
            <div class="panel-body">
                
                <div class="row"></div>
                <div class="col-lg-12">
                    <br>
                </div>
                <div id="mydiv">
                    <table class="table" id="sort">
                        <thead>
                            <tr>
                                <th class="no_print"><input type="checkbox" id="select_all" name=""></th>
                                <th class="index">Sl#</th>
                                <th>Schedule Code</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1; foreach ($all_delivery_schedule_list as $valu){?>
                            <tr style="cursor: move" schedule_id="<?php echo $valu['delivery_schedule_id']; ?>">
                                <td class="no_print"><input class="confirm_check_box_value" type="checkbox" name="" value="<?php echo $valu['delivery_schedule_id']; ?>"></td>
                                <td class="index"><?php echo $sl;?></td>
                                <th><?php echo $valu['schedule_code'];?></th>
                                <th><?php echo $valu['schedule_time'];?></th>
                                <th><?php echo $valu['status_name'];?></th>
                                <th><?php echo $valu['address'];?></th>
                                <th>
                                    <span class="btn"><i class="glyphicon glyphicon-print"></i></span>
                                    <span 
                                        class="btn create_schedule_button" 
                                        data-toggle="modal" 
                                        schedule_id="<?php echo $valu['delivery_schedule_id']; ?>"
                                        chalan_id="<?php echo implode(',',json_decode($valu['chalan_id'])); ?>"><i class="glyphicon glyphicon-pencil"></i>
                                    </span>
                                </th>
                            </tr>
                            <?php $sl++;} ?>
                        </tbody>
                    </table>
                    <span class="btn btn-success confirm_check_box_button">Confirm</span>
                </div>
            </div>
        </div>
<script>
    
    $('#select_all').click(function(event) {
        if(this.checked) {
            // Iterate each checkbox
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
    
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);            
        });
        var p =($.map($(this).find('tr'), function(el) {
                return $(el).attr("schedule_id") + "_" + $(el).index();
            }));
            $.ajax({
                url: '<?php echo base_url(); ?>chalan/schedule_ordering',
                type: "POST",
                data: {order:p},
                success: function(feedback){
                    // $("#test").html(feedback);
                }
            });
    };

    $("#sort tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
</script>













































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
                    <input type="hidden" name="chalan_type" value="Sale">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="delivery_time">Delivery Date</label>  
                        <div class="col-md-3">
                            <input type="date" class="form-control delivery_time" id="delivery_time" name="delivery_time" value="" >
                        </div>
                        <label class="col-md-3 control-label" for="delivery_time">Delivery Time</label>  
                        <div class="col-md-3">
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
    var chalan_id = $(this).attr('chalan_id');
    $('.edit_schedule_id').val(schedule_id);  
    $(this).attr("data-target", "#create_schedule_button");
    //alert(schedule_id);
    $.ajax({
        url: '<?php echo base_url(); ?>chalan/order_list_for_create_schedule',
        type: 'POST',
        data: {schedule_id:schedule_id,chalan_id:chalan_id},
        success: function (data) {
            if(schedule_id)
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>chalan/selected_value_from_schedule_table',
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
                //alert("not");
                //$('#schedule_no').val("<?php //echo $schedule_code; ?>");
                $('#delivery_time').val("");
                $('#time').val("");
                $(".delivery_location").val("");
                $(".delivery_van").val("");
            }
           $('.show_sales_order').html(data);
           
        }
    });
});


//$(".delivery_confirm").click(function () {
$(".confirm_check_box_button").click(function () {
    var allVals = [];
    $('.confirm_check_box_value').each(function() {
        if($(this).is(':checked')) {
            allVals.push($(this).val());
         }
    });
    //var schedule_id = $(this).attr('schedule_id');
    if (confirm('Are you sure you want to confirm this? There is no undo.')) {
        $.ajax({
            url: '<?php echo base_url(); ?>chalan/delivery_confirm',
            type: 'POST',
            data: {allVals:allVals},
            success: function (data) {
                if(data == true)
                {
                    window.location.href = "<?php //echo base_url(); ?>chalan/all_chalan_list/";
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
        url: '<?php echo base_url(); ?>chalan/create_delivery_schedule',
        type: 'POST',
        data: $('#schedule_order_form').serialize(),
        success: function (data) {
            if(data == true)
            {
                window.location.href = "<?php echo base_url(); ?>chalan/all_chalan_list/";
            }
            else
            {
                var htm ='<div class="invalid alert alert-danger">';
                htm += data;
                htm +='</div>';
                $('.adi_info_block').html(htm);
                //$('.invalid').slideUp(4000);
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