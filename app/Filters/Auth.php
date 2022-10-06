<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Config\Services;
use App\Models\LevelModel;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $logged_in = session()->get('logged_in');
			if($logged_in != TRUE || empty($logged_in))
			{
				#user not logged in
				session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your session has been expired. Please sign in again.</div>
            	<div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            	
				return redirect()->to(base_url('auth'));
			} else {
                $role = new LevelModel();
                $level= session()->get('level_id');
                $modName = strtolower($request->uri->getSegment(1));
                $check = $role->check_role($modName, $level);

                // special suppler admin
                if($level=="LV001") {
                    $menuCustom = array('level','userhris','users','privilege','menu','submenu');
                    if(in_array($modName, $menuCustom)) $check = true;
                }

                // special access owner
                if($level=="LV006") {
                    $menuCustom = array('topup/add','topup/add_withdraw','owners/addOwnersBank','owners/add_marketplace','owners/add_agreement');
                    $modName = strtolower($request->uri->getSegment(1).'/'.$request->uri->getSegment(2));
                    if(in_array($modName, $menuCustom)) $check = true;
                }

                if (!$check) {
                    return redirect()->to(base_url('cannot_access'));
                }
            }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}