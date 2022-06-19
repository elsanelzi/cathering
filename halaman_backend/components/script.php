<!-- Chart JS -->
<script src="assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- jQuery Vector Maps -->
<script src="assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert
<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script> -->
<!-- Sweet Alert 2 -->
<script src="assets/sweet alert2/sweetalert2.min.js"></script>
<!-- Atlantis JS 
    -->
<script src="assets/js/atlantis.min.js"></script>


<!--  -->
<script src="assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Sweet Alert 2 -->
<script>
    const notification = $('.info-data').data('infodata');

    if (notification == "Berhasil Disimpan" || notification == "Berhasil Diubah" || notification == "Berhasil Dihapus") {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data ' + notification + '!',
        })
    } else if (notification == "Gagal Disimpan" || notification == "Gagal Diubah" || notification == "Gagal Dihapus") {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data ' + notification + '!',
        })
    } else if (notification == "Berhasil Dikonfirmasi" || notification == "Berhasil Dibatalkan" || notification == "Berhasil Dikirim") {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Pesanan ' + notification + '!',
        })

    } else if (notification == "Gagal Dikonfirmasi" || notification == "Gagal Dibatalkan" || notification == "Gagal Dikirim") {
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