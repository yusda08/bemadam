<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = aksesLog();
echo $javasc;
echo $notifikasi;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<section id="widget-grid" class="">
    <div class="row">
        <div class="col-sm-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="well well-light well-sm no-margin no-padding">

                            <div class="row">

                                <div class="col-sm-12">
                                    <img src="<?= base_url(); ?>assets/img/header_back11.png" class="img-responsive" alt="demo user">
                                    <div id="myCarousel" class="carousel fade profile-carousel">

                                        <div class="air air-bottom-right padding-10">
                                            <button class="btn btn-sm" style="background: #990F0F;color: #FFC" onclick="editProfil('<?= $kd_user; ?>')">
                                                <i class="fa fa-pencil"></i> Edit Profil</button>&nbsp; 
                                            <!--<a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Connect</a>-->
                                        </div>
                                        <!--                                        <div class="air air-top-left padding-10">
                                                                                    <h4 class="txt-color-white font-md"><?= Tgl_indo::indo(date('Y-m-d')); ?> </h4>
                                                                                </div>-->

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">

                                <div class="row">

                                    <div class="col-sm-3 profile-pic">
                                        <?php
                                        $foto = $a['foto'];
                                        if ($foto == '') {
                                            echo "<img src='" . base_url() . "assets/img/avatars/sunny-big.png' class='img-responsive' />";
                                        } else {
                                            echo "<img src='" . base_url() . "assets/img/user/" . $foto . "' class='img-responsive'/>";
                                        }
                                        ?>
                                        <!--<img src="<?= base_url(); ?>assets/img/avatars/sunny-big.png" class='img-responsive img-circle' alt="demo user">-->
                                        <br>
                                        <div class="padding-10">
                                            <h4 class="font-md"><strong></strong>
                                                <br>
                                                <small></small></h4>
                                            <br>
                                            <h4 class="font-md"><strong></strong>
                                                <br>
                                                <small></small></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <h1><?= $a['nama_user']; ?>
                                            <br>
                                            <small> <?= $a['ket_level']; ?></small></h1>

                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-phone"></i>&nbsp;&nbsp;<?= $a['no_telpon']; ?>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="<?= $a['email']; ?>"><?= $a['email']; ?></a>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                                                    <span class="txt-color-darken">Last Login 
                                                        <a href="javascript:void(0);" rel="tooltip" title="" data-placement="top" data-original-title="Tanggal Terakhir Logout"><?= Tgl_indo::indo($a['last_login_dt']) . ' At : ' . $a['last_login_tm']; ?> </a>
                                                    </span>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="padding-10">
                                    <div class="tab-content padding-top-10">
                                        <div class="tab-pane fade in active" id="a1">

                                            <div class="row">
                                                <div class="padding-10 bg-gray-light" >

                                                    <ul class="nav nav-tabs tabs-pull-right">
                                                        <li class="active">
                                                            <a href="#a1" data-toggle="tab">Aktifitas Saya</a>
                                                        </li>
                                                        <li class="pull-left">
                                                            <span class="margin-top-10 display-inline"><i class="fa fa-rss text-success"></i> Activity</span>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content padding-top-10">
                                                        <div class="tab-pane fade in active" id="a1">
                                                            <div class="custom-scroll" style="height:450px; overflow-y: scroll;">
                                                                <?php foreach ($aktifitas->result() as $row) { ?>
                                                                    <div class="row ">
                                                                        <div class="col-xs-4 col-sm-3">
                                                                            <p class="no-margin"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<a href="javascript:void(0);"> <?= Tgl_indo::indo($row->tanggal) . '<br><i class="fa fa-clock-o"></i>&nbsp;&nbsp; At : ' . $row->jam; ?></a></p>
                                                                        </div>
                                                                        <div class="col-xs-8 col-sm-9">
                                                                            <p><small>Keterangan :</small><br><?= $row->keterangan; ?></p>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="editProfil"></div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function editProfil() {
        var url_form = '<?= site_url('setting/Set_profil/editProfil'); ?>';
        $.ajax({
            type: 'POST',
            url: url_form,
            success: function (data) {
                $('#editProfil').html(data);
            }
        });
    }
</script>