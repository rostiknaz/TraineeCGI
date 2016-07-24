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
<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <?php if(isset($data['errors']) && !empty($data['errors'])) {
                    foreach ($data['errors'] as $error) { ?>
                        <div id="login-alert" class="alert alert-danger col-sm-12"><?=$error?></div>
                    <?php } ?>
                <?php } ?>


                <form id="loginform" action="login" class="form-horizontal" role="form" method="post">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="email">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button type="submit" id="btn-login" class="btn btn-success">Login  </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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