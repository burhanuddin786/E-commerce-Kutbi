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
			Riwayat Transaksi
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">Riwayat Transaksi <?= $_SESSION['customer']['nama'] ?></h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Order ID</th>
                            <th>Tanggal</th>
                            <th>Sub Total</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pengiriman</th>
                            <th>Resi</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                        <?php foreach($datas as $data) : ?>
                            <tr>
                                <td><?= $data['order_id'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= number_format($data['sub_total']) ?></td>
                                <td><?= number_format($data['total']) ?></td>
                                <td><?= $data['status'] ?></td>
                                <td>JNE <?= $data['courier'] ?></td>
                                <td><?= $data['resi'] ?></td>
                                <td><a href="detail-riwayat-transaksi.php?id=<?= $data['id'] ?>" class="btn btn-primary btn-sm">Lihat</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>
