<?php
require_once 'core/init.php';
if (empty($_SESSION['customer'])) {
    header('Location: login-page.php');
}
$title = 'Riwayat Transaksi | Kutbi Textile';
$active = '';

$transaction = new Transaksi();

$datas = $transaction->getTransactionCustomer($_SESSION['customer']['id']);

?>

<?php ob_start() ?>
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			Profil
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">Profil <?= $_SESSION['customer']['nama'] ?></h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="update-customer.php" method="POST">
                        <input type="hidden" name="id" value="<?= $_SESSION['customer']['id'] ?>">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" id="" value="<?= $_SESSION['customer']['nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" id="" value="<?= $_SESSION['customer']['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input type="number" name="no_telp" class="form-control" id="" value="<?= $_SESSION['customer']['no_telp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="" value="<?= $_SESSION['customer']['alamat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" id="">
                            <small>* Kosongkan Jika Tidak Ingin Mengubah Password</small>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>
