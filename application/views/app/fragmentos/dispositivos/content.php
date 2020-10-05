<style>
.status{
    justify-content: space-between;
    padding:15px;
}
.status p {
    margin-left:10px;
}
.circle {
    margin-left: 10px;
    width:0.8rem;
    height: 0.8rem;
    border-radius: 50%;
    animation: crescendo 1s alternate infinite ease-in;
}

@keyframes crescendo {
    0%   {
        transform: scale(.8);
        opacity: 0.8;
    }
    100% {
        transform: scale(1.1);
        opacity: 1;
    }
}
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dispositivos</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dispositivos</li>
                    </ol>
                    <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
                </div>
            </div>
        </div>

        <div class="row">
            <?php 
                if($devices):
                foreach($devices as $iot): 
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $iot->tags->deviceName; ?></h4>
                        <p class="card-text"><b>Descrição:</b> <?= $iot->tags->deviceDescription; ?></p>
                        <p class="card-text"><b>Ultima atividade:</b> <?= date('d/m/Y H:i:s', strtotime($iot->lastActivityTime)); ?></p>
                        <?php if($iot->connectionState == "Disconnected"): ?>
                            <div class="status row">
                                <a href="<?= base_url('dispositivos/device_id/').$iot->deviceId; ?>" class="btn btn-primary">Detalhes</a>
                                <div class="stado row"><div style="background-color: red;" class="circle"></div> <p style="color:red">Desconectado</p></div>
                            </div> 
                        <?php else: ?>
                            <div class="status row">
                                <a href="<?= base_url('dispositivos/device_id/').$iot->deviceId; ?>" class="btn btn-primary">Detalhes</a>
                                <div class="stado row"><div style="background-color: #92C97A;" class="circle"></div> <p style="color: #92C97A;;">Conectado</p></div>
                            </div> 
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php 
                endforeach; 
                endif;
                ?>
        </div>

    </div>
</div>