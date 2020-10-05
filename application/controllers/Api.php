<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

class Api extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // Carregando MODEL de acesso ao banco de dados do sistema
        $this->load->model('login_model', '', true);
        $this->load->model('upload_model', '', true);
        $this->load->library('upload');
    }

    public function api_things($id = null)
    {
        // Definições de permissao ACL
        executarPermissaoCliente();

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        if(!$id == NULL):
            $device_query = $this->Eugenio_DataQuery_Return($id, 'aromni_schema');
            if($device_query):
                foreach($device_query as $query): 
                    if($query->heartbeat):
                        echo "Modo Automatico acionado em ".date('d-m-Y H:i:s', $query->datetime)."<br />";
                    else:
                        echo "<b style='color:#7dc667'>Sensor heartbeat acionado em ".date('d-m-Y H:i:s', $query->datetime)."</b><br />";
                    endif;
                endforeach;
            else:
                $msg = "Não foi encontrado nenhum log para este dispositivo!";
                echo $msg;
            endif;
        else:
            return false;
        endif;

    }

    public function dispositivos()
    {
        // Definições de permissao ACL
        executarPermissaoCliente();

        // Dados da conta
        $data['usuario'] = $this->dadosConta();

        //Titulo da pagina
        $data['title_page'] = "Aromni - Dispositivos";

        if($this->Eugenio_Things_Return() == array("message" => "Forbidden")):
            $msg = array('result' => false, 'message' => 'Nenhum dispositivo foi encontrado ou retornou 403 Forbidden');
            $this->session->set_flashdata('error', $msg);
            redirect('dashboard');
        else:
            $data['devices'] = $this->Eugenio_Things_Return();
        endif;

        $this->load->view('app/paginas/dispositivos', $data);
    }

    public function device_id($id = NULL)
    { 
        // Definições de permissao ACL
        executarPermissaoCliente();

        // Dados da conta
        $data['usuario'] = $this->dadosConta();

        $data['title_page'] = "Aromni - Dispositivos";

        $data['device_info'] = $this->Eugenio_Things_ID_Return($id);

        if($this->Eugenio_DataQuery_Return($id, 'aromni_schema')){
            $data['device_query'] = $this->Eugenio_DataQuery_Return($id, 'aromni_schema');
        }else{
            $msg = array("result" => false, "message" => "Nenhum histórico foi encontrado.");
            $this->session->set_flashdata('warning', $msg);
            $data['device_query'] = false;
        }

        $this->load->view('app/paginas/device_id', $data);
    }

    public function invoke_id($id = NULL)
    {
        // Definições de permissao ACL
        executarPermissaoCliente();

        print_r($this->Eugenio_ThingsInvoke_ID_Return($id));
    }
    
}