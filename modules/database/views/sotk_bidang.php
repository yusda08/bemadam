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
                                <div class="col-md-2 col-md-offset-10">
                                    <?php
                                    $attr = 'data-toggle="modal" 
                                        data-target="#aksi_bidang" 
                                        data-ket="tambah"';
                                    $ket = 'Bidang';
                                    btn_tambah($attr, $ket);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-active" width="5%">No</th>
                                        <th class="bg-gray-active">Nama Bidang / Sub Bidang</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_dataBidang as $row) {
                                        ?>
                                        <tr style="background-color: #ededed">
                                            <td><?= $no; ?></td>
                                            <td ><?= $row->nama_jabatan; ?></td>
                                            <td class="text-center no-padding">
                                                <?php
                                                $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_sub_bidang" 
                                                                data-kd_bid="'.$row->kd_bid.'" 
                                                                    data-nama_bidang="' . $row->nama_jabatan . '" 
                                                                data-ket="tambah"';
                                                $ket = 'Sub Bidang';
                                                btn_tambah($attr, $ket);
                                                ?>
                                            </td>
                                            <td class="text-center no-padding">
                                                <?php
                                                $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_bidang" 
                                                                data-kd_bid="' . $row->kd_bid . '" 
                                                                    data-nama_jabatan="'.$row->nama_jabatan.'" 
                                                                data-ket="edit"';
                                                $ket_e = '';
                                                $class_e = '';
                                                btn_edit($attr, $ket_e, $class_e);
                                                ?>
                                                <button <?=$m['rul_hapus'];?> class="btn btn-danger btn-default" onclick="hapusBidang('<?= $row->kd_bid; ?>', '<?= $row->nama_jabatan; ?>')"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        $no_s = 1;
                                        foreach ($get_dataSubBidang as $row_sub) {
                                            if ($row_sub->kd_bid == $row->kd_bid) {
                                                ?>
                                                <tr>
                                                    <td><?= $no . '.' . $no_s++; ?></td>
                                                    <td ><?= $row_sub->nama_jabatan; ?></td>
                                                    <td ></td>
                                                    <td class="text-center no-padding">
                                                        <?php
                                                        $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_sub_bidang" 
                                                                data-kd_sub="'.$row_sub->kd_sub.'" 
                                                                data-kd_bid="'.$row_sub->kd_bid.'" 
                                                                data-nama_bidang="' . $row->nama_jabatan . '"
                                                                data-nama_jabatan="'.$row_sub->nama_jabatan.'" 
                                                                data-ket="edit"';
                                                        $ket_e = '';
                                                        $class_e = '';
                                                        btn_edit($attr, $ket_e, $class_e);
                                                        ?>
                                                        <button <?=$m['rul_hapus'];?> class="btn btn-danger btn-default" onclick="hapusSubBidang('<?= $row_sub->kd_sub; ?>', '<?= $row_sub->nama_jabatan; ?>')"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="aksi_bidang" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <label>Nama Bidang</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control nama_jabatan" name="nama_jabatan" placeholder="Nama Bidang" autofocus="true" required />
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control ket" name="ket" />
                            <input type="hidden" class="form-control kd_bid" name="kd_bid" />
                            <input type="hidden" class="form-control kd_unit" name="kd_unit" value="1" />

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
<div class="modal fade" id="aksi_sub_bidang" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_sub" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="alert alert-info text-center nama_bidang"></h3>
                            <div class="col-md-3">
                                <label>Nama Sub Bidang</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control nama_jabatan" name="nama_jabatan" placeholder="Nama Sub Bidang" autofocus="true" required />
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control ket" name="ket" />
                            <input type="hidden" class="form-control kd_bid" name="kd_bid" />
                            <input type="hidden" class="form-control kd_sub" name="kd_sub" />

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
    $('#aksi_bidang').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var kd_bid = button.data('kd_bid');
        var nama_jabatan = button.data('nama_jabatan');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.aksi_form_bidang').attr('action', '<?= site_url('database/Data_sotk/aksiBidang'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data SOTK Bidang</b>');
            modal.find('.modal-body input.kd_bid').val('');
            modal.find('.modal-body input.nama_jabatan').val('');
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data SOTK Bidang</b>');
            modal.find('.modal-body input.kd_bid').val(kd_bid);
            modal.find('.modal-body input.nama_jabatan').val(nama_jabatan);
        }
    });
    $('#aksi_sub_bidang').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var nama_bidang = button.data('nama_bidang');
        var kd_bid = button.data('kd_bid');
        var kd_sub = button.data('kd_sub');
        var nama_jabatan = button.data('nama_jabatan');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.nama_bidang').text(nama_bidang);
        modal.find('.modal-body input.kd_bid').val(kd_bid);
        modal.find('.aksi_form_sub').attr('action', '<?= site_url('database/Data_sotk/aksiSubBidang'); ?>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        if (ket == 'tambah') {
            modal.find('.label_head').html('<b>Form Tambah Data SOTK Sub Bidang</b>');
            modal.find('.modal-body input.kd_sub').val('');
            modal.find('.modal-body input.nama_jabatan').val('');
        } else if (ket == 'edit') {
            modal.find('.label_head').html('<b>Form Edit Data SOTK Sub Bidang</b>');
            modal.find('.modal-body input.kd_sub').val(kd_sub);
            modal.find('.modal-body input.nama_jabatan').val(nama_jabatan);
        }
    });

    function hapusBidang(kd_bid, nama_jabatan) {
        $.SmartMessageBox({
            title: "Form Hapus Data User",
            content: "Apakah Anda Yakin Menghapus Data SOTK Bidang dengan nama : " + nama_jabatan + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('database/Data_sotk/deleteBidang'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_bid: kd_bid},
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