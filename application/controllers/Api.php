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

    public function teste()
    {
        $this->load->view('app/estrutura/request');
    }

    private function Eugenio_Credenciais()
    {
        $api = array(
            'apikey: 1J0Uip9R4agRfEg0SZjAGV1VXVsNzpW6', //Key da API do Eugenio
            'Content-Type: application/json',
        );

        return $api;
    }

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
        if(!$resultado){die("A conexão falhou");}
        curl_close($curl);

        return $resultado;
    }

    public function Eugenio_Devices_Return()
    {
        $api = $this->Eugenio_Credenciais();
        $device_id = "639d1942-6dab-45f1-aede-a3ac6d91a83e";
        $endpoint = 'things/'.$device_id.'/invoke';
        $url = "https://portal.stg.eugenio.io/api/v1/" . $endpoint;
        $data = [];

        echo "<pre>".print_r($this->Eugenio_Connect("GET", $url, $data, $api))."</pre>";
    }
}