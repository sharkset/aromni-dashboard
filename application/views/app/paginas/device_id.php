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
   setTime();
   function setTime() {
      var string = "<?php 
            if($device_query):
                foreach($device_query as $query): 
                    if($query->heartbeat):
                        echo "Modo Automatico acionado em ".date('l dS \o\f F Y h:i:s A', $query->datetime)."<br />";
                    else:
                        echo "<b style='color:#7dc667'>Sensor heartbeat acionado em ".date('l dS \o\f F Y h:i:s A', $query->datetime)."</b><br />";
                    endif;
                endforeach;
            else:
                $msg = "Não foi encontrado nenhum log para este dispositivo!";
                echo $msg;
            endif;
        ?>";
      setTimeout(setTime, 3000);
      $('#setLog').html(string);
   }
 });
</script>
</body>
</html>