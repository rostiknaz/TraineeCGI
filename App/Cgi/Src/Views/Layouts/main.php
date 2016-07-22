<?php define( 'SCRIPT_ROOT', 'http://cgi-trainee.local/' );?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$data['title']?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=SCRIPT_ROOT . 'Media/css/bootstrap.min.css'?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=SCRIPT_ROOT . 'Media/css/sb-admin.css'?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=SCRIPT_ROOT . 'Media/css/plugins/morris.css'?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=SCRIPT_ROOT . 'Media/font-awesome/css/font-awesome.min.css'?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Magento product management</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo (isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '') . ' ' . (isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '')?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?=SCRIPT_ROOT . 'login/logout'?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="<?=SCRIPT_ROOT?>"><i class="fa fa-fw fa-upload"></i> Products import page</a>
                </li>
                <li>
                    <a href="<?=SCRIPT_ROOT . 'products/list'?>"><i class="fa fa-fw fa-bar-chart-o"></i> Products listing page</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">


            <?php include 'App/Cgi/Src/Views/'.$content_view . '.php'; ?>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="<?=SCRIPT_ROOT . 'Media/js/jquery.js'?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=SCRIPT_ROOT . 'Media/js/bootstrap.min.js'?>"></script>

<!-- Morris Charts JavaScript -->
<script src="<?=SCRIPT_ROOT . 'Media/js/plugins/morris/raphael.min.js'?>"></script>
<script src="<?=SCRIPT_ROOT . 'Media/js/plugins/morris/morris.min.js'?>"></script>
<script src="<?=SCRIPT_ROOT . 'Media/js/plugins/morris/morris-data.js'?>"></script>

</body>

</html>