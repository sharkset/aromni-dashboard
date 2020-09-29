<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$dados['title_page'] = "Aroma Spot - Login";

		$this->load->view('app/paginas/login', $dados);
	}
}
