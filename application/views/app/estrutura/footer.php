        <footer class="footer">
            © 2020 Aromni - Todos direitos reservados.
        </footer>
    </div>
    <script src="<?= base_url('template/assets/node_modules/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?= base_url('template/assets/node_modules/popper/popper.min.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url('template/dist/js/perfect-scrollbar.jquery.min.js'); ?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('template/dist/js/waves.js'); ?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url('template/dist/js/sidebarmenu.js'); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('template/dist/js/custom.min.js'); ?>"></script>
    <!-- Flot Charts JavaScript -->
    <script src="<?= base_url('template/assets/node_modules/flot/jquery.flot.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/flot.tooltip/js/jquery.flot.tooltip.min.js'); ?>"></script>
    <!--sparkline JavaScript -->
    <script src="<?= base_url('template/assets/node_modules/sparkline/jquery.sparkline.min.js'); ?>"></script>
    <!-- EASY PIE CHART JS -->
    <script src="<?= base_url('template/assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js'); ?>"></script>
    <!-- Vector map JavaScript -->
    <script src="<?= base_url('template/assets/node_modules/vectormap/jquery-jvectormap-2.0.2.min.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/vectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
    <!-- Chart JS -->
    <script src="<?= base_url('template/dist/js/app.js'); ?>"></script>
    <script src="<?= base_url('template/dist/js/dashboard2.js'); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('template/dist/js/custom.min.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/toast-master/js/jquery.toast.js'); ?>"></script>
    <!-- Alerta de callback do sistema -->
    <?php if ($this->session->flashdata('info') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Info',
                    text: '<?php echo $this->session->flashdata('info')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'info',
                    hideAfter: 3000, 
                    stack: 6
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Ops, algo deu errado',
                    text: '<?php echo $this->session->flashdata('error')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500
                    
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('warning') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Cuidado',
                    text: '<?php echo $this->session->flashdata('warning')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'warning',
                    hideAfter: 3500, 
                    stack: 6
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Processado corretamente',
                    text: '<?php echo $this->session->flashdata('success')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            });
        </script>
    <?php endif; ?>
</body>

</html>