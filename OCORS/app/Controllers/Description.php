<?php

namespace App\Controllers;

use App\Models\LoadManga;
use App\Models\LoadUserManga;
use App\Models\LoadMangaChapters;
class Description extends BaseController
{
	protected $loadManga;
	protected $session;

	public function __construct(){
		$this->loadManga = new LoadManga();
		$this->session =  session();
	}

	public function index($mangaId)
	{

		$isi = $this->loadManga->where('id',$mangaId)->findAll(1);
		$visited = intval($isi[0]['visited']);
		$this->loadManga->where('id',$mangaId)->set('visited',$visited+1)->update();
		// dd($isi[0]);
		$genres = json_decode($isi[0]['genre']);
		// dd($genres);
		$bought = 0;
		$data = 
		[
			'loggedin' => 0,
			'tmpImg' => 'profile.png',
			'tmpName' => 'Guest',
			'tmpPrivilege' => '0',
			'tmpBought' => $bought,
			'data' => $isi[0],
			'genres' => $genres,
			'chapters' => 0,
			'css' => 'my.css',
			'id' => $mangaId
		];
		if($this->session->get('loggedIn')){
			$model = new LoadUserManga();
			$user = $this->session->get('data');
			$arr = [
				'mangaId' => $mangaId,
				'userId' => $user['id']
			];
			$manga = $model->where($arr)->first();
			$chapter = [];
			if($manga){
				$model2 = new LoadMangaChapters();
				$chapter = $model2->where('mangaId',$mangaId)->findAll();
				// dd($chapter);
				$bought = 1;

			}
			$data['loggedin'] = 1;
			$data['tmpName'] = $user['username'];
			$data['tmpImg'] = $user['profileImg'];
			$data['tmpPrivilege'] = $user['privilege'];
			$data['tmpBought'] = $bought;
			$data['chapters'] = $chapter;
			// dd($user);
		}
		echo view('layout/header',$data);
		echo view('description', $data);
	}
	public function back(){
		return redirect()->to(base_url());
	}
}
