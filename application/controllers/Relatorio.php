<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends MY_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', '', true);
    }

	public function index()
	{
        // Definições de permissao ACL
        executarPermissaoCliente();

        $data['title_page'] = "Aromni - Relatórios";

        // Busca no DB os dados do usuário logado na sessão
        $data['usuario'] = $this->dadosConta();

        $dadosRelatorio = $this->login_model->ver('relatorios');
        if($dadosRelatorio){
            foreach($dadosRelatorio as $dados):
                $device_query = $this->Eugenio_DataQuery_Return($dados->deviceID, 'aromni_schema');
                if($device_query):
                    $i = 1;
                    foreach($device_query as $query): 
                        if(!$query->heartbeat):
                            $ativacoes[] = $i++;
                        endif;
                    endforeach;
                else:
                    $ativacoes[] = 0;
                endif;

                $relatorio[] = array(
                    "deviceID" => $dados->deviceID,
                    "Essencias" => $dados->Essencias,
                    "Loja" => $dados->Loja,
                    "Regiao" => $dados->Regiao,
                    "Ativacoes" => $ativacoes,
                    "lastUpdate" => @date('d/m/Y H:m:s', strtotime($this->Eugenio_Things_ID_Return($dados->deviceID)->lastActivityTime))
                );
            endforeach;

            $data['relatorio'] = $relatorio;

        }else{
            $data['relatorio'] = False;
        }

        $this->load->view('app/paginas/relatorio', $data);
    }
}