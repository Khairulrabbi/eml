<?php
    if(label_change_permission())
    { ?>
        <script>
            $(document).on('dblclick','.label_class',function(e){
                e.preventDefault();
                var label_text = $(this).text();
                var label_slug = $(this).attr('id');
                $('.existing_label_name').attr('id',label_slug);
                $('.existing_label_name').val(label_text);
                $('#label_change_modal').modal('show');        
            });
        </script>
    <?php }
?>

<!-- Modal -->
<div id="label_change_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Label Name</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="" id="changeLabelForm" class="form-inline">
                <div class="form-group">
                    <label for="label_name">Label Name</label>
                    <input type="label_name" class="form-control existing_label_name" value="">
                </div>
                <button type="submit" class="btn btn-default change_button_submit">Submit</button>
            </form>
            <script>
                $('.change_button_submit').on('click',function(e){
                    e.preventDefault();
                    var label_slug = $('.existing_label_name').attr('id');
                    var label_text = $('.existing_label_name').val();                    
                    $.ajax({
                        url: '<?php echo base_url(); ?>common_controller/updateLabelText',
                        type: 'POST',
                        data: {label_slug:label_slug,label_text:label_text},
                        success: function (data) {
                            if(data == true)
                            {
                                $('#'+label_slug).text(label_text);
                                $('#label_change_modal').modal('hide');  
                            }
                            else
                            {
                                alert("Ooops! Somthing Wrong!!");
                            }
                        }
                    });

                });
            </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

  </div>
</div>