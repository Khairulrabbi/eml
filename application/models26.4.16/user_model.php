<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    private $user_id;

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->user_id = $this->session->userdata('USER_ID');
    }

    function get_user_record($user_id){
        $this->db->select('
                        `user`.user_id,
                        `user`.first_name, `user`.last_name, `user`.email, `user`.contact_number, `user`.username, `user`.`password`,
                        `user`.secret_question_1, `user`.secret_question_2, `user`.secret_question_ans_1, `user`.secret_question_ans_2,
                        `user`.identification_type_id, `user`.identification_number, `user`.date_of_birth, `user`.gender, `user`.religion_id, `user`.father_name,
                        `user`.mother_name, `user`.bank_account_number, `user`.bank_branch_id, `user`.last_login_date_time, `user`.default_module_id
                            ');
        $this->db->from('`user`');
        $this->db->where('`user`.user_id',$user_id);
        

        //var_dump($this->db);
        $query = $this->db->get();
        //echo $this->db->last_query(); 
        return $query->result_array();
    }
}
