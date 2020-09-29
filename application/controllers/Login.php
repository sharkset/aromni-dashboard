<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Verifica se o usuário esta logado
		/*
        if ((!session_id()) || ($this->session->userdata('logado'))) {
            redirect('dashboard');
		}*/
		
		$dados['title_page'] = "Aroma Spot - Login";

		$this->load->view('app/paginas/login', $dados);
	}

	// Função de sair
    public function sair()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }
}
