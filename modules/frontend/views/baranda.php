<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $javasc;
?>
<div id="home" class="banner">
    <div class="rev_slider_wrapper">
        <div id="main-banner-slider" class="rev_slider video-slider" data-version="5.0.7">
            <ul>
                <!-- SLIDE1  -->
                <li data-index="rs-280" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default"  data-title="Nama Gambar" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="<?= base_url(); ?>assets/front/images/home/back_hst1.jpg"  alt="image" 
                         class="rev-slidebg" data-bgparallax="3" data-bgposition="center center" 
                         data-duration="5000" data-ease="Linear.easeNone" data-kenburns="on" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="140">
                    <!-- LAYERS -->

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption" 
                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                         data-y="['middle','middle','middle','middle']" data-voffset="['-58','-58','0','-50']" 
                         data-width="none"
                         data-height="none"
                         data-whitespace="nowrap"
                         data-transform_idle="o:1;"

                         data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                         data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                         data-mask_in="x:0px;y:[100%];" 
                         data-mask_out="x:inherit;y:inherit;" 
                         data-start="1000" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-responsive_offset="on" 
                         style="z-index: 6; white-space: nowrap;">
                        <h1>WELCOME</h1>
                    </div>

                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption" 
                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                         data-y="['middle','middle','middle','middle']" data-voffset="['-05','-05','63','0']"
                         data-width="none"
                         data-height="none"
                         data-whitespace="nowrap"
                         data-transform_idle="o:1;"

                         data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                         data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                         data-mask_in="x:0px;y:[100%];" 
                         data-mask_out="x:inherit;y:inherit;" 
                         data-start="2000" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-responsive_offset="on" 
                         style="z-index: 6; white-space: nowrap;">
                        <h6>PEMERINTAH KABUPATEN HULU SUNGAI TENGAH</h6>
                    </div>


                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption"
                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                         data-y="['middle','middle','middle','middle']" data-voffset="['52','52','125','80']"
                         data-transform_idle="o:1;"

                         data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                         data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                         data-mask_in="x:0px;y:[100%];" 
                         data-mask_out="x:inherit;y:inherit;" 
                         data-start="3000" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-responsive_offset="on">
                        <a href="<?=site_url('frontend/Home');?>#about-us" class="project-button hvr-bounce-to-right">Portal Aplikasi</a>
                    </div>
                </li>


            </ul>	
        </div>
    </div>
</div>
<section id="about-us">
    <div class="container">
        <div class="theme-title">
            <h2>PORTAL APLIKASI</h2>
            <p>PEMERINTAH KABUPATEN HULU SUNGAI TENGAH</p>
        </div> <!-- /.theme-title -->

        <div class="row">
            <?php
            foreach ($get_portalAplikasi->result() as $row) {
                if ($row->status == 'Y') {
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="single-about-content">
                            <span class="hover-ajax"   data-placement="bottom" title="<?= $row->nama; ?>"  href="<?= site_url('frontend/Home/tooltips'); ?>?id_portal=<?= $row->id; ?>" >
                                <div class="icon round-border tran3s">
                                    <i class="fa <?= $row->icon; ?>" aria-hidden="true"></i>
                                </div>
                            </span>
                            <h5><?= $row->nama; ?></h5>
                        </div> <!-- /.single-about-content -->
                    </div> <!-- /.col -->
                    <?php
                }
            }
            ?>
        </div> <!-- /.row -->
    </div>
</section>

<script>
    $('.hover-ajax').popover({
        container: 'body',
        
        html: true,
        content: function () {
            var div_id = "tmp-id-" + $.now();
            return details_in_popup($(this).attr('href'), div_id);
        }
    });

    function details_in_popup(link, div_id, clone) {
        $.ajax({
            url: link,
            success: function (response) {
                var popover = {visibility: 'hidden', left: '-150px', padding: '1.5rem', backgroundColor: '#ededed', color: '#000', width: '400px'};
                var my_content = {backgroundColor: '#ededed', color: '#000', width: '480px'};
                var my_title = {backgroundColor: '#dedede', color: '#000', width: '480px', "font-weight": "bold", "font-size": "20px"};
                $('.popover__content').css(popover);
                $('.popover-content').css(my_content);
                $('.popover-title').css(my_title);
                $('#' + div_id).html(response);
            }
        });
        return '<div id="' + div_id + '"><img src="<?=base_url();?>assets/img/ajax-loader1.gif"></div>';
    }
</script>

