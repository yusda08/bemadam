<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = aksesLog();
$m = aksesMenu($a['kd_user']);
echo $javasc;
echo $notifikasi;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" >
                <header class="bg-gray">
                    <h2><strong>Tabel Data Desa</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2">Pilih Kabupaten</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name='kabupaten' class="btn btn-default select2" id="kabupaten" style="width: 100%">
                                            <option value=''> Pilih Kabupaten</option>
                                            <option value='https://bemadam.info/assets/kml/jln_kab_hst.kml'> Kabupaten Hulu Sungai Tengah</option>
                                            <option value='https://bemadam.info/assets/kml/Scotland_routes.kmz'> Scotland</option>
                                            <option value='https://bemadam.info/assets/kml/kalimantan.kml'> Kalimantan</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-default btn-primary btn-block btn-flat" id="btnLihat" onclick="lihatJalan()"><i class="fa fa-search"></i> Lihat Jalan</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-body" style="height:750px;" id="map-canvas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" >
                <header class="bg-gray">
                    <h2><strong>Descripsi Jalan KaBupaten Hulu Sungai Tengah</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">

                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%">Id</th>
                                            <th>Description</th>
                                            <th>Koordinat</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($getXml->Document->Folder->Placemark as $key => $row) { ?>
                                        <tr>
                                            <td><?php echo $row->name; ?></td>
                                            <td>
                                                <?php
                                                $descrip = str_replace('<br>', ';', $row->description);
                                                $expDescrip = explode(';', $descrip);
                                                $no = 1;
                                                foreach ($expDescrip as $key => $rowDes) {
                                                    echo $no++ . '. ' . $rowDes . '<br>';
                                                }
                                                ?>


                                            </td>
                                            <!--<td><?php echo $row->LineString->coordinates ?></td>-->
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYamPgC83CJZIMoQbfkuju9-nnQ2iFdkQ&callback=initMap" async defer></script>
<script>
                                        var map;
                                        function initMap() {
                                            geocoder = new google.maps.Geocoder();
                                            var mapOptions = {
                                                zoom: 8,
                                                center: new google.maps.LatLng(-2.8441064, 115.568287),
                                                mapTypeId: google.maps.MapTypeId.HYBRID
                                            }
                                            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                                        }
                                        google.maps.event.addDomListener(window, 'load', initMap);

                                        function lihatJalan() {
                                            var jalan = document.getElementById('kabupaten').value;

                                            var jalanLayar = new google.maps.KmlLayer({
                                                url: jalan,
                                                map: map,
                                                zoom: 30
                                            })

                                        }
</script>