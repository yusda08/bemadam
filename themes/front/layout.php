<!DOCTYPE html>
<html>
    <head>
        <?= $head; ?>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body>
        <div class="main-page-wrapper">



            <!-- 
            =============================================
                    Theme Header
            ============================================== 
            -->
            <header class="theme-main-header">
                <?= $nav; ?>
            </header>


            <?=$content;?>
            <footer>
                <?= $footer; ?>
            </footer>




            <!-- =============================================
                    Loading Transition
            ============================================== -->
            <div id="loader-wrapper">
                <div id="preloader_1">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>


            <!-- Scroll Top Button -->
            <button class="scroll-top tran3s p-color-bg">
                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
            </button>




            <!-- Js File_________________________________ -->



        </div> <!-- /.main-page-wrapper -->
    </body>
</html>
