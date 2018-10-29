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
                    <h2><strong>Tabel User</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <form name='flevel_user' method='get' >
                                        <select name='kd_level' class="btn btn-default select2" style="width: 100%"  onchange='document.flevel_user.submit();'>
                                            <option value=''> Pilih Level User </option>
                                            <?php
                                            foreach ($get_levelUser as $row_lvl) {
                                                echo"<option value='$row_lvl->kd_level'";
                                                if ($kd_level == $row_lvl->kd_level)
                                                    echo" selected";
                                                echo">$row_lvl->kd_level. $row_lvl->ket_level</option>";
                                            }
                                            ?>
                                        </select> 
                                    </form>
                                </div>
                                <?php if (!empty($kd_level)) { ?>
                                    <span class="pull-right">
                                        <div class="col-md-12">
                                            <?php
                                            $attr = 'data-toggle="modal" 
                                                    data-target="#aksi_user" 
                                                    data-kd_level="' . $kd_level . '" 
                                                    data-kd_user="' . $kd_new . '" 
                                                    data-ket="tambah"';
                                            $ket = 'User';
                                            btn_tambah($attr, $ket);
                                            ?>
                                        </div>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <?php if (!empty($kd_level)) { ?>
                                <!--</div>-->
                                <table class="tabel_2 table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-active" width="5%"><i class="fa fa-key text-warning"></i> No</th>

                                            <th class="bg-gray-active">Username</th>
                                            <th class="bg-gray-active">Password</th>
                                            <th class="bg-gray-active">Nama User</th>
                                            <th class="bg-gray-active">Status</th>
                                            <th class="bg-gray-active">Info</th>
                                            <th class="bg-gray-active">Email</th>
                                            <th class="bg-gray-active">No Telpon</th>

                                            <th class="bg-gray-active" width="3%"><i class="fa fa-trash"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($get_user as $row) {
                                            if ($kd_level == $row->kd_level) {
                                                $disabled = '';
                                                if ($kd_level == 1) {
                                                    if ($row->kd_user == $a['kd_user']) {
                                                        $disabled = 'disabled';
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>    
                                                    <td><?= $row->username; ?></td>
                                                    <td><?= $row->password; ?></td>
                                                    <td><?= $row->nama_user; ?></td>
                                                    <td>
                                                        <div class="smart-form">
                                                            <label class="toggle">
                                                                <input  <?=$m['rul_edit'].' '. $disabled . ' ';
                                                                if ($row->is_active == 1) {
                                                                    echo "checked='checked'";
                                                                }
                                                                ?> onclick="aksi_kunci('<?= $row->kd_user; ?>', '<?= $row->is_active; ?>');" 
                                                                    type="checkbox" name="checkbox-toggle">
                                                                <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                        </div>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($row->is_login == 0) { ?>
                                                            <label class="label label-danger">Offline</label>
                                                        <?php } else { ?>
                                                            <label class="label label-success">Online</label>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center"><?= $row->email; ?></td>
                                                    <td class="text-center"><?= $row->no_telpon; ?></td>
                                                    <td class="text-center">
                                                        
                                                        <button  <?= $disabled.' '.$m['rul_hapus']; ?> class="btn btn-danger btn-xs btn-flat btn-block" onclick="hapus_user('<?= $row->kd_user; ?>', '<?= $row->username; ?>')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <table class="tabel_2 table table-bordered">
                                    <thead>
                                        <tr >
                                            <th class="bg-gray-active" width="10%"><i class="fa fa-key text-warning"></i> No</th>

                                            <th class="bg-gray-active">Username</th>
                                            <th class="bg-gray-active">Password</th>
                                            <th class="bg-gray-active">Nama User</th>
                                            <th class="bg-gray-active">Info</th>
                                            <th class="bg-gray-active">Email</th>
                                            <th class="bg-gray-active">No Telpon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($get_user as $row) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td><?= $row->username; ?></td>
                                                <td><?= $row->password; ?></td>
                                                <td><?= $row->nama_user; ?></td>
                                                <td class="text-center">
                                                    <?php if ($row->is_login == 0) { ?>
                                                        <label class="label label-danger">Offline</label>
                                                    <?php } else { ?>
                                                        <label class="label label-success">Online</label>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center"><?= $row->email; ?></td>
                                                <td class="text-center"><?= $row->no_telpon; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        </article>
    </div>
</section>
<div class="modal fade" id="aksi_user" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="label_head"></h4>
            </div>
            <form class="form-horizontal aksi_form_user" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Username</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control username" name="username" placeholder="username" autofocus="true" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Password</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" class="form-control password" name="password" placeholder="password" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Nama User</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control nama_user" name="nama_user" placeholder="nama_user" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="email" class="form-control email" name="email" placeholder="email" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>No Telpon</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control no_telpon" name="no_telpon" placeholder="No Telpon" required />
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                            <input type="hidden" class="form-control kd_level" name="kd_level" value="<?=$kd_level;?>"/>
                            <input type="hidden" class="form-control kd_user" name="kd_user" value="<?=$kd_new;?>"/>
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
    $('#aksi_user').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        if (ket == 'tambah') {
            modal.find('#label_head').html('<b>Form Tambah Data User</b>');
            modal.find('.aksi_form_user').attr('action', '<?= site_url('setting/Set_user/insertUser'); ?>');
            modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        }
    });

    $("#skpd").change(function () {
        var id_skpd = $("#skpd").find('option:selected').data('id');
        var kd_urusan = $("#skpd").find('option:selected').data('kd_urusan');
        var kd_bidang = $("#skpd").find('option:selected').data('kd_bidang');
        var kd_unit = $("#skpd").find('option:selected').data('kd_unit');
//        var kd_level = '<?= $kd_level; ?>';
        $('.kd_urusan').val(kd_urusan);
        $('.kd_bidang').val(kd_bidang);
        $('.kd_unit').val(kd_unit);

//        $.ajax({
//            url: '<?= site_url(); ?>setting/Set_user/loadDataPgw/' + id_skpd + '/' + kd_level,
//            success: function (data) {
//                $('#id_pegawai').html(data);
//            }
//        })
    })


    $("#id_pegawai").change(function () {
        var nama = $("#id_pegawai").find('option:selected').data('nama');
        $('.nama_user').val(nama);
    })

    function aksi_kunci(kd_user, ket) {
        if (ket == 0) {
            var kt = 'Aktif';
        } else {
            var kt = 'Kunci';
        }
        var url_form = '<?= site_url('setting/Set_user/updateKunci'); ?>';
        $.ajax({
            type: 'POST',
            url: url_form,
            data: {kd_user: kd_user, ket: ket},
            success: function (data) {
                if (data == 'true') {
                    notif_alert_sukses('Berhasi di Update menjadi ' + kt);
                } else {
                    notif_alert_gagal(ket);
                }
            }
        });
    }

    function hapus_user(kd_user, username) {
        $.SmartMessageBox({
            title: "Form Hapus Data User",
            content: "Apakah Anda Yakin Menghapus Data User dengan Username : " + username + "<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('setting/Set_user/deleteUser'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_user: kd_user},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(username + ' Berhasi di Hapus');
                        } else {
                            notif_alert_gagal('Gagal menghapus data');
                        }
                    }
                });
            }
        });
    }
</script>