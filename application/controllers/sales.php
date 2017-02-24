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
        $this->load->model('common_model');
        $this->load->library('form_validation');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function add_new($order_id = NULL) {
        $this->load->helper('search_helper');
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        $data['due'] = $this->common_model->customer_due(((@$order_info->customer_id)?$order_info->customer_id:0));
        $data['order_info'] = $order_info;
        $data['table'] = 'region';
        if($order_id)
        {
            $data['selected_product_group'] = $this->sales_model->get_selected_product_group($order_id,'region','region_name');
        }
        
        //$data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['selected_product_list'] = $this->load->view("sales/selected_product_list", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            //$data['sales_code'] = $order_info->sales_code;
            $data['status'] = $order_info->status_name;
            $data['sales_status'] = $order_info->sales_status;
            $data['cost_component_list']=  $this->sales_model->get_cost_component_list($order_id);
            $data['supporting_doc_list']=  $this->sales_model->get_support_doc_list($order_id);
        } else {
            //$data['sales_code'] = $this->common_model->get_code_number('sales');
            $data['status'] = '';
            $data['sales_status'] = '2';
        }

        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Create Sales Order';
        $this->render_page('sales/sales_form', $data);
    }
    
    
    public function front_desk_sale($order_id = NULL) {
        $this->load->helper('search_helper');
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_front_desk_order_info($order_id);
        //debug($order_id,1);
        $data['order_info'] = $order_info;
        $data['table'] = 'region';
        if($order_id)
        {
            $data['selected_product_group'] = $this->sales_model->get_selected_product_group($order_id,'region','region_name');
        }
        
        $data['selected_product_list'] = $this->load->view("sales/selected_product_list", $data, true);
        if ($order_id) {
            $data['status'] = $order_info->status_name;
            $data['sales_status'] = $order_info->sales_status;
        } else {
            $data['status'] = '';
            $data['sales_status'] = '2';
        }

        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Create Sales Order';
        $this->render_page('sales/front_desk_sales_form', $data);
    }
    
    public function front_desk_order_details($order_id = NULL) {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_front_desk_order_info($order_id);
//      debug($order_info,1);
        $data['due'] = $this->common_model->customer_due(((@$order_info->customer_id)?$order_info->customer_id:0));
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        $data['product'] = $this->sales_model->get_product_list();
        //$code = $data['order_info']->sales_code;
        $data['chalan_info'] = $this->sales_model->get_chalan_info($order_id,'Counter');
        $data['title'] = 'Sales Order Details';
        $this->render_page('sales/front_desk_order_details_view',$data);
    }
    
    public function add_new_from_quotation($quotation_id = NULL) {
        $quotation_info = $this->db->query("SELECT c.customer_id FROM quotation q 
                LEFT JOIN customer c ON c.customer_id=q.customer_id 
                WHERE q.quotation_id=".$quotation_id)->row();
        
        $order_id = $this->db->insert('sales_order',array(
            'customer_id'=>$quotation_info->customer_id,
            'sales_code'=>$this->common_model->get_code_number('sales'),
            'order_date'=>date('Y-m-d'),
            'sales_person_id'=>$this->session->userdata('USER_ID'),
            'sales_status'=>2,
            'quotation_id'=>$quotation_id
        ));
        $order_id = $this->db->insert_id();
        $quotation_details = $this->db->query("SELECT * FROM quotation_details WHERE quotation_id=".$quotation_id);
        foreach ($quotation_details->result() as $qd)
        {
            $this->db->insert('sales_order_details',array(
                'sales_order_id'=>$order_id,
                'sales_price'=>$qd->quotation_price,
                'product_id'=>$qd->product_id,
                'quantity'=>$qd->quantity
            ));
        }
        
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        $data['due'] = $this->common_model->customer_due(((@$order_info->customer_id)?$order_info->customer_id:0));
        //debug($order_info,1);
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            $data['sales_code'] = $order_info->sales_code;
            $data['status'] = $order_info->status_name;
            $data['sales_status'] = $order_info->sales_status;
            $data['cost_component_list']=  $this->sales_model->get_cost_component_list($order_id);
            $data['supporting_doc_list']=  $this->sales_model->get_support_doc_list($order_id);
        } else {
            $data['sales_code'] = $this->get_code();
            $data['status'] = '';
            $data['sales_status'] = '2';
        }

        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Create Sales Order';
        $this->render_page('sales/sales_form', $data);
    }

    public function order_details($order_id = NULL) {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        //debug($order_info,1);
        $data['due'] = $this->common_model->customer_due(((@$order_info->customer_id)?$order_info->customer_id:0));
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        $data['cost_component']=  $this->sales_model->get_cost_component_list($order_id);
        $data['support_doc']=  $this->sales_model->get_support_doc_list($order_id);
        $data['product'] = $this->sales_model->get_product_list();
        $code = $data['order_info']->sales_code;
        $data['approve_history'] = $this->sales_model->get_approve_history($code);
        $data['chalan_info'] = $this->sales_model->get_chalan_info($order_id,'Sale');
        $data['title'] = 'Sales Order Details';
        $this->render_page('sales/sales_detais',$data);
        //$this->load->view('customer', $data);
    }
    
    public function sales_chalan_details_info($order_id){
        $data['chalan_info'] = $this->sales_model->get_chalan_info($order_id,'Sale');
        //debug($data['chalan_info'],1);
        $this->render_page('sales/sales_chalan_details_view',$data);
     }
     
     public function sales_chalan_front_desk_details_info($order_id){
        $data['chalan_info'] = $this->sales_model->get_chalan_front_desk_info($order_id);
        $this->render_page('sales/sales_chalan_front_desk_details_view',$data);
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
    
    public function sales_print_view($order_id){
        $data['order_info'] = $this->sales_model->get_order_info($order_id);
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['view'] = 'sales/sales_print_view';
        mpdf_create($data,'pdf_name','A4-L');
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
    
    public function delete_product_quotation() {
        $quotation_details_id = $this->input->post('quotation_details_id');
        $this->db->where("quotation_details_id", $quotation_details_id);
        $this->db->delete("quotation_details");
        //debug($this->db->last_query(),1);
        echo 1;
    }

    public function update_product_details() {
        $order_details_id = $this->input->post('order_details_id');
        $where = array("sales_order_details_id" => $order_details_id);
        $data = $this->input->post();
        $data['approve_quantity'] = $data['quantity'];
        //debug($data,1);
        unset($data['order_details_id']);
        $this->sales_model->update_data($data, "sales_order_details", $where);
    }

    public function update_product_details_quotation() {
        $quotation_details_id = $this->input->post('quotation_details_id');
        $where = array("quotation_details_id" => $quotation_details_id);
        $data = $this->input->post();
        unset($data['quotation_details_id']);
        $this->sales_model->update_data($data, "quotation_details", $where);
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
        $order_info = $this->input->post();
        $order_id = $order_info['sales_order_id'];
        $query = $this->db->query("SELECT * FROM sales_order_details where sales_order_id= $order_id");
//        if($query->num_rows() > 0)
//        {
//            $this->db->where('sales_id', $order_id);
//            $this->db->update('sales_order', array('sales_status'=>3));            
//        }
        echo $query->num_rows();
    }
    
    public function check_front_desk_order_details() {
        $order_info = $this->input->post();
        $order_id = $order_info['sales_order_id'];
        $query = $this->db->query("SELECT * FROM sales_order_details where sales_order_id= $order_id");
        if($query->num_rows() > 0)
        {
            $this->db->where('sales_id', $order_id);
            $this->db->update('sales_order', array('sales_status'=>10));            
        }
        echo $query->num_rows();
    }
    
    public function check_quotation_details() 
    {        
        $quotation_info = $this->input->post();
       
        $query = $this->db->query("SELECT * FROM quotation_details where quotation_id= ".$quotation_info['quotation_id']);
        $msg = array();
        if($query->num_rows() < 1)
        {
            $msg[] = "No Product Selected!<br/>";
        }
        if($quotation_info['remark_type'] == 2)
        {
            $users = $this->input->post('userid');
            if($users == "")
            {
                $msg[] = "Please Set Approval Persons<br/>";
            }            
        }
        
        if(empty($msg))
        {
            $this->db->delete('remark_persons', array('quotation_id' => $quotation_info['quotation_id'])); // before insert remark_persons delete all row by quotation id
            if($quotation_info['remark_type'] == 1)
            {
                $default_user = $this->sales_model->get_default_quotation_approval_person(3); // here 3 = approve_for_id from approve_for table
                foreach($default_user->result() as $du)
                {
                    $this->db->insert('remark_persons', array(
                        'quotation_id'=>$quotation_info['quotation_id'],
                        'remark_user_id'=>$du->userid,
                        'comments_type'=>1
                        )); 
                }
            }
            else if($quotation_info['remark_type'] == 2)
            {
                foreach ($quotation_info['userid'] as $key=>$cs)
                {
                    $this->db->insert('remark_persons', array(
                        'quotation_id'=>$quotation_info['quotation_id'],
                        'remark_user_id'=>$quotation_info['userid'][$key],
                        'comments_type'=>1
                        ));
                }
            }

            $this->db->where('quotation_id', $quotation_info['quotation_id']);
            $this->db->update('quotation', array('remark_quotation'=>$quotation_info['remarkText'],'remark_type'=>$quotation_info['remark_type'],'quotation_status'=>22));
            
            echo TRUE;
        }
        else
        {
            $return_data = '';
            foreach ($msg as $m)
            {
                $return_data .= $m.'<br/>';
            }
            echo $return_data;
        }        
    }
    
    public function quotation_list(){
        $data['columns'] = array("#SL_no","quotation_code","customer_name","quotation_date","sales_person","status","Action");
        $data['sql'] = $this->sales_model->get_quotation_list();
        $data['action'] = array("common"=>FALSE,"edit"=>"sales/new_quotation/","view"=>"sales/quotation_details/","delete"=>FALSE);
        $this->render_page('sales/quotation_order_history',$data);
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
	

    
     public function sales_order_history(){
        $data['table_data'] = $this->sales_model->getAllSalesOrderList();
        $data['title'] = 'Sales Order History';
        $this->render_page('sales/sales_order_history',$data);
     }
     
     public function send_for_approval()
     {
        $sales_id = $this->input->post('sales_id');
        $sales_code = $this->input->post('sales_code');

        $this->common_model->delegation_by_ref_insert(2,$sales_code);

        initiate_delegation($sales_code);

        $update_data = array(
            'sales_status' => 3
        );
        $where = array(
            'sales_id' => $sales_id
        );
        $this->sales_model->update_data($update_data, 'sales_order', $where);
     }

      public function save_front_desk_sales_order_block(){
        $data = $this->input->post();
        //debug($data,1);
        $front_desk_customer = array(
            "customer_name"=>$data["customer_name"],
            "mobile_number"=>$data["mobile_number"],
            "address"=>$data["address"]
        );
        $customer_id = $this->sales_model->save_data($front_desk_customer, 'customer_front_desk_sale');
        $data['sales_code'] = get_generated_code(1);
        $data['customer_id'] = $customer_id;
        $data['sales_status'] = 2;
        $data['sales_type'] = 'counter';
        unset($data["customer_name"]);
        unset($data["mobile_number"]);
        unset($data["address"]);
        unset($data["order_id"]);
        $return_id = $this->sales_model->save_data($data, 'sales_order');
       
        $return_array['code'] = $data['sales_code'];
        $return_array['id'] = $return_id;
        echo json_encode($return_array);
        exit();
     }
     
     public function update_front_desk_sales_order_block(){
         $data = $this->input->post();
         $sales_id = $this->input->post('order_id');
         $front_desk_customer_id = $this->sales_model->front_desk_customer_id($sales_id);
         $front_desk_customer = array(
            "customer_name"=>$data["customer_name"],
            "mobile_number"=>$data["mobile_number"],
            "address"=>$data["address"]
        );
         $where= array(
            'sales_id' =>$sales_id
         );
        unset($data["customer_name"]);
        unset($data["mobile_number"]);
        unset($data["address"]);
        unset($data["order_id"]);
        $this->sales_model->update_data($front_desk_customer, 'customer_front_desk_sale', array('customer_id'=>$front_desk_customer_id->customer_id));
        $update_id =  $this->sales_model->update_data($data, 'sales_order', $where);
        echo $update_id;
     }

    public function save_sales_order_block(){
        $dara = array();
        $data = $this->input->post();
        $data['sales_code'] = get_generated_code(1);
        $data['sales_status'] = 2;
        $data['sales_type'] = 'vendor';
        $data_return = $this->unset_data($data);
        $return_id = $this->sales_model->save_data($data_return, 'sales_order');
        if (!file_exists('upload/sales/'.$return_id)) {
            mkdir('upload/sales/'.$return_id, 0777, true);
        }
        $return_array['code'] = $data['sales_code'];
        $return_array['id'] = $return_id;
        echo json_encode($return_array);
        exit();
     }
     
    
     
     public function update_sales_order_block(){
         $data = $this->input->post();
         $sales_id = $this->input->post('order_id');
         $data_return = $this->unset_data($data);
         $where= array(
            'sales_id' =>$sales_id
         );
         
        $update_id =  $this->sales_model->update_data($data_return, 'sales_order', $where);
        echo $update_id;
     }
     
     public function save_sales_details() {
        $post = $this->input->post();
        $sales_order_id = $this->input->post("order_id");
        $product_id = $this->input->post("product_id");
        $sale_price = $this->input->post("purchase_price");
        $sale_price_usd = $this->input->post("purchase_price_usd");
        $price_list_id = $this->input->post("price_list_id");
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['product_id'] = $values;
            $data['sales_price_usd'] = ($sale_price_usd[$values])?$sale_price_usd[$values]:0;
            $data['sales_price'] = ($sale_price[$values])?$sale_price[$values]:0;
            $data['sales_order_id'] = $sales_order_id;
            $data['quantity'] = 1;
            $data['approve_quantity'] = 1;
            $return_id = $this->sales_model->save_data($data, 'sales_order_details');
        }
        $this->db->where("sales_id",$sales_order_id);
        $this->db->update("sales_order",array("price_list_id"=>$price_list_id));
    }
   
    
    
    public function save_quotation_details() {
        $quotation_order_id = $this->input->post("quotation_order_id");
        $product_id = $this->input->post("product_id");
        $sale_price = $this->input->post("purchase_price");
        $sale_price_usd = $this->input->post("purchase_price_usd");
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['product_id'] = $values;
            $data['quotation_price_usd'] = $sale_price_usd[$values];
            $data['quotation_price'] = $sale_price[$values];
            $data['quotation_id'] = $quotation_order_id;
            $data['quantity'] = 1;
            $return_id = $this->sales_model->save_data($data, 'quotation_details');
        }
    }
    
    public function quotation_details($quotation_id)
    {
        $data['quotation_details'] = $this->sales_model->quotation_details($quotation_id);
        $data['due'] = $this->common_model->customer_due($data['quotation_details']->customer_id);
        $data['item_list'] = $this->sales_model->quotation_item_list($quotation_id);
        $data['cost_component']=  $this->sales_model->get_cost_component_list_for_quotation($quotation_id);
        $data['remarks_history'] = $this->sales_model->remarks_history($quotation_id);
        $data['ifremarked'] = $this->sales_model->ifremarked($quotation_id);
        $data['title'] = 'Quotation Details';
        $this->render_page('sales/quotation_details', $data);
    }
    
    
    public function quotation_approval_page($quotation_id)
    {
        $data['quotation_details'] = $this->sales_model->quotation_details($quotation_id);
        $data['item_list'] = $this->sales_model->quotation_item_list($quotation_id);
        $data['remarks_history'] = $this->sales_model->remarks_history($quotation_id);
        $data['ifremarked'] = $this->sales_model->ifremarked($quotation_id);
        $data['title'] = 'Quotation Details';
        $this->render_page('sales/quotation_approval_page', $data);
    }
    
    public function waiting_for_ramark()
    {
        $data['columns'] = array("#SL_no","quotation_code","customer_name","quotation_date","sales_person","Action");
        $data['sql'] = $this->sales_model->get_waiting_for_remark_list();
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/view_single_waiting_for_remark/","delete"=>FALSE);
        $this->render_page('sales/waiting_for_remark',$data);
    }
    
    
    public function sales_approve()
    {
        $data['columns'] = array("#SL_no","sales_code","customer_name","order_date","sales_person","Action");
        $data['sql'] = $this->sales_model->get_waiting_for_approve_list();
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/view_single_sales_order_for_approval/","delete"=>FALSE);
        $this->render_page('sales/waiting_for_sales_approve',$data);
    }
    
    public function quotation_approve_list()
    {
        $data['columns'] = array("#SL_no","quotation_code","customer_name","quotation_date","sales_person","Action");
        $data['sql'] = $this->sales_model->get_waiting_for_quotation_approve_list();
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/quotation_approval_page/","delete"=>FALSE);
        $this->render_page('sales/waiting_for_remark',$data);
    }
    
    
    public function sales_approval_list()
    {
        $data['columns'] = array("#SL_no","sales_code","customer_name","order_date","sales_person","Action");
        $data['sql'] = $this->sales_model->all_sales_approved_list();
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/view_single_sales_order_approved/","delete"=>FALSE);
        $this->render_page('sales/waiting_for_sales_approve',$data);
    }
    
    public function all_sales_order()
    {
        $data['columns'] = array("#SL_no","sales_code","customer_name","order_date","sales_person","Action");
        $data['sql'] = $this->sales_model->get_waiting_for_approve_list(24);
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/sales_order_for_sale/","delete"=>FALSE);
        $this->render_page('sales/waiting_for_sales_approve',$data);
    }
    
    public function waiting_for_packing_slip()
    {
        $data['columns'] = array("#SL_no","sales_code","customer_name","order_date","sales_person","Action");
        $data['sql'] = $this->sales_model->get_waiting_for_approve_list(25);
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/sales_order_for_sale/","delete"=>FALSE);
        //$data['unschedule_sales_order'] = $this->sales_model->get_list_for_create_schedule();
        $data['schedule_code'] = $this->common_model->get_code_number('schedule');
        $data['active_schedules'] = $this->sales_model->active_schedules();
        $this->render_page('sales/waiting_for_packing_slip',$data);
    }
    
    
    public function order_list_for_create_schedule()
    {
        $schedule_id = $_POST['schedule_id'];
        $sales_id = $_POST['sales_id'];
        $sales_id_array = explode(',', $sales_id);
        $unschedule_sales_order = $this->sales_model->get_list_for_create_schedule($sales_id);
        $html = "";
        $html .= '<table class="table product_list_table">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>#Sl</th>';
        $html .= '<th>Sales Code</th>';
        $html .= '<th>Customer Name</th>';
        $html .= '<th>Sales Person</th>';
        $html .= '<th>Delivery Mode</th>';
        $html .= '<th>Order Date</th>';
        //$html .= '<th style="text-align: center;"><input type="checkbox" id="select_all"></th>';
        $html .= '<th>&nbsp;</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $sl=1;
        foreach ($unschedule_sales_order as $key=>$uso)
        {        
        $html .= '<tr>';
        $html .= '<td>'.$sl.'</td>';
        $html .= '<td>'.$uso['sales_code'].'</td>';
        $html .= '<td>'.$uso['customer_name'].'</td>';
        $html .= '<td>'.$uso['sales_person'].'</td>';
        $html .= '<td>'.$uso['delivery_mode_name'].'</td>';
        $html .= '<td>'.$uso['order_date'].'</td>';
        $html .= '<td  align="center">';
        $html .= '<input '.(in_array($uso['sales_id'],$sales_id_array)?'checked="checked"':'').' type="checkbox" name="sales_id[]" value="'.$uso['sales_id'].'">';
        $html .= '</td>';
        $html .= '</tr>';        
        $sl++;
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }
    
    public function selected_value_from_schedule_table()
    {
        $schedule_id = $_POST['schedule_id'];
        $schedule_info = $this->sales_model->svfst($schedule_id);
        echo json_encode($schedule_info);
        
    }

    public function create_delivery_schedule()
    {
        $post_info = $this->input->post();
        //debug($post_info,1);
        $this->form_validation->set_rules('schedule_no','Schedule No.','trim|required');
        $this->form_validation->set_rules('delivery_time','Delivery Date','trim|required');
        $this->form_validation->set_rules('time','Delivery Time','trim|required');
        $this->form_validation->set_rules('delivery_location','Delivery Location','trim|required');
        $this->form_validation->set_rules('delivery_van','Delivery Van','trim|required');
        $this->form_validation->set_rules('sales_id','Sales Order','required');
        //debug($post_info['sales_id'],1);
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            //debug(json_encode($post_info['sales_id']),1);
            $insert_array = array(
                    'sales_id'=>  json_encode($post_info['sales_id']),
                    'schedule_code'=>$post_info['schedule_no'],
                    'schedule_time'=> $post_info['delivery_time']." ".$post_info['time'],
                    'delivery_address_id'=>$post_info['delivery_location'],
                    'van_id'=>$post_info['delivery_van'],
                    'created_by'=>  $this->session->userdata('USER_ID'),
                    'delivery_status'=>26,
                    'status'=>1
                );
            if($post_info['schedule_id'])
            {
                $this->db->where('delivery_schedule_id', $post_info['schedule_id']);
                $result = $this->db->update('delivery_schedule', $insert_array); 
                $this->sales_model->psm_so($post_info);
                echo TRUE;
            }
            else
            {
                $result = $this->db->insert('delivery_schedule',$insert_array);
                $this->sales_model->psm_so($post_info);
                echo TRUE;
            }
        }
    }
    
    public function delivery_confirm()
    {
        $schedule_id = $_POST['schedule_id'];
        $this->sales_model->sales_order_complete($schedule_id);
        echo TRUE;
    }

    public function sales_order_sale_submit()
    {
        $order_id = $this->input->post('order_id');
        $date = date('Y-m-d');
        //die();
        
        $sod_info = $this->db->query("SELECT product_id, warranty_period FROM sales_order_details where sales_order_id=".$order_id);
        
        
        
        $this->db->trans_start();
        $this->db->query('UPDATE sales_order SET sales_status=25 WHERE sales_id='.$order_id);
        $this->db->query('UPDATE product_stock_manager SET sale_status_id=25,sold_date="'.$date.'" WHERE sale_order_id='.$order_id);
        foreach ($sod_info->result() as $sod)
        {
            $this->db->query('UPDATE product_stock_manager SET customer_warranty_period="'.$sod->warranty_period.'" WHERE sale_order_id='.$order_id.' AND product_id='.$sod->product_id);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            echo "Somthing wrong!!! Try again.";
        }
        else
        {
            echo "done";
        }
    }

    

    public function waiting_for_allocate_list()
    {
        //Khairul Made this comment
//        $data['columns'] = array("#SL_no","sales_code","customer_name","order_date","sales_person","Action");
        $data['sql'] = $this->sales_model->get_waiting_allocate_list();
        $data['action'] = array("common"=>FALSE,"edit"=>FALSE,"view"=>"sales/sales_order_approve_for_allocate/","delete"=>FALSE);
        $this->render_page('sales/waiting_for_sales_approve',$data);
    }
    
    public function sales_order_approve_for_allocate($order_id)
    {
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
        $data['cost_component']=  $this->sales_model->get_cost_component_list($order_id);
        $data['support_doc']=  $this->sales_model->get_support_doc_list($order_id);
        
        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Sales Order Details';
        //die('aj');
        $this->render_page('sales/sales_order_approve_for_allocate', $data);
        //$this->load->view('customer', $data);
    }
    
    
    public function sales_order_for_sale($order_id)
    {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        $data['cost_component']=  $this->sales_model->get_cost_component_list($order_id);
        $data['support_doc']=  $this->sales_model->get_support_doc_list($order_id);
        
        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Sales Order Details';
        $this->render_page('sales/sales_order_for_sale', $data);
    }

    public function view_single_waiting_for_remark($quotation_id)
    {
        $data['quotation_details'] = $this->sales_model->quotation_details($quotation_id);
        $data['due'] = $this->common_model->customer_due($data['quotation_details']->customer_id);
        $data['item_list'] = $this->sales_model->quotation_item_list($quotation_id);
        $data['cost_component']=  $this->sales_model->get_cost_component_list_for_quotation($quotation_id);
        $data['remarks_history'] = $this->sales_model->remarks_history($quotation_id);
        $data['ifremarked'] = $this->sales_model->ifremarked($quotation_id);
        $data['myremark'] = $this->sales_model->myremark($quotation_id);
        $data['title'] = 'Quotation Details';
        $this->render_page('sales/view_single_waiting_for_remark', $data);
    }
    
    public function view_single_sales_order_for_approval($order_id)
    {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        $data['due'] = $this->common_model->customer_due(((@$order_info->customer_id)?$order_info->customer_id:0));
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        $data['cost_component']=  $this->sales_model->get_cost_component_list($order_id);
        $data['support_doc']=  $this->sales_model->get_support_doc_list($order_id);
        
        $data['product'] = $this->sales_model->get_product_list();
        $data['mycomments'] = $this->db->query("SELECT comments FROM sales_approval_persons WHERE sales_order_id=".$order_id." AND user_id=".$this->session->userdata("USER_ID"))->row();
        $data['title'] = 'Sales Order Details';
        $this->render_page('sales/view_single_sales_order_for_approval', $data);
    }
    
    public function view_single_sales_order_approved($order_id)
    {
        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list_sales", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($order_id) {
            
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        $data['cost_component']=  $this->sales_model->get_cost_component_list($order_id);
        $data['support_doc']=  $this->sales_model->get_support_doc_list($order_id);
        
        $data['product'] = $this->sales_model->get_product_list();
        $data['mycomments'] = $this->db->query("SELECT comments FROM sales_approval_persons WHERE sales_order_id=".$order_id." AND user_id=".$this->session->userdata("USER_ID"))->row();
        $data['title'] = 'Sales Order Details';
        $this->render_page('sales/view_single_sales_order_approved', $data);
    }
    
    
    public function personal_remark_submit()
    {
        $this->form_validation->set_rules('comments','Comments','required');
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $comments = $this->input->post('comments');
            $quotation_id = $this->input->post('quotation_id');
            $data = array('comments'=>$comments,'comments_type'=>2);
            $this->db->where('quotation_id',$quotation_id);
            $this->db->where('remark_user_id',  $this->session->userdata('USER_ID'));
            $this->db->update('remark_persons', $data);
            
            $ifremarked = $this->sales_model->ifremarked($quotation_id);
            if($ifremarked == '<button class="btn btn-primary btn-sm">Print</button>')
            {
                $this->db->where('quotation_id', $quotation_id);
                $this->db->update('quotation', array('quotation_status'=>23));
            }
            
            echo TRUE;
        }
        
    }
    
    public function personal_sales_approval_submit()
    {
        $this->form_validation->set_rules('comments','Comments','required');
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $comments = $this->input->post('comments');
            $order_id = $this->input->post('order_id');
            $data = array('comments'=>$comments,'comments_type'=>2);
            $this->db->where('sales_order_id',$order_id);
            $this->db->where('user_id',  $this->session->userdata('USER_ID'));
            $this->db->update('sales_approval_persons', $data);
            
            $ifapproved = $this->sales_model->ifsalesorderapproved($order_id);
            //debug($ifapproved,1);
            if($ifapproved == 4)
            {
                $this->db->where('sales_id', $order_id);
                $this->db->update('sales_order', array('sales_status'=>24));
                //debug($this->db->last_query(),1);
            }
            
            echo TRUE;
        }
        
    }
    
    public function quotation_exchange_rate_update()
    {
        $quotation_id = $_POST['quotation_id'];
        $exchange_rate = $_POST['exchange_rate'];
        $this->db->where('quotation_id',$quotation_id);
        $this->db->update('quotation',array('exchange_rate'=>$exchange_rate));
    }

    public function save_quotation_order_block(){
        $data = $this->input->post();
        $data['quotation_status'] = 21;
        $data['quotation_code'] = $this->common_model->get_code_number('quotation');
        $data['sales_person'] = $this->session->userdata('USER_ID');
        unset($data['quotation_order_id']);
        $return_id = $this->sales_model->save_data($data, 'quotation');
        echo $return_id;
    }
    
    public function update_quotation_order_block(){
        $data = array();
        $data = $this->input->post();
        unset($data['quotation_order_id']);
         $quotation_id = $this->input->post('quotation_order_id');
         $where= array(
            'quotation_id' =>$quotation_id
         );         
        $update_id =  $this->sales_model->update_data($data, 'quotation', $where);
        //debug($this->db->last_query(),1);
        echo $update_id;
     }
     
    public function get_product_list(){
        $order_id = $this->input->post('order_id');
        $table = $this->input->post('table');
        $field = $this->input->post('field');
        $order_id = (int)$order_id;
        $data['selected_product_group'] = $this->sales_model->get_selected_product_group($order_id,$table,$field);
        $data['table'] = $table;
        $data['order_id'] = $order_id;
//        $data['selected_product'] = $this->sales_model->get_selected_product($order_id);
//        $data['order_id'] = $order_id;
        $order_info = $this->sales_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
//       echo $this->load->view("selected_product_list_sales", $data, true);
        echo $this->load->view("sales/selected_product_list", $data, true);
    }
    
    public function get_product_list_for_quotation(){
        $quotation_order_id = $this->input->post('quotation_order_id');
        $data['selected_product'] = $this->sales_model->get_selected_product_for_quotation($quotation_order_id);
        $data['quotation_order_id'] = $quotation_order_id;
        $quotation_info = $this->sales_model->get_quotation_order_info($quotation_order_id);
        $data['order_info'] = $quotation_info;
        echo $this->load->view("sales/selected_product_list_quotation", $data, true);
    }
    
    public function update_product(){
        $sales_order_id = $this->input->post('sales_order_id');
        $field_name = $this->input->post('field_name');
        $value = $this->input->post('value');
        $product_id = $this->input->post('product_id');
        $data[$field_name] = $value;
        $where = array(
            "sales_order_id" => $sales_order_id,
            "product_id" => $product_id
        );
        $this->sales_model->update_data($data,"sales_order_details",$where);
        echo 1;
    }
    
    public function update_product_quotation(){
        $quotation_id = $this->input->post('quotation_id');
        $field_name = $this->input->post('field_name');
        $value = $this->input->post('value');
        $product_id = $this->input->post('product_id');
        $data[$field_name] = $value;
        $where = array(
            "quotation_id" => $quotation_id,
            "product_id" => $product_id
        );
        $this->sales_model->update_data($data,"quotation_details",$where);
        echo 1;
    }
    
    public function add_ajax_cost_component_view(){
        $sales_id = $this->input->post('sales_id');
        $cost_component = $this->input->post('cost_component');
        $cost_value = $this->input->post('cost_value');
        $insert_data = array(
            'sales_order_id' =>$sales_id,
            'amount' => $cost_value,
            'cost_component_id' =>  $cost_component,
            'created_by' => $this->user_id
        );
        $this->sales_model->save_data($insert_data,'sales_cost_component');
//        echo $this->db->last_query();
        
        $data['cost_component_list']=$this->db->query("SELECT
            sales_cost_component.sales_cost_component_id,
            sales_cost_component.sales_order_id,
            sales_cost_component.cost_component_id,
            sales_cost_component.amount,
            cost_component.cost_component_name
            FROM
            sales_cost_component
            Left JOIN cost_component ON sales_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE sales_order_id = $sales_id")->result_array();
        
        
        echo $this->load->view('sales/add_cost_component_view',$data);
    }
    
    public function delete_cost_component(){
        $sales_order_id = $this->input->post('sales_order_id');
        $cost_component_id = $this->input->post('cost_component_id');
        $sales_cost_component_id = $this->input->post('sales_cost_component_id');
        $this->db->where("sales_cost_component_id", $sales_cost_component_id);
        $this->db->delete("sales_cost_component");
//        echo $this->db->last_query();
    }
    
    public function update_cost_component(){
        $sales_order_id = $this->input->post('sales_order_id');
        $sales_cost_component_id = $this->input->post('sales_cost_component_id');
        $cost_component = $this->input->post('cost_component');
        $cost_value = $this->input->post('cost_value');
        
        $update_data = array(
            'amount' => $cost_value,
            'cost_component_id' =>  $cost_component
        );
        $where = array("sales_cost_component_id" => $sales_cost_component_id);
        
        $this->sales_model->update_data($update_data,'sales_cost_component',$where);
        
        $data['cost_component_list']=$this->db->query("SELECT
            sales_cost_component.sales_cost_component_id,
            sales_cost_component.sales_order_id,
            sales_cost_component.cost_component_id,
            sales_cost_component.amount,
            cost_component.cost_component_name
            FROM
            sales_cost_component
            Left JOIN cost_component ON sales_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE sales_order_id = $sales_order_id")->result_array();
        
        
        echo $this->load->view('sales/add_cost_component_view',$data);
    }
    
    
    public function add_ajax_cost_component_view_for_quotation(){
        $quotation_id = $this->input->post('quotation_order_id');
        //$sales_id = $this->input->post('sales_id');
        $cost_component = $this->input->post('cost_component');
        $cost_value = $this->input->post('cost_value');
        $insert_data = array(
            'quotation_id' =>$quotation_id,
            'amount' => $cost_value,
            'cost_component_id' =>  $cost_component,
            'created_by' => $this->user_id
        );
        $this->sales_model->save_data($insert_data,'quotation_cost_component');
        
        $data['cost_component_list']=$this->db->query("SELECT
            quotation_cost_component.quotation_cost_component_id,
            quotation_cost_component.quotation_id,
            quotation_cost_component.cost_component_id,
            quotation_cost_component.amount,
            cost_component.cost_component_name
            FROM
            quotation_cost_component
            Left JOIN cost_component ON quotation_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE quotation_id = $quotation_id")->result_array();
        
        
        echo $this->load->view('sales/add_cost_component_view_for_quotation',$data);
    }
    public function update_cost_component_for_quotation(){
        $quotation_order_id = $this->input->post('quotation_order_id');
        $quotation_cost_component_id = $this->input->post('quotation_cost_component_id');
        $cost_component = $this->input->post('cost_component');
        $cost_value = $this->input->post('cost_value');
        
        $update_data = array(
            'amount' => $cost_value,
            'cost_component_id' =>  $cost_component
        );
        $where = array("quotation_cost_component_id" => $quotation_cost_component_id);
        
        $this->sales_model->update_data($update_data,'quotation_cost_component',$where);
        
        $data['cost_component_list']=$this->db->query("SELECT
            quotation_cost_component.quotation_cost_component_id,
            quotation_cost_component.quotation_id,
            quotation_cost_component.cost_component_id,
            quotation_cost_component.amount,
            cost_component.cost_component_name
            FROM
            quotation_cost_component
            Left JOIN cost_component ON quotation_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE quotation_id = $quotation_order_id")->result_array();
        
        
        echo $this->load->view('sales/add_cost_component_view_for_quotation',$data);
    }
    
    public function delete_cost_component_for_quotation(){
        $sales_order_id = $this->input->post('sales_order_id');
        $cost_component_id = $this->input->post('cost_component_id');
        $quotation_cost_component_id = $this->input->post('quotation_cost_component_id');
        $this->db->where("quotation_cost_component_id", $quotation_cost_component_id);
        //$this->db->where("cost_component_id", $cost_component_id);
        $this->db->delete("quotation_cost_component");
//        echo $this->db->last_query();
    }
    
    function ajax_file_upload(){
        $post = $this->input->post();
        $title = $post[1];
        $order_id = (int)$post[0];
        if (!file_exists('upload/purchase/'.$order_id.'/')) {
            mkdir('upload/purchase/'.$order_id.'/', 0777, true);
        }
        
        $target_dir = "upload/sales/".$order_id."/";
        $target_file = $target_dir . basename($_FILES[0]["name"]);
        
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES[0]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        if (move_uploaded_file($_FILES[0]["tmp_name"], $target_file)) {
            $insert_data= array(
                'sales_order_id'=>$order_id,
                'sales_supporting_doc_name'=>$title,
                'sales_supporting_doc_url' =>$target_file,
                'created_by' =>  $this->user_id
            );
            
            $this->sales_model->save_data($insert_data,'sales_supporting_doc');
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        
        $data['supporting_doc_list']=$this->db->query("SELECT *
            FROM `sales_supporting_doc`
            WHERE
            sales_supporting_doc.sales_order_id = $order_id")->result_array();
        
        
        echo $this->load->view('sales/supporting_doc_view',$data);
                
    }
    
    
    public function delete_supporting_doc(){
        $sales_supporting_doc_id= $this->input->post('sales_supporting_doc_id');
        $this->db->where("sales_supporting_doc_id", $sales_supporting_doc_id);
        $this->db->delete("sales_supporting_doc");
        echo 1;
    }
    
    public function save_aditional_info(){
        $order_id = $this->input->post('sales_order_id');
        $delivery_contact_number = $this->input->post('delivery_contact_number');
        $payment_type_id = $this->input->post('payment_type_id');
        $delivery_cost = $this->input->post('delivery_cost');
        $delivery_address = $this->input->post('delivery_address');
        
        $update_data= array(
            'delivery_contact_number' =>$delivery_contact_number,
            'payment_type_id' => $payment_type_id,
            'delivery_cost' =>$delivery_cost,
            'delivery_address'=> $delivery_address
        );
        
        $where = array("sales_id" => $order_id);
        
        $tt =  $this->sales_model->update_data($update_data, "sales_order", $where);
         return $tt;
    }
    
     public function update_status(){  
        $sales_order_id = $this->input->post('sales_order_id');          
        $status = $this->input->post('status');

        $update_data = array(
           'sales_status'=>$status
        );
        $where = array(
            'sales_id' =>$sales_order_id
        );
        
        $this->sales_model->update_data($update_data,'sales_order',$where); 
    }
	
	
	/*
     * Added By Rokib Hasnat
     * For Delevery Schedule
     */
    
    public function delivery_schedule(){
        
        $data['delivery_list']=array(
            array(
                'order_no'=>1101,
                'order_date'=>'2016-05-10',
                'delivery_date'=>'2016-05-26',
                'name'=>'Rokib',
                'contact_no'=>'01817895589',
                'order_val'=>20000,
                'location'=>'Mirpur',
                'address'=>'18/A, Mirpur-10, Dhaka'
            ),
            array(
                'order_no'=>1102,
                'order_date'=>'2016-05-15',
                'delivery_date'=>'2016-05-27',
                'name'=>'Arif',
                'contact_no'=>'01911587935',
                'order_val'=>10000,
                'location'=>'Banani',
                'address'=>'188, New RS Road, Banani, Dhaka'
            ),
            array(
                'order_no'=>1103,
                'order_date'=>'2016-05-18',
                'delivery_date'=>'2016-05-27',
                'name'=>'Riad',
                'contact_no'=>'01557896541',
                'order_val'=>30000,
                'location'=>'Gulshan',
                'address'=>'1356, AKM Road, Gulshan-1, Dhaka'
            ),
            array(
                'order_no'=>1104,
                'order_date'=>'2016-05-20',
                'delivery_date'=>'2016-05-26',
                'name'=>'Asif',
                'contact_no'=>'01772548963',
                'order_val'=>78000,
                'location'=>'Dhanmondi',
                'address'=>'56, Kalabagan Bosiruddin Road, Dhanmondi, Dhaka'
            ),
            array(
                'order_no'=>1105,
                'order_date'=>'2016-05-10',
                'delivery_date'=>'2016-05-30',
                'name'=>'Asif',
                'contact_no'=>'01992587934',
                'order_val'=>80000,
                'location'=>'Banani',
                'address'=>'88888/1A, Banani, Dhaka'
            )
            
        );
        
        $post = $this->input->post('print');
        
        if(!empty($post)){
            $data['print']= 'Print';
            $this->render_page('sales/print_deliver',$data);
        }  else {
            $this->render_page('sales/delivery_schedule_list',$data);
        }
//        exit();
        
//        $data['print_data']=$this->load->view('sales/print_deliver',$data);
        
        
        
    }
	
	
	
	     /* A  function to show all available product list
      * of a specific item to book product for sale
      */    
     
     public function load_available_product(){
         $product_id =$this->input->post('product_id');
         //$house = $this->input->post('house');
         $data['table_data']= $this->sales_model->get_available_product_list($product_id);
         //debug($this->db->last_query(),1);
         $data['product_id'] = $product_id;
         echo $this->load->view('sales/load_product_list',$data);
     }
     
     public function load_allocated_product(){
         $product_id = $this->input->post('product_id');
         $order_id = $this->input->post('order_id');
         $data['table_data'] = $this->sales_model->get_allocated_product_list($product_id,$order_id);
         echo $this->load->view('sales/load_allocated_list',$data);
     }
     
     public function available_product_list($order_id){
        //$ordered_info = $this->sales_model->get_ordered_info($order_id);;
        //$data['table_data'] = $ordered_info;
        $data['order_id'] = $order_id;  
        $product_list = $this->sales_model->get_ordered_product($order_id);
        
        $allocation = $this->sales_model->get_alocation_info($order_id);
        $allocation_array =[];
        foreach($allocation as $val){
            $allocation_array[$val['product_id']]['name'] = $val['product_name'];
            $allocation_array[$val['product_id']]['qty'] = $val['qty'];
            //$allocation_array[$val['product_id']]['p_id'] = $val['product_id'];
        }
        $final_array=[];
        foreach($product_list as $key=>$val){
           $final_array[$val['product_id']]['name'] = $val['product_name'];
           $final_array[$val['product_id']]['qty'] = isset($allocation_array [$val['product_id']]['qty'])? $allocation_array [$val['product_id']]['qty']:0;
           $final_array[$val['product_id']]['p_id'] = $val['product_id'];
        }
        $data['product_list'] = $product_list;
        $data['allocation_array'] = $final_array;
        $data['approval_position'] = $this->db->query("SELECT sales_status FROM sales_order WHERE sales_id=".$order_id)->row();
        //debug();
        //debug($product_list[0]['quantity']);
        //debug($final_array,1);
        $data['title'] = 'Available Product List';
        $this->render_page('sales/available_product_list',$data); 
     }
     
     
    public function send_for_sales_order_approve()
    {
        $post_data = $this->input->post();
        $order_id = $this->input->post('order_id');
        $this->form_validation->set_rules('remark_type','Approval Person Type','required');
        if(isset($post_data['remark_type']) && ($post_data['remark_type'] == 2))
        {
            $this->form_validation->set_rules('userid','Approval Person','required');
        }
        if ($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            if($post_data['remark_type'] == 1)
            {
                $this->db->delete('sales_approval_persons', array('sales_order_id' => $order_id)); // before insert sales_approval_person delete all row by quotation id
                $default_user = $this->sales_model->get_default_quotation_approval_person(3); // here 3 = approve_for_id from approve_for table
                foreach($default_user->result() as $du)
                {
                        $this->db->insert('sales_approval_persons', array(
                            'sales_order_id'=>$order_id,
                            'user_id'=>$du->userid,
                            'comments_type'=>1
                            )); 
                }
                $this->db->where('sales_id', $order_id);
                $this->db->update('sales_order', array('approval_type'=>$post_data['remark_type'],'sales_status'=>3));
                echo "done";
            }
            else if($post_data['remark_type'] == 2)
            {
                $this->db->delete('sales_approval_persons', array('sales_order_id' => $order_id)); // before insert sales_approval_person delete all row by quotation id
                foreach ($post_data['userid'] as $key=>$cs)
                {
                    $this->db->insert('sales_approval_persons', array(
                            'sales_order_id'=>$order_id,
                            'user_id'=>$post_data['userid'][$key],
                            'comments_type'=>1
                            ));
                }
                $this->db->where('sales_id', $order_id);
                $this->db->update('sales_order', array('approval_type'=>$post_data['remark_type'],'sales_status'=>3));
                echo "done";                
            }
        }
    }
     
        public function sales_status_change($status){
        //echo $status;
        $data = $this->input->post();
        $serial_no;
        $p_code;
        foreach($data['data'] as $val){
           $serial_no = $val['serial_no'];
           $p_code = $val['p_code'];
           $order_id = $val['order_id'];
           echo $this->sales_model->sales_status_change($p_code,$serial_no,$status,$order_id);
       }    
    }
	
	
	    /*
     * Demo Static page created by charlie
     * later this will be dynamic
     */
    public function payment_receive(){
        //$data['table_data'] = $this->sales_model->get_all_sales_order_history();
        $data['title'] = 'Payment Details';
        $this->render_page('sales/payment_receive',$data);  
    }
	
	    public function payment_receipt(){
        $data['title'] = 'Payment Receipt';
        $this->render_page('sales/payment_receipt',$data); 
    }
     
    
    /*******************************************/
    
    
    public function new_quotation($quotation_id = NULL) {
        $data['selected_product'] = $this->sales_model->get_selected_product_for_quotation($quotation_id);
        $data['quotation_id'] = $quotation_id;
        
        $data['selected_product_list'] = $this->load->view("sales/selected_product_list_quotation", $data, true);
        $data['vendor'] = $this->sales_model->get_vendor_list();
        if ($quotation_id) {
            $quotation_info = $this->sales_model->get_quotation_order_info($quotation_id);
            $data['due'] = $this->common_model->customer_due($quotation_info->customer_id);
            $data['quotation_info'] = $quotation_info;
            
            $data['status'] = $quotation_info->status_name;
            $data['remark_type'] = $quotation_info->remark_type;
            $data['level_array'] = $this->sales_model->quotation_approval_persons($quotation_id);
            $data['update_quotation_id'] = $quotation_id;
            $data['remark_complete'] = $this->sales_model->ifremarked($quotation_id);
            
            $data['cost_component_list']=  $this->sales_model->get_cost_component_list_for_quotation($quotation_id);
        } else {
            $data['status'] = '';
            $data['remark_type'] = 0;
            $data['remark_complete'] = '';
        }
        $data['product'] = $this->sales_model->get_product_list();
        $data['title'] = 'Create New Quotation';
        $this->render_page('sales/new_quotation', $data);
    }

}
