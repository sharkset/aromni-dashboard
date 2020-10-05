<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', '', true);
    }

	public function index()
	{
        // Definições de permissao ACL
        executarPermissaoCliente();

        $data['title_page'] = "Aromni - Dashboard (dados simulados)";

        $data['usuario'] = $this->dadosConta();

        $data['devices'] = $this->Eugenio_Things_Return();

        $this->load->view('app/paginas/dashboard', $data);
    }
}