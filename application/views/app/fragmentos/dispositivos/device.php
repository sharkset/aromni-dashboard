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
        <?php
            if($msg = get_msg()):
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'.$msg.
                '</div>';
            endif; 
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $device_info->tags->deviceName; ?></h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xlg-4">
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

                            <div class="col-md-4 col-lg-4 col-xlg-4">
                                <div class="card">
                                    <div class="box bg-success text-center">
                                        <h1 class="font-light text-white"><?php 
                                        $i = 0; 
                                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                        date_default_timezone_set('America/Sao_Paulo');
                                        if($device_query):
                                            foreach($device_query as $query):
                                                if($query->heartbeat == FALSE AND date('d-m-Y', $query->datetime) == date('d-m-Y', strtotime('today'))):
                                                $i++;
                                                endif;
                                            endforeach;
                                        endif; echo $i;
                                        ?></h1>
                                        <h6 class="text-white">Acionamentos hoje</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xlg-4">
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
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cadastrarBanco">Cadastrar nos relatórios</button>
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

<!-- MODAL -->
<div class="modal" id="cadastrarBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style=" background:#3c4452">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Cadastrar dispositivo nos relatórios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
                <form action="<?= base_url('api/cadastarDeviceDB'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deviceid" class="control-label">DeviceID:</label>
                            <input value="<?= $device_info->deviceId; ?>" disabled type="text" class="form-control" id="deviceid">
                            <input value="<?= $device_info->deviceId; ?>" type="hidden" class="form-control" name="deviceid">
                        </div>
                        <div class="form-group">
                            <label for="loja" class="control-label">Loja:</label>
                            <input type="text" class="form-control" id="loja" name="loja" required>
                        </div>
                        <div class="form-group">
                            <label for="essencia" class="control-label">Essência (Produto):</label>
                            <input type="text" class="form-control" id="essencia" name="essencia" required>
                        </div>
                        <div class="form-group">
                            <label for="regiao" class="control-label">Região:</label>
                            <input type="text" class="form-control" id="regiao" name="regiao" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
        </div>
    </div>
</div>