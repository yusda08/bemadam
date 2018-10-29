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
                    <h2><strong>Tabel Slide Show</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10">
                                    <form action="<?= site_url('setting/Set_slide/tambahSlideShow'); ?>">
                                        <?php
                                        $attr = '';
                                        $ket = 'Slide Show';

                                        btn_tambah($attr, $ket)
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-active" width="5%">No</th>
                                        <th class="bg-gray-active">Judul</th>
                                        <th class="bg-gray-active">Ketrangan</th>
                                        <th class="bg-gray-active" width="5%"> Status</th>
                                        <th class="bg-gray-active" width="20%">Foto</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_slideShow as $row) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td ><?= $row->judul; ?></td>
                                            <td><?= $row->keterangan; ?></td>
                                            <td class="text-center">
                                                <div class="smart-form">
                                                    <label class="toggle">
                                                        <input  <?=
                                                        $m['rul_edit'];
                                                        if ($row->status == 'Y') {
                                                            echo "checked='checked'";
                                                        }
                                                        ?> onclick="aksiStatus('<?= $row->id; ?>', '<?= $row->status; ?>');" 
                                                            type="checkbox" name="checkbox-toggle">
                                                        <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                </div>
                                            </td>
                                            <td><img src="<?php linkImg('slide', $row->foto); ?>" class="img-responsive"></td>
                                            <td class="text-center no-padding">
                                                <form action="<?= site_url('setting/Set_slide/editSlideShow'); ?>">
                                                    <input name="id" class="form-control" type="hidden" value="<?=$row->id;?>">
                                                    <?php
                                                    $attr = '';
                                                    $ket_e = '';
                                                    $class_e = '';
                                                    btn_edit($attr, $ket_e, $class_e);
                                                    ?>
                                                </form>
                                                <button class="btn btn-danger btn-default" onclick="hapusSlideShow('<?= $row->id; ?>', '<?= $row->judul; ?>', '<?= $row->foto; ?>')"><i class="fa fa-trash"></i></button>
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
<script>
    function aksiStatus(id, status) {
        var url_form = '<?= site_url('setting/Set_slide/updateStatus'); ?>';
        $.ajax({
            type: 'POST',
            url: url_form,
            data: {id: id, status: status},
            success: function (data) {
                if (data == 'true') {
                    notif_alert_sukses('Berhasil Update');
                } else {
                    notif_alert_gagal('Gagal Update');
                }
            }
        });
    }
    function hapusSlideShow(id, judul, img) {
        $.SmartMessageBox({
            title: "Form Hapus Menu",
            content: "Apakah Anda Yakin Menghapus Slide Ini : "+judul+"<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('setting/Set_slide/deleteSlideShow'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {id: id, img:img},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses('Data Berhasil di Hapus');
                        } else {
                            notif_alert_gagal('Data Gagal di Hapus');
                        }
                    }
                });
            }
        });
    }
</script>