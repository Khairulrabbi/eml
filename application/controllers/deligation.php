<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deligation extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('common_model');
        $this->load->model('deligation_model');
        $this->load->library('form_validation');
    }
    
    public function approval_privilege()
    {
        $breadcrumb_url = array(
                array("url"=>  base_url(),"title"=>"Home"),
                array("url"=>  base_url(),"title"=>"Link")
            );
        $where =array();
        $data['title'] = 'Approval Privilege';
        $data['user_list'] = $this->deligation_model->userlist($where);
        $data['breadcrumb'] = $breadcrumb_url;
        $this->render_page('deligation/approval_privilege', $data);
       
    }
    
    

    public function defined_hierarchy()
    {
        $data['title'] = 'Pre Define Hierarchy';
        $data['approval_persons'] = $this->deligation_model->get_approval_persons();
        $this->render_page('deligation/define_hierarchy', $data);
    }
    
    public function approval_persons_for_heirarchy()
    {
        $approve_for_id = $_POST['approve_for_id'];
        $data['approval_persons'] = $this->deligation_model->get_approval_persons($approve_for_id);
        $this->load->view('deligation/define_hierarchy_approval_person_list',$data);
    }
    
    public function common_info_approval_persons()
    {
        $approve_for_id = $_POST['approve_for_id'];
        $data['approval_persons_info'] = $this->deligation_model->get_common_info_approval_persons($approve_for_id);
        $this->load->view('deligation/define_hierarchy_approval_person_info',$data);
        //exit();
    }
    
    public function delete_step_number()
    {
        $approve_for_id = $_POST['approve_for_id'];
        $stepNumber = $_POST['stepNumber'];
        $this->db->where("approve_for_id",$approve_for_id);
        $this->db->where("step_number",$stepNumber);
        $this->db->delete("delegation_hierarchy");
    }
    
    public function delete_user_id()
    {
        $approve_for_id = $_POST['approve_for_id'];
        $stepNumber = $_POST['stepNumber'];
        $userId = $_POST['userId'];
        $this->db->where("approve_for_id",$approve_for_id);
        $this->db->where("step_number",$stepNumber);
        $this->db->where("user_id",$userId);
        $this->db->delete("delegation_hierarchy");
    }

        public function open_modal_create_step()
    {
        $approve_for_id = $_POST['approve_for_id'];
        
        $data['approval_persons'] = $this->deligation_model->get_approval_persons($approve_for_id);
        $data['step_no'] = $this->deligation_model->get_step_no($approve_for_id);
        $data['approve_for_id'] = $approve_for_id;
        $data['action'] = 'insert';
        $this->load->view('deligation/define_hierarchy_approval_person_info_modal',$data);
    }
    
    public function open_modal_edit_step()
    {
        $step_no = $_POST['step_no'];
        $approve_for_id = $_POST['approve_for_id'];
        
        $data['approval_persons'] = $this->deligation_model->get_approval_persons($approve_for_id);
        $data['step_no_persons'] = $this->deligation_model->get_approval_persons($approve_for_id,$step_no);
        $data['step_info'] = $this->deligation_model->get_step_info($approve_for_id,$step_no);
        $data['step_no'] = $step_no;
        $data['approve_for_id'] = $approve_for_id;
        $data['action'] = 'edit';
        $this->load->view('deligation/define_hierarchy_approval_person_info_modal',$data);
    }

    public function heirarchy_tree()
    {
        $approve_for_id = $_POST['approve_for_id'];
        $data['heirarchy_query'] = $this->deligation_model->heirarchy_query($approve_for_id);
        $this->load->view('deligation/heirarchy_tree',$data);
    }

        public function approval_persons()
    {
        $check_users = $_POST['check_value'];
        $get_check_users = $this->deligation_model->get_check_users($check_users);
        $html = "";
        $sl = 1;
        foreach ($get_check_users->result() as $k=>$v)
        {
            $html .="<tr>";
            $html .= "<td class='cl_serial'>".$sl."</td>";
            $html .= "<td><input class='existing_user' type='hidden' name='approve_user[]' value='".$v->user_id."'>".$v->username."</td>";
            $html .= "<td><input type='text' value='' name='max_limit[$v->user_id]'></td>";
            $html .= "<td><input type='checkbox' value='1' name='limit_type[$v->user_id]'></td>";
            $html .= "<td>";
            $html .= "<a class='ex_u_remove' user_id='".$v->user_id."' flag='new' href=''>";
            $html .= "<i class='fa fa-remove btn btn-danger'></i></td>";
            $html .= "</a>";
            $html .= "</tr>";
            $sl++;
        }
        echo $html;
    }
    
    
    public function save_approve_for()
    {
        $post = $this->input->post();
        //$this->db->where('approve_for_id', $post["approve_for_id"]);
        //$this->db->delete('privilege_for_approval'); 
        
        foreach ($post["approve_user"] as $v)
        {
            $limit_type = "Maximum";
            if(@$post['limit_type'][$v])
            {
                $limit_type = "Above";
            }
          $data_insert = array(
              "userid"=>$v,
              "approve_for_id"=>$post["approve_for_id"],
              "max_limit"=>$post['max_limit'][$v],
              "limit_type"=>$limit_type
          );
          $this->db->insert("privilege_for_approval",$data_insert);
        }
        
    }
    
    
    public function remove_existing_user($user_id)
    {
        $this->db->where("userid",$user_id);
        $result = $this->db->delete("privilege_for_approval");
        if($result)
        {
            echo TRUE;
        }
    }

    public function save_hirarchy_define()
    {
        $post = $this->input->post();
        //debug($post,1);
        $stepAction = $post['obj'][0]['stepAction'];
        $approve_for_id = $post['obj'][0]['approve_for_id'];
        $step_number = $post['obj'][0]['step_number'];
        if($stepAction == "insert")
        {
            foreach ($post['obj'] as $k=>$v)
            {
                unset($v['stepAction']);
                if($v['approve_priority'] == "")
                {
                    $v['approve_priority']="All";
                }
                if($v['same_sort'] == "")
                {
                    unset($v['same_sort']);
                    $v['created_by'] = $this->session->userdata('USER_ID');
                    $this->db->insert("delegation_hierarchy",$v);
                }
                else
                {
                    unset($v['same_sort']);
                    unset($v['sort_number']);
                    $v['created_by'] = $this->session->userdata('USER_ID');
                    $v['sort_number'] = 1;
                    $this->db->insert("delegation_hierarchy",$v);
                }

            }
        }
        else
        {
            $this->db->where("approve_for_id",$approve_for_id);
            $this->db->where("step_number",$step_number);
            $this->db->delete("delegation_hierarchy");

            foreach ($post['obj'] as $k=>$v)
            {
                unset($v['stepAction']);
                if($v['approve_priority'] == "")
                {
                    $v['approve_priority']="All";
                }
                if($v['same_sort'] == "")
                {
                    unset($v['same_sort']);
                    $v['created_by'] = $this->session->userdata('USER_ID');
                    $this->db->insert("delegation_hierarchy",$v);
                }
                else
                {
                    unset($v['same_sort']);
                    unset($v['sort_number']);
                    $v['created_by'] = $this->session->userdata('USER_ID');
                    $v['sort_number'] = 1;
                    $this->db->insert("delegation_hierarchy",$v);
                }

            }
        }
        
        
        echo TRUE;
    }
    public function get_current_list_by_approve_for_id(){
        $af_id = $this->input->post('approve_for_id');
        $data['approve_for'] = $this->deligation_model->get_current_list_by_approve_for_id($af_id);
        $this->load->view("deligation/current_list_view_by_approve_for_id",$data);
    }
    
    public function search_user_list(){
        $post = $this->input->post();
        $where =array();
            foreach ($post as $key=>$val){
                $wkey = "u.".$key;
                if($key == "user_level_id")
                {
                    $wkey = "ul.".$key;
                }
                if($key == "user_department_id")
                {
                    $wkey = "u.user_id";
                }
                if($key == "user_designation_id")
                {
                    $wkey = "u.user_id";
                }
                if($val != "")
                {
                    $where[$wkey] = $post[$key];
                }                    
            }             
//        echo '<pre>';
//        print_r($post);
//        exit();
        $data['search_data'] = $this->deligation_model->userlist($where);
        //debug($this->db->last_query(),1);
        $this->load->view("deligation/search_user_list_view",$data);
    } 
}
