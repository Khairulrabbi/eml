<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Price_list extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('price_list_model');
        $this->load->model('deligation_model');
        $this->load->model('common_model');
    }

    /* ----------------------------------------------------------------------------------------- */

//    public function add_new_price_list($order_id = NULL) {
//        
//       $data['type2'] = $_GET['list_type'];
////$data['type2'] = $this->input->get('list_type');
////debug($data['type2'],1);
//       $data['price_type'] = $this->common_model->get_enum_list("price_list","list_type");
//       if($order_id)
//        {
//            $data['selected_product_group'] = $this->price_list_model->get_selected_product_group($order_id,'region','region_name');
//        }
//        
//        $data['order_id'] = $order_id;
//        $order_info = $this->price_list_model->get_order_info($order_id);
//        $data['order_info'] = $order_info;
//        $data['selected_product_list'] = $this->load->view("selected_product_list", $data, true);
//        $data['vendor'] = $this->price_list_model->get_vendor_list();
//        
//        if ($order_id) {
//            $data['status'] = $order_info->status_name;
//        } else {
//            $data['status'] = 'Draft';
//        }
//        
//        
//        $data['product'] = $this->price_list_model->get_product_list();
//        $data['title'] = 'Create Price List';
//        $this->render_page('price_list/price_list_form', $data);
//    }
    
    
    
    public function add_new_price_list($type,$order_id=NULL) {
        $data['title'] = 'Create Price List';
        $data['type2'] = $type;
        if($order_id)
            {
                $data['order_id'] = $order_id;
                $data['p_list'] = $this->price_list_model->get_all_price_history($type,$order_id);
                $data['selected_product_group'] = $this->price_list_model->get_selected_product_group($order_id,'region','region_name');
                
                $order_info = $this->price_list_model->get_order_info($order_id);
//                debug($order_info,1);
                $data['order_info'] = $order_info;
                $data['status'] = $order_info->status_name;
                $data['selected_product_list'] = $this->load->view("price_list/selected_product_list", $data, true);
                
            }
        else
            {
                $data['status'] = 'Draft';
                $data['product'] = $this->price_list_model->get_product_list();
                $data['p_list'] = $this->price_list_model->get_all_price_history($type,$order_id);
                $data['selected_product_group'] = $this->price_list_model->get_selected_product_group($order_id=NULL,'region','region_name');
//                $data['selected_product_list'] = $this->load->view("price_list/selected_product_list", $data, true);
               
            }
        $data['price_type'] = $this->common_model->get_enum_list("price_list","list_type");
        
        $this->render_page('price_list/price_list_form', $data);
    }
    
    
    

    

        public function save_price_for_price_list_block(){
        $this->form_validation->set_rules('price_list_name', 'Price List Name', 'trim|required');
        $this->form_validation->set_rules('budget_year', 'Budget Year', 'trim|required');
        $this->form_validation->set_rules('effective_date', 'Effective Date', 'trim|required');
        $this->form_validation->set_rules('list_type', 'Price List Type', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $data = $this->input->post();
            $data['price_list_status'] = 57; // 5=pi draft
            $data['price_list_code'] = get_generated_code(5); 
            $data['created_by'] = $this->session->userdata("USER_ID");
            $data_return = $this->unset_data($data);
            //debug($data_return,1);
            $return_id = $this->price_list_model->save_data($data_return, 'price_list');
            
            $return_array['code'] = $data['price_list_code'];
            $return_array['id'] = $return_id;
            echo json_encode($return_array);
            exit();
        }    
    }
	
	public function update_price_list_for_price_list_order_block(){
            $order_id = $this->input->post('order_id');
            $data['price_list_name'] = $this->input->post('price_list_name');
            $data['budget_year'] = $this->input->post('budget_year');
            $data['effective_date'] = $this->input->post('effective_date');
            $data['list_type'] = $this->input->post('list_type');

            $where = array("price_list_id" => $order_id);
            $this->price_list_model->update_data($data, 'price_list', $where);
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
        $this->price_list_model->update_data($data,"purchase_order_details",$where);
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
        $data['selected_product_group'] = $this->price_list_model->get_selected_product_group($order_id,$table,$field);
        $data['table'] = $table;
        $data['order_id'] = $order_id;
        $order_info = $this->price_list_model->get_order_info($order_id);
        $data['order_info'] = $order_info;
        echo $this->load->view("price_list/selected_product_list", $data, true);
    }
    
    public function update_price(){
        $price = $this->input->post('price');
        $price_list_details = $this->input->post('price_list_details');
        $this->db->where("price_list_details_id",$price_list_details);
        $this->db->update("price_list_details",array("unit_price"=>$price));
    }
    //---------------------End ------------------------//

    public function price_list_details($order_id = NULL) {
        
        $data['selected_product'] = $this->price_list_model->get_selected_product($order_id);
        $data['order_id'] = $order_id;
        $order_info = $this->price_list_model->get_order_info($order_id);
        $data['table'] = 'region';
        $data['selected_product_group'] = $this->price_list_model->get_selected_product_group($order_id,'region','region_name');
        $data['price_list_status'] = $this->price_list_model->price_list_status($order_id);
        
        $data['selected_product_list'] = $this->load->view("price_list/selected_product_list", $data, true);
        //$data['vendor'] = $this->price_list_model->get_vendor_list();
        if ($order_id) {
            $data['data_exist'] = true;
        } else {
            $data['data_exist'] = false;
        }
       
        $data['product'] = $this->price_list_model->get_product_list();
        $data['title'] = 'Price List Details';
        $data['order_info'] = $order_info;
        
        $code = $order_info->price_list_code;
        $data['approve_history'] = $this->price_list_model->get_approve_history($code);
        $data['current_approval_location'] = $this->common_model->get_waiting_approval_list($this->session->userdata("USER_ID"),"purchase",$code);
        $this->render_page('price_list/price_list_details', $data);
    }
    
   

    

    public function save_order_details() {
        $price_list_id =(int)$this->input->post("order_id");
        $product_id = $this->input->post("product_id");
        $purchase_price_usd = $this->input->post("purchase_price_usd");
        $purchase_price = $this->input->post("purchase_price");
        
        
        foreach ($product_id as $key => $values) {
            $data = array();
            $data['price_list_id'] = $price_list_id;
            $data['product_id'] = $values;
            $data['unit_price'] = floatval($purchase_price[$values]);
            $data['created_by'] = $this->session->userdata("USER_ID");
            $return_id = $this->price_list_model->save_data($data, 'price_list_details');
        }
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
            $return_id = $this->price_list_model->update_data($data_return, 'purchase_order', $where);
        } else {
            //echo "he";
            $return_id = $this->price_list_model->save_data($data_return, 'purchase_order');
        }
        //exit();
        echo $return_id;
    }

   
    public function update_product_details() {
        $order_details_id = $this->input->post('order_details_id');
        $where = array("purchase_order_details_id" => $order_details_id);
        $data = $this->input->post();
        unset($data['order_details_id']);
        //debug($data['purchase_price'],1);
        $this->price_list_model->update_data($data, "purchase_order_details", $where);
    }
    
    public function update_product_details_usd() {
        $order_details_id = $this->input->post('order_details_id');
        $where = array("purchase_order_details_id" => $order_details_id);
        $data = $this->input->post();
        unset($data['order_details_id']);
        $this->price_list_model->update_data($data, "purchase_order_details", $where);
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

        $this->price_list_model->update_data($data_return, "purchase_order", $where);
        redirect($redirect);
    }

    public function check_order_details() {
        $order_id = $this->input->post("order_id");
        $query = $this->db->query("SELECT * FROM price_list_details where price_list_id= $order_id");
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
    
     public function price_history($type){
        $data['table_data'] = $this->price_list_model->get_all_price_history($type);
        $data['title'] = $type.' Price List';
        $data['type1'] = $type;
        $this->render_page('price_list/price_history',$data);
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
           $data['table_data'] = $this->price_list_model->get_all_purchase_history($where);
           $this->load->view("purchase/current_purchase_view_ajax_list",$data);
       }
        
    
    function ajax_upload(){
        
        $post = $this->input->post();
        
        //debug($post,1);
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

            
            $this->price_list_model->save_data($insert_data,'purchase_supporting_doc');
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
   public function delete_product() {
        $order_details_id = $this->input->post('order_details_id');
        $this->db->where("price_list_details_id", $order_details_id);
        $this->db->delete("price_list_details");
        echo 1;
    }
	
	 /* Show the summary of recieve packing list serial
     * of a specific purchase id
     * Creted by charlie
     */
      
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
            $this->price_list_model->update_data($update_data, 'purchase_order', $where);
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

    



    
	
	
    
    public  function privileges_approval() {
        $post = $this->input->post();
        $data = array();
        $data['user_level_id'] = '';
        if($post) {
           $user_level_id = $this->input->post('user_level_id');
           $data['user_list'] = $this->price_list_model->get_user_for_approval_privilege($user_level_id, 1); //  here $approve_for_id = 1 and it's predefined
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

    public function my_approval_list(){
        $user_id = $this->session->userdata("USER_ID");
        $data['approval_list'] = $this->price_list_model->get_my_approvd_list($user_id);
        $this->render_page("purchase/my_approval_list_view",$data);
    }
    
    
    public function send_for_approval()
     {        
        $price_list_id = $this->input->post('price_list_id');
        $price_list_code = $this->input->post('price_list_code');
        $this->common_model->delegation_by_ref_insert(5,$price_list_code);

        initiate_delegation($price_list_code);
        $update_data = array(
            'price_list_status' => 58
        );
        $where = array(
            'price_list_id' => $price_list_id
        );
        $this->price_list_model->update_data($update_data, 'price_list', $where);
     }
     
//     public function check_existing_status(){
//         $price_list_id = $this->input->post('price_list_id');
//         $c_Status = $this->input->post('status');
//         $type= $this->input->post('type');
//         $data['existing_status'] = $this->price_list_model->get_existing_status($type);
//         foreach ($data['existing_status'] as $k => $v) {
//            if ($v['status'] == 'Active') {
//                echo 1;
//            }
//            else{
//                
//            }
//        }
//
//        //debug($data['existing_status'],1);
//     }
     
     public function change_status(){
        $p_list_id= $this->input->post('price_list_id');
        $status= $this->input->post('status');
        $type= $this->input->post('type');
        if($status == "Active")
        {
            $this->db->WHERE('price_list_id', $p_list_id);
            $this->db->UPDATE('price_list',array('status'=>'Inactive'));
            echo "Inactive";
        }
        else
        {
            $existing_status = $this->price_list_model->get_existing_status($type);
            if($existing_status->total < 1)
            {
                $this->db->WHERE('price_list_id', $p_list_id);
                $this->db->UPDATE('price_list',array('status'=>'Active'));
                 echo "Active";
            }
            else
            {
                echo "One already active.";
            }
        }
    }
}



