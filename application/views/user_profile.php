<?php 
    if(@$user_record == ''){ 
        echo "<style>.check_user{display:none !important;}.next_data{color:red;}</style>"; 
        $user_form_action = "d360_user/user_entry/";
    }
    else { 
        echo "<style>.check_user{}.next_data{}</style>";       
        foreach ($user_record as $user_data_record){
            $user_id = $user_data_record['user_id'];
            $first_name = $user_data_record['first_name'];
            $last_name = $user_data_record['last_name'];
            $email = $user_data_record['email'];
            $contact_number = $user_data_record['contact_number'];
            $username = $user_data_record['username'];
            $password = $user_data_record['password'];
            $secret_question_1 = $user_data_record['secret_question_1'];
            $secret_question_2 = $user_data_record['secret_question_2'];
            $secret_question_ans_1 = $user_data_record['secret_question_ans_1'];
            $secret_question_ans_2 = $user_data_record['secret_question_ans_2'];
            $date_of_birth = $user_data_record['date_of_birth'];
            $gender = $user_data_record['gender'];
            $father_name = $user_data_record['father_name'];
            $mother_name = $user_data_record['mother_name'];
            $identification_number = $user_data_record['identification_number'];

        } 
        $user_form_action = "d360_user/user_update/";
    }
?>
<script>
$(function() {
    $("#bank").change(function(){
        //alert("Your book is overdue.");
        var user_id = $(this).attr('user_id');
        var site_url = $(this).attr('url');
        var id = $('#bank option:selected').val();
        var full_url = site_url+'d360_user/get_bank_branch/'+user_id;
        //alert(full_url);
       //return false;
        $.ajax({
            url: full_url,
            data: {bank_id:id},
            type: 'post',
            dataType: "html",
            success: function(data){
                //alert(data);
                $('#branch').html(data);
            }
        });
    });
    
    $("#referral").keyup(function(){
        var site_url = $(this).attr('url');
        var value = $('#referral').val();
        var full_url = site_url+'d360_user/get_referral/';
        $.ajax({
            url: full_url,
            data: {referral_id : value },
            type: 'post',
            dataType: "html",
            success: function(data){
                //alert(data);
                $('#referral_name').html(data);
            }
        });
    });
    
});
</script>
<div class="row">
        <div class="col-lg-12">
<!----=========================================================================================---->

    <div class="panel-group" id="accordion">
<!---------------------------------------User Information---------------------------------------------------------->
 
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <span class="glyphicon glyphicon-hand-down"></span> User Information
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <form action="<?php echo base_url($user_form_action);?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input class="form-control" type="text" name="username" value="<?php echo @$username; ?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password" value="<?php echo @$password; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Retype Password</label>
                                        <input class="form-control" type="password" name="re_password" value="<?php echo @$password; ?>" required>
                                    </div>
                                    <br>
                                    <input type="hidden" value="<?php echo @$user_id; ?>" name="user_id">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Secret Question 1</label>
                                        <input class="form-control" type="text" name="sec_ques_1" value="<?php echo @$secret_question_1; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Secret Answer 1</label>
                                        <input class="form-control" type="text" name="seq_ans_1" value="<?php echo @$secret_question_ans_1; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Secret Question 2</label>
                                        <input class="form-control" type="text" name="sec_ques_2" value="<?php echo @$secret_question_2; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Secret Answer 2</label>
                                        <input class="form-control" type="text" name="seq_ans_2" value="<?php echo @$secret_question_ans_2; ?>">
                                    </div>
                                </div>
                            </div>
                        <!-- /.row (nested) -->
                        </form>
                </div>
            </div>
        </div>
<!----------------------------------------Personal Information--------------------------------------------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title next_data">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <span class="glyphicon glyphicon-hand-down"></span> Personal Information
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse check_user">
                <div class="panel-body">
                        <form action="<?=base_url();?>user/user_personal_entry" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" name="first_name" value="<?=@$first_name?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" name="last_name" value="<?=@$last_name?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="dob" value="<?=@$date_of_birth?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" value="<?=@$email?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input class="form-control" type="text" name="contact_number" value="<?=@$contact_number?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="optionsRadiosInline1" value="Male" <?php echo @$checked = ($gender == 'Male')?'Checked="Checked"':'';?>> Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="optionsRadiosInline2" value="Female"  <?php echo @$checked = ($gender == 'Female')?'Checked="Checked"':'';?>> Female
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Father's Name</label>
                                        <input class="form-control" type="text" name="father_name" value="<?=@$father_name?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mother's Name</label>
                                        <input class="form-control" type="text" name="mother_name" value="<?=@$mother_name?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Religious view</label>

                                    </div>
                                    <div class="form-group">
                                        <label>Identification Type</label>

                                    </div>
                                    <div class="form-group">
                                        <label>Identification Number</label>
                                        <input class="form-control" type="text" name="identification_number" value="<?=@$identification_number?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload your Photo</label>
                                        <?php file_browse('image_file', 'Upload to browse', "id='uploadImage'");?>
                                    </div>                                    
                                    <br>
                                    <input type="hidden" value="<?php echo @$user_id; ?>" name="user_id">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                </div>
                            </div>
                        <!-- /.row (nested) -->
                        </form>
                </div>
            </div>
        </div>
<!---------------------------------------End---------------------------------------------------------->
    </div>
<!----==========================================================================================--->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
    <script>
    $('.datepicker').datepicker()
    </script>
</body>
</html>
