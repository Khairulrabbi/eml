<?php

class Requisition_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function get_selected_product_group($order_id=NULL,$table,$field,$proforma_invoice_id=NULL)
    {
        $this->db->select("product.product_group_id,product.region_id,stock_requisition_details.stock_requisition_id,stock_requisition_details.stock_requisition_details_id,".$table.".".$field);
        $this->db->from("stock_requisition_details");
        $this->db->join("product",'product.product_id=stock_requisition_details.product_id', 'LEFT');
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
            $this->db->where("stock_requisition_details.stock_requisition_id ",$order_id,FALSE);
        }
        
        $this->db->group_by($table.".".$field);
        $this->db->order_by($table.".".$field);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    
    public function get_selected_product2($order_details_id,$field,$table,$pi=NULL){
        $this->db->select("stock_requisition_details.*,product.product_name,product.product_details_json,product.product_code,product.model_name,product_category.product_category_name",false);
        $this->db->from("stock_requisition_details");
        $this->db->join("product",'product.product_id=stock_requisition_details.product_id', 'LEFT');
        $this->db->join("product_category",'product.product_category_id = product_category.product_category_id', 'LEFT');
        $this->db->where("stock_requisition_details.stock_requisition_id ",$order_details_id,FALSE);
        if($table == 'region')
        {
            $this->db->where("product.region_id",$field,FALSE);
        }
        else if($table == 'product_group')
        {
            $this->db->where("product.product_group_id",$field,FALSE);
        }
        if($pi)
        {
            $this->db->group_by("stock_requisition_details.product_id");
        }

        $this->db->order_by("product.product_name");
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_all_requisition_history($where = " WHERE 1"){
        //if($this->session->userdata("LOCATION_ID") != 1)
//        if(stock_view_privilege_wise())
//         {
//             $where.=" AND warehouse.location_id=".$this->session->userdata("LOCATION_ID");
//         }
        $previlige = stock_view_privilege_wise();
        if($previlige == FALSE)
        {
                $where .= " AND stock_requisition.created_by IN (SELECT user_id FROM user WHERE location_id=".$this->session->userdata('LOCATION_ID').")";
        }
        $sql = "SELECT stock_requisition.stock_requisition_id,stock_requisition.requisition_code,stock_requisition.request_date_for_delivery,stock_requisition.requisition_status,status.status_name,warehouse.warehouse_name
                FROM	stock_requisition 
                LEFT JOIN  status ON stock_requisition.requisition_status = status.status_id 
                LEFT JOIN warehouse ON stock_requisition.warehouse_id = warehouse.warehouse_id ".$where." ORDER BY stock_requisition.stock_requisition_id DESC";
               $result= $this->db->query($sql);
               return $result->result_array();
    }
    
    public function requisition_details($requisition_id){

        $sql = "SELECT
                stock_requisition.stock_requisition_id,
                stock_requisition.requisition_code,
                stock_requisition.created,
                stock_requisition.request_date_for_delivery,
                user.username,
                status.status_name,
                warehouse.warehouse_name,
                stock_requisition.requisition_status
                FROM
                stock_requisition
                LEFT JOIN status ON stock_requisition.requisition_status = status.status_id
                LEFT JOIN warehouse ON stock_requisition.warehouse_id = warehouse.warehouse_id
                LEFT JOIN user ON stock_requisition.created_by = user.user_id
                WHERE stock_requisition.stock_requisition_id=".$requisition_id;
               $result= $this->db->query($sql);
               return $result->row();
    }
    
    public function get_waiting_approval_list_for_requisition($u_id){
            $this->db->select("stock_requisition.*");
            $this->db->from("delegation_by_ref");
            $this->db->join("stock_requisition",'stock_requisition.current_delegation_step=delegation_by_ref.step_number AND delegation_by_ref.ref_no =stock_requisition.requisition_code',"inner");
            $this->db->where("delegation_by_ref.userid",$u_id);
            $result = $this->db->get();
            return $result->result_array();
    }
    
    public function requisition_item_info($requisition_id){

        $sql = "SELECT
                stock_requisition_details.stock_requisition_id,
                stock_requisition_details.chalan_quantity,
                stock_requisition_details.request_quantity,
                stock_requisition_details.approved_quantity,
                product.product_id,
                product.product_name,
                product.product_code,
                product.product_details_json
                FROM
                stock_requisition_details
                LEFT JOIN product ON product.product_id = stock_requisition_details.product_id
                LEFT JOIN stock_requisition ON stock_requisition.stock_requisition_id = stock_requisition_details.stock_requisition_id
                WHERE
                stock_requisition_details.stock_requisition_id =".$requisition_id;
                $result= $this->db->query($sql);
                //debug($this->db->last_query(),1);
                return $result->result_array();
    }
    
    public function get_chalan_info($requisition_id,$type){
        $chalan_info = "SELECT c.*, dto.warehouse_name as dtowarehouse, fr.warehouse_name as frwarehouse FROM chalan c
                LEFT JOIN warehouse dto ON dto.warehouse_id=c.delivery_to 
                LEFT JOIN warehouse fr ON fr.warehouse_id=c.delivery_from 
                WHERE chalan_type = '".$type."' AND chalan_type_id=".$requisition_id;
        $result= $this->db->query($chalan_info);
        return $result->result_array();
    }
    
    public function chalan_info_details_info($chalan_id)
    {
        $this->db->select("p.product_name,p.product_code,p.product_details_json,cd.quantity,cd.chalan_id");
        $this->db->from("chalan_details cd");
        $this->db->join("product p","p.product_id=cd.product_id","left");
        $this->db->where("cd.chalan_id",$chalan_id);
        $result =  $this->db->get()->result_array();
        //debug($result,1);
        return $result;
    }

        public function get_all_requisition_search_history($where){
        $sql = "SELECT stock_requisition.stock_requisition_id,stock_requisition.requisition_code,stock_requisition.request_date_for_delivery,stock_requisition.requisition_status,status.status_name,warehouse.warehouse_name
                FROM	stock_requisition 
                LEFT JOIN  status ON stock_requisition.requisition_status = status.status_id 
                LEFT JOIN warehouse ON stock_requisition.warehouse_id = warehouse.warehouse_id 
                WHERE $where ";
               $result= $this->db->query($sql);
               return $result->result_array();
    }
    
    public function get_all_deligation_information($requisition_id){
        $info = "SELECT
                user.username,
                sr_delegation.step_number,
                sr_delegation.sort_number,
                sr_delegation.must_approve
                FROM sr_delegation
                LEFT JOIN user ON user.user_id = sr_delegation.userid
                WHERE sr_delegation.stock_requisition_id=".$requisition_id;
        $result = $this->db->query($info);
        return $result->result_array();
    }
    
    
    public function get_requisition_info($order_id){
        $this->db->select("stock_requisition.*,status.status_name");
        $this->db->from("stock_requisition");
        $this->db->join("status","status.status_id=stock_requisition.requisition_status","left");
        $this->db->where("stock_requisition.stock_requisition_id",$order_id,FALSE);
        $result= $this->db->get();
        return $result->row();
    }
    
    public function get_cart_product_list($table,$field)
    {
        $join = '';
        if($table == 'region')
        {
            $join .= 'LEFT JOIN region ON region.region_id=product.region_id ';
        }
        else if($table == 'product_group')
        {
            $join .= 'LEFT JOIN product_group ON product_group.product_group_id=product.product_group_id ';
        }
        return $this->db->query("SELECT product.product_group_id,product.region_id,purchase_order_details.purchase_order_id,purchase_order_details.purchase_order_details_id,".$table.".".$field." 
                FROM product 
                LEFT JOIN product_category ON product.product_category_id=product_category.product_category_id 
                LEFT JOIN purchase_order_details ON purchase_order_details.product_id=product.product_id ".$join." 
                WHERE product.product_id IN(SELECT product_id FROM cart)")->result_array();
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

}
