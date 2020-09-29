<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$dados['title_page'] = "Aroma Spot - Login";
		$this->load->view('app/paginas/login', $dados);
	}
}
