<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\LoadUserManga;
use App\Models\LoadMangaChapters;
class Read extends BaseController
{
	public function index($mangaId,$chapter)
	{
		$session = session();
		if(!$session->get('loggedIn')){
			return redirect()->to(base_url('login'));
		}
		// dd($user);
		$user = $session->get('data');
		$location = "/{$mangaId}/$chapter";
		// $files = glob($location.'/*.{jpg,png,jpeg}',GLOB_BRACE);
		helper('filesystem');
		$bought = 0;
		$model = new LoadUserManga();
		$arr = [
			'mangaId' => $mangaId,
			'userId' => $user['id']
		];
		$manga = $model->where($arr)->first();
		if($manga){
			// dd($chapter);
			$bought = 1;
		}
		if($bought){
			$files = directory_map("manga/{$mangaId}/$chapter", 1);
			$loadManga = new LoadMangaChapters();
			$totalChapters = $loadManga->where('mangaId',$mangaId)->countAllResults();
			$model2 = new LoadMangaChapters();
			$chapters = $model2->where('mangaId',$mangaId)->findAll();
			$data = 
			[
				'loggedin' => 1,
				'tmpImg' => $user['profileImg'],
				'tmpName' =>  $user['username'],
				'tmpPrivilege' => $user['privilege'],
				'css' => 'reading.css',
				'counter' => 0,
				'manga' => $mangaId,
				'chapter' => $chapter,
				'chapters' => $chapters,
				'total' => $totalChapters,
				'files' => $files,
				'src' => $location
			];
			echo view('layout/header',$data);
			echo view('read', $data);
		}
		else{
			return redirect()->to(base_url());
		}
	}

	public function back(){
		return redirect()->to(base_url());
	}
}
