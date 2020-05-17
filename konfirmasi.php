<?php
require_once 'core/init.php';
$title = 'Konfirmasi Pembayaran | Kutbi Textile';
$active = 'belanja';

unset($_SESSION['cart']);

if (Input::get('submit')) {
    $transaction = new Transaksi();

    $file = $_FILES['image']['name'];
    $loc = $_FILES['image']['tmp_name'];
    move_uploaded_file($loc, "bukti_trf/".$file);

    $data = [
        'bukti' => $file,
    ];
    
    $transaction->updateProof($data, Input::get('order_id'));

    if ($transaction) {
        echo "<script>alert('Pesanan Berhasil Dibuat, Lakukan Cek Di Riwayat Pemesanan untuk Update informasi Pesanan'); window.location.href='product.php'</script>";
    } else {
        echo "<script>alert('Gagal! Periska form kembali.'); window.history.go(-1)'</script>";
    }
}

?>

<?php ob_start() ?>
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			Konfirmasi Pembayaran
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h2 class="text-center mb-4">Konfirmasi Pembayaran</h2>
                    <p class="mb-3">Harap melakukan pembayaran ke nomor rekening berikut:</p>
                    <h5 style="line-height: 35px" class="mb-4">
                        Burhan Bali <br>
                        BCA 7809387493
                    </h5>
                    <p>Setelah melakukan pembayaran, harap melakukan konfirmasi melalui website.</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <small>Order ID</small>
                            <input type="text" name="order_id" id="" value="<?= Input::get('orderid') ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <small>Tanggal Transfer</small>
                            <input type="date" name="date" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <small>Nama Pemilik Rekening</small>
                            <input type="text" name="name" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <small>Jumlah Transfer</small>
                            <input type="number" name="amount" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <small>Bukti Transfer</small>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Kirim" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>
