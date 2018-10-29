<div class="container">
    <div class="hidden-xs">
    <a href="<?=site_url('frontend/Home');?>" class="logo float-left tran4s"><img src="<?=base_url();?>assets/img/logo_width.png" width="30%" alt="Logo">
    </a>
    </div>
    <!-- ========================= Theme Feature Page Menu ======================= -->
    <nav class="navbar float-right theme-main-menu one-page-menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                Menu
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="<?=site_url('frontend/Home/home');?>">HOME</a></li>
                <li class="dropdown-holder"><a href="#">Slide Down <span class="caret"></span></a>
                    <ul class="sub-menu">
                        <li><a href="#" class="tran3s">Blog Details</a></li>
                    </ul>
                </li>
                <li ><a href="<?=site_url('Login');?>">Login <i class="fa fa-lock"></i></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav> <!-- /.theme-feature-menu -->
</div>