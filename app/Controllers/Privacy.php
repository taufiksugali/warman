<?php

namespace App\Controllers;
use App\Models\OwnersModel;
use App\Models\StateModel;
use Config\Services;

class Owners extends BaseController
{
    public function __construct()
    {
        $this->owners = new OwnersModel();
        $this->state = new StateModel();

        helper(['form', 'url', 'my']);
    }

	public function index()
	{
		$data = [
            'title' => 'Privacy Policy',
            'title_menu' => 'Privacy Policy',
            'sidebar' => 'Privacy Policy'
        ];	

		echo view('layout/header', $data);
		echo view('owner/owner_data', $data);
		echo view('layout/footer');
    }

}

?>