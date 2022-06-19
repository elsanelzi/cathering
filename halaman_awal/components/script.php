    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="halaman_awal/assets/js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="halaman_awal/assets/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="halaman_awal/assets/js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="halaman_awal/assets/js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="halaman_awal/assets/js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="halaman_awal/assets/js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="halaman_awal/assets/js/owl.carousel.min.js"></script>
    <!-- swiper js -->
    <script src="halaman_awal/assets/js/slick.min.js"></script>
    <script src="halaman_awal/assets/js/gijgo.min.js"></script>
    <script src="halaman_awal/assets/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="halaman_awal/assets/js/custom.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="halaman_awal/assets/sweet alert2/sweetalert2.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script>
        const notification = $('.info-data').data('infodata');

        if (notification == "Berhasil Melakukan Pesanan" || notification == "Berhasil Diubah" || notification == "Berhasil Dihapus") {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: notification + '!',
            })
        } else if (notification == "Gagal Melakukan Pesanan" || notification == "Gagal Diubah" || notification == "Gagal Dihapus") {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: notification + '!',
            })
        } else if (notification == "Berhasil Dikonfirmasi" || notification == "Berhasil Dibatalkan") {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Pesanan ' + notification + '!',
            })

        } else if (notification == "Gagal Dikonfirmasi" || notification == "Gagal Dibatalkan") {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Pesanan ' + notification + '!',
            })
        } else if (notification == "Pembayaran Berhasil Dikonfirmasi" || notification == "Pembayaran Berhasil Dibatalkan") {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: notification + '!',
            })
        } else if (notification == "Pembayaran Gagal Dikonfirmasi" || notification == "Pembayaran Gagal Dibatalkan") {

        }


        // Script Sweet Alert Hapus
        $('.delete-data').on('click', function(e) {
            e.preventDefault();
            var getLink = $(this).attr('href');
            Swal.fire({
                title: 'Yakin Hapus Data?',
                text: "Secara Permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = getLink;
                }
            })
        });
    </script>