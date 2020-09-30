<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Carregando MODEL de acesso ao banco de dados do sistema
        $this->load->model('login_model', '', true);
        $this->load->model('upload_model', '', true);
        $this->load->library('upload');
    }

    public function upload_files()
    {
        // Definições de permissao ACL
        executarPermissaoCliente();

        $this->load->library('upload');
        $this->load->library('image_lib');

        $directory = FCPATH . 'template' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('m-Y') . DIRECTORY_SEPARATOR . 'fotos-' . $this->session->userdata('id');

        // Verifica se o diretorio existe
        if (!is_dir($directory . DIRECTORY_SEPARATOR . 'thumbs')) {
            // cria um diretorio para as thumbs
            try {
                mkdir($directory . DIRECTORY_SEPARATOR . 'thumbs', 0777, true);
            } catch (Exception $e) {
                echo json_encode(['result' => false, 'mensagem' => $e->getMessage()]);
                die();
            }
        }

        $config['upload_path'] = $directory;
        $config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG';
        $config['max_size'] = '1024';
        $config['encrypt_name'] = TRUE;
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $userFoto = $this->upload->data();
            $url = base_url('template/uploads'. DIRECTORY_SEPARATOR . date('m-Y') . DIRECTORY_SEPARATOR . 'fotos-' . $this->session->userdata('id'));

            $dados = array(
                'usuarios_id' => $this->session->userdata('id'),
                'foto_pessoas' => $url . DIRECTORY_SEPARATOR . $userFoto['file_name'],
            );

            $this->upload_model->uploadFoto($dados);

            $msg = array('result' => false, 'message' => 'Sua foto de perfil foi alterada com sucesso!');
            $this->session->set_flashdata('success', $msg);
            redirect(base_url('profile'));
            
        } else {
            
            $msg = array('result' => false, 'message' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $msg);
            redirect(base_url('profile'));
        }
    }
}
