<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_logined');
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div class="col-sm-12 col-md-6 col-lg-6">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                &times;
            </button>
            <h4 class="modal-title" id="label_head">Form Edit Profil</h4>
        </div>
        <form class="form-horizontal" action="<?= site_url('setting/Set_profil/update_profil'); ?>" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Username</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control username" name="username" value="<?= $a['username']; ?>" placeholder="username" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Password Lama</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="password" id="password_lama" class="form-control password_lama" name="password_lama" placeholder="Password" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Password Baru</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="password" class="form-control password_baru" name="password_baru" placeholder="Password Baru" required />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>Nama User</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control nama_user" name="nama_user" placeholder="Nama User" required value="<?= $a['nama_user']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>No Telpon</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control no_telpon" name="no_telpon" placeholder="No Telpon" required value="<?= $a['no_telpon']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Email</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="email" class="form-control email" name="email" placeholder="Email" required value="<?= $a['email']; ?>"/>
                            <input type="hidden" class="form-control url" name="url" placeholder="Email" required value="<?= $url . "?kd_user=" . $a['kd_user']; ?>"/>
                            <input type="hidden" class="form-control kd_user" name="kd_user" placeholder="kd_user" required value="<?= $a['kd_user']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <center>
                            <label>Foto Admin</label>
                            <div id='tampilimg'>
                                <?php
                                $foto = $a['foto'];
                                if ($foto == '') {
                                    echo "<img src='" . base_url() . "assets/img/avatars/sunny-big.png' class='img-responsive' />";
                                } else {
                                    echo "<img src='" . base_url() . "assets/img/user/" . $foto . "' class='img-responsive'/>";
                                }
                                ?>
                            </div>
                            <div class="hidden_file hidden">
                                <input type="file" name="upload_image" id="upload_image" class="form-control bg-gray-light">
                            </div>
                            <hr>
                            <button type='button' onclick='gantiimg()' class='btn'>Ganti</button>
                            <button type='button'  onclick='batalimg()' class='btn'>Batal</button>
                        </center>
                        <input type='hidden' name='img' class="form-control" value="<?= $foto; ?>" />
                    </div>
                    <div class="col-md-6">
                        <center>
                            <div id="uploaded_image"></div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
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
    $(document).ready(function () {
        $('#password_lama').after('<span class="status_password_lama"></span>').css('margin-right', '10px');
        $('#password_lama').keyup(function () {
            $(this).css({'border': '1px solid #ccc', 'background': 'none'});
        });

        $('#password_lama').change(function (e) {
            var password_lama = $(this).val();
//            alert(password_lama+ "--" + '<?= $a['password']; ?>' );
            if (password_lama == '<?= $a['password']; ?>') {
                $('.status_password_lama').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> Password diterima</b>');
                $('#submit').removeAttr("disabled", "disabled");
            } else {
                $('.status_password_lama').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> Password Lama Tidak Diterima</b>');
                $('#password_lama').css({'border': '3px solid #f00', 'background': 'yellow'});
                $("#submit").attr("disabled", "disabled");
            }
        });
    });

    $(document).ready(function () {
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 300,
                type: 'square' //circle || square
            },
            boundary: {
                width: 350,
                height: 400
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
</script>