<?= $this->load->view('app/estrutura/header'); ?>
<title><?= $title_page; ?></title>
</head>
<body class="skin-default-dark fixed-layout">
<?php
    // CONTEUDO DA PAGINA
    echo $this->load->view('app/fragmentos/login/index');

    // RODAPE DA PRINCIPAL
    //echo $this->load->view('app/estrutura/footer'); 
?>