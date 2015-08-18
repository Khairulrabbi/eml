<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Import Data From Excel</strong>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 col-xs-12">
                    <fieldset>
                        <legend>Download Sample File</legend>
                        <form action="<?php echo base_url('master/download_sample'); ?>" method="post">
                            <div class="form-group">
                                <label>Select Master Entry</label>
                                <?php
                                master_entry_table('view_name',NULL,$view_name);
                                ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Download</button>
                        </form>
                    </fieldset>
                    <br/>
                    <fieldset>
                        <legend>Upload File</legend>
                        <form id="upload" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-warning btn-file">
                                            Browse&hellip; <input type="file" name="file">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Upload</button>
                        </form>
                        <div class="progress" style="margin-top: 15px;display: none;">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">Processing...</div>
                        </div>
                    </fieldset>
                    <br/>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="alert alert-danger">
                        <legend>Instruction</legend>
                        <ol>
                            <li>Download the sample file first.</li>
                            <li>Update the file with your data into relevant column.</li>
                            <li>Keep the header row remain unchanged.</li>
                            <li>Save and close the file.</li>
                            <li>Upload the saved file.</li>
                            <li>File size must be less than 10Mb.</li>
                            <li>Do not change the file extension.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
$('#upload').submit(function(e){
    $.ajax( {
      url: '<?php echo base_url('master/import_excel'); ?>',
      type: 'POST',
      data: new FormData( this ),
      beforeSend: function(){
          $('.progress').show();
                    },
      success:function(){
          $('.progress').html('Done').removeClass('progress').addClass('alert alert-success text-center');
      },
      processData: false,
      contentType: false
    } );
    e.preventDefault();
});

</script>