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
                    <h2><strong>Cetak Data Desa Sesuai dengan Pilihan yang ada</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <form action="<?= site_url('laporan/Laporan_desaPdf/data_desaPdf'); ?>" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Pilih Kabupaten</label>
                                        <div class="form-group">
                                            <select name='kd_kab' class="btn btn-default select2 kabupaten" style="width: 100%">
                                                <option value='0'> Pilih Kabupaten</option>
                                                <?php
                                                foreach ($get_dataKab as $kab) {
                                                    echo"<option value='$kab->kd_kab'>$kab->kd_kab. $kab->nama</option>";
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Pilih Kabupaten</label>
                                        <div class="form-group">
                                            <select name='kd_kec' class="btn btn-default select2 kecamatan" style="width: 100%">
                                                <?php
                                                if (!empty($kd_kab)) {
                                                    foreach ($get_dataKec as $kec) {
                                                        if ($kd_kab == $kec->kd_kab) {
                                                            echo"<option value='$kec->kd_kec'";
                                                            if ($kd_kec == $kec->kd_kec)
                                                                echo" selected";
                                                            echo">$kec->kd_kec. $kec->nama</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            </form>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-4">
                                        <label>Filter Status</label>
                                        <div class="form-group" >
                                            <select name='status' class="btn btn-default select2" style="width: 100%">
                                                <option value=''> Status Filter</option>
                                                <?php
                                                foreach ($get_statusIdm as $stt) {
                                                    echo"<option value='$stt->id'";
                                                    if ($status == $stt->id)
                                                        echo" selected";
                                                    echo">$stt->id. $stt->nama_status</option>";
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>-->
                                    <div class="col-md-2">
                                        <label>Tombol Cetak</label>
                                        <button type="submit" target="_blank" class="btn btn-danger btn-default btn-block"><i class="fa fa-print"></i>  <i class="fa fa-file-pdf-o"></i> Cetak</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p>Keterangan :</p>
                        <ol>
                            <li>Pilih Kabupaten Untuk Cetak Desa Perkabupaten</li>
                            <li>Pilih Kabupaten dan Pilih Kecamatan Untuk Cetak Desa Perkabupaten dan Perkecamatan</li>
                            <!--<li>Pilih Fiter status untuk cetak Desa Perstatus</li>-->
                        </ol>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<script>
    $(".kabupaten").change(function () {
        var kd_kab = $(this).val();
        $('.kd_kab').val(kd_kab);
        $.ajax({
            type: 'POST',
            url: '<?= site_url('database/Data_lokasi/loadKecamatan'); ?>',
            data: {kd_kab: kd_kab},
            success: function (data) {
                $('.kecamatan').html(data);
            }
        });
    });
</script>