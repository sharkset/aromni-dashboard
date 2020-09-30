<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Meu Perfil</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                    <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
                </div>
            </div>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php
                    if($msg = get_msg()):
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'.$msg.
                        '</div>';
                    endif; 
                ?>
            </div>
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="<?= $usuario['foto']; ?>" class="img-circle"
                                width="150" />
                            <h4 class="card-title m-t-10"><?= $usuario['nome_conta']; ?></h4>
                            <h6 class="card-subtitle">Administrador</h6>
                        </center>
                        <div class="m-b-30">
                            <style>
                                .btn-tertiary {
                                    color: #C4874B;
                                    padding: 0;
                                    line-height: 40px;
                                    width: 200px;
                                    margin: auto;
                                    display: block;
                                    border: 2px solid #C4874B;
                                }

                                .btn-tertiary:hover,
                                .btn-tertiary:focus {
                                    color: #FB9678;
                                    border-color: #FB9678;
                                }

                                /* input file style */
                                .input-file {
                                    width: 0.1px;
                                    height: 0.1px;
                                    opacity: 0;
                                    overflow: hidden;
                                    position: absolute;
                                    z-index: -1;
                                }

                                .input-file+.js-labelFile {
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    white-space: nowrap;
                                    padding: 0 10px;
                                    cursor: pointer;
                                }

                                .input-file+.js-labelFile .icon:before {
                                    content: "\f093";
                                }

                                .input-file+.js-labelFile.has-file .icon:before {
                                    content: "\f00c";
                                    color: #5AAC7B;
                                }
                            </style>
                            <form id="form_foto" action="<?=base_url('upload/upload_files');?>" enctype="multipart/form-data" method="POST" class="">
                                <div class="form-group">
                                    <input type="file" name="foto" id="foto" class="input-file">
                                    <label for="foto" class="btn btn-tertiary js-labelFile">
                                        <i class="icon fa fa-check"></i>
                                        <span class="js-fileName">Escolha uma foto</span>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="text-center m-t-15">
                            <p style="color:#C4874B">LIMITE MAX: 1 mb <br>RECOMENDADO: 500x500</p>
                            <button onclick="enviar_foto()" type="submit" class="btn btn-success waves-effect waves-light">ATUALIZAR FOTO</button>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body"> <small class="text-muted">Endereço de e-mail </small>
                        <h6><?= $usuario['email']; ?></h6> <small class="text-muted p-t-30 db">Data de cadastro</small>
                        <h6><?= date('d/m/Y', strtotime($usuario['data_cadastro'])); ?></h6> <small class="text-muted p-t-30 db">Expiração da conta</small>
                        <h6><?= date('d/m/Y', strtotime($usuario['expiracao_conta'])); ?></h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                role="tab">Perfil</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#changepassword"
                                role="tab">Alterar senha</a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="<?= base_url('profile/updatePerfil'); ?>" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Nome completo</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?= $usuario['nome_completo']; ?>"
                                                class="form-control form-control-line" name="nome_completo" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Telefone celular</label>
                                        <div class="col-md-12">
                                            <input type="tel" id="celular" value="<?= $usuario['celular']; ?>"
                                                class="form-control form-control-line" name="celular" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Data de nascimento</label>
                                        <div class="col-md-12">
                                            <input type="date" value="<?= $usuario['nascimento']; ?>"
                                                class="form-control form-control-line" name="data_nascimento" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Cidade</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?= $usuario['cidade']; ?>"
                                                class="form-control form-control-line" name="cidade" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Estado</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?= $usuario['estado']; ?>"
                                                class="form-control form-control-line" name="estado" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Sexo</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="sexo">
                                                <option value="3">Masculino</option>
                                                <option value="1">Feminino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">ATUALIZAR PERFIL</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- CHANGE PASSWORD -->
                        <div class="tab-pane" id="changepassword" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="<?= base_url('profile/alterarSenha'); ?>" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Senha antiga</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="" name="password_antigo"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Nova senha</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="" name="password"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirmar a nova senha</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="" name="senhaconf"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">ATUALIZAR SENHA</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

    </div>
</div>

<script src="<?= base_url('template/dist/js/jquery.mask.min.js'); ?>"></script>
<script type="text/javascript">
    $('#celular').mask('(00) 00000-0000');
    $('#telefone').mask('(00) 0000-0000');

    function enviar_foto() {
        $('form#form_foto').submit();
    }

    $(".input-file").each(function() {
        var $input = $(this),
            $label = $input.next(".js-labelFile"),
            labelVal = $label.html();

        $input.on("change", function(element) {
            var fileName = "";
            if (element.target.value)
                fileName = element.target.value.split("\\").pop();
            fileName
                ?
                $label.addClass("has-file").find(".js-fileName").html(fileName) :
                $label.removeClass("has-file").html(labelVal);
        });
    });
</script>