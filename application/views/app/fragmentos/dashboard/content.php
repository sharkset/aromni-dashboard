<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <p style="margin:10px 0px 0px 0px;">Por período: </p>
            <div class="col-md-4 align-self-center">
                <ul class="nav nav-fill">
                    <li style="margin-left:5px"> <a href="#navpills-1" class="btn waves-effect waves-light btn-outline-primary active" data-toggle="tab" aria-expanded="false">Última semana</a> </li>
                    <li style="margin-left:5px"> <a href="#navpills-2" class="btn waves-effect waves-light btn-outline-primary" data-toggle="tab" aria-expanded="false">Mês</a> </li>
                    <li style="margin-left:5px"> <a href="#navpills-3" class="btn waves-effect waves-light btn-outline-primary" data-toggle="tab" aria-expanded="true">Ano</a> </li>
                </ul>
            </div>
            <p style="margin:10px 0px 0px 0px;">Por loja: </p>
            <div class="col-md-2 align-self-center">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Todas
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="javascript:void(0)">S J Campos</a>
                            <a class="dropdown-item" href="javascript:void(0)">Iguatemi</a>
                        </div>
                    </div>
                </div>
            </div>

            <p style="margin:10px 0px 0px 0px;">Por região: </p>
            <div class="col-md-2 align-self-center">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Brasil
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="javascript:void(0)">Sudeste</a>
                            <a class="dropdown-item" href="javascript:void(0)">Nordeste</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
                </div>
            </div>
        </div>


        <div class="tab-content br-n pn">
            <div id="navpills-1" class="tab-pane active">
                
                <div class="row">

                    <div class="col-md-4">
                        <?php $this->load->view('app/fragmentos/charts/semana/zonas'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php $this->load->view('app/fragmentos/charts/semana/donut_chart'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php $this->load->view('app/fragmentos/charts/semana/total_devices_active'); ?>
                        <?php $this->load->view('app/fragmentos/charts/semana/total_devices_off'); ?>
                        <?php $this->load->view('app/fragmentos/charts/semana/top_one'); ?>
                    </div>

                </div>
            </div>
            
            <div id="navpills-2" class="tab-pane">
                
                <div class="row">
                    <div class="col-md-4">
                        <?php $this->load->view('app/fragmentos/charts/mes/zonas'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php $this->load->view('app/fragmentos/charts/mes/donut_chart'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php $this->load->view('app/fragmentos/charts/mes/total_devices_active'); ?>
                        <?php $this->load->view('app/fragmentos/charts/mes/total_devices_off'); ?>
                        <?php $this->load->view('app/fragmentos/charts/mes/top_one'); ?>
                    </div>
                </div>
            </div>

                        
            <div id="navpills-3" class="tab-pane">
                
                <div class="row">
                    <div class="col-md-4">
                        <?php $this->load->view('app/fragmentos/charts/ano/zonas'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php $this->load->view('app/fragmentos/charts/ano/donut_chart'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php $this->load->view('app/fragmentos/charts/ano/total_devices_active'); ?>
                        <?php $this->load->view('app/fragmentos/charts/ano/total_devices_off'); ?>
                        <?php $this->load->view('app/fragmentos/charts/ano/top_one'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>