<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$username = $row_user->username;
$foto = $row_user->foto;
$nama_user = $row_user->nama_user;
$ket_level = $row_user->ket_level;
$email = $row_user->email;
$kd_level = $row_user->kd_level;
$no_telpon = $row_user->no_telpon;
?>
<html lang="en-us" id="lock-page">
    <head>
        <meta charset="utf-8">
        <title>tes </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/lockscreen.min.css">
        <style>
            #get-notifieded {
                width: 50%;
                position: absolute;
                z-index: 999;
                top: 10px;
                right: 10px;
            }
            .body {
                background-image: url('<?php echo base_url(); ?>assets/img/background.png') !important; 
                background-size: auto;
                -webkit-background-size: 100% 100%;
                background-repeat : no-repeat;
                background-attachment:fixed ; 
            }
        </style>
    </head>
    <body class="body">
        <div id="main" role="main">
            <form class="lockscreen animated flipInY" id="login-form">
                <div id="get-notifieded"></div>
                <div class="logo"></div>
                <div>
                    <?php if ($foto == '') { ?>
                        <img src="<?= base_url(); ?>assets/img/avatars/sunny-big.png" alt="" width="120" height="120" class="img-circle" />
                    <?php } else { ?>
                        <img src="<?= base_url(); ?>assets/img/user/<?= $foto; ?>" alt="" width="120" height="120" class="img-circle" />
                    <?php } ?>
                    <div>
                        <h1 class="hidden-mobile"><i class="fa fa-user fa-3x text-muted air air-top-right"></i>
                            <?php echo $nama_user; ?> 
                            <small><i class="fa fa-lock text-muted"></i> &nbsp;Locked <?= $ket_level; ?></small></h1>
                        <p class="text-muted">
                            <a href="mailto:simmons@smartadmin"><?= $no_telpon . ' - ' . $email; ?></a>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control " name="username" type="" id="username" value="<?= $username; ?>" readonly placeholder="Password">
                                <input class="form-control" name="tahun" type="hidden" id="tahun" value="<?= $tahun; ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-user"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" name="password" type="password" autofocus="true" id="password" placeholder="Password">
                                <div class="input-group-btn">
                                    <button class="btn btn-warning" type="submit"><i class="fa fa-key"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <p class="font-xs margin-top-5">Copyright Tahun 2018.</p>
            </form>

        </div>
        <script src="<?= base_url(); ?>assets/js/plugin/pace/pace.min.js"></script>
        <script> if (!window.jQuery) {
                document.write('<script src="<?= base_url(); ?>assets/js/libs/jquery-2.1.1.min.js"><\/script>'); }</script>
        <script> if (!window.jQuery.ui) {
                document.write('<script src="<?= base_url(); ?>assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
            }</script>
        <script src="<?= base_url(); ?>assets/js/app.config.js"></script>
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
                            }, 2000);
                        });
                        var username = $('#username').val();
                        var password = $('#password').val();
                        var tahun = $('#tahun').val();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('login/Login/validasi'); ?>",
                            data: {
                                username: username,
                                tahun: tahun,
                                password: password
                            },
                            success: function (msg)
                            {
                                if (msg == "true") {
                                    $("#get-notifieded").html('<div class="alert alert-success alert-dismissable animated fadeIn"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil Masuk. </div>');
                                    setTimeout(function () {
                                        window.location.href = '<?= site_url('home/Home'); ?>';
                                    }, 2000);
                                } else if (msg == "false") {
                                    $("#get-notifieded").html('<div class="alert alert-danger alert-dismissable animated fadeIn" id="notiv_kunic"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-ban"></i> Peringatan!</h4> User Anda Sedang Dikunci Administrator, Silahkan Hubungi Administrator Untuk Mengaktifkan. </div>');
                                    $('#notiv_kunic').fadeOut(7000)// then reload the page.
                                } else {
                                    $("#get-notifieded").html('<div class="alert alert-warning alert-dismissable animated fadeIn" id="notiv_gagal"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Username dan Password Salah. </div>');
                                    $('#notiv_gagal').fadeOut(3000)// then reload the page.
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>