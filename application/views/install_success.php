
<div class="jumbotron text-center">
    <h2>Congratulation! Project Installation is Complete</h2>
    <button class="btn btn-primary" id="delete_folder">Delete Installation Directory</button>
</div>
<script>
    $('#delete_folder').click(function(){
        var elem = $(this);
        $.ajax({
            url:'<?php echo base_url('home/delete_intallation_directory'); ?>',
            success:function(data){
                elem.text('Delete Succefully');
                elem.attr('disabled','disabled');
                $('.jumbotron').append(data);
            }
        });       
    });
</script>