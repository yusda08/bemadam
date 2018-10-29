<!DOCTYPE html>
<html lang="en-us" class="smart-style-1">
    <head>
        <?= $head; ?>
    </head>
    <body class="desktop-detected  fixed-header fixed-navigation fixed-ribbon pace-done smart-style-3">

        <!-- HEADER -->
        <header id="header" class="bg-yellow-active">
            <?= $nav_header; ?>
        </header>
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel" class="bg-gray-active">
            <?= $nav; ?>
        </aside>

        <div id="main" role="main">
                <div class="preloader">
                    <div class="loading">
                        <center>
                            <img src="<?= base_url('assets/img/' . $row_din->logo); ?>" class="img-responsive hidden-mobile hidden-xs " width="20%">
                            <img src="<?= base_url('assets/img/' . $row_din->logo); ?>" class="img-responsive hidden-lg hidden-md hidden-sm " width="40%">
                            <!--<p style="font-size: 15pt; padding: 10px; font-style: initial; background-color: #ffffff">Sistem Informasi Pembangunan Daerah<br> Pemerintah <?= $row_kab->tipe . ' ' . $row_kab->kabupaten; ?></p>-->
                            <img src="<?= base_url('assets/img/loading_ajax.gif'); ?>" >
                        </center>
                    </div>
                </div>

            <div id="ribbon">
                <?php if (isset($ribbon)) { ?>
                <div id="ribbon" class="bg-gray-active">
                        <span class="ribbon-button-alignment"> 
                            <span id="refresh" class="btn btn-ribbon btn-default" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                                <i class="fa fa-refresh"></i>
                            </span> 
                        </span>
                        <ol class="breadcrumb">
                            <?= $ribbon; ?>
                        </ol>
                    </div>
                <?php } ?>
                <div id='notivs'></div>
            </div>
            <!-- END RIBBON -->

            <!-- MAIN CONTENT -->
            <div id="content">
                <?= $content; ?>
            </div>
        </div>


        <div class="page-footer bg-yellow-active" >
            <?= $footer; ?>
        </div>
        <!-- END PAGE FOOTER -->

        <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
        Note: These tiles are completely responsive,
        you can add as many as you like
        -->

    </body>

</html>