<?php 
    $this->load->view('app/estrutura/header');

    echo "<title>".$title_page."</title><body class='skin-default-dark fixed-layout'>";

    $this->load->view('app/estrutura/preloader');

    echo "<div id='main-wrapper'>";

    $this->load->view('app/estrutura/menu_top');
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