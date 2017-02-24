
<div class="panel panel-default">
    <div class="panel-heading " style="overflow: hidden;">Waiting Approval List</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="approved_list">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select_all">&nbsp;&nbsp;<?php echo label_html(SL, 'SL'); ?></th>
                    <th>Payment Code</th>
                </tr>
            </thead>
            <tbody class="show_search_data">
                <?php $i = 1;
                foreach ($sql as $key => $value) { ?>
                    <tr>
                        <td>
                            <input class="select_one" type="checkbox" name="" value="">&nbsp;&nbsp;
                            <?php echo $i++;?> 
                        </td>
                        <td 
                            payment_approval_note_id="<?php echo $value['payment_approval_note_id']; ?>"
                            class="action_for_approve" 
                            style="cursor: pointer; color: #00f; text-decoration: underline;">
                            <?php echo $value['payment_approval_code'] ?>
                        </td>
                        
                    </tr>    
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


        <!-- payment preview modal -->
	<div id="add_product_m" class="modal fade " role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal" style="width: 980px;">
                <!-- Modal content-->
                <div class="modal-content" style="overflow:hidden; padding-bottom:15px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Approve Approval Note</h3>
                    </div>
                    <div class="comment_block"></div>
                    <div class="modal-body show_payment_approval_preview" style="overflow: hidden">
                        
                    </div>
                        <div class="col-lg-12">
                            <h3>Comments</h3>
                        </div>
                        <div class="col-lg-12">
                            <textarea class="approve_comment" style="width: 50%;"></textarea>
                        </div>
                        <div class="col-lg-12 text-right">
                            <span class="approve_submit btn btn-primary">Approve</span>
                        </div>
                </div>

            </div>
        </div>

<script>
    $(document).on("click",".approve_submit", function (e) {
        e.preventDefault();
        var comments = $('.approve_comment').val();
        var ref_id = $('.payment_approval_hid_code').val();
        if(comments)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/approve_delegation_action',
                type: 'POST',
                data: {ref_id:ref_id,comments:comments},
                success: function (data) {
                   if(data == true)
                   {
                       window.location.href = "<?php echo base_url(); ?>common_controller/waiting_approval_list/approval_payment";
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



    $(document).ready(function(){
        $('#approved_list').DataTable();
    });
    
    $(document).on("click",".action_for_approve", function () {
        //var payment_approval_hid_code = $('.payment_approval_hid_code').val();
        var payment_approval_note_id = $(this).attr("payment_approval_note_id");
        $.ajax({
            url: '<?php  echo base_url(); ?>common_controller/approve_payment_approval_note',
            type: 'POST',
            data: {payment_approval_note_id:payment_approval_note_id},
            success: function (data) {
                $('#add_product_m').modal("show");
                $('.show_payment_approval_preview').html(data);
            }
        });
    });

</script>