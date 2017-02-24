<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('reports_model');
        $this->load->model('common_model');
    }

    public function purchase_summary() {
        $data['sql'] = $this->reports_model->get_purchase_summary();
        $this->render_page('reports/purchase_summary', $data);
    }

    public function item_wise_purchase_summary() {
        $data['sql'] = $this->reports_model->get_item_wise_purchase_summary();
        $this->render_page('reports/item_wise_purchase_summary', $data);
    }

    public function recieved_goods() {
        $data['sql'] = $this->reports_model->get_item_wise_purchase_summary();
        $this->render_page('reports/recieve_goods', $data);
    }

    public function purchase_vendor() {
        $data['sql'] = $this->reports_model->get_item_wise_purchase_summary();
        $this->render_page('reports/purchase_by_vendor', $data);
    }

    public function re_order_manager() {
        $data['sql'] = $this->reports_model->get_re_order_manager();
        $this->render_page('reports/re_order_manager', $data);
    }
    
    public function update_re_order_manager()
    {
        $product_id = $_POST['product_id'];
        $reordermanager = $_POST['reorderquantity'];      
        $this->db->where('product_id', $product_id);
        $this->db->update('product', array('reorder_qty'=>$reordermanager));       
        echo TRUE;
    }
    
    public function customer_wise_sales()
    {
        $data['sql'] = $this->reports_model->get_customer_wise_sales();
        $this->render_page('reports/customer_wise_sales', $data);
    }
}



