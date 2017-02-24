<div class="panel panel-default">
    <div class="panel-heading " style="overflow: hidden;">My Approved List</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="approved_list">
            <thead>
                <tr>
                    <?php echo generate_specefic_list_view($approval_list,"title"); ?>  
                </tr>
            </thead>
            <tbody class="show_search_data">
                <?php echo generate_specefic_list_view($approval_list,"value"); ?>
            </tbody>
        </table>
    </div>
</div>


<script>
$(document).ready(function(){
    $('#approved_list').DataTable();
});
</script>