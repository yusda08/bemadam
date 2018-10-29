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
                    <h2><strong>Tabel List User</strong></h2>				
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-2">Pilih Level User</div>
                                <div class="col-md-4">
                                    <form name='flevel_user' method='get' >
                                        <select name='kd_level' class="btn btn-default select2" style="width: 100%"  onchange='document.flevel_user.submit();'>
                                            <option value=''> Pilih Level User</option>
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
                            </div>
                        </div>
                        <?php if (!empty($kd_level)) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-active" width="5%">No</th>
                                            <th class="bg-gray-active">Ket Level</th>
                                            <th class="bg-gray-active">Username</th>
                                            <th class="bg-gray-active">Nama User</th>
                                            <th class="bg-gray-active" width="8%"><i class="fa fa-crop"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($get_setUser->result() as $row) {
                                            if ($kd_level == $row->kd_level) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-center"><?= $row->ket_level; ?></td>
                                                    <td><?= $row->username; ?></td>
                                                    <td><?= $row->nama_user; ?></td>
                                                    <td class="text-center no-padding">
                                                        <a href="<?= site_url('setting/Set_rule/rule_user?kd_level=' . $kd_level . '&kd_user=' . $row->kd_user); ?>" class="btn btn-primary btn-default"><i class="fa fa-search"></i> Rule Menu</a>
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