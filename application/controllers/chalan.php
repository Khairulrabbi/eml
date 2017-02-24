<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chalan extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('chalan_model');
        $this->load->model('common_model');
    }
    public function requisition_chalan_form($requisition_id,$chalan_id=NULL)
    {
        
        if($chalan_id)
        {
            //
        }
        else
        {
            //$data['chalan_code'] = $this->common_model->get_code_number('chalan');
            //$data['chalan_code'] = get_generated_code("CH");
            $data['warehouse_id'] = 3;
        }
        $data['requisition_id'] = $requisition_id;
        $data['requisition_info'] = $this->chalan_model->requisition_info($requisition_id);
        $data['requisition_details'] = $this->chalan_model->requisition_details($requisition_id,$data['warehouse_id']);
        $data['title'] = 'Create Requisition Chalan Form';
        $this->render_page('chalan/requisition_chalan_form',$data);    
    }
    
    public function chalan_details_pdf_generate($id=NULL)
        {
            $data['requisition_id'] = $id;
            $data['requisition_info'] = $this->chalan_model->get_chalan_save_info($id);
            $data['product_info'] = $this->chalan_model->get_chalan_product_save_info($id);
            $data['view'] = 'chalan/chalan_pdf_generate';
            mpdf_create($data,'pdf_name','A4-L');
        }
        
        
        
        
        
        public function requisition_chalan_form_details_preview($id=NULL){
            $data['requisition_id'] = $id;
            $data['requisition_info'] = $this->chalan_model->get_chalan_save_info($id);
            $data['product_info'] = $this->chalan_model->get_chalan_product_save_info($id);
            $this->render_page('chalan/requisition_chalan_form_details_view',$data); 
        }
        
        
        public function sales_chalan_form_details_preview($id=NULL){
            $data['sales_id'] = $id;
            $data['sales_info'] = $this->chalan_model->get_chalan_save_info_for_sales($id);
            $data['product_info'] = $this->chalan_model->get_chalan_product_save_info($id);
            $this->render_page('chalan/sales_chalan_form_details_view',$data); 
        }
    
    public function load_requisition_info()
    {
        $requisition_id = $this->input->post('requsition_id');
        $delivery_to = $this->input->post('delivery_to');
        $data['requisition_details'] = $this->chalan_model->requisition_details($requisition_id,$delivery_to);
        $this->load->view("chalan/requisition_chalan_form_ajax_view",$data);
    }
    
    public function load_sales_info()
    {
        $sales_id = $this->input->post('sales_id');
        $delivery_to = $this->input->post('delivery_to');
        $data['sales_details'] = $this->chalan_model->sales_details($sales_id,$delivery_to);
        $this->load->view("chalan/sales_chalan_form_ajax_view",$data);
    }

    
    
    public function save_requisition_chalan()
    {
        $post = $this->input->post();
//        debug($post,1);
        $this->chalan_model->info_save_requisition_chalan($post);        
        echo TRUE;
    }
    
    public function save_sales_chalan()
    {
        $post = $this->input->post();
        //debug($post,1);
        $this->chalan_model->info_save_sales_chalan($post);        
        echo TRUE;
    }

    public function save_chalan()
    {
        $post = $this->input->post();
        
        //$this->chalan_model->info_save_sales_chalan($post);
        $this->chalan_model->info_save_chalan($post);        
        echo TRUE;
    }
    
    
    public function chalan_list()
    {
        //debug($this->session->all_userdata(),1);
        $data['chalan_list'] = $this->chalan_model->chalan_list($this->session->userdata("LOCATION_ID"),44,"Stock Transfer"); // here 2nd parameter 44 status id (waiting for delevery) and 3rd parameter is chalan type
        $data['title'] = 'Stock Receive List';
        $this->render_page('chalan/chalan_list',$data); 
    }
    
    
    public function chalan_details($c_id){
        $data['chalan_details'] = $this->chalan_model->chalan_info($c_id);
        $data['item_list'] = $this->chalan_model->get_chalan_item_info($c_id);
        $this->render_page('chalan/chalan_details_view',$data);
    }
    
    public function update_chalan_purchase_good_receive(){
        $chalan_id = $this->input->post('chalan_id');
        $this->db->where('chalan_id', $chalan_id);
        $this->db->update('chalan',array("chalan_status"=>45));
        $this->db->where('chalan_id',$chalan_id );
        $this->db->update('purchase_good_receive',array("good_receive_status_id"=>45));
//        echo $this->db->last_query();
//        exit();
        
    }
    
    
    public function sales_chalan_form($sales_id,$chalan_id=NULL)
    {
        if($chalan_id)
        {
            //
        }
        else
        {
            //$data['warehouse_id'] = 3;
        }
        //debug($this->session->userdata(LOCATION_ID),1);
        $default_warehouse = $this->common_model->default_warehouse($this->session->userdata('LOCATION_ID'));
        //debug($default_warehouse->warehouse_id,1);
        $data['warehouse_id'] = $default_warehouse->warehouse_id;
        $data['sales_id'] = $sales_id;
        $data['sales_info'] = $this->chalan_model->sales_info($sales_id);
        $data['sales_details'] = $this->chalan_model->sales_details($sales_id,$data['warehouse_id']);
        $data['title'] = 'Create Sales Chalan Form';
        $this->render_page('chalan/sales_chalan_form',$data);    
    }
    
    public function sales_chalan_details_pdf_generate($id=NULL)
        {
            $data['sales_id'] = $id;
            $data['sales_info'] = $this->chalan_model->get_chalan_save_info_for_sales($id);
            $data['product_info'] = $this->chalan_model->get_chalan_product_save_info($id);
            $data['view'] = 'chalan/sales_chalan_pdf_generate';
            mpdf_create($data,'pdf_name','A4-L');
        }
    public function all_chalan_list()
    { 
        //$data['chalan_details'] = $this->chalan_model->chalan_info($c_id);
        $data['sales_id_array'] = array();
        $data['all_chalan_list'] = $this->chalan_model->get_all_chalan_list('Sale');
        $data['all_delivery_schedule_list'] = $this->chalan_model->get_all_delivery_schedule_list('Sale');
        $this->render_page('chalan/all_chalan_list',$data);
    }
    
    public function chalan_order_detail_list($chalan_id = NULL){
        $data['chalan_order_details'] = $this->chalan_model->get_chalan_order_details('Sale',$chalan_id);
        $data['item_list'] = $this->chalan_model->get_chalan_item_list($chalan_id);
        $this->render_page('chalan/chalan_order_detail_list',$data);
        
    }
    
    public function chalan_order_detail_print($chalan_id = NULL){
        $data['chalan_order_details'] = $this->chalan_model->get_chalan_order_details_print('Sale',$chalan_id);
        $data['item_list'] = $this->chalan_model->get_chalan_item_list($chalan_id);
        $data['view'] = 'chalan/chalan_order_detail_print_view';
        mpdf_create($data,'pdf_name','A4-L');
    }

    public function order_list_for_create_schedule()
    {
       
        $schedule_id = $_POST['schedule_id'];
        $chalan_id = $_POST['chalan_id'];
        $chalan_id_array = explode(',', $chalan_id);
        $data['chalan_id_array'] = $chalan_id_array;
        
        //$unschedule_sales_order = $this->sales_model->get_list_for_create_schedule($sales_id);
         $data["all_chalan_list"] = $this->chalan_model->get_all_chalan_list('Sale',$chalan_id);
        
        $data['flag']= 'modal';
        echo $this->load->view("chalan/all_chalan_list_ajax_view",$data);
    }
    
    public function selected_value_from_schedule_table()
    {
        $schedule_id = $_POST['schedule_id'];
        $schedule_info = $this->chalan_model->svfst($schedule_id);
        echo json_encode($schedule_info);
        
    }
    
    public function create_delivery_schedule()
    {
        $post_info = $this->input->post();
        //debug($post_info,1);
        $this->form_validation->set_rules('delivery_time','Delivery Date','trim|required');
        $this->form_validation->set_rules('time','Delivery Time','trim|required');
        $this->form_validation->set_rules('delivery_location','Delivery Location','trim|required');
        $this->form_validation->set_rules('delivery_van','Delivery Van','trim|required');
        $this->form_validation->set_rules('chalan_id','Chalan Order','required');
        //debug($post_info['sales_id'],1);
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            //debug(json_encode($post_info['sales_id']),1);
            $insert_array = array(
                'chalan_type'=> $post_info['chalan_type'],
                'chalan_id'=>  json_encode($post_info['chalan_id']),
                'schedule_code'=>get_generated_code(6),
                'schedule_time'=> $post_info['delivery_time']." ".$post_info['time'],
                'delivery_address_id'=>$post_info['delivery_location'],
                'van_id'=>$post_info['delivery_van'],
                'created_by'=>  $this->session->userdata('USER_ID'),
                'delivery_status'=>60
                );
            if($post_info['schedule_id'])
            {
                $this->chalan_model->psm_so($post_info);
                $this->db->where('delivery_schedule_id', $post_info['schedule_id']);
                $result = $this->db->update('delivery_schedule', $insert_array);                 
                echo TRUE;
            }
            else
            {
                $result = $this->db->insert('delivery_schedule',$insert_array);
                $this->chalan_model->psm_so($post_info);
                echo TRUE;
            }
        }
    }
    
    public function delivery_confirm()
    {
        $post = $this->input->post();
        $this->chalan_model->sales_order_complete($post);
        echo TRUE;
    }
    
    
    public function schedule_ordering()
    {
        $post = $this->input->post();
//        debug($post,1);
        $this->chalan_model->schedule_ordering_sql($post);
        echo TRUE;
    }
}
