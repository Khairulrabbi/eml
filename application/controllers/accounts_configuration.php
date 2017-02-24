<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_Configuration extends Custom_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('url','html','form');
        $this->load->library('session');
        $this->load->model('account_model','','TRUE'); 
        $this->load->library('form_validation');
    }
    function index($id = NULL){
        $msg = NULL;
        if($id == NULL){
            if($this->is_post()){
                
                $post = $this->input->post();
                $post['ParentID'] = ($post['ParentID'] == "")?0:$post['ParentID'];
                $acc_code = $post['AccountCode'];
//                debug($post,1);
                unset($post['acc_tag_id']);
                if(isset($post['edit_acc_head'])){
                    $acc_head_id = $post['edit_acc_head'];                    
                    unset($post['edit_acc_head']);
                    unset($post['AccountCode']);
                    //$post['updated_by'] = $this->user_id;
                    $this->db->where('AccountCode', $acc_code);
                    $this->db->update('chartofaccounts',$post);
                    $this->account_model->account_head_maping($acc_code,$post);
                    $msg = "Successfully Updated";
                }else{
                    $parent_name_code = explode('-',$post['ParentID']);
//                    $post['created'] = date('Y-m-d H:i:s');
//                    $post['created_by'] = $this->user_id;
                    
                    $acc_head_id = $this->db->insert('chartofaccounts',$post);
                    
                    $this->account_model->account_head_maping($acc_code,$post);
                    $msg = "Successfully Inserted";
                }
            }
        }
        $data['msg'] = $msg;
        $data['acc_head'] = $this->account_model->get_acc_head();
        $this->render_page('accounting/configuration/account_head',$data);
    }
    
    
    public function tag_account()
    {
        $data['title'] = 'Tag Accounts';
        $data['tag_accounts_list'] = $this->account_model->get_tag_accounts();
        $this->render_page('accounting/configuration/tag_account', $data);
    }
    
    public function save_acc_tag()
    {
        $this->form_validation->set_rules('acc_tag_name','Account Tag','trim|required');
        $this->form_validation->set_rules('table_name','Table Name','trim|required|is_unique[acc_tag.table_name]');
        $this->form_validation->set_rules('id_field','Id Field','trim|required');
        $this->form_validation->set_rules('field_name','Field Name','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $post = $this->input->post();
            $post["created_by"] = $this->session->userdata("USER_ID");
            $post["created"] = date("Y-m-d");
            $result = $this->account_model->save_data($post,"acc_tag");
            if($result)
            {
                //$this->account_model->alter_acc_head_voucher($post['acc_tag_name']);
                echo "done";
            }
        }
    }
    
    public function update_acc_tag_status($id)
    {
        echo $this->account_model->update_acc_tag_status_sql($id);
    }
            
    
    function acc_details_history($voucher_no){
        $data['journal_details'] = $this->db->query("SELECT
            journal_details.journal_details_id,
            journal_main.voucher_auto_no,
            journal_details.journal_main_id,
            journal_details.sl_no,
            journal_details.acc_head_id,
            journal_details.acc_group_id,
            journal_details.dr_amount,
            journal_details.cr_amount,
            journal_details.currency,
            journal_details.currency_rate,
            journal_details.description,
            journal_details.fc_dr_amount,
            journal_details.fc_cr_amount
            FROM
            journal_details
            LEFT JOIN journal_main ON journal_details.journal_main_id = journal_main.journal_id
            WHERE journal_details.journal_main_id = $voucher_no")->result_array();
        $this->render_page('accounting/details_history', $data);
    }
    
    function delete_acc_head(){
        
        $id = $this->input->post('AccountCode');
        $this->account_model->delete_acc_head($id);
        //redirect(accounts_configuration);
    }
    
    function get_acc_head(){
        $acc_head = $this->db->query("SELECT
        chartofaccounts.AccountCode AS id,
        chartofaccounts.ParentID AS pId,
        CONCAT(chartofaccounts.AccountCode,'-',chartofaccounts.AccountName) AS name,
        chartofaccounts.AccountName
        FROM
        chartofaccounts")->result_array();
        //echo json_encode($acc_head);
        echo json_encode($this->account_model->get_acc_head_details());
    }
    
    function get_acc_details(){
        $code = $this->input->post('acc_code');
        echo json_encode($this->account_model->get_acc_head_details($code));
    }

    function create_tag($id = NULL){
        $post = $this->input->post();
        if(!empty($post)){
            extract($post);
            $insertData = $this->input->post();
            unset($insertData['submit']);
            $this->db->insert('acc_tag',$insertData);
        }
        if($id != NULL){
            $data['tag_details'] = $this->account_model->get_tag_details($id);
            print_r($data);
        }
        $data['table_list'] = $this->account_model->table_list();
        $data['tag_list'] = $this->account_model->get_acc_tag_list();
        $this->render_page('accounting/configuration/create_tag',$data);
    }

    function get_table_field(){
        $table_name = $this->input->post('tbl_name');
        $sql = "SHOW COLUMNS FROM $table_name";
        $field_list = $this->db->query($sql)->result_array();
        $select = '';
        foreach($field_list as $field){
            $select .= '<div class="radio">
                    <label><input type="radio" name="field_name" value="'.$field['Field'].'" required>'.$field['Field'].'</label>
                </div>';
        }
        foreach($field_list as $element) {
            if ($element === reset($field_list))
                $select .= '<div class="checked" style= display:none><label>
                    <input type="checked" name="id_field" value="'.$element['Field'].'" checked>'.$element['Field'].'</label>
                    </div>';
        }
        echo $select;
    }

    function journal_entry() {

        $this->db->truncate('temp_journal_details');

        $this->db->truncate('temp_journal_details_tag');

        $data['acc_head_list'] = $this->account_model->get_acc_list();

        $data['journal_type_list'] = $this->account_model->get_journal_type();

        $data['auto_voucher_num'] = $this->serial_generator('journal');

        $day_close = $this->input->post("day_close");

        if (!empty($day_close)) {

            //$datetime = new DateTime($day_close);
            //$datetime->modify('+1 day');

            $day_closed_date = date('Y-m-d', strtotime($day_close . ' +1 day'));

            $day_insert = array('day_close_date' => $day_closed_date,
                'day_close_status' => 'open',
                'day_close_for' => 'journal');

            $this->db->query("UPDATE day_close SET day_close_status = 'closed' WHERE day_close_date = '$day_close'");

            $this->db->WHERE('day_close_date', $day_close);

            $this->db->INSERT('day_close', $day_insert);
        }

        $data['day_closed_date'] = $this->db->query("SELECT day_close_date FROM day_close WHERE day_close_for = 'journal' AND day_close_status = 'open' ORDER BY day_close_date DESC limit 1")->row()->day_close_date;

        $this->render_page('accounting/journal/journal_entry', $data);
    }
    
    
    
    
//    function journal_entry(){
//        $data['acc_head_list'] = $this->account_model->get_acc_list();
//        $data['journal_type_list'] = $this->account_model->get_journal_type();
//        $data['auto_voucher_num'] = $this->serial_generator('journal');
//        $this->render_page('accounting/journal/journal_entry',$data);
//    }
    
    /*
     * This function is called via ajax from voucher entry page to visible the track list of an acoount
     */
//    function get_tagged_account(){
//        $acc_id = $this->input->post('acc_head_id');
//        $id = $this->input->post('id');
//        $sql = "SELECT
//        acc_head.track_agreement,
//        acc_head.track_customer,
//        acc_head.track_employee,
//        acc_head.track_vendor,
//        acc_head.track_cost_center,
//        acc_head.track_asset,
//        acc_head.track_bill,
//        acc_head.track_bank,
//        acc_head.track_inventory_item,
//        acc_head.track_teller,
//        acc_head.track_transaction
//        FROM
//        acc_head
//        WHERE acc_head.acc_head_id = '$acc_id'";
//        $query = $this->db->query($sql)->row();
//        $trac_list = array();
//        foreach ($query as $key=>$value) {
//            if($value == 1){
//                $trac_list[$key] = 1;
//            }
//        }
//        echo json_encode($trac_list);
//    }
    
    function remove_journal_from_temp() {
        $details_id = $this->input->post('details_id');
        $voucherNo = $this->input->post("voucherNo");
        $slno = $this->input->post("slno");
        
        $this->db->where('VoucherNo',$voucherNo);
        $this->db->where('SLNo',$slno);
        $this->db->delete('voucherdetails');
    }
    
    
    function edit_journal() {

        $journal_details_id = $this->input->post('id');
        $voucherNo = $this->input->post('voucherNo');
        $this->db->select('
            VoucherLineID,
            AccountName,
            Debit,
            Credit,
            Currency,
            Rate,
            FCDebit,
            FCCredit,
            SLNo
        ');

        $this->db->from('voucherdetails');

        $this->db->where("SLNo",$journal_details_id);
        $this->db->where("VoucherNo",$voucherNo);

        $query = $this->db->get();
        //debug($this->db->last_query(),1);
        $temp_data = $query->result_array();
        //debug($temp_data,1);
        echo json_encode($temp_data);
    }
    function remove_tag_from_temp() {
        $details_id = $this->input->post('details_id');
        $tag_table_name = $this->input->post('table_name');
        $voucherNo = $this->input->post('voucherNo');
        $slno = $this->input->post('slno');
        $fnnumber = $this->input->post('fnnumber');
        //debug($fnnumber,1);
        $k = explode("-", $fnnumber);
        
        $this->db->where("VoucherNo",$voucherNo);
        $this->db->where("SLNo",$slno);
        $this->db->update('voucherdetails', array($k[0] => NULL));
    }
    
    function get_tagged_account() {

        $acc_id = $this->input->post('AccountCode');
        $id = $this->input->post('id');

        $sql = "SELECT

        acc_head_tag_details.acc_head_id,

        acc_head_tag_details.acc_tag_id,

        acc_tag.acc_tag_name,

        acc_tag.table_name,

        acc_tag.field_name,

        acc_tag.acc_tag_id,
        acc_tag.ref_field

        FROM
        
        acc_head_tag_details

        INNER JOIN acc_tag ON acc_head_tag_details.acc_tag_id = acc_tag.acc_tag_id

        WHERE

        acc_head_tag_details.acc_head_id = '$acc_id'";

        $query = $this->db->query($sql)->result_array();
//        echo '<pre>';
//        print_r($query);
//                exit();
        echo '<form id="frm_tag">';

        if ($id == "") {

            foreach ($query as $value) {

                echo '<div class="col-lg-6"><div class="form-group"><span class="">' . $value['acc_tag_name'] . '</span>';

                $sqlinner = "SELECT " . $value['table_name'] . "_id, " . $value['field_name'] . " FROM " . $value['table_name'];

                $queryInner = $this->db->query($sqlinner)->result_array();
                
                echo '<select name="tagged_account[]"> class="form-control"';

                foreach ($queryInner as $innerVal) {

                    echo '<option value="' . $value['ref_field'] . '-' . $innerVal[$value['table_name'] . '_id'] . '">' . $innerVal[$value['field_name']] . '</option>';
                }

                echo '</select></div></div>';
            }
        } else {

            $selected_val = array();

            $sql_tag = "SELECT * FROM voucherdetails WHERE VoucherLineID = '".$id."'";
            $selected_val = $this->db->query($sql_tag)->row_array();

            foreach ($query as $value) {
                echo '<div class="col-lg-6"><div class="form-group"><label>' . $value['acc_tag_name'] . '</label>';

                $sqlinner = "SELECT " . $value['table_name'] . "_id, " . $value['field_name'] . " FROM " . $value['table_name'];

                $queryInner = $this->db->query($sqlinner)->result_array();

                echo '<select name="tagged_account[]">';

                foreach ($queryInner as $innerVal) {
                    echo '<option ' . ($value['ref_field'].'-'.$selected_val[$value['ref_field']] == $value['ref_field'] . '-' . $innerVal[$value['table_name'] . '_id'] ? "selected" : "") . ' value="' . $value['ref_field'] . '-' . $innerVal[$value['table_name'] . '_id'] . '">' . $innerVal[$value['field_name']] . '</option>';
                }

                echo '</select></div></div>';
            }
        }

        echo '</form>';
    }
    
    //////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////// Auto Generate Voucher ID ///////////////////////////// 
    //////////////////////////////////////////////////////////////////////////////////////
    function generate_voucher_id($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') {
        for ($s = '', $cl = strlen($c) - 1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
        return $this->check_voucher_id_before($s);
    }
    
    public function check_voucher_id_before($voucher_id) {
        $this->db->select('journal_main.voucher_auto_no');
        $this->db->from('journal_main');
        $this->db->where('journal_main.voucher_auto_no', $voucher_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $this->generate_voucher_id(4, '0123456789ABCDEF');
        } else {
            return $voucher_id;
        }
    }
    //////////////////////////////////////////////////////////////////////////////////
    function journal_final_submit() {
        $data = $this->input->post();
        $insert_data = array(
            "VoucherNo"=>$data['voucherno'],
            "VoucherType"=>$data['journal_type'],
            "VoucherDate"=>$data['journal_date'],
            "EntryDate"=>date("Y-m-d H:i:s"),
            "TotalAmount"=>$data['total_dr'],
            "Description"=>$data['narration'],
            "UserID"=>$this->session->userdata('USER_ID')
        );
        $this->db->insert("vouchermain",$insert_data);
        echo TRUE;
    }
    
//    function journal_final_submit() {
//        $data = $this->input->post();

//        unset($data['total_dr']);
//        unset($data['total_cr']);
//        
//        $data['created_by'] = $this->session->userdata('USER_ID');
//        $data['created'] = date('Y-m-d H:i:s');
//        $data['voucher_auto_no'] = $this->input->post('voucher_auto_no');
//        $manual_vouchar = $this->input->post('voucher_manual_no');
//
//        if (!empty($manual_vouchar)) {
//            $data['voucher_manual_no'] = $manual_vouchar;
//        }
//
//        $data['narration'] = $this->input->post('narration');
//        $this->db->insert('journal_main', $data);
//        $journal_id = $this->db->insert_id();
//
//        $this->serial_update('journal'); 
//        // 1 for journal
//
//        $data_list = $this->account_model->get_temp_journal_details_list();
//        $cheque_entry = false;
//        $cheque_amount = 0;
//
//        foreach ($data_list as $value) {
//            if ($cheque_amount == 0) {
//                $cheque_amount = $value['dr_amount'];
//            }
//
//            
//
//            $array_data = array('journal_main_id' => $journal_id, 'acc_head_id' => $value['acc_head_id'], 'dr_amount' => $value['dr_amount'], 'cr_amount' => $value['cr_amount'], 'currency' => $value['currency'], 'currency_rate' => $value['currency_rate'], 'description' => $value['description']);
//            $this->db->insert('journal_details', $array_data);
//            $journal_details_id = $this->db->insert_id();
//            if (isset($value['tag_data']) && $value['tag_data'] != '') {
//                $table_entity = preg_split("/,/", $value['tag_data']);
//
//
//                $tag_array = array();
//                $customer_id = null;
//                foreach ($table_entity as $tegged_val) {
//                    $split_val = preg_split("/-/", $tegged_val);
//                    $tag_array[] = array('journal_details_id' => $journal_details_id,
//                        'table_name' => $split_val[0],
//                        'entity_id' => $split_val[1]
//                    );
//
//                    if ($split_val[0] == 'customer') {
//                        $this->db->where("journal_details_id", $journal_details_id);
//                        $this->db->update('journal_details', array("customer_id" => $split_val[1]));
//                        $customer_id = $split_val[1];
//                    }
//
//                    if ($split_val[0] == 'bank') {
//                        $cheque_entry = true;
//                        $cheque_data['customer_id'] = $customer_id;
//                        $bank_id = $split_val[1];
//                    }
//                }
//                $this->db->insert_batch('journal_details_tag', $tag_array);
//            }
//        }
//
//        if ($cheque_entry) {
//
//            $cheque_data = array();
//
//
//            $cheque_data['cheque_date'] = date("Y-m-d H:i:s");
//
//            $cheque_data['referance_type'] = 'customer';
//
//
//            $cheque_data['customer_id'] = $customer_id;
//
//            $cheque_data['bank_id'] = $bank_id;
//
//            $cheque_data['status'] = 'Deposited';
//
//            $cheque_data['cheque_amount'] = $cheque_amount;
//
//            $this->db->insert('cheque_details', $cheque_data);
//        }
//
//        $this->db->truncate('temp_journal_details');
//
//        $this->db->truncate('temp_journal_details_tag');
//
//        redirect('accounts_configuration/journal/' . $journal_id);
//    }
    
    
//    function journal_final_submit(){
//        $data = $this->input->post();
//        //print_r($data);
//        $form_main = $data['form_main'];
//        $details_data = $data['details_data'];
//        $voucher_main = array();
//        $voucher_details = array();
//        foreach ($form_main as $value) {
//            $voucher_main[$value['name']] = $value['value'];
//        }
//        $voucher_main['created_by'] = $this->session->userdata('USER_ID');
//        $voucher_main['created'] = date('Y-m-d H:i:s');
//        $voucher_main['total_amount'] = $voucher_main['total_dr'];
//        unset($voucher_main['total_dr']);
//        unset($voucher_main['total_cr']);
//        $voucher_main['voucher_number_auto'] = $this->serial_generator('journal');
//        $voucher_id = $voucher_main['voucher_number_auto'];
//        $this->db->insert('voucher_main',$voucher_main);
//        foreach ($details_data as $value) {
//            $temp = array('voucher_main_id'=>$voucher_id);
//            foreach ($value as $val) {
//                $temp[$val['name']] = $val['value'];
//            }
//            $temp['base_dr_amount'] = $temp['dr_amount'];
//            $temp['base_cr_amount'] = $temp['cr_amount'];
//            $temp['fc_dr_amount'] = $temp['dr_amount']*$temp['currency_rate'];
//            $temp['fc_cr_amount'] = $temp['cr_amount']*$temp['currency_rate'];
//            $voucher_details[] = $temp;
//        }
//        $this->db->insert_batch('voucher_details',$voucher_details);
//        $this->db->query("UPDATE auto_code_serial SET current_serial = current_serial + 1 WHERE format_id = 1");
//        echo $voucher_id;
//    }
    
    function voucher($journal_id){
        $data['voucher_info'] = $this->account_model->voucher_details_model($journal_id);
        $this->render_page('accounting/journal/voucher',$data);
    }
    
    function acc_config(){
        $this->render_page('accounting/configuration/acc_config');
    }
   /*
    * Modal Item Show via Ajax from Journal Entry
    */ 
    function show_table($table_name){
        $data['table_name'] = $table_name;
        $data['table_data'] = $this->db->query("SELECT ".$table_name."_id, ".$table_name."_name FROM $table_name")->result_array();
        $this->load->view('accounting/configuration/test',$data);
    }
    
    public function manager($term) {
        $data['search_panel'] = $this->search_panel($term);
        $this->render_page('accounting/common_manager',$data);
    }
    
    private function search_panel($event){
        
    }
    
//    function save_journal_to_temp() {
//        $data = $this->input->post();
//        extract($data);
//        $tag_data = isset($data['tagged_account']) ? $data['tagged_account'] : array();
//        unset($data['tagged_account']);
//        unset($data['journal_date']);
//        unset($data['entry_date']);
//
//        if (!$data['dr_amount']) {
//            unset($data['dr_amount']);
//        }
//
//        if (!$data['cr_amount']) {
//            unset($data['cr_amount']);
//        }
//
//        $result = $this->db->query("SELECT COUNT(acc_head.acc_head_id) AS val FROM acc_head WHERE acc_head.parent_id  = $acc_head_id")->row_array();
//        $parent_id = $result['val'];
//
//        if ($parent_id < 1) {
//            $id = $this->input->post('journal_details_id');
//            $this->db->where('journal_details_id', $id);
//            $this->db->delete('temp_journal_details');
//            
//            $this->db->insert('temp_journal_details', $data);
//            
//            $this->db->where('journal_details_id', $id);
//            $this->db->delete('temp_journal_details_tag');
//
//            if (!empty($tag_data)) {
//                $insert_data = array();
//                
//                foreach ($tag_data as $value) {
//                    $insert_data[] = array('journal_details_id' => $id, 'table_name' => $value);
//                }
//                
//                $this->db->insert_batch('temp_journal_details_tag', $insert_data);
//            }
//        } else {
//            echo 1;
//        }
//    }
    
    
    function save_journal_to_temp() {
        $data = $this->input->post();
        $id = $this->input->post('journal_details_id');
        //debug($data,1);
        extract($data);
        $tag_data = isset($data['tagged_account']) ? $data['tagged_account'] : array();
        //debug($tag_data,1);
        $result = $this->db->query("SELECT COUNT(chartofaccounts.AccountCode) AS val FROM chartofaccounts WHERE chartofaccounts.ParentID  = $acc_head_id")->row_array();
        $parent_id = $result['val'];

        if ($parent_id < 1) {
            if($data['VoucherNo'] == "")
            {
                $VoucherNo = get_generated_code(9);
            }
            else
            {
                $VoucherNo = $data['VoucherNo'];
            }
            if(isset($data['edit']))
            {
                $idarray = explode("-", $id);
                $slno = $idarray[3];
                $voucherlineid = $id;
                $this->db->where('VoucherLineID', $id);
                $this->db->delete('voucherdetails');
            }
            else
            {
                $slno = $id;
                $voucherlineid = $VoucherNo."-".$id;
            }
            $vd = array(
                "VoucherLineID"=>$voucherlineid,
                "VoucherNo"=>$VoucherNo,
                "SLNo"=>$slno,
                "AccountName"=>$data["acc_head_id"],
                "Debit"=>($data["dr_amount"])?$data["dr_amount"]:0,
                "Credit"=>($data["cr_amount"])?$data["cr_amount"]:0,
                "Currency"=>$data["currency"],
                "Rate"=>$data["currency_rate"],
                "UserID"=>  $this->session->userdata("USER_ID"),
                "TransactionDate"=>$data["TransactionDate"]
            );
            //debug($tag_data,1);
            if (!empty($tag_data)) {
                
                foreach ($tag_data as $key=>$value) {
                    $k = explode("-", $value);
                    $vd[$k[0]] = $k[1];
                }
            }

            $this->db->insert("voucherdetails",$vd);
            echo $VoucherNo;
        } else {
            echo 1;
        }
    }
    
    
    
    public function my_approval_list(){
        $user_id = $this->session->userdata("USER_ID");
        $data['approval_list'] = $this->account_model->get_my_approvd_list($user_id);
        $this->render_page("accounting/my_approval_list_view",$data);
    }
}
?>