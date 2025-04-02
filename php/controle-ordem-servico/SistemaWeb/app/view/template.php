<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Controle de Ordem de Serviço - Centro Automotivo CHAVE DE RODAS</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../../bootstrap_add_remove_tble/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="plugin/bootstraptable/bootstrap-table.min.css">
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="plugin/bootstraptable/bootstrap-table.min.js" type="text/javascript"></script>
    <script src="bootstrap_add_remove_tble/bootstrap-table.min.js"></script>
    <script src="assets/js/main.js"></script>
        

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">  <i class="menu-icon fa fa-cogs"></i> Ordem de Serviço </a>
                    </li>
                    <li>
                        <a href="/cliente"> <i class="menu-icon fa fa-users"></i>Clientes </a>
                    </li>
                    <li>
                        <a href="/auto"> <i class="menu-icon fa fa-truck"></i>Automóvel </a>
                    </li>
                    <li>
                        <a href="/funcionario"> <i class="menu-icon fa fa-briefcase"></i>Funcionário </a>
                    </li>
                    <li>
                        <a href="/logout"> <i class="menu-icon fa fa-times"></i>Logout </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>
                
                

               
            </div>

        </header><!-- /header -->
        
        <div class="content mt-3">
            <?php 
            if (isset($viewName)) { 
                $path = viewsPath() . $viewName . '.php'; 
                if (file_exists($path)) { 
                    require_once $path; 
                } 
            } 
        ?>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

</body>
</html>
