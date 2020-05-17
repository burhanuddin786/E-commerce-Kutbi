<?php
require_once 'core/init.php';
if (empty($_SESSION['customer'])) {
    header('Location: login-page.php');
}
$title = 'Riwayat Transaksi | Kutbi Textile';
$active = '';

$transaction = new Transaksi();

$datas1 = $transaction->getTransaksiJoinById('pembelian', 'customer', Input::get('id'), 'id_customer', 'id');
foreach ($datas1 as $data1);
$datas2 = $transaction->getTransaksiJoinById('pembelian_produk', 'produk', Input::get('id'), 'id_produk', 'id_pembelian');
$i = 1;

// echo '<pre>';
// print_r($datas1);
// echo '</pre>';
// die;
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
                <div class="col-md-6 text-detail">
                    <table class="table">
                        <tr>
                            <td>Order ID</td>
                            <td>:</td>
                            <td><?= $data1['order_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $data1['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pembelian</td>
                            <td>:</td>
                            <td><?= $data1['tanggal'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?= $data1['email'] ?></td>
                        </tr>
                        <tr>
                            <td>No Telpon</td>
                            <td>:</td>
                            <td><?= $data1['no_telp'] ?></td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td>:</td>
                            <td><?= $transaksi->getData('city', $data1['id_city'])[0]['province'] ?></td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>:</td>
                            <td><?= $transaksi->getData('city', $data1['id_city'])[0]['city_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $data1['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>Ekspedisi</td>
                            <td>:</td>
                            <td>JNE <?= $data1['courier'] ?></td>
                        </tr>
                        <tr>
                            <td>Resi</td>
                            <td>:</td>
                            <td><?= $data1['resi'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                <p class="text-dark">Bukti Transfer</p>
                    <?php
                        if ($data1['bukti'] != 'null') {
                            ?>
                    <img src="bukti_trf/<?=$data1['bukti']?>" class="mb-4 img-fluid" alt="">
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Sub Total</th>
                            <th>Total</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                        <?php foreach($datas2 as $data2) : ?>
                            <tr>
                                <th scope="col" class="text-center"><?= $i ?></th>
                                <td><?= $data2['nama'] ?></td>
                                <td><?= number_format($data2['harga']) ?></td>
                                <td><?= $data2['jumlah'] ?></td>
                                <td><?= number_format($data2['harga'] * $data2['jumlah']) ?></td>
                            </tr>
                        <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>
