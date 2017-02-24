<?php       
$user_form_action = 'master/edit_profile';
    foreach($user_record as $user_data_record){
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
        $identification_type_id = $user_data_record['identification_type_id'];
        $identification_number = $user_data_record['identification_number'];
        $date_of_birth = $user_data_record['date_of_birth'];
        $gender = $user_data_record['gender'];
        $religion_id = $user_data_record['religion_id'];
        $father_name = $user_data_record['father_name'];
        $mother_name = $user_data_record['mother_name'];
        $bank_account_number = $user_data_record['bank_account_number'];
        @$bank_id = $user_data_record['bank_id'];
        $bank_branch = $user_data_record['bank_branch'];
        $last_login_date_time = $user_data_record['last_login_date_time'];
    }
?>
<script>
//$(function() {
//    $("#bank").change(function(){
//        //alert("Your book is overdue.");
//        var user_id = $(this).attr('user_id');
//        var site_url = $(this).attr('url');
//        var id = $('#bank option:selected').val();
//        var full_url = site_url+'d360_user/get_bank_branch/'+user_id;
//        $.ajax({
//            url: full_url,
//            data: {bank_id:id},
//            type: 'post',
//            dataType: "html",
//            success: function(data){
//                //alert(data);
//                $('#branch').html(data);
//            }
//        });
//    });
//    

window.onload = function () {
    document.getElementById("password1").onchange = validatePassword;
    document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password1").value;
if(pass1!=pass2)
    document.getElementById("password2").setCustomValidity("Passwords Didn't Match");
else
    document.getElementById("password2").setCustomValidity('');  
//empty string means no validation error
}

</script>
<div class="row col-lg-12 col-lg-offset-0">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">USER INFORMATION</a></li>
        <li><a data-toggle="tab" href="#sectionB">PERSONAL INFORMATION</a></li>
        <li><a data-toggle="tab" href="#sectionC">BANKING INFORMATION</a></li>
    </ul>
    <div class="tab-content">
        <!---------------------------------------User Information--------------------------------------------------->
        <div id="sectionA" class="tab-pane fade in active">
            <form action="<?php echo base_url($user_form_action);?>" method="post">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>User Name</label>
                            <input class="form-control" type="text" name="username" value="<?php echo @$username; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" id="password1" type="password" name="" value="">
                        </div>
                        <div class="form-group">
                            <label>Retype Password</label>
                            <input class="form-control" id="password2" type="password" name="password" value="">
                        </div>
                        <br>
                        <Input type="submit" value="Save" name="user_submit" class="btn btn-primary">
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Secret Question 1</label>
                            <input class="form-control" type="text" name="secret_question_1" value="<?php echo @$secret_question_1; ?>">
                        </div>
                        <div class="form-group">
                            <label>Secret Answer 1</label>
                            <input class="form-control" type="text" name="secret_question_ans_1" value="<?php echo @$secret_question_ans_1; ?>">
                        </div>
                        <div>&nbsp;<br/></div>
                        <div class="form-group">
                            <label>Secret Question 2</label>
                            <input class="form-control" type="text" name="secret_question_2" value="<?php echo @$secret_question_2; ?>">
                        </div>
                        <div class="form-group">
                            <label>Secret Answer 2</label>
                            <input class="form-control" type="text" name="secret_question_ans_2" value="<?php echo @$secret_question_ans_2; ?>">
                        </div>
                    </div>
                </div>
            <!-- /.row (nested) -->
            </form>
        </div>
        <!----------------------------------------Personal Information---------------------------------------------->
        <div id="sectionB" class="tab-pane fade">
            <form action="<?php echo base_url($user_form_action);?>" method="post">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <img style="width: 100%; border: 10px solid #aaa; border-radius: 5px" src="<?php echo base_url().''.$this->session->userdata('USER_IMAGE'); ?>">
                    </div>
                    <div class="form-group">
                        <?php file_browse(); ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" name="first_name" value="<?=@$first_name?>">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" name="last_name" value="<?=@$last_name?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="date_of_birth" value="<?=@$date_of_birth?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?=@$email?>">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input class="form-control" type="text" name="contact_number" value="<?=@$contact_number?>">
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
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Father's Name</label>
                        <input class="form-control" type="text" name="father_name" value="<?=@$father_name?>">
                    </div>
                    <div class="form-group">
                        <label>Mother's Name</label>
                        <input class="form-control" type="text" name="mother_name" value="<?=@$mother_name?>">
                    </div>
                    <div class="form-group">
                        <label>Religious view</label>
                        <?php religion(@$religion_id); ?>
                    </div>
                    <div class="form-group">
                        <label>Identification Type</label>
                        <?php identification_type(@$identification_type_id); ?>
                    </div>
                    <div class="form-group">
                        <label>Identification Number</label>
                        <input class="form-control" type="text" name="identification_number" value="<?php echo $identification_number; ?>">
                    </div>
                    <br>
                    <Input type="submit" value="Save" name="personal_submit" class="btn btn-primary">
                    <button type="reset" class="btn btn-primary">Reset</button>
                </div>
            </form>
        </div>
        <!----------------------------------------Banking Information---------------------------------------------->
        <div id="sectionC" class="tab-pane fade">
            <form action="<?php echo base_url($user_form_action);?>" method="post">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Bank Name</label>
                        
                        <?php bank($bank_id);?>
                    </div>
                    <div class="form-group">
                        <label>Bank Branch</label>
<!--                        <select id="branch" class="form-control" name="bank_branch"></select>-->
                        <input class="form-control" type="text" name="bank_branch" value="<?=@$bank_branch?>">
                    </div>
                    <div class="form-group">
                        <label>Bank Account Number</label>
                        <input class="form-control" type="text" name="bank_account_number" value="<?=@$bank_account_number?>">
                    </div>
                    <Input type="submit" value="Save" name="bank_submit" class="btn btn-primary">
                    <button type="reset" class="btn btn-primary">Reset</button>
                </div>
            </form>
        </div>
    </div>