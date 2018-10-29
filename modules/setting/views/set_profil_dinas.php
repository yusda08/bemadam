<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_logined');
echo $javasc;
echo $notifikasi;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!--<section id="widget-grid" class="">-->
<div class="row">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="label_head">Form Setting Profil SKPD</h4>
                </div>
                <form class="form-horizontal aksi_form_user" action="<?= site_url('setting/Set_profil/update_profilDinas'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Nama SKPD</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama SKPD" value="<?= $row_pro->nama; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Alamat</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <textarea type="email" class="form-control alamat" name="alamat" placeholder="Alamat" ><?= $row_pro->alamat; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>No Telpon</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="no_telpon" placeholder="No Telpon " value="<?= $row_pro->no_telpon;; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $row_pro->email; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Instannsi Pemerintah</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="instansi" placeholder="Instansi Pemerintah" value="<?= $row_pro->instansi; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <center>
                                    <label for="kecamatan">File Foto</label>
                                    <div id="uploaded_image">
                                        <div id='tampilimg'>
                                            <img src='<?= base_url() ?>assets/img/<?= $row_pro->logo; ?>' width='80px' heigth='80px'>
                                        </div>
                                        <div class="hidden_file hidden">
                                            <input type="file" name="upload_image" id="upload_image" class="form-control bg-gray-light">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type='button' onclick='gantiimg()' class='btn'>Ganti</button>
                                    <button type='button'  onclick='batalimg()' class='btn'>Batal</button>
                                </center>
                                <input type="hidden" name="img" id="img" class="form-control" value="<?= $row_pro->logo; ?>">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="url" value="<?= $url; ?>"/>
                        <input type="hidden" class="form-control" name="id" value="<?= $row_pro->id; ?>"/>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-success" type="submit" style="background-color:#5a995a;" type="button"><i class="fa fa-save"></i> Simpan</button>
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
                    <div class="col-md-8 text-center">
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
                width: 320,
                height: 450,
                type: 'square' //circle || square
            },
            boundary: {
                width: 350,
                height: 500
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