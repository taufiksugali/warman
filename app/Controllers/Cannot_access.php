<?php

namespace App\Controllers;

class Cannot_access extends BaseController
{
	public function __construct()
    {
        helper(['form', 'url', 'my']);
    }

    public function index()
	{
		$data = [
            'title' => 'Cannot Access',
        ];

    
		echo view('layout/header', $data);
		echo view('cannot_access', $data);
		echo view('layout/footer');
	}
}
?>