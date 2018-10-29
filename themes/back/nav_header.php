<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = aksesLog();
?> 
<span class="hidden-xs">
    <div id="logo-group" class="bg-info">
        <span id="logo" style="color:#000;font-size: 14pt;"><center><strong><?= strtoupper($ket_level); ?></strong></center></span>
    </div>
</span>
<div class="pull-left" >
    <div id="hide-menu" class="btn-header pull-right">
        <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
    </div>
</div>
<div class="pull-right">
    <div id="logout" class="btn-header transparent pull-right">
        <span> <a href="<?= site_url('login/logout/' . $kd_user); ?>" title="Sign Out" data-action="userLogout" data-logout-msg="Apakah Anda Yakin Akan Keluar...???"><i class="fa fa-sign-out"></i></a> </span>
    </div>
    <!-- fullscreen button -->
    <div id="fullscreen"  class="btn-header transparent pull-right" >
        <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen">
                <i class="fa fa-arrows-alt"></i></a> </span>
    </div>
    <div class="btn-header transparent pull-right" >
        <span> <a href="<?= site_url('setting/Set_profil/user?kd_user=' . $kd_user); ?>" title="Profil Admin">
                <i class="fa fa-users"></i> <span class="hidden-mobile">Profil</span></a></span>
    </div>

</div>