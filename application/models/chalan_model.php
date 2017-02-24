<?php

class Chalan_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function requisition_info($requisition_id)
    {
        $this->db->select("stock_requisition.*,warehouse.warehouse_name");
        $this->db->from("stock_requisition");
        $this->db->join("warehouse","warehouse.warehouse_id=stock_requisition.warehouse_id","left");
        $this->db->where("stock_requisition.stock_requisition_id",$requisition_id); 
        $result = $this->db->get()->row();
        return $result;        
    }
    
    public function requisition_details($requisition_id,$warehouse_id)
    {
        return $this->db->query("
            SELECT p.product_id,p.product_code,p.product_details_json,srd.stock_requisition_details_id,srd.request_quantity,srd.approved_quantity,srd.chalan_quantity,p.product_name,
            (SELECT case when SUM(pgr.available_quantity) is null then 0 else SUM(pgr.available_quantity) end FROM purchase_good_receive pgr WHERE srd.product_id=pgr.product_id AND pgr.warehouse_id=".$warehouse_id.") as available_product
            FROM stock_requisition_details srd 
            LEFT JOIN product p ON p.product_id=srd.product_id 
            WHERE srd.stock_requisition_id=".$requisition_id)->result_array();
    }
    
    
    public function info_save_requisition_chalan($post)
    {
        $chalan_insert = array(
            'chalan_code'=>get_generated_code(4),
            'chalan_type'=>'Stock Transfer',
            'chalan_type_id'=>$post['requisition_id'],
            'delivery_from'=>$post['warehouse_id'],
            'delivery_to'=>$post['delivery_to'],
            'chalan_status'=>44,
            'created_by'=>$this->session->userdata('USER_ID'),
            'delivery_date'=>$post['delivery_date']            
        );
        
        $chalan_id = $this->common_model->save_data($chalan_insert,"chalan");
        
        $cdi = array(
            'chalan_id'=>$chalan_id,
            'chalan_type_details_id'=>$post['requisition_id'],
            'updated_by'=>$this->session->userdata('USER_ID')
        );
        foreach ($post['product_id'] as $pid)
        {
            $cdi['product_id'] = $pid;
            $cdi['quantity'] = $post['cnfrm_quantity'][$pid];
            $this->common_model->save_data($cdi,"chalan_details");
            
            $this->update_goods_receive_for_transfer($pid,$post['warehouse_id'],$post['delivery_to'],$post['approve_quantity'][$pid],$post['cnfrm_quantity'][$pid],$chalan_id);
            
            $this->db->query("UPDATE stock_requisition_details SET chalan_quantity=(chalan_quantity+".$post['cnfrm_quantity'][$pid].")  WHERE stock_requisition_id=".$post['requisition_id']." AND product_id=".$pid);
        }
          
        $this->db->select("chalan_quantity,approved_quantity");
        $this->db->from("stock_requisition_details");
        $this->db->where('stock_requisition_id',$post['requisition_id']);
        $srd = $this->db->get();
        $count = 0;
        foreach ($srd->result() as $srd_value)
        {
            if($srd_value->chalan_quantity != $srd_value->approved_quantity)
            {
                $count = $count+1;
            }
        }
        if($count == 0)
        {
            $this->db->where("stock_requisition_id",$post['requisition_id']);
            $this->db->update("stock_requisition",array("requisition_status"=>42)); // 42=requisition complete
        }
    }
    
    public function get_chalan_save_info($requisition_id){
        $this->db->select("s_r.requisition_code,c.delivery_date,w.warehouse_name as warehouse_from,w1.warehouse_name as warehouse_to");
        $this->db->from("chalan c");
        $this->db->join("stock_requisition s_r","s_r.stock_requisition_id=c.chalan_type_id","left");
        $this->db->join("warehouse w","w.warehouse_id=c.delivery_from","left");
        $this->db->join("warehouse w1","w1.warehouse_id=c.delivery_to","left");
        $this->db->where('s_r.stock_requisition_id',$requisition_id);
        $result=$this->db->get()->row();
        return $result;
    }
    
    public function get_chalan_save_info_for_sales($sales_id){
        $this->db->select("s_o.sales_code,c.delivery_date,w.warehouse_name as warehouse_from,w1.warehouse_name as warehouse_to");
        $this->db->from("chalan c");
        $this->db->join("sales_order s_o","s_o.sales_id=c.chalan_type_id","left");
        $this->db->join("warehouse w","w.warehouse_id=c.delivery_from","left");
        $this->db->join("warehouse w1","w1.warehouse_id=c.delivery_to","left");
        $this->db->where('s_o.sales_id',$sales_id);
        $result=$this->db->get()->row();
        return $result;
    }
    
    public function get_chalan_product_save_info($id){
        $this->db->select("p.*,c_d.quantity as chalan_quantity");
        $this->db->from("product p");
        $this->db->join("chalan_details c_d","c_d.product_id=p.product_id","left");
        $this->db->where('c_d.chalan_type_details_id',$id);
        $result=$this->db->get()->result_array();
        return $result;
    }

        public function info_save_sales_chalan($post)
    {
        if($post['ps_type'] == 'sales')
        {
            $chalan_type = 'Sale';
            $chalan_type_id = $post['sales_id'];
            $delivery_to = $post['customer_id'];
        }
        else if($post['ps_type'] == 'requisition')
        {
            $chalan_type = 'Requisition';
            $chalan_type_id = $post['requisition_id'];
            $delivery_to = $post['delivery_to'];
        }
        
        $chalan_insert = array(
            'chalan_code'=>get_generated_code(4),
            'chalan_type'=>$chalan_type,
            'chalan_type_id'=>$chalan_type_id,
            'delivery_from'=>$post['warehouse_id'],
            'delivery_to'=>$delivery_to,
            'chalan_status'=>44,
            'created_by'=>$this->session->userdata('USER_ID'),
            'delivery_date'=>$post['delivery_date']            
        );
        
        $chalan_id = $this->common_model->save_data($chalan_insert,"chalan");
        
        $cdi = array(
            'chalan_id'=>$chalan_id,
            'chalan_type_details_id'=>$chalan_type_id,
            'updated_by'=>$this->session->userdata('USER_ID')
        );
        foreach ($post['product_id'] as $pid)
        {
            $cdi['product_id'] = $pid;
            $cdi['quantity'] = $post['cnfrm_quantity'][$pid];
            $this->common_model->save_data($cdi,"chalan_details");
            
            $this->update_goods_receive_for_transfer2($pid,$post['warehouse_id'],$delivery_to,$post['approve_quantity'][$pid],$post['cnfrm_quantity'][$pid],$chalan_id,$chalan_type);
            if($chalan_type == "Sale")
            {
                $this->db->query("UPDATE sales_order_details SET chalan_quantity=(chalan_quantity+".$post['cnfrm_quantity'][$pid].")  WHERE sales_order_id=".$chalan_type_id." AND product_id=".$pid);
            }
            else if($chalan_type == "Requisition")
            {
                $this->db->query("UPDATE stock_requisition_details SET chalan_quantity=(chalan_quantity+".$post['cnfrm_quantity'][$pid].")  WHERE stock_requisition_id=".$chalan_type_id." AND product_id=".$pid);
            }
            
        }
        
        if($chalan_type == "Requisition")
        {
            $this->db->select("chalan_quantity,approved_quantity");
            $this->db->from("stock_requisition_details");
            $this->db->where('stock_requisition_id',$chalan_type_id);
            $srd = $this->db->get();
            $count = 0;
            foreach ($srd->result() as $srd_value)
            {
                if($srd_value->chalan_quantity != $srd_value->approved_quantity)
                {
                    $count = $count+1;
                }
            }
            if($count == 0)
            {
                $this->db->where("stock_requisition_id",$chalan_type_id);
                $this->db->update("stock_requisition",array("requisition_status"=>42)); // 42=requisition complete
            }
        }
        
    }
    
    
    public function info_save_chalan($post)
    {
        //debug($post,1);
        if($post['ps_type'] == 'sales')
        {
            $chalan_type = 'Sale';
            $chalan_type_id = $post['sales_id'];
            $delivery_to = $post['customer_id'];
            $chalan_status = 44;
        }
        else if($post['ps_type'] == 'counter')
        {
            $chalan_type = 'Counter';
            $chalan_type_id = $post['sales_id'];
            $delivery_to = $post['customer_id'];
            $chalan_status = 45;
        }
        else if($post['ps_type'] == 'requisition')
        {
            $chalan_type = 'Stock Transfer';
            $chalan_type_id = $post['requisition_id'];
            $delivery_to = $post['delivery_to'];
            $chalan_status = 44;
        }
        
        
        
        $chalan_insert = array(
            'chalan_code'=>get_generated_code(4),
            'chalan_type'=>$chalan_type,
            'chalan_type_id'=>$chalan_type_id,
            'delivery_from'=>$post['warehouse_id'],
            'delivery_to'=>$delivery_to,
            'chalan_status'=>$chalan_status,
            'created_by'=>$this->session->userdata('USER_ID'),
            'delivery_date'=>$post['delivery_date']            
        );
        
        $chalan_id = $this->common_model->save_data($chalan_insert,"chalan");
        
        $cdi = array(
            'chalan_id'=>$chalan_id,
            'chalan_type_details_id'=>$chalan_type_id,
            'updated_by'=>$this->session->userdata('USER_ID')
        );
        foreach ($post['product_id'] as $pid)
        {
            $cdi['product_id'] = $pid;
            $cdi['quantity'] = $post['cnfrm_quantity'][$pid];
            if($post['cnfrm_quantity'][$pid] > 0)
            {
                $this->common_model->save_data($cdi,"chalan_details");
            }
            
            
            $this->update_goods_receive_for_transfer3($pid,$post['warehouse_id'],$delivery_to,$post['approve_quantity'][$pid],$post['cnfrm_quantity'][$pid],$chalan_id,$chalan_type);
            if(($chalan_type == "Sale") || ($chalan_type == "Counter"))
            {
                $this->db->query("UPDATE sales_order_details SET chalan_quantity=(chalan_quantity+".$post['cnfrm_quantity'][$pid].")  WHERE sales_order_id=".$chalan_type_id." AND product_id=".$pid);
            }
            else if($chalan_type == "Stock Transfer")
            {
                $this->db->query("UPDATE stock_requisition_details SET chalan_quantity=(chalan_quantity+".$post['cnfrm_quantity'][$pid].")  WHERE stock_requisition_id=".$chalan_type_id." AND product_id=".$pid);
                //debug($this->db->last_query(),1);
            }
            
        }
        if($chalan_type == "Counter")
        {
            $this->db->where("sales_id",$chalan_type_id);
            $this->db->update("sales_order",array("sales_status"=>27)); // 27=sold
        }
        if($chalan_type == "Stock Transfer")
        {
            $this->db->select("chalan_quantity,approved_quantity");
            $this->db->from("stock_requisition_details");
            $this->db->where('stock_requisition_id',$chalan_type_id);
            $srd = $this->db->get();
            $count = 0;
            foreach ($srd->result() as $srd_value)
            {
                if($srd_value->chalan_quantity != $srd_value->approved_quantity)
                {
                    $count = $count+1;
                }
            }
            if($count == 0)
            {
                $this->db->where("stock_requisition_id",$chalan_type_id);
                $this->db->update("stock_requisition",array("requisition_status"=>42)); // 42=requisition complete
            }
        }
        
    }
    
    public function update_goods_receive_for_transfer3($product_id,$warehouse_from,$warehouse_delivery,$approve_quantity,$confirm_quantity,$chalan_id,$chalan_type)
    {
        $this->db->select("*");
        $this->db->from("purchase_good_receive");
        $this->db->where("warehouse_id",$warehouse_from);
        $this->db->where("product_id",$product_id);
        $this->db->where("good_receive_status_id",45);
        $this->db->order_by("purchase_good_receive_id","ASC");
        $rows = $this->db->get()->result();
        //debug($rows,1);
        $check_loop = $confirm_quantity;
        $receive_insert = 0;
        $receive = 0;
        $stock = 0;
        $tqty = 0;
        foreach ($rows as $row)
        {
            if($row->available_quantity > 0)
            {
                if($row->available_quantity >= $confirm_quantity)
                {
                   $stock = $row->available_quantity - $confirm_quantity; 
                   $receive_insert = $confirm_quantity;
                   $receive += $confirm_quantity;
                   $tqty = $confirm_quantity;
                }
                else if($row->available_quantity < $confirm_quantity)
                {
                    $confirm_quantity = $confirm_quantity - $row->available_quantity;
                    $tqty = $row->available_quantity;
                    $receive_insert = $row->available_quantity;
                    $receive += $row->available_quantity;
                    $stock = 0;
                }
                
                if(($chalan_type == "Sale") || ($chalan_type == "Counter"))
                {
                    $this->db->query("UPDATE purchase_good_receive SET available_quantity=".$stock.", sold_quantity = (sold_quantity+$tqty) WHERE purchase_good_receive_id=".$row->purchase_good_receive_id);
                }
                else if($chalan_type == "Stock Transfer")
                {
                    $this->db->query("UPDATE purchase_good_receive SET available_quantity=".$stock.", transfer_quantity = (transfer_quantity+$tqty) WHERE purchase_good_receive_id=".$row->purchase_good_receive_id);
                    if($receive_insert > 0)
                    {
                        $this->db->insert("purchase_good_receive",array(
                            "purchase_id"=>$row->purchase_id,
                            "purchase_order_details_id"=>$row->purchase_order_details_id,
                            "chalan_id"=>$chalan_id,
                            "product_id"=>$row->product_id,
                            "indent_number"=>$row->indent_number,
                            "warehouse_id"=>$warehouse_delivery,
                            "receive_quantity"=>$receive_insert,
                            "available_quantity"=>$receive_insert,
                            "good_receive_status_id"=>44,
                            "transfer_from"=>$warehouse_from,
                            "created_by"=>$this->session->userdata("USER_ID")                    
                        ));
                    }                    
                }
                
            }
            
            if($check_loop == $receive)
            {
                break;
            }
        }
    }
    
    
    
    public function update_goods_receive_for_transfer2($product_id,$warehouse_from,$warehouse_delivery,$approve_quantity,$confirm_quantity,$chalan_id,$chalan_type)
    {
        $this->db->select("*");
        $this->db->from("purchase_good_receive");
        $this->db->where("warehouse_id",$warehouse_from);
        $this->db->where("product_id",$product_id);
        $this->db->where("good_receive_status_id",45);
        $this->db->order_by("purchase_good_receive_id","ASC");
        $rows = $this->db->get()->result();
        //debug($rows,1);
        $check_loop = $confirm_quantity;
        $receive_insert = 0;
        $receive = 0;
        $stock = 0;
        $tqty = 0;
        foreach ($rows as $row)
        {
            if($row->available_quantity > 0)
            {
                if($row->available_quantity >= $confirm_quantity)
                {
                   $stock = $row->available_quantity - $confirm_quantity; 
                   $receive_insert = $confirm_quantity;
                   $receive += $confirm_quantity;
                   $tqty = $confirm_quantity;
                }
                else if($row->available_quantity < $confirm_quantity)
                {
                    $confirm_quantity = $confirm_quantity - $row->available_quantity;
                    $tqty = $row->available_quantity;
                    $receive_insert = $row->available_quantity;
                    $receive += $row->available_quantity;
                    $stock = 0;
                }
                
                if($chalan_type == "Sale")
                {
                    $this->db->query("UPDATE purchase_good_receive SET available_quantity=".$stock.", sold_quantity = (sold_quantity+$tqty) WHERE purchase_good_receive_id=".$row->purchase_good_receive_id);
                }
                else if($chalan_type == "Requisition")
                {
                    $this->db->query("UPDATE purchase_good_receive SET available_quantity=".$stock.", transfer_quantity = (transfer_quantity+$tqty) WHERE purchase_good_receive_id=".$row->purchase_good_receive_id);
                
                    $this->db->insert("purchase_good_receive",array(
                        "purchase_id"=>$row->purchase_id,
                        "purchase_order_details_id"=>$row->purchase_order_details_id,
                        "chalan_id"=>$chalan_id,
                        "product_id"=>$row->product_id,
                        "indent_number"=>$row->indent_number,
                        "warehouse_id"=>$warehouse_delivery,
                        "receive_quantity"=>$receive_insert,
                        "available_quantity"=>$receive_insert,
                        "good_receive_status_id"=>44,
                        "transfer_from"=>$warehouse_from,
                        "created_by"=>$this->session->userdata("USER_ID")                    
                    ));
                }
                
            }
            
            if($check_loop == $receive)
            {
                break;
            }
        }
    }
    
    public function update_goods_receive_for_transfer($product_id,$warehouse_from,$warehouse_delivery,$approve_quantity,$confirm_quantity,$chalan_id)
    {
        $this->db->select("*");
        $this->db->from("purchase_good_receive");
        $this->db->where("warehouse_id",$warehouse_from);
        $this->db->where("product_id",$product_id);
        $this->db->order_by("purchase_good_receive_id","ASC");
        $rows = $this->db->get()->result();
        //debug($rows,1);
        $check_loop = $confirm_quantity;
        $receive_insert = 0;
        $receive = 0;
        $stock = 0;
        $tqty = 0;
        foreach ($rows as $row)
        {
            if($row->available_quantity > 0)
            {
                if($row->available_quantity >= $confirm_quantity)
                {
                   $stock = $row->available_quantity - $confirm_quantity; 
                   $receive_insert = $confirm_quantity;
                   $receive += $confirm_quantity;
                   $tqty = $confirm_quantity;
                }
                else if($row->available_quantity < $confirm_quantity)
                {
                    $confirm_quantity = $confirm_quantity - $row->available_quantity;
                    $tqty = $row->available_quantity;
                    $receive_insert = $row->available_quantity;
                    $receive += $row->available_quantity;
                    $stock = 0;
                }
                
                
                $this->db->query("UPDATE purchase_good_receive SET available_quantity=".$stock.", transfer_quantity = (transfer_quantity+$tqty) WHERE purchase_good_receive_id=".$row->purchase_good_receive_id);
                
                $this->db->insert("purchase_good_receive",array(
                    "purchase_id"=>$row->purchase_id,
                    "purchase_order_details_id"=>$row->purchase_order_details_id,
                    "chalan_id"=>$chalan_id,
                    "product_id"=>$row->product_id,
                    "indent_number"=>$row->indent_number,
                    "warehouse_id"=>$warehouse_delivery,
                    "receive_quantity"=>$receive_insert,
                    "available_quantity"=>$receive_insert,
                    "good_receive_status_id"=>44,
                    "transfer_from"=>$warehouse_from,
                    "created_by"=>$this->session->userdata("USER_ID")                    
                ));
            }
            
            if($check_loop == $receive)
            {
                break;
            }
        }
    }
    
    
    public function chalan_list($location,$status,$chalan_type)
    {
        return $this->db->query("SELECT
            chalan.chalan_code,chalan.chalan_id,
            (SELECT warehouse.warehouse_name FROM warehouse WHERE warehouse.warehouse_id=chalan.delivery_from) AS dfrom,
            (SELECT warehouse.warehouse_name FROM warehouse WHERE warehouse.warehouse_id=chalan.delivery_to) AS dto,
            chalan.chalan_type_id,
            chalan.chalan_id,
            chalan.delivery_date
            FROM
            chalan
            LEFT JOIN warehouse ON chalan.delivery_to = warehouse.warehouse_id
            LEFT JOIN location ON warehouse.location_id = location.location_id
            WHERE
            location.location_id = ".$location." AND
            chalan.chalan_status = ".$status." AND
            chalan.chalan_type = '".$chalan_type."' ORDER BY chalan.chalan_code DESC")->result();
    }
    
    public function chalan_info($c_id){
        $this->db->select("c.*,s.status_name,u.username");
        $this->db->from("chalan c");
        $this->db->join("status s","s.status_id=c.chalan_status","left");
        $this->db->join("user u","u.user_id=c.delivery_from","left");
        $this->db->where("c.chalan_id",$c_id);
        $result = $this->db->get()->row();
        return $result;
    }
    
    
    public function get_chalan_item_info($chalan_id){

        $sql = "SELECT
                chalan_details.chalan_details_id,
                chalan_details.quantity,
                product.product_id,
                product.product_name,
                product.product_code,
                product.product_details_json
                FROM
                chalan_details
                LEFT JOIN product ON product.product_id = chalan_details.product_id
                LEFT JOIN chalan ON chalan.chalan_id = chalan_details.chalan_details_id
                WHERE
                chalan_details.chalan_id ="."$chalan_id";
                $result= $this->db->query($sql);
                return $result->result_array();
    }
    
    
    
     public function sales_info($sales_id)
    {
        $sales_type = $this->db->select("sales_type")->from("sales_order")->where("sales_id",$sales_id)->get()->row();
       // debug($sales_type,1);
        $table = "";
        if($sales_type->sales_type == "vendor")
        {
            $table = "customer";
        }
        else if($sales_type->sales_type == "counter")
        {
            $table = "customer_front_desk_sale";
        }
        $this->db->select("sales_order.*,".$table.".customer_name,".$table.".mobile_number");
        $this->db->from("sales_order");
        $this->db->join($table,$table.".customer_id=sales_order.customer_id","left");
        $this->db->where("sales_order.sales_id",$sales_id);
        return $this->db->get()->row();
    }
    
    public function sales_details($sales_id,$warehouse_id)
    {
        $rows = $this->db->query("
            SELECT p.product_id,p.product_code,p.product_details_json,sod.sales_order_details_id,sod.quantity,sod.approve_quantity,sod.chalan_quantity,p.product_name,
            (SELECT case when SUM(pgr.available_quantity) is null then 0 else SUM(pgr.available_quantity) end FROM purchase_good_receive pgr WHERE sod.product_id=pgr.product_id AND pgr.warehouse_id=".$warehouse_id.") as available_product
            FROM sales_order_details sod 
            LEFT JOIN product p ON p.product_id=sod.product_id 
            WHERE sod.sales_order_id=".$sales_id)->result_array();   
        //debug($this->db->last_query(),1);
        return $rows;
    }
    
    public function get_all_chalan_list($type,$chalan_id=NULL)
    {
        $previlige = stock_view_privilege_wise();
       // debug($previlige,1);
        $this->db->select("chalan.chalan_id,chalan.chalan_code,chalan.chalan_id");
        $this->db->select("status.status_name");
        if($type == "Sale")
        {
            $this->db->select("sales_order.sales_id,sales_order.sales_code,customer.customer_name,customer.mobile_number");
        }
        else if($type == "requisition")
        {
            //$this->db->select("");
        }
        $this->db->select("warehouse.warehouse_name");
        $this->db->from("chalan");
        $this->db->join("warehouse","warehouse.warehouse_id=chalan.delivery_from","left");
        $this->db->join("status","status.status_id=chalan.chalan_status","left");
        
        if($type == "Sale")
        {
            $this->db->join("sales_order","sales_order.sales_id=chalan.chalan_type_id","left");
            $this->db->join("customer","customer.customer_id=chalan.delivery_to","left");
            $this->db->where("chalan.chalan_type",$type);
        }
        else if($type == "requisition")
        {
            //$this->db->select("");
        }
        
        
        $this->db->where("chalan.chalan_status",44);
        if($chalan_id)
        {
            $this->db->or_where_in("chalan.chalan_id",  explode(",",$chalan_id));
        }
        
        if($previlige == FALSE)
        {
            $this->db->where("warehouse.location_id",$this->session->userdata("LOCATION_ID"));
        }
        $result = $this->db->get()->result_array();
        //debug($this->db->last_query(),1);
        return $result;
    }
    
    
    public function get_chalan_order_details($type,$chalan_id=NULL)
    {
       
        if($type == "Sale")
        {
        $this->db->select("chalan.*");
        $this->db->select("status.status_name");
        $this->db->select("warehouse.warehouse_name");
        $this->db->select("user.username");
        $this->db->select("chalan_details.quantity");
        $this->db->select("customer.*");
        $this->db->from("chalan");
        $this->db->join("warehouse","warehouse.warehouse_id=chalan.delivery_from","left");
        $this->db->join("customer","customer.customer_id=chalan.delivery_to","left");
        $this->db->join("status","status.status_id=chalan.chalan_status","left");
        $this->db->join("user","user.user_id=chalan.created","left");
        $this->db->join("chalan_details","chalan_details.chalan_id=chalan.chalan_id","left");
        $this->db->where("chalan.chalan_id",$chalan_id);
        
        $result = $this->db->get()->row();
        //debug($this->db->last_query());
        return $result;
        }
    }
    
    
    public function get_chalan_order_details_print($type,$chalan_id=NULL)
    {
       
        if($type == "Sale")
        {
        $this->db->select("chalan.*");
       
        $this->db->select("warehouse.warehouse_name");
        $this->db->select("user.username");
        $this->db->select("chalan_details.quantity");
        $this->db->select("customer.*");
        $this->db->select("customer_address.*");
        $this->db->from("chalan");
        $this->db->join("warehouse","warehouse.warehouse_id=chalan.delivery_from","left");
        $this->db->join("customer","customer.customer_id=chalan.delivery_to","left");
        $this->db->join("user","user.user_id=chalan.created","left");
        $this->db->join("customer_address","customer_address.customer_id=customer.customer_id","left");
        $this->db->join("chalan_details","chalan_details.chalan_id=chalan.chalan_id","left");
        $this->db->where("chalan.chalan_id",$chalan_id);
        
        $result = $this->db->get()->row();
        //debug($this->db->last_query());
        return $result;
        }
    }
    
    
    public function get_chalan_item_list($chalan_id=NULL){
        $this->db->select("product.*");
        $this->db->select("chalan_details.quantity");
        $this->db->select("chalan_details.quantity");
        $this->db->from("product");
        $this->db->join("chalan_details","chalan_details.product_id=product.product_id","left");
        $this->db->where("chalan_details.chalan_id",$chalan_id);
        return $this->db->get()->result_array();
    }

    

    public function get_all_delivery_schedule_list($type)
    {
        $previlige = stock_view_privilege_wise();
        $this->db->select("delivery_schedule.delivery_schedule_id,delivery_schedule.chalan_type,delivery_schedule.chalan_id,delivery_schedule.schedule_code,delivery_schedule.schedule_time");
        $this->db->select("status.status_name");
        //$this->db->select("chalan.chalan_code");
        $this->db->select("delivery_address.address");
        if($type == "Sale")
        {
            //$this->db->select("sales_order.sales_code,sales_order.order_value,sales_order.order_date,sales_order.delivery_date,customer.customer_name,customer.mobile_number");
        }
        else if($type == "requisition")
        {
            //$this->db->select("");
        }
        //$this->db->select("warehouse.warehouse_name");
        $this->db->from("delivery_schedule");
        //$this->db->join("chalan","delivery_schedule.chalan_id=chalan.chalan_id","left");
        //$this->db->join("warehouse","warehouse.warehouse_id=chalan.delivery_from","left");
        $this->db->join("status","status.status_id=delivery_schedule.delivery_status","left");
        $this->db->join("delivery_address","delivery_address.delivery_address_id=delivery_schedule.delivery_address_id","left");
        
//        following join only use if the user not have gloval access
        $this->db->join("user","user.user_id=delivery_schedule.created_by","left");
        $this->db->join("location","location.location_id=user.location_id","left");
        $this->db->join("warehouse","warehouse.location_id=location.location_id","left");
        
        if($type == "Sale")
        {
            //$this->db->join("sales_order","sales_order.sales_id=chalan.chalan_type_id","left");
            //$this->db->join("customer","customer.customer_id=chalan.delivery_to","left");
            //$this->db->where("chalan.chalan_type",$type);
        }
        else if($type == "requisition")
        {
            //$this->db->select("");
        }
        $this->db->where("delivery_schedule.chalan_type",$type);
        $this->db->where("delivery_schedule.delivery_status",60);
        
        if($previlige == FALSE)
        {
            $this->db->where("warehouse.location_id",$this->session->userdata("LOCATION_ID"));
        }
        
        $this->db->group_by("delivery_schedule.schedule_code");
        $this->db->order_by("delivery_schedule.sorting");
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
        //debug($post_info,1);
        if($post_info['schedule_id'])
        {
            $schedule_info = $this->db->query("SELECT chalan_id FROM delivery_schedule WHERE delivery_schedule_id=".$post_info['schedule_id'])->row();
            $chalan_id = implode(',',json_decode($schedule_info->chalan_id));
            
            $this->db->query("UPDATE sales_order SET sales_status=44 WHERE sales_id IN (SELECT chalan_type_id FROM chalan WHERE chalan_id IN ($chalan_id) GROUP BY chalan_type_id)");
            $this->db->query("UPDATE chalan SET chalan_status=44 WHERE chalan_id IN ($chalan_id)");
        }
        foreach ($post_info['chalan_id'] as $key=>$val)
        {
            $this->db->where('chalan_id', $val);
            $this->db->update('chalan', array(
                'chalan_status'=>60
            ));
            
            if($post_info['chalan_type'] == 'Sale')
            {
                $this->db->query("UPDATE sales_order SET sales_status=26 WHERE sales_id=(SELECT chalan_type_id FROM chalan WHERE chalan_id=".$val.")");
            }
            else if($post_info['chalan_type'] == 'Requisition')
            {
                //
            }
        }
       
        //debug($this->db->last_query(),1);
    }
    
    public function sales_order_complete($schedule_ids)
    {
        foreach ($schedule_ids['allVals'] as $schedule_id)
        {
            $schedule_info = $this->db->query("SELECT chalan_id FROM delivery_schedule WHERE delivery_schedule_id=".$schedule_id)->row();
            $chalan_id = implode(",",json_decode($schedule_info->chalan_id));

            $this->db->where_in('delivery_schedule_id',$schedule_id);
            $this->db->update('delivery_schedule',array('delivery_status'=>45));
            $this->db->where_in('chalan_id',json_decode($schedule_info->chalan_id));
            $this->db->update('chalan',array('chalan_status'=>45));
            $this->db->where('sales_id IN (SELECT chalan_type_id FROM chalan WHERE chalan_id IN('.$chalan_id.') GROUP BY chalan_type_id)',NULL,FALSE);
            $this->db->update('sales_order',array('sales_status'=>27));
        }        
    }
    
    public function schedule_ordering_sql($data)
    {
        //debug($data,1);
        foreach ($data['order'] as $val)
        {
            $v = explode("_", $val);
            $this->db->where("delivery_schedule_id",$v[0]);
            $this->db->update("delivery_schedule",array("sorting"=>$v[1]));
        }
    }
}