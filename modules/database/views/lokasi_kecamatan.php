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
                    <h2><strong>Tabel Data Kecamatan</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2">Pilih Kabupaten</div>
                                <div class="col-md-4">
                                    <form name='fkab' method='get' >
                                        <select name='kd_kab' class="btn btn-default select2" style="width: 100%" onchange='document.fkab.submit();'>
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
                                    </form>
                                </div>
                                <div class="col-md-2 col-md-offset-4">
                                    <?php
                                    if (!empty($kd_kab)) {
                                        $attr = 'data-toggle="modal" 
                                                    data-target="#aksi_kecamatan" 
                                                    data-ket="tambah"';
                                        $ket = 'Kecamatan';
                                        btn_tambah($attr, $ket);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($kd_kab)) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-active" width="8%">Kode</th>
                                            <th class="bg-gray-active">Tipe</th>
                                            <th class="bg-gray-active">Nama Kecamatan</th>
                                            <th class="bg-gray-active" width="8%">Desa</th>
                                            <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $jml = count($get_dataKec);
                                        foreach ($get_dataKec as $row) {
                                            if ($kd_kab == $row->kd_kab) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $row_prov->kd_prov . '.' . sprintf('%02s', $kd_kab) . '.' . sprintf('%02s', $row->kd_kec); ?></td>
                                                    <td width="8%"><?= $row->tipe; ?></td>
                                                    <td ><?= $row->nama; ?></td>
                                                    <td class="no-padding">
                                                        <a class="btn btn-default btn-block btn-flat" href="<?= site_url('database/Data_lokasi/lokasi_desa?kd_kab=' . $kd_kab . '&kd_kec=' . $row->kd_kec); ?>">
                                                            <i class="fa fa-search"></i> Desa</a>
                                                    </td>

                                                    <td class="text-center no-padding">
                                                        <?php
                                                        $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_kecamatan" 
                                                                data-kd_kec="' . $row->kd_kec . '" 
                                                                data-nama="' . $row->nama . '" 
                                                                data-ket="edit"';
                                                        $ket_e = '';
                                                        $class_e = '';
                                                        btn_edit($attr, $ket_e, $class_e);
                                                        ?>
                                                        <button <?=$m['rul_hapus'];?> class="btn btn-danger btn-default" onclick="hapusKec('<?= $kd_kab; ?>', '<?= $row->kd_kec; ?>', '<?= $row->nama; ?>')"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="aksi_kecamatan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_kecamatan" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Kode Kecamatan</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control kd_kec" name="kd_kec" placeholder="Kode Kecamatan" value="<?= $kd_new; ?>" required />
                                    <note><u><i>Kode Default sudah tersedia, silakan edit kode apabila berbeda.</i></u></note>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nama Kecamatan</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control nama" name="nama" placeholder="Nama Kecamatan" autofocus="true" required />
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control kd_kab" name="kd_kab" value="<?= $kd_kab; ?>"/>
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
    $('#aksi_kecamatan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var kd_kec = button.data('kd_kec');
        var nama = button.data('nama');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form_kecamatan').attr('action', '<?= site_url('database/Data_lokasi/aksiKecamatan'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data Kecamatan</b>');
            modal.find('.modal-body input.nama').val('');
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data Kecamatan</b>');
            modal.find('.modal-body input.nama').val(nama);
            modal.find('.modal-body input.kd_kec').val(kd_kec).attr('readonly', true);
        }
    });

    function hapusKec(kd_kab, kd_kec, nama) {
        $.SmartMessageBox({
            title: "Form Hapus Data User",
            content: "Apakah Anda Yakin Menghapus Data Kecamatan dengan nama : " + nama + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_lokasi/deleteKecamatan'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_kab: kd_kab, kd_kec: kd_kec},
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

</script>