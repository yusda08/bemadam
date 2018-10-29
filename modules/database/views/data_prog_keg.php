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
                    <h2><strong>Tabel SOTK Bidang dan sub Bidang</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                    $attr = 'data-toggle="modal" 
                                        data-target="#tarik_program"';
                                    $ket = 'Tarik Tahun Lalu';
                                    btn_tambah($attr, $ket);
                                    ?>
                                </div>
                                <div class="col-md-2 col-md-offset-8">
                                    <?php
                                    $attr = 'data-toggle="modal" 
                                        data-target="#aksi_program" 
                                        data-ket="tambah"';
                                    $ket = 'Program';
                                    btn_tambah($attr, $ket);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered tabel_3" width="100%">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-active" width="8%">Kode</th>
                                        <th class="bg-gray-active">Nama Program / Kegiatan</th>
                                        <th class="bg-gray-active">Nama Bidang / Sub Bidang</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_dataProgram->result() as $row) {
                                        $kd_new_keg = $this->Model_basis->maxKeg($this->a['tahun'], $row->kd_prog);
                                        ?>
                                        <tr style="background-color: #ededed">
                                            <td ><?= $row->kd_prog; ?></td>
                                            <td ><?= $row->ket_program; ?></td>
                                            <td ><?= $row->nama_jabatan; ?></td>
                                            <td class="text-center no-padding">
                                                <?php
                                                $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_kegiatan" 
                                                                data-kd_prog="' . $row->kd_prog . '" 
                                                                data-kd_bid="' . $row->kd_bid . '" 
                                                                data-kd_keg="' . sprintf('%02s', $kd_new_keg) . '" 
                                                                data-ket="tambah"';
                                                $ket = 'Kegiatan';
                                                btn_tambah($attr, $ket);
                                                ?>
                                            </td>
                                            <td class="text-center no-padding">
                                                <?php
                                                $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_program" 
                                                                data-kd_prog="' . $row->kd_prog . '" 
                                                                data-kd_bid="' . $row->kd_bid . '" 
                                                                data-ket_program="' . $row->ket_program . '" 
                                                                data-ket="edit"';
                                                $ket_e = '';
                                                $class_e = '';
                                                btn_edit($attr, $ket_e, $class_e);
                                                ?>
                                                <button <?=$m['rul_hapus'];?> class="btn btn-danger btn-default" onclick="hapusProgram('<?= $row->kd_prog; ?>', '<?= $row->tahun; ?>', '<?= $row->ket_program; ?>')"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        foreach ($get_dataKegiatan->result() as $row_keg) {
                                            if ($row_keg->kd_prog == $row->kd_prog) {
                                                ?>    

                                                <tr >
                                                    <td ><?= $row->kd_prog . '.' . $row_keg->kd_keg; ?></td>
                                                    <td ><?= $row_keg->ket_kegiatan; ?></td>
                                                    <td ><?= $row_keg->nama_jabatan; ?></td>
                                                    <td class="text-center no-padding"></td>
                                                    <td class="text-center no-padding">
                                                        <?php
                                                        $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_kegiatan" 
                                                                data-kd_prog="' . $row_keg->kd_prog . '" 
                                                                data-kd_sub="' . $row_keg->kd_sub . '" 
                                                                data-kd_keg="' . $row_keg->kd_keg . '" 
                                                                data-ket_kegiatan="' . $row_keg->ket_kegiatan . '" 
                                                                data-ket="edit"';
                                                        $ket_e = '';
                                                        $class_e = '';
                                                        btn_edit($attr, $ket_e, $class_e);
                                                        ?>
                                                        <button <?=$m['rul_hapus'];?> class="btn btn-danger btn-default" onclick="hapusKegiatan('<?= $row_keg->kd_keg; ?>', '<?= $row_keg->kd_prog; ?>', '<?= $row_keg->tahun; ?>', '<?= $row_keg->ket_kegiatan; ?>')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
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
    </div>
</section>
<div class="modal fade" id="tarik_program" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_bidang" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Pilih Tahun</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control select2 tahun" name="tahun" width="100%" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php for ($i = 2015; $i < $a['tahun']; $i++) { ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
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
<div class="modal fade" id="aksi_program" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_bidang" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Kode Program</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control kd_prog" name="kd_prog" placeholder="Kode Perogram" value="<?= sprintf('%02s', $kd_new); ?>" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nama Program</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control ket_program" name="ket_program" placeholder="Nama Program" autofocus="true" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Pilih Bidang</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control select2 kd_bid" name="kd_bid" width="100%">
                                        <option value="">-- Pilih Bidang --</option>
                                        <?php foreach ($get_dataBidang->result() as $row_bid) { ?>
                                            <option value="<?= $row_bid->kd_bid; ?>"><?= $row_bid->nama_jabatan; ?></option>
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
<div class="modal fade" id="aksi_kegiatan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_kegiatan" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Kode Kegiatan</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control kd_keg" name="kd_keg" placeholder="Kode Kegiatan" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nama Kegiatan</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control ket_kegiatan" name="ket_kegiatan" placeholder="Nama Kegiatan" autofocus="true" required />
                                </div>
                            </div>
                            <!--                            <div class="col-md-3">
                                                            <label>Pilih Sub Bidang</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <select class="form-control select2 kd_sub" name="kd_sub" width="100%">
                                                                    <option value="">-- Pilih Bidang --</option>
                            <?php foreach ($get_dataSubBidang->result() as $row_sub) { ?>
                                                                                <option value="<?= $row_sub->kd_sub; ?>"><?= $row_sub->nama_jabatan; ?></option>
                            <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>-->
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control ket" name="ket" />
                            <input type="hidden" class="form-control kd_prog" name="kd_prog" />
                            <input type="hidden" class="form-control kd_bid" name="kd_bid" />
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
    $('#tarik_program').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find('.label_head').html('<b>Form Tarik Data Program</b>');
        modal.find('.aksi_form_bidang').attr('action', '<?= site_url('database/Data_prog_keg/tarikProgramTahun'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
    });
    $('#aksi_program').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var kd_prog = button.data('kd_prog');
        var ket_program = button.data('ket_program');
        var kd_bid = button.data('kd_bid');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form_bidang').attr('action', '<?= site_url('database/Data_prog_keg/aksiProgram'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data Program</b>');
            modal.find('.modal-body select.kd_bid').val('').change();
            modal.find('.modal-body input.kd_prog').attr('readonly', false);
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data Program</b>');
            modal.find('.modal-body select.kd_bid').val(kd_bid).change();
            modal.find('.modal-body input.ket_program').val(ket_program);
            modal.find('.modal-body input.kd_prog').val(kd_prog).attr('readonly', true);
        }
    });
    $('#aksi_kegiatan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var kd_prog = button.data('kd_prog');
        var ket_kegiatan = button.data('ket_kegiatan');
        var kd_keg = button.data('kd_keg');
        var kd_sub = button.data('kd_sub');
        var kd_bid = button.data('kd_bid');
//        alert(kd_bid)
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.modal-body input.kd_prog').val(kd_prog);
        modal.find('.modal-body input.kd_bid').val(kd_bid);
        modal.find('.aksi_form_kegiatan').attr('action', '<?= site_url('database/Data_prog_keg/aksiKegiatan'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data Kegiatan</b>');
            modal.find('.modal-body select.kd_sub').val('').change();
            modal.find('.modal-body select.ket_kegiatan').val('');
            modal.find('.modal-body input.kd_keg').val(kd_keg).attr('readonly', false);
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data Kegiatan</b>');
            modal.find('.modal-body select.kd_sub').val(kd_sub).change();
            modal.find('.modal-body input.ket_kegiatan').val(ket_kegiatan);
            modal.find('.modal-body input.kd_keg').val(kd_keg).attr('readonly', true);
        }
    });

    function hapusProgram(kd_prog, tahun, ket_program) {
        $.SmartMessageBox({
            title: "Form Hapus Data Program",
            content: "Apakah Anda Yakin Menghapus Data Program dengan Ket : " + ket_program + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_prog_keg/deleteProgram'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_prog: kd_prog, tahun: tahun},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(ket_program + ' Berhasi di Hapus');
                        } else {
                            notif_alert_gagal('Gagal menghapus data');
                        }
                    }
                });
            }
        });
    }
    function hapusKegiatan(kd_keg, kd_prog, tahun, ket_kegiatan) {
        $.SmartMessageBox({
            title: "Form Hapus Data Kegiatan",
            content: "Apakah Anda Yakin Menghapus Data Kegiatan dengan Ket : " + ket_kegiatan + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_prog_keg/deleteKegiatan'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_keg: kd_keg, kd_prog: kd_prog, tahun: tahun, },
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(ket_kegiatan + ' Berhasi di Hapus');
                        } else {
                            notif_alert_gagal('Gagal menghapus data');
                        }
                    }
                });
            }
        });
    }

</script>