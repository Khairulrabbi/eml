<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounts_cheque_management extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('cheque_management');
        $this->load->model('deligation_model');
        $this->load->model('common_model');
    }
    
    public function outgoing_cheque()
    {
        $data['header_title'] = "Outgoing Cheque Management.";
        $data['ref_name'] = $this->common_model->get_enum_list('payment_approval_note','ref_name');
        $this->render_page('accounting/cheque_management/outgoing_cheque',$data);
    }
    
    public function get_cheque_head()
    {
        $ChequeReferenceType = $this->input->post('ChequeReferenceType');
        echo $this->cheque_management->get_cheque_head_html($ChequeReferenceType);
    }
    
    public function out_going_cheque_save()
    {
        $ChequeID = get_generated_code(8);
        $post = $this->input->post();
        $post['TotalAmount'] = $post['Amount'];
        $post['ChequeID'] = $ChequeID;
        //debug($post,1);
        $this->db->insert("outgoingcheque",$post);
        echo TRUE;
    }
}



