<?php

namespace App\Controllers;

use App\Models\LoadManga;
use App\Models\LoadUserManga;
use Omnipay\Omnipay;
class Cart extends BaseController
{
	protected $session;
	protected $cart;
	protected $gateway;
	public function __construct(){
		$this->session = session();
		$this->cart = $this->session->get('cart');
	}
	public function index()
	{
		if(!$this->session->get("loggedIn"))
			return redirect()->to(base_url());

		$user = $this->session->get('data');
		// dd($userManga);
		// d($this->cart);
		// $user['visited']++;
		$data = 
		[
			'loggedin' => 1,
			'tmpImg' => $user['profileImg'],
			'tmpName' =>  $user['username'],
			'tmpEmail' => $user['email'],
			'tmpPrivilege' => $user['privilege'],
			'css' => 'cart.css',
			'cart' => $this->cart
		];
		echo view('layout/header',$data);
		echo view('Cart', $data);
	}

	public function addToCart($id){
		if(!$this->session->get("loggedIn"))
			return redirect()->to(base_url());
		$model = new LoadManga();
		$item = $model->where('id',$id)->first();
		// dd($item);
		if(array_key_exists($id,$this->cart)){
			$this->cart[$id]['qty']++;	
		}
		else{
			$added = [
				"barang" => $item,
				"qty" => 1,
				"harga" => $item['harga']
			];
			$this->cart[$id] = $added;
		}
		$this->session->set('cart',$this->cart);
		// dd($this->cart);

		return redirect()->to(base_url('cart'));
	}

	public function decreaseOrIncrease($id,$option){
		if(array_key_exists($id,$this->cart) && $option == 0){
			$this->cart[$id]['qty']--;
			if($this->cart[$id]['qty'] <= 0){
				unset($this->cart[$id]);
			}	
		}
		else if(array_key_exists($id,$this->cart) && $option == 1){
			$this->cart[$id]['qty']++;
		}
		$this->session->set('cart',$this->cart);
		// dd($this->cart);

		return redirect()->to(base_url('cart'));
	}
	public function payment(){
		require_once(ROOTPATH.'vendor/autoload.php');
		$this->gateway = OmniPay::create('PayPal_Express');

		$this->gateway->setUsername('sb-lt47096306004_api1.business.example.com');
		$this->gateway->setPassword("NBUBW4GV9K444Q3E");
		$this->gateway->setSignature("AvLKru-IORfyGYN5vT.FFrlUy1K4AaUJd-QY3EQ-Z0mNqjPYwTvVtbCq");
		$this->gateway->setTestMode(true);
		$total = 0;
		// dd($this->cart);
		foreach($this->cart as $isi){
			$total += $isi['harga'];
		}
		$params = array(
			'amount'=>$total,
			'currency'=>'USD',
			'description' =>'Pembelian Manga' ,
			'returnUrl'=>base_url('cart/save'),
			'cancelUrl'=>base_url('cart/cancel'),
			'notify_url' => "notify"
		);
		session()->set('params',$params);
		$transaction= $this->gateway->purchase($params);
		$response = $transaction->send();
		$data = $response->getData();

		if ($response->isSuccessful()) {
            print_r($response);
        } elseif ($response->isRedirect()) {
            $response->redirect();
        } else {
            echo $response->getMessage();
        }
	}

	public function save(){
		if(!$this->session->get('params'))
			return redirect()->to(base_url());
		$params = session()->get('params');
		// dd($params);
		$this->gateway = OmniPay::create('PayPal_Express');

		$this->gateway->setUsername('sb-lt47096306004_api1.business.example.com');
		$this->gateway->setPassword("NBUBW4GV9K444Q3E");
		$this->gateway->setSignature("AvLKru-IORfyGYN5vT.FFrlUy1K4AaUJd-QY3EQ-Z0mNqjPYwTvVtbCq");
		$this->gateway->setTestMode(true);
		$transaction = $this->gateway->completePurchase($params);
		$response = $transaction->send();
		if($response->isSuccessful()){
			$model = new LoadUserManga();
			$user = $this->session->get('data');
			// dd($this->cart);
			foreach($this->cart as $isi){
				$data = [
					"userId" => $user['id'],
					"mangaId" => $isi['barang']['id']
				];
				$model->save($data);
			}
			unset($this->cart);
			session()->set('cart',array());
			return redirect()->to(base_url('profile'));
		}
	}

	public function cancel(){

	}

	public function notify(){

	}
}
