<?php
$profil_usaha = mysqli_query($koneksi, "SELECT * FROM tb_profil_usaha")->fetch_array();
?>
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-md-3 col-lg-3">
                <div class="single-footer-widget footer_1">
                    <h4>About Us</h4>
                    <p><?= $profil_usaha['tentang_kami']; ?>.</p>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-2 col-lg-3">
                <div class="single-footer-widget footer_2">
                    <h4>Important Link</h4>
                    <div class="contact_info">
                        <ul>
                            <li><a href="?page=halaman_awal/home">Home</a></li>
                            <li><a href="?page=halaman_awal/pages/pesan/viewriwayatpesanan"> Riwayat Pesanan</a></li>
                            <li><a href="?page=halaman_awal/pages/pembayaran/viewpembayaran">Pembayaran</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-3 col-lg-3">
                <div class="single-footer-widget footer_2">
                    <h4>Contact us</h4>
                    <div class="contact_info">
                        <p><span> Address :</span><?= $profil_usaha['alamat']; ?> </p>
                        <p><span> Phone :</span><?= $profil_usaha['no_telp']; ?></p>
                        <p><span> Email : </span><?= $profil_usaha['email']; ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
                <div class="single-footer-widget footer_3">
                    <h4>Ikuti Kami</h4>
                    <div class="row">
                        <div class="copyright_social_icon text-right">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="ti-dribbble"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- intro_wa_bg start-->
        <div class="row mt-5">
            <div class="col-xl-12 col-sm-6 col-md-3 col-lg-3">
                <div class="single-footer-widget footer_1">
                    <h4>Ada kendala pesanan? Beri tahu kami</h4>
                    <p>Ada kendala dalam pesanan Langganan atau Acara yang kamu terima?</p>
                    <p>Kamu bisa langsung hubungi WA untuk klaim garansi kualitas makanan dan garansi pengantaran tepat waktu dengan melampirkan foto bukti kendala pesanan kamu.</p>
                    <a href="https://api.whatsapp.com/send?phone=<?= $profil_usaha['no_wa'] ?>&text=Permisi,, " target="blank" class="badge badge-success mt-2" style="background-color:green; padding:10px 20px; ">WhatsApp</a>
                </div>
            </div>
        </div>
        <!-- intro_wa_bg part start-->
        <div class="copyright_part_text">
            <div class="row">
                <div class="col-lg-8">
                    <p class="footer-text m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> Website is made <i class="ti-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Catering Andri</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
                <!-- <div class="col-lg-4">
                     <div class="copyright_social_icon text-right">
                         <a href="#"><i class="fab fa-facebook-f"></i></a>
                         <a href="#"><i class="fab fa-twitter"></i></a>
                         <a href="#"><i class="ti-dribbble"></i></a>
                         <a href="#"><i class="fab fa-behance"></i></a>
                     </div>
                 </div> -->
            </div>
        </div>
    </div>
</footer>