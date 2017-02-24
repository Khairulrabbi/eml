<div class="panel panel-default">
    <div class="panel-heading " style="overflow: hidden;">My Approved List</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="approved_list">
            <thead>
                <tr>
                    <th>Ref No</th>
                    <th>Created Date</th>
                    <th>Approve By</th>
                    <th>Comment</th>
                    <th>Reliever Of</th>
                    <th>Action Type</th>
                    <th>Delegation Start</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($approval_list as $k=>$v){?>
                    <td><?php echo $v['ref_no']; ?></td>
                    <td><?php echo date("Y-m-d",strtotime($v['created']));?></td>
                    <td><?php echo $v['username']; ?></td>
                    <td><?php echo $v['comment']; ?></td>
                    <td><?php echo $v['reliever_of']; ?></td>
                    <td><?php echo $v['action_type']; ?></td>
                    <td><?php echo date("Y-m-d",  strtotime($v['delegation_start'])) ; ?></td>
                   
                    
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
$(document).ready(function(){
    $('#approved_list').DataTable();
});
</script>