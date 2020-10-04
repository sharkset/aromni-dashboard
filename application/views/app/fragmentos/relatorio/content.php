<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Relatórios</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Relatórios</li>
                    </ol>
                    <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Histórico dos dispositivos</h4>
                        <h6 class="card-subtitle">Exporte esse relatório para qualquer ferramenta.</h6>
                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Essências</th>
                                        <th>Ativações</th>
                                        <th>Loja</th>
                                        <th>Região</th>
                                        <th>Ultima ativação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($relatorio as $relatorios): ?>
                                    <tr>
                                        <td><?= $relatorios->Essencias; ?></td>
                                        <td><?= $relatorios->Ativacoes; ?></td>
                                        <td><?= $relatorios->loja; ?></td>
                                        <td><?= $relatorios->Regiao; ?></td>
                                        <td><?= date('d/m/Y h:m:s', strtotime($relatorios->Essencias)); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>