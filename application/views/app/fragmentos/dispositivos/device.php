<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dispositivo - <?php echo $device_info->tags->deviceName; ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dispositivos</a></li>
                        <li class="breadcrumb-item active"><?php echo $device_info->tags->deviceName; ?></li>
                    </ol>
                    <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $device_info->tags->deviceName; ?></h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xlg-12">
                                <div class="card">
                                    <div class="box bg-primary text-center">
                                        <h1 class="font-light text-white"><?php 
                                        $i = 0; 
                                        if($device_query):
                                            foreach($device_query as $query):
                                                if($query->heartbeat == FALSE):
                                                $i++;
                                                endif;
                                            endforeach;
                                        endif; echo $i;
                                        ?></h1>
                                        <h6 class="text-white">Acionamentos hoje</h6>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <style>
                        .desc b {
                            font-weight: bold;
                        }
                        </style>

                        <div class="card-text desc">
                            <b>ID do dispositivo:</b> <?php echo $device_info->deviceId; ?><br /><br />
                            <b>Organização do dispositivo:</b> <?php echo $device_info->tags->tenantId; ?><br /><br />
                            <b>Status:</b> <?php echo $device_info->connectionState; ?><br /><br />
                            <b>Criado em:</b>
                            <?php echo date('d/m/Y H:m:s', strtotime($device_info->tags->created)); ?><br /><br />
                            <b>Última atividade em:</b>
                            <?php echo date('d/m/Y H:m:s', strtotime($device_info->lastActivityTime)); ?><br /><br />
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Logs</h4>
                    </div>
                    <div class="card-body">
                        <div style="height:450px;overflow-y:scroll;">
                            <?php 
                            $date = new DateTime();

                            if($device_query):
                                foreach($device_query as $query): 
                                    if($query->heartbeat):
                                        echo "Modo Automatico acionado em ".date('d/m/Y H:m:s', $query->datetime)."<br />";
                                    else:
                                        echo "<b style='color:#7dc667'>Sensor heartbeat acionado em ".date('d/m/Y H:m:s', $query->datetime)."</b><br />";
                                    endif;
                                endforeach;
                            else:
                                $msg = "Não foi encontrado nenhum log para este dispositivo!";
                                echo $msg;
                            endif;
                            ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>