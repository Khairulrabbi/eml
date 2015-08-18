<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Custom_Controller {
        function __construct() {
        parent::__construct();
        //phpinfo();
        $this->load->helper('url','html','form');
        $this->load->model('user_model','','TRUE');
        $this->load->library('session','form_validation');
    }

    /*--------------=====================----------nirjhar------------========================--------------*/
    
    function image_upload($image_name, $upload_path){
                
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $config['max_size'] = '9999999KB';
        $config['max_width'] = '1048';
        $config['max_height'] = '768';
        $config['overwrite'] = 'TRUE';
        
        $upload_info = $this->file_upload($config); 
        
        return $directory = $upload_path.$upload_info['file_name'];
    }

/*----------------------------------------------------class end-------------------------------------------------*/

    function entry_form() {
        $data['user_record'] = $this->user_model->get_user_record($this->user_id);
        $this->render_page('user_profile',$data);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////	
	
//    function user_entry($menu_id){
//        $password = md5($this->input->post('password'));
//        $re_password = md5($this->input->post('re_password'));
//        
//        if($password == $re_password){
//            //$user_type = $this->input->post('user_type');
//            $username = $this->input->post('username');
//            $qes1 = $this->input->post('sec_ques_1');
//            $ans1 = $this->input->post('seq_ans_1');
//            $qes2 = $this->input->post('sec_ques_2');
//            $ans2 = $this->input->post('seq_ans_2');
//
//            $get_user_data = array('username' => $username, 
//                                    'password' => $password, 
//                                    'secret_question_1' => $qes1, 
//                                    'secret_question_2' => $qes2, 
//                                    'secret_question_ans_1' => $ans1, 
//                                    'secret_question_ans_2' => $ans2);
//            
//            $user_insert_id = $this->d360_user_model->user_entry_model($get_user_data);
//            
//            redirect('d360_user/entry_form/'.$user_insert_id, 'refresh');
//        }
//        else {
//            $this->entry_form($menu_id);
//        }
//    }
	
////////////////////////////////////////////////////////////////////////////////////////////////////


    function user_update($menu_id){
        $password = $this->input->post('password');
        $re_password = $this->input->post('re_password');
        
        $username = $this->input->post('username');
        $qes1 = $this->input->post('sec_ques_1');
        $ans1 = $this->input->post('seq_ans_1');
        $qes2 = $this->input->post('sec_ques_2');
        $ans2 = $this->input->post('seq_ans_2');
        $user_id = $this->input->post('user_id');

        if(!empty($password) && $password==$re_password){
            $pass = $password;
            $edit_user_data = array('username' => $username, 
                    'password' => md5($pass), 
                    'secret_question_1' => $qes1, 
                    'secret_question_2' => $qes2, 
                    'secret_question_ans_1' => $ans1, 
                    'secret_question_ans_2' => $ans2, 
                    'user_id' => $user_id,
                );
            $this->session->set_flashdata('feedback', '<div class="alert alert-danger alert-dismissable">​Update with New Password.</div>​');
        }
        else{
            $edit_user_data = array('username' => $username, 
                    'secret_question_1' => $qes1, 
                    'secret_question_2' => $qes2, 
                    'secret_question_ans_1' => $ans1, 
                    'secret_question_ans_2' => $ans2, 
                    'user_id' => $user_id,
                );
            $this->session->set_flashdata('feedback', '<div class="alert alert-danger alert-dismissable">​Update with Old/Previous Password</div>​');
        }
                        
        $this->db->where('user.user_id', $user_id);
        $this->db->update('user', $edit_user_data);

        redirect('d360_user/entry_form/');
    }
	
    function user_personal_entry(){
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $dob = $this->input->post('dob');
            $gender = $this->input->post('gender');
            $father_name = $this->input->post('father_name');
            $mother_name = $this->input->post('mother_name');
            $religion = $this->input->post('get_religion');
            $email = $this->input->post('email');
            $contact_number = $this->input->post('contact_number');
            $identification_type = $this->input->post('identification_type');
            $identification_number = $this->input->post('identification_number');
            $user_id = $this->input->post('user_id');
            
//            $image_name = $user_id.'_'.$first_name;
//            $upload_path = 'images/user/';
//            $image_field = $this->image_upload($image_name, $upload_path);
            
            $get_personal_data = array('first_name' => $first_name, 
                                    'last_name' => $last_name, 
                                    'date_of_birth' => $dob, 
                                    'email' => $email, 
                                    'contact_number' => $contact_number, 
                                    'gender' => $gender, 
                                    'father_name' => $father_name,
                                    'mother_name' => $mother_name, 
                                    'identification_number' => $identification_number
                                );
//            $sess['USER_IMAGE']= $image_field;
//            $this->session->set_userdata($sess);
            
            $this->db->where('user.user_id', $user_id);
            $this->db->update('user', $get_personal_data);
                
            //print_r($get_personal_data);

            redirect('user/entry_form/', 'refresh');
    }    
}