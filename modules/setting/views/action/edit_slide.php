<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_logined');
echo $javasc;
echo $notifikasi;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<section id="widget-grid" class="">
<div class="row">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="label_head">Form Slide Show</h4>
                </div>
                <form class="form-horizontal aksi_form_user" action="<?= site_url('setting/Set_slide/updateSlideShow'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Judul</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control judul" name="judul" placeholder="Judul Slide Show" value="<?= $row_slide->judul; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Keterangan</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <textarea type="email" class="form-control keterangan" name="keterangan" placeholder="Keterangan" ><?= $row_slide->keterangan; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <center>
                                    <label for="kecamatan">File Foto</label>
                                    <div id="uploaded_image">
                                        <div id='tampilimg'>
                                            <img src='<?php linkImg('slide', $row_slide->foto); ?>' width="100%" class="img-responsive">
                                        </div>
                                        <div class="hidden_file hidden">
                                            <input type="file" name="upload_image" id="upload_image" class="form-control bg-gray-light">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type='button' onclick='gantiimg()' class='btn'>Ganti</button>
                                    <button type='button'  onclick='batalimg()' class='btn'>Batal</button>
                                </center>
                                <input type="hidden" name="img" id="img" class="form-control" value="<?= $row_slide->foto; ?>">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                        <input type="hidden" class="form-control" name="id" value="<?= $row_slide->id; ?>"/>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="<?= site_url('setting/Set_slide'); ?>" type="button"><i class="fa fa-backward"></i> Kembali</a>
                        <button  class="btn btn-success" type="submit" type="button"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </article>
</div>
</section>
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function gantiimg() {
        $("#tampilimg").addClass('hidden');
        $(".hidden_file").removeClass('hidden');
    }
    function batalimg() {
        $("#tampilimg").removeClass('hidden');
        $(".hidden_file").addClass('hidden');
    }
    $(document).ready(function () {

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 500,
                height: 250,
                type: 'square' //circle || square
            },
            boundary: {
                width: 550,
                height: 350
            }
        });

        $('#upload_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                //                alert(response);
                $.ajax({
                    url: "<?= site_url('setting/Set_profil/crop_ImgUpload'); ?>",
                    type: "POST",
                    data: {"image": response},
                    success: function (data)
                    {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
                        //                        $('#img').val(data.nm_foto);
                        document.getElementById('upload_image').setAttribute('type', 'hidden');
                    }
                });
            })
        });

    });
</script>