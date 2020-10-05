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
                            <div class="col-md-6 col-lg-6 col-xlg-6">
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
                                        <h6 class="text-white">Total de acionamentos</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xlg-6">
                                <div class="card">
                                    <div class="box bg-info text-center">
                                        <h1 class="font-light text-white"><?= $device_info->tags->deviceFrequency == NULL? "0": $device_info->tags->deviceFrequency ;?> <i style="font-size: 12px;">ms</i></h1>
                                        <h6 class="text-white">Tempo de resposta</h6>
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
                            <b>Status:</b> <?php echo $device_info->connectionState == "Disconnected"? "<i style='color:#f45f5f'>Desconectado</i>" : "<i style='color:#22cc77'>Conectado</i>"; ?><br /><br />
                            <b>Criado em:</b>
                            <?php echo date('d/m/Y H:m:s', strtotime($device_info->tags->created)); ?><br /><br />
                            <b>Última atividade em:</b>
                            <?php echo date('d/m/Y H:m:s', strtotime($device_info->lastActivityTime)); ?><br /><br />
                        </div>

                        <a class="btn btn-primary" href="#" onclick="window.location.reload()">Atualizar</a>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Logs</h4>
                    </div>
                    <div class="card-body">
                        <div id="setLog" style="height:450px;overflow-y:scroll;"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>