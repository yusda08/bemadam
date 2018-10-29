<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $javasc;
//$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
?>
<div id="service-section"></div> <!-- /.theme-title -->
<!-- /.theme-title -->


<div id="blog-section" style="background-color: #ededed">
    <div class="container" >
        <div class="theme-title">
            <h2>Berita Terkini</h2>
        </div> <!-- /.theme-title -->
        <div class="clear-fix" id="berita">
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($get_beritaLimit as $row_brt) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="single-news-item well_sama" style="background-color: #fff">
                                <div class="img">
                                    <?php
                                    $isi = substr($row_brt->isi, 0, 100);
                                    $foto = $row_brt->foto;
                                    if ($foto == '') {
                                        ?>
                                        <img src="<?= base_url(); ?>assets/img/berita/kosong.png" />
                                    <?php } else { ?>
                                        <img src="<?= base_url(); ?>assets/img/berita/<?= $foto; ?>" />
                                    <?php }
                                    ?>
                                    <a href="<?= site_url('frontend/berita/berita_detail?berita=' . $row_brt->id); ?>" class="opacity tran4s"><i class="fa fa-link" aria-hidden="true"></i> <?= $row_brt->judul; ?></a>
                                </div> <!-- /.img -->
                                <div class="post" style="padding: 10px">
                                    <h6><a href="blog-details.html" class="tran3s"><?= $row_brt->judul; ?></a></h6>
                                    <a href="blog-details.html">Posted by <span class="p-color"><?= $row_brt->from; ?></span> <br> <?= Tgl_indo::indo_angka($row_brt->tanggal) . ' At : ' . $row_brt->time; ?></a>
                                    <p>
                                        <?= $isi; ?>
                                        <a href="<?= site_url('frontend/berita/berita_detail?berita=' . $row_brt->id); ?>" class="tran3s">Read More</a></p>
                                </div> <!-- /.post -->
                            </div> <!-- /.single-news-item -->
                        </div> <!-- /.col- -->
                    <?php } ?>
                </div>
                <div class="row text-center">
                    <ul class="pagination">
                        <?php
                        $jml = count($get_berita);
                        $jmlhal = ceil($jml / $limit);
                        $sebelumnya = $hal - 1;
                        $berikutnya = $hal + 1;
                        if ($hal > 1) {
                            echo "<li ><a  href='" . site_url('frontend/Home/home?hal=1#berita') . "'> &laquo;</a></li>";
                        } else {
                            echo "<li><a  href='#'>&laquo;</a></li>";
                        }
                        for ($i = 1; $i <= $jmlhal; $i++) {
                            if ($i == $hal)
                                echo "<li> <a  href='#'><b>$i</b></a></li> ";
                            else
                                echo "<li><a href='" . site_url('frontend/Home/home?hal=' . $i . '#berita') . "'> $i </a></li> ";
                        }

                        if ($hal < $jmlhal) {
                            echo "<li><a href='" . site_url('frontend/Home/home?hal=' . $berikutnya . '#berita') . "'> &raquo; </a></li> ";
                        } else {
                            echo "<li><a  href='#'>&raquo;</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div> 
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#gpr" role="tab" data-toggle="tab">GPR</a></li>
                            <li><a href="#2" role="tab" data-toggle="tab">Daerah</a></li>
                        </ul>
                    </div>

                    <!-- Tab panes + Panel body -->
                    <div class="panel-body tab-content">
                        <div class="tab-pane active" id="gpr">
                            <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
                            <div id="gpr-kominfo-widget-container" style="margin: 0 auto;"></div>
                        </div>
                        <div class="tab-pane" id="2">PROFILE</div>
                    </div>
                </div>
            </div> 
        </div> <!-- /.clear-fix -->
    </div> <!-- /.clear-fix -->
</div> <!-- /.clear-fix -->
<!-- /.clear-fix -->
<div id="blog-section">
    <div id="thumbnail-slider">
        <div class="inner">
            <ul>
                <?php
                foreach ($get_link as $row_link) {
                    $foto = $row_link->foto;
                    ?>
                    <li>
                        <a href="<?= $row_link->link; ?>" target="_blank">
                            <img src="<?= base_url(); ?>assets/img/link/<?= $foto; ?>" width="100%" class="thumb img-responsive">
                        </a>                        
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</div> 
<script>
    //Note: this script should be placed at the bottom of the page, or after the slider markup. It cannot be placed in the head section of the page.
    var thumbs1 = document.getElementById("thumbnail-slider");
    var thumbs2 = document.getElementById("thumbs2");
    var closeBtn = document.getElementById("closeBtn");
    var slides = thumbs1.getElementsByTagName("li");
    for (var i = 0; i < slides.length; i++) {
        slides[i].index = i;
        slides[i].onclick = function (e) {
            var li = this;
            var clickedEnlargeBtn = false;
            if (e.offsetX > 220 && e.offsetY < 25)
                clickedEnlargeBtn = true;
            if (li.className.indexOf("active") != -1 || clickedEnlargeBtn) {
                thumbs2.style.display = "block";
                mcThumbs2.init(li.index);
            }
        };
    }

    thumbs2.onclick = closeBtn.onclick = function (e) {
        //This event will be triggered only when clicking the area outside the thumbs or clicking the CLOSE button
        thumbs2.style.display = "none";
    };
</script>