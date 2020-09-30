<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', '', true);
    }

	public function index()
	{
		// Verifica se o usuário esta logado
        if ((!session_id()) || ($this->session->userdata('logado'))) {
            redirect('dashboard');
		}
		
		$dados['title_page'] = "AromaSpot - Login";

		$this->load->view('app/paginas/login', $dados);
	}

	// Função de sair
    public function sair()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }

    // Verificação de login
    public function verificarLogin()
    {
        if(!$this->session->userdata('current_page') == NULL){
            $url_referencia = $this->session->userdata('current_page');
        }else{
            $url_referencia = 'dashboard';
        }

        header('Access-Control-Allow-Origin: ' . base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
        if ($this->form_validation->run() == false) {
            set_msg(validation_errors());
            redirect(base_url() . 'login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $user = $this->login_model->check_credentials($email);

            if ($user) {
                // Verificar se acesso está expirado
                if ($this->chk_date($user->dataExpiracao)) {
                    $msg = array('result' => false, 'message' => "Ahh, que pena sua conta expirou, contate nossa equipe :(");
                    $this->session->set_flashdata('warning', $msg);
                    redirect(base_url() . 'login');
                    die();
                }

                if (password_verify($password, $user->senha)) {
                    $session_data = array('nome' => $user->nome_pessoas, 'email' => $user->email, 'id' => $user->idUsuarios, 'permissao' => $user->permissoes, 'logado' => true);
                    $this->session->set_userdata($session_data);
                    log_info('Efetuou login no sistema');
                    $msg = array('result' => false, 'message' => "Aproveite a experiência =)");
                    $this->session->set_flashdata('success', $msg);
                    redirect(base_url() . $url_referencia);
                    //echo json_encode($json);
                } else {
                    $msg = array('result' => false, 'message' => "Os dados de acesso estão incorretos.");
                    //echo json_encode($json);
                    $this->session->set_flashdata('error', $msg);
                    redirect(base_url() . 'login');
                }
            } else {
                $msg = array('result' => false, 'message' => "Sua conta foi bloqueada ou suas credenciais estão incorretas.");
                //echo json_encode($json);
                $this->session->set_flashdata('error', $msg);
                redirect(base_url() . 'login');
            }
        }
        die();
    }

    // Busca a data do sistema no banco de dados
    private function chk_date($data_banco)
    {
        $data_banco = new DateTime($data_banco);
        $data_hoje = new DateTime("now");

        return $data_banco < $data_hoje;
    }

    public function alterarMinhasenha($hash)
    {
        // Verifica se o usuário esta logado
        if ((!session_id()) || ($this->session->userdata('logado'))) {
            redirect('dashboard');
        }

        //Verificação no banco de dados se existe o hash do email, se existir muda o status para desativado e permite alteração de senha
        $verifica_hash = $this->login_model->check_hash($hash);

        if($verifica_hash){
            $data['title_page'] = "AromaSpot - Alterar Senha";
            $data['hash'] = $hash;
            $this->load->view('app/paginas/trocar_minha_senha', $data);
        }else{
            $json = array('result' => 'true', 'message' => 'Ocorreu um erro ao tentar acessar esta página.');
            $this->session->set_flashdata('error', $json);
            redirect(base_url() . 'login');
        }
    }

    public function alterarNovaSenha()
    {
        $hash = $this->input->post('hash');
        $verifica_hash = $this->login_model->check_hash($hash);
        if($verifica_hash){
            $verificado_email = $verifica_hash->email_recuperacao;
        }else{
            redirect('login', 'refresh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Senha', 'required|min_length[7]', array('required' => 'Você deve preencher a %s.'));
        $this->form_validation->set_rules('cpassword', 'Confirmação de Senha', 'required|matches[password]');
        if ($this->form_validation->run() == false) {
            $json = array('result' => false, 'message' => validation_errors());
            $this->session->set_flashdata('error', $json);
            redirect(base_url('login/alterarMinhasenha/') . $hash);
        } else {
            $dados = array(
                'senha' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            );

            $retorno = $this->login_model->edit('usuarios', $dados, 'email', $verificado_email);

            if ($retorno) {
                $muda_status = ['status_recuperacao' => '0'];
                $this->login_model->edit('recuperacao_senha', $muda_status, 'email_recuperacao', $verificado_email);
                $json = array('result' => 'true', 'message' => 'Senha alterada com sucesso!');
                $this->session->set_flashdata('success', $json);
                log_info('Usuario alterou a senha: '.$verificado_email);
                redirect(base_url() . 'login');
            } else {
                $json = array('result' => 'true', 'message' => 'Ocorreu um erro ao tentar alterar a senha.');
                $this->session->set_flashdata('error', $json);
                redirect(base_url() . 'login');
            }
        }
    }

    public function recoverPass()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');

        if ($this->form_validation->run() == false) {
            $json = array('result' => false, 'message' => validation_errors());
            $this->session->set_flashdata('error', $json);
            redirect(base_url() . 'login');
        } else {
            $email = $this->input->post('email');
            $user = $this->login_model->check_credentials($email);

            if($user){
                $retorno = $this->gereador_de_key($email);
                if($retorno){
                    $json = array('result' => 'true', 'message' => 'E-mail de recuperação enviado com sucesso.');
                    $this->session->set_flashdata('success', $json);
                    redirect('login');
                }else{
                    $json = array('result' => 'true', 'message' => 'Ocorreu um erro ao tentar recuperar senha!');
                    $this->session->set_flashdata('error', $json);
                    redirect('login');
                }
            }else{
                $json = array('result' => 'true', 'message' => 'Ocorreu um erro ao tentar recuperar senha, e-mail não encontrado!');
                $this->session->set_flashdata('error', $json);
                redirect('login');
            }

        }
    }

    private function email_recuperacao_senha($email, $hash)
    {
        try {
            $url = base_url('login/alterarMinhasenha/') . $hash;
            $this->email->set_mailtype("html");
            $this->email->from("sistema@syspro.club", 'AromaSpot - Sistema'); //De quem - Remetente
            $this->email->subject("Redefinição de senha - AromaSpot");
            $this->email->to($email); //Para quem - Destino
            //$this->email->bcc('sistema@syspro.club);
            $this->email->message("
            <html>
                <div style='background:#f5f5f5; height:100%; width:100%; padding-top:50px'>
                    <div style='width:640px; background-color: #fff; margin:50px
                            auto;border-radius:5px'>
                        <div style='width:100%;'>
                            <img style='width:180px;padding:30px; ' src='". base_url('template/assets/images/logo.png') ."' />
                        </div>
                        <div style='width:100%;margin:0px auto;color:#333; font-family:Roboto,Helvetica,Arial,sans-serif!important;padding:0;text-align:left;vertical-align:top'>
                            <div style='padding:50px;'>
                                <h1>Defina uma nova senha</h1>
                                <p style='font-size:18px;font-weight:400;line-height:28px;'>Recebemos uma solicitação para recuperar sua senha do AromaSpot. Para definir uma nova senha, basta clicar abaixo.</p>
                                <br />
                                <a href='". $url ."' style='background:#30419B;text-transform: uppercase; color: #f5f5f5; margin-top:30px;padding:20px;border-radius:5px; text-decoration: none; font-weight: bold;'>Definir nova senha</a>
                                <br /><br /><br />
                                <p style='font-size: 14px; color: #333;'>Se você não pediu para recuperar sua senha, ignore este e-mail.</p>
                                <br /><br /><br />
                                <hr />
                                <p style='font-size: 12px; color: #444;'>Se você tiver alguma dúvida, entre em contato conosco por meio do e-mail contato@geneuto.com</p>
                            </div>
                        </div>

                    </div>
                </div>

            </html>
        ");
            $this->email->send();
        } catch (Exception $e) {
            return false;
        }
    }

    private function gereador_de_key($email)
    {
        $hash = md5(rand());
        $dados =  array(
            'email_recuperacao' => $email,
            'hash_recuperacao' => $hash,
            'status_recuperacao' => 1 // Para ativado
        );

        $retorno = $this->login_model->add("recuperacao_senha", $dados);

        if(!$retorno){
            return false;
        }else{
            $valid = $this->email_recuperacao_senha($email, $hash);
            if($valid){
                return true;
            }else{
                return false;
            }
        }
    }
}
