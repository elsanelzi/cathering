   <nav class="navbar navbar-expand-lg navbar-light">
       <a class="navbar-brand" href="?page=halaman_awal/home"> <img src="halaman_awal/assets/img/logocatering3.jpg" alt="logo" width="145px" height="70px"> </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
           <ul class="navbar-nav">
               <li class="nav-item">
                   <a class="nav-link" href="?page=halaman_awal/home">Home</a>
               </li>

               <li class="nav-item">
                   <a class="nav-link" href="?page=halaman_awal/pages/pesan/viewriwayatpesanan">Riwayat Pesanan</a>
               </li>

               <li class="nav-item">
                   <a class="nav-link" href="?page=halaman_awal/pages/pembayaran/viewpembayaran">Pembayaran</a>
               </li>
               <!-- <li class="nav-item">
                   <a class="nav-link" href="about.html">Produk</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="food_menu.html">Tentang Kami</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="chefs.html">Galeri</a>
               </li> -->
               <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="blog.html">Blog</a>
                                        <a class="dropdown-item" href="single-blog.html">Single blog</a>
                                        <a class="dropdown-item" href="elements.html">Elements</a>
                                    </div>
                                </li> -->
               <!-- <li class="nav-item">
                   <a class="nav-link" href="chefs.html">Testimonial</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="contact.html">Contact</a>
               </li> -->
           </ul>
       </div>
       <div class="menu_btn">
           <a href="?page=halaman_awal/pages/pesan/viewpesan" class="btn_1 d-none d-sm-block" style="margin-right:5px;">Pesan Sekarang</a>
       </div>
       <?php if (!isset($_SESSION['level_pelanggan'])) : ?>
           <div class="menu_btn">
               <a href="?page=halaman_awal/login/login" class="btn_1 d-none d-sm-block mr-1">Login</a>
           </div>

           <div class="menu_btn">
               <a href="halaman_backend" class="btn_1 d-none d-sm-block">Login Admin</a>
           </div>
       <?php else : ?>
           <div class="menu_btn">
               <a href="?page=halaman_awal/logout" class="btn_1 d-none d-sm-block">Logout</a>
           </div>
       <?php endif; ?>

   </nav>