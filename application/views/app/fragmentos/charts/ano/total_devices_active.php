<div class="card text-center">
    <div class="card-header">
        TOTAL DE DISPOSITIVOS AROMNI's
    </div>
    <div class="card-body">
        <h1 class="card-title text-success">
            <?php
                $i = 0;
                foreach($devices as $iot):
                    if($iot->status == "enabled"):
                        $i++;
                    endif;
                endforeach;
                echo $i;
            ?>
        </h1>
        <p class="card-text">Em 1 de 4 lojas</p>
    </div>
</div>