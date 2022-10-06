<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\UserhrisModel;
use App\Models\StateModel;
use App\Models\OwnersModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->hris  = new UserhrisModel();
        $this->state  = new StateModel();
        $this->owners  = new OwnersModel();

        helper(['form']);
    } 

    public function index()
	{
        if (session('logged_in') == TRUE) 
        {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Login - WMS'
        ];

        echo view('auth/login_admin', $data);
	}

    public function admin()
	{
        if (session('logged_in') == TRUE) 
        {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Login - WMS'
        ];

        echo view('auth/login_admin', $data);
	}

    public function login_admin(){
        $appid_key = "posloghris-v1";

        $nik = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $ArrayParse = array(
            'username' => $nik,
            'password' => $password,
            'appid_key' => $appid_key,
            'your_apps_id' => "APPS-009"
        );

        $signature = hash_hmac('sha256', json_encode($ArrayParse), "0a05252241f3bc45ffc4abaeca369963");
        
        $JsonFormatParse = json_encode($ArrayParse);
        $ch = curl_init();
        
        $headers  = array(
            'Content-Type: text/plain',
            'Cookie: ci_session=3v1e45vqid18dcrtiuqahh882siltv7l',
            'signature:' . $signature . ''
        );
        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/loginWeb');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JsonFormatParse);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);

        if (@$dataObject->code == '200') { // login HRIS
            // print_r($dataObject);
            // die;
            // if (@$dataObject->data->division_id == 'DIV-002' || @$dataObject->data->division_id == 'DIV-003') {
                $user_hris = $this->hris->getUserByNik($dataObject->data->employee_number);
                if(!empty($user_hris->hris_nik) and !empty($user_hris->user_level)){
                    if($user_hris->warehouse_id != null){
                        $warehouse_id = $user_hris->warehouse_id;
                    } else {
                        $warehouse_id = "POSLOG";
                    }
                    $data = array(
                        'user_id' => $user_hris->hris_nik,
                        'email' => $user_hris->hris_email,
                        'fullname' => $user_hris->hris_name,
                        'level_id' => $user_hris->user_level,
                        'warehouse_id' => $warehouse_id,
                        'division_id' => $dataObject->data->division_id,
                        'division_name' => $dataObject->data->division_name,
                        'employee_photo' => $dataObject->data->employee_photo,
                        'level_name' => $dataObject->data->level_name,
                        'job_title' => $dataObject->data->job_title,
                        'office_name' => $dataObject->data->office_name,
                        'user_type' => 0,
                        'user_src' => 'HRIS',
                        'logged_in' => TRUE
                    );
                    session()->set($data);
                    // var_dump($data);die;
                    // if(strpos(, 'Finance'))
                    $level_id = $data['level_id'];
                    if ($level_id == 'LV008') {
                        return redirect()->to(base_url('topup'));
                    } elseif($level_id == 'LV009') {
                        return redirect()->to(base_url('materialapproval'));
                    } else {
                        return redirect()->to(base_url('dashboard'));
                    }
                }else{
                    if(!empty($user_hris->hris_nik)){
                        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Contact your Admin to Register your account.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                        return redirect()->to(base_url('login-admin'))->withInput();
                    }else {
                        $data = array(
                            'hris_nik' => $dataObject->data->employee_number,
                            'hris_name' => $dataObject->data->full_name,
                            'hris_email' => $dataObject->data->official_email,
                            'hris_status' => 1
                        );
                        $this->hris->insert_data($data);
                        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Contact your Admin to Register your accounts.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                        return redirect()->to(base_url('login-admin'))->withInput();
                    } 

                }
                
            // } else {
            //     session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">You cannot access with this credentials.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            //     return redirect()->to(base_url('login-admin'));
            // }   
        } else {
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">'.$dataObject->message.'</div>
            <div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('login-admin'))->withInput();
        }
    }

    public function login(){
        $appid_key = "posloghris-v1";

        $nik = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $ArrayParse = array(
            'username' => $nik,
            'password' => $password,
            'appid_key' => $appid_key,
            'your_apps_id' => "APPS-009"
        );

        $signature = hash_hmac('sha256', json_encode($ArrayParse), "0a05252241f3bc45ffc4abaeca369963");
        
        $JsonFormatParse = json_encode($ArrayParse);
        $ch = curl_init();
        
        $headers  = array(
            'Content-Type: text/plain',
            'Cookie: ci_session=3v1e45vqid18dcrtiuqahh882siltv7l',
            'signature:' . $signature . ''
        );
        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/loginWeb');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JsonFormatParse);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        // var_dump($dataObject);
        // die;

        $user_email = $this->request->getPost('email');
        $user_password = hash('sha256', $this->request->getPost('password'));
        $valid_user = $this->users->login($user_email, $user_password);

        if ($valid_user) {
            if ($valid_user->status == 1) {
                if (hash('sha256', $password, $valid_user->password)) {
                    if($valid_user->user_type == 1){
                        $office = $valid_user->owners_id;
                    }else {
                        $office = $valid_user->warehouse_id;
                    }
                    $owner_data = $this->owners->get_owner_byid($valid_user->owners_id);
                    $data = [
                        'user_id' => $valid_user->user_id,
                        'email' => $valid_user->email,
                        'level_id' => $valid_user->level_id,
                        'warehouse_id' => @$valid_user->warehouse_id, // nanti ini disesuaikan
                        'owners_id' => @$valid_user->owners_id, // nanti ini disesuaikan
                        'fullname' => @$valid_user->fullname,
                        'phone' => @$valid_user->phone,
                        'company' => @$valid_user->company,
                        'user_type' => @$valid_user->user_type,
                        'user_src' => 'LOCAL', 
                        'owners_balance' => @$owner_data->owners_balance,
                        'owners_va_number' => @$owner_data->owners_va_number,
                        'job_title' => @$owner_data->owners_name,
                        'logged_in' => TRUE
                    ];
                    session()->set($data);
                    // if ($valid_user->level_id == 'LVL-003') {
                    if($valid_user->user_type == 1){
                        return redirect()->to(base_url('dashboard_seller'));
                    }else {
                        return redirect()->to(base_url('dashboard'));
                    }
                    // }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Wrong Email or HRIS NIK; or Password! Please try again.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                    return redirect()->to(base_url('auth'));
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your account has not been activated, please check your email.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('auth'));
            }
        } else if (@$dataObject->code == '200') { // login HRIS
        
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">You do not have access on this page.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
            
        } else {
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">'.$dataObject->message.'</div>
            <div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
        }
    }

    public function logout()
	{
		session()->destroy();
        if(session()->get('user_type') == 1){
            return redirect()->to(base_url('auth'));
        } else {
            return redirect()->to(base_url('login-admin'));
        }
	}

    public function register()
    {
        if(@$this->request->getPost('state_id')){
            $city = $this->state->getCity($this->request->getPost('state_id'));
        }else{
            $city = NULL;
        }
        if(@$this->request->getPost('city_id')){
            $district = $this->state->getDistrict($this->request->getPost('city_id'));
        }else{
            $district = NULL;
        }
        if(@$this->request->getPost('district_id')){
            $sub_district = $this->state->getSubDistrict($this->request->getPost('district_id'));
        }else{
            $sub_district = NULL;
        }
        $data = [
            'title' => 'Register - OMS',
            'autogen' => $this->users->generate_id(),
            'owners_id' => $this->owners->generate_id(),
            'validation' => \Config\Services::validation(),
            'request' => $this->request,
            'state' => $this->state->getState(),
            'city' => $city,
            'district' => $district,
            'sub_district' => $sub_district
        ];

        echo view('auth/register', $data);
    }

    public function signup()
    {
        $data = [
            'title' => 'Signing Up - WMS'
            
        ];

        $validate = $this->validate([
            'fullname' => ['label' => 'Fullname', 'rules' => 'required'],
            'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email|is_unique[users.email]'],
            'password' => ['label' => 'Password', 'rules' => 'required|min_length[6]|matches[repassword]'],
            'repassword' => ['label' => 'Re-Password', 'rules' => 'required|min_length[6]'],
            'phone' => ['label' => 'Contact Phone', 'rules' => 'required|is_unique[users.phone]'],
            'owners_name' => ['label' => 'Owner Name', 'rules' => 'required'],
            'owners_address' => ['label' => 'Address', 'rules' => 'required'],
            // 'owners_latitude' => ['label' => 'Latitude', 'rules' => 'required'],
            // 'owners_longitude' => ['label' => 'Longitude', 'rules' => 'required'],
            'state_id' => ['label' => 'Province', 'rules' => 'required'],
            'city_id' => ['label' => 'City', 'rules' => 'required'],
            'district_id' => ['label' => 'District', 'rules' => 'required'],
            'sdistrict_id' => ['label' => 'Sub District', 'rules' => 'required']
        ],[
            'email' => [
                'is_unique' => 'This email is already used!'
            ],
            'phone' => [
                'is_unique' => 'This phone number is already used!'
            ],
        ]);

        if (!$validate) {
            if(@$this->request->getPost('state_id')){
                $city = $this->state->getCity($this->request->getPost('state_id'));
            }else{
                $city = NULL;
            }
            if(@$this->request->getPost('city_id')){
                $district = $this->state->getDistrict($this->request->getPost('city_id'));
            }else{
                $district = NULL;
            }
            if(@$this->request->getPost('district_id')){
                $sub_district = $this->state->getSubDistrict($this->request->getPost('district_id'));
            }else{
                $sub_district = NULL;
            }
            $data = [
                'title' => 'Register - OMS',
                'autogen' => $this->users->generate_id(),
                'owners_id' => $this->owners->generate_id(),
                'validation' =>  $this->validator,
                'request' => $this->request,
                'state' => $this->state->getState(),
                'city' => $city,
                'district' => $district,
                'sub_district' => $sub_district
            ];
    
            echo view('auth/register', $data);
        } else{
            $id = $this->owners->generate_id();
            $total_seller = $this->owners->total_seller();

            // fungsi promo sampai 31 desember
            $today = date('Y-m-d');
            $end_promo_date = '2021-12-31';
            if(intVal($total_seller[0]->total_seller) <= 100 and $today <= $end_promo_date){
                $balance = 50000;
            } else {
                $balance = 0;
            }
            $data_owner = [
                'owners_id' => $id,
                'owners_name' => $this->request->getPost('owners_name'),
                'owners_status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => $this->request->getPost('fullname'),
                'owners_address' => $this->request->getPost('owners_address'),
                'owners_latitude' => $this->request->getPost('owners_latitude'),
                'owners_longitude' => $this->request->getPost('owners_longitude'),
                'owners_balance' => $balance,
                'owners_va_number' => $this->owners->generate_va_number()->VA_NUMBER,
                'state_id' => $this->request->getPost('state_id'),
                'city_id' => $this->request->getPost('city_id'),
                'district_id' => $this->request->getPost('district_id'),
                'sdistrict_id' => $this->request->getPost('sdistrict_id')
            ];


            $user_id = $this->users->generate_id();
            $email = $this->request->getPost('email');
            $fullname = $this->request->getPost('fullname');
            $agreement = intval($this->request->getPost('agreement'));
            $user_type = 1;
            if($user_type == 1){
                $level = 'LV006';
            }else {
                $level = 'LV007';
            }
            $data_users = [
                'user_id' => @$user_id,
                'fullname' => $fullname,
                'email' => $email,
                'password' => hash('sha256', $this->request->getPost('password')),
                'level_id' => $level,
                'user_type' => 1,
                'phone' => $this->request->getPost('phone'),
                'owners_id' => $id,
                'email_verification' => 0,
                'req_reset_pass' => 0,
                'status' => 0,
                'created_time' => date('Y-m-d H:i:s'),
                'agreement' => $agreement
            ];

            $email_message = $this->_send_email_verification($user_id, $email, $fullname, 'verify');

            if($email_message == true){
                $this->owners->insert_data($data_owner);
                $this->users->insert_data($data_users);
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Congratulations! Please check your email for verification.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('auth'));
            } else {
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your email is not valid. Please check it again.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('register'));
            }

        }
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Forgot Password - WMS',
            'validation' => \Config\Services::validation()
        ];

        echo view('auth/forgot_password', $data);
    }

    public function forgot()
    {
        $data = [
            'title' => 'Forgotten Password - WMS'
        ];

        $validate = $this->validate([
            'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email']
        ],[
            'email' => [
                'required' => 'Please enter your email!'
            ]
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/forgot'))->withInput();
        } else{
            $checkEmail = $this->users->checkEmail($this->request->getPost('email'));

            if (!$checkEmail) {
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">We couldn\'t find your account with that information.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('/forgot'));
            } else {
                $id = $checkEmail->user_id;
                $fullname = $checkEmail->fullname;
                $email = $checkEmail->email;
                $userData = array(
                    'req_reset_pass' => 1
                );

                $this->users->update_data($id, $userData);
                
                $email_message = $this->_send_email_verification($id, $email, $fullname, 'forgot');
    
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Password reset has been successfully requested, please check your email ('. $checkEmail->email .').</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('auth'));
            }
        }
    }

    protected function _send_email_verification($user_id, $email, $fullname, $type)
	{
        $to                 = $email;
        $subjectverif       = '[Email Verification] STORI';
        $subjectforgot      = '[Forgot Password] STORI';
        
        $mail = new PHPMailer(true);
 
        // $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host         = 'smtp.googlemail.com';   
        $mail->SMTPAuth     = true;
        $mail->Username     = 'no-reply@poslogistics.co.id'; 
        $mail->Password     = 'Make1tright!';
        $mail->SMTPSecure   = 'ssl';
        $mail->Port         = 465;

        $mail->setFrom('no-reply@poslogistics.co.id', 'STORI'); 
        $mail->addAddress($to);
        $mail->addReplyTo($to, 'STORI'); 
        // Content
        $mail->isHTML(true);

        if ($type == 'verify') {
            $data = [
                'email' => $email,
                'fullname' => $fullname,
                'user_id' => $user_id
            ];
            $email_verifs = view('email/verify', $data);
            $mail->Subject = $subjectverif;
            $mail->Body    = $email_verifs;
        } else if ($type == 'forgot') {
            $data = [
                'email' => $email,
                'fullname' => $fullname,
                'user_id' => $user_id
            ];
            $forgot_password = view('email/forgot-password', $data);
            $mail->Subject = $subjectforgot;
            $mail->Body    = $forgot_password;
        }

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function verify($id)
    {
        $user = $this->users->get_users_byid($id);
		if(@$user->email_verification == 0 AND @$user->status == 0){
			$user_data = array(
				'email_verification' => 1,
				'status' => 1
			);
			$this->users->update_data($id, $user_data);

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Congratulations! Your email address is successfully verified!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
		}
		return redirect()->to(base_url('auth'));
    }

    public function reset_password($id)
    {
        $user = $this->users->get_users_byid($id);
		if($user->req_reset_pass == 1){
            $validate = $this->validate([
				'user_password' => ['label' => 'New Password', 'rules' => 'required|min_length[6]|matches[user_repassword]'],
				'user_repassword' => ['label' => 'Confirm Password', 'rules' => 'required|min_length[6]']
			]);

            $data = [
                'title' => 'Reset Password - WMS',
                'user' => $user,
                'validation' => \Config\Services::validation()
            ];
    
            if(!$validate){
                echo view('auth/reset-password', $data);
            } else {
                $userData = array(
					'password' => hash('sha256', $this->request->getPost('user_password')),
					'req_reset_pass' => 0
				);

                $this->users->update_data($id, $userData);

                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your password has been successfully changed!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('auth'));
            }
		} else {
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">You did not request to reset your password!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
        }
    }

}
?>