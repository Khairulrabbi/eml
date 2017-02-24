<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('purchase_model');
        $this->load->model('stock_model');
        $this->load->model('inventory_model');
        $this->load->model('common_model');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function add_new_product($order_id = NULL) 
    {
        if(isset($_GET['page']))
        {
            $child_view = $_GET['page'];
            $data['sql'] = $this->inventory_model->get_purchase_history();
            $data['sql1'] = $this->inventory_model->get_current_stock();
        }
        else
        {
            $child_view = 'product_info';
        }
        $data['product_suggest'] = $this->inventory_model->product_suggest('product_name');
        $data['model_suggest'] = $this->inventory_model->product_suggest('model_name');
        $data['specification_list'] = $this->inventory_model->specification_type();

        $data['child_view'] = 'inventory/'.$child_view;
        $this->render_page('inventory/add_product', $data);
    }
    
    public function get_ajax_product_sub_category()
    {
        $product_category_id = $this->input->post('product_category_id');
        $this->db->select('product_subcategory_id,product_subcategory_name');
        $this->db->where('product_category_id',$product_category_id);
        $rows = $this->db->get('product_subcategory');
        $html = '<option value="">Select One</option>';
        foreach ($rows->result() as $key=>$row)
        {
            $html .= '<option value="'.$row->product_subcategory_id.'">'.$row->product_subcategory_name.'</option>';
        }
        echo $html;
    }
    
    public function add_product_indent_number_wise($indent=NULL,$product_id=NULL){
        $data['p_list_indent_wise'] = $this->inventory_model->get_p_list_indent_wise($indent,$product_id);
        $this->render_page('inventory/product_list_indent_wise_view', $data);
    }

    public function add_product_submit()
    {
        $post = $this->input->post();
//        debug($post,1);
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('model_name', 'Product Model Name', 'trim|required');
        $this->form_validation->set_rules('region_id', 'Region', 'trim|required');
        $this->form_validation->set_rules('product_group_id', 'Product Group', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('unit_m3', 'Unit M3', 'trim|required');
        $this->form_validation->set_rules('unit_price_usd', 'Unit Price USD', 'trim|required');
        $this->form_validation->set_rules('unit_price', 'Unit Price BDT', 'trim|required');
        if(!isset($post['new_vehicle']))
        {
            $this->form_validation->set_rules('vehicle_type_id', 'Vehicle Type Id', 'trim|required');
        }
        
        
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $product_id = $this->input->post('product_id');
            if($product_id)
            {
                if(isset($post['new_vehicle']))
                {
                    $this->db->insert('vehicle_type',array(
                        'vehicle_type_name'=>$post['new_vehicle'],
                        'created_by'=>  $this->session->userdata('USER_ID'),
                        'status'=>'Active')
                   );
                   $vehicle_id = $this->db->insert_id();
                   unset($post['vehicle_type_id']);
                   unset($post['new_vehicle']);
                   $post['vehicle_type_id'] = $vehicle_id;
                }
                $ps = array();
                foreach ($post['product_specification'] as $key=>$ps_val)
                {
                    if($ps_val)
                    {
                        $ps[$key] = $ps_val;
                    }                    
                }
                $post['product_details_json'] = json_encode($ps);
                unset($post['product_id']);
                unset($post['product_specification']);
                $post['updated_by'] = $this->session->userdata('USER_ID');
                $this->db->where('product_id',$product_id);
                $this->db->update('product',$post);
                echo TRUE;
            }
            else
            {
                if(isset($post['new_vehicle']))
                {
                    $this->db->insert('vehicle_type',array(
                        'vehicle_type_name'=>$post['new_vehicle'],
                        'created_by'=>  $this->session->userdata('USER_ID'),
                        'status'=>'Active')
                   );
                   $vehicle_id = $this->db->insert_id();                   
                   unset($post['vehicle_type_id']);
                   unset($post['new_vehicle']);
                   $post['vehicle_type_id'] = $vehicle_id;
                }
                $ps = array();
                foreach ($post['product_specification'] as $key=>$ps_val)
                {
                    if($ps_val)
                    {
                        $ps[$key] = $ps_val;
                    }                    
                }
                $post['product_details_json'] = json_encode($ps);
                unset($post['product_id']);
                unset($post['product_specification']);
                $post['created_by'] = $this->session->userdata('USER_ID');
                $this->db->insert('product',$post);
                echo TRUE;
            }
        }
    }
   
    
    //Khairul Area
    //Work for product spliting
    public function aftersplit() {
       $this->load->view('inventory/break');
    } 
    
    public function get_details($product_code = '') {
        //debug($this->session->all_userdata(),1);
        $data['product'] = $this->stock_model->get_product_details($product_code);
        $this->render_page("inventory/splits", $data);
    }
    
    public function splitSave(){
       $post = $this->input->post();
       $product_code = $post['product_code'];
       $cat_id = $post['cat_id'];
       $pro_subcat_id = $post['pro_subcat_id'];
       $pro_brand_id = $post['pro_brand_id'];
      
       $price_usd = $post['price_usd'];
       $price = $post['price'];
       $pro_id = $post['pro_id'];
       $sl_number = $post['sl_number'];
       
       $row = $this->db->query("SELECT * FROM product_stock_manager WHERE product_code='".$product_code."'")->row();
       //debug($row,1);
       $insert_array=array(
            'product_code' => $this->common_model->get_code_number('purchase'),
            'service_tag_number' => $row->service_tag_number,
            'vendor_id' => $row->vendor_id,
            'purchase_id' => $row->purchase_id,
            'purchase_date' => $row->purchase_date,
            'purchase_price_usd' => $price_usd,
            'good_recieve_date' => date("Y-m-d"),
            'current_warehouse_location' => $row->current_warehouse_location,
            'packing_slip_date' => $row->packing_slip_date,
            'product_id' =>$pro_id, 
            'serial_number' =>$sl_number, 
            'purchase_price' =>$price,
            'status_id' => 13,
            'created' => date("Y-m-d"),
            'created_by' => $this->session->userdata('USER_ID')
           );
       
        $this->stock_model->save_data($insert_array,'product_stock_manager');        

        $this->db->where('product_code', $product_code);
        $this->db->update('product_stock_manager', array('status_id'=>20));
    }
    
    //Work for Displaying Product List
    
     public function product_list_backup() {  
        $data['columns'] = array("#SL_no","product_name","sdta","vehicle_type_name","created_by","created","status","Action");
        $data['sql'] = $this->inventory_model->get_product_list();
        $data['action'] = array("common"=>"","edit"=>"inventory/add_new_product/?page=product_info&p_id=","view"=>"inventory/view/","delete"=>"inventory/delete/");
        $this->render_page('inventory/detail_product_list', $data);
    }
    
    //This function works are done again in the lower part at this page. Khairul 17.10.16
//     public function product_lists() {  
//        $data['sql'] = $this->inventory_model->get_product_list();
//        $data['action'] = array("common"=>"","edit"=>"inventory/add_new_product/?page=product_info&p_id=","view"=>"inventory/view/","delete"=>"inventory/delete/");
//        $this->render_page('inventory/detail_product_list', $data);
//    }
    
    
    public function segregation($order_id = NULL)
    {
        $data['columns'] = array("#SL_no","product_name","vendor_name","purchase_price_usd","purchase_price_bdt","serial_number","order_number","warehouse_name","status_name");
        $data['sql'] = $this->inventory_model->get_segregation_list();
        $data['action'] = array("common"=>"inventory/get_details/","edit"=>FALSE,"view"=>FALSE,"delete"=>FALSE);
        $this->render_page('inventory/segregation', $data);
    }
    
//Added By Khairul 
 
    public function product_list() {
        $where = "WHERE 1 ";
        $data['results'] = $this->inventory_model->get_product_lists($where);
//        debug($this->db->last_query(),1);  
       
        $this->render_page('inventory/detail_product_list', $data);
    }
    
    public function current_stock_search() {
        $post = $this->input->post();
        $where = "WHERE 1 ";
        foreach($post as $k=>$pv) {
            if($pv) {
              $where .= ' AND p.'.$k.'="'.$pv.'"';
            }
        }
        $data['results'] = $this->inventory_model->get_product_lists($where);
        $this->load->view("inventory/detail_product_list_search_ajax_result",$data);
    }
}
