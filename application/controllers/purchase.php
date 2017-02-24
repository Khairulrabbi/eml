<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('purchase_model');
        $this->load->model('deligation_model');
        $this->load->model('common_model');
    }

    /* ----------------------------------------------------------------------------------------- */

    public function add_new($order_id = NULL) {
        if(isset($_GET['c']))
        {
            $data['cart_value'] = $_GET['c'];
            //$data['selected_product'] = $this->purchase_model->get_cart_product_list();
            $data['table'] = 'region';
            $data['selected_product_group'] = $this->purchase_model->get_cart_product_list('region','region_name');
        }
        else
        {
            $data['table'] = 'region';
            if($order_id)
            {
                $data['selected_product_group'] = $this->purchase_model->get_selected_product_group($order_id,'region','region_name');
            }
            //$data['selected_product'] = $this->purchase_model->get_selected_product($order_id);
        }
        
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list", $data, true);
        $data['vendor'] = $this->purchase_model->get_vendor_list();
//        echo '<pre>';
//        print_r($data['vendor']);
//        exit();
        if ($order_id) {
            $data['status'] = $order_info->status_name;
            //$data['purchase_code'] = $order_info->purchase_code;
            $data['cost_component']=  $this->purchase_model->get_cost_component_list($order_id);
            $data['supporting_doc_list']=  $this->purchase_model->get_support_doc_list($order_id);
        } else {
            //$data['purchase_code'] = $this->common_model->get_code_number('purchase');
            $data['status'] = 'Draft';
            $data['last_exchange_rate']= $this->purchase_model->last_purchase_exchange_rate();
        }

        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Create Purchase Order';
        $this->render_page('purchase/purchase_form', $data);
    }
    
    
    public function purchase_order_from_cart($type)
    {        
        $user_id = $this->session->userdata("USER_ID");
        $purchase_code = get_generated_code(2); 
        $purchase_order = array(
            'purchase_code'=>$purchase_code,
            'order_date'=>date('Y-m-d'),
            'currency_id'=>144,
            'status'=>5,
            'exchange_rate'=>80,
            'purchase_type_id'=>4,
            'created_by' => $this->session->userdata("USER_ID")
        );
        $this->db->insert('purchase_order',$purchase_order);
        $order_id = $this->db->insert_id();
        
        $rows = $this->db->query("SELECT * FROM product WHERE product_id IN (SELECT product_id FROM cart WHERE type='".$type."' AND user_id='".$user_id."')");
        
        foreach ($rows->result() as $row)
        {
            $purchase_order_details = array(
                'purchase_order_id'=>$order_id,
                'purchase_price'=>$row->unit_price,
                'purchase_price_usd'=>$row->unit_price_usd,
                'product_id'=>$row->product_id,
                'quantity'=>1,
                'confirm_quantity'=>1,
                'total_received'=>0,
                'receive_status'=>6
            );
            $this->db->insert('purchase_order_details',$purchase_order_details);
        }
        $this->db->where("type",$type);
        $this->db->where("user_id",$user_id);
        $this->db->delete('cart');
        redirect(base_url().'purchase/add_new/'.$order_id.'/?p_code='.$purchase_code);
    }

    

        public function save_purchase_for_purchase_order_block(){        
        //$this->form_validation->set_rules('purchase_code', 'PO Number', 'trim|required');
        $this->form_validation->set_rules('order_date', 'PO Date', 'trim|required');
        //$this->form_validation->set_rules('indent_number', 'Indent Number', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $data = $this->input->post();
            $data['status'] = 5; // 5=pi draft
            $data['purchase_type_id'] = 4; // 4=lc purchase
            $data['purchase_code'] = get_generated_code(2); 
            $data['created_by'] = $this->session->userdata("USER_ID");
            $data_return = $this->unset_data($data);
            //debug($data_return,1);
            $return_id = $this->purchase_model->save_data($data_return, 'purchase_order');
            if (!file_exists('upload/purchase/'.$return_id)) {
                mkdir('upload/purchase/'.$return_id, 0777, true);
            }
            $return_array['code'] = $data['purchase_code'];
            $return_array['id'] = $return_id;
            echo json_encode($return_array);
            exit();
        }    
    }
	
	public function update_purchase_for_purchase_order_block(){
//        $data = array();
        $order_id = $this->input->post('order_id');
        $data['vendor_id'] = $this->input->post('vendor_id');
        $data['order_date'] = $this->input->post('order_date');
        $data['lc_number'] = $this->input->post('lc_number');
        $data['lc_value'] = $this->input->post('lc_value');
        $data['bill_of_entry'] = $this->input->post('bill_of_entry');
        $data['bill_of_lading'] = $this->input->post('bill_of_lading');
        $data['lc_settlement_duration'] = $this->input->post('lc_settlement_duration');
        $data['lc_settlement_date'] = $this->input->post('lc_settlement_date');
        $data['purchase_type_id'] = $this->input->post('purchase_type_id');
        
        $where = array("purchase_id" => $order_id);
        $this->purchase_model->update_data($data, 'purchase_order', $where);
        echo $order_id;
    }
    
    
    
    
    /*
     * edit by rokib hasnat 22-5-2016
     */
    
    public function update_product(){
        $order_details_id = $this->input->post('order_details_id');
        $field_name = $this->input->post('field_name');
        $value = $this->input->post('value');
        $product_id = $this->input->post('product_id');
        $data[$field_name] = $value;
        $data['confirm_quantity'] = $value;
        $where = array(
            "purchase_order_id" => $order_details_id,
            "product_id" => $product_id
        );
        $this->purchase_model->update_data($data,"purchase_order_details",$where);
        echo 1;
    }
    //---------------------End ------------------------//
    /*
     */
    public function get_product_list(){
        $order_id = $this->input->post('order_id');
        $table = $this->input->post('table');
        $field = $this->input->post('field');
        $order_id = (int)$order_id;
        //$data['selected_product'] = $this->purchase_model->get_selected_product($order_id,"product_group_id");
        $data['selected_product_group'] = $this->purchase_model->get_selected_product_group($order_id,$table,$field);
        $data['table'] = $table;
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
        echo $this->load->view("selected_product_list", $data, true);
    }
    
    public function get_product_list_confirm_page(){
        $order_id = $this->input->post('order_id');
        $table = $this->input->post('table');
        $field = $this->input->post('field');
        $order_id = (int)$order_id;
        $data['purchase_order_status'] = $this->purchase_model->purchase_order_status($order_id);
        $data['selected_product_group'] = $this->purchase_model->get_selected_product_group($order_id,$table,$field);
        $data['table'] = $table;
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
        echo $this->load->view("purchase/selected_product_list_confirm_page", $data, true);
    }
    //---------------------End ------------------------//

    public function order_details($order_id = NULL) {
        
        $data['selected_product'] = $this->purchase_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
        $data['table'] = 'region';
        $data['selected_product_group'] = $this->purchase_model->get_selected_product_group($order_id,'region','region_name');
        $data['purchase_order_status'] = $this->purchase_model->purchase_order_status($order_id);
        
        $data['selected_product_list'] = $this->load->view("selected_product_list", $data, true);
        $data['vendor'] = $this->purchase_model->get_vendor_list();
        if ($order_id) {
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        $data['proforma_invoice_info'] = $this->purchase_model->proforma_invoice_info($order_id);
        $data['cost_component']=  $this->purchase_model->get_cost_component_list($order_id);
        $data['support_doc']=  $this->purchase_model->get_support_doc_list($order_id);
        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Purchase Order Details';
        $data['order_info'] = $order_info;
        
        $code = $order_info->purchase_code;
        $data['approve_history'] = $this->purchase_model->get_approve_history($code);
        $data['current_approval_location'] = $this->common_model->get_waiting_approval_list($this->session->userdata("USER_ID"),"purchase",$code);
        $this->render_page('purchase/purchase_detais', $data);
    }
    
    
//    public function waiting_approval_list(){
//        $user_id = $this->session->userdata("USER_ID");
//        $data['sql'] = $this->purchase_model->get_waiting_approval_list($user_id);
//        $this->render_page('purchase/waiting_approval_list_view', $data);
//    }
    
    
    public function proforma_invoice()
    {
        $data['proforma_invoice_info'] = $this->purchase_model->proforma_invoice_info();
        $this->render_page('purchase/proforma_invoice', $data);
    }
    public function receive_history()
    {
        $data['good_receive'] = $this->purchase_model->get_receive_history();
        $this->render_page('purchase/receive_history', $data);
    }
    
    
    public function proforma_invoice_details($proforma_invoice_details,$table='region',$fiels='region_name')
    { 
        $data["pi_info"] = $this->purchase_model->get_purchase_order_id_from_proforma_invoice($proforma_invoice_details);
        $data['supporting_doc_list'] = $this->purchase_model->pi_supporting_doc_list($data["pi_info"]->purchase_order_id,$proforma_invoice_details);
        $data['purchase_prices'] = $this->purchase_model->purchase_prices_for_proforma($proforma_invoice_details);
        $data['pidid'] = $proforma_invoice_details;
        $data['table'] = $table;
        $data['selected_product_group'] = $this->purchase_model->get_selected_product_group(NULL,$table,$fiels,$proforma_invoice_details);
        $data['fob_group'] = $this->purchase_model->get_fob_group($proforma_invoice_details);
        $data['payable_list'] = $this->purchase_model->get_payable_payment_list($proforma_invoice_details);
        $data['good_receive'] = $this->purchase_model->get_good_receive_info($proforma_invoice_details);
       
        //$data['status'] = $this->purchase_model->get_status($proforma_invoice_details);
        $this->render_page('purchase/proforma_invoice_details', $data);
    }
    
    public function proforma_invoice_details_load_view($id){
        $data['payable_list'] = $this->purchase_model->get_payable_payment_list($id);
        $this->load->view("purchase/proforma_invoice_details_payable_payment_ajax_view",$data);
    }
    
    
    public function fob_product_details_view_ajax_page()
    {
        
        $data['sql'] = $this->purchase_model->fob_product_details_sql($this->input->post('p_invoice'),$this->input->post('p_group_id'));
        $data['p_group_name'] = $this->input->post('p_group_name');
        $this->load->view("purchase/fob_product_details_view_ajax_page",$data);
    }
    
    public function fob_costing_setting_view_ajax_page()
    {
        $p_invoice_id = $this->input->post('p_invoice');
        $product_group_id = $this->input->post('p_group_id');
        $data['p_group_name'] = $this->input->post('p_group_name');
        $data['p_group_id'] = $this->input->post('p_group_id');
        $data['p_invoice_id'] = $this->input->post('p_invoice');
        $data['sql'] = $this->purchase_model->fob_costing_setting_sql($product_group_id);
        $this->load->view("purchase/fob_costing_setting_view_ajax_view",$data);
    }
    
    
    public function purchase_product_fob_details_save()
    {
        $p_group_id = $this->input->post("p_group_id");
        $p_invoice_id = $this->input->post("p_invoice_id");
        $sql_fcs = $this->purchase_model->fob_costing_setting_sql($p_group_id);
        $sql_pig = $this->purchase_model->get_product_invoice_group_wise($p_invoice_id,$p_group_id);
        $ppfd_array2 = array();
        foreach ($sql_pig->result() as $pig_key=>$pig_val)
        {
            $this->db->where("purchase_order_details_id",$pig_val->purchase_order_details_id);
            $this->db->delete("purchase_product_fob_details");
            $amount_array = array();
            foreach ($sql_fcs->result() as $fcs_key=>$fcs_val)
            {
                if($fcs_val->row_index == 'A')
                {
                    $amount_array['A'] = $pig_val->purchase_price_usd;
                }
                else
                {
                    $amount_array[$fcs_val->row_index] = $this->purchase_model->get_amount($amount_array,$fcs_val->value_of,$fcs_val->formula_on);
                }
                $ppfd_array['purchase_order_details_id'] = $pig_val->purchase_order_details_id;
                $ppfd_array['row_index'] = $fcs_val->row_index;
                $ppfd_array['cost_details'] = str_replace("#", $fcs_val->value_of, $fcs_val->fob_name).(($fcs_val->formula_on != "")?" On ".$fcs_val->formula_on:"");
                $ppfd_array['amount'] = $amount_array[$fcs_val->row_index];
                $ppfd_array['created_by'] = $this->session->userdata("USER_ID");
                //array_push($ppfd_array2, $ppfd_array);
                $this->db->insert("purchase_product_fob_details",$ppfd_array);
            }
        }
        //debug($amount_array,1);
        //debug($ppfd_array2,1);
        //$this->db->insert("purchase_product_fob_details",$ppfd_array2);
        
    }
    
    public function save_proforma_details()
    {
        $post = $this->input->post();
        //debug($post,1);
        if (!file_exists('upload/purchase/'.$post['purchase_order_id'].'/'.$post['proforma_invoice_id'])) {
            mkdir('upload/purchase/'.$post['purchase_order_id'].'/'.$post['proforma_invoice_id'], 0777, true);
        }
        $insert_data = array(
            'lc_number'=>$post['lc_number'],
            'lc_value_usd'=>$post['lc_value_usd'],
            'lc_value_bdt'=>$post['lc_value_bdt'],
            'shipping_advise'=>$post['shipping_advice'],
            'remarks'=>$post['remarks'],
            'lc_settlement_date'=>$post['lc_settlement_date'],
            'shipping_date'=>$post['shipping_date'],
            'lc_settlement_duration'=>(int)$post['lc_settlement_duration'],
            'pi_status'=>48,
            'updated_by'=>$this->session->userdata('USER_ID')            
        );
        $where = array("proforma_invoice_id" => $post['proforma_invoice_id']);
        $return_id = $this->purchase_model->update_data($insert_data, 'proforma_invoice', $where);
        echo TRUE;
    }

    public function purchase_goods_receive()
    {
        $post = $this->input->post();
        $this->db->select("total_received");
        $this->db->from("purchase_order_details");
        $this->db->where("proforma_invoice_id",$post['proforma_invoice_id']);
        $this->db->where("purchase_order_id",$post['purchase_id']);
        $this->db->where("purchase_order_details_id",$post['podid']);
        $row = $this->db->get()->row();
        
        $pgr_data = array(
            'purchase_id'=>$post['purchase_id'],
            'purchase_order_details_id'=>$post['podid'],
            'product_id'=>$post['product_id'],
            'indent_number'=>$post['proforma_invoice_name'],
            'warehouse_id'=>3,
            'receive_quantity'=>$post['new_recieve'],
            'available_quantity'=>$post['new_recieve'],
            'good_receive_status_id'=>45, // here 45 means received
            'recieve_ack_date'=>$post['recieve_ack_date'],
            'created_by'=>  $this->session->userdata('USER_ID')
        );
        $this->db->insert("purchase_good_receive",$pgr_data);
        
//        this status only purchase group
        $status = 14;
        if($post['hi_order_quantity'] == ($post['new_recieve']+$post['recieve']))
        {
            $status = 15;
        }
        $this->db->where("purchase_order_details_id",$post['podid']);
        $this->db->update("purchase_order_details",array("total_received"=>($post['new_recieve']+$row->total_received),"receive_status"=>$status));
        
        $pstatus = $this->common_model->total_goods_receive_for_status($post['proforma_invoice_id']);
        $this->db->where("proforma_invoice_id",$post['proforma_invoice_id']);
        $this->db->update("proforma_invoice",array("pi_status"=>$pstatus));
        echo TRUE;
    }

    public function update_confirm_order()
    {
        $post = $this->input->post();
        $this->db->where("purchase_order_details_id",$post['purchase_order_details_id']);
        $this->db->update("purchase_order_details",array("confirm_quantity"=>$post['confirm_qty']));
    }
    
    public function vendor_confirm_submit()
    {
        $post = $this->input->post();
        $this->db->where('purchase_id',$post['order_id']);
        $this->db->update('purchase_order',array('status'=>49));
        
        foreach ($post['purchase_order_details_id'] as $podid)
        {            
            $this->db->where('purchase_order_details_id',$podid);
            $this->db->update('purchase_order_details',array('receive_status'=>49));
        }
        echo TRUE;
    }
    
    public function get_pi_list()
    {
        $post = $this->input->post();
        //debug($post,1);
        echo json_encode($post);
        exit();
    }
    
    public function save_proforma_invoice()
    {
        $post = $this->input->post();
        $product_details_id = explode(',', $post['porder_details_id']);
        $this->db->insert("proforma_invoice",array(
            "indent_number"=>$post["indent_number"],
            "purchase_order_id"=>$post["porder_id"],
            "created_by"=>$this->session->userdata("USER_ID"),
            "pi_status"=>47
        ));
        $proforma_invoice_id = $this->db->insert_id();
        
        foreach ($product_details_id as $pdi)
        {
            $this->db->where("purchase_order_details_id",$pdi);
            $this->db->update("purchase_order_details",array("proforma_invoice_id"=>$proforma_invoice_id));
        }
        
        $this->purchase_model->check_and_update_purchase_order($post["porder_id"]);
        
        echo TRUE;
        
    }

    public function get_code() {
        return 'PO-'.rand(0001,9999).'-'.rand(001,999);
    }

    public function save_order_details() {
        $purchase_order_id =(int)$this->input->post("order_id");
        $product_id = $this->input->post("product_id");
        $purchase_price_usd = $this->input->post("purchase_price_usd");
        $purchase_price = $this->input->post("purchase_price");
        $purchase_type = $this->db->query("SELECT purchase_type_id FROM purchase_order WHERE purchase_id=".$purchase_order_id." GROUP BY purchase_id")->row();
        if($purchase_type->purchase_type_id == 1)
        {
            $purchase_status = 16;
        }
        else if($purchase_type->purchase_type_id == 4)
        {
            $purchase_status = 6;
        }
        
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['product_id'] = $values;
            $data['purchase_price_usd'] = floatval($purchase_price_usd[$values]);
            $data['purchase_price'] = floatval($purchase_price[$values]);
            $data['purchase_order_id'] = $purchase_order_id;
            $data['quantity'] = 1;
            $data['confirm_quantity'] = 1;
            $data['receive_status'] = $purchase_status;
            $return_id = $this->purchase_model->save_data($data, 'purchase_order_details');
        }
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
        //debug($data['purchase_price'],1);
        $this->purchase_model->update_data($data, "purchase_order_details", $where);
    }
    
    public function update_product_details_usd() {
        $order_details_id = $this->input->post('order_details_id');
        $where = array("purchase_order_details_id" => $order_details_id);
        $data = $this->input->post();
        unset($data['order_details_id']);
        $this->purchase_model->update_data($data, "purchase_order_details", $where);
    }

    public function update_order($order_id = NULL) {
        //echo "<pre>";
//        print_r($this->input->post());
//     exit();
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
        //debug($this->db->last_query(),1);
        if($query->num_rows() > 0)
        {
            $row = $this->db->query("SELECT
                            Sum(purchase_order_details.purchase_price) AS total
                            FROM
                            purchase_order_details
                            WHERE
                            purchase_order_details.purchase_order_id = ".$order_id)->row();
            $this->db->where("purchase_id",$order_id);
            $this->db->update("purchase_order",array("order_value"=>$row->total));
        }
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
        unset($data['order_name']);
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
//        $where =array();
        $data['table_data'] = $this->purchase_model->get_all_purchase_history();
        $data['title'] = 'Purchase History';
        $this->render_page('purchase/purchase_history',$data);
     }

     public function current_purchase_search()
       {
           $post = $this->input->post();
           $where =array();
           foreach ($post as $k=>$pv)
           {
               if($pv)
               {
                   $where[$k] = $pv;
               }
           }
           $data['table_data'] = $this->purchase_model->get_all_purchase_history($where);
           $this->load->view("purchase/current_purchase_view_ajax_list",$data);
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
            $data['bill_of_lading'] = $order_info->bill_of_lading;
            $data['data_exist'] = true;
            $data['exchange_rate'] = $order_info->exchange_rate;
        } else {
            $data['data_exist'] = false;
        }
		
        $data['product'] = $this->purchase_model->get_packing_slip_data($order_id);
        $data['order_id'] = $order_id;
        $data['title'] = 'Packing Slip Details';
        $this->render_page('purchase/packing_slip_detail', $data);
        
    }
    
/*Make some Change for requirement change
     * 
     */
    public function get_serial_number(){
        $post = $this->input->post();
        $received = $post['new_received'];
        $product_id =  $post['product_id'];
        $purchase_order_id = $post['order_id'];
		
		$order_info = $this->purchase_model->get_order_info($purchase_order_id);
		
        for($i=1; $i<=$received; $i++){
           $product_code[] = $this->generate_random_string(8);
        }
            $month= $post['warranty_period'];

            $priod= "+".$month." month";
            $date = $post['warranty_start_date'];

            $insert_array = array(
                'product_name'=>$post['product_name'],
                'new_received' =>$post['new_received'],
                'serviceTag' => $post['serviceTag'],
                'vendor_id' =>$post['vendor_id'],
                'product_id' =>$post['product_id'],
                'purchase_id' =>$post['order_id'],
                'purchase_price_usd' =>$post['unit_price_usd'],
                'purchase_price' =>$post['unit_price'],
                'warranty_start_date' =>$post['warranty_start_date'],
                'warranty_period' =>$post['warranty_period'],
                'warranty_expired_on' =>date("Y-m-d", strtotime(str_replace('-','/', $date). $priod)),
                'packing_slip_date' =>date('Y-m-d')
            );
            
           // $this->purchase_model->save_data($insert_array,'product_stock_manager');
//        }
        
//        $update_data = array(
//            'total_received'=>'total_received'+$received
//        );
//        $where = array(
//            'purchase_order_id' =>$post['order_id'],
//            'product_id'=>$post['product_id']
//        );
//        
//        $this->purchase_model->update_data($update_data,'purchase_order_details',$where);

        $data['title'] = 'Packing Serial Details';
        $data['insert_array']=$insert_array;
        $data['product_code']=$product_code;
        $data['order_info'] = $order_info;
        //$data['products_data']=  $this->purchase_model->get_stock_manager_data($purchase_order_id);
        
        $this->render_page('purchase/product_stock_manager_view',$data);
    }
	
	public function insert_serial_no() {
        $data = $this->input->post();
        $received = $data['new_received'];
		$purchas_type_id = $data['purchase_type_id'];
		
		if($purchas_type_id==1){
			$status = 13;
		}else{
			$status = 9;
		}
		
        for($i=0;$i<count($data['serial_number']);$i++){
            $data_array =array(
                'product_id' => $data['product_id'],
                'service_tag_number' => $data['serviceTag'], 
                'purchase_id' => $data['purchase_id'],
                'vendor_id' =>$data['vendor_id'],
                'sale_status_id'=>19,
                'status_id' =>$status,
                'purchase_price_usd' => $data['purchase_price_usd'],
                'purchase_price' => $data['purchase_price'],
                'purchase_date' => date("Y-m-d"),
                'warranty_start_date' => $data['warranty_start_date'],
                'warranty_period' => $data['warranty_period'],
                'warranty_expired_on' =>$data['warranty_expired_on'],
                'packing_slip_date' => $data['packing_slip_date'],
                'product_code' =>$data['product_code'][$i],
                'serial_number' =>$data['serial_number'][$i],
                'created_by' => $this->session->userdata('USER_ID')
            );
            $this->purchase_model->save_data($data_array, 'product_stock_manager'); 
            $this->db->where('purchase_order_id', $data['purchase_id']);
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('purchase_order_details', array('receive_status'=>12));
        }
        
         $purchase_id = $data['purchase_id'];
         $product_id = $data['product_id'];
        $this->purchase_model->update_received($received,$purchase_id,$product_id);
                
          /*change status if all packing serial list is recieeve
           * 
           */ 
                //$purchase_id = $data['purchase_id'];
          
                $check=$this->purchase_model->update_purchase_status($purchase_id,$purchas_type_id);
        
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
        $order_id = $this->input->post('order_id');
        $order_id = (int)$order_id;
        $cost_component = $this->input->post('cost_component');
        $cost_value_usd = $this->input->post('cost_value_usd');
        $cost_value = $this->input->post('cost_value');
        $insert_data = array(
            'purchase_order_id' =>$order_id,
            'total_cost_usd' => $cost_value_usd,
            'total_cost' => $cost_value,
            'cost_component_id' =>  $cost_component,
            'created_by' => $this->user_id
        );
        //debug($cost_value_usd,1);
        $this->purchase_model->save_data($insert_data,'purchase_cost_component');
        
        $data['cost_component_list']=$this->db->query("SELECT
            purchase_cost_component.purchase_cost_component_id,
            purchase_cost_component.purchase_order_id,
            purchase_cost_component.cost_component_id,
            purchase_cost_component.total_cost_usd,
            purchase_cost_component.total_cost,
            cost_component.cost_component_name
            FROM
            purchase_cost_component
            Left JOIN cost_component ON purchase_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE purchase_order_id = $order_id")->result_array();
        
        
        echo $this->load->view('purchase/add_cost_component_view',$data);
    }
    
    public function delete_cost_component(){
        $order_details_id = $this->input->post('order_details_id');
        $cost_component_id = $this->input->post('cost_component_id');
        $purchase_cost_component_id = $this->input->post('purchase_cost_component_id');
        $order_id = $this->input->post('order_id');
        $this->db->where("purchase_cost_component_id", $purchase_cost_component_id);
        //$this->db->where("cost_component_id", $cost_component_id);
        $this->db->delete("purchase_cost_component");
        //echo 1;
        
        
        $data['cost_component_list']=$this->db->query("SELECT
            purchase_cost_component.purchase_cost_component_id,
            purchase_cost_component.purchase_order_id,
            purchase_cost_component.cost_component_id,
            purchase_cost_component.total_cost_usd,
            purchase_cost_component.total_cost,
            cost_component.cost_component_name
            FROM
            purchase_cost_component
            Left JOIN cost_component ON purchase_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE purchase_order_id = $order_id")->result_array();
        
        
        echo $this->load->view('purchase/add_cost_component_view',$data);
    }
    
    public function update_cost_component(){
        $order_id = $this->input->post('order_id');
        $order_id = (int)$order_id;
        $cost_component = $this->input->post('cost_component');
        $purchase_cost_component_id = $this->input->post('purchase_cost_component_id');
        $cost_value_usd = $this->input->post('cost_value_usd');
        $cost_value = $this->input->post('cost_value');
        
        $update_data = array(
            'total_cost_usd' => $cost_value_usd,
            'total_cost' => $cost_value,
            'cost_component_id' =>  $cost_component
        );
        $where = array("purchase_order_id" => $order_id,'purchase_cost_component_id'=>$purchase_cost_component_id);
        
        $this->purchase_model->update_data($update_data,'purchase_cost_component',$where);
        $data['cost_component_list']=$this->db->query("SELECT
            purchase_cost_component.purchase_cost_component_id,
            purchase_cost_component.purchase_order_id,
            purchase_cost_component.cost_component_id,
            purchase_cost_component.total_cost_usd,
            purchase_cost_component.total_cost,
            cost_component.cost_component_name
            FROM
            purchase_cost_component
            Left JOIN cost_component ON purchase_cost_component.cost_component_id = cost_component.cost_component_id
            WHERE purchase_order_id = $order_id")->result_array();
        
        
        echo $this->load->view('purchase/add_cost_component_view',$data);
    }
    
    function ajax_upload(){
        
        $post = $this->input->post();
        
//        debug($post,1);
        $title = $post[1];
        $order_id = $post[0];
        $order_id = (int)$order_id;
        
        if (!file_exists('upload/purchase/'.$order_id.'/')) {
            mkdir('upload/purchase/'.$order_id.'/', 0777, true);
        }
        
        $target_dir = "upload/purchase/".$order_id."/";
        //$target_file = $target_dir . basename($_FILES[0]["name"]);
        $array = explode('.', $_FILES[0]["name"]);
        $fileName=$array[0];
        $fileExt=$array[1];
        
        
        //$date = date('Y-m-d H-i-s');
        // = new DateTime;
        //$timestamp = $date->setTimestamp(date('Y-m-d H-i-s'));
        
       // $date = date('Y-m-d H:i:s');
        //$date1 = strtotime($date);
        
        $target_file=$target_dir.$fileName."_". time().".".$fileExt;
        //date('Y-m-d_H-i-s', $timestamp);
        //echo $target_file;
       
        
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
                'purchase_order_id'=>$order_id,
                'purchase_supporting_doc_name'=>$title,
                'purchase_supporting_doc_url' =>$target_file,
                'created_by' =>  $this->user_id
            );
                    //echo $insert_data['purchase_supporting_doc_url'];

            
            $this->purchase_model->save_data($insert_data,'purchase_supporting_doc');
//            echo $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
		
            $data['supporting_doc_list']=$this->db->query("SELECT *
            FROM `purchase_supporting_doc`
            WHERE
            purchase_supporting_doc.purchase_order_id = $order_id")->result_array();
        
        
        echo $this->load->view('purchase/supporting_doc_view',$data);
                
    }
    
    public function proforma_invoice_ajax_upload(){        
        $post = $this->input->post();
        $purchase_order_id = $post['purchase_order_id'];
        $proforma_invoice_id = $post['proforma_invoice_id'];
        
        //debug($post,1);
        if (!file_exists('upload/purchase/'.$purchase_order_id.'/'.$proforma_invoice_id)) {
            mkdir('upload/purchase/'.$purchase_order_id.'/'.$proforma_invoice_id, 0777, true);
        }
        if($_FILES["userfile"])
        {
            if($_FILES["userfile"]['name']!='')
            {
                $config['upload_path'] = "./upload/purchase/".$purchase_order_id."/".$proforma_invoice_id."/";
                $config['allowed_types'] = '*';
                $this->upload->initialize( $config );
                if ( ! $this->upload->do_upload() )
                {
                    echo $this->upload->display_errors();
                    die();
                }
                else
                {
                    $image_info = $this->upload->data();
                    $post['purchase_supporting_doc_url'] = "./upload/purchase/".$purchase_order_id."/".$proforma_invoice_id."/".$image_info['file_name'];
                }
            }
            else 
            {
                unset($post['imgInp']);
            }
        }
        
        $post['created_by'] = $this->session->userdata('USER_ID');
        $this->purchase_model->save_data($post,'purchase_supporting_doc');
        
		
        $data['supporting_doc_list']=$this->db->query("SELECT *
        FROM `purchase_supporting_doc`
        WHERE
        purchase_supporting_doc.purchase_order_id = $purchase_order_id AND purchase_supporting_doc.proforma_invoice_id = $proforma_invoice_id")->result_array();
        
        
        echo $this->load->view('purchase/supporting_doc_view',$data);
                
    }


    public function delete_supporting_doc(){
        $puchase_supporting_doc_id= $this->input->post('puchase_supporting_doc_id');
        $this->db->where("puchase_supporting_doc_id", $puchase_supporting_doc_id);
        $this->db->delete("purchase_supporting_doc");
        echo 1;
    }
	
	 /* Show the summary of recieve packing list serial
     * of a specific purchase id
     * Creted by charlie
     */
       public function summary_packing_serial_list(){
            $data['table_data'] = $this->purchase_model->get_summary_packing_serial_list();
            $data['title'] = 'Recieved Packing Serial Report';
            $this->render_page('purchase/summary_packing_serial_list',$data);
       }
       
       public function details_packing_serial_no($purchase_id,$product_id){
            $data['table_data'] = $this->purchase_model->get_details_packing_serial_no($purchase_id,$product_id);
            $data['title'] = 'Details Recieved Packing Serial';
            $this->render_page('purchase/details_packing_serial_no',$data);
       }
	   
        public function update_status() {
            $purchase_id = $this->input->post('purchase_id');
            $status = $this->input->post('status');
            $code = $this->db->query("SELECT purchase_code FROM purchase_order WHERE purchase_id=".$purchase_id)->row();

            $this->common_model->delegation_by_ref_insert(1,$code->purchase_code);
            
            initiate_delegation($code->purchase_code);
            
            $update_data = array(
                'status' => $status
            );
            $where = array(
                'purchase_id' => $purchase_id
            );
            $this->purchase_model->update_data($update_data, 'purchase_order', $where);
        }
    
    
    
    public function approve_delegation_action()
    {
        $post = $this->input->post();
        $comments = $post['comments'];
        unset($post['comments']);
        $post_array = array();
        foreach ($post as $v)
        {
            $post_array[] = $v;
        }
        //debug($post_array,1);
        delegation_action($this->session->userdata("USER_ID"),"Approve",$comments,$post_array);
        echo TRUE;
    }

    



    public function save_aditional_info(){
        $order_id = $this->input->post('order_id');
        $request_ship_date = $this->input->post('request_ship_date');
        $shipping_method_id = $this->input->post('shipping_method_id');
        $shipping_advice = $this->input->post('shipping_advice');
        $remarks = $this->input->post('remarks');
        
        $update_data= array(
            'request_ship_date' =>$request_ship_date,
            'remarks' => $remarks,
            'shipping_advice' =>$shipping_advice,
            'shipping_method_id'=> $shipping_method_id
        );
        
        $where = array("purchase_id" => $order_id);
        
        $tt =  $this->purchase_model->update_data($update_data, "purchase_order", $where);
         return $tt;
    }
	
	/*
     * Local Purchase 
     */
    
    public function add_local_purchase($order_id = NULL){
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
            $data['cost_component']=  $this->purchase_model->get_cost_component_list($order_id);
        } else {
            $data['purchase_code'] = $this->get_code();
            $data['status'] = 'Draft';
            
        }

        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Create Local Purchase Order';
        $this->render_page('purchase/add_local_purchase_form',$data);
    }
    
    public function save_local_purchase_from_purchase_order_block(){
        $data = $this->input->post();
        $data['status'] = 5;
        $data['purchase_type_id']=1;
        $data_return = $this->unset_data($data);
        $return_id = $this->purchase_model->save_data($data_return, 'purchase_order');
        echo $return_id;
    }
    
    public function local_order_details($order_id=NULL){
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
        
        $data['cost_component']=  $this->purchase_model->get_cost_component_list($order_id);

        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Local Purchase Order Details';
        $this->render_page('purchase/local_purchase_detais', $data);
    }
    
    public function local_order_details_pdf_generate($info)
          {
            $data['pdf_info'] = $this->purchase_model->get_pdf_information($info);
            $data['sum']=$this->purchase_model->get_totalamount($info);
            
            $data['view'] = 'purchase/local_order_details_pdf_generate';
            mpdf_create($data,'pdf_name','A4-L');
          }
    
    public function goods_received(){
        $order_id = $this->input->post('order_id');
        //debug($order_id,1);
        $$order_id = (int)$order_id;
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);
		//echo $this->db->last_query();
		//exit();
        $data['order_info'] = $order_info;
        
        if ($order_id) {
            $data['purchase_code'] = $order_info->purchase_code;
            $data['status'] = $order_info->status_name;
            $data['vendor_id'] = $order_info->vendor_id;
            $data['bill_of_entry'] = $order_info->bill_of_entry;
            $data['bill_of_lading'] = $order_info->bill_of_lading;
            $data['data_exist'] = true;
            $data['exchange_rate'] = $order_info->exchange_rate;
        } else {
            $data['data_exist'] = false;
        }
		
        $data['product'] = $this->purchase_model->get_packing_slip_data($order_id);
        //echo $this->db->last_query();
        //exit();
        $data['order_id'] = $order_id;
        $data['title'] = 'Goods Received Details';
        $this->render_page('purchase/goods_received_details', $data);
    }
    
    public function add_local_purchase_serial_number(){
        $post = $this->input->post();
        $received = $post['new_received'];
        $product_id =  $post['product_id'];
        $purchase_order_id = $post['order_id'];
        $warehouse_id = $post['warehouse_id'];
		
        $order_info = $this->purchase_model->get_order_info($purchase_order_id);
		
        for($i=1; $i<=$received; $i++){
           $product_code[] = $this->generate_random_string(8);
        }
            $month= $post['warranty_period'];

            $priod= "+".$month." month";
            $date = $post['warranty_start_date'];

            $insert_array = array(
                'product_name'=>$post['product_name'],
                'new_received' =>$post['new_received'],
                'vendor_id' =>$post['vendor_id'],
                'product_id' =>$post['product_id'],
                'purchase_id' =>$post['order_id'],
                'purchase_price_usd' =>$post['unit_price_usd'],
                'purchase_price' =>$post['unit_price'],
                'warranty_start_date' =>$post['warranty_start_date'],
                'warranty_period' =>$post['warranty_period'],
                'warranty_expired_on' =>date("Y-m-d", strtotime(str_replace('-','/', $date). $priod)),
                'packing_slip_date' =>date('Y-m-d'),
                'warehouse_id' => $post['warehouse_id']
            );

        $data['title'] = 'Goods Received Details';
        $data['insert_array']=$insert_array;
        $data['product_code']=$product_code;
        $data['order_info'] = $order_info;
        
        $this->render_page('purchase/local_purchase_stock_manager_view',$data);
    }
	
	
	public function local_purchase_insert_serial_no() {
        $this->load->model('stock_model');
        $data = $this->input->post();
        //debug($data,1);
        $received = $data['new_received'];
        for($i=0;$i<count($data['serial_number']);$i++){
            $data_array =array(
                'product_id' => $data['product_id'],
                'purchase_id' => $data['purchase_id'],
                'vendor_id' =>$data['vendor_id'],
                'status_id' =>'9',
                'purchase_price_usd' => $data['purchase_price_usd'],
                'purchase_price' => $data['purchase_price'],
                'purchase_date' => date("Y-m-d"),
                'warranty_start_date' => $data['warranty_start_date'],
                'warranty_period' => $data['warranty_period'],
                'warranty_expired_on' =>$data['warranty_expired_on'],
                'packing_slip_date' => $data['packing_slip_date'],
                'product_code' =>$data['product_code'][$i],
                'serial_number' =>$data['serial_number'][$i] ,
                'current_warehouse_location' => $data['warehouse_id'],
                'sale_status_id' => 18,
                'created_by' => $this->session->userdata('USER_ID')
            );
            //debug($data_array,1);
             $this->purchase_model->save_data($data_array, 'product_stock_manager');
             echo $this->db->last_query().'<br>';
             

            $this->db->where('purchase_order_id', $data['purchase_id']);
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('purchase_order_details', array('receive_status'=>13));
        }
        
        

        $purchase_id = $data['purchase_id'];
        $product_id = $data['product_id'];
        $this->purchase_model->update_received($received,$purchase_id,$product_id);
        //echo $this->db->last_query();
        $serial_ids=  implode($data['serial_number'], ',');
        
          
        $check=$this->stock_model->change_status_to_good_receive($serial_ids,$purchase_id,$data['warehouse_id']);
        
    }
	
	public function lc_settlement_list(){
        $data['table_data'] = $this->purchase_model->get_all_purchase_history();
        $data['title'] = 'LC Sattlement History';
        $this->render_page('purchase/lc_sattelment_view',$data);
    }
    
    public function payment_details($order_id = NULL){
        $data['selected_product'] = $this->purchase_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->purchase_model->get_order_info($order_id);

        $data['order_info'] = $order_info;
        $data['selected_product_list'] = $this->load->view("selected_product_list", $data, true);
        $data['vendor'] = $this->purchase_model->get_vendor_list();
        if ($order_id) {
            
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
        
        $data['cost_component']=  $this->purchase_model->get_cost_component_list($order_id);

        $data['product'] = $this->purchase_model->get_product_list();
        $data['title'] = 'Payment Details';
        $this->render_page('purchase/payment_details', $data);
    }
	
	public function save_settelment(){
        $cost_code_name = $this->input->post('cost_component_name');
        $cost_compnent_payment = $this->input->post('cost_compnent_payment');
        
        $order_id = $this->input->post('order_id');
        
        
        $order_info = $this->purchase_model->get_order_info($order_id);

        $data['order_info'] = $order_info;
        $data['product_cost'] = $this->input->post('product_cost');
		if(!empty($cost_code_name)){
			foreach ($cost_code_name as $kay=>$val){
            $cost_code[$val]=$cost_compnent_payment[$kay];
			$data['cost_component'] = $cost_code;
        }
		}
        
        $data['title'] = 'Confirm Settlement';
        
        
        $this->render_page('purchase/conferm_settlement',$data);
    }

	/*
     * Product Specification Entry
     */
    
    public function product_specification($product_id=NULL, $model_id=NULL ){
        $post = $this->input->post();
        $data = array();
        if($post){
            $spac_array = array();
            $porduct_id = $post['product_id'];
            $model_name = $post['model_name'];
            $desc = $post['model_des'];
            $productmodel_data = $this->purchase_model->product_model_search($porduct_id,$model_name);
            if(empty($productmodel_data)){
                $insert_array=array(
                    'product_id' => $porduct_id,
                    'product_model_name' => $model_name,
                    'created_by' => $this->user_id,
                    'description' =>$desc,
                    'price' => $post['model_price'],
                    'currency_id' =>$post['currency_id']
                );
                
                $model_id = $this->purchase_model->save_data($insert_array,'product_model');
                
            }  else {
                $model_id = $productmodel_data[0]['product_model_id'];
            }
            
            $specification_id = $post['specification_id'];
            $specification_details = $post['specification_details'];
            $product_category_id = '';
           
            $specification_type_name = $post['specification_type_name'];
            $other_specification_details = $post['other_specification_details'];
            
            if(!empty($specification_type_name)){
                $other_specification_type = array();
                foreach ($specification_type_name as $val){
                    if(!empty($val)){
                        $insert_array = array(
                            'product_category_id' =>$product_category_id,
                            'specification_type_name' =>$val
                        );
                        $other_specification_type[] = $this->purchase_model->save_data($insert_array,'specification_type');
                    }
                    
                }
                
                
                foreach ($other_specification_type as $key=>$val){
                    if($other_specification_details[$key] != NULL || $other_specification_details[$key] > 0){
                        $spac_array[$val]= $other_specification_details[$key];
                    }
                }
                
                
            }
            
            
            foreach ($specification_id as $key=>$val){
                if($specification_details[$key] > 0){
                    $spac_array[$val]= $specification_details[$key];
                }
            }
            
            if(!empty($productmodel_data)){
                
                $this->db->where("model_id", $model_id);
                $this->db->delete("product_specification");
                
                $insert_array= array();
                foreach ($spac_array as $key=>$val){
                    $insert_array[] = array(
                        'product_id' =>$porduct_id,
                        'model_id' =>$model_id,
                        'specification_type_id' =>$key,
                        'specification_details' =>$val
                    );
                }
                
            }else{
                $insert_array= array();
                foreach ($spac_array as $key=>$val){
                    $insert_array[] = array(
                        'product_id' =>$porduct_id,
                        'model_id' =>$model_id,
                        'specification_type_id' =>$key,
                        'specification_details' =>$val
                    );
                }
            }
            
            $this->db->insert_batch('product_specification', $insert_array); 
            
            redirect("purchase/product_specification");
            
        }elseif ($product_id && $model_id) {
            $result =  $this->db->query("SELECT * FROM product_model WHERE product_model_id = $model_id")->result_array();
            $data['model_des'] = $result[0]['description'];
            $data['model_name'] = $result[0]['product_model_name'];
            $data['model_id'] = $result[0]['product_model_id'];
            $data['product_category_id'] = '';
            $data['porduct_id'] = $product_id;
            $data['specification_list']= $this->purchase_model->get_specification_list($product_id,$model_id);
            $data['model_specification_list']= $this->load->view('purchase/specification_list_view',$data,TRUE);
        }

        $this->render_page('purchase/product_specification_view',$data);
    }
    
    
    public function sp_submit()
    {
        $post = $this->input->post();
        if(isset($post['product_model_name']))
        {
            $model_info = array();
            $model_info['product_model_name'] = $post['product_model_name'];
            $model_info['product_id'] = $post['product_id'];
            $model_info['description'] = $post['model_des'];
            $model_info['created_by'] = $this->session->userdata('USER_ID');
            $this->db->insert('product_model', $model_info);
            $post['model_id'] = $this->db->insert_id();
            
            unset($post['model_des']);
            unset($post['product_model_name']);
            foreach ($post['specification_type_id'] as $val)
            {
                $sti = explode("_", $val);
                $post['specification_type_id'] = $sti[1];
                $post['specification_details'] = $sti[0];
                if($sti[0] == 'Yes')
                {
                    $this->db->insert('product_specification', $post);
                }                
            }
        }
        else if(isset($post['model_id']))
        {
            $this->db->where('product_id',$post['product_id']);
            $this->db->where('product_model_id',$post['model_id']);
            $this->db->update('product_model',array('description'=>$post['model_des']));
            
            $this->db->where('product_id',$post['product_id']);
            $this->db->where('model_id',$post['model_id']);
            $this->db->delete('product_specification');
            
            unset($post['model_des']);
            unset($post['product_model_name']);
            foreach ($post['specification_type_id'] as $val)
            {
                $sti = explode("_", $val);
                $post['specification_type_id'] = $sti[1];
                $post['specification_details'] = $sti[0];
                if($sti[0] == 'Yes')
                {
                    $this->db->insert('product_specification', $post);
                } 
            }
        }
        
        echo $post['model_id'];
    }






    public function get_product_model(){
        $searchTerm = $this->input->get('query');

        $products_model = $this->purchase_model->get_models($searchTerm);
        $data = array();
        foreach ($products_model as $row) {
            $data[] = $row['product_model_name'];
        }
        echo json_encode($data);
    }
    
    public function get_product_model_with_id()
    {
        $product_id = $_POST['product_id'];
        $product_model = $this->purchase_model->get_model_with_id($product_id);
        $html = "";
        if(!empty($product_model))
        {
            $html .= "<select class='form-control model_id' name='model_id'>";
            $html .= "<option value=''>Select Model</option>";
            foreach ($product_model as $val)
            {
                $html .= "<option value='".$val['product_model_id']."'>".$val['product_model_name']."</option>";
            }
            $html .= "</select>";
        }
        else
        {
            $html .= 1;
        }
        echo $html;
    }
    public function get_products(){
        $product_category_id = $this->input->post('product_category_id');
        $products_list = $this->purchase_model->get_products_list($product_category_id);
        $html = "<option value = ''>Select</option>";
        foreach($products_list as $val){
            $html .= "<option value='".$val['product_id']."'>".$val['product_name']."</option>";
        }
        
        echo $html;
    }
    
    public function get_specification_list(){
        $product_id = $this->input->post('product_id');
        $model_name = $this->input->post('model_name');
        $type = $this->input->post('type');
        
        $prodeuct_model=  $this->purchase_model->product_model_search($product_id,$model_name,$type);
        if(empty($prodeuct_model)){
            $model_id = 0;
        }else{
            $model_id = $prodeuct_model[0]['product_model_id'];            
        }
        $data['specification_list']= $this->purchase_model->get_specification_list($product_id,$model_id);
        //debug($this->db->last_query());
        //debug($data['specification_list']);
        echo $this->load->view('purchase/specification_list_view',$data,TRUE);
    }
    
    
    public function view_specification($product_category_id = NULL,$product_id=NULL, $model_id=NULL){
        
        $post=  $this->input->post();
        $data = array();
        if(!empty($post)){
            $porduct_id = $post['product_id'];
            $porduct_cat = $post['product_category_id'];
            $model_name = $post['model_name'];
            $productmodel_data = $this->purchase_model->product_model_search($porduct_id,$model_name);
//            debug($this->db->last_query());
//            debug($productmodel_data,1);
            $model_id = $productmodel_data[0]['product_model_id'];
            
            $data['model_name'] = $model_name;
            $data['product_category_id'] = $porduct_cat;
            $data['porduct_id'] = $porduct_id;
            $data['specification_list'] =  $this->purchase_model->get_product_model_spac($porduct_id,$model_id);
            
        }elseif ($product_category_id && $product_id &&  $model_id) {
            $result =  $this->db->query("SELECT * FROM product_model WHERE product_model_id = $model_id")->result_array();
            
            $data['model_name'] = $result[0]['product_model_name'];
            $data['product_category_id'] = $product_category_id;
            $data['porduct_id'] = $product_id;
            $data['specification_list'] =  $this->purchase_model->get_product_model_spac($product_id,$model_id);
        }
        
        $this->render_page('purchase/view_specification',$data);
    }
    
    
    public function product_model_list(){
        
        $data['model_list'] = $this->purchase_model->model_list();
        
        $this->render_page('purchase/product_model_list',$data);
    }
    
    public function delete_model($model_id){
        $this->db->where("product_model_id", $model_id);
        $this->db->delete("product_model");
        redirect('Purchase/product_model_list');
    }
    
    
    public function get_spec_list(){
        $post = $this->input->post();
        $order_id = $post['order_id'];
        $product_id = $post['product_id'];
        $model_id = $post['model_id'];
        $purchase_order_details_id = $post['purchase_order_details_id'];
        $get_model_spec_name = $this->purchase_model->get_model_spec_name($model_id);
        $model_name = $get_model_spec_name[0]['product_model_name'];
        
        $get_spec_from_po_product_spec = $this->purchase_model->get_po_spec($order_id,$product_id,$model_name,$purchase_order_details_id);
        //debug($get_spec_from_po_product_spec,1);
        if(!empty($get_spec_from_po_product_spec)){
            $data['model_spec_list'] = $get_spec_from_po_product_spec;
        }else{
            $data['model_spec_list'] = $this->purchase_model->get_product_model_spac($product_id,$model_id);
        }
        
        echo $this->load->view('purchase/purchase_model_spec',$data);
    }
    
    public function get_spec_list_click(){
        $post = $this->input->post();
        $order_id = $post['order_id'];
        $product_id = $post['product_id'];
        $model_id = $post['model_id'];
        $purchase_order_details_id = $post['purchase_order_details_id'];
        $get_model_spec_name = $this->purchase_model->get_model_spec_name($model_id);
        $model_name = $get_model_spec_name[0]['product_model_name'];
        
        //$get_spec_from_po_product_spec = $this->purchase_model->get_po_spec($order_id,$product_id,$model_name,$purchase_order_details_id);
        //debug($get_spec_from_po_product_spec,1);
       $data['model_spec_list'] = $this->purchase_model->get_product_model_spac($product_id,$model_id);
        
        echo $this->load->view('purchase/purchase_model_spec',$data);
    }
    
    
    public function save_purchase_model_spec(){

        $specification_type_name =  $this->input->post('specification_type_name');
        $specification_details =  $this->input->post('specification_details');
        $order_id=  $this->input->post('order_id');
        $product_id=  $this->input->post('product_id');
        $selected_model=  $this->input->post('selected_model');
        $other_specification_type_name=  $this->input->post('other_specification_type_name');
        $other_specification_details=  $this->input->post('other_specification_details');
        $purchase_order_details_id=  $this->input->post('purchase_order_details_id');
        
        $spac_array = array();
        if(!empty($specification_type_name)){
            foreach ($specification_type_name as $key=>$val){
                if(!empty($specification_details[$key] )){
                    $spac_array[$val]= $specification_details[$key];
                }
            }
        }
        
        
        if(!empty($other_specification_type_name)){
            foreach ($other_specification_type_name as $key=>$val){
                if(!empty($other_specification_details[$key])){
                    $spac_array[$val]= $other_specification_details[$key];
                }
            }  
        }
        
        $get_spec_from_po = $this->purchase_model->get_po_spec_not_model($order_id,$product_id);
        
        if(!empty($get_spec_from_po)){
            $this->db->where("purchase_id", $order_id);
            $this->db->where("po_product_id", $product_id);
            $this->db->delete("po_product_spec");
        }
        
        
        $this->db->delete('po_product_spec', array('purchase_order_details_id' => $purchase_order_details_id)); 
        //debug($purchase_order_details_id,1);
        $insert_array= array();
        foreach ($spac_array as $key=>$val){
            $insert_array = array(
                'purchase_order_details_id' =>$purchase_order_details_id,
                'spec_title' =>$key,
                'spec_details' =>$val,
                'created' => date("Y-m-d H:i:s")
            );
            $this->db->insert('po_product_spec', $insert_array);
        }
        

       // $this->db->insert_batch('po_product_spec', $insert_array); 
        
        $update_model = array(
            'product_model_name' =>$selected_model
        );
        
        $where = array(
            'purchase_order_details_id' =>$purchase_order_details_id
        );
        
        $this->purchase_model->update_data($update_model,'purchase_order_details',$where);
        
        $sql = $this->purchase_model->get_product_mode($product_id,$selected_model);
        echo(@$sql[0]['product_model_id']);
//        echo ;
    }
    
    public function get_product_model_list(){
        $product_id =  $this->input->post('product_id');
        $model_id = $this->input->post('model_id');
        $data["modelOrModelId"] = $_POST["modelOrModelId"];
       // debug($_POST["modelOrModelId"],1);
        $data['model_list'] = $this->purchase_model->get_product_model($product_id);
        
        if(!empty($model_id)){
            $data['model_id'] = $model_id;
        }

        echo $this->load->view('purchase/ajax_product_model_view',$data);
    }

        
    //Khairul..................................
    
    
    public  function privileges_approval() {
        $post = $this->input->post();
        $data = array();
        $data['user_level_id'] = '';
        if($post) {
           $user_level_id = $this->input->post('user_level_id');
           $data['user_list'] = $this->purchase_model->get_user_for_approval_privilege($user_level_id, 1); //  here $approve_for_id = 1 and it's predefined
           $data['user_level_id'] = $user_level_id;
        }
        
        $this->render_page("purchase/approval_privilege",$data);
    }
    
    public function  privilege_approval_save() {
        $post = $this->input->post();
        $data = array();
        if($post) {
           $user_id = $this->input->post('userid');
           $user_level_id = $this->input->post('user_level_id');

            foreach($user_id as $key=>$uid) {
                $data[$key]['userid']=$uid;
                 $data[$key]['approve_for_id']=1;  
            }
         $this->db->insert_batch('privilege_for_approval', $data);     
        }
    }
    
    public function delete_approval_privilige() {
        $flag = $this->input->post('flag');
         $array = array('userid' => $this->input->post('userid'), 'approve_for_id' => 1);
        if($flag=='delete') {
//        $this->db->where($array);
        $this->db->where($array);
        $this->db->delete('privilege_for_approval');
        } else {
            $this->db->insert('privilege_for_approval', $array);
        }

    }

    public function define_delegation($id = NULL) {
      
        $this->render_page("purchase/delegation");
    }

    public function add_define_delegation() {
        $array = array('approve_for_id'=>1, 'userid' => $this->input->post('u_id') );
        if($this->input->post('u_id')!=0) {
            $this->db->insert('defined_delegation', $array);
        }
        
        $data['lists'] = $this->purchase_model->get_hierarchy_list();
       
//        echo $this->load->view('purchase/ajax_user_list_table',$data);
        echo $this->load->view('purchase/ajax_users_list',$data);

    }
    
    public function reorder_delegation(){
        $order = $this->input->post('order');
        $this->purchase_model->reorder_entry_element($order);
       
        $data['lists'] = $this->purchase_model->get_hierarchy_list();
       
        echo $this->load->view('purchase/ajax_user_list_table',$data);
    }
    
    
    public function fob_setting(){
        $pg_id = NULL;
        if(isset($_GET['pg_id']))
        {
            $pg_id = $_GET['pg_id'];
            $data['fob_existing'] = $this->purchase_model->get_fob_list_existing($pg_id);
            $data['product_group'] = $this->purchase_model->get_product_group($pg_id);
        }
        $data['title'] = 'POB Setting';
        $data['pg_id'] = $pg_id;
        $data['fob'] = $this->purchase_model->get_fob_list($pg_id);
        $this->render_page("purchase/fob_setting_view",$data);
    }

    public function fob_setting_save()
    {
        $post = $this->input->post();
        $insert_data = array("product_group_id"=>$post["product_group_id"]);
        $this->db->where("product_group_id",$post["product_group_id"]);
        $this->db->delete("costing_settings");
        foreach ($post['costing_set_id'] as $csi)
        {
            $insert_data["fob_id"] = $csi;
            $insert_data["value_of"] = ($post["value_of"][$csi])?$post["value_of"][$csi]:0;
            $insert_data["formula_on"] = $post["formula_on"][$csi];
            $insert_data["row_index"] = $post["row_index"][$csi];
            $insert_data["formula_on"] = strtoupper($post["formula_on"][$csi]);
            $insert_data["created_by"] = $this->session->userdata("USER_ID");
            
            $this->db->insert("costing_settings",$insert_data);
        }
        echo TRUE;
    }
    
    
    public function change_fob_list_by_product_group()
    {
        $pg_id = $this->input->post('product_group_id');
        $data['fob'] = $this->purchase_model->get_fob_list($pg_id);
        $this->load->view("purchase/fob_setting_view_fob_list",$data);
    }
    
    public function change_existing_fob_list_by_product_group()
    {
        $pg_id = $this->input->post('product_group_id');
        $data['fob_existing'] = $this->purchase_model->get_fob_list_existing($pg_id);
        $data['product_group'] = $this->purchase_model->get_product_group($pg_id);
        $this->load->view("purchase/fob_setting_view_fob_list_existing",$data);
    }
    
    public function individual_product_fob_costing()
    {
        $purchase_order_details_id = $this->input->post('purchase_order_details_id');
        $result = $this->purchase_model->individual_product_fob_costing_sql_view($purchase_order_details_id);
        //debug($this->db->last_query(),1);
        echo $result;
    }
    
    public function my_approval_list(){
        $user_id = $this->session->userdata("USER_ID");
        $data['approval_list'] = $this->purchase_model->get_my_approvd_list($user_id);
        $this->render_page("purchase/my_approval_list_view",$data);
    }
}



