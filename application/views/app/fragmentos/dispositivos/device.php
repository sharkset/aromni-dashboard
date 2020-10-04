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
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $device_info->tags->deviceName; ?></h4>

                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xlg-2">
                                <div class="card">
                                    <div class="box bg-primary text-center">
                                        <h1 class="font-light text-white">Null</h1>
                                        <h6 class="text-white">Acionamentos hoje</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xlg-2">
                                <div class="card">
                                    <div class="box bg-cyan text-center">
                                        <h1 class="font-light text-white">Null ms</h1>
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
                            <b>Organização do dispositivo:</b> <?php echo $device_info->tags->tenantId; ?><br /><br />
                            <b>Criado em:</b> <?php echo date('d/m/Y H:m:s', strtotime($device_info->tags->created)); ?><br /><br />
                            <b>Última atividade em:</b> <?php echo date('d/m/Y H:m:s', strtotime($device_info->lastActivityTime)); ?><br /><br />
                            <b>ID do dispositivo:</b> <?php echo $device_info->deviceId; ?>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Logs</h4>
                        <?php var_dump($device_query); ?>
                    </div>

                        <a type="submit" href="<?= base_url('api/invoke/'.$device_info->deviceId); ?>" class="btn btn-primary">Ping</a>
                </div>
            </div>

        </div>

    </div>
</div>