<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = aksesLog();
$m = aksesMenu($a['kd_user']);
echo $javasc;
echo $notifikasi;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if ($kd_user == 1) {
    $att = 'disabled';
} else {
    $att = '';
}
?>
<section id="widget-grid" class="">
    <legend><?=$nama_user;?></legend>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!--<span class="pull-right">-->
            <a href="<?= site_url('setting/Set_rule?kd_level=' . $kd_level); ?>" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-backward"></i> Kembali</a>
            <!--</span>-->
            <div class="jarviswidget" >
                <header class="bg-gray">
                    <h2><strong>Tabel Rule</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                    <?php
                                    $attr = 'data-toggle="modal" data-target="#tambahRoleMenu" 
                                            data-aksi="tambah"
                                            data-ket="Menu Utama"
                                            data-kd_level="' . $kd_level . '"
                                            data-kd_user="' . $kd_user . '"
                                            data-parent="0"';
                                    $ket = 'Menu';
                                    btn_tambah($attr, $ket);
                                    ?>
                                </div>
                                <span class="pull-right">
                                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                        <button <?= $m['rul_tambah']; ?> class="btn btn-default btn-sm" onclick="insertAll('<?= $kd_user; ?>', 'Tambah Semua Menu')">
                                            <i class="fa fa-plus"></i> Semua Menu
                                        </button>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div>
                            <table id="tabel_skpd" class="table tabel_2 table-bordered">
                                <thead>
                                    <tr >
                                        <th class="bg-gray-active" width="3%">No</th>
                                        <th class="bg-gray-active">Nama Menu</th>
                                        <th class="bg-gray-active" >LINK</th>
                                        <th class="bg-gray-active" width="5%">Lihat</th>
                                        <th class="bg-gray-active" width="5%">Tambah</th>
                                        <th class="bg-gray-active" width="5%">Edit</th>
                                        <th class="bg-gray-active" width="5%">Hapus</th>
                                        <th class="bg-gray-active" width="5%">Print</th>
                                        <th class="bg-gray-active" width="8%"><i class="fa fa-plus"></i></th>
                                        <th class="bg-gray-active" width="3%"><i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_ruleMenu->result() as $row) {
                                        if ($row->parent == 0) {
                                            ?>
                                            <tr style="background-color: #ededed">
                                                <td><?= $row->urutan; ?></td>
                                                <td><?= $row->nama; ?></td>
                                                <td><?= $row->link; ?></td>
                                                <td>
                                                    <?php if ($row->link != '#') { ?>
                                                        <div class="smart-form">
                                                            <label class="toggle">
                                                                <input <?php
                                                                if ($row->lihat == 1) {
                                                                    echo "checked='checked'";
                                                                }
                                                                echo $m['rul_edit'];
                                                                ?> onclick="updateRuleAksi('<?= $row->id_menu; ?>', '<?= $row->kd_user; ?>', '<?= $row->lihat; ?>', 'lihat');" type="checkbox" name="checkbox-toggle">
                                                                <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->link != '#') { ?>
                                                        <div class="smart-form">
                                                            <label class="toggle">
                                                                <input <?php
                                                                if ($row->tambah == 1) {
                                                                    echo "checked='checked'";
                                                                }
                                                                echo $m['rul_edit'];
                                                                ?> onclick="updateRuleAksi('<?= $row->id_menu; ?>', '<?= $row->kd_user; ?>', '<?= $row->tambah; ?>', 'tambah');" type="checkbox" name="checkbox-toggle">
                                                                <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->link != '#') { ?>
                                                        <div class="smart-form">
                                                            <label class="toggle">
                                                                <input <?php
                                                                if ($row->edit == 1) {
                                                                    echo "checked='checked'";
                                                                }
                                                                echo $m['rul_edit'];
                                                                ?> onclick="updateRuleAksi('<?= $row->id_menu; ?>', '<?= $row->kd_user; ?>', '<?= $row->edit; ?>', 'edit');" type="checkbox" name="checkbox-toggle">
                                                                <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->link != '#') { ?>
                                                        <div class="smart-form">
                                                            <label class="toggle">
                                                                <input <?php
                                                                if ($row->hapus == 1) {
                                                                    echo "checked='checked'";
                                                                }
                                                                echo $m['rul_edit'];
                                                                ?> onclick="updateRuleAksi('<?= $row->id_menu; ?>', '<?= $row->kd_user; ?>', '<?= $row->hapus; ?>', 'hapus');" type="checkbox" name="checkbox-toggle">
                                                                <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->link != '#') { ?>
                                                        <div class="smart-form">
                                                            <label class="toggle">
                                                                <input <?php
                                                                if ($row->print == 1) {
                                                                    echo "checked='checked'";
                                                                }
                                                                echo $m['rul_edit'];
                                                                ?> onclick="updateRuleAksi('<?= $row->id_menu; ?>', '<?= $row->kd_user; ?>', '<?= $row->print; ?>', 'print');" type="checkbox" name="checkbox-toggle">
                                                                <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td class="no-padding">
                                                    <?php
                                                    if ($row->link == '#') {
                                                        $attr = 'data-toggle="modal"
                                                                data-target="#tambahRoleMenu" 
                                                                data-aksi="tambah"
                                                                data-ket="Sub Menu"
                                                                data-kd_level="' . $kd_level . '"
                                                                data-kd_user="' . $kd_user . '"
                                                                data-parent="' . $row->id . '"';
                                                        $ket = 'Sub Menu';
                                                        btn_tambah($attr, $ket);
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button <?= $m['rul_hapus']; $att; ?> class="btn btn-danger btn-xs btn-flat" onclick="hapusMenu('<?= $kd_level; ?>', '<?= $kd_user; ?>', '<?= $row->id_menu; ?>', 'Hapus Menu')"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                            $nop = 1;
                                            foreach ($get_ruleMenu->result() as $row_p) {
                                                if ($row->id == $row_p->parent and $row->link == '#') {
                                                    ?>
                                                    <tr>
                                                        <td><?= $row->urutan . '.' . $row_p->urutan; ?></td>
                                                        <td><?= $row_p->nama; ?></td>
                                                        <td><?= $row_p->link; ?></td>
                                                        <td>
                                                            <?php if ($row_p->link != '#') { ?>
                                                                <div class="smart-form">
                                                                    <label class="toggle">
                                                                        <input <?php
                                                                        if ($row_p->lihat == 1) {
                                                                            echo "checked='checked'";
                                                                        }
                                                                        ?> onclick="updateRuleAksi('<?= $row_p->id_menu; ?>', '<?= $row_p->kd_user; ?>', '<?= $row_p->lihat; ?>', 'lihat');" type="checkbox" name="checkbox-toggle">
                                                                        <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row_p->link != '#') { ?>
                                                                <div class="smart-form">
                                                                    <label class="toggle">
                                                                        <input <?php
                                                                        if ($row_p->tambah == 1) {
                                                                            echo "checked='checked'";
                                                                        }
                                                                        echo $m['rul_edit'];
                                                                        ?> onclick="updateRuleAksi('<?= $row_p->id_menu; ?>', '<?= $row_p->kd_user; ?>', '<?= $row_p->tambah; ?>', 'tambah');" type="checkbox" name="checkbox-toggle">
                                                                        <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row_p->link != '#') { ?>
                                                                <div class="smart-form">
                                                                    <label class="toggle">
                                                                        <input <?php
                                                                        if ($row_p->edit == 1) {
                                                                            echo "checked='checked'";
                                                                        }
                                                                        echo $m['rul_edit'];
                                                                        ?> onclick="updateRuleAksi('<?= $row_p->id_menu; ?>', '<?= $row_p->kd_user; ?>', '<?= $row_p->edit; ?>', 'edit');" type="checkbox" name="checkbox-toggle">
                                                                        <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row_p->link != '#') { ?>
                                                                <div class="smart-form">
                                                                    <label class="toggle">
                                                                        <input <?php
                                                                        if ($row_p->hapus == 1) {
                                                                            echo "checked='checked'";
                                                                        }
                                                                        echo $m['rul_edit'];
                                                                        ?> onclick="updateRuleAksi('<?= $row_p->id_menu; ?>', '<?= $row_p->kd_user; ?>', '<?= $row_p->hapus; ?>', 'hapus');" type="checkbox" name="checkbox-toggle">
                                                                        <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row_p->link != '#') { ?>
                                                                <div class="smart-form">
                                                                    <label class="toggle">
                                                                        <input <?php
                                                                        if ($row_p->print == 1) {
                                                                            echo "checked='checked'";
                                                                        }
                                                                        echo $m['rul_edit'];
                                                                        ?> onclick="updateRuleAksi('<?= $row_p->id_menu; ?>', '<?= $row_p->kd_user; ?>', '<?= $row_p->print; ?>', 'print');" type="checkbox" name="checkbox-toggle">
                                                                        <i data-swchon-text="Aktif" data-swchoff-text="Non"></i></label>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <button <?= $m['rul_hapus']; $att; ?> class="btn btn-danger btn-xs btn-flat" onclick="hapusMenu('<?= $kd_level; ?>', '<?= $kd_user; ?>', '<?= $row_p->id_menu; ?>', 'Hapus Menu')"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } $no++;
                                        }
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
<div class="modal fade" id="tambahRoleMenu" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="label_head"></h4>
            </div>
            <form class="form-horizontal" id="aksi_menu" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Pilih Menu</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select class="form-control select2 id_menu" id="id_menu" name="id_menu" required>
                                    <option value="">--Pilih Menu--</option>
                                    
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control text-center  kd_user" name="kd_user">
                        <input type="hidden" class="form-control text-center  parent" name="parent">
                        <input type="hidden" class="form-control text-center  ket" name="ket">
                        <input type="hidden" class="form-control text-center  url" name="url" value="<?= $url; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="submitMenu"></div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
    $('#tambahRoleMenu').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var ket = button.data('ket');
        var kd_user = button.data('kd_user');
        var kd_level = button.data('kd_level');
        var parent = button.data('parent');
        var aksi = button.data('aksi');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(aksi);
        modal.find('.modal-body input.kd_user').val(kd_user);
        modal.find('.modal-body input.parent').val(parent);
        $('#label_head').html('Form Tambah ' + ket);
        $('.submitMenu').html('<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>');
        $('#aksi_menu').attr('action', '<?= site_url('setting/Set_rule/insertRoleMenu'); ?>');
        $.ajax({
            url: '<?= base_url(); ?>setting/Set_rule/pilihMenu/' + parent + '/' + kd_user,
            success: function (data) {
                $('#id_menu').html(data);
            }
        })
    });

    function updateRuleAksi(id_menu, kd_user, status, aksi) {
        var url_form = '<?= site_url('setting/Set_rule/update_rule_aksi'); ?>';
        $.ajax({
            type: 'POST',
            url: url_form,
            data: {id_menu: id_menu, kd_user: kd_user, status: status, aksi: aksi},
            success: function (data) {
                if (data == 'true') {
                    notif_alert_sukses('Berhasil Update');
                } else {
                    notif_alert_gagal('Gagal Update');
                }
            }
        });
    }


    function insertAll(kd_user, ket) {
        $.SmartMessageBox({
            title: "Form Tambah Semua Menu",
            content: "Apakah Anda Yakin Menambahkan Semua Menu Pada User Ini<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('setting/Set_rule/insertAllMenu'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_user: kd_user},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(ket);
                        } else {
                            notif_alert_gagal(ket);
                        }
                    }
                });
            }
        });
    }
    function hapusMenu(kd_level, kd_user, id_menu, ket) {
        $.SmartMessageBox({
            title: "Form Hapus Menu",
            content: "Apakah Anda Yakin Menghapus Menu Ini<br>silahkan tekan tombol Yes untuk melanjutkan Aksi Hapus",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var url_form = '<?= site_url('setting/Set_rule/deleteMenu'); ?>';
                $.ajax({
                    type: 'POST',
                    url: url_form,
                    data: {kd_level: kd_level, kd_user: kd_user, id_menu: id_menu},
                    success: function (data) {
                        if (data == 'true') {
                            notif_alert_sukses(ket);
                        } else {
                            notif_alert_gagal(ket);
                        }
                    }
                });
            }
        });
    }
    
</script>
