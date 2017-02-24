
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width: 17%">From</th>
                    <th style="width: 23%">Subject</th>
                    <th style="width: 60%">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(empty($notification_list)){
                    echo '<tr><td colspan="3"><div class="alert alert-warning">No nofication found!</div></td></tr>';
                }
                $sl = 0;
                foreach ($notification_list as $value) {
                    $sl++;
                    echo '<tr class="'.($value['status']=='Unread'?'strong':'').' not_row" data-div_id="details_'.$sl.'" data-user_id="'.$value['notify_to'].'" data-date_time="'.$value['created'].'">
                                    <td>'.$value['notification_from'].'<br/>'.$value['created'].'</td>
                                    <td>'.substr($value['subject'], 0, 30).'</td>
                                    <td>'.substr($value['details'], 0, 80).'
                                        <div class="alert alert-success details" id="details_'.$sl.'" style="display:none">'.$value['details'].'</div>
                                    </td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('.not_row').click(function(){
        var div_id = $(this).data('div_id');
        var show_state = $('#'+div_id).css('display');
        var user_id = $(this).data('user_id');
        var date_time = $(this).data('date_time');
        $(this).removeClass('strong');
        $('.details').hide();
        if (show_state == 'none') {
            $('#'+div_id).toggle(500);
        }
        $.ajax({
            url:'../master/update_notification',
            type:'post',
            data:{user_id:user_id,date_time:date_time},
            success:function(data){
                $('#count_notification').html(data);
            }
        });
    });
</script>
<style>
    .strong td{
        font-weight: bold;
    }
</style>
