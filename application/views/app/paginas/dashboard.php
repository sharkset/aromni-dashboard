<?php 
    $this->load->view('app/estrutura/header');

    echo "<title>".$title_page."</title><body class='skin-default-dark fixed-layout'>";

    $this->load->view('app/estrutura/preloader');

    echo "<div id='main-wrapper'>";
?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url('dashboard'); ?>">
                <img width="190px" src="<?= base_url('template/assets/images/logo.png'); ?>" alt="Aromni" class="light-logo" />
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
            </ul>
            <b class="text-danger">MODO SIMULADO ATIVO</b>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item right-side-toggle"> 
                    <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                        <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                    </a>
                </li>
            </ul>
            
        </div>
    </nav>
</header>
<?php
    $this->load->view('app/estrutura/menu_lateral');

    // CONTEUDO
    $this->load->view('app/fragmentos/dashboard/content');

    // FOOTER
    $this->load->view('app/estrutura/footer');
?>
<script src="<?= base_url('template/assets/node_modules/chartist-js/dist/chartist.min.js'); ?>"></script>
<script src="<?= base_url('template/assets/node_modules/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js'); ?>"></script>
<script src="<?= base_url('template/assets/node_modules/sparkline/jquery.sparkline.min.js'); ?>"></script>
<!-- Chart JS -->
<script src="<?= base_url('template/assets/node_modules/echarts/echarts-all.js'); ?>"></script>
<!-- Flot Charts JavaScript -->
<script src="<?= base_url('template/assets/node_modules/flot/excanvas.js'); ?>"></script>
<script src="<?= base_url('template/assets/node_modules/flot/jquery.flot.js'); ?>"></script>
<script src="<?= base_url('template/assets/node_modules/flot/jquery.flot.time.js'); ?>"></script>
<script src="<?= base_url('template/assets/node_modules/flot.tooltip/js/jquery.flot.tooltip.min.js'); ?>"></script>
<?php $this->load->view('app/fragmentos/charts/semana/js'); ?>
<?php $this->load->view('app/fragmentos/charts/mes/js'); ?>
<?php $this->load->view('app/fragmentos/charts/ano/js'); ?>
</body>
</html>