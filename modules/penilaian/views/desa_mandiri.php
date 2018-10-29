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
                                        <select name='kabupaten' class="btn btn-default select2 kabupaten" style="width: 100%">
                                            <option value=''> Pilih Kabupaten</option>
                                            <?php
                                            foreach ($get_dataKab as $kab) {
                                                echo"<option value='$kab->kd_kab'";
                                                if ($kd_kab == $kab->kd_kab)
                                                    echo" selected";
                                                echo">$kab->kd_kab. $kab->nama</option>";
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Pilih Kecamatan</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <form name='fkec' method='get' >
                                            <select name='kd_kec' class="btn btn-default select2 kecamatan" style="width: 100%"  onchange='document.fkec.submit();'>
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
                                            <input class="form-control kd_kab" name="kd_kab" type="hidden" value="<?= $kd_kab; ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($kd_kab) and ! empty($kd_kec)) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-active" width="8%">Kode</th>
                                            <th class="bg-gray-active" width="10%">Tipe</th>
                                            <th class="bg-gray-active">Nama Desa</th>
                                            <th class="bg-gray-active">Jumlah Bidang</th>
                                            <th class="bg-gray-active">Jumlah Kegiatan</th>
                                            <th class="bg-gray-active">Status</th>
                                            <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                        $no = 1;
                                        foreach ($get_dataDesa as $row) {
                                            if ($kd_kab == $row->kd_kab and $kd_kec == $row->kd_kec){
                                                    $jml_bid = $row->jml_bid;
                                                    $jml_keg = $row->jml_keg;
                                                    $status_desa = $row->status_desa;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $row_prov->kd_prov . '.' . sprintf('%02s', $kd_kab) . '.' . sprintf('%02s', $kd_kec) . '.' . $row->kd_desa; ?></td>
                                                    <td ><?= $row->tipe; ?></td>
                                                    <td ><?= $row->nama; ?></td>
                                                    <td class="text-center" >
                                                        <?php
                                                        if ($jml_bid >= 4) {
                                                            echo '<label class="label label-success">' . $jml_bid . ' Bidang</label>';
                                                        } elseif ($jml_bid > 0 and $jml_bid < 4) {
                                                            echo '<label class="label label-warning">' . $jml_bid . ' Bidang</label>';
                                                        } else {
                                                            echo '<label class="label label-danger">NULL</label>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($jml_keg >= 4) {
                                                            echo '<label class="label label-success">' . $jml_keg . ' Kegiatan</label>';
                                                        } elseif ($jml_keg > 0 and $jml_keg < 4) {
                                                            echo '<label class="label label-warning">' . $jml_keg . ' Kegiatan</label>';
                                                        } else {
                                                            echo '<label class="label label-danger">NULL</label>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if($status_desa == 'Belum Mandiri'){ ?> 
                                                        <label class="label label-warning"><?= $status_desa; ?></label>
                                                        <?php }else{ ?>
                                                        <label class="label label-primary"><?= $status_desa; ?></label>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center no-padding">
                                                        <a href="<?= site_url('penilaian/Desa_mandiri/inputKegiatan?kd_kab=' . $kd_kab . '&kd_kec=' . $kd_kec . '&kd_desa=' . $row->kd_desa); ?>" class="btn btn-default btn-primary"><i class="fa fa-search"></i> Kegiatan</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<div class="modal fade" id="aksi_desa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_desa" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Kode Desa</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control kd_desa" name="kd_desa" placeholder="Kode Desa" value="<?= $kd_new; ?>" required />
                                    <note><u><i>Kode Default sudah tersedia, silakan edit kode apabila berbeda.</i></u></note>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nama Desa</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control nama" name="nama" placeholder="Nama Desa" autofocus="true" required />
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control kd_kab" name="kd_kab" value="<?= $kd_kab; ?>"/>
                            <input type="hidden" class="form-control kd_kec" name="kd_kec" value="<?= $kd_kec; ?>"/>
                            <input type="hidden" class="form-control ket" name="ket" />

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="submit"></div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $('#aksi_desa').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var kd_desa = button.data('kd_desa');
        var nama = button.data('nama');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form_desa').attr('action', '<?= site_url('database/Data_lokasi/aksiDesa'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data Desa</b>');
            modal.find('.modal-body input.nama').val('');
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data Desa</b>');
            modal.find('.modal-body input.nama').val(nama);
            modal.find('.modal-body input.kd_desa').val(kd_desa).attr('readonly', true);
        }
    });

    function hapusDesa(kd_kab, kd_kec, kd_desa, nama) {
        $.SmartMessageBox({
            title: "Form Hapus Data User",
            content: "Apakah Anda Yakin Menghapus Data Kecamatan dengan nama : " + nama + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_lokasi/deleteDesa'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_kab: kd_kab, kd_kec: kd_kec, kd_desa: kd_desa},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(nama + ' Berhasi di Hapus');
                        } else {
                            notif_alert_gagal('Gagal menghapus data');
                        }
                    }
                });
            }
        });
    }

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