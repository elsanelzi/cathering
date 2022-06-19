<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="assets/css/img/default.png" alt="profil" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <span class="user-level"><?= $_SESSION['username']; ?></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="index.php">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($_SESSION['level'] == 'admin') : ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-coffee"></i>
                        </span>
                        <h4 class="text-section">Menu Administrator</h4>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Kelola Akun</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">

                                <li>
                                    <a href="?page=pages/admin/viewadmin">
                                        <i class="fas fa-user"></i>
                                        <span>Kelola Admin</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?page=pages/pimpinan/viewpimpinan">
                                        <i class="fas fa-users"></i>
                                        <span>Kelola Pimpinan</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="?page=pages/paket/viewpaket">
                            <i class="fas fa-layer-group"></i>
                            <p>Kelola Paket</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#pesanan">
                            <i class="fas fa-file"></i>
                            <p>Pesanan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pesanan">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="?page=pages/pesanan/viewkelolapesanan">
                                        <i class="fas fa-book"></i>
                                        <span>Kelola Pesanan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?page=pages/pesanan/kelolapembayaran">
                                        <i class="fas fa-layer-group"></i>
                                        <span>Kelola Pembayaran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION['level'] == 'pimpinan') : ?>
                    <li class="nav-item">
                        <a href="?page=pages/lihatpengguna">
                            <i class="fas fa-user"></i>
                            <p>Lihat Pengguna</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#laporan">
                        <i class="fas fa-id-card"></i>
                        <p>Laporan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="laporan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="?page=pages/laporan/viewlaporanpaket">
                                    <i class="fas fa-book"></i>
                                    <span>Laporan Paket</span>
                                </a>
                            </li>
                            <li>
                                <a href="?page=pages/laporan/viewlaporanpenjualan">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Laporan Penjualan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="?page=pages/profil_usaha/viewprofilusaha">
                        <i class="fas fa-id-card"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>