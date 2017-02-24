<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->model('user_model','','TRUE');  
    $this->load->model('customer_model');
    }
/*-----------------------------------------------------------------------------------------*/
    public function get_customer_list(){
         $data['table_data'] = $this->customer_model->get_customer_list();
          $data['title'] = 'Customer List';
          $this->render_page('customer',$data);
          //$this->load->view('customer', $data);
    }
  
    public function add_customer($customer_id = NULL){
       $data['title'] = "Add a new Customer";
       if(isset($customer_id)){
          $data['customer_data']= $this->customer_model->get_customer_info($customer_id); 
          $data['customer_address'] = $this->customer_model->get_address($customer_id);
       }
       
//       print_r($data);
//       exit();
        $this->render_page('add_customer_form',$data);
    }
    
    public function save_customer_info(){
        $data = $this->input->post();
        $data_return = $this->unset_data($data);
        $customer_id =  $this->customer_model->save_data($data_return,'customer');
        $customer_info = $this->customer_model->get_customer_info($customer_id);
        echo json_encode($customer_info); 
    }
    
    public function update_customer_info(){
        $data = $this->input->post();
        $customer_id = $this->input->post('customer_id');
        $data_return = $this->unset_data($data);
        $where = array(
            'customer_id' =>$customer_id
        );
        $this->customer_model->update_data($data_return,'customer',$where);
        $customer_info = $this->customer_model->get_customer_info($customer_id);
        echo json_encode($customer_info); 
    }
    
    public function save_addredd(){
        $data = $this->input->post();
        $customer_id = $this->input->post('customer_id');
        $data_return = $this->unset_data($data);
        $this->customer_model->save_data($data_return,'customer_address');
        $data['address_value'] = $this->customer_model->get_address($customer_id);
        echo $this->load->view('ajax_customer_address',$data);
    }
    
    public function get_edit_address(){
        $address_table_id = $this->input->post('address_table_id');
        $edit_address = $this->customer_model->get_edit_address($address_table_id);
        
        echo json_encode($edit_address); 
    }
    
    public function update_edit_address(){
        $address_table_id = $this->input->post('address_table_id');
        $customer_address_title = $this->input->post('customer_address_title');
        $address_details = $this->input->post('address_details');
        $customer_id = $this->input->post('customer_id');
        $update_data = array(
            'customer_address_title' =>$customer_address_title,
            'address_details' => $address_details
        );
        $where = array(
            'customer_address_id' =>$address_table_id
        );
        
        $this->customer_model->update_data($update_data,'customer_address',$where);
        
        $data['address_value'] = $this->customer_model->get_address($customer_id);
        echo $this->load->view('ajax_customer_address',$data);
    }

    public function delete_address(){
        $address_table_id= $this->input->post('address_table_id');
        
        $this->db->where("customer_address_id", $address_table_id);
        $this->db->delete("customer_address");
        echo 1;
    }

    public function unset_data($data) {

        
        foreach ($data as $key=>$value){
            if(!$data[$key]){
                unset($data[$key]);
            }
            
        }
        if($this->input->post('currency_id')){
            $data['currency_id'] = implode(",",$this->input->post('currency_id'));
        }
        return $data;
    }
}
