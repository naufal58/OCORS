<?php

namespace App\Controllers;

use App\Models\LoadUserManga;
use App\Models\LoadManga;
use App\Models\User;


class Profile extends BaseController
{
	protected $session;

	public function __construct(){
		$this->session = session();
	}

	public function index()
	{
		if(!$this->session->get("loggedIn"))
			return redirect()->to(base_url());

		$user = $this->session->get('data');
		$loadUserManga = new LoadUserManga();
		$userManga = $loadUserManga->where('userid',$user['id'])->findAll();
		$loadManga = new LoadManga();
		$mangas = [];
		foreach($userManga as $isi){
			$m = $loadManga->where('id',$isi['mangaId'])->first();
			array_push($mangas,$m);
		}
		// dd($userManga);
		$data = 
		[
			'loggedin' => 1,
			'mangas' => $mangas,
			'tmpImg' => $user['profileImg'],
			'tmpName' =>  $user['username'],
			'tmpEmail' => $user['email'],
			'tmpPrivilege' => $user['privilege'],
			'css' => 'profile.css'
		];
		echo view('layout/header',$data);
		echo view('profile', $data);
	}

	public function change(){
		helper(['form']);

		$rules = [
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
			$user = $this->session->get('data');
			// dd($this->request->getVar('password'));
			// dd($user['username']);
			// $data = [
			// 	'username' => $user['username'],
			// 	'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)];
			$model->where('username',$user['username'])->set('password',password_hash($this->request->getVar('password'), PASSWORD_DEFAULT))->update();
			return redirect()->to(base_url('profile'));
        }else{            
            session()->setFlashData('errors',$this->validator->getErrors());
			return redirect()->to(base_url('profile'));
        }
		
	}
	public function upload(){
		helper(['form']);
		$user = $this->session->get('data');
		$file = $this->request->getFile('profpic');
		// dd($file);
		$extension = $file->getExtension();
		$newName = $user['username'].'_'.uniqid().".".$extension;
		$location = 'profpic';
		$rules = [
			'profpic' => [
				'rules' => "max_size[profpic,2048],is_image[profpic]",
				'errors' => [
					'required'=> 'You need to upload your image!']
				]
		];
		if($this->validate($rules)){
			$model = new User();
			$user = $this->session->get('data');
			// dd(base_url('profpic').'/'.$user['profileImg']);
			// dd(ROOTPATH.'public\profpic');
			// dd(FCPATH);
			$model->where('username',$user['username'])->set("profileImg",$newName)->update();
			$file->move(ROOTPATH.'public\profpic',$newName);
			if($user['profileImg'] != 'profile.png'){
				unlink(FCPATH.'profpic/'.$user['profileImg']);
			}
			$user['profileImg'] = $newName;
			session()->set('data',$user);
			return redirect()->to(base_url('profile'));
		}
		else{
			session()->setFlashData('errors',$this->validator->getErrors());
			return redirect()->to(base_url('profile'));
		}
	}
}

