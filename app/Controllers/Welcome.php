<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\OutModel;
use App\Models\WarehouseModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Welcome extends BaseController
{
	public function __construct()
    {
        $this->reports = new OutModel();
        
        $this->warehouse = new WarehouseModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index()
	{
		$data = [
            'title' => 'Home',
			'title_menu' => 'Home',
            'sidebar' => 'Home',
            'warehouse' => $this->warehouse->get_all_warehouse()
        ];

        echo view('layout/landing_header', $data);
		echo view('landing_page/landing_page2', $data);
        echo view('layout/landing_footer');
	}


    public function about_us()
	{
		$data = [
            'title' => 'About Us',
			'title_menu' => 'About Us',
            'sidebar' => 'About Us',
            'warehouse' => $this->warehouse->get_all_warehouse()
        ];

        echo view('layout/landing_header', $data);
		echo view('landing_page/about_us', $data);
        echo view('layout/landing_footer');
	}

    public function visi_misi()
	{
		$data = [
            'title' => 'Visi Misi',
			'title_menu' => 'Visi Misi',
            'sidebar' => 'Visi Misi',
            'warehouse' => $this->warehouse->get_all_warehouse()
        ];

        echo view('layout/landing_header', $data);
		echo view('landing_page/visi_misi', $data);
        echo view('layout/landing_footer');
	}
}
?>