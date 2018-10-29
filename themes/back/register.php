<html lang="en-us" id="extr-page">
    <?php
    $tipe = $row_kab->tipe;
    $nm_kab = $row_kab->kabupaten;
    $logo = $row_kab->logo;
    ?>
    <head>
        <meta charset="utf-8">
        <title> Pendapatan <?= $tipe . ' ' . $nm_kab; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/bootstrapnew.min.css">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/font_css.css">
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/<?= $logo; ?>" type="image/x-icon">
        <style>
            #get-notified {
                width: 50%;
                position: absolute;
                z-index: 999;
                top: 10px;
                right: 10px;
            }

            #panel, #flip {
                padding: 5px;
                text-align: center;
                border: solid 1px #c3c3c3;
                background-color: #e5eecc;
                color: #000000;
            }
            .custom-body {
                background-image: url('<?php echo base_url(); ?>assets/img/demo/m2.jpg') !important; 
                background-size: auto;
                -webkit-background-size: 100% 100%;
                background-repeat : no-repeat;
                background-attachment:fixed ; 
            }
            #panel {
                padding: 5px;
                display: none;
            }
            .login{
                padding-top: 0px;
                margin-top:0px; 
            }


            .bag {
                background-color:rgba(255,255,255,0.8);
            }
        </style>
    </head>
    <body class="hold-transition fixed login-page custom-body login">
        <div class="container" >
            <h2 style="color: #000;" class="bag text-center alert">Sistem Informasi Pendapatan Asli Daerah
                <br> <small style="color: #000;font-size: 14pt"> Pemerintah <?= $tipe . ' ' . $nm_kab; ?></small>
            </h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default max">
                        <div class="panel-heading">
                            <h3>Register :</h3>
                        </div>
                        <div class="panel-body">
                            <form id='login-form'>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label>Username</label>
                                            <input type="text" name='username' id='username' class="form-control" autofocus="true" placeholder="Username">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="panel-footer bg-gray">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="<?= site_url('Login'); ?>" class="btn btn-danger btn-flat"><i class="fa fa-backward"></i> Kembali</a>
                                </div>
                                <div class="col-md-6">
                                    <span class="pull-right">
                                        <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-registered"></i> Register</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </form>

                        <!-- /.login-box-body -->
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugin/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugin/jquery-validation/src/localization/messages_id.js"></script>
    </body>
</html>

