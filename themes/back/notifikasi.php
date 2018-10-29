<?php
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
if ($tipe == 'alert-danger') {
    $lambang = 'fa-ban';
    $notify = 'Gagal!';
}
?>   
<section id="widget-grid" class="">
    <article class="col-md-6">
        <?php
        if ($msg) {
            ?>
            <div class="alert <?php echo $tipe; ?> alert-dismissable" id='notiv'>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa <?php echo $lambang; ?>"></i> <?php echo $notify; ?></h4>
                <?php echo $msg; ?>
            </div>
        <?php } ?>
    </article>
</section>