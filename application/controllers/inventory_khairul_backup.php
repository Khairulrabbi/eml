<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('purchase_model');
                $this->load->model('inventory_model');
        $this->load->model('master_model');
        $this->load->model('common_model');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function add_new_product($order_id = NULL) 
    {
        if(isset($_GET['page']))
        {
            $child_view = $_GET['page'];
        }
        else
        {
            $child_view = 'product_info';
        }
        
        $data['title'] = 'Add New Product';
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

    public function add_product_submit()
    {
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('product_category_id', 'Product Category', 'trim|required');
        $this->form_validation->set_rules('product_subcategory_id', 'Product Sub Category', 'trim|required');
        $this->form_validation->set_rules('product_brand_id', 'Product Brand', 'trim|required');
        //$postData = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $data['product_name'] = $this->input->post('product_name');
            $data['product_category_id'] = $this->input->post('product_category_id');
            $data['product_subcategory_id'] = $this->input->post('product_subcategory_id');
            $data['product_brand_id'] = $this->input->post('product_brand_id');
            $data['description'] = $this->input->post('description');
            $data['unit_measure_id'] = (int)$this->input->post('unit_measure_id');
            $data['barcode_prefix'] = $this->input->post('barcode_prefix');
            $data['reorder_point'] = (int)$this->input->post('reorder_point');
            $data['reorder_qty'] = (int)$this->input->post('reorder_qty');
            $data['remarks'] = $this->input->post('remarks');
            //$data['image_location'] = $this->input->post('image_location');
            if($_FILES["userfile"])
            {
                if($_FILES["userfile"]['name']!='')
                {
                    $config['upload_path'] = "./upload/product/";
                    $config['allowed_types'] = '*';
                    $this->upload->initialize( $config );
                    if ( ! $this->upload->do_upload() )
                    {
                        echo $this->upload->display_errors();
                        $this->form_validation->set_message('userfile', $this->upload->display_errors());
                        echo validation_errors(); 
                        die();
                    }
                    else
                    {
                        $image_info = $this->upload->data();
                        $data['image_location'] = $image_info['file_name'];
                    }
                }
                else 
                {
                    unset($data['imgInp']);
                }
            }
            $this->db->insert('product', $data);
            $done = "done";
            //debug($done,1);
            echo $done;
        }
    }
    
//    public function product_list() {
//        $sql = " SELECT
//                        product.product_name,
//                        product.created,
//                        product.created_by,
//                        product.`status`,
//                        product.unit_price_usd,
//                        product.unit_price,
//                        product_brand.product_brand_name,
//                        product_category.product_category_name,
//                        product_subcategory.product_subcategory_name
//                FROM
//                        product
//                LEFT JOIN product_brand ON product.product_brand_id = product_brand.product_brand_id
//                LEFT JOIN product_category ON product.product_category_id = product_category.product_category_id
//                LEFT JOIN product_subcategory ON product.product_subcategory_id = product_subcategory.product_subcategory_id ";
//        $query = $this->db->query($sql);
//        $data_master_form = $query->result_array();
//        $menu_id = $this->input->get('m_id');
//        
//        $this->render_page('inventory/display_product_list');
//    }
    
     public function display_product_list() {
        $data['results'] = $this->inventory_model->get_product_list();
        
        $this->render_page('inventory/detail_product_list', $data);
    }
    
}
