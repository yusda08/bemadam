<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = aksesLog();
echo $javasc;
?>
<section id="widget-grid" class=""> 
    <div class="row">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> My Dashboard</span></h1>
    </div>
    <div class="row">

        <div class="col-sm-12"> 

            <div class="alert alert-info">
                <h2>Tahun Login : <?= $a['tahun']; ?></h2>
                <!--
                
                
                                <h3 class="no-margin">jQuery HighchartTable</h3>
                                
                                <ul>
                                    <li>The HighchartTable plugin takes data and attributes from a table and parses them to simply create an Hightcharts chart</li>
                                    <li>Control the graph dynamically and easily without any javascript</li>
                                    <li>Builds automatically during page load, all you need to do is load the plugin</li>
                                    <li>See the full documentation <a href="http://highcharttable.org/#documentation" target="_blank"><strong>here <i class="fa fa-link"></i> </strong> </a></li>
                                </ul>-->



            </div>

            <div class="col-sm-12 well"> 
                <div class="col-sm-4">
                        <table class="highchart table table-hover table-bordered table-responsive" data-graph-container=".. .. .highchart-container2" data-graph-type="column">
                            <caption>Tabel Jumlah Desa</caption>
                            <thead>
                                <tr>
                                    <th>Nama Kabupaten</th>
                                    <th class="">Jumlah Desa</th>
                                    <th class="">Desa Berkinerja Baik</th>
                                    <th class="">Desa Belum Mandiri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_kabJmlDesa as $row) {
                                    $row_mdr = $this->Model_penilaian->get_jmlMandiri($row['kd_kab'], $a['tahun']);
                                    $jml_mandiri = $row_mdr->jml_mandiri;
                                    if (is_null($jml_mandiri)) {
                                        $jml_mandiri = 0;
                                    } else {
                                        $jml_mandiri = $jml_mandiri;
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $row['nama']; ?></td>
                                        <td class="text-center"><?= $row['jml_desa']; ?></td>
                                        <td class="text-center"><?= $jml_mandiri; ?></td>
                                        <td class="text-center"><?= $row['jml_desa'] - $jml_mandiri; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <div class="col-sm-8">
                    <h3 class="text-center">Perbandingan Desa Provinsi Kalimantan Selatan</h3>
                    <div class="highchart-container2"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url(); ?>assets/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?= base_url(); ?>assets/js/smart-chat-ui/smart.chat.manager.min.js"></script>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
<script src="<?= base_url(); ?>assets/js/plugin/highChartCore/highcharts-custom.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugin/highchartTable/jquery.highchartTable.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {

        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         *
         * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
         *
         * // activate tooltips
         * 
         *
         * // activate popovers
         * 
         *
         * // activate popovers with hover states
         * $("[rel=popover-hover]").popover({ trigger: "hover" });
         *
         * // activate inline charts
         * runAllCharts();
         *
         * // setup widgets
         * setup_widgets_desktop();
         *
         * // run form elements
         * runAllForms();
         *
         ********************************
         *
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */

        pageSetUp();
        /*
         * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
         * eg alert("my home function");
         * 
         * var pagefunction = function() {
         *   ...
         * }
         * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
         * 
         * TO LOAD A SCRIPT:
         * var pagefunction = function (){ 
         *  loadScript(".../plugin.js", run_after_loaded);	
         * }
         * 
         * OR
         * 
         * loadScript(".../plugin.js", run_after_loaded);
         */

//				 $('table.highchart').highchartTable();
        $('table.highchart')
                .bind('highchartTable.beforeRender', function (event, highChartConfig) {
                    highChartConfig.colors = ['#00CCCC', '#000000', '#3399CC'];
                })
                .highchartTable();

    })

</script>
