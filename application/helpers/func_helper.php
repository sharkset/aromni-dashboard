<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
 */

defined('BASEPATH') or exit('No direct script access allowed');

// Verifica se esta logado e as permissoes Master
function executarPermissaoMaster()
{
    $ci = &get_instance();
    $ci->load->model('Login_model');

    if ($ci->session->userdata('expirado')) {
        $ci->session->sess_destroy();
        redirect('login');
    }

    if ((!session_id()) || (!$ci->session->userdata('logado'))) {
        redirect('login');
    }

    if ($ci->session->userdata('permissao') > 3 or $ci->session->userdata('permissao') < 2) {
        $ci->session->set_flashdata('warning', 'Você não tem permissão para acessar essa página!');
        redirect(base_url('dashboard'));
    }
}

// Verifica se esta logado e as permissoes Master
function executarPermissaoCliente()
{
    $ci = &get_instance();
    $ci->load->model('Login_model');

    if ($ci->session->userdata('expirado')) {
        $ci->session->sess_destroy();
        redirect('login');
    }

    if ((!session_id()) || (!$ci->session->userdata('logado'))) {
        $ci->session->set_flashdata('warning', 'Você não pode acessar a aplicação!');
        redirect('login');
    }
}

// log info
function log_info($task)
{
    date_default_timezone_set('America/Sao_Paulo');
    
    $ci = &get_instance();
    $ci->load->model('Func_model');

    $data = array(
        'usuario' => $ci->session->userdata('nome'),
        'ip' => $ci->input->ip_address(),
        'tarefa' => $task,
        'data' => date('Y-m-d'),
        'hora' => date('H:i:s'),
    );

    $ci->Func_model->add($data);
}
// Abrevia o nome completo
function reduzirNome($texto, $tamanho)
{
    // Se o nome for maior que o permitido
    if (strlen($texto) > ($tamanho - 2)) {
        $texto = strip_tags($texto);

        // Pego o primeiro nome
        $palavas = explode(' ', $texto);
        $nome = $palavas[0];

        // Pego o ultimo nome
        $palavas = explode(' ', $texto);
        $sobrenome = trim($palavas[count($palavas) - 1]);

        // Vejo qual e a posicao do ultimo nome
        $ult_posicao = count($palavas) - 1;

        // Crio uma variavel para receber os nomes do meio abreviados
        $meio = '';

        // Listo todos os nomes do meios e abrevio eles
        for ($a = 1; $a < $ult_posicao; $a++) :

            // Enquanto o tamanho do nome nao atingir o limite de caracteres
            // completo com o nomes do meio abreviado
        if (strlen($nome . ' ' . $meio . ' ' . $sobrenome) <= $tamanho) :
            $meio .= ' ' . strtoupper(substr($palavas[$a], 0, 1));
        endif;
        endfor;

    } else {
        $nome = $texto;
        $meio = '';
        $sobrenome = '';
    }

    return trim($nome . $meio . ' ' . $sobrenome);
}

if(!function_exists('set_msg')):
    //Seta uma mensagem via session para ser lida
    function set_msg($msg=NULL){
        $ci = & get_instance();
        $ci->session->set_userdata('aviso', $msg);
    }
endif;

if(!function_exists('get_msg')):
    //Retorna a mensagem recebida pela funcao set_msg
    function get_msg($destroy=TRUE){
        $ci = & get_instance();
        $retorno = $ci->session->userdata('aviso'); // Ler alguma coisa na session
        if($destroy) $ci->session->unset_userdata('aviso'); // Gravar alguma coisa na session
        return $retorno;
    }
endif;

if (!function_exists('formata_preco')):
    function formata_preco($valor){

        $negativo = false;
        $preco = "";
        $valor = intval(trim($valor));

        if ($valor < 0):
            $negativo = true;
            $valor = abs($valor);
        endif;

        $valor = strrev($valor);
        while (strlen($valor) < 3) {
            $valor .= "0";
        }
        for ($i = 0; $i < strlen($valor); $i++) {
            if ($i == 2) :
                $preco .= ",";
            endif;
            if (($i <> 2) AND (($i+1)%3 == 0)):
                $preco .= ".";
            endif;
            $preco .= substr($valor, $i , 1);
        }

        $preco = strrev($preco);

        return ($negativo ? "-" : "") . $preco;
    }
endif;

if (!function_exists('formata_precoB')):
    function formata_precoB($valor){

        $negativo = false;
        $preco = "";
        $valor = intval(trim($valor));

        if ($valor < 0):
            $negativo = true;
            $valor = abs($valor);
        endif;

        $valor = strrev($valor);
        while (strlen($valor) < 3) {
            $valor .= "0";
        }
        for ($i = 0; $i < strlen($valor); $i++) {
            if ($i == 2) :
                $preco .= ".";
            endif;
            $preco .= substr($valor, $i , 1);
        }

        $preco = strrev($preco);

        return ($negativo ? "-" : "") . $preco;
    }
endif;

// Converter formato da data
function converteData($data)
{
    $data_convert = str_replace("/", "-", $data);
    return date('d/m/Y', strtotime($data_convert));
}

// Converter formato da data
function converteDataBanco($data)
{
    $data_convert = str_replace("/", "-", $data);
    return date('Y-m-d', strtotime($data_convert));
}

// Formata numero de telefone
function formataTelefone($numero)
{
    if(strlen($numero) == 10){
        $novo = substr_replace($numero, '(', 0, 0);
        $novo = substr_replace($novo, '9', 3, 0);
        $novo = substr_replace($novo, ')', 3, 0);
    }else{
        $novo = substr_replace($numero, '(', 0, 2);
        $novo = substr_replace($novo, ')', 3, 0);
        $novo = substr_replace($novo, '-', 9, 0);
        $novo = substr_replace($novo, ' ', 4, 0);
    }
    return $novo;
}

// Remove formatação de numeros
function removeformatacao($valor) 
{
    $valor2 = str_replace('.','',$valor);
    $valor3 = str_replace(',','',$valor2);

    return $valor3;
}

function formatarHora($hora) {
    $string = explode(":", $hora);
    switch($string[1]) {
        case "00":
            $string[1] = "";
            $molde = "{$string[0]}h";
            return $molde;
        break;
        default:
            $molde = "{$string[0]}h$string[1]min";
            return $molde;
        break;
    }
}

function verificaFoto($link)
{
    if($link){
        return $link;
    }else{
        return $link = base_url('template/assets/images/users/default.png');
    }
}