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
        <article class="col-md-12">
            <div class="jarviswidget" >
                <header class="bg-gray">
                    <h2><strong>Penilaian IDM</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10">
                                    <?php
                                    $attr = 'data-toggle="modal" 
                                        data-target="#aksiPenilaian" 
                                        data-ket="tambah"';
                                    $ket = 'Penilaian IDM';
                                    btn_tambah($attr, $ket);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-active" width="10%">Tahun</th>
                                        <th class="bg-gray-active">Status Desa</th>
                                        <th class="bg-gray-active">Rata-rata Tertinggal</th>
                                        <th class="bg-gray-active">Rata-rata Berkembang</th>
                                        <th class="bg-gray-active">Rata-rata Maju</th>
                                        <th class="bg-gray-active">Rata-rata Mandiri</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_penilaianIdm as $row) {
                                        ?>
                                        <tr>
                                            <td ><?= $row->tahun; ?></td>
                                            <td class="text-center bg-gray" style="font-weight: bold; font-size: 12pt"> <?= $row->nama_status; ?></td>
                                            <td class="text-center"> (Kurang dari) < <?= $row->tertinggal; ?></td>
                                            <td class="text-center"> <?= $row->tertinggal; ?> >= S/D < <?= $row->berkembang; ?></td>
                                            <td class="text-center"> <?= $row->berkembang; ?> >= S/D < <?= $row->maju; ?></td>
                                            <td class="text-center">  >= <?= $row->maju; ?></td>
                                            <td class="text-center no-padding">
                                                <?php
                                                $attr = 'data-toggle="modal" 
                                                                data-target="#aksiPenilaian" 
                                                                data-tertinggal="' . $row->tertinggal . '" 
                                                                data-berkembang="' . $row->berkembang . '" 
                                                                data-maju="' . $row->maju . '" 
                                                                data-id_status="' . $row->id_status . '" 
                                                                data-ket="edit"';
                                                $ket_e = '';
                                                $class_e = '';
                                                btn_edit($attr, $ket_e, $class_e);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <!--        <article class="col-md-4">
                    <div class="jarviswidget" >
                        <header class="bg-gray">
                            <h2><strong>Setting Status Tahunan</strong></h2>				
                        </header>
                        <div>
                            <div class="widget-body">
                                <div class="widget-body-toolbar">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-6">
        <?php
        $attr = 'data-toggle="modal" 
                                        data-target="#aksiSetStatus" 
                                        data-ket="tambah"';
        $ket = 'Status Tahunan';
        btn_tambah($attr, $ket);
        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="bg-gray-active" width="20%">Tahun</th>
                                                <th class="bg-gray-active">Status</th>
                                                <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
        <?php
        $no = 1;
        foreach ($get_settingStatus as $row_stts) {
            ?>
                                                        <tr>
                                                            <td ><?= $row_stts->tahun; ?></td>
                                                            <td><?= $row_stts->nama_status; ?></td>
                                                            <td class="text-center no-padding">
            <?php
            $attr = 'data-toggle="modal" 
                                                                data-target="#aksiSetStatus" 
                                                                data-tahun="' . $row_stts->tahun . '" 
                                                                data-id_status="' . $row_stts->id_status . '" 
                                                                data-ket="edit"';
            $ket_e = '';
            $class_e = '';
            btn_edit($attr, $ket_e, $class_e);
            ?>
                                                            </td>
                                                        </tr>
            <?php
            $no++;
        }
        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>-->
    </div>
</section>
<div class="modal fade" id="aksiSetStatus" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <label>Tahun</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control select2 tahun" width="100%" name="tahun" required>
                                        <option value="">Pilih stats</option>
                                        <?php for ($i = 2016; $i < 2025; $i++) {
                                            ?>
                                            <option <?php
                                            if ($i == $a['tahun']) {
                                                echo "selected";
                                            }
                                            ?> value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Status</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control select2 status" width="100%" name="id_status" required>
                                        <option value="">Pilih stats</option>
                                        <?php foreach ($get_statusIdm as $status) { ?>
                                            <option value="<?= $status->id; ?>"><?= $status->nama_status; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
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
<div class="modal fade" id="aksiPenilaian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <label>Nilai Tertinggal</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="number" step="0.0001" class="form-control tertinggal" name="tertinggal" placeholder="Nilai Tertinggal" autofocus="true" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nilai Berkembang</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="number" step="0.0001" class="form-control berkembang" name="berkembang" placeholder="Nilai Berkembang" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nilai Maju</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="number" step="0.0001" class="form-control maju" name="maju" placeholder="Nilai Maju" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Status</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control select2 status" width="100%" name="id_status" required>
                                        <option value="">Pilih stats</option>
                                        <?php foreach ($get_statusIdm as $status) { ?>
                                            <option value="<?= $status->id; ?>"><?= $status->nama_status; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control ket" name="ket" />
                            <input type="hidden" class="form-control tahun" name="tahun" value="<?= $a['tahun']; ?>" />

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
    $('#aksiPenilaian').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var tertinggal = button.data('tertinggal');
        var berkembang = button.data('berkembang');
        var maju = button.data('maju');
        var id_status = button.data('id_status');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form').attr('action', '<?= site_url('database/Data_penilaian/aksiPenilaian'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data Penilaian</b>');
            modal.find('.modal-body input.tertinggal').val('');
            modal.find('.modal-body input.berkembang').val('');
            modal.find('.modal-body input.maju').val('');
            modal.find('.modal-body select.status').val('').change();
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data Penilaian</b>');
            modal.find('.modal-body input.tertinggal').val(tertinggal);
            modal.find('.modal-body input.berkembang').val(berkembang);
            modal.find('.modal-body input.maju').val(maju);
            modal.find('.modal-body select.status').val(id_status).change();
        }
    });

    $('#aksiSetStatus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var tahun = button.data('tahun');
        var status = button.data('id_status');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form').attr('action', '<?= site_url('database/Data_penilaian/aksiSetStatus'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Setting Status Penilaian</b>');
            modal.find('.modal-body select.tahun').attr('readonly', false);
            modal.find('.modal-body select.status').val(status).change();
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Setting Status Penilaian </b>');
            modal.find('.modal-body select.tahun').val(tahun).change().attr('readonly', true);
            modal.find('.modal-body select.status').val(status).change();
        }
    });

    function hapusSubBidang(kd_sub, nama_jabatan) {
        $.SmartMessageBox({
            title: "Form Hapus Data User",
            content: "Apakah Anda Yakin Menghapus Data SOTK Sub Bidang dengan nama : " + nama_jabatan + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_sotk/deleteSubBidang'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_sub: kd_sub},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(nama_jabatan + ' Berhasi di Hapus');
                        } else {
                            notif_alert_gagal('Gagal menghapus data');
                        }
                    }
                });
            }
        });
    }

</script>