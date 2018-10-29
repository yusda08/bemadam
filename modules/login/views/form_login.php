<!DOCTYPE html>
<html lang="en-us" id="extr-page">
    <?php
//    $tipe = $row_kab->tipe;
//    $nm_kab = $row_kab->kabupaten;
//    $logo = $row_kab->logo;
    ?>
    <head>
        <meta charset="utf-8">
        <title> Dinas Pem. Desa Prov Kalsel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="56x56" href="<?= linkLogoKab($row_din->logo); ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/font_css.css">

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
                background-image: url('<?php echo base_url(); ?>assets/img/bendera2.jpg') !important; 
                background-size: auto;
                -webkit-background-size: 100% 100%;
                background-repeat : no-repeat;
                background-attachment:fixed ; 
            }


            .bag {
                background-color:rgba(255,255,255,0.8);
            }
            .login-box,.register-box{margin-top:10%; }
            @media (max-width:1200px){
                .login-box,.register-box{width:960px;margin-top:10%; margin-left: 0%}
            }
            @media (max-width:960px){
                .login-box,.register-box{width:360px;margin-top:10%; margin-left: 25%}
            }
            @media (max-width:768px){
                .login-box,.register-box{width:360px;margin-top:10%; margin-left: 20%}
            }
            @media (max-width:480px){
                .login-box,.register-box{width:320px;margin-top:10%; margin-left: 0%}
            }
            .bag { background-color:rgba(255,255,255,0.8);}
        </style>
    </head>
    <body class="hold-transition fixed login-page custom-body login">
        <div class="container" >
            <div class="login-box">
                <div class="row">
                    <div class="col-md-8 hidden-xs hidden-sm">
                        <div class="panel bag">
                            <div class="panel-heading panel-primary">
                                <p style="color: #000;font-size: 16pt; font-weight: bold " style="color: #000;" class="text-center">
                                    SIGADIS</p>
                                <p style="color: #000;font-size: 14pt; font-weight: bolder" style="color: #000;" class="text-center">
                                    Sistem Informasi Data Desa Mandiri Se Kalsel</p>
                            </div>
                            <div class="panel-body">
                                <div id="carousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php
                                        $jmlSlide = count($get_slideShow);
                                        for ($i = 0; $i < $jmlSlide; $i++) {
                                            ?>
                                            <li data-target="#carousel" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo "class='active'"; ?>></li>
                                        <?php } ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $no = 0;
                                        foreach ($get_slideShow as $row) {
                                            ?>
                                            <div class="item <?php if ($no == 0) echo ' active'; ?>">
                                                <img src="<?php linkImg('slide', $row->foto); ?>" style="width:100%;height:300px; ">
                                                <div class="carousel-caption">
                                                    <h3 class="bag" style="color: #000"><?= $row->judul; ?></h3>
                                                </div>
                                            </div>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </div>
                                    <a class="carousel-control left" href="#carousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="carousel-control right" href="#carousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- /.login-box-body -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel bag">
                            <div class="panel-heading panel-primary">
                                <p style="color: #000;font-size: 14pt; font-weight: bold " style="color: #000;" class="text-center">
                                    <img  style="float:left; margin:0 8px 4px 0" src="<?= base_url(); ?>assets/img/<?= $row_din->logo; ?>" width="15%" class="img-responsive img-rounded">
                                    <?= $row_din->nama; ?>
                                </p>
                            </div>
                            <div class="panel-body">
                                <div id="get-notified"></div>
                                <!--<h4 class="text-center"></h4>-->
                                <p style="font-weight: bold; font-size: 14pt" class="text-center">
                                    Form Login :</p>
                                <form id='login-form'>
                                <!--<form action="<?php // echo base_url('login/Login/validasi');        ?>" method="POST">-->
                                    <div class="form-group has-feedback">
                                        <label>Username</label>
                                        <input type="text" name='username' id='username' class="form-control" autofocus="true" placeholder="Username">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Password</label>
                                        <input type="password" id='password' name='password' x-autocompletetype="cc-number" class="form-control"  placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Tahun</label>
                                        <select class="form-control" name="tahun" id='tahun' required>
                                            <?php for ($tahun = 2016; $tahun <= 2020; $tahun++) { ?>
                                                <option value="<?php echo $tahun; ?>"
                                                <?php
                                                if ($tahun == date('Y')) {
                                                    echo "selected";
                                                }
                                                ?>
                                                        ><?php echo $tahun; ?></option>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <!--<a href="<?= site_url('Home'); ?>" class="btn btn-danger btn-flat"><i class="fa fa-backward"></i> Kembali</a>-->
                                        </div>
                                        <div class="col-xs-6">
                                            <span class="pull-right">
                                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-sign-in"></i>  Masuk</button>
                                            </span>
                                        </div>
                                        <!--                                        <div class="col-xs-6">
                                                                                    <a href="#">Lupa Password</a>
                                                                                </div>-->
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer panel-primar">
                                <p class="text-center">
                                    <u><?= $row_din->instansi; ?></u><br>
                                    <b>Hak Cipta Dilindungi Undang-Undang</b>
                                    <br>
                                    Copyright &copy; <?php echo date("Y"); ?>
                                </p>
                                <center>
                                    <span style="color: #000;text-decoration: underline"><i class="fa fa-desktop"></i> Design By Yusda Helmani, S.Kom</span>
                                </center>
                            </div>
                            <!-- /.login-box-body -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
<!--        <script src="<?= base_url(); ?>assets/js/jquery2.2.1.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap1.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugin/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugin/jquery-validation/src/localization/messages_id.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#login-form").validate({
                    submitHandler: function (form) {
                        $("button[type='submit']").click(function () {
                            var $btn = $(this);
                            $btn.button('loading');
                            setTimeout(function () {
                                $btn.button('reset');
                            }, 4000);
                        });
                        var username = $('#username').val();
                        var password = $('#password').val();
                        var tahun = $('#tahun').val();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('login/Login/validasi'); ?>",
                            data: {
                                username: username,
                                password: password,
                                tahun: tahun
                            },
                            success: function (msg)
                            {
                                if (msg == "true") {
                                    $("#get-notified").html('<div class="alert alert-success alert-dismissable animated fadeIn"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil Masuk. </div>');
                                    setTimeout(function () {// wait for 2 secs
//                                        window.location.href = 'login/Login/loginBerhasil';  // then reload the page.
                                        window.location.href = '<?= base_url('login/Login/loginBerhasil'); ?>';  // then reload the page.
                                    }, 500);
                                } else if (msg == "false") {
                                    $("#get-notified").html('<div class="alert alert-danger alert-dismissable animated fadeIn" id="notiv_kunic"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-ban"></i> Peringatan!</h4> User Anda Sedang Dikunci Administrator, Silahkan Hubungi Administrator Untuk Mengaktifkan. </div>');
                                    $('#notiv_kunic').fadeOut(7000)// then reload the page.
                                } else {
                                    $("#get-notified").html('<div class="alert alert-warning alert-dismissable animated fadeIn" id="notiv_gagal"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Username dan Password Salah. </div>');
                                    $('#notiv_gagal').fadeOut(7000)// then reload the page.
                                }
                            }
                        });
                    }
                });
            });




        </script>
    </body>
</html>