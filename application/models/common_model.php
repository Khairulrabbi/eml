<?php
class Common_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function save_data($data, $table) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        
        public function update_data($data,$table,$where){
            $this->db->where($where);
            $this->db->update($table,$data);
            if(isset($where['purchase_id'])){
                return $where['purchase_id'];
            }
        }
        
        public function get_search_panel_info($id=NULL){
            $this->db->select("sp.*,u.username");
            $this->db->join("user u","u.user_id=sp.created_by","left");
            $this->db->from("search_panel sp");
            if($id){
                $this->db->where("sp.panel_id",$id);
                return $this->db->get()->row();
            }else{
               return $this->db->get()->result_array(); 
            }  
        }
        
        
        public function get_details_search_panel_info($id =NULL){
            $this->db->select("spd.*");
            $this->db->from("search_panel_details spd");
            if($id){
                $this->db->where("spd.panel_details_id",$id);
                return $this->db->get()->row();
            }else{
//                $this->db->order_by('spd.panel_details_id', 'DESC');
            return $this->db->get()->result_array(); }
            }  
        
        
        public function get_dropdown_info($id=NULL){
            $this->db->select("dl.*,u.username");
            $this->db->join("user u","u.user_id=dl.created_by","left");
            $this->db->from("dropdown_list dl");
            if($id){
                $this->db->where("dl.dd_id",$id);
                return $this->db->get()->row();
            }
            else
            {   
                
                return $this->db->get()->result_array();
            }
            
        }
        
        
        
    
        public function get_product_list($data,$module=NULL){
            if(($module == "sales") || ($module == "counter"))
            {
                $pl = $this->get_active_price_list_id($module);                
                $this->db->select("price_list_details.unit_price,price_list_details.unit_price_usd");
            }
            else
            {
                $this->db->select("product.unit_price_usd,product.unit_price");
            }
            $this->db->select("product.product_id,product.product_name,product.product_code,product.model_name,product.sdta,product.product_details_json");
           
            $this->db->select("region.region_name");
            $this->db->select("product_group.product_group_name");
            $this->db->select("SUM(purchase_good_receive.available_quantity) as total");
            $this->db->from("product");
            $this->db->join("purchase_good_receive","product.product_id=purchase_good_receive.product_id","left");
            $this->db->join("region","region.region_id=product.region_id","left");
            $this->db->join("product_group","product_group.product_group_id=product.product_group_id","left");
            if($module == "sales" || ($module == "counter"))
            {
                $this->db->join("price_list_details","price_list_details.product_id=product.product_id AND price_list_details.price_list_id=".$pl->price_list_id,"left");            
            }
            $this->db->where($data);
            $this->db->group_by("product.product_id");
            $result = $this->db->get()->result_array();
            //debug($this->db->last_query(),1);
            return $result;
        }
        
        public function get_active_price_list_id($module)
        {
            $list_type = ($module == "sales")?"Dealer":"Retail";
            $this->db->select("price_list_id");
            $this->db->from("price_list");
            $this->db->where("status","Active");
            $this->db->where("price_list_status",59);
            $this->db->where("list_type",$list_type);
            return $this->db->get()->row();
        }

                public function get_code_number($code_type=NULL)
        {
            switch ($code_type) {
            case 'purchase':
                return 'PO-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'sales':
                return 'SO-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'quotation':
                return 'QU-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'schedule':
                return 'SDL-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'token':
                return 'TO-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'ticket':
                return 'TK-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'requisition':
                return 'RQ-'.rand(0001,9999).'-'.rand(001,999);
                break;
            case 'chalan':
                return 'CHLN-'.rand(0001,9999).'-'.rand(001,999);
                break;
            default:
                return "NaN";
            }
        }
        
        public function warranty_count($warranty_count_type,$ending_date)
        {
            if($warranty_count_type == 'days')
            {
                if($ending_date)
                {
                    $result = floor((strtotime($ending_date)-strtotime(date('Y-m-d')))/(60*60*24));
                    return ($result > 0)?$result.'&nbsp;Days&nbsp;Left':-($result).'&nbsp;Days&nbsp;Over';
                }
                else
                {
                    return "No Warranty";
                }               
            }
        }
        
        public function warranty_count_integer_day($ending_date)
        {
            if($ending_date)
            {
                $result = floor((strtotime($ending_date)-strtotime(date('Y-m-d')))/(60*60*24));
                return ($result > 0)?$result:0;
            }
            else
            {
                return 0;
            } 
        }
        
        public function customer_due($customer_id)
        {
            $payment = $this->db->query("SELECT SUM(payment) AS total FROM payment_recieve WHERE customer_id=".$customer_id)->row();
            $order = $this->db->query("SELECT SUM(sales_price) AS total FROM sales_order so 
                    LEFT JOIN sales_order_details sod ON sod.sales_order_id=so.sales_id 
                    WHERE so.customer_id=".$customer_id." AND so.sales_status=27")->row();
            
            $due = $order->total - $payment->total;
            return ($due > 0)?$due:0;
        }
        
        public function get_serial_number($type)
        {
            if($type == 'ticket')
            {
                $this->db->select('MAX(serial_number) as max_serial_no');
                $this->db->from('ticket');
                $result = $this->db->get()->row();
                return ($result->max_serial_no)?$result->max_serial_no+1:1;
            }
        }
        
        public function delegation_by_ref_insert($approve_by_id,$code)
        {
            $this->db->where("ref_no",$code);
            $this->db->delete("delegation_by_ref");
            
            $ld = $this->db->query("SELECT limit_defination FROM delegation_hierarchy WHERE approve_for_id=".$approve_by_id)->row();
            $sql = $ld->limit_defination;
            if($sql != "")
            {
                $ld_result = $this->db->query($sql)->row();
                if($ld_result)
                {
                    $lamount = $ld_result->ld_amount;
                }
                else
                {
                    $lamount = 0;
                }
            }
            else
            {
                $lamount = 0;
            }
            

            $this->db->query("INSERT INTO delegation_by_ref SELECT '$code',user_id,manage_by,$lamount,max_limit,limit_type,sort_number,step_number,must_approve,approve_priority,step_name,'".date("Y-m-d")."', ".$this->session->userdata("USER_ID").",decline_logic FROM delegation_hierarchy WHERE approve_for_id=".$approve_by_id);       
        }
        
        public function total_goods_receive_for_status($proforma_invoice_id)
        {
            $row = $this->db->query("SELECT
                    Sum(purchase_order_details.confirm_quantity) AS total_confirm,
                    Sum(purchase_order_details.total_received) AS total_receive
                    FROM
                    purchase_order_details
                    WHERE
                    purchase_order_details.proforma_invoice_id = ".$proforma_invoice_id)->row();
            if($row->total_receive == $row->total_confirm)
            {
                return 51;
            }
            else if($row->total_confirm > $row->total_receive)
            {
                return 50;
            }
            else
            {
                return 48;
            }
        }
        
        /*
         * get waiting approval list 
         * use for get waiting for approval list for purchase order, requisition, sales order
         * 
         * and use current location
        */
        public function get_waiting_approval_list($u_id,$module,$code=NULL){
            if($module == "purchase")
            {
                $table = "purchase_order";
                $field = "purchase_code";
            }
            else if($module == "approval_payment")
            {
                $table = "payment_approval_note";
                $field = "payment_approval_code";
            }
            else if($module == "requisition")
            {
                $table = "stock_requisition";
                $field = "requisition_code";
            }
            else if($module == "sales")
            {
                $table = "sales_order";
                $field = "sales_code";
            }
            else if($module == "price_list")
            {
                $table = "price_list";
                $field = "price_list_code";
            }
            $this->db->select($table.".*");
            $this->db->select("user.username");
            $this->db->select("delegation_by_ref.step_number");
            $this->db->from("delegation_by_ref");
            $this->db->join($table,$table.".current_delegation_step=delegation_by_ref.step_number AND delegation_by_ref.ref_no =".$table.".".$field,"inner");
            $this->db->join("user","user.user_id=delegation_by_ref.userid","left");
            $this->db->where("delegation_by_ref.userid",$u_id);
            if($code)
            {
                $this->db->where("delegation_by_ref.ref_no",$code);
                return $this->db->get()->row();
            }
            else
            {
                return $this->db->get()->result_array();
            }
        }
        
        
        public function get_waiting_approval_list2($module,$code=NULL){
            if($module == "purchase")
            {
                $table = "purchase_order";
                $field = "purchase_code";
            }
            else if($module == "requisition")
            {
                $table = "stock_requisition";
                $field = "requisition_code";
            }
            else if($module == "sales")
            {
                $table = "sales_order";
                $field = "sales_code";
            }
            $this->db->select($table.".*");
            $this->db->select("user.username");
            $this->db->select("delegation_by_ref.step_number");
            $this->db->select("delegation_by_ref.step_name");
            $this->db->from("delegation_by_ref");
            $this->db->join($table,$table.".current_delegation_step=delegation_by_ref.step_number AND delegation_by_ref.ref_no =".$table.".".$field,"left");
            $this->db->join("user","user.user_id=delegation_by_ref.userid","left");
            //$this->db->where("delegation_by_ref.userid",$u_id);
            if($code)
            {
                $this->db->where("delegation_by_ref.ref_no",$code);
                return $this->db->get()->row();
            }
            else
            {
                return $this->db->get()->result_array();
            }
        }
        
        public function default_warehouse($location_id)
        {
            return $this->db->query("SELECT
                warehouse.*
                FROM
                warehouse
                WHERE
                warehouse.location_id = ".$location_id."
                LIMIT 0, 1")->row();
        }
        
        
        public function get_enum_list($table,$field)
        {
            $row = $this->db->query("SHOW COLUMNS FROM ".$table." WHERE Field = '".$field."'")->row();
            $search = array("enum","(",")","'");
            $replace = array("");
            $enums = explode(",",str_replace($search, $replace, $row->Type));
            //debug($enums,1);
            return $enums;
        }
        
        public function panel_list_ordering_model($data)
        {
            //debug($data,1);
            foreach ($data['sort'] as $val)
            {
                $v = explode("_", $val);
                $this->db->where("panel_details_id",$v[0]);
                $this->db->update("search_panel_details",array("sort"=>$v[1]));
            }
        }
        
        public function pan_info($pan_id)
        {
            return $this->db->select("payment_approval_note.*,status.status_name")
                ->from("payment_approval_note")
                ->join("status","payment_approval_note.payment_approval_note_status = status.status_id","left")
                ->where("payment_approval_note.payment_approval_note_id",$pan_id)
                ->get()->row();
        }
        public function pand_info($pan_id)
        {
            return $this->db->select("payment_approval_note_details.payment_approval_note_details_id,cost_component.cost_component_name,payment_approval_note_details.amount,payment_approval_note_details.approve_by,payment_approval_note_details.decline_by,payment_approval_note_details.decline_coments")
                ->from("payment_approval_note_details")
                ->join("cost_component","payment_approval_note_details.cost_component_id = cost_component.cost_component_id","left")
                ->where("payment_approval_note_details.payment_approval_note_id",$pan_id)
                ->get()->result();
        }

        public function payment_approval_note_preview_html($pan_id)
        {
            $pan_info = $this->pan_info($pan_id);
//            $pan_info = $this->db->select("payment_approval_note.*,status.status_name")
//                                ->from("payment_approval_note")
//                                ->join("status","payment_approval_note.payment_approval_note_status = status.status_id","left")
//                                ->where("payment_approval_note.payment_approval_note_id",$pan_id)
//                                ->get()->row();
            $pand_info = $this->pand_info($pan_id);
//            $pand_info = $this->db->select("payment_approval_note_details.payment_approval_note_details_id,cost_component.cost_component_name,payment_approval_note_details.amount")
//                                ->from("payment_approval_note_details")
//                                ->join("cost_component","payment_approval_note_details.cost_component_id = cost_component.cost_component_id","left")
//                                ->where("payment_approval_note_details.payment_approval_note_id",$pan_id)
//                                ->get()->result();
            $html = "<div class='col-lg-6'><h5>Payment Approval Note : ".$pan_info->payment_approval_code."</h5></div>";
            $html .= "<div class='col-lg-6'><h5>Status : ".$pan_info->status_name."</h5></div>";
            $html .= "<input class='payment_approval_hid_code' type='hidden' value='".$pan_info->payment_approval_code."'>";
            $html .= "<input class='payment_approval_note_hid_id' type='hidden' value='".$pan_info->payment_approval_note_id."'>";
            $html .= "<table class='table'>";            
            $sl = 1;
            $total = 0;
            foreach ($pand_info as $val)
            {
                $total += $total+$val->amount;
                $html .= "<tr>";
                $html .= "<td>".$sl."</td>";
                $html .= "<th>".$val->cost_component_name."</th>";
                $html .= "<td>".$val->amount."</td>";
                $html .= "<td><i id='".$val->payment_approval_note_details_id."' class='btn btn-danger fa fa-times' style='cursor: pointer; text-align: center;'></i></td>";
                $html .= "</tr>";
                $sl++;
            }
            $html .= "<tr><th colspan='2' style='text-align:right'>Total : </th><td colspan='2'>".number_format($total,2)."</td></tr>";
            $html .= "<tr><th colspan='4'>Total Inword : ".convert_number_to_words($total)."</th></tr>";
            $html .= "</table>";
            return $html;
        }
        
        
        public function approve_payment_approval_note_html($pan_id)
        {
            $pan_info = $this->pan_info($pan_id);
            $pand_info = $this->pand_info($pan_id);
            $html = "<div class='col-lg-6'><h5>Payment Approval Note : ".$pan_info->payment_approval_code."</h5></div>";
            $html .= "<div class='col-lg-6'><h5>Status : ".$pan_info->status_name."</h5></div>";
            $html .= "<input class='payment_approval_hid_code' type='hidden' value='".$pan_info->payment_approval_code."'>";
            $html .= "<input class='payment_approval_note_hid_id' type='hidden' value='".$pan_info->payment_approval_note_id."'>";
            $html .= "<table class='table'>";
            $html .= "<tr>";
            $html .= "<th>#SL</th>";
            $html .= "<th>Component</th>";
            $html .= "<th>Amount</th>";
            $html .= "<th>Decline</th>";
            $html .= "<th>Approve Person</th>";
            $html .= "<th>Decline Person</th>";
            $html .= "<th>Decline Comments</th>";
            $html .= "</tr>";
            $sl = 1;
            $total = 0;
            foreach ($pand_info as $val)
            {
                $total += $total+$val->amount;
                $html .= "<tr>";
                $html .= "<td>".$sl."</td>";
                $html .= "<th>".$val->cost_component_name."</th>";
                $html .= "<td>".$val->amount."</td>";
                $html .= "<td><input type='checkbox' val='".$val->payment_approval_note_details_id."'></td>";
                $html .= "<td>".$val->approve_by."</td>";
                $html .= "<td>".$val->decline_by."</td>";
                $html .= "<td>".$val->decline_coments."</td>";
                $html .= "</tr>";
                $sl++;
            }
            $html .= "<tr><th colspan='2' style='text-align:right'>Total : </th><td colspan='5'>".number_format($total,2)."</td></tr>";
            $html .= "<tr><th colspan='4'>Total Inword : ".convert_number_to_words($total)."</th></tr>";
            $html .= "</table>";
            return $html;
        }
        
}

