<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('sales_model');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function add_new($order_id = NULL) {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
//        echo $this->db->last_query();
//        exit();
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            $data['sales_code'] = $order_info->sales_code;
            $data['status'] = $order_info->status_name;
            $data['sales_status'] = $order_info->sales_status;
            
            
        } else {
            $data['sales_code'] = $this->get_code();
            $data['status'] = '';
            $data['sales_status'] = '2';
            
            
            
        }

        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Create Sales Order';
        $this->render_page('sales_form', $data);
        //$this->load->view('customer', $data);
    }

    public function order_details($order_id = NULL) {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        // echo $this->db->last_query();
        //exit();
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }

        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Sales Order Details';
        $this->render_page('sales_detais', $data);
        //$this->load->view('customer', $data);
    }

    public function get_code() {
        return rand();
    }

    public function save_order_details() {
        $sales_order_id = $this->input->post("order_id");
        $product_id = $this->input->post("product_id");
        $sales_price = $this->input->post("purchase_price");
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['product_id'] = $values;
            $data['sales_price'] = ($sales_price[$key]) ? $sales_price[$key] : 0;
            $data['sales_order_id'] = $sales_order_id;
            $data['quantity'] = 1;
            $return_id = $this->sales_model->save_data($data, 'sales_order_details');
            //echo $this->db->last_query()."<br>";
        }
        //exit();
        redirect("sales/add_new/$sales_order_id");
    }

    public function sales_summary() {

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

        $this->sales_model->add_summary($data);
    }

    public function get_sub_category() {
        $category_id = $this->input->post("category_id");
        echo sub_category_list(null, array('class' => 'sub_category_id', 'required' => 'required'), 'product_subcategory_name', array("product_category_id" => $category_id));
    }

    public function save_sales_order() {
        $data = array();
        $order_id = $this->input->post('main_order_id');
        //echo $order_id;
        //exit();
        $data['vendor_id'] = $this->input->post('vendor_id');
        $data['sales_code'] = $this->input->post('sales_code');
        $data['lc_number'] = $this->input->post('lc_number');
        $data['order_date'] = $this->input->post('order_date');
        $data = $this->input->post();

        $data['sales_status'] = 2;
        $data_return = $this->unset_data($data);
        if ($order_id) {
            //echo "h";
            $where = array("sales_id" => $order_id);
            $return_id = $this->sales_model->update_data($data_return, 'sales_order', $where);
        } else {
            //echo "he";
            $return_id = $this->sales_model->save_data($data_return, 'sales_order');
        }
        //exit();
        echo $return_id;
    }

    public function delete_product() {
        $order_details_id = $this->input->post('order_details_id');
        $this->db->where("sales_order_details_id", $order_details_id);
        $this->db->delete("sales_order_details");
        echo 1;
    }

    public function update_product_details() {
        $order_details_id = $this->input->post('order_details_id');
        $where = array("sales_order_details_id" => $order_details_id);
        $data = $this->input->post();
        unset($data['order_details_id']);
        $this->sales_model->update_data($data, "sales_order_details", $where);
    }

    public function update_order($order_id = NULL) {
        //echo "<pre>";
        //print_r($this->input->post());
//      exit();
        if (!$this->input->post('confirm')) {
            $order_id = $this->input->post('order_id');

            $redirect = "sales/order_details/$order_id";
            $data = $this->input->post();
            $data['sales_status'] = 2;
            $data_return = $this->unset_data($data);
        } else {
            $data['status'] = 3;
            $data_return['sales_status'] = 3;
            $redirect = "sales/add_new";
        }
        $where = array("sales_id" => $order_id);

        $this->sales_model->update_data($data_return, "sales_order", $where);
        redirect($redirect);
    }

    public function check_order_details() {
        $order_id = $this->input->post("order_id");
        $query = $this->db->query("SELECT * FROM sales_order_details where sales_order_id= $order_id");
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
     * A function to view sales order details list
     * Created by Charlie 04-May-16
     * assigned by Atik vai
     */ 
    
     public function sales_order_history(){
        $data['table_data'] = $this->sales_model->get_all_sales_order_history();
        $data['title'] = 'Sales Order History';
        $this->render_page('sales/sales_order_history',$data);
     }

}
