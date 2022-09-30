<?php

namespace App\Controllers;

use App\Models\User;

class Register extends BaseController
{
	public function index()
	{
		helper(['form']);
		$data = [];
		return view('register',$data);
	}

	public function save(){
		helper(['form']);

		$rules = [
			'username' => 'required|min_length[6]|max_length[24]',
			'email' => 'required|valid_email|min_length[6]|max_length[24]',
			'password'      => 'required|min_length[6]|max_length[200]',
            'cpassword'  => [
				'rules' => 'matches[password]',
				'errors' => [
					'matches' => 'Your password does not match!'
				]
			]
		];
		if($this->validate($rules)){
			$model = new User();
			$data = [
				'username' => $this->request->getVar('username'),
				'email' => $this->request->getVar('email'),
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				'profileImg' => 'profile.png'
			];
			$model->save($data);
			return redirect()->to('/login');
        }else{            
            session()->setFlashData('errors',$this->validator->getErrors());
			return redirect()->to(base_url('register'));
        }
	}
}
