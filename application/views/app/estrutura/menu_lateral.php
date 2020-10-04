<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="<?= $usuario['foto']; ?>" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $usuario['nome_conta']; ?> <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a href="<?= base_url('profile'); ?>" class="dropdown-item"><i class="ti-user"></i> Meu Perfil</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="<?= base_url('login/sair'); ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Sair</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">--- CONTROLE</li>
                <li> 
                    <a class="waves-effect waves-dark" href="<?= base_url('dashboard'); ?>" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard </span></a>
                </li>

                <li> 
                    <a class="waves-effect waves-dark" href="<?= base_url('dispositivos'); ?>" aria-expanded="false"><i class="ti-light-bulb"></i><span class="hide-menu">Dispositivos </span></a>
                </li>

                <li> 
                    <a class="waves-effect waves-dark" href="<?= base_url('relatorios'); ?>" aria-expanded="false"><i class="ti-pie-chart"></i><span class="hide-menu">Relatórios </span></a>
                </li>

                <li class="nav-small-cap">--- SUPORTE</li>
                <li>
                    <a class="waves-effect waves-dark" href="https://portal.stg.eugenio.io/" target="_blank" aria-expanded="false">
                        <i class="fa fa-circle text-primary"></i>
                        <span class="hide-menu">Eugenio</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>