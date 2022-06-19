<?php
// Jika terdapat session, arahkan ke halaman home
if (isset($_SESSION['level_pelanggan'])) {
    header("location: ?page=halaman_awal/home");
    die();
}
?>


<!--::header part start::-->
<header class="main_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <?php include "halaman_awal/components/navbar.php"; ?>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card" style="padding: 20px;">
                    <div class="col-md-12">
                        <h2 class="contact-title">Login</h2>
                    </div>
                    <div class="col-md-12">
                        <form class="form-contact contact_form" action="?page=halaman_awal/login/proses_login" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" name="username" id="username" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" placeholder='Username'>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="password" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" placeholder='Password'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:-5px">
                                <div class="row">
                                    <div class="col-md-8" style="padding: 14.5px 43px 14.5px 0px;"><a href="?page=halaman_awal/registered/viewregistered">Belum Punya Akun? Silahkan <strong>Register!!</strong></a></div>
                                    <div class="col-md-4"> <button type="submit" class="button button-loginForm btn_5 float-right ml-6" name="login">Login</button></div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

</section>
<!-- ================ contact section end ================= -->

<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->