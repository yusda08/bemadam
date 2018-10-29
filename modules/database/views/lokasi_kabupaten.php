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
            <legend class="text-center">
                <h2><?= $row_prov->kd_prov; ?> - <a data-placement="bottom" href="#" id="<?= $row_prov->kd_prov; ?>" ><?= $row_prov->nama; ?></a></h2>
                <script>
                    $(document).ready(function () {
                        $('#<?= $row_prov->kd_prov; ?>').editable({
                            type: 'textarea',
                            pk: 1,
                            url: '<?= site_url('database/Data_lokasi/editProvinsi'); ?>',
                            title: 'Edit Nama Urusan'
                        });
                    });
                </script>
            </legend>
            <div class="jarviswidget" >
                <header class="bg-gray">
                    <h2><strong>Tabel Data Kabupaten</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10">
                                    <?php
                                    $attr = 'data-toggle="modal" 
                                                    data-target="#aksi_kab" 
                                                    data-ket="tambah"';
                                    $ket = 'Kabupaten';
                                    btn_tambah($attr, $ket);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-active" width="8%">Kode</th>
                                        <th class="bg-gray-active">Nama Kabupaten</th>
                                        <th class="bg-gray-active" width="8%">Kecamatan</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_dataKab as $row) {
                                        $kd_kab = $row->kd_kab;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $row_prov->kd_prov . '.' . sprintf('%02s', $kd_kab); ?></td>
                                            <td ><?= $row->nama; ?></td>
                                            <td class="no-padding">
                                                <a class="btn btn-default btn-block btn-flat" href="<?= site_url('database/Data_lokasi/lokasi_kecamatan?kd_kab=' . $kd_kab); ?>">
                                                    <i class="fa fa-search"></i> Kecamatan</a>
                                            </td>

                                            <td class="text-center no-padding">
                                                <?php
                                                $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_kab" 
                                                                data-kd_kab="' . $row->kd_kab . '" 
                                                                data-nama="' . $row->nama . '" 
                                                                data-ket="edit"';
                                                $ket_e = '';
                                                $class_e = '';
                                                btn_edit($attr, $ket_e, $class_e);
                                                ?>
                                                <button <?=$m['rul_hapus'];?> class="btn btn-danger btn-default" onclick="hapusKab('<?= $kd_kab; ?>', '<?= $row->kd_prov; ?>', '<?= $row->nama; ?>')"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<div class="modal fade" id="aksi_kab" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Kode Kabupaten</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control kd_kab" name="kd_kab" placeholder="Kode Kabupaten" value="<?= $kd_new; ?>" required />
                                    <note><u><i>Kode Default sudah tersedia, silakan edit kode apabila berbeda.</i></u></note>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nama Kabupaten</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control nama" name="nama" placeholder="Nama Kabupaten" autofocus="true" required />
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control kd_prov" name="kd_prov" value="<?= $row_prov->kd_prov; ?>" />
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
    $('#aksi_kab').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var kd_kab = button.data('kd_kab');
        var nama = button.data('nama');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form').attr('action', '<?= site_url('database/Data_lokasi/aksiKabupaten'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data Kabupaten</b>');
            modal.find('.modal-body input.nama').val('');
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data Kabupaten</b>');
            modal.find('.modal-body input.nama').val(nama);
            modal.find('.modal-body input.kd_kab').val(kd_kab).attr('readonly', true);
        }
    });

    function hapusKab(kd_kab, kd_prov, nama) {
        $.SmartMessageBox({
            title: "Form Hapus Data User",
            content: "Apakah Anda Yakin Menghapus Data Kabupaten dengan nama : " + nama + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_lokasi/deleteKabupaten'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_kab: kd_kab, kd_prov: kd_prov},
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