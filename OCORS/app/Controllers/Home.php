<?php

namespace App\Controllers;

use App\Models\LoadManga;

class Home extends BaseController
{
	protected $session;
	protected $loadManga;
	protected $genres;
	public function __construct(){
		$this->loadManga = new LoadManga();
		$this->genres = [
			"Action"
			,"Comedy"
			,"Drama"
			,"Ecchi"
			,"Fantasy"
			,"Harem"
			,"Historical"
			,'Horror'
			,'Isekai'
			,"Josei"
			,'Romance'
			,"School"
			,"Sci-fi"
			,"Seinen"
			,"Shoujo"
			,"Shounen"
			,"Slice of Life"
			,"Supernatural"
		];
		$this->session = session();
	}

	public function index()
	{

		$isi = $this->loadManga->orderBy('visited','desc')->findAll(10);
		$data = 
		[
			'loggedin' => 0,
			'tmpImg' => 'profile.png',
			'tmpName' => 'Guest',
			'tmpPrivilege' => '0',
			'css' => 'my.css',
			'genres' => $this->genres,
			'popular' => $isi,
			'data' => $isi
		];

		if($this->session->get('loggedIn')){
			$user = $this->session->get('data');
			$data['loggedin'] = 1;
			$data['tmpName'] = $user['username'];
			$data['tmpImg'] = $user['profileImg'];
			$data['tmpPrivilege'] = $user['privilege'];
			// dd($user);
		}

		// dd($isi);
		echo view('layout\header',$data);
		echo view('home', $data);
	}


	public function search(){
		$search = $this->request->getGet('search');
		$isi = $this->loadManga->like('nama',$search)->findAll(10);
		$data = 
		[
			'loggedin' => 0,
			'tmpImg' => 'profile.png',
			'tmpName' => 'Guest',
			'tmpPrivilege' => '0',
			'css' => 'my.css',
			'genres' => $this->genres,
			'popular' => $isi,
			'data' => $isi,
			'text' => "Search : ".$search
		];
		if($this->session->get('loggedIn')){
			$user = $this->session->get('data');
			$data['loggedin'] = 1;
			$data['tmpName'] = $user['username'];
			$data['tmpImg'] = $user['profileImg'];
			$data['tmpPrivilege'] = $user['privilege'];
			// dd($user);
		}

		// dd($isi);
		echo view('layout\header',$data);
		echo view('search', $data);
	}

	public function genre(){
		$search = $this->request->getGet('genre');
		$isi = $this->loadManga->like('genre',$search)->findAll(10);
		$data = 
		[
			'loggedin' => 0,
			'tmpImg' => 'profile.png',
			'tmpName' => 'Guest',
			'tmpPrivilege' => '0',
			'css' => 'my.css',
			'genres' => $this->genres,
			'popular' => $isi,
			'data' => $isi,
			'text' => "Genre : ".$search
		];

		if($this->session->get('loggedIn')){
			$user = $this->session->get('data');
			$data['loggedin'] = 1;
			$data['tmpName'] = $user['username'];
			$data['tmpImg'] = $user['profileImg'];
			$data['tmpPrivilege'] = $user['privilege'];
			// dd($user);
		}
		// dd($isi);
		echo view('layout\header',$data);
		echo view('search', $data);
	}
	public function back(){
		return redirect()->to(base_url());
	}
}
