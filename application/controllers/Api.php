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

    private function Eugenio_API_Config($parr)
    {
        $ApiKey = "1J0Uip9R4agRfEg0SZjAGV1VXVsNzpW6";
        $url = "https://portal.stg.eugenio.io/api/v1/";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $resultado = json_decode(curl_exec($ch));

    }

    public function Eugenio_Devices_Return()
    {
        $local_lib = "apis/dataquery";
    }
}