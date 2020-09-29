<?php
    // CONTEUDO DA PAGINA
    $data['$title'] = $title_page;
    echo $this->load->view('app/fragmentos/login/index', $title);

    // RODAPE DA PRINCIPAL
    //echo $this->load->view('app/estrutura/footer'); 
?>