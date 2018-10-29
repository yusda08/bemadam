<?php
$logo = $row_pro->logo;
$namaDns = $row_pro->nama;
$instansi = $row_pro->instansi;
$alamatDns = $row_pro->alamat;
$noTelpDns = $row_pro->no_telpon;
$emailDns = $row_pro->email;
?>
<div id="wrapper">
    <table  border='0' repeat_header="1" cellspacing="0" width="100%" >
        <tr>
            <td rowspan="3" class="center" width="10%"><img src="<?= base_url(); ?>assets/img/<?= $logo; ?>" width="60px" height="80px"></td>
            <td valign="top" style="font-size: 12pt;" class="center" ><?= strtoupper($instansi); ?></td>
        </tr>
        <tr>
            <td valign="top" style="font-size: 14pt;" class="center" ><?= strtoupper($namaDns); ?></td>
        </tr>
        <tr>
            <td valign="top" style="font-size: 10pt;" class="center" ><?= strtoupper('Alamat : ' . $alamatDns . ' No Telp :' . $noTelpDns . ' Email : ' . $emailDns); ?></td>
        </tr>
    </table>
    <table  border='0' repeat_header="1" cellspacing="0" width="100%" >
        <tr>
            <td class="" width="10%"><hr></td>
        </tr>
        <tr>
            <td class="" width="10%">Keterangan : <?= strtoupper($pageText); ?></td>
        </tr>
    </table>
    <?php if (empty($kd_kab) and empty($kd_kec)) { ?>
        <table  border='1' repeat_header="1" cellspacing="0" width="100%" >
            <tr style="background-color: #dedede">
                <th class="padding-8" width="10%">Kode</th>
                <th class="padding-8" width="15%">Keterangan</th>
                <th class="padding-8">Provinsi / Kabupaten / Kecamatan / Desa</th>
            </tr>
            <tr style="background-color: #ffca38">
                <td class="padding-8"><?= $row_prov->kd_prov; ?></td>
                <td class="padding-8">PROVINSI</td>
                <td class="padding-8"><?= strtoupper($row_prov->nama); ?></td>
            </tr>
            <?php
            foreach ($get_dataKab as $row_kab) {
                ?>
            <tr style="background-color: #c1a65a">
                        <td class="padding-8"><?= $row_kab->kd_prov . '.' . sprintf('%02s', $row_kab->kd_kab); ?></td>
                        <td class="padding-8">KABUPATEN</td>
                        <td class="padding-8"><?= $row_kab->nama; ?></td>
                    </tr>
                <?php
                foreach ($get_dataKec as $row_kec) {
                    if ($row_kab->kd_prov == $row_kec->kd_prov and $row_kab->kd_kab == $row_kec->kd_kab) {
                        ?>
                    <tr style="background-color: #f7eac6">
                                <td class="padding-8"><?= $row_kec->kd_prov . '.' . sprintf('%02s', $row_kec->kd_kab) . '.' . sprintf('%02s', $row_kec->kd_kec); ?></td>
                                <td class="padding-8"><?= $row_kec->tipe; ?></td>
                                <td class="padding-8"><?= $row_kec->nama; ?></td>
                            </tr>
                        <?php
                        foreach ($get_dataDesa as $row_desa) {
                            if ($row_desa->kd_prov == $row_kec->kd_prov and $row_desa->kd_kab == $row_kec->kd_kab and $row_desa->kd_kec == $row_kec->kd_kec) {
                                ?>
                                 <tr>
                                        <td class="padding-8"><?= $row_desa->kd_prov . '.' . sprintf('%02s', $row_desa->kd_kab) . '.' . sprintf('%02s', $row_desa->kd_kec) . '.' . sprintf('%02s', $row_desa->kd_desa); ?></td>
                                        <td class="padding-8"><?= $row_desa->tipe ?></td>
                                        <td class="padding-8"><?= $row_desa->nama; ?></td>
                                    </tr>
                                <?php
                            }
                        }
                    }
                }
            }
            ?>
        </table>
    <?php } elseif (!empty($kd_kab) and empty($kd_kec)) { ?>
        <table  border='1' repeat_header="1" cellspacing="0" width="100%" >
            <tr style="background-color: #dedede">
                <th class="padding-8" width="10%">Kode</th>
                <th class="padding-8" width="15%">Keterangan</th>
                <th class="padding-8">Provinsi / Kabupaten / Kecamatan / Desa</th>
            </tr>
            <tr style="background-color: #ffca38">
                <td class="padding-8"><?= $row_prov->kd_prov; ?></td>
                <td class="padding-8">PROVINSI</td>
                <td class="padding-8"><?= strtoupper($row_prov->nama); ?></td>
            </tr>
            <?php
            foreach ($get_dataKab as $row_kab) {
                if ($row_kab->kd_kab == $kd_kab) {
                    ?>
                    <tr style="background-color: #c1a65a">
                        <td class="padding-8"><?= $row_kab->kd_prov . '.' . sprintf('%02s', $row_kab->kd_kab); ?></td>
                        <td class="padding-8">KABUPATEN</td>
                        <td class="padding-8"><?= $row_kab->nama; ?></td>
                    </tr>
                    <?php
                    foreach ($get_dataKec as $row_kec) {
                        if ($row_kab->kd_prov == $row_kec->kd_prov and $row_kab->kd_kab == $row_kec->kd_kab) {
                            ?>
                            <tr style="background-color: #f7eac6">
                                <td class="padding-8"><?= $row_kec->kd_prov . '.' . sprintf('%02s', $row_kec->kd_kab) . '.' . sprintf('%02s', $row_kec->kd_kec); ?></td>
                                <td class="padding-8"><?= $row_kec->tipe; ?></td>
                                <td class="padding-8"><?= $row_kec->nama; ?></td>
                            </tr>
                            <?php
                            foreach ($get_dataDesa as $row_desa) {
                                if ($row_desa->kd_prov == $row_kec->kd_prov and $row_desa->kd_kab == $row_kec->kd_kab and $row_desa->kd_kec == $row_kec->kd_kec) {
                                    ?>
                                    <tr>
                                        <td class="padding-8"><?= $row_desa->kd_prov . '.' . sprintf('%02s', $row_desa->kd_kab) . '.' . sprintf('%02s', $row_desa->kd_kec) . '.' . sprintf('%02s', $row_desa->kd_desa); ?></td>
                                        <td class="padding-8"><?= $row_desa->tipe ?></td>
                                        <td class="padding-8"><?= $row_desa->nama; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </table>
    <?php } elseif (!empty($kd_kab) and ! empty($kd_kec)) { ?>
        <table  border='1' repeat_header="1" cellspacing="0" width="100%" >
            <tr style="background-color: #dedede">
                <th class="padding-8" width="10%">Kode</th>
                <th class="padding-8" width="15%">Keterangan</th>
                <th class="padding-8">Provinsi / Kabupaten / Kecamatan / Desa</th>
            </tr>
            <tr style="background-color: #ffca38">
                <td class="padding-8"><?= $row_prov->kd_prov; ?></td>
                <td class="padding-8">PROVINSI</td>
                <td class="padding-8"><?= strtoupper($row_prov->nama); ?></td>
            </tr>
            <?php
            foreach ($get_dataKab as $row_kab) {
                if ($row_kab->kd_kab == $kd_kab) {
                    ?>
                     <tr  style="background-color: #c1a65a">
                        <td class="padding-8"><?= $row_kab->kd_prov . '.' . sprintf('%02s', $row_kab->kd_kab); ?></td>
                        <td class="padding-8">KABUPATEN</td>
                        <td class="padding-8"><?= $row_kab->nama; ?></td>
                    </tr>
                    <?php
                    foreach ($get_dataKec as $row_kec) {
                        if ($row_kab->kd_prov == $row_kec->kd_prov and $row_kab->kd_kab == $row_kec->kd_kab and $row_kec->kd_kec == $kd_kec) {
                            ?>
                            <tr style="background-color: #f7eac6">
                                <td class="padding-8"><?= $row_kec->kd_prov . '.' . sprintf('%02s', $row_kec->kd_kab) . '.' . sprintf('%02s', $row_kec->kd_kec); ?></td>
                                <td class="padding-8"><?= $row_kec->tipe; ?></td>
                                <td class="padding-8"><?= $row_kec->nama; ?></td>
                            </tr>
                            <?php
                            foreach ($get_dataDesa as $row_desa) {
                                if ($row_desa->kd_prov == $row_kec->kd_prov and $row_desa->kd_kab == $row_kec->kd_kab and $row_desa->kd_kec == $row_kec->kd_kec) {
                                    ?>
                                    <tr>
                                        <td class="padding-8"><?= $row_desa->kd_prov . '.' . sprintf('%02s', $row_desa->kd_kab) . '.' . sprintf('%02s', $row_desa->kd_kec) . '.' . sprintf('%02s', $row_desa->kd_desa); ?></td>
                                        <td class="padding-8"><?= $row_desa->tipe ?></td>
                                        <td class="padding-8"><?= $row_desa->nama; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </table>
    <?php } ?>
</div>