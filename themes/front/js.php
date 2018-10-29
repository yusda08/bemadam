<!-- j Query -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/jquery.2.2.3.min.js"></script>

<!-- Bootstrap JS -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/bootstrap/bootstrap.min.js"></script>

<!-- Vendor js _________ -->

<!-- revolution -->
<script src="<?= base_url(); ?>assets/front/vendor/revolution/jquery.themepunch.tools.min.js"></script>
<script src="<?= base_url(); ?>assets/front/vendor/revolution/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/revolution/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/revolution/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/revolution/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/revolution/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/revolution/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/revolution/revolution.extension.video.min.js"></script>

<!-- Google map js -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ8VrXgGZ3QSC-0XubNhuB2uKKCwqVaD0&callback=goMap" type="text/javascript"></script> <!-- Gmap Helper -->
<script src="<?= base_url(); ?>assets/front/vendor/gmaps.min.js"></script>
<!-- owl.carousel -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/owl-carousel/owl.carousel.min.js"></script>
<!-- mixitUp -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/jquery.mixitup.min.js"></script>
<!-- Progress Bar js -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/skills-master/jquery.skills.js"></script>
<!-- Validation -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/contact-form/validate.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/vendor/contact-form/jquery.form.js"></script>


<!-- Theme js -->
<script type="text/javascript" src="<?= base_url(); ?>assets/front/js/theme.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/front/js/map-script.js"></script>
<!--<script src="<?= base_url(); ?>assets/css/1/thumbnail-slider.js" type="text/javascript"></script>-->
<script src="<?= base_url(); ?>assets/css/4/thumbnail-slider.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var heights = $(".well_sama").map(function () {
            return $(this).height();
        }).get(),
                maxHeight = Math.max.apply(null, heights);

        $(".well_sama").height(maxHeight);
    });

</script>