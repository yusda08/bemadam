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
                                    <form name='fkec' method='get' >
                                        <div class="form-group">
                                            <select name='kd_kab' onchange='document.fkec.submit();' class="btn btn-default select2 kabupaten" style="width: 100%">
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
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <form method='get' >
                                    <div class="col-md-2">Filter Status</div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <select name='status' class="btn btn-default select2 statusIdm" style="width: 100%">
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
                                            <input class="form-control kd_kab" type="hidden"  name="kd_kab" value="<?= $kd_kab; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2"><button type="submit" class="btn btn-info btn-default btn-block"><i class="fa fa-search"></i> Filter</button></div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered tabel_3" width="100%">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-active" width="8%">Kode</th>
                                        <th class="bg-gray-active" width="15%">Kecamatan</th>
                                        <th class="bg-gray-active">Nama Desa</th>
                                        <th class="bg-gray-active">Bidang</th>
                                        <th class="bg-gray-active">Kegiatan</th>
                                        <th class="bg-gray-active" width="10%">IKS</th>
                                        <th class="bg-gray-active" width="10%">IKE</th>
                                        <th class="bg-gray-active" width="10%">IKL</th>
                                        <th class="bg-gray-active">Jumlah</th>
                                        <th class="bg-gray-active">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($get_viewDesaNilai as $row) {
                                        $stts_ds = $row->stts_desa;
                                        if ($stts_ds == 'Mandiri') {
                                            $bg_color = 'bg-info';
                                        } elseif ($stts_ds == 'Maju') {
                                            $bg_color = 'bg-success';
                                        } elseif ($stts_ds == 'Berkembang') {
                                            $bg_color = 'bg-warning';
                                        } elseif ($stts_ds == 'Tertinggal') {
                                            $bg_color = 'bg-danger';
                                        } else {
                                            $bg_color = '';
                                        }
                                        ?>
                                        <tr id="bg_color<?= $row->kd_prov . $row->kd_kab . $row->kd_kec . $row->kd_desa . $a['tahun']; ?>" class="<?= $bg_color; ?>">
                                            <td class="text-center"><?= $row->kd_prov . '.' . sprintf('%02s', $row->kd_kab) . '.' . sprintf('%02s', $row->kd_kec) . '.' . $row->kd_desa; ?></td>
                                            <td><?= $row->nm_kec; ?></td>
                                            <td><?= $row->nama; ?></td>
                                            <td class="text-center"><?= !is_null($row->jml_bid) ? $row->jml_bid . ' Bidang' : 'NULL'; ?> </td>
                                            <td class="text-center"><?= !is_null($row->jml_keg) ? $row->jml_keg . ' Kegiatan' : 'NULL'; ?> </td>
                                            <td class="text-center "><?= $row->iks; ?></td>
                                            <td class="text-center "><?= $row->ike; ?></td>
                                            <td class="text-center "><?= $row->ikl; ?></td>
                                            <td class="text-center"><?= $row->jml_idm; ?></td>
                                            <td class="text-center"><?= $stts_ds; ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
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