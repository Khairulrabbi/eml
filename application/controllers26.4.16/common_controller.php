<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_controller extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->model('user_model','','TRUE');  
    $this->load->model('purchase_model');
    $this->load->model('common_model');
    $this->load->model('sales_model');
    $this->load->model('stock_model');
    }
/*-----------------------------------------------------------------------------------------*/
 
  public function get_sub_category(){
      $category_id = $this->input->post("category_id");
      echo sub_category_list(null, array('class' => 'sub_category_id', 'required' => 'required'),'product_subcategory_name',array("product_category_id"=>$category_id));
}
   public function get_product_list_combo(){
      $category_id = $this->input->post("category_id");
      $brand_id = $this->input->post("brand_id");
      $sub_category_id = $this->input->post("sub_category_id");
      
      echo  product_list(null, array('class' => 'product_id', 'required' => 'required'),'product_name',array("product_category_id"=>$category_id,"product_subcategory_id"=>$sub_category_id,"product_brand_id"=>$brand_id));
      //echo $this->db->last_query();
  }
  
//  public function add_dropdownmenu($id=NULL){
//      
//      $info = $this->input->post();
//      if($info){
//      if($id){
//          $data['info'] = $this->common_model->get_dropdown_info($id);
//          $post = $this->input->post();
//          $this->db->where("dd_id",$id);
//          $this->db->update("dropdown_list",array("dd_name"=>$post['name'],"details"=>$post['details'],"option_id"=>$post['id_field'],"option_value"=>$post['option_value'],"multiselect"=>$post['multiselect'],"query"=>$post['query'])); 
//          $data['sql'] = $this->common_model->get_dropdown_info();
//       }
//       else
//            {
//             $u_id = $this->session->userdata("USER_ID");
//             $this->db->insert('dropdown_list',$info);
//             }
//         }
//            $data['sql'] = $this->common_model->get_dropdown_info();
//            $this->render_page("add_dropdownmenu",$data);
//    }
  
  
  
    public function add_dropdownmenu($id = NULL){
            $data['id'] = $id;
            $data['info'] = $this->common_model->get_dropdown_info($id);
            $data['dropdown_status'] = $this->common_model->get_enum_list("dropdown_list","status");
            $data['drop_info'] = $this->common_model->get_dropdown_info();
            $this->render_page("add_dropdownmenu",$data);
    }
    
    //default controller
    public function search_panel($id=NULL){
        $data['id'] = $id;
        $data['panel_status'] = $this->common_model->get_enum_list("search_panel","status");
        $data['info'] = $this->common_model->get_search_panel_info($id);
        $data['panel_info'] = $this->common_model->get_search_panel_info();
        $this->render_page("search_panel_view",$data);
    }
    //click save & edit button
    public function search_panel_ajax(){
        $info = $this->input->post();
        $u_id = $this->session->userdata("USER_ID");
        $id = $this->input->post('panel_id');
        if($id){
            unset($info['panel_id']);
            $info['updated_by'] = $u_id;
            $this->db->where('panel_id',$id);
            $this->db->update("search_panel",$info); 
        }else{
            $u_id = $this->session->userdata("USER_ID");
            $info['created_by'] = $u_id;
            $this->db->insert('search_panel',$info);
        }
        $data['panel_info'] = $this->common_model->get_search_panel_info();
        echo $this->load->view('search_panel_ajax_view',$data);
        
    }
    
    
    //click view button
    public function panel_details($id=NULL){
        
        $panel_id = $this->input->post('panel_id');
        $data['p_id'] = $panel_id;
        //$data['data1'] = $this->common_model->get_search_panel_info($id);
        $data['details_info'] = $this->common_model->get_details_search_panel_info();
        echo $this->load->view('panel_details_view',$data);
    }
    
    public function search_panel_info1()
    {
        $data['details_info'] = $this->common_model->get_details_search_panel_info();
        //debug($data['details_info'],1);
        echo $this->load->view('panel_details_view_chield',$data);
        //exit();
    }

    //click add button and save info
    public function search_panel_details(){
        $v= $this->input->post();
//        debug($v);
        
        $field_type_id = $this->input->post('field_type_id');
        
        $data['p_id'] = $this->input->post('p_id');
        $data['v'] = $this->input->post('value');
//        debug($data,1);
//        echo '<pre>';
//        print_r($id);
//        exit();
        
        
        $data['edit_info'] = $this->common_model->get_details_search_panel_info();
        $data['panel_info'] = $this->common_model->get_search_panel_info();
        $data['info']=$this->input->post();
//        debug($data['info'],1);
        echo $this->load->view('search_panel_details_view',$data);
    }
    //click edit button
    public function search_panel_details_edit($id=NULL){
        $info = $this->input->post();
        $data['p_d_id'] =$info['panel_d_id'];
        $p_id= $data['p_d_id'];
        
//        $data['v'] = $this->input->post('value');
        $data['v'] = $this->input->post('field_type_id');
        $data['edit_info'] = $this->common_model->get_details_search_panel_info($data['p_d_id']);
        $data['p_id'] = $data['edit_info']->panel_id;
        
        echo $this->load->view('search_panel_details_view',$data);
        
    }
    //save_button & update
    public function search_panel_details_ajax($i=NULL){
        
        
        $data['details_info'] = $this->common_model->get_details_search_panel_info();
//        debug($data['details_info'],1);
        $info = $this->input->post();
        debug($info,1);
        $id = $info['panel_id'];
        unset( $info['panel_details_id'] );
        $info=(array_filter($info));
        if($i){
            if(!isset($info['show']))
            {
                $info['show'] = 0;
            }
            if (!isset($info['required'])) {
            $info['required'] = 0;
        }if (!isset($info['allow_ajax'])) {
            $info['allow_ajax'] = 0;
        }
//            unset($info['panel_id']);
            unset($info['dd_id']);
            $this->db->where('panel_details_id',$i);
            $this->db->update("search_panel_details",$info);
        }else{
//            $all_info = array(
//            'panel_id'=>$info['panel_id'],
//            'item_title'=>$info['item_title'],
//            'field_type_id'=>$info['field_type_id'],
//            'item_comma_separated'=>$info['item_comma_separated'],
//            'sort'=>'0',
//            'item_auto'=>'0',
//            'dd_id'=>$info['dd_id'],
//            'dd_extra_condition'=>$info['dd_extra_condition'],
//            'dd_order_by'=>$info['dd_order_by'],
//            'show'=>$info['show'],
//            'field_id'=>$info['field_id'],
//            'field_name'=>$info['field_name'],
//            'option_value'=>$info['option_value'],
//            'description'=>$info['description'],
//            'placholder'=>$info['placholder'],
//            'required'=>$info['required'],
//            'allow_ajax'=>$info['allow_ajax'],
//              
//            'max_char'=>$info['max_char'],
//            'min_char'=>$info['min_char'],
//            'reg_expression'=>$info['reg_expression']
//        );
        $this->db->insert('search_panel_details',$info);
        }
        
        $this->load->view("panel_details_view_chield",$data);
        exit();
    }
    public function details_delete(){
        $data['details_info'] = $this->common_model->get_details_search_panel_info();
        $id = $this->input->post('panel_d_id');
        
        $this->db->where('panel_details_id',$id);
        $this->db->delete('search_panel_details');
         
        $this->load->view("search_panel_details_view_all_ajax_info",$data);
        exit();
    }


    
    
    
    
    public function add_dropdownmenu_ajax(){
        $info = $this->input->post();
        $id= $this->input->post('dd_id');
        if($id){
            unset($info['dd_id']); // unset key
            $this->db->where("dd_id",$id);
            $this->db->update("dropdown_list",$info); 
            }
            else
            {
                $u_id = $this->session->userdata("USER_ID");
                $info['created_by']=$u_id;
                $this->db->insert('dropdown_list',$info);
            }
            $data['drop_info'] = $this->common_model->get_dropdown_info();
            echo $this->load->view('dropdown_info_ajax_view',$data);
    }
    
    

  public function get_product_list_view(){
       $pd = $this->input->post();
       //debug($pd,1);
       $data['gorder_id'] = $pd['order_id'];
       $data['module'] = $pd['module'];
       unset($pd['order_id']);
       unset($pd['module']);
       $where = array();
       foreach ($pd as $k=>$v)
       {
           if($v)
           {
               if($k == "warehouse_id")
                {
                    $where['purchase_good_receive.'.$k] = $v;
                }
                else
                {
                    $where['product.'.$k] = $v;
                }               
           }
       }
      $data['list']  = $this->common_model->get_product_list($where,$data['module']);
      echo $this->load->view("product_list",$data);
  }
  
  public function get_product_list_view2(){
//       echo "<pre>";
//       print_r($this->input->post());
//       exit();
      $category_id = $this->input->post("category_id");
      $brand_id = $this->input->post("brand_id");
      $sub_category_id = $this->input->post("sub_category_id");
      $sub_category_id = $this->input->post("product_id");
      $order_id = $this->input->post("order_id");
      
      $data = array();
//      if($this->input->post("flag")){
//         $data['selected_product']= $this->get_product_plane_array($this->sales_model->get_selected_product($order_id));
//      }  else {
//         $data['selected_product']= $this->get_product_plane_array($this->purchase_model->get_selected_product($order_id)); 
//      }
      $data['list']  = $this->common_model->get_product_list($this->input->post());
      //debug($this->db->last_query(),1);
      echo $this->load->view("purchase/product_list",$data);
  }
  public function get_product_plane_array($array){
        $return_array = array();
         if(!empty($array)){
            foreach($array as $key=>$value){
                $return_array[]=$value['product_id'];
            }
        }
        return $return_array;
  }
  public function get_customer_info(){
      $customer_id = $this->input->post("customer_id");
      $due = $this->common_model->customer_due($customer_id);
      $data = $this->db->query("SELECT c.*,ct.customer_type_name,co.company_name,".$due." AS customerDue FROM customer c 
              LEFT JOIN customer_type ct ON ct.customer_type_id=c.customer_type_id 
              LEFT JOIN company co ON co.company_id=c.company_id 
              WHERE c.customer_id=".$customer_id)->row();     
      echo json_encode($data);
  }
  
  public function get_customer_defult_address(){
      $customer_id = $this->input->post("customer_id");
      $this->db->select("address_details");
      $this->db->from("customer_address");
      $this->db->where("customer_id",$customer_id);
      $this->db->where("default_flag",1);
      $data = $this->db->get()->row();
      echo json_encode($data);
  }
  
  public function updateLabelText()
  {
        $slug = $_POST['label_slug'];
        $label_text = $_POST['label_text'];
        $this->db->where('label_slug', $slug);
        $this->db->update('label',array('custom_name'=>$label_text));
        echo TRUE;
  }
  
    public function product_transaction_list()
    {   
        $data['title'] = 'All Cart List';
        $this->render_page('transaction/product_transaction_list', $data);    
    }
    
    public function delete_from_transaction_list()
    {
        $product_id = $_POST['product_id'];
        $list_type = $_POST['list_type'];
        $this->db->where('product_id',$product_id);
        $this->db->where('type',$list_type);
        $this->db->where('user_id',$this->session->userdata('USER_ID'));
        $result = $this->db->delete('cart');
        if($result)
        {
            echo TRUE;
        }
        else
        {
            echo FALSE;
        }
    }
    
    public function waiting_approval_list($module){
        $user_id = $this->session->userdata("USER_ID");
        $data['sql'] = $this->common_model->get_waiting_approval_list($user_id,$module);
        $this->render_page($module.'/waiting_approval_list_view', $data);
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
    
    
    
    public function panel_list_ordering()
    {
        $post = $this->input->post();
//        debug($post,1);
        $this->common_model->panel_list_ordering_model($post);
        echo TRUE;
    }
    
    
    public function payable_payment_create()
    {
        $post = $this->input->post();
        //debug($post,1);
        $code = get_generated_code(7);
        $pan_data = array(
            "payment_approval_code"=>$code,
            "ref_name"=>$post["ref_name"],
            "ref_name_id"=>$post["ref_name_id"],
            "payment_approval_note_status"=>62,
            "created"=>  $this->session->userdata("USESR_ID")
        );
        $this->db->insert("payment_approval_note",$pan_data);
        $payment_approval_note_id = $this->db->insert_id();
        
        foreach ($post['account_amount'] as $key=>$val)
        {
            $pand_data = array(
                "payment_approval_note_id"=>$payment_approval_note_id,
                "amount"=>$val,
                "cost_component_id"=>$key,
                "payment_approval_note_details_status"=>63
            );
            $this->db->insert("payment_approval_note_details",$pand_data);
        }
        echo $this->common_model->payment_approval_note_preview_html($payment_approval_note_id);       
    }
    
    public function send_for_payment_approval_note()
    {
        $payment_approval_hid_code = $_POST['payment_approval_hid_code'];
        $payment_approval_note_hid_id = $_POST['payment_approval_note_hid_id'];
        
        $this->common_model->delegation_by_ref_insert(6,$payment_approval_hid_code);
        
        initiate_delegation($payment_approval_hid_code);
        
        $this->db->where("payment_approval_note_id",$payment_approval_note_hid_id);
        $this->db->update("payment_approval_note",array("payment_approval_note_status"=>63));
    }
    
    public function approve_payment_approval_note()
    {
        $payment_approval_note_id = $_POST['payment_approval_note_id'];
        echo $this->common_model->approve_payment_approval_note_html($payment_approval_note_id);
    }
}