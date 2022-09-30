<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\LoadManga;
class Manage extends BaseController
{
    protected $session;

    public function __construct(){
        $this->session = session();
    }

	public function index(){
        if(!$this->session->get("loggedIn") || $this->session->get('data')['privilege'] != '3')
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$user = $this->session->get('data');
		$loadManga = new LoadManga();
		$mangas = $loadManga->findAll();
		// dd($manga);
		$data = 
		[
			'loggedin' => 1,
			'mangas' => $mangas,
			'tmpImg' => $user['profileImg'],
			'tmpName' =>  $user['username'],
			'tmpEmail' => $user['email'],
			'tmpPrivilege' => $user['privilege'],
			'css1' => 'bootstrap-datepicker/css/datepicker.css',
			'css2' => 'bootstrap-daterangepicker/daterangepicker.css',
			'css3' => 'style.css',
			'css4' => 'style-responsive.css',
			'css5' => 'bootstrap/css/bootstrap.min.css',
			'css6' => 'font-awesome/css/font-awesome.css'
		];
        return view('Admin/manage',$data);
    }

	public function delete($id){
		if(!$this->session->get("loggedIn") || $this->session->get('data')['privilege'] != '3')
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		helper('filesystem');
		// dd(FCPATH.'manga/'.$id);
		$model = new LoadManga();
		$model->where('id',$id)->delete();
		delete_files(FCPATH.'manga/'.$id);
		// rmdir(FCPATH.'manga/'.$id);
		return redirect()->to(base_url('admin'));
	}

	public function edit($id){
		if(!$this->session->get("loggedIn") || $this->session->get('data')['privilege'] != '3')
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

		
		$user = $this->session->get('data');
        $this->session->set('isEdit',1);
		$model = new LoadManga();
		$manga = $model->where('id',$id)->first();
		$genre = $manga['genre'];
		$genre = str_replace('[','',$genre);
		$genre = str_replace(']','',$genre);
		$genre = str_replace('"','',$genre);
		// dd($genre);
		$data = 
		[
			'loggedin' => 1,
			'tmpImg' => $user['profileImg'],
			'tmpName' =>  $user['username'],
			'tmpEmail' => $user['email'],
			'tmpPrivilege' => $user['privilege'],
			'text' => 'Edit',
			'id' => $id,
			'judul' => $manga['nama'],
            'harga' => $manga['harga'],
            'genres' => $genre,
            'deskripsi' => $manga['deskripsi'],
            'isEdit' => ''
		];
        return view('Admin/upload',$data);
	}

	public function save($id){
		helper(['form']);
        if(!$this->session->get("loggedIn") || $this->session->get('data')['privilege'] != '3'){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $model = new LoadManga();
		$manga = $model->where('id',$id)->first();
        $judul = $this->request->getVar('judul');
        $harga = $this->request->getVar('harga');
        $genres = json_encode(explode(',',$this->request->getVar('genres')));
        $deskripsi = $this->request->getVar('deskripsi');
        $coverImage = $this->request->getFile('coverImage');
		// dd($coverImage->getName()=="");
		$newName = $manga['coverImage'];
        // d($newName);
        // d($file->openFile('r'));
        
        // dd(directory_map('manga'));
        // d(bin2hex($file->openFile('r')));
        if($this->session->get('isEdit') == 1){
            if($coverImage->getName()!="")
			{
				$newName = $coverImage->getRandomName();
				// dd($chapters);
				// dd(json_encode($genres));
				$coverImage->move(ROOTPATH.'public\img',$newName);
			}
            $data = [
                'nama' => $judul,
                'harga' => $harga,
                'genre' => $genres,
                'deskripsi' => $deskripsi,
                'visited' => $manga['visited'],
                'coverImage' => $newName
            ];
            // dd($model);
            $model->update($id,$data);
            return redirect()->to(base_url('admin'));
        }
	}
}

