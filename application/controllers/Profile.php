<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', '', true);
    }

	public function index()
	{
        // Definições de permissao ACL
        executarPermissaoCliente();

        $data['title_page'] = "Aromni - Perfil";

        // Busca no DB os dados do usuário logado na sessão
        $query_data = $this->login_model->getById($this->session->userdata('id'));
        $data['usuario'] = array(
            'nome_conta' => reduzirNome($query_data->nome_pessoas, 15),
            'nome_completo' => $query_data->nome_pessoas,
            'foto' => verificaFoto($query_data->foto_pessoas),
            'expiracao_conta' => $query_data->dataExpiracao,
            'email' => $query_data->email,
            'data_cadastro' => $query_data->dataCadastro,
            'genero' => $query_data->sexo_pessoas,
            'nascimento' => $query_data->nascimento_pessoas,
            'cidade' => $query_data->cidade_pessoas,
            'estado' => $query_data->estado_pessoas,
            'celular' => $query_data->celular_pessoas,
        );

        $this->load->view('app/paginas/profile', $data);
    }

    public function updatePerfil()
    {
        // Definições de permissao ACL
        executarPermissaoCliente();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome_completo', 'Nome completo', 'required|trim');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|trim');
        $this->form_validation->set_rules('celular', 'Numero Celular', 'required|trim');
        $this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required|trim');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim');
        if ($this->form_validation->run() == false) {
            set_msg(validation_errors());
            redirect(base_url() . 'cwg/perfil');
        } else {
            $dados = array(
                'nome_pessoas' => $this->input->post('nome_completo'),
                'sexo_pessoas' => $this->input->post('sexo'),
                'celular_pessoas' => $this->input->post('celular'),
                'nascimento_pessoas' => $this->input->post('data_nascimento'),
                'estado_pessoas' => $this->input->post('estado'),
                'cidade_pessoas' => $this->input->post('cidade'),
            );

            $retorno = $this->login_model->edit('pessoas', $dados, 'usuarios_id', $this->session->userdata('id'));

            if ($retorno) {
                $msg = array('result' => false, 'message' => 'Perfil atualizado com sucesso!');
                $this->session->set_flashdata('success', $msg);
                log_info('Atualizou perfil de usuário.');
                redirect(base_url() . 'profile');
            } else {
                $msg = array('result' => false, 'message' => 'Ocorreu um erro ao tentar atualizar seu perfil, tente mais tarde...');
                $this->session->set_flashdata('error', $msg);
                redirect(base_url() . 'profile');
            }
        }
    }

    public function alterarSenha()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password_antigo', 'Senha antiga', 'required|min_length[7]', array('required' => 'Você deve preencher a %s.'));
        $this->form_validation->set_rules('password', 'Nova senha', 'required|min_length[7]', array('required' => 'Você deve preencher a %s.'));
        $this->form_validation->set_rules('senhaconf', 'Confirmação da nova senha', 'required|matches[password]');
        if ($this->form_validation->run() == false) {
            set_msg(validation_errors());
            redirect(base_url() . 'profile');
        } else {
            // Busca no DB os dados do usuário logado na sessão
            $user = $this->login_model->check_credentials($this->session->userdata('email'));
            $password = $this->input->post('password_antigo');
            if (password_verify($password, $user->senha)) {

                $dados = array(
                    'idUsuarios' => $this->session->userdata('id'),
                    'senha' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                );

                $retorno = $this->login_model->alterarSenha($dados);
            } else {
                $msg = array('result' => false, 'message' => 'A senha atual não confere!');
                $this->session->set_flashdata('error', $msg);
                redirect(base_url() . 'profile');
            }

            if ($retorno) {
                $msg = array('result' => false, 'message' => 'Sua senha foi atualizada com sucesso!');
                $this->session->set_flashdata('success', $msg);
                log_info('Alterou a senha de usuário.');
                redirect(base_url() . 'profile');
            } else {
                $msg = array('result' => false, 'message' => 'Ocorreu um erro ao tentar atualizar sua senha! tente mais tarde...');
                $this->session->set_flashdata('error', $msg);
                redirect(base_url() . 'profile');
            }
        }
    }
}