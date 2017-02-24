<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticket extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('ticket_model');
        $this->load->model('common_model');
        $this->load->model('sales_model');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function new_token($token_id = NULL) 
    {
        $data['product_info_name'] = $this->ticket_model->product_info_for_autocomplete_token();
        
        $this->form_validation->set_rules("token_code","Token Code","required");
        $this->form_validation->set_rules("customer_name","Customer Name","required");
        $this->form_validation->set_rules("customer_mobile","Customer Mobile","required");
        $this->form_validation->set_rules("product_name","Product Name","required");
        $this->form_validation->set_rules("problem_details","Problem Details","required");        
        $data['action'] = base_url().'ticket/new_token/'.$token_id;
        if($this->form_validation->run() == FALSE)
        {
            if($token_id == NULL)
            {
                $data['token_code'] = $this->common_model->get_code_number('token');
            }
            else
            {
                $data['token_info'] = $this->ticket_model->token_info($token_id);
            }
            $data['title'] = "Create New Token.";
            $this->render_page('ticket/token_form', $data);
        }
        else
        {
            $token_info = $this->input->post();
            $token_id = $token_info['token_id'];
            
            unset($token_info['token_id']);
            if($token_id)
            {
                unset($token_info['token_code']);
                $this->db->where('token_id',$token_id);
                $this->db->update('token',$token_info);
                redirect(base_url()."ticket/token_list");
            }
            else
            {
                $this->db->insert('token',$token_info);
                redirect(base_url()."ticket/token_list");
            }
        }
    }
    
    public function token_to_ticket($token_id)
    {
        $data['ticket_info'] = $this->ticket_model->token_info_for_token_to_ticket($token_id);
        $data['ticket_code'] = $this->common_model->get_code_number('ticket');
        $data['serial_number'] = $this->common_model->get_serial_number('ticket');
        $this->render_page('ticket/ticket_form', $data);
    }

    

    public function token_list()
    {
        //$data['columns'] = array("#SL_no","token_code","date","sales_code","sales_person","customer_name","customer_mobile","product_name","product_code","token_status","Action");
        $data['table_data'] = $this->ticket_model->get_token_list();
        //$data['action'] = array("common"=>FALSE,"edit"=>"ticket/new_token/","view"=>FALSE,"delete"=>FALSE);
        $this->render_page('ticket/token_list', $data);
    }

        public function auto_complete_sales_info_for_token()
    {
        $sales_code = $_POST['sales_code'];
        $this->db->select("c.customer_name,c.mobile_number,c.address");
        $this->db->from("sales_order s");
        $this->db->join("customer c","c.customer_id=s.customer_id","left");
        $this->db->where("s.sales_id",$sales_code);
        $rows = $this->db->get()->row();
        echo json_encode($rows);
    }
    
    public function auto_complete_sales_info_for_token2()
    {
        $product_code = $_POST['product_code'];
        $this->db->select("c.customer_name,c.mobile_number,c.address,p.product_name,ps.sale_order_id");
        $this->db->from("product_stock_manager ps");
        $this->db->join("product p","p.product_id=ps.product_id","left");
        $this->db->join("sales_order s","s.sales_id=ps.sale_order_id","left");
        $this->db->join("customer c","c.customer_id=s.customer_id","left");
        $this->db->where("ps.product_code",$product_code);
        $rows = $this->db->get()->row();
        echo json_encode($rows);
    }
    public function sales_info_view_for_token_create()
    {
        $field_type = $_POST['field_type'];
        $order_id = NULL;
        if($field_type == "code")
        {
            $product_code = $_POST['product_code'];
            $oid = $this->db->query("SELECT sale_order_id FROM product_stock_manager WHERE product_code='".$product_code."'")->row();
            $order_id = $oid->sale_order_id;
            $data['selected_product'] = $this->ticket_model->get_ordered_product_info($order_id,$product_code);
        }
        else if($field_type == "sales_id")
        {
            $order_id = $_POST['sales_code'];
            $data['selected_product'] = $this->ticket_model->get_ordered_product_info($order_id);
        }
        
        $data['order_info'] = $this->sales_model->get_order_info($order_id);
              
        echo $this->load->view("ticket/product_warranty_info",$data);                      
    }
    
    
    public function create_ticket_submit()
    {
        $ticket_id = $this->input->post('ticket_id');
        if($ticket_id == '')
        {
            $this->form_validation->set_rules('ticket_code','Ticket Code','trim|required|is_unique[ticket.ticket_code]');
            $this->form_validation->set_rules('serial_number','Serial Number','trim|required|is_unique[ticket.serial_number]');
        }        
        $this->form_validation->set_rules('product_name','Product Name','trim|required');
        $this->form_validation->set_rules('customer_address','Customer Address','trim|required');
        $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
        $this->form_validation->set_rules('customer_mobile','Mobile Number','trim|required');
        $this->form_validation->set_rules('problem_details','Problem Details','trim|required');
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $post_data = $this->input->post();
            if($post_data['customer_warranty_start'] == NULL)
            {
                unset($post_data['customer_warranty_start']);
            }
            if($post_data['customer_warranty_end'] == NULL)
            {
                unset($post_data['customer_warranty_end']);
            }
            if($post_data['warranty_start'] == NULL)
            {
                unset($post_data['warranty_start']);
            }
            if($post_data['warranty_end'] == NULL)
            {
                unset($post_data['warranty_end']);
            }
            if($post_data['token_id'] == NULL)
            {
                unset($post_data['token_id']);
            }
            if($post_data['product_id'] == NULL)
            {
                unset($post_data['product_id']);
            }
            if($post_data['warranty_left'] == '')
            {
                unset($post_data['warranty_left']);
            }
            if($post_data['customer_warranty_left'] == '')
            {
                unset($post_data['customer_warranty_left']);
            }
            if($ticket_id)
            {
                unset($post_data['ticket_id']);
                unset($post_data['ticket_code']);
                unset($post_data['serial_number']);
                
                $post_data['updated_by'] = $this->session->userdata('USER_ID');
                
                $this->db->where('ticket_id',$ticket_id);
                $this->db->update('ticket',$post_data);
                echo TRUE;
            }
            else
            {
                unset($post_data['ticket_id']);
                $post_data['created_by'] = $this->session->userdata('USER_ID');
                $post_data['service_status'] = 29;
                
                $this->db->insert('ticket',$post_data);
                if($_POST['token_id'])
                {
                    $this->db->where('token_id',$_POST['token_id']);
                    $this->db->update('token',array('token_status'=>1));
                }
                echo TRUE;
            }            
        }        
    }

    



    public function new_ticket($ticket_id = NULL) 
    {
        if($ticket_id)
        {
            $data['ticket_info'] = $this->ticket_model->get_ticket_info($ticket_id);
            $data['ticket_code'] = $data['ticket_info']->ticket_code;
            $data['serial_number'] = $data['ticket_info']->serial_number;            
        }
        else
        {
            $data['ticket_code'] = $this->common_model->get_code_number('ticket');
            $data['serial_number'] = $this->common_model->get_serial_number('ticket');
        }
        //$data['title'] = "Search Product or Order no.";
        $this->render_page('ticket/ticket_form', $data);
    }

    public function ticket_details($ticket_id = NULL) {

        //$order_info = $this->purchase_model->get_order_info($order_id);
        $data['ticket_info'] = $this->ticket_model->get_ticket_info($ticket_id);
        $data['primary_observation_info'] = $this->ticket_model->get_primary_observation_info($ticket_id);
        //echo $this->db->last_query();
        //exit();
        $data['title'] = 'Ticket Details';
        //$data['primary_observation'] = $this->load->view('ticket/primary_observation');
        $this->render_page('ticket/ticket_detais', $data);
        //$this->load->view('customer', $data);
    }

    public function update_ticket($ticket_id = NULL) {
        $data = $this->input->post();
        $reset_data = $this->unset_data($data);
        $reset_data['warranty_status_id']=1;
        $where = array("ticket_id" => $ticket_id);
        $ticket_id = $this->ticket_model->update_data($reset_data, 'ticket', $where);

        redirect("ticket/new_ticket");
    }
    
    public function primary_observation_submit()
    {
        $this->form_validation->set_rules("ticket_id","Ticket Id","trim|required");
        $this->form_validation->set_rules("observation_type","Observation Type","trim|required");
        $this->form_validation->set_rules("comments","Comments","trim|required");
        
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $post_data = $this->input->post();
            $primary_observation_id = $this->input->post('primary_observation_id');
            $assign = $this->input->post('servicing_engineer_list');
            $status = NULL;
            if(($post_data['observation_type'] == 1) || ($post_data['observation_type'] == 2) || ($post_data['observation_type'] == 5))
            {
                $status = 32;
            }
            else if($post_data['observation_type'] == 3)
            {
                $status = 30;
            }
            else if($post_data['observation_type'] == 4)
            {
                $status = 31;
            }
            
            //debug($post_data,1);
            unset($post_data['primary_observation_id']);
            unset($post_data['servicing_engineer_list']);
            if($primary_observation_id != '')
            {                
                $this->db->where('primary_observation_id',$primary_observation_id);
                $this->db->update('primary_observation',$post_data);
                
                $this->db->where('ticket_id',$post_data['ticket_id']);
                $this->db->update('ticket',array('service_status'=>$status,'assign'=>($assign)?$assign:NULL));
                echo TRUE;
            }
            else
            {
                $this->db->insert('primary_observation',$post_data);
                $poi = $this->db->insert_id();
                
                $this->db->where('ticket_id',$post_data['ticket_id']);
                $this->db->update('ticket',array('service_status'=>$status,'primary_observation_id'=>$poi,'assign'=>($assign)?$assign:NULL));
                echo TRUE;
            }
        }        
    }

    public function get_code() {
        return rand();
    }

    public function get_sub_category() {
        $category_id = $this->input->post("category_id");
        echo sub_category_list(null, array('class' => 'sub_category_id', 'required' => 'required'), 'product_subcategory_name', array("product_category_id" => $category_id));
    }

    public function check_order_details() {
        $order_id = $this->input->post("order_id");
        $query = $this->db->query("SELECT * FROM purchase_order_details where purchase_order_id= $order_id");
        echo $query->num_rows();
    }

    public function unset_data($data) {
        //echo "<pre>";
        //print_r($data);
        //exit();
        unset($data['save']);
        unset($data['product_category_id']);
        unset($data['product_brand_id']);
        unset($data['product_category_id']);
        unset($data['product_subcategory_id']);
        unset($data['product_subcategory_name']);
        unset($data['confirm']);
        unset($data['product_name']);

        foreach ($data as $key => $value) {
            if (!$data[$key]) {
                unset($data[$key]);
            }
        }
        return $data;
    }
		/*
     * A function to view ticket details list
     * Created by Charlie 03-May-16
     * assigned by Atik vai
     */ 
    
     public function ticket_history(){
        $data['table_data'] = $this->ticket_model->get_all_ticket_history();
        $data['title'] = 'Ticket History';
        $this->render_page('ticket/ticket_history',$data);
     }
    
//     public function update_assign_user()
//     {
//         $ticket_id = $_POST['ticket_id'];
//         $user_id = $_POST['user_id'];
//         $where = array('ticket_id'=>$ticket_id);
//         $this->ticket_model->update_data(array('assign'=>(($user_id)?$user_id:NULL)),'ticket',$where);
//     }

          public function call_log()
    {
        $data['table_data'] = $this->ticket_model->get_all_sales_product();// its now just static..it will be changed later
        $data['title'] ='Product Search Panel';
        $this->render_page('ticket/call_log',$data);         
     }

}
