<?php 
class Ledger_Model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function insert($wt_id, $from)
    {
        $sqltnx = $this->db->query("select tnx_id from wallet_transaction order id desc limit 1");
        if($sqltnx->num_rows() > 0)
        {
            $tnx_id = ((int)$sqltnx->row()->tnx_id)+1;
        }
        else{
            $tnx_id = 1;
        }

        if($from == "Registration Fees")
        {
            $sql = "select * from wallet_transaction where id=$wt_id";
            $result = $this->db->query($sql)->row_array();
            
            
            $walletArray = array(
                'tnx_id' => $tnx_id,
                'tnx_date' => $result['wallet_transaction_date'],
                'tnx_type' => 'Credit',
                'account_id' => '2',
                'location_id' => $result['location_id'],
                'tnx_description' => $result['description'],
                'gross_amount' => $result['gross_amount'],
                'vat_perc' => $result['vat_percentage'],
                'vat_amount' => $result['vat_value'],
                //'discount_perc' => $result['wallet_transaction_date'],
                //'discount_amount' => $result['wallet_transaction_date'],
                'net_amount' => $result['net_amount'],
                'payable_amount' => $result['net_amount'],
                //'debit' => $result['wallet_transaction_date'],
                'credit' => $result['net_amount'],
                'payment_type' => $result['payment_type'],
                //'payable_date' => $result['wallet_transaction_date'],
                //'cheque_no' => $result['wallet_transaction_date'],
                //'cheque_date' => $result['wallet_transaction_date'],
                //'bank_id' => $result['wallet_transaction_date'],
                'created_by' => $this->session->userid,
                'parent_id' => $result['parent_id'],
                //'coach_id' => $result['wallet_transaction_date'],
                'student_id' => $result['student_id'],
                //'activity_id' => $result['wallet_transaction_date'],
                //'details_id' => $result['wallet_transaction_date'],
                'created_at' => $result['created_at'],

            );
            $this->db->insert('ledger_report', $walletArray);
        }
        else if($from == "Prepaid Credits")
        {
            $sql = "select * from wallet_transaction where id=$wt_id";
            $result = $this->db->query($sql)->row_array();
            $walletArray = array(
                'tnx_id' => $tnx_id,
                'tnx_date' => $result['wallet_transaction_date'],
                'tnx_type' => 'Debit',
                'account_id' => '1',
                'location_id' => $result['location_id'],
                'tnx_description' => $result['description'],
                'gross_amount' => $result['gross_amount'],
                'vat_perc' => $result['vat_percentage'],
                'vat_amount' => $result['vat_value'],
                //'discount_perc' => $result['wallet_transaction_date'],
                //'discount_amount' => $result['wallet_transaction_date'],
                'net_amount' => $result['net_amount'],
                'payable_amount' => $result['net_amount'],
                //'debit' => $result['wallet_transaction_date'],
                'credit' => $result['net_amount'],
                'payment_type' => $result['payment_type'],
                'payable_date' => $result['wallet_transaction_date'],
                'cheque_no' => $result['cheque_number'],
                'cheque_date' => $result['cheque_date'],
                'bank_id' => $result['bank'],
                'created_by' => $this->session->userid,
                'parent_id' => $result['parent_id'],
                //'coach_id' => $result['wallet_transaction_date'],
                //'student_id' => $result['student_id'],
                //'activity_id' => $result['wallet_transaction_date'],
                //'details_id' => $result['wallet_transaction_date'],
                'created_at' => $result['created_at'],

            );
            $this->db->insert('ledger_report', $walletArray);
        }

        else if($from == "Slot Booking")
        {
            $sql = "select * from wallet_transaction where id=$wt_id";
            $result = $this->db->query($sql)->row_array();
            
            $walletArray = array(
                'tnx_id' => $tnx_id,
                'tnx_date' => $result['wallet_transaction_date'],
                'tnx_type' => 'Credit',
                'account_id' => '3',
                'location_id' => $result['location_id'],
                'tnx_description' => $result['description'],
                'gross_amount' => $result['gross_amount'],
                'vat_perc' => $result['vat_percentage'],
                'vat_amount' => $result['vat_value'],
                //'discount_perc' => $result['wallet_transaction_date'],
                //'discount_amount' => $result['wallet_transaction_date'],
                'net_amount' => $result['net_amount'],
                'payable_amount' => $result['net_amount'],
                //'debit' => $result['wallet_transaction_date'],
                'credit' => $result['net_amount'],
                'payment_type' => $result['payment_type'],
                'payable_date' => $result['wallet_transaction_date'],
                'cheque_no' => $result['cheque_number'],
                'cheque_date' => $result['cheque_date'],
                'bank_id' => $result['bank'],
                'created_by' => $this->session->userid,
                'parent_id' => $result['parent_id'],
                //'coach_id' => $result['wallet_transaction_date'],
                //'student_id' => $result['student_id'],
                //'activity_id' => $result['wallet_transaction_date'],
                //'details_id' => $result['wallet_transaction_date'],
                'created_at' => $result['created_at'],

            );
            $this->db->insert('ledger_report', $walletArray);
        }
    }

}
?>