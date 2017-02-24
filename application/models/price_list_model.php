<?php

class Price_list_model extends CI_Model {

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
        $this->db->insert('purchase_order_summary', $array);
    }

    public function save_data($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

	
	public function update_received($received,$purchase_id,$product_id){
        $sql = "UPDATE `purchase_order_details` SET `total_received` = `total_received`+ $received
                WHERE 
                `purchase_order_id` =$purchase_id AND `product_id` =$product_id";
        $this->db->query($sql);
        
    }
	
	
    public function get_order_info($order_id){
            $this->db->select("price_list.*,status.status_name");
            $this->db->from("price_list");
            $this->db->join("status",'price_list.price_list_status=status.status_id');
            $this->db->where("price_list_id",$order_id,FALSE);
            $result= $this->db->get();
            return $result->row();
    }
    
    public function get_existing_status($type){
        $this->db->select("COUNT(*) as total");
        $this->db->from("price_list");
        $this->db->where("list_type",$type);
        $this->db->where("status","Active");
        $result = $this->db->get();
        return $result->row();
    }


    public function update_data($data,$table,$where){
        $this->db->where($where,false);
        $this->db->update($table,$data);
        if(isset($where['price_list_id']) ){
            return $where['price_list_id'];
        }        
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
    
    
    public function get_pdf_information($Proforma_invoice_id){
        
            $this->db->select("purchase_order_details.*,"
                    . "product.product_name,product.product_details_json,"
                    . "product.product_code,product.model_name,product.line,product.do_product,product.unit,product.unit_m3,product.unit_price,"
                    . "product.unit_price_usd,product_category.product_category_name,proforma_invoice.indent_number as pindent_number,"
                    . "proforma_invoice.proforma_invoice_id,proforma_invoice.purchase_order_id,"
                    . "proforma_invoice.lc_number,region.region_name",false);
            
            $this->db->from("purchase_order_details");
            $this->db->join("product",'product.product_id=purchase_order_details.product_id', 'LEFT');
            $this->db->join("product_category",'product.product_category_id = product_category.product_category_id', 'LEFT');
            $this->db->join("proforma_invoice","proforma_invoice.proforma_invoice_id=purchase_order_details.proforma_invoice_id","left");
            $this->db->join("region","region.region_id=product.region_id","left");
            $this->db->where("purchase_order_details.proforma_invoice_id ",$Proforma_invoice_id);
            $result= $this->db->get();
            return $result->result_array();
    }

    
 public function get_totalamount($Proforma_invoice_id){
        $this->db->select("sum(purchase_order_details.confirm_quantity) AS total_quantity,sum(purchase_order_details.purchase_price_usd)As usd_price,sum(product.unit_m3)As total_m3,sum(purchase_order_details.quantity) AS order_quantity,region.region_name,proforma_invoice.indent_number,proforma_invoice.created,region.region_name",false);
        $this->db->from("purchase_order_details");
        $this->db->join("product","product.product_id=purchase_order_details.product_id","left");
        $this->db->join("proforma_invoice","proforma_invoice.proforma_invoice_id=purchase_order_details.proforma_invoice_id","left");
        $this->db->join("region","region.region_id=product.region_id","left");
        $this->db->where("purchase_order_details.proforma_invoice_id",$Proforma_invoice_id);
        $result= $this->db->get();
        return $result->row();
 }

	public function get_all_price_history($type=NULL,$price_id=NULL){
                    $previlige = stock_view_privilege_wise();
                    
                    $this->db->select("pl.*,u.username,s.status_name");			   
                    $this->db->from("price_list pl");
                    $this->db->join("user u",'u.user_id = pl.created_by','left');
                    $this->db->join("status s",'s.status_id=pl.price_list_status','left');  
                    $this->db->where("pl.list_type",$type);
                    if($previlige == FALSE)
                    {
                            $this->db->where("pl.created_by IN (SELECT user_id FROM user WHERE location_id=".$this->session->userdata('LOCATION_ID').")",NULL,FALSE);
                    }
                    if($price_id){
                        $this->db->where("pl.price_list_id",$price_id);
                        $result= $this->db->get();
                        return $result->row();
                    }else{
                        $result= $this->db->get();
                        return $result->result_array();
                    }                           
                    $this->db->order_by("pl.price_list_code","DESC");
                    
                  
	}
        
        
        public function change_price_list_status($price_id=NULL){
                    $this->db->select("pl.*,u.username,s.status_name");			   
                    $this->db->from("price_list pl");
                    $this->db->join("user u",'u.user_id = pl.created_by','left');
                    $this->db->join("status s",'s.status_id=pl.price_list_status','left');  
                    $this->db->where("pl.price_list_id",$price_id);
                    $this->db->order_by("pl.price_list_code","DESC");
                    $result= $this->db->get();
                    return $result->row();            
                         
	}
	
	
    public function get_selected_product($order_id = NULL,$flag = "product_group_id"){
            $this->db->select("purchase_order_details.*,product.product_name,product.product_details_json,product.product_code,product.model_name,product_category.product_category_name",false);
            $this->db->from("purchase_order_details");
            $this->db->join("product",'product.product_id=purchase_order_details.product_id', 'LEFT');
            $this->db->join("product_category",'product.product_category_id = product_category.product_category_id', 'LEFT');
            $this->db->where("purchase_order_id ",$order_id,FALSE);
            $this->db->order_by("product.".$flag);
            $result= $this->db->get();
            return $result->result_array();
    }
    
    public function get_selected_product2($order_details_id,$field,$table){
            $this->db->select("price_list_details.*,product.product_name,product.product_details_json,product.product_code,product.model_name,product_category.product_category_name",false);
            $this->db->from("price_list_details");
            $this->db->join("product",'product.product_id=price_list_details.product_id', 'LEFT');
            $this->db->join("product_category",'product.product_category_id = product_category.product_category_id', 'LEFT');
            $this->db->where("price_list_details.price_list_id ",$order_details_id,FALSE);
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
    
    

    public function check_and_update_purchase_order($purchase_order_id)
    {
        $this->db->select("proforma_invoice_id");
        $this->db->from("purchase_order_details");
        $this->db->where("purchase_order_id",$purchase_order_id);
        $rows = $this->db->get();
        
        $count = 0;
        foreach ($rows->result() as $key=>$row)
        {
            if($row->proforma_invoice_id == NULL)
            {
                $count += 1;
            }
        }
        
        if($count == 0)
        {
            $this->db->where("purchase_id",$purchase_order_id);
            $this->db->update("purchase_order",array("status"=>37));
        }
    }

    
    public function proforma_invoice_info($order_id=NULL)
    {
        $this->db->select("pi.proforma_invoice_id,pi.indent_number,pi.created,pi.lc_number,pi.shipping_date");
        $this->db->select("u.username");
        $this->db->select("po.purchase_code");
        $this->db->select("s.status_name");
        $this->db->from("proforma_invoice pi");
        $this->db->join("user u","u.user_id=pi.created_by","left");
        $this->db->join("purchase_order po","po.purchase_id=pi.purchase_order_id","left");
        $this->db->join("status s","s.status_id=pi.pi_status","left");
        if($order_id)
        {
            $this->db->where("pi.purchase_order_id",$order_id);
        }
        $this->db->order_by("po.purchase_code");
        return $this->db->get()->result_array();
    }

    

    public function price_list_status($order_id)
    {
        $this->db->select("status");
        $this->db->from("price_list");
        $this->db->where("price_list_id",$order_id);
        $result = $this->db->get()->row();
        return $result;
    }
    public function pi_supporting_doc_list($purchase_order_id,$proforma_invoice_id)
    {
        $this->db->select("*");
        $this->db->from("purchase_supporting_doc");
        $this->db->where("purchase_order_id",$purchase_order_id);
        $this->db->where("proforma_invoice_id",$proforma_invoice_id);
        return $this->db->get()->result_array();
    }

    public function get_selected_product_group($order_id=NULL,$table,$field)
    {
        $this->db->select("product.product_group_id,product.region_id,price_list_details.price_list_id,price_list_details.price_list_details_id,".$table.".".$field);
        
        $this->db->from("price_list_details");
        $this->db->join("product",'product.product_id=price_list_details.product_id', 'LEFT');
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
            $this->db->where("price_list_details.price_list_id",$order_id,FALSE);
        }
        
        $this->db->group_by($table.".".$field);
        $this->db->order_by($table.".".$field);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    
    function get_fob_group($proforma_invoice_id)
    {
        return $this->db->query("SELECT
            product.product_name,
            Count(purchase_order_details.product_id) AS total_product,
            purchase_order_details.proforma_invoice_id,
            product_group.product_group_id,
            product_group.product_group_name
            FROM
            purchase_order_details
            LEFT JOIN product ON purchase_order_details.product_id = product.product_id
            INNER JOIN product_group ON product.product_group_id = product_group.product_group_id
            WHERE
            purchase_order_details.proforma_invoice_id = ".$proforma_invoice_id."
            GROUP BY
            product.product_group_id");
    }
  function get_good_receive_info($proforma_invoice_id){
    $this->db->select("purchase_good_receive.receive_quantity,purchase_good_receive.recieve_ack_date,p.product_name");
        $this->db->from("purchase_good_receive");
        $this->db->join("purchase_order_details",'purchase_order_details.purchase_order_details_id=purchase_good_receive.purchase_order_details_id', 'LEFT');
        $this->db->join("product p",'p.product_id=purchase_good_receive.product_id', 'LEFT');
        $this->db->where("purchase_order_details.proforma_invoice_id",$proforma_invoice_id);
        $result= $this->db->get();
        return $result->result_array();
        
    }
    
    
    function get_receive_history(){
    $this->db->select("purchase_good_receive.receive_quantity,purchase_good_receive.created,p.product_name");
        $this->db->from("purchase_good_receive");
        $this->db->join("purchase_order_details",'purchase_order_details.purchase_order_details_id=purchase_good_receive.purchase_order_details_id', 'LEFT');
        $this->db->join("product p",'p.product_id=purchase_good_receive.product_id', 'LEFT');
        $this->db->order_by("purchase_good_receive.purchase_order_details_id DESC");
        $result= $this->db->get();
        return $result->result_array();
        
    }
    function get_product_invoice_group_wise($p_invoice_id,$p_group_id)
    {
        return $this->db->query("
            SELECT
                purchase_order_details.purchase_order_details_id,
                purchase_order_details.purchase_price,
                purchase_order_details.purchase_price_usd,
                product.product_name,
                product.product_id,
                product_group.product_group_name
                FROM
                purchase_order_details
                LEFT JOIN product ON purchase_order_details.product_id = product.product_id
                LEFT JOIN product_group ON product.product_group_id = product_group.product_group_id
                WHERE
                purchase_order_details.proforma_invoice_id = ".$p_invoice_id." AND
                product.product_group_id = ".$p_group_id."
                GROUP BY
                purchase_order_details.purchase_order_details_id
        ");
    }
    
    function get_amount($amount_array,$value,$formula_on)
    {
        $formula = 0;
        if($formula_on)
        {
            $type = strpos($formula_on, 'TO');
            if($type == TRUE)
            {
                $a = explode("TO", $formula_on);
                $fv = range(str_replace(' ','',$a[0]), str_replace(' ','',$a[1]));
            }
            else
            {
                $fv = explode("+",$formula_on);
            }
            
            
            foreach ($fv as $fvalue)
            {
                if(ctype_alpha($fvalue))
                {
                    $formula += $amount_array[$fvalue];
                }
                else
                {
                    $f = str_replace("%", "", $fvalue);
                   $formula += $f;
                }
            }
        }
        if($value > 0)
        {
            $a1 = ($value/100)*$formula;
        }
        else
        {
            $a1 = $formula;
        }
        
        return $a1;
    }
            
    function fob_product_details_sql($proforma_invoice_id,$product_group_id)
    {
        return $this->db->query("SELECT
                    purchase_order_details.purchase_price,
                    purchase_order_details.purchase_price_usd,
                    product.product_name,
                    purchase_order_details.purchase_order_details_id,
                    product.product_details_json,
                    product.product_code,
                    product.sdta,
                    region.region_name
                    FROM
                    purchase_order_details
                    LEFT JOIN product ON purchase_order_details.product_id = product.product_id
                    LEFT JOIN region ON product.region_id = region.region_id
                    WHERE
                    purchase_order_details.proforma_invoice_id = ".$proforma_invoice_id." AND
                    product.product_group_id = ".$product_group_id."
                    GROUP BY
                    purchase_order_details.product_id
                ");
    }
    
    function fob_costing_setting_sql($product_group_id)
    {
        return $this->db->query("SELECT
                    costing_settings.row_index,
                    costing_settings.value_of,
                    fob.fob_name,
                    costing_settings.formula_on
                    FROM
                    costing_settings
                    LEFT JOIN fob ON costing_settings.fob_id = fob.fob_id
                    WHERE
                    costing_settings.product_group_id = ".$product_group_id);
    }
            
    function get_purchase_order_id_from_proforma_invoice($proforma_invoice_id)
    {
        $this->db->select("pi.*");
        $this->db->select("po.purchase_code,po.purchase_id");
        $this->db->select("s.status_name");
        $this->db->from("proforma_invoice pi");
        $this->db->join("purchase_order po",'po.purchase_id=pi.purchase_order_id','left');
        $this->db->join("status s",'s.status_id=pi.pi_status','left');
        $this->db->where("pi.proforma_invoice_id",$proforma_invoice_id);
        return $this->db->get()->row();
        
    }
    
    public function purchase_prices_for_proforma($proforma_invoice_id)
    {
        return $this->db->query("SELECT SUM(purchase_price*confirm_quantity) AS total_purchase_price, SUM(purchase_price_usd*confirm_quantity) AS total_price_usd FROM purchase_order_details WHERE proforma_invoice_id=".$proforma_invoice_id)->row();
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

    public function get_selected_product_po_product_spec($purchase_order_details_id)
    {
        return $this->db->query("SELECT * FROM po_product_spec WHERE purchase_order_details_id=".$purchase_order_details_id);
    }


   
    
    public function get_packing_slip_data($order_id){
        $this->db->select("*,product.product_name");
        $this->db->from("purchase_order_details");
        $this->db->join("product",'product.product_id=purchase_order_details.product_id');
        $this->db->where("purchase_order_id",$order_id, FALSE);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_stock_manager_data($product_id){
        $this->db->select("product_stock_manager.product_code,product_stock_manager.serial_number");
        $this->db->from("product_stock_manager");
        $this->db->where("product_id",$product_id);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_cost_component_list($order_id){
        $this->db->select("*,cost_component.cost_component_name");
        $this->db->from("purchase_cost_component");
        $this->db->join("cost_component",'cost_component.cost_component_id=purchase_cost_component.cost_component_id', "LEFT");
        $this->db->where("purchase_order_id",$order_id);
        $result= $this->db->get();
        return $result->result_array();
        
    }
	

    public function get_summary_packing_serial_list(){
       $sql = " SELECT
                    product_stock_manager.product_id,
                    count(
                            product_stock_manager.serial_number
                    ) AS `total_recieve_serial`,
                    product.product_name,
                    purchase_order.purchase_code,
                    product_stock_manager.vendor_id,
                    product_stock_manager.purchase_id,
                    product_stock_manager.packing_slip_date
               FROM
                    product_stock_manager
                INNER JOIN product ON product_stock_manager.product_id = product.product_id
                INNER JOIN purchase_order ON product_stock_manager.purchase_id = purchase_order.purchase_id
               GROUP BY
                    product_stock_manager.product_id,
                    product_stock_manager.product_id,
                    product_stock_manager.packing_slip_date";
       
       $data_result = $this->db->query($sql)->result_array();
       return $data_result; 
    }

    public function get_details_packing_serial_no($purchase_id,$product_id){
        $sql= "SELECT
                    product_stock_manager.product_code,
                    product_stock_manager.serial_number
                    FROM
                    product_stock_manager
                    WHERE
                    product_stock_manager.product_id =$product_id AND
                    product_stock_manager.purchase_id =$purchase_id";
       $data_result = $this->db->query($sql)->result_array();
       return $data_result; 
    }
    
   
	
    public function update_purchase_status($purchase_id,$purchas_type_id){
        $sql = "SELECT
                    Sum(purchase_order_details.quantity) AS `total_quantity`,
                    sum(purchase_order_details.total_received) AS `total_received`
                    FROM
                    purchase_order_details
                    WHERE
                    purchase_order_details.purchase_order_id =$purchase_id";
        
        $total_quantity = $this->db->query($sql)->row()->total_quantity;
        $total_recieved= $this->db->query($sql)->row()->total_received;
        //echo $sql;exit;
        if($purchas_type_id == 1){
			$status = 13;
		}else{
			$status = 9;
		}
        if($total_quantity==$total_recieved){
           
            $sql = "UPDATE purchase_order
                        SET purchase_order.`status` = $status
                        WHERE
                        purchase_order.purchase_id =$purchase_id ";
            $check= $this->db->query($sql);
            
        }
        return 1;
    }
	
    public function get_support_doc_list($order_id){
        $this->db->select("*");
        $this->db->from("purchase_supporting_doc");
        $this->db->where("purchase_order_id",$order_id);
        $result= $this->db->get();
        return $result->result_array();
    }
	
    public function last_purchase_exchange_rate( $currency_id = 144 ){
        
        $sql = $this->db->query("SELECT
            purchase_order.exchange_rate,
            purchase_order.purchase_code,
            purchase_order.purchase_id
            FROM `purchase_order`
            WHERE
            currency_id = $currency_id
            ORDER BY
            purchase_id DESC
            LIMIT 1");
        return $sql->result_array();
    }
	
	

    public function get_models($searchTerm){
        $result = $this->db->query("SELECT
        product_model.product_model_id,
        product_model.product_model_name
        FROM `product_model`
        WHERE
        product_model_name LIKE '%$searchTerm%'
        AND
        `status` = 'Active'");
        
        return $result->result_array();
    }
    public function get_model_with_id($product_id){
        $result = $this->db->query("SELECT
        product_model.product_model_id,
        product_model.product_model_name
        FROM `product_model`
        WHERE
        product_model.product_id=$product_id
        AND
        `status` = 'Active'");
        
        return $result->result_array();
    }
    
    public function get_products_list($product_category_id){
        $sql = $this->db->query("SELECT
                product.product_id,
                product.product_name
                FROM `product`
                WHERE
                product_category_id = $product_category_id");
        
        return $sql->result_array();
    }
    
    public function get_specification_list($product_id,$model_id){

        $sql = $this->db->query("SELECT
                    specification_type.specification_type_id,
                    specification_type.specification_type_name,
                    product_specification.specification_details
                    FROM
                    specification_type
                    LEFT JOIN product_specification ON specification_type.specification_type_id = product_specification.specification_type_id AND product_specification.product_id = $product_id AND product_specification.model_id = $model_id
                    WHERE
                    specification_type.`status` = 'Active' ORDER BY specification_type.specification_type_id");
        return $sql->result_array();
    }
    
    public function get_product_model_spac($porduct_id,$model_id){
        $sql = $this->db->query("SELECT
            product_specification.product_id,
            product_specification.model_id,
            product_specification.specification_type_id,
            product_specification.specification_details,
            product_model.product_model_name,
            product.product_name,
            specification_type.specification_type_name,
            product.product_category_id
            FROM
            product_specification
            LEFT JOIN product_model ON product_specification.model_id = product_model.product_model_id
            LEFT JOIN product ON product_model.product_id = product.product_id
            LEFT JOIN specification_type ON product_specification.specification_type_id = specification_type.specification_type_id
            WHERE
            product_specification.model_id = $model_id
            AND
            product_specification.product_id = $porduct_id");
        
        return $sql->result_array();
    }
    
    public function product_model_search($product_id,$model_name,$type){
        if($type == 'new')
        {
            $cond = "product_model_name LIKE '%$model_name%'";
        }
        else if($type == 'old')
        {
            $cond = "product_model_id=$model_name";
        }
        $result = $this->db->query("SELECT
	product_model.product_model_id,
	product_model.product_model_name
        FROM
	`product_model`
        WHERE
	product_id = $product_id
        AND
	$cond
        AND `status` = 'Active'");
        
        return $result->result_array();
    }
	
	public function get_product_mode($product_id,$model_name){
        $result = $this->db->query("SELECT
	product_model.product_model_id,
	product_model.product_model_name
        FROM
	`product_model`
        WHERE
	product_id = $product_id
        AND
	product_model_name ='$model_name'
        AND `status` = 'Active'");
        
        return $result->result_array();
    
    }
	
	public function model_list(){
        $result= $this->db->query("SELECT
            product.product_id,
            product.product_name,
            product_category.product_category_name,
            product_category.product_category_id,
            product_brand.product_brand_name,
            product_brand.product_brand_id,
            product_subcategory.product_subcategory_name,
            product_model.product_model_id,
            product_model.product_model_name
            FROM
            product_model
            LEFT JOIN product ON product.product_id = product_model.product_id
            LEFT JOIN product_category ON product.product_category_id = product_category.product_category_id
            LEFT JOIN product_brand ON product.product_brand_id = product_brand.product_brand_id
            LEFT JOIN product_subcategory ON product.product_category_id = product_subcategory.product_subcategory_id");
        
        return $result->result_array();
            
    }
	
	/*
     */
    public function get_po_spec($order_id,$product_id,$model_name,$purchase_order_details_id){
        $result = $this->db->query("SELECT * FROM `po_product_spec` WHERE po_product_spec.purchase_order_details_id = ".$purchase_order_details_id);        
        return $result->result_array();
    }
    
    public function get_model_spec_name($model_id){
        $result = $this->db->query("SELECT
            product_model.product_model_id,
            product_model.product_model_name
            FROM `product_model`
            WHERE
            product_model.product_model_id= $model_id");
        
        return $result->result_array();
    }
    
    public function get_po_spec_not_model($order_id,$product_id){
        $result = $this->db->query("SELECT *
                FROM `po_product_spec`
                WHERE
                po_product_spec.purchase_order_details_id = ".$order_id);
        
        return $result->result_array();
    }
    
    public function get_product_model($product_id){
        $result = $this->db->query("SELECT * FROM `product_model` WHERE product_id = $product_id");
        return $result->result_array();
    }

    public function get_user_list_by_level($user_level_id) {
        $result = $this->db->query("SELECT
                                    `user`.user_id,
                                    `user`.first_name,
                                    `user`.last_name
                            FROM
                                    privilege_level
                            INNER JOIN `user` ON privilege_level.user_id = `user`.user_id
                            WHERE
                                    privilege_level.user_level_id = $user_level_id
                            AND `user`.`status` = 'Active'");
        return $result->result_array();
    }
    
    public function get_user_for_approval_privilege($user_level_id,$approve_for_id) {
        $result = $this->db->query("SELECT
                                    `user`.user_id,
                                    `user`.first_name,
                                    `user`.last_name,
                                     privilege_for_approval.userid as available
                            FROM
                                    privilege_level
                            INNER JOIN `user` ON privilege_level.user_id = `user`.user_id
                            LEFT JOIN privilege_for_approval ON `user`.user_id = privilege_for_approval.userid AND privilege_for_approval.approve_for_id = $approve_for_id
                            WHERE
                                    privilege_level.user_level_id = $user_level_id
                            AND `user`.`status` = 'Active'");
        return $result->result_array();
    }
    
    public function get_hierarchy_list() {
        $result = $this->db->query("SELECT
                            `user`.user_id,
                            defined_delegation.approve_for_id,
                            CONCAT(
                                    `user`.first_name,
                                    ' ',
                                    `user`.last_name
                            ) AS NAME,
                            `defined_delegation`.sort_number
                        FROM
                                `user`
                        INNER JOIN defined_delegation ON defined_delegation.userid = `user`.user_id
                        ORDER BY 
                        `defined_delegation`.sort_number ASC
                        ");
        return $result->result_array();
    }
    
    function reorder_entry_element($data){
        foreach ($data as $value) {
            $split_value = explode("=", $value);
            $sort_number = $split_value[0];
            $new_sort = $split_value[1];
            $user_id = $split_value[2];
            
            
            $this->db->query("UPDATE `defined_delegation` SET sort_number = $new_sort WHERE userid = $user_id AND sort_number = $sort_number");
        }
    }

    public function get_fob_list($pg_id)
    {
        $this->db->select("f.fob_id,f.fob_name");
        if($pg_id != NULL)
        {
            $this->db->select("cs.costing_set_id,cs.product_group_id,cs.fob_id as cs_fob_id,cs.row_index,cs.value_of,cs.formula_on");
        }
        $this->db->from("fob f");
        if($pg_id != NULL)
        {
            $this->db->join("costing_settings cs","cs.fob_id=f.fob_id AND cs.product_group_id=".$pg_id,"left");
            //$this->db->order_by("cs.row_index IS NULL, cs.row_index ASC");
        }
        $this->db->order_by("f.fob_id ASC");
        $result = $this->db->get()->result();
        return $result;
    }
    
    
    public function get_fob_list_existing($pg_id)
    {
        $this->db->select("f.fob_name");
        $this->db->select("cs.costing_set_id,cs.row_index,cs.value_of,cs.formula_on");
        $this->db->from("costing_settings cs");
        $this->db->join("fob f","cs.fob_id=f.fob_id","left");
        $this->db->where("cs.product_group_id",$pg_id);
        $this->db->order_by("cs.row_index ASC");
        $result = $this->db->get()->result();
        return $result;
    }
    
    public function get_product_group($pg_id)
    {
        $this->db->select("product_group_name");
        $this->db->from("product_group");
        $this->db->where("product_group_id",$pg_id);
        $result = $this->db->get()->row();
        return $result;
    }
    
    public function individual_product_fob_costing_sql_view($purchase_order_details_id)
    {
        $this->db->select("*");
        $this->db->from("purchase_product_fob_details");
        $this->db->where("purchase_order_details_id",$purchase_order_details_id);
        $rows = $this->db->get();
        $html = "<table class='table'>";
        $html .= "<thead><tr><th colspan='3'>Fob Costing Details</th></tr></thead>";
        $html .= "<tboday>";
        foreach ($rows->result() as $row)
        {
            $html .= "<tr>";
            $html .= "<td>".$row->row_index."</td>";
            $html .= "<td>".$row->cost_details."</td>";
            $html .= "<td>".$row->amount."</td>";
            $html .= "</tr>";
        }
        $html .= "</tboday>";
        $html .= "</table>";
        return $html;
    }
    
    
    public function get_my_approvd_list($u_id){
        
        $this->db->select("dl.*,u.username");
        $this->db->from("delegation_log dl");
        $this->db->join("user u",'u.user_id=dl.approve_by', 'LEFT');
        $this->db->join("user r",'r.user_id=dl.reliever_of', 'LEFT');
        $this->db->where("u.user_id",$u_id);
        $result = $this->db->get();
        return $result->result_array();
        
    }

}
