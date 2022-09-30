<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\LoadManga;
use App\Models\LoadMangaChapters;
class Upload extends BaseController
{
    protected $session;

    public function __construct(){
        $this->session = session();
    }

	public function index(){
        if(!$this->session->get("loggedIn") || $this->session->get('data')['privilege'] != '3')
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $user = $this->session->get('data');
        $loadManga = new LoadManga();
        $mangas = $loadManga->findAll();
        // dd($manga);
        $this->session->set('isEdit',0);
        $data = 
        [
            'loggedin' => 1,
            'mangas' => $mangas,
            'tmpImg' => $user['profileImg'],
            'tmpName' =>  $user['username'],
            'tmpEmail' => $user['email'],
            'tmpPrivilege' => $user['privilege'],
            'text' => 'Upload',
            'judul' => '',
            'harga' => '',
            'genres' => '',
            'deskripsi' => '',
            'isEdit' => 'required'
        ];
        return view('Admin/upload',$data);
    }


    public function save(){
        helper(['form']);
        if(!$this->session->get("loggedIn") || $this->session->get('data')['privilege'] != '3'){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $model = new LoadManga();
        $model2 = new LoadMangaChapters();
        $jpg = 'ffd8';
        $png = '89504e470d0a1a0a';
        $png2 = '89504e470d0a';
        $zip = new \ZipArchive;
        $judul = $this->request->getVar('judul');
        $harga = $this->request->getVar('harga');
        $genres = json_encode(explode(',',$this->request->getVar('genres')));
        $deskripsi = $this->request->getVar('deskripsi');
		$file = $this->request->getFile('fileManga');
        $coverImage = $this->request->getFile('coverImage');
        // d($newName);
        // d($file->openFile('r'));
        
        // dd(directory_map('manga'));
        // d(bin2hex($file->openFile('r')));
        if($file != "" and $zip->open($file) and $this->session->get('isEdit') == 0){
            $chapters = [];
            $newName = $coverImage->getRandomName();
            for($i = 0;$i<$zip->numFiles;++$i){
                $dir = $zip->getNameIndex($i);
                $tempId = explode('/',$dir);
                $chapters[$tempId[0]] = intval($tempId[0]);
            }
            // dd($chapters);
            // dd(json_encode($genres));
            $coverImage->move(ROOTPATH.'public\img',$newName);
            $data = [
                'nama' => $judul,
                'harga' => $harga,
                'genre' => $genres,
                'deskripsi' => $deskripsi,
                'visited' => 0,
                'coverImage' => $newName
            ];
            // dd($model);
            $model->save($data);
            $mangaId = $model->getInsertID();
            d($model->getInsertID());
            foreach($chapters as $isi){
                $data = [
                    'mangaId' => $mangaId,
                    'chapters' => $isi,
                    'readCount' => 0
                ];
                $model2->save($data);
            }
            $zip->extractTo("manga/".$mangaId);
            return redirect()->to(base_url('admin'));
        }
    }
}

