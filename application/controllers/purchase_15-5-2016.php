<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('purchase_model');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function add_new($order_id = NULL) {
        $data['selected_product'] = $this->purchase_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
        //echo $this->db->last_query();
        //exit();
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list", $data, true);
        $data['vendor'] = $this->purchase_model->get_vendor_list();
        if ($order_id) {
            
            $data['status'] = $order_info->status_name;
            $data['purchase_code'] = $order_info->purchase_code;
        } else {
            $data['purchase_code'] = $this->get_code();
            $data['status'] = 'Draft';
            
        }

        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Create Purchase Order';
        $this->render_page('purchase_form', $data);
        //$this->load->view('customer', $data);
    }

    public function order_details($order_id = NULL) {
        $data['selected_product'] = $this->purchase_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
        // echo $this->db->last_query();
        //exit();
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list", $data, true);
        $data['vendor'] = $this->purchase_model->get_vendor_list();
        if ($order_id) {
            
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }

        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Purchase Order Details';
        $this->render_page('purchase_detais', $data);
        //$this->load->view('customer', $data);
    }

    public function get_code() {
        return rand();
    }

    public function save_order_details() {
        $purchase_order_id = $this->input->post("order_id");
        $product_id = $this->input->post("product_id");
        $purchase_price = $this->input->post("purchase_price");
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['product_id'] = $values;
            $data['purchase_price'] = ($purchase_price[$key]) ? $purchase_price[$key] : 0;
            $data['purchase_order_id'] = $purchase_order_id;
            $data['quantity'] = 1;
            $return_id = $this->purchase_model->save_data($data, 'purchase_order_details');
            //echo $this->db->last_query()."<br>";
        }
        //exit();
        redirect("purchase/add_new/$purchase_order_id");
    }

    public function purchase_summary() {

        $vendor = $this->input->post('vendor');
        $order_no = $this->input->post('order_no');
        $lc_no = $this->input->post('lc_no');
        $order_date = $this->input->post('order_date');
        $shipping_date = $this->input->post('shipping_date');
        $data = array('vendor' => $vendor,
            'order_no' => $order_no,
            'lc_no' => $lc_no,
            'order_date' => $order_date,
            'shipping_date' => $shipping_date
        );

        $this->purchase_model->add_summary($data);
    }

    public function get_sub_category() {
        $category_id = $this->input->post("category_id");
        echo sub_category_list(null, array('class' => 'sub_category_id', 'required' => 'required'), 'product_subcategory_name', array("product_category_id" => $category_id));
    }

    public function save_purchase_order() {
        $data = array();
        $order_id = $this->input->post('main_order_id');
        //echo $order_id;
        //exit();
        $data['vendor_id'] = $this->input->post('vendor_id');
        $data['purchase_code'] = $this->input->post('purchase_code');
        $data['lc_number'] = $this->input->post('lc_number');
        $data['order_date'] = $this->input->post('order_date');
        $data = $this->input->post();

        $data['status'] = 5;
        $data_return = $this->unset_data($data);
        if ($order_id) {
            //echo "h";
            $where = array("purchase_id" => $order_id);
            $return_id = $this->purchase_model->update_data($data_return, 'purchase_order', $where);
        } else {
            //echo "he";
            $return_id = $this->purchase_model->save_data($data_return, 'purchase_order');
        }
        //exit();
        echo $return_id;
    }

    public function delete_product() {
        $order_details_id = $this->input->post('order_details_id');
        $this->db->where("purchase_order_details_id", $order_details_id);
        $this->db->delete("purchase_order_details");
        echo 1;
    }

    public function update_product_details() {
        $order_details_id = $this->input->post('order_details_id');
        $where = array("purchase_order_details_id" => $order_details_id);
        $data = $this->input->post();
        unset($data['order_details_id']);
        $this->purchase_model->update_data($data, "purchase_order_details", $where);
    }

    public function update_order($order_id = NULL) {
        //echo "<pre>";
        //print_r($this->input->post());
//      exit();
        if (!$this->input->post('confirm')) {
            $order_id = $this->input->post('order_id');

            $redirect = "purchase/order_details/$order_id";
            $data = $this->input->post();
            $data['status'] = 5;
            $data_return = $this->unset_data($data);
        } else {
            $data['status'] = 6;
            $data_return['status'] = 6;
            $redirect = "purchase/add_new";
        }
        $where = array("purchase_id" => $order_id);

        $this->purchase_model->update_data($data_return, "purchase_order", $where);
        redirect($redirect);
    }

    public function check_order_details() {
        $order_id = $this->input->post("order_id");
        $query = $this->db->query("SELECT * FROM purchase_order_details where purchase_order_id= $order_id");
        echo $query->num_rows();
    }

    public function unset_data($data) {
        unset($data['order_id']);
        unset($data['update_order']);
        unset($data['unit_price']);
        unset($data['quantity']);
        unset($data['order_details_id']);
        unset($data['main_order_id']);
        unset($data['order_id']);
        unset($data['product_category_name']);
        unset($data['product_brand_name']);
        unset($data['product_name']);
        unset($data['product_subcategory_name']);
        unset($data['product_subcategory_name']);
        unset($data['order_id']);
        unset($data['product_category_name']);
        unset($data['product_brand_name']);
        unset($data['product_name']);
        unset($data['product_subcategory_name']);
        unset($data['product_subcategory_name']);
        unset($data['main_order_id']);
        foreach ($data as $key=>$value){
            if(!$data[$key]){
                unset($data[$key]);
            }
        }
        return $data;
    }
    
    /*
     * A function to view purchase details list
     * Created by Charlie 03-May-16
     * assigned by Saiful vai
     */ 
    
     public function purchase_history(){
        $data['table_data'] = $this->purchase_model->get_all_purchase_history();
        $data['title'] = 'Purchase History';
        $this->render_page('purchase/purchase_history',$data);
     }
	 
	     /*
     * A function to save serial no of packing slip
     * Created by Charlie 04-May-16
     * assigned by Atik vai
     */ 
	 
	 //public function get_serial_no($order_id=1){
		 //$data['title'] ='Get Packing Slip Serial';
		 //$data['recieve_qty']= 5;
		 //$this->render_page('purchase/get_serial_no',$data);
	 //}
	 
	      
    /*Added By Rokib Hasnat
     * 
     */
         
    public function packing_slip(){
        $order_id = $this->input->post('order_id');
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);

        $data['order_info'] = $order_info;
        
        if ($order_id) {
            $data['purchase_code'] = $order_info->purchase_code;
            $data['status'] = $order_info->status_name;
            $data['vendor_id'] = $order_info->vendor_id;
            $data['lc_number'] = $order_info->lc_number;
            $data['lc_value'] = $order_info->lc_value;
            $data['bill_of_entry'] = $order_info->bill_of_entry;
            $data['bill_of_leading'] = $order_info->bill_of_leading;
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
		
        $data['product'] = $this->purchase_model->get_packing_slip_data($order_id);
        $data['order_id'] = $order_id;
        $data['title'] = 'Packing Slip Details';
        $this->render_page('packing_slip_detail', $data);
        
    }
    
    public function get_serial_number(){
        $post = $this->input->post();
        $received = $post['new_received'];
        $product_id =  $post['product_id'];
        for($i=1; $i<=$received; $i++){
            $product_code = $this->generate_random_string(8);
            $month= $post['warranty_period'];

            $priod= "+".$month." month";
            $date = $post['warranty_start_date'];

            $insert_array = array(
                'product_code' =>$product_code,
                'product_id' =>$post['product_id'],
                'purchase_id' =>$post['order_id'],
                'purchase_price' =>$post['unit_price'],
                'warranty_start_date' =>$post['warranty_start_date'],
                'warranty_period' =>$post['warranty_period'],
                'warranty_expired_on' =>date("Y-m-d", strtotime(str_replace('-','/', $date). $priod)),
                'packing_slip_date' =>date('Y-m-d')
            );
            
            $this->purchase_model->save_data($insert_array,'product_stock_manager');
        }
        
        $update_data = array(
            'total_received'=>'total_received'+$received
        );
        $where = array(
            'purchase_order_id' =>$post['order_id'],
            'product_id'=>$post['product_id']
        );
        
        $this->purchase_model->update_data($update_data,'purchase_order_details',$where);

        $data['title'] = 'Packing Serial Details';
        $data['products_data']=  $this->purchase_model->get_stock_manager_data($product_id);
        
        $this->render_page('product_stock_manager_view',$data);
    }
    
    public function generate_random_string($length) {
        $str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
    }
	
	public function add_ajax_cost_component_view(){
        $this->load->view('purchase/add_cost_component_view');
    }
}
