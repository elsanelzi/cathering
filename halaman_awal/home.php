<?php
// Query untuk mengambil data table paket dimana harga paket kecil sama dengan 30000 berdasarkan id_paket dari yang terbesar dengan mengambil limit 3 data
$paket30ribuan = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE harga_paket <= 30000 ORDER BY id_paket DESC LIMIT 3");
// Query untuk mengambil data table paket dimana harga paket besar dari 30000 berdasarkan id_paket dari yang terbesar dengan mengambil limit 3 data
$paketdiatas30ribuan = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE harga_paket > 30000 ORDER BY id_paket DESC LIMIT 3");
$paketterbaru = mysqli_query($koneksi, "SELECT * FROM tb_paket ORDER BY id_paket DESC LIMIT 3");
?>
<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <?php include "halaman_awal/components/navbar.php"; ?>
            </div>
        </div>
    </div>
</header>
<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h5>Harga Terjangkau</h5>
                        <h1 style="color:#121212">Sangat Enak dan menggugah selera</h1>
                        <p style="color:#131313">Together creeping heaven upon third dominion be upon won't darkness rule land
                            behold it created good saw after she'd Our set living. Signs midst dominion
                            creepeth morning</p>
                        <div class="banner_btn">
                            <div class="banner_btn_iner">
                                <a href="?page=halaman_awal/pages/pesan/viewpesan" class="btn_2" style="font-weight: bold; color:#121212; font-size:18px; background-color:white">Pesan Sekarang<img src="halaman_awal/assets/img/icon/left_1.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->

<!--::exclusive_item_part start::-->
<section class="exclusive_item_part blog_item_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_tittle">
                    <!-- <p>Popular Dishes</p> -->
                    <h2>Paket 30 Ribuan - Termasuk Ongkir</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $no = 1;
            foreach ($paket30ribuan as $key => $value) : ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="single_blog_item">

                        <div class="single_blog_img">
                            <img src="halaman_backend/assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="" style="height:300px; border-radius:10px">
                        </div>
                        <div class="single_blog_text">
                            <h3><?= $value['nama_paket']; ?></h3>
                            <p><?= $value['keterangan']; ?> </p>
                            <!-- <a href="#" class="btn_3">Read More <img src="halaman_awal/assets/img/icon/left_2.svg" alt=""></a> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!--::exclusive_item_part end::-->
<br><br><br>
<!-- about part start-->
<section class="exclusive_item_part blog_item_section mt-10">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_tittle">
                    <!-- <p>Popular Dishes</p> -->
                    <h2>Paket Diatas 30 Ribuan - Termasuk Ongkir</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $no = 1;
            foreach ($paketdiatas30ribuan as $key => $value) : ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="single_blog_item">

                        <div class="single_blog_img">
                            <img src="halaman_backend/assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="" style="height:300px; border-radius:10px">
                        </div>
                        <div class="single_blog_text">
                            <h3><?= $value['nama_paket']; ?></h3>
                            <p><?= $value['keterangan']; ?> </p>
                            <!-- <a href="#" class="btn_3">Read More <img src="halaman_awal/assets/img/icon/left_2.svg" alt=""></a> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- about part end-->
<br><br><br>

<!-- intro_video_bg start-->
<section class="intro_video_bg mt-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro_video_iner text-center">
                    <h2>Expect The Best</h2>
                    <!-- <div class="intro_video_icon">
                        <a id="play-video_1" class="video-play-button popup-youtube" href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                            <span class="ti-control-play"></span>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- intro_video_bg part start-->


<!--::exclusive_item_part start::-->
<section class="blog_item_section blog_section section_padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="section_tittle">
                    <p>New Paket</p>
                    <h2>Paket Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $no = 1;
            foreach ($paketterbaru as $key => $value) : ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="single_blog_item">
                        <div class="single_blog_img">
                            <img src="halaman_backend/assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="" style="height:300px; border-radius:10px">
                        </div>
                        <div class="single_blog_text">
                            <div class="date">
                                <a href="#" class="date_item"> <span>#</span> Food News </a>
                            </div>
                            <h3><a href="blog.html"><?= $value['nama_paket']; ?></a></h3>
                            <p class="mt-30"><?= $value['keterangan']; ?> </p>
                            <!-- <a href="#" class="btn_3">Read More <img src="halaman_awal/assets/img/icon/left_1.svg" alt=""></a> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</section>
<!--::exclusive_item_part end::-->

<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->