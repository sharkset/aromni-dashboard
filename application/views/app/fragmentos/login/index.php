<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aroma Spot - Um projeto Eugenio Chalenge da natura">
    <meta name="author" content="Francisco Geneuto">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('template/assets/images/favicon.png'); ?>">
    <!-- page css -->
    <link href="<?= base_url('template/dist/css/pages/login-register-lock.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('template/dist/css/style.css'); ?>" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= base_url('template/assets/node_modules/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">

    <title><?= $title_page; ?></title>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
.overlay-bg {
    background: rgba(0,0,0,0.9);
    background-image: radial-gradient(circle,rgba(255,255,255,0.9) 0%,rgba(0,0,0,0.9) 100%);
}
.overlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
</style>
</head>

<body class="skin-default card-no-border">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Aromni</p>
        </div>
    </div>

    <section id="wrapper">
        <!--<div class="overlay overlay-bg" style="background-image:url(<?=  base_url('template/assets/images/background/login-register.jpg'); ?>);"></div>-->
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="<?= base_url('verificarlogin'); ?>" method="POST">
                        <div class="logo" style="text-align: center;"><img style="text-align: center; width:200px" src="<?= base_url('template/assets/images/logo.png'); ?>" alt="Aromni" class="light-logo" /></div>
                        <?php
                            if($msg = get_msg()):
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'.$msg.
                                '</div>';
                            endif; 
                        ?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" type="email" required="" placeholder="E-mail"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="senha" type="password" required="" placeholder="Senha"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Lembrar-me</label>
                                    </div> 
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> Esqueceu a senha?</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Entrar</button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" action="<?= base_url('recuperarsenha'); ?>" method="POST">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recuperar Senha</h3>
                                <p class="text-muted">Digite seu e-mail e receba as instruções por ele ao clicar em resetar </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="required" name="email" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Resetar</button>
                            </div>
                        </div>
                        <div class="form-group row m-t-30 m-b-0 mx-auto">
                            <div class="col-sm-6">
                                <a href="<?=base_url('login');?>"><i class="fa fa-home m-r-5"></i> Voltar para o login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    
    <script src="<?= base_url('template/assets/node_modules/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('template/assets/node_modules/popper/popper.min.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('template/dist/js/custom.min.js'); ?>"></script>
    <script src="<?= base_url('template/assets/node_modules/toast-master/js/jquery.toast.js'); ?>"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

    <!-- Alerta de callback do sistema -->
    <?php if ($this->session->flashdata('info') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Info',
                    text: '<?php echo $this->session->flashdata('info')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'info',
                    hideAfter: 3000, 
                    stack: 6
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Ops, algo deu errado',
                    text: '<?php echo $this->session->flashdata('error')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500
                    
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('warning') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Cuidado',
                    text: '<?php echo $this->session->flashdata('warning')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'warning',
                    hideAfter: 3500, 
                    stack: 6
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success') != null): ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $.toast({
                    heading: 'Sucesso',
                    text: '<?php echo $this->session->flashdata('success')['message']; ?>',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            });
        </script>
    <?php endif; ?>
    </body>

</html>