<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_Reports extends Custom_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('url','html','form');
        $this->load->library('session');
        $this->load->model('account_reports_model','','TRUE'); 
        $this->load->library('form_validation');
    }
    
    public function accounts_statement()
    {
        $data['page_title'] = "Accounts Statement";
        $this->render_page('accounting/reports/accounts_statement',$data);
    }
    
    public function get_taging_by_acc_head()
    {
        $acc_head_id = $this->input->post("acc_head_id");
        echo $this->account_reports_model->get_taging_by_acc_head_html($acc_head_id);
    }
    public function get_account_statement()
    {
        $post = $this->input->post();
        //debug($post,1);
        $transaction_date = $this->input->post("TransactionDate");
        $date_ex = explode("-", $transaction_date);
        $fromdate = $date_ex[0];
        $todate = $date_ex[1];
        $data['opening_balance_date'] = date(date('Y-m-d',strtotime($fromdate)),  strtotime(' -1 day'));
        $account_head = $this->input->post("acc_head_id");
        $data['dynamic_thead'] = $this->account_reports_model->dynamic_thead($post,"thead");
        $data['opening_balance_head'] = $this->account_reports_model->dynamic_thead($post,"opening_balance_head");
        //$data['tag_value'] = $this->account_reports_model->dynamic_thead($post,"tag_value");
       
        $data['opening_balance'] = $this->account_reports_model->get_opening_balance($fromdate,$account_head,$post);
        $data['statement_data'] = $this->account_reports_model->get_statement_data($fromdate,$todate,$account_head,$post); 
        //debug($this->db->last_query(),1);
        $this->load->view('accounting/reports/accounts_statement_result',$data);
    }
    
    
    public function trial_balance($parent_id = 0)
    {
        $data['page_title'] = "Trial Balance";
        $this->render_page('accounting/reports/trial_balance',$data);
    }
    
    public function get_trial_balance()
    {
        $transaction_date = $this->input->post("TransactionDate");
        $date_ex = explode("-", $transaction_date);
        $fromdate = $date_ex[0];
        $todate = $date_ex[1];
        $data['statement_data'] = $this->account_reports_model->trial_balance(0,$fromdate,$todate);
        
        $this->load->view('accounting/reports/trial_balance_result',$data);
    }
}
?>