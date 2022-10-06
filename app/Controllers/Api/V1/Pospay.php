<?php

namespace App\Controllers\Api\V1;
use App\Models\PospayApiModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use Config\Services;

class Pospay extends BaseController {
    use ResponseTrait;
    public function __construct() {
        $this->pospay = new PospayApiModel();

        helper(['form', 'url']);
        header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
        header('Content-type: application/json; charset=utf-8');
        // Poslog Celalu Dihati is : a9f29dd50156bb6a50cfe35967fec722
    } 

    public function vasbupos_inquiry() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $DataObject = (array) json_decode(file_get_contents('php://input'), TRUE);

        if ($this->request->getServer('REQUEST_METHOD') != 'POST') {
            $response = array(
				'respon_code' => 405,
				'respon_mess' => 'Request method not allowed.'
			);
        }elseif (@$DataObject['nomor_va'] == NULL || @$DataObject['kode_inst'] == NULL || @$DataObject['channel_id'] == NULL || @$DataObject['waktu_proses'] == NULL) {
            $response = array(
				'respon_code' => 400,
				'respon_mess' => 'Empty value'
			);
        }elseif ($token != 'cG9zbG9nLWFwaS12MTpwb3Nsb2cxMjNA') {
            $response = array(
				'respon_code' => 401,
				'respon_mess' => 'Invalid authentication token.'
			);
        }else{
            $nomor_va       = @$DataObject['nomor_va'];
            $kode_inst      = @$DataObject['kode_inst'];
            $channel_id     = @$DataObject['channel_id'];
            $waktu_proses   = @$DataObject['waktu_proses'];

            $get_topup = $this->pospay->get_owner_byva($nomor_va);
            $get_bank_bychannel = $this->pospay->get_bank_bychannel($channel_id);
            $get_setting_pospay = $this->pospay->get_setting_pospay();

            // $waktu_proses1 = date_create(@$get_topup->created_date);
            // $waktu_proses2 = date_create(date("Y-m-d H:i:s"));
            // $diff_date = date_diff($waktu_proses1, $waktu_proses2);
            // @$diff_date->h

            if (strlen($nomor_va) != 8) {
                $response = array(
                    'respon_code' => 400,
                    'respon_mess' => 'VA number cannot be more than or less than 8 digits.'
                );
            }elseif (@$get_topup == NULL) {
                $response = array(
                    'respon_code' => 204,
                    'respon_mess' => 'Data not available.'
                );
            }elseif ($get_setting_pospay->setting_kode_inst != $kode_inst) {
                $response = array(
                    'respon_code' => 203,
                    'respon_mess' => 'Incorrect Institution Code.'
                );
            }elseif ($get_bank_bychannel == NULL) {
                $response = array(
                    'respon_code' => 204,
                    'respon_mess' => 'Unregistered Bank.'
                );
            }else{
                $data_inquiry = [
                    'va_number' => @$get_topup->owners_va_number,
                    'nominal' => 0,
                    'admin_fee' => @$get_bank_bychannel->bank_admin,
                    'institution_code' => $kode_inst,
                    'channel_id' => $channel_id,
                    'account_name' => @$get_topup->owners_name,
                    'account_info' => @$get_bank_bychannel->bank_name,
                    'rekgiro' => $get_setting_pospay->setting_rek_giro,
                    'va_ctime' => date('Y-m-d H:i:s')
                ];

                $this->pospay->insert_inquiry($data_inquiry);
                
                $response = [
                    'respon_code' => "00",
                    'respon_mess' => "OK",
                    'nomor_va' => @$get_topup->owners_va_number,
                    'nominal' => 0,
                    'admin' => intval(@$get_bank_bychannel->bank_admin),
                    'kode_inst' => $kode_inst,
                    'channel_id' => $channel_id,
                    'nama' => @$get_topup->owners_name,
                    'info' => '',
                    'rekgiro' => $get_setting_pospay->setting_rek_giro,
                    'waktu_proses' => $waktu_proses
                ];
            } 
        }
        echo json_encode($response);
    }

    public function vasbupos_payment() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $DataObject = (array) json_decode(file_get_contents('php://input'), TRUE);

        if ($this->request->getServer('REQUEST_METHOD') != 'POST') {
            $response = array(
				'respon_code' => 405,
				'respon_mess' => 'Request method not allowed.'
			);
        }elseif (@$DataObject['nomor_va'] == NULL || @$DataObject['kode_inst'] == NULL || @$DataObject['channel_id'] == NULL || @$DataObject['nominal'] == NULL || @$DataObject['admin'] == NULL || @$DataObject['refnumber'] == NULL || @$DataObject['waktu_proses'] == NULL || @$DataObject['nopen'] == NULL || @$DataObject['hashing'] == NULL) {
            $response = array(
				'respon_code' => 204,
				'respon_mess' => 'Empty value'
			);
        }elseif ($token != 'cG9zbG9nLWFwaS12MTpwb3Nsb2cxMjNA') {
            $response = array(
				'respon_code' => 401,
				'respon_mess' => 'Invalid authentication token.'
			);
        }else{
            $nomor_va       = @$DataObject['nomor_va'];
            $kode_inst      = @$DataObject['kode_inst'];
            $channel_id     = @$DataObject['channel_id'];
            $nominal        = @$DataObject['nominal'];
            $admin          = @$DataObject['admin'];
            $refnumber      = @$DataObject['refnumber'];
            $waktu_proses   = @$DataObject['waktu_proses'];
            $nopen          = @$DataObject['nopen'];
            $hashing        = @$DataObject['hashing'];
            
            $hashing_var = $nomor_va.$kode_inst.$channel_id.$nominal.$admin.$refnumber.$waktu_proses.$nopen;
            $hashing_result = md5($hashing_var);
            // var_dump($hashing_result); die();
            
            $get_topup = $this->pospay->get_owner_byva($nomor_va);
            $get_bank_bychannel = $this->pospay->get_bank_bychannel($channel_id);
            $get_setting_pospay = $this->pospay->get_setting_pospay();

            if (strlen($nomor_va) != 8) {
                $response = array(
                    'respon_code' => 400,
                    'respon_mess' => 'VA number cannot be more than or less than 8 digits.'
                );
            }elseif ($hashing != $hashing_result) {
                $response = array(
                    'respon_code' => 401,
                    'respon_mess' => 'Invalid hashing.'
                );
            }elseif ($get_setting_pospay->setting_kode_inst != $kode_inst) {
                $response = array(
                    'respon_code' => 203,
                    'respon_mess' => 'Incorrect Institution Code.'
                );
            }elseif ($get_bank_bychannel == NULL) {
                $response = array(
                    'respon_code' => 204,
                    'respon_mess' => 'Unregistered Bank.'
                );
            }elseif (@$get_topup == NULL) {
                $response = array(
                    'respon_code' => 204,
                    'respon_mess' => 'Data not available.'
                );
            }else{
                $data_owners_topup = array(
                    'topup_id' => $this->pospay->generate_topup_id(),
                    'owners_id' => @$get_topup->owners_id,
                    'bank_id' => @$get_bank_bychannel->bank_id,
                    'dest_id' => 2,
                    'topup_amount' => intval($nominal),
                    'topup_va' => @$get_topup->owners_va_number,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => @$get_topup->owners_name,
                    'topup_status' => 1,
                );
                $this->pospay->insert_owners_topup($data_owners_topup);

                $data_payment = [
                    'respon_code' => '00',
                    'va_number' => @$get_topup->owners_va_number,
                    'nominal' => intval($nominal),
                    'admin_fee' => intval($admin),
                    'institution_code' => $kode_inst,
                    'ref_number' => $refnumber,
                    'nopend' => $nopen,
                    'channel_id' => $channel_id,
                    'account_name' => @$get_topup->owners_name,
                    'account_info' => @$get_bank_bychannel->bank_name,
                    'rekgiro' => $get_setting_pospay->setting_rek_giro,
                    'va_ctime' => date('Y-m-d H:i:s'),
                    'va_utime' => date('Y-m-d H:i:s'),
                    'underpaid' => 0
                ];
                $this->pospay->insert_payment($data_payment);

                $data_owner = [
                    'owners_balance' => @$get_topup->owners_balance + $nominal
                ];
                $this->pospay->update_data_owners(@$get_topup->owners_id, $data_owner);

                $response = [
                    'respon_code' => "00",
                    'respon_mess' => "OK",
                    'nomor_va' => $nomor_va,
                    'kode_inst' => $kode_inst,
                    'channel_id' => $channel_id,
                    'nominal' => intval($nominal),
                    'admin' => intval($admin),
                    'refnumber' => $refnumber,
                    'waktu_proses' => $waktu_proses,
                    'nopen' => $nopen
                ];
            }
        }
        echo json_encode($response);
    }    
}
?>
