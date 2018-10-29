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
                    <h2><strong>Tabel Bidang dan Kegiatan</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <legend class="text-center">
                                        <h2 class="alert bg-gray-active"><?= $row_nl->kd_prov . '.' . sprintf('%02s', $kd_kab) . '.' . sprintf('%02s', $kd_kec) . '.' . sprintf('%02s', $kd_desa) . ' - ' . $row_nl->tipe . ' ' . $row_nl->nama; ?>
                                            <br>
                                            <small>Tahun Anggaran : <?= $tahun; ?></small>
                                        </h2>
                                    </legend>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?= site_url('penilaian/Desa_mandiri?kd_kec=' . $kd_kec . '&kd_kab=' . $kd_kab); ?>" class="btn btn-danger btn-default btn-block"><i class="fa fa-backward"></i> Kembali</a>
                                </div>
                                <div class="col-md-2 col-md-offset-8">
                                    <?php
                                    $attr = 'data-toggle="modal" 
                                                                data-target="#aksi_kegiatan" 
                                                                data-ket="tambah"';
                                    $ket = 'Kegiatan';
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
                                        <th class="bg-gray-active">Bidang / Kegiatan</th>
                                        <th class="bg-gray-active">Keterangan</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_bidangDesa as $row_bid) { ?>
                                        <tr style="background-color: #ededed">
                                            <td><?= sprintf('%02s', $row_bid->kd_bid); ?></td>
                                            <td><?= $row_bid->nama_jabatan; ?></td>
                                            <td class="text-center">BIDANG</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($get_kegiatanDesa as $row_keg) {
                                            if ($row_keg->kd_bid == $row_bid->kd_bid ) {
                                                ?>
                                                <tr>
                                                    <td><?= sprintf('%02s', $row_bid->kd_bid) . '.' . sprintf('%02s', $row_keg->kd_prog) . '.' . sprintf('%02s', $row_keg->kd_keg); ?></td>
                                                    <td><?= $row_keg->ket_kegiatan; ?></td>
                                                    <td class="text-center">KEGIATAN</td>
                                                    <td class="text-center no-padding">
                                                        <button class="btn btn-danger btn-default" <?=$m['rul_hapus'];?> onclick="hapusKegiatan('<?= $row_keg->kd_prov; ?>', '<?= $row_keg->kd_kab; ?>',
                                                                        '<?= $row_keg->kd_kec; ?>', '<?= $row_keg->kd_desa; ?>', '<?= $row_keg->kd_keg; ?>', '<?= $row_keg->kd_prog; ?>',
                                                                        '<?= $row_keg->tahun; ?>', '<?= $row_keg->ket_kegiatan; ?>')"><i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </article>
    </div>
</section>
<div class="modal fade" id="aksi_kegiatan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form" method="POST" action="<?= site_url('penilaian/Desa_mandiri/aksiKegiatan'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Pilih Kegiatan</label>
                                <div class="form-group">
                                    <select class="form-control select2 kegiatan" name="kd_keg" width="100%" required>
                                        <option value="">-- Pilih Kegiatan --</option>
                                        <?php 
                                        $no = 1;
                                        foreach ($get_dataBidang as $row_bd) { ?>
                                        <option disabled=""><span style="background-color: #ededed"><?= $no++.'. BIDANG '.$row_bd->nama_jabatan; ?></span></option>
                                            <?php
                                            foreach ($get_dataKegiatan as $row) {
                                                if ($row->kd_bid == $row_bd->kd_bid) {
                                                    ?>
                                                    <option data-kd_prog='<?= $row->kd_prog; ?>' value="<?= $row->kd_keg; ?>"><?= $row->ket_kegiatan; ?></option>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control kd_prov" name="kd_prov" value="<?= $row_prov->kd_prov; ?>"/>
                            <input type="hidden" class="form-control kd_kab" name="kd_kab" value="<?= $kd_kab; ?>"/>
                            <input type="hidden" class="form-control kd_kec" name="kd_kec" value="<?= $kd_kec; ?>"/>
                            <input type="hidden" class="form-control kd_desa" name="kd_desa" value="<?= $kd_desa; ?>"/>
                            <input type="hidden" class="form-control tahun" name="tahun" value="<?= $tahun; ?>"/>
                            <input type="hidden" class="form-control kd_prog" name="kd_prog" required/>
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
    $(".kegiatan").change(function () {
        var kd_prog = $(".kegiatan").find('option:selected').data('kd_prog');
        $('.kd_prog').val(kd_prog);
    });

    $('#aksi_kegiatan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        modal.find('.label_head').html('<b>Form Tambah Data Kegiatan</b>');
        modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
    });

    function hapusKegiatan(kd_prov, kd_kab, kd_kec, kd_desa, kd_keg, kd_prog, tahun, ket_keg) {
        $.SmartMessageBox({
            title: "Form Hapus Data Penilaian Desa (Kegiatan)",
            content: "Apakah Anda Yakin Menghapus Data Penilaian Desa (Kegiatan) dengan nama : " + ket_keg + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('penilaian/Desa_mandiri/deleteKegiatan'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_prov: kd_prov, kd_kab: kd_kab, kd_kec: kd_kec, kd_desa: kd_desa, tahun: tahun, kd_prog: kd_prog, kd_keg: kd_keg},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(ket_keg + ' Berhasi di Hapus');
                        } else {
                            notif_alert_gagal('Gagal menghapus data');
                        }
                    }
                });
            }
        });
    }

</script>