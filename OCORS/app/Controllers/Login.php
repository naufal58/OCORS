<?php

namespace App\Controllers;
use App\Models\User;
class Login extends BaseController
{
	public function index()
	{
		helper(['form']);
		return view('login');
	}

	public function auth(){
		$session = session();
		$model = new User();
		if($this->request->getMethod()=="post"){
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$data = $model->where('username',$username)->first();
			if($data){
				$pass = $data['password'];
				if(password_verify($password,$pass)){
					unset($data['password']);
					$cart = array();
					$sessionData = [
						'data' => $data,
						'loggedIn' => TRUE,
						'cart' => $cart
					];
					$session->set($sessionData);
					return redirect()->to(base_url());
				}
				else{
					$session->setFlashdata('msg', 'Wrong Password');
               		return redirect()->to('/login');
				}
			}
			else{
				$session->setFlashdata('msg', 'Username not Found');
            	return redirect()->to('/login');
			}
		}
	}
	public function logout()
	{
		session()->destroy();
        return redirect()->to(base_url());
	}
}
