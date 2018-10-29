
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_logined');
echo $javasc;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center error-box">
                    <h1 class="error-text-2 bounceInDown animated"> Error 404 <span class="particle particle--c"></span><span class="particle particle--a"></span><span class="particle particle--b"></span></h1>
                    <h2 class="font-xl"><strong><i class="fa fa-fw fa-warning fa-lg text-warning"></i> Page <u>Not</u> Found</strong></h2>
                    <br />
                    <p class="lead">Permintaan masih belum ada dalam aplikasi.</p>
<!--                    <p class="font-md">
                        <b>... That didn't work on you? Dang. May we suggest a search, then?</b>
                    </p>-->
                    <br>

                    <div class="row">

                        <div class="col-sm-12">
                            <ul class="list-inline">
                                <li>
                                    &nbsp;Silahkan Kembali Ke (Klik) <a href="<?= site_url('Home'); ?>">Dashbaord</a>&nbsp;
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- end row -->

</div>