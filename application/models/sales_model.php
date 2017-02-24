<?php

class Sales_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_vendor_list() {
        $query = $this->db->get('vendor');
        return $query->result_array();
    }

    public function get_product_list() {
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function add_summary($array) {
//        echo "<pre>";
//        print_r($array);
//        exit;
        $this->db->insert('sales_order_summary', $array);
    }

    public function save_data($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update_data($data,$table,$where){
        $this->db->where($where,false);
        $this->db->update($table,$data);
        if(isset($where['sales_id']) ){
            return $where['sales_id'];
        }
        
    }
    
 
    
    public function get_order_info($order_id){
            $this->db->select("sales_order.*,status.status_name,customer.customer_name, customer.customer_id, 
                    customer.mobile_number, customer.credit_limit, customer.address as customerAddress, customer.contact_person,
                    shipping_method.shipping_method_name,
                    currency.currency_name,
                    payment_type_name,
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name,
                    delivery_mode.delivery_mode_name
                    ",false);
            $this->db->from("sales_order");
            $this->db->join("status",'sales_order.sales_status=status.status_id');
            $this->db->join("customer",'customer.customer_id=sales_order.customer_id');
            $this->db->join("currency",'currency.currency_id=sales_order.currency_id','left');
            $this->db->join("shipping_method",'shipping_method.shipping_method_id=sales_order.shipping_method_id',"left");
            $this->db->join("payment_type",'payment_type.payment_type_id=sales_order.payment_type_id',"left");
            $this->db->join("delivery_mode",'delivery_mode.delivery_mode_id=sales_order.delivery_mode_id',"left");
            $this->db->join("user",'user.user_id=sales_order.sales_person_id',"left");
            $this->db->where("sales_id",$order_id);
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->row();
    }
    
    
    public function get_front_desk_order_info($order_id){
            $this->db->select("sales_order.*,status.status_name,cfds.customer_name, cfds.customer_id, 
                    cfds.mobile_number,  cfds.address,
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name",false);
            $this->db->from("sales_order");
            $this->db->join("status",'sales_order.sales_status=status.status_id');
            $this->db->join("customer_front_desk_sale cfds",'cfds.customer_id=sales_order.customer_id');
            $this->db->join("user",'user.user_id=sales_order.sales_person_id',"left");
            $this->db->where("sales_id",$order_id);
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->row();
    }
    
    
    public function get_approve_history($code){
        $this->db->select("dl.*,u.username");
        $this->db->from("delegation_log dl");
        $this->db->join("user u",'u.user_id=dl.approve_by', 'LEFT');
        $this->db->join("user r",'r.user_id=dl.reliever_of', 'LEFT');
        $this->db->where("dl.ref_no",$code);
        $result = $this->db->get();
        return $result->result_array(); 
    }
    
    public function get_chalan_info($order_id,$type){
        $chalan_info = "
            SELECT c.chalan_id,c.chalan_code, dto.warehouse_name as dtowarehouse, fr.warehouse_name as frwarehouse,c.delivery_date FROM chalan c
            LEFT JOIN warehouse dto ON dto.warehouse_id=c.delivery_to 
            LEFT JOIN warehouse fr ON fr.warehouse_id=c.delivery_from 
            WHERE chalan_type = '".$type."' AND chalan_type_id=".$order_id;
        $result= $this->db->query($chalan_info);
        return $result->result_array();
    }
    
 
    
    public function get_chalan_front_desk_info($order_id){
        $this->db->select("p.*,cd.quantity,c.chalan_id");
        $this->db->from("product p");
        $this->db->join("chalan_details cd",'cd.product_id=p.product_id', 'LEFT');
        $this->db->join("chalan c",'c.chalan_id=cd.chalan_id', 'LEFT');
        $this->db->where("c.chalan_id",$order_id);
        return $this->db->get()->result_array();
    }
    
    public function chalan_info_details_info($chalan_id)
    {
        $this->db->select("p.product_name,p.product_code,p.product_details_json,cd.quantity");
        $this->db->from("chalan_details cd");
        $this->db->join("product p","p.product_id=cd.product_id","left");
        $this->db->where("cd.chalan_id",$chalan_id);
        $result =  $this->db->get();
        return $result->result_array();
    }
    
    
    
    
    public function get_quotation_order_info($quotation_id){
            $this->db->select("quotation.*,status.status_name,customer.customer_id,customer.customer_name, 
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name,
                    company.company_name,customer.address,customer.credit_limit,customer_type.customer_type_name,
                    
                    ",false);
            $this->db->from("quotation");
            $this->db->join("status",'quotation.quotation_status=status.status_id');
            $this->db->join("customer",'customer.customer_id=quotation.customer_id');
            $this->db->join("company","company.company_id=customer.company_id","left");
            $this->db->join("customer_type","customer_type.customer_type_id=customer.customer_type_id");
            $this->db->join("user",'user.user_id=quotation.sales_person',"left");
            $this->db->where("quotation_id",$quotation_id);
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->row();
    }
	
		/*
	 *Function to query all details sales order list
     * created by Charlie 04-may-2016	 
     */
	 public function get_all_sales_order_history(){
            $this->db->select("sales_order.*,status.status_name,customer.customer_name, 
                    shipping_method.shipping_method_name,
                    currency.currency_name,
                    payment_type_name,
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name,
					product.product_name,
                    delivery_mode_name,sales_order_details.*
                    ",false);
            $this->db->from("sales_order");
            $this->db->join("sales_order_details",'sales_order.sales_id=sales_order_details.sales_order_id','left');
            $this->db->join("status",'sales_order.sales_status=status.status_id');
            $this->db->join("customer",'customer.customer_id=sales_order.customer_id');
            $this->db->join("currency",'currency.currency_id=sales_order.currency_id','left');
            $this->db->join("shipping_method",'shipping_method.shipping_method_id=sales_order.shipping_method_id',"left");
            $this->db->join("payment_type",'payment_type.payment_type_id=sales_order.payment_type_id',"left");
            $this->db->join("delivery_mode",'delivery_mode.delivery_mode_id=sales_order.delivery_mode_id',"left");
            $this->db->join("user",'user.user_id=sales_order.sales_person_id',"left");
            $this->db->join("product",'sales_order_details.product_id=product.product_id','left');
            
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->result_array();
    }
    
    
    public function getAllSalesOrderList(){
            $previlige = stock_view_privilege_wise();
            $this->db->select("sales_order.*,status.status_name,customer.customer_name, 
                    shipping_method.shipping_method_name,
                    currency.currency_name,
                    payment_type_name,
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name,
					product.product_name,
                    delivery_mode_name,sales_order_details.*
                    ",false);
            $this->db->from("sales_order");
            $this->db->join("sales_order_details",'sales_order.sales_id=sales_order_details.sales_order_id','left');
            $this->db->join("status",'sales_order.sales_status=status.status_id','left');
            $this->db->join("customer",'customer.customer_id=sales_order.customer_id','left');
            $this->db->join("currency",'currency.currency_id=sales_order.currency_id','left');
            $this->db->join("shipping_method",'shipping_method.shipping_method_id=sales_order.shipping_method_id',"left");
            $this->db->join("payment_type",'payment_type.payment_type_id=sales_order.payment_type_id',"left");
            $this->db->join("delivery_mode",'delivery_mode.delivery_mode_id=sales_order.delivery_mode_id',"left");
            $this->db->join("user",'user.user_id=sales_order.sales_person_id',"left");
            $this->db->join("product",'sales_order_details.product_id=product.product_id','left');
            if($previlige == FALSE)
            {
                    $this->db->where("sales_order.sales_person_id IN (SELECT user_id FROM user WHERE location_id=".$this->session->userdata('LOCATION_ID').")",NULL,FALSE);
            }
            $this->db->group_by("sales_order.sales_id");
            $this->db->order_by("sales_order.sales_id");
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->result_array();
    }
	 
	
    public function get_selected_product($order_id){
        $this->db->select("sod.*,p.product_name,p.product_details_json");
        $this->db->from("sales_order_details sod");
        $this->db->join("product p",'p.product_id=sod.product_id');
        $this->db->where("sod.sales_order_id",$order_id,false);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_selected_product_for_quotation($quotation_id){
            $this->db->select("*");
            $this->db->from("quotation_details");
            $this->db->join("product",'product.product_id=quotation_details.product_id');
            $this->db->where("quotation_id",$quotation_id,false);
            $result= $this->db->get();
            return $result->result_array();
        
    }
	
    
    public function get_default_quotation_approval_person($approve_for_id)
    {
        $this->db->select('privilege_for_approval.userid');
        $this->db->from('privilege_for_approval');
        $this->db->join('user','user.user_id=privilege_for_approval.userid');
        $this->db->where('privilege_for_approval.approve_for_id',$approve_for_id);
        $this->db->where('user.status','Active');
        $this->db->group_by('privilege_for_approval.userid');
        return $this->db->get();
    }
    
    public function quotation_approval_persons($quotation_id)
    {
        
        $this->db->select('GROUP_CONCAT(DISTINCT(remark_user_id)) AS level_id');
        $this->db->from('remark_persons');
        $this->db->where('quotation_id',$quotation_id);
        $rows = $this->db->get()->row()->level_id;
        return $rows;
//        $lebel_list = $this->db->select('GROUP_CONCAT(remark_user_id) AS level_id')
//                  ->get_where('remark_persons', array('quotation_id' => $quotation_id))
//                  ->row()
//                  ->level_id;
//        return $lebel_list;
        
    }
    
    public function sales_approval_persons($order_id)
    {
        
        $this->db->select('GROUP_CONCAT(DISTINCT(user_id)) AS level_id');
        $this->db->from('sales_approval_persons');
        $this->db->where('sales_order_id',$order_id);
        $rows = $this->db->get()->row()->level_id;
        return $rows;
//        $lebel_list = $this->db->select('GROUP_CONCAT(remark_user_id) AS level_id')
//                  ->get_where('remark_persons', array('quotation_id' => $quotation_id))
//                  ->row()
//                  ->level_id;
//        return $lebel_list;
        
    }

    public function get_quotation_list()
    {
        $this->db->select("q.quotation_code,c.customer_name,q.quotation_date,u.username as sales_person,s.status_name as status,q.quotation_id as id");
        $this->db->from("quotation q");
        $this->db->join("customer c","c.customer_id=q.customer_id","left");
        $this->db->join("user u","u.user_id=q.sales_person","left");
        $this->db->join("status s","s.status_id=q.quotation_status");
        return $this->db->get()->result_array();
    }
    
    public function get_waiting_for_remark_list()
    {
        //debug($this->session->all_userdata(),1);
        $this->db->select("q.quotation_code,c.customer_name,q.quotation_date,u.username as sales_person,r.quotation_id as id");
        $this->db->from("remark_persons r");
        $this->db->join("quotation q","q.quotation_id=r.quotation_id");
        $this->db->join("customer c","c.customer_id=q.customer_id","left");
        $this->db->join("user u","u.user_id=q.sales_person","left");
        $this->db->where("r.remark_user_id",  $this->session->userdata('USER_ID'));
        $this->db->where("q.quotation_status",  22);
        $this->db->group_by("r.quotation_id");
        return $this->db->get()->result_array();
    }
    
    
    public function get_waiting_for_approve_list($status=3)
    {
        $this->db->select("so.sales_code,c.customer_name,so.order_date,u.username as sales_person,sap.sales_order_id as id");
        $this->db->from("sales_approval_persons sap");
        $this->db->join("sales_order so","so.sales_id=sap.sales_order_id");
        $this->db->join("customer c","c.customer_id=so.customer_id","left");
        $this->db->join("user u","u.user_id=sap.user_id","left");
        $this->db->where("sap.user_id",  $this->session->userdata('USER_ID'));
        $this->db->where("so.sales_status",  $status);
        $this->db->group_by("sap.sales_order_id");
        return $this->db->get()->result_array();
    }
    
    public function all_sales_approved_list()
    {
        $this->db->select("so.sales_code,c.customer_name,so.order_date,u.username as sales_person,sap.sales_order_id as id");
        $this->db->from("sales_approval_persons sap");
        $this->db->join("sales_order so","so.sales_id=sap.sales_order_id");
        $this->db->join("customer c","c.customer_id=so.customer_id","left");
        $this->db->join("user u","u.user_id=sap.user_id","left");
        $this->db->where("so.sales_status",  24);
        $this->db->group_by("sap.sales_order_id");
        return $this->db->get()->result_array();
    }
    
    public function get_waiting_allocate_list()
    {
        $this->db->select("so.sales_code,c.customer_name,so.order_date,u.username as sales_person,so.sales_id as id");
        $this->db->from("sales_order so");
        $this->db->join("customer c","c.customer_id=so.customer_id","left");
        $this->db->join("user u","u.user_id=so.sales_person_id","left");
        $this->db->where_in("so.sales_status",  array(3,10));
        return $this->db->get()->result_array();
    }
    
    public function get_list_for_create_schedule($sales_id=NULL)
    {
        $this->db->select("so.sales_code,c.customer_name,so.order_date,u.username as sales_person,so.sales_id,dm.delivery_mode_name");
        $this->db->from("sales_order so");
        $this->db->join("customer c","c.customer_id=so.customer_id","left");
        $this->db->join("user u","u.user_id=so.sales_person_id","left");
        $this->db->join("delivery_mode dm","dm.delivery_mode_id=so.delivery_mode_id","left");
        $this->db->where("so.sales_status", 25);
        if($sales_id)
        {
            $this->db->or_where_in("so.sales_id",array($sales_id));
        }
        
        return $this->db->get()->result_array();
    }
    
    public function svfst($schedule_id)
    {
        $this->db->select("schedule_code,schedule_time,delivery_address_id,van_id");
        $this->db->from("delivery_schedule");
        $this->db->where("delivery_schedule_id",$schedule_id);
        return $this->db->get()->row();
    }

    public function psm_so($post_info)
    {
        if($post_info['schedule_id'])
        {
            $schedule_info = $this->db->query("SELECT sales_id FROM delivery_schedule WHERE delivery_schedule_id=".$post_info['schedule_id'])->row();
            $sales_id = implode(',',json_decode($schedule_info->sales_id));
            
            
            $this->db->where_in('sales_id',$sales_id);
            $this->db->update('sales_order',array('sales_status'=>25));
            
            $this->db->where_in('sale_order_id',(int)$sales_id);
            $result = $this->db->update('product_stock_manager', array(
                'sale_status_id'=>25,
                'status_id'=>25
            ));
        }
        foreach ($post_info['sales_id'] as $key=>$val)
        {
            $this->db->where('sales_id', $val);
            $this->db->update('sales_order', array(
                'sales_status'=>26
            ));
            
            $this->db->where('sale_order_id', $val);
            $this->db->update('product_stock_manager', array(
                'sale_status_id'=>26,
                'shipment_date'=>$post_info['delivery_time'],
                'packing_slip_date'=>date('Y-m-d'),
                'status_id'=>26,
                'customer_warranty_start_date'=>date('Y-m-d')
            ));
        }
        
        $this->db->select("sale_order_id,product_id,customer_warranty_start_date,customer_warranty_period");
        $this->db->from("product_stock_manager");
        $this->db->where_in("sale_order_id",implode (",", $post_info['sales_id']));
        $sales_info = $this->db->get();
        foreach ($sales_info->result() as $si)
        {
            $wending_date = date("Y-m-d", strtotime("+".(($si->customer_warranty_period)?$si->customer_warranty_period:0)." month",strtotime($si->customer_warranty_start_date)));
            $this->db->where('sale_order_id', $si->sale_order_id);
            $this->db->where('product_id',$si->product_id);
            $this->db->update('product_stock_manager', array(
                'customer_warranty_end_date'=>$wending_date
            ));
        }
       
        //debug($this->db->last_query(),1);
    }
    
    
    public function sales_order_complete($schedule_id)
    {        
        $schedule_info = $this->db->query("SELECT sales_id FROM delivery_schedule WHERE delivery_schedule_id=".$schedule_id)->row();
        $sales_id = implode(',',json_decode($schedule_info->sales_id));
        
        $this->db->where_in('delivery_schedule_id',$schedule_id);
        $this->db->update('delivery_schedule',array('delivery_status'=>27));
        
        $this->db->where_in('sales_id',$sales_id);
        $this->db->update('sales_order',array('sales_status'=>27));

        $this->db->where_in('sale_order_id',$sales_id);
        $result = $this->db->update('product_stock_manager', array(
            'sale_status_id'=>27,
            'status_id'=>27,
            'sold_date'=>date('Y-m-d')
        ));
    }
    
    
    public function active_schedules()
    {
        $this->db->select("ds.delivery_schedule_id,ds.sales_id,ds.schedule_code,ds.schedule_time,");
        $this->db->select("da.address");
        $this->db->select("dv.van_no");
        $this->db->select("dd.driver_name");
        $this->db->from("delivery_schedule ds");
        $this->db->join("delivery_address da","da.delivery_address_id=ds.delivery_address_id","left");
        $this->db->join("delivery_van dv","dv.delivery_van_id=ds.van_id","left");
        $this->db->join("delivery_driver dd","dd.delivery_driver_id=dv.driver_id");
        $this->db->where("ds.delivery_status",26);
        $this->db->where("ds.status",1);
        return $this->db->get();
    }

    

    public function get_waiting_for_quotation_approve_list()
    {
        $this->db->select("q.quotation_code,c.customer_name,q.quotation_date,u.username as sales_person,r.quotation_id as id");
        $this->db->from("remark_persons r");
        $this->db->join("quotation q","q.quotation_id=r.quotation_id");
        $this->db->join("customer c","c.customer_id=q.customer_id","left");
        $this->db->join("user u","u.user_id=q.sales_person","left");
        $this->db->where("r.remark_user_id",  $this->session->userdata('USER_ID'));
        $this->db->where("q.quotation_status",  23);
        $this->db->group_by("r.quotation_id");
        return $this->db->get()->result_array();
    }
    
    public function quotation_details($quotation_id)
    {
        $this->db->select('q.quotation_id,q.quotation_code,DATE(q.quotation_date) AS date,q.exchange_rate');
        $this->db->select('c.customer_id,c.customer_name,c.address,c.mobile_number,c.credit_limit');
        $this->db->select('ct.customer_type_name');
        $this->db->select('u.username');
        $this->db->select('s.status_name');
        $this->db->from('quotation q');
        $this->db->join('customer c','c.customer_id=q.customer_id','left');
        $this->db->join('customer_type ct','ct.customer_type_id=c.customer_type_id');
        $this->db->join('user u','u.user_id=q.sales_person','left');
        $this->db->join('status s','s.status_id=q.quotation_status');
        $this->db->where('q.quotation_id',$quotation_id);
        return $this->db->get()->row();
    }
    
    public function quotation_item_list($quotation_id)
    {
        $this->db->select('qd.quotation_price,qd.quotation_price_usd,qd.quantity');
        $this->db->select('p.product_name');
        $this->db->from('quotation_details qd');
        $this->db->join('product p','p.product_id=qd.product_id','left');
        $this->db->where('qd.quotation_id',$quotation_id);
        return $this->db->get()->result_array();
    }
    
    public function remarks_history($quotation_id)
    {
        $this->db->select('r.comments,r.date');
        $this->db->select('u.username');
        $this->db->from('remark_persons r');
        $this->db->join('user u','u.user_id=r.remark_user_id','left');
        $this->db->where('r.quotation_id',$quotation_id);
        return $this->db->get()->result_array();
    }
    
    public function myremark($quotation_id)
    {
        $this->db->select('comments');
        $this->db->from('remark_persons');
        $this->db->where('quotation_id',$quotation_id);
        $this->db->where('remark_user_id',$this->session->userdata('USER_ID'));
        return $this->db->get()->row();
    }

    public function ifremarked($quotation_id)
    {
        $this->db->select('comments_type');
        $this->db->from('remark_persons');
        $this->db->where('quotation_id',$quotation_id);
        $rows = $this->db->get();
        
        $html = '';
        if($rows->num_rows() > 0)
        {
            $remarktype = 0;
            $approvetype = 0;
            $done = 0;
            foreach ($rows->result() as $key=>$row)
            {
                if($row->comments_type == 1)
                {
                    $remarktype = $remarktype+1;
                }
                else if($row->comments_type == 2)
                {
                    $approvetype = $approvetype+1;
                }
                else if($row->comments_type == 3)
                {
                    $done = $done+1;
                }
            }
            $quotation_status = $this->db->query("SELECT quotation_status FROM quotation WHERE quotation_id=".$quotation_id)->row();
            if(($approvetype == $rows->num_rows()) && ($quotation_status->quotation_status == 22))
            {
                $html .= '<button class="btn btn-primary btn-sm">Print</button>';
            }
            else if($done == $rows->num_rows())
            {
                $html .= '<span style="color:#008000;">approve done.</span>';
            }
            else if($remarktype > 0)
            {
                $html .= '<span style="color:#f00;">Waiting for all approval person remarks.</span>';
            }
            else if($approvetype > 0)
            {
                $html .= '<button class="btn btn-primary btn-sm">Print</button>';
                $html .= '<a href="'.base_url().'sales/add_new_from_quotation/'.$quotation_id.'" class="btn btn-primary btn-sm">Create Sales Order</a>';
            }
            
        }
        return $html;
    }

    /*this function create for 
     * when any sales order view (before sale) this function says the position of the order 
     * 
    */
//    public function ifsalesorderapproved($order_id)
//    {
//        $this->db->select('sales_status');
//        $this->db->from('sales_order');
//        $this->db->where('sales_id',$order_id);
//        $sales_status = $this->db->get()->row();
//        
//        if($sales_status->sales_status == 2)
//        {
//            return "1"; // one for send for approve and edit
//        }
//        else if($sales_status->sales_status == 3)
//        {
//            $this->db->select('comments_type');
//            $this->db->from('sales_approval_persons');
//            $this->db->where('sales_order_id',$order_id);
//            $this->db->group_by('comments_type');
//            $comments_result = $this->db->get();
//            if($comments_result->num_rows() > 0)
//            {
//                $forapprove = 0;
//                $approvedone = 0;
//                foreach ($comments_result->result() as $key=>$val)
//                {
//                    if($val->comments_type == 1)
//                    {
//                        $forapprove = $forapprove+1;
//                    }
//                    else if($val->comments_type == 2)
//                    {
//                        $approvedone = $approvedone+1;
//                    }
//                }
//                if($comments_result->num_rows() == $forapprove)
//                {
//                    return 2; // two for waiting for approve and edit
//                }
//                else if($comments_result->num_rows() == $approvedone)
//                {
//                    return 4; // four for approved
//                }
//                else
//                {
//                    return 3; // three for waiting for approve
//                }
//            }
//        }
//        else if($sales_status->sales_status == 24)
//        {
//            return 4; // four for approved
//        }
//        else if($sales_status->sales_status == 27)
//        {
//            return 5; // five for sold order
//        }
//        else if($sales_status->sales_status == 10)
//        {
//            return 6; // six for waiting for allocate
//        }
//    }    
    public function sales_status_position_after_sales_order_proved($sales_id)
    {
        return $this->db->query("SELECT sales_status FROM sales_order WHERE sales_id=".$sales_id)->row();
    }

    public function get_ordered_product($order_id){            
            $this->db->select("sales_order_details.product_id,sales_order_details.quantity,product.product_name");
            $this->db->from("sales_order_details");
           // $this->db->join("sales_order_details",'sales_order.sales_id=sales_order_details.sales_order_id');
            $this->db->join("product",'product.product_id=sales_order_details.product_id');
            $this->db->where("sales_order_id",$order_id,false);
            $result= $this->db->get();
            //echo $this->db->last_query();
            //exit();
            return $result->result_array();
    }
    
     public function get_available_product_list($ordered_item){
         
            $sql = "SELECT
                        `product_stock_manager`.*, `vendor`.`vendor_name`,
                        `warehouse`.`warehouse_name`
                            FROM
                                (`product_stock_manager`)
                                LEFT JOIN `vendor` ON `product_stock_manager`.`vendor_id` = `vendor`.`vendor_id`
                                LEFT JOIN `warehouse` ON `product_stock_manager`.`current_warehouse_location` = `warehouse`.`warehouse_id`
                                LEFT JOIN `status` ON `product_stock_manager`.`sale_status_id` = `status`.`status_id`
                                    WHERE
                                        `product_stock_manager`.`product_id` = $ordered_item
					AND (`product_stock_manager`.`sale_status_id` = 18
					OR `product_stock_manager`.`sale_status_id` = 19)
                                    ORDER BY
                                        `product_stock_manager`.`warranty_start_date` ASC";			
            $result= $this->db->query($sql);
			//echo $this->db->last_query();
            return $result->result_array();
     }
     
     public function get_alocation_info($order_id){
         $this->db->select("product_stock_manager.product_id,product_name,Count(product_stock_manager.sale_status_id) as qty",false);
         $this->db->from("product_stock_manager");
         $this->db->join("product","product_stock_manager.product_id=product.product_id");
         $this->db->where("product_stock_manager.sale_order_id",$order_id,false);
         $this->db->where("product_stock_manager.sale_status_id",17);
         $this->db->group_by("product_stock_manager.product_id");
         $result = $this->db->get();
         return $result->result_array();
     }
     
     public function sales_status_change($p_code,$serial_no,$status,$order_id){
         $update_data = array('sale_status_id'=>$status,'sale_order_id'=>$order_id);
         
         $this->db->where('product_code',$p_code);
         $this->db->where('serial_number',$serial_no);
         $this->db->update('product_stock_manager',$update_data);
         return $this->db->last_query();
     }
     
     
     public function get_allocated_product_list($product_id,$order_id){
            
            $this->db->select("product_stock_manager.*,vendor.vendor_name,warehouse.warehouse_name");
            $this->db->from("product_stock_manager");
            $this->db->join("vendor",'product_stock_manager.vendor_id = vendor.vendor_id','left');
            $this->db->join("warehouse",'product_stock_manager.current_warehouse_location = warehouse.warehouse_id','left');
            $this->db->join("status",'product_stock_manager.sale_status_id = status.status_id','left');
            $this->db->where("product_stock_manager.product_id",$product_id,false);
            $this->db->where("product_stock_manager.sale_order_id",$order_id,false);
            $this->db->where("product_stock_manager.sale_status_id",17);
            //$this->db->or_where("product_stock_manager.sale_status_id",19);
            $this->db->order_by("product_stock_manager.warranty_start_date", "asc");
            $result= $this->db->get();
//            echo $this->db->last_query();
//            exit();
            return $result->result_array();
     }
	 
    public function get_cost_component_list($order_id){
        $this->db->select("*,cost_component.cost_component_name");
        $this->db->from("sales_cost_component");
        $this->db->join("cost_component",'cost_component.cost_component_id=sales_cost_component.cost_component_id', "LEFT");
        $this->db->where("sales_order_id",$order_id,false);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_cost_component_list_for_quotation($quotation_id){
        $this->db->select("quotation_cost_component.*,cost_component.cost_component_name");
        $this->db->from("quotation_cost_component");
        $this->db->join("cost_component",'cost_component.cost_component_id=quotation_cost_component.cost_component_id', "LEFT");
        $this->db->where("quotation_id",$quotation_id,false);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_support_doc_list($order_id){
        $this->db->select("*");
        $this->db->from("sales_supporting_doc");
        $this->db->where("sales_order_id",$order_id);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    
    public function get_selected_product_group($order_id=NULL,$table,$field)
    {
        $this->db->select("product.product_group_id,product.region_id,sales_order_details.sales_order_id,sales_order_details.sales_order_details_id,".$table.".".$field);
        
        $this->db->from("sales_order_details");
        $this->db->join("product",'product.product_id=sales_order_details.product_id', 'LEFT');
        $this->db->join("product_category",'product.product_category_id = product_category.product_category_id', 'LEFT');
        if($table == "region")
        {
            $this->db->join("region",'region.region_id = product.region_id', 'LEFT');
        }
        else if($table == "product_group")
        {
            $this->db->join("product_group",'product.product_group_id = product_group.product_group_id', 'LEFT');
        }
        if($order_id)
        {
            $this->db->where("sales_order_details.sales_order_id",$order_id,FALSE);
        }
        
        $this->db->group_by($table.".".$field);
        $this->db->order_by($table.".".$field);
        $result= $this->db->get();
        //debug($this->db->last_query(),1);
        return $result->result_array();
    }
    
    public function get_selected_product2($order_details_id,$field,$table){
            $this->db->select("sales_order_details.*,product.product_name,product.product_details_json,product.product_code,product.model_name,product_category.product_category_name",false);
            $this->db->from("sales_order_details");
            $this->db->join("product",'product.product_id=sales_order_details.product_id', 'LEFT');
            $this->db->join("product_category",'product.product_category_id = product_category.product_category_id', 'LEFT');
            $this->db->where("sales_order_details.sales_order_id ",$order_details_id,FALSE);
            if($table == 'region')
            {
                $this->db->where("product.region_id",$field,FALSE);
            }
            else if($table == 'product_group')
            {
                $this->db->where("product.product_group_id",$field,FALSE);
            }
            
            $this->db->order_by("product.product_name");
            $result= $this->db->get();
            return $result->result_array();
    }
    
    public function front_desk_customer_id($sales_id)
    {
        $this->db->select("customer_id");
        $this->db->from("sales_order");
        $this->db->where("sales_id",$sales_id);
        return $this->db->get()->row();
    }

}
