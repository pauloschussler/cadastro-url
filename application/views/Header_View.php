<body onload="Inicio()">
    <!-- Navbar -->
    <nav class="navbar-expand-md navbar-dark bg-dark navbar fixed-top">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar3SupportedContent" aria-controls="navbar3SupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse text-center justify-content-center" id="navbar3SupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item mx-3">
                        <a class="nav-link <?php if ($navbar == 1) {
                                                echo 'text-light';
                                            } ?>" href="<?= base_url('Index') ?>"><b class="navbar_text">Home</b></a>
                    </li>
                    <!-- <li class="nav-item mx-2">
                        <a class="nav-link" href="<?= base_url('Usuario') ?>"><b class="navbar_text">Usuários</b></a>
                    </li> -->
                    <li class="nav-item mx-2">
                        <a class="nav-link <?php if ($navbar == 2) {
                                                echo 'text-light';
                                            } ?>" href="<?= base_url('Url/visualizarUrl') ?>"><b class="navbar_text">Visualizar URLs</b></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link <?php if ($navbar == 3) {
                                                echo 'text-light';
                                            } ?>" href="<?= base_url('Url/cadastraUrl') ?>"><b class="navbar_text">Cadastrar URLs</b></a>
                    </li>
                </ul>
            </div>
            <a class="btn btn-outline-light font-weight-bold" href="<?= base_url('Login/Logout') ?>">LOGOUT</a>
        </div>
    </nav>