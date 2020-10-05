<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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

        // Busca no DB os dados do usuário logado na sessão
        $query_data = $this->login_model->getById($this->session->userdata('id'));
        $data['usuario'] = array(
            'nome_conta' => reduzirNome($query_data->nome_pessoas, 15),
            'foto' => verificaFoto($query_data->foto_pessoas),
            'expiracao_conta' => $query_data->dataExpiracao,
            'data_cadastro' => $query_data->dataCadastro,
            'genero' => $query_data->sexo_pessoas,
            'nascimento' => $query_data->nascimento_pessoas,
            'cidade' => $query_data->cidade_pessoas,
            'estado' => $query_data->estado_pessoas,
        );

        $this->load->view('app/paginas/dashboard', $data);
    }
}