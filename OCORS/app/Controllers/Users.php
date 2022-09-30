<?php

namespace App\Controllers;

class Users extends BaseController
{
	public function logout()
	{
		session()->destroy();
        return redirect()->to(base_url());
	}
}
