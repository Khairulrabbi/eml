<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Requisition extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('purchase_model');
        $this->load->model('requisition_model');
        $this->load->model('deligation_model');
        $this->load->model('common_model');
    }
    
    public function product_requisition($order_id=NULL)
    {
       
        if(isset($_GET['c']))
        {
            $data['cart_value'] = $_GET['c'];
            $data['table'] = 'region';
            $data['selected_product_group'] = $this->requisition_model->get_cart_product_list('region','region_name');
        }
        else
        {
            $data['table'] = 'region';
            if($order_id)
            {
                $data['selected_product_group'] = $this->requisition_model->get_selected_product_group($order_id,'region','region_name');
            }
        }
        
        $data['order_id'] = $order_id;
        $order_info = $this->requisition_model->get_requisition_info($order_id);
        //debug($order_info,1);
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("requisition/selected_product_list", $data, true);
        $data['vendor'] = $this->purchase_model->get_vendor_list();
        if ($order_id) {
            $data['status'] = $order_info->status_name;
            $data['requisition_code'] = $order_info->requisition_code;
        } else {
            $data['requisition_code'] = $this->common_model->get_code_number('requisition');
            $data['status'] = 'Draft';
        }
        $data['title'] = 'Create New Requisition';
        $this->render_page('requisition/requisition_form', $data);
    }
    
    
    public function save_requisition_for_reauisition_order_block()
    {
        //$this->form_validation->set_rules('requisition_code', 'PO Number', 'trim|required');
        $this->form_validation->set_rules('warehouse_id', 'Delivery Location', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $data = $this->input->post();
            $data['created_by'] = $this->session->userdata('USER_ID');
            $data['location_id'] = $this->session->userdata('LOCATION_ID');
            $data['requisition_code'] = get_generated_code(3);
            $data['requisition_status'] = 39; // 39=Requisition draft
            $return_id = $this->common_model->save_data($data, 'stock_requisition');
            if (!file_exists('upload/requisition/'.$return_id)) {
                mkdir('upload/requisition/'.$return_id, 0777, true);
            }
            //echo $return_id;
            
            $return_array['code'] = $data['requisition_code'];
            $return_array['id'] = $return_id;
            echo json_encode($return_array);
            exit();
        }
    }
    
    public function update_requisition_for_requisition_order_block()
    {
        $order_id = $this->input->post('order_id');
        $data['request_date_for_delivery'] = $this->input->post('requist_date_for_delivery');
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        
        $where = array("stock_requisition_id" => $order_id);
        $this->common_model->update_data($data, 'stock_requisition', $where);
        echo $order_id;
    }
    
    public function save_requisition_details()
    {        
        $purchase_order_id =(int)$this->input->post("order_id");
        $product_id = $this->input->post("product_id");
        
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['product_id'] = $values;
            $data['stock_requisition_id'] = $purchase_order_id;
            $data['request_quantity'] = 1;
            $data['approved_quantity'] = 1;
            $return_id = $this->common_model->save_data($data, 'stock_requisition_details');
        }
    }
    
    public function get_product_list()
    {        
        $order_id = $this->input->post('order_id');
        $table = $this->input->post('table');
        $field = $this->input->post('field');
        $order_id = (int)$order_id;
        $data['selected_product_group'] = $this->requisition_model->get_selected_product_group($order_id,$table,$field);
        $data['table'] = $table;
        $data['order_id'] = $order_id;
        echo $this->load->view("requisition/selected_product_list", $data, true);
    }
    
    public function update_product(){
        $order_details_id = $this->input->post('order_details_id');
        $field_name = $this->input->post('field_name');
        $value = $this->input->post('value');
        $product_id = $this->input->post('product_id');
        $data[$field_name] = $value;
        $data['request_quantity'] = $value;
        $where = array(
            "stock_requisition_id" => $order_details_id,
            "product_id" => $product_id
        );
        $this->common_model->update_data($data,"stock_requisition_details",$where);
        echo 1;
    }
    
    public function update_product_details() {
        $order_details_id = $this->input->post('order_details_id');
        $request_quantity = $this->input->post('quantity');
        $where = array("stock_requisition_details_id" => $order_details_id);
        $data = array("request_quantity"=>$request_quantity,"approved_quantity"=>$request_quantity);
        $this->common_model->update_data($data, "stock_requisition_details", $where);
    }
    
    public function delete_product() {
        $order_details_id = $this->input->post('order_details_id');
        $this->db->where("stock_requisition_details_id", $order_details_id);
        $this->db->delete("stock_requisition_details");
        echo 1;
    }
    
    public function check_order_details() {
        $order_id = $this->input->post("order_id");
        $query = $this->db->query("SELECT * FROM stock_requisition_details where stock_requisition_id= $order_id");
        echo $query->num_rows();
    }
    
    
     public function save_aditional_info(){
        $order_id = $this->input->post('order_id');
        $approve_person = $this->input->post('approve_person');
        $code = $this->db->query("SELECT requisition_code FROM stock_requisition WHERE stock_requisition_id=".$order_id)->row();
        
        $this->common_model->delegation_by_ref_insert(4,$code->requisition_code);
            
        initiate_delegation($code->requisition_code);
        
//        $this->db->where("stock_requisition_id",$order_id);
//        $this->db->delete("sr_delegation");
//        $hiedrarchy_query = $this->deligation_model->heirarchy_query(4);
//        foreach ($hiedrarchy_query->result() as $k=>$v)
//        {
//            $insert_array = array(
//                'stock_requisition_id'=>$order_id,
//                'userid'=>$v->user_id,
//                'sort_number'=>$v->sort_number,
//                'step_number'=>$v->step_number,
//                'must_approve'=>$v->must_approve,
//                'created_by'=>  $this->session->userdata("USER_ID")
//            );
//            $this->db->insert("sr_delegation",$insert_array);
//        }
        
        
        
        $update_data = array(
            'requisition_status' => 40
        );
        $where = array(
            'stock_requisition_id' => $order_id
        );
        $tt = $this->common_model->update_data($update_data, 'stock_requisition', $where);
         return $tt;
    }
    
    public function requisition_history(){
        $data['table_data'] = $this->requisition_model->get_all_requisition_history();
        $data['title'] = 'Requisition History';
        $this->render_page('requisition/requisition_history_view',$data);
     }
     
     public function requisition_chalan_details_info($chalan_id){
        $data['table_data'] = $this->requisition_model->get_all_requisition_history();
        $data['chalan_id'] = $chalan_id;
        $data['chalan_info'] = $this->requisition_model->chalan_info_details_info($chalan_id,'Stock Transfer');
        $this->render_page('requisition/requisition_chalan_details_view',$data);
     }
     
     public function requisition_history_search(){
           $post = $this->input->post();
           $where ='1';
           foreach ($post as $k=>$pv)
           {               
               if($k == "status_id"){
                   $k="requisition_status";
               }
               if($pv)
               {
                   $where .= " AND stock_requisition.".$k."=".$pv;
               }
           }
           //$data['table_data'] = $this->requisition_model->get_all_requisition_search_history($where);
           $data['table_data'] = $this->requisition_model->get_all_requisition_history($where);
           $this->load->view("requisition/requisition_history_ajax_view",$data);
     }
     public function requisition_details($requisition_id){
        $data['requisition_id'] = $requisition_id;
        $data['table_data'] = $this->requisition_model->requisition_details($requisition_id); 
        $data['sql'] = $this->requisition_model->requisition_item_info($requisition_id); 
        $data['info'] = $this->requisition_model->get_all_deligation_information($requisition_id); 
        $data['chalan_info'] = $this->requisition_model->get_chalan_info($requisition_id,'Stock Transfer'); 
        $data['title'] = 'Requisition Details';
        $code = $data['table_data']->requisition_code;
        $data['approve_history'] = $this->requisition_model->get_approve_history($code);
        $this->render_page('requisition/requisition_details',$data);
     }
     
     
     
    
     
     public function requisition_order_from_cart($type)
    {    
        $user_id = $this->session->userdata("USER_ID");
        $requisition_code = get_generated_code(3);
        $requisition_order = array(
            'requisition_code'=>  $requisition_code,
            'created_by'=>$user_id,
            'location_id'=>  $this->session->userdata('LOCATION_ID'),
            'request_date_for_delivery'=>date('Y-m-d'),
            'warehouse_id'=>2,
            'requisition_status'=>39
        );
        $this->db->insert('stock_requisition',$requisition_order);
        $order_id = $this->db->insert_id();
        
        $rows = $this->db->query("SELECT * FROM product WHERE product_id IN (SELECT product_id FROM cart WHERE type='".$type."' AND user_id='".$user_id."')");
        
        foreach ($rows->result() as $row)
        {
            $purchase_order_details = array(
                'stock_requisition_id'=>$order_id,
                'product_id'=>$row->product_id,
                'request_quantity'=>1,
                'approved_quantity'=>1
            );
            $this->db->insert('stock_requisition_details',$purchase_order_details);
        }
        $this->db->where("type",$type);
        $this->db->where("user_id",$user_id);
        $this->db->delete('cart');
        redirect(base_url().'requisition/product_requisition/'.$order_id.'/?r_code='.$requisition_code);
    }
}



