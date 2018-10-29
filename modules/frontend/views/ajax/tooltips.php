

<div id="popover-content-login" >
    <ol class="list-group">
        <?php
        if (!is_array($get_linkAplikasi)) {
            if ($get_linkAplikasi->num_rows() != 0) {
                $no = 1;
                foreach ($get_linkAplikasi->result() as $row) {
                    if($row->status == 'Y'){
                    ?>
                    <li class="list-group-item">
                        <a href="<?= $row->link; ?>" target="_blank" style="font-size: 16pt"> <?= $no++ . '. ' . $row->nama; ?></a>
                        <br>
                        <note><?=$row->keterangan;?></note>
                    </li>
                    <?php
                    }
                }
            } else {
                ?>
                <label class="label label-danger">Konten Kosong</label>
            <?php }
        }
        ?>
    </ol>
</div>