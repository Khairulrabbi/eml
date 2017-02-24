<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Primary Observation</h3>
            </div>            
            <div class="panel-body"> 
                <div class="text-center observation_block"></div>
                <form id="primary_observation_form" action="" method="post">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="product_code" class="col-lg-2 control-label">Observation Type <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="hidden" name="primary_observation_id" value="<?php echo @$primary_observation_info->primary_observation_id; ?>">
                                <input type="hidden" name="ticket_id" class="ticket_id" value="<?php echo $ticket_id; ?>">
                                <input <?php echo ((@$primary_observation_info->observation_type == 1)?'checked="checked"':''); ?> type="radio" name="observation_type" value="1"> Product Out of btrac 
                                <input <?php echo ((@$primary_observation_info->observation_type == 2)?'checked="checked"':''); ?> type="radio" name="observation_type" value="2"> Physical Damage 
                                <input <?php echo ((@$primary_observation_info->observation_type == 3)?'checked="checked"':''); ?> type="radio" name="observation_type" value="3"> Warranty available from supplier 
                                <input <?php echo ((@$primary_observation_info->observation_type == 4)?'checked="checked"':''); ?> type="radio" name="observation_type" value="4"> Warranty available from btrac  
                                <input <?php echo ((@$primary_observation_info->observation_type == 5)?'checked="checked"':''); ?> type="radio" name="observation_type" value="5"> No Warranty available
                            </div>
                        </div>
                    </div>
                    
                    <br/><br/>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Faulty Type</label>
                            <div class="col-lg-2">
                                <?php echo faulty_type(@$primary_observation_info->faulty_type, array('class' => 'faulty_type',''=>'')); ?>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Comments <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea class="form-control comments" name="comments"><?php echo @$primary_observation_info->comments; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <br/><br/>
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Assigned</label>
                            <div class="col-lg-2">
                                <?php echo servicing_engineer_list(@$userid, array('class' => 'servicing_engineer_list', '')); ?>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary eosubmit" name="eosubmit" value="submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div>

<script>
    $(document).on("click",".eosubmit", function (e) {
        e.preventDefault();
        var ticket_id = $('.ticket_id').val();
        $.ajax({
            url: '<?php echo base_url(); ?>ticket/primary_observation_submit',
            type: 'POST',
            data: $('#primary_observation_form').serialize(),
            success: function (data) {
                if(data == true)
                {
                    window.location.href = "<?php echo base_url(); ?>ticket/ticket_details/"+ticket_id;
                }
                else
                {
                    var htm ='<div class="alert alert-danger">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += data;
                    htm +='</div>';
                    $('.observation_block').html(htm);
                }
            }
        });
    });
</script>
