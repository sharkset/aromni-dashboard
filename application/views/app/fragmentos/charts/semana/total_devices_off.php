<div class="card text-center">
    <div class="card-header">
        AROMNI's <b class="text-danger">OFFLINE</b>
    </div>
    <div class="card-body">
        <h1 class="card-title text-danger">
            <?php
                $i = 0;
                foreach($devices as $iot):
                    if($iot->connectionState == "Disconnected"):
                        $i++;
                    endif;
                endforeach;
                echo $i;
            ?>
        </h1>
        <a href="<?= base_url('dispositivos'); ?>" class="btn btn-primary">Mais detalhes</a>
    </div>
</div>