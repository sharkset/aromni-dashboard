<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $this->load->view('app/fragmentos/charts/status_cpu'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $this->load->view('app/fragmentos/charts/zonas'); ?>
            </div>
        </div>
        <!--<div class="row">
            <?php // $this->load->view('app/fragmentos/charts/visits'); ?>
        </div>-->
        <div class="row">
            <?php $this->load->view('app/fragmentos/charts/trafic'); ?>
        </div>
       
    </div>
</div>