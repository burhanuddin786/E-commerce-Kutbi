<?php
require_once 'core/init.php';
if (empty($_SESSION['cart'])) {
    header('Location: product.php');
}
$title = 'Pengiriman | Kutbi Textile';
$active = 'belanja';


// Playground
// ;
if (isset($_SESSION['checkout_data'])) {
    unset($_SESSION['checkout_data']);
}

Session::set('checkout_data', $_POST);

$rajaOngkir = new RajaOngkir();

$dataCourier = $rajaOngkir->getCost(Session::get('checkout_data')['kota']);

?>

<?php ob_start() ?>
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			Pengiriman
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row">
                <div class="col-md-6">
                    <h2 class="mb-4">Pilih Kurir</h2>
                    <form id="courier" action="order.php" method="POST">
                        <?php
                            foreach ($dataCourier as $key => $value) {
                                foreach ($value['cost'] as $cost) {
                                    ?>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="courier[]" id="" cost="<?= $cost['value'] ?>" value="<?= $value['service'] ?>" <?= $key == 0 ? 'checked' : '' ?> >
                                <label class="form-check-label" for="exampleRadios1">
                                   
                                        <strong>Rp. <?= number_format($cost['value']) ?></strong> 
                                        <br>
                                        JNE <?= $value['service'] ?>
                                        <br>
                                        <small>Estimasi Waktu: <?= $cost['etd'] ?> Hari</small>
                                </label>
                            </div>
                        <?php
                                }
                            }
                        ?>
                        <div class="form-group">
                            <input style="max-width:100px; min-height:35px" class="float-right flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" name="submit" value="Bayar">
                        </div>
                        <input type="hidden" name="sub_total" id="hidden_sub_total" value="">
                        <input type="hidden" name="total" id="hidden_total" value="">
                    </form>
                </div>
                <div class="col-md-6">
                    <h2>Pesanan</h2>
                    <table class="table">
                        <thead>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub. Total</th>
                        </thead>
                        <tbody>
                            <?php foreach (Session::get('cart') as $id => $value) {?>
                            <?php $datas = $produk->getProduk('id', $id) ?>
                            <tr>
                                <td><?= $datas['nama'] ?></td>
                                <td>Rp. <?= number_format($datas['harga']) ?></td>
                                <td><?= $value ?></td>
                                <td>Rp. <?= number_format($hasil[] = $datas['harga'] * $value) ?></td>
                            </tr>
                            <?php } ?>
                        <tr>
                            <td><strong>Total:</strong></td>
                            <td colspan="2"></td>
                            <td>Rp. <span id="total"></span></td>
                            <td class="d-none tmp-total"><?= array_sum($hasil) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
$(document).ready(function() {
    var tmpTotal = parseInt($('.tmp-total').text());
    var service = $('input[type="radio"]:checked').val();
    var cost = parseInt($('input[type="radio"]:checked').attr('cost'));
    var total = tmpTotal+cost;
    $('#total').html('<strong>'+total.toLocaleString('us', {maximumFractionDigits: 0})+'</strong>');
    var hidden_sub_total = $('#hidden_sub_total').val(tmpTotal);
    var hidden_total = $('#hidden_total').val(total);

    $('#courier input[type="radio"]').on('change', function(){
        service = $('input[type="radio"]:checked').val();
        cost = parseInt($('input[type="radio"]:checked').attr('cost'));
        total = tmpTotal+cost;
        $('#total').html('<strong>'+total.toLocaleString('us', {maximumFractionDigits: 0})+'</strong>');
        hidden_sub_total = $('#hidden_sub_total').val(tmpTotal);
        hidden_total = $('#hidden_total').val(total);
    });
});
</script>
<?php $scripts = ob_get_clean() ?>

<?php include 'template/main.php'; ?>
