<?php 
    $this->load->view('app/estrutura/header');

    echo "<title>".$title_page."</title><body class='skin-default-dark fixed-layout'>";

    $this->load->view('app/estrutura/preloader');

    echo "<div id='main-wrapper'>";

    $this->load->view('app/estrutura/menu_top');
    $this->load->view('app/estrutura/menu_lateral');

    // CONTEUDO PROFILE
    $this->load->view('app/fragmentos/profile/content');

    // FOOTER
    $this->load->view('app/estrutura/footer');
?>