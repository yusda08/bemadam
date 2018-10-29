
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = aksesLog();
?> 
<div class="login-info">
    <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
        <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
            <?php
            $foto = $a['foto'];
            if ($foto == '') {
                echo "<img src='" . base_url() . "assets/img/avatars/sunny.png' class='online' />";
            } else {
                echo "<img src='" . base_url() . "assets/img/user/" . $foto . "' class='online' />";
            }
            ?>
            <span>
                <?= $a['username']; ?>
            </span>
        </a> 

    </span>
</div>
<!-- end user info -->

<!-- NAVIGATION : This navigation is also responsive-->
<nav>
    <ul id='navig'>

        <?php
        foreach ($get_menu->result() as $row) {
            if ($row->parent == 0) {
                if ($row->link != '#') {
                    ?>
                    <li class="">
                        <a href="<?= site_url($row->link); ?>" title="Urusan">
                            <i class="fa fa-lg fa-fw <?= $row->icon; ?>"></i> <span class="menu-item-parent"><?= $row->nama; ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="top-menu-invisible">
                        <a href="#"><i class="fa fa-lg fa-fw <?= $row->icon; ?> txt-color-blue"></i> <span class="menu-item-parent"><?= $row->nama; ?></span></a>
                        <ul>
                            <?php
                            foreach ($get_menu->result() as $row_p) {
                                if ($row_p->parent == $row->id) {
                                    ?>
                                    <li class="">
                                        <a href="<?= site_url($row_p->link); ?>">
                                            <?php if (!is_null($row_p->icon)) { ?>
                                                <i class="fa fa-lg fa-fw <?= $row_p->icon; ?>"></i>
                                            <?php } ?>
                                            <span class="menu-item-parent"><?= $row_p->nama; ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                        </ul>
                    </li>
                    <?php
                }
            }
        }
        ?>
    </ul>	
</nav>
<script> if (!window.jQuery) {
        document.write('<script src="<?= base_url(); ?>assets/js/libs/jquery-2.1.1.min.js"><\/script>'); }</script>
<script>
<?php
$ci = &get_instance();
$folder = $ci->uri->segment(1);
$controller = $ci->uri->segment(2);
$method = $ci->uri->segment(3);
if (empty($folder) and empty($method)) {
    $url = $controller;
} elseif (empty($method)) {
    $url = $folder . '/' . $controller;
} else {
    $url = $folder . '/' . $controller . '/' . $method;
}
?>
    $(function () {
        $('#navig a[href~="<?= site_url($url); ?>"]').parents('li').addClass('active');

    })

</script>
