<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Carregando MODEL de acesso ao banco de dados do sistema
        $this->load->model('login_model', '', true);
        $this->load->model('upload_model', '', true);
        $this->load->library('upload');
    }
    protected function dadosConta()
    {
        // Busca no DB os dados do usuário logado na sessão
        $query_data = $this->login_model->getById($this->session->userdata('id'));
        $data = array(
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

        return $data;
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
        print_r($this->Eugenio_ThingsInvoke_ID_Return($id));
    }

    // Credenciais da Application criada no Eugenio.io
    private function Eugenio_Credenciais()
    {
        $api = array(
            'apikey: 1J0Uip9R4agRfEg0SZjAGV1VXVsNzpW6', //Key da API do Eugenio
            //'X-Tenant: tenant1600910450731',
            'Content-Type: application/json',
        );

        return $api;
    }

    // Endpoint do Eugenio.io
    private function Eugenio_Endpoint_URL($slug)
    {
        $url = "https://portal.stg.eugenio.io/api/v1/" . $slug; // Endereço da API
        return $url;
    }

    // Conecta com o Eugenio.io API
    private function Eugenio_Connect($metodo, $url, $data, $api){
        $curl = curl_init();
        switch ($metodo){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPÇÕES:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUÇÃO:
        $resultado = curl_exec($curl);
        if(!$resultado){
            return false;
        }
        curl_close($curl);

        return json_decode($resultado);
    }

    // Funções de retorno
    // Lista os dispositivos
    protected function Eugenio_Devices_Return()
    {
        $api = $this->Eugenio_Credenciais();
        $url = $this->Eugenio_Endpoint_URL("devices");
        $data = [];

        return $this->Eugenio_Connect("GET", $url, $data, $api);
    }

    // Lista os dispositivos com metadados
    protected function Eugenio_Things_Return()
    {
        $api = $this->Eugenio_Credenciais();
        $url = $this->Eugenio_Endpoint_URL("things");
        $data = [
            "limit" => 100,
            "offset" => 0
        ];

        return $this->Eugenio_Connect("GET", $url, $data, $api);
    }

    // Lista o dispositivo especifico
    protected function Eugenio_Things_ID_Return($device_id)
    {
        $api = $this->Eugenio_Credenciais();
        $endpoint = 'things/'.$device_id;
        $url = $this->Eugenio_Endpoint_URL($endpoint);
        $data = [];

        return $this->Eugenio_Connect("GET", $url, $data, $api);
    }

    // Executa comando POST invoke
    protected function Eugenio_ThingsInvoke_ID_Return($device_id)
    {
        $api = $this->Eugenio_Credenciais();
        $endpoint = 'things/'.$device_id.'/invoke';
        $url = $this->Eugenio_Endpoint_URL($endpoint);
        $data = array(
            'method: ping',
            'timeout: 10'
        );

        return $this->Eugenio_Connect("POST", $url, $data, $api);
    }

    // Executa comando POST invoke
    protected function Eugenio_DataQuery_Return($device_id, $schema)
    {
        $api = $this->Eugenio_Credenciais();
        $query = "SELECT * FROM ".$schema." WHERE deviceid = '".$device_id."' ORDER BY _eugenio_created_at DESC";
        $endpoint = 'data/query';
        $url = $this->Eugenio_Endpoint_URL($endpoint);
        $data = [
            "sql" => $query
        ];

        return $this->Eugenio_Connect("GET", $url, $data, $api);
    }
}