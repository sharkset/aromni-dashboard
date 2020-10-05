<?php 
    $this->load->view('app/estrutura/header');

    echo "<title>".$title_page."</title><body class='skin-default-dark fixed-layout'>";

    $this->load->view('app/estrutura/preloader');

    echo "<div id='main-wrapper'>";

    $this->load->view('app/estrutura/menu_top');
    $this->load->view('app/estrutura/menu_lateral');

    // CONTEUDO
    $this->load->view('app/fragmentos/dispositivos/device');

    // FOOTER
    $this->load->view('app/estrutura/footer');
?>
<script>
 $(function() {
    var spinner = '<div class="loader__figure"></div>';
    $('#setLog').html(spinner);
    setInterval(function(){ 
    $.ajax({
        type: 'GET',
        url: '<?= base_url()."api/api_things/".$device_info->deviceId; ?>',
        dataType: 'html',
        success: function (response) {
            $('#setLog').html(response);
        },
    })
}, 10000);
    
 });
</script>
</body>
</html>