<?php 
require_once 'core/init.php';
if (empty($_SESSION['cart'])) {
    header('Location: product.php');
}
$active = 'belanja';
$title = 'Keranjang | Kutbi Textile';
?>

<?php ob_start() ?>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-04.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
                            <th class="column-4 text-center">Quantity</th>
                            <th class="column-5">Total</th>
                            <th class="column-5">Delete</th>
						</tr>

                        <?php foreach (Session::get('cart') as $id => $value) {
    ?>
                        <?php $datas = $produk->getProduk('id', $id) ?>
						<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="produk_image/<?= $datas['foto'] ?>" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2"><?= $datas['nama'] ?></td>
							<td class="column-3"><?= number_format($datas['harga']) ?></td>
							<td class="column-4 text-center"><?= $value ?></td>
                            <td class="column-5"><?=  number_format($hasil[] =  $datas['harga'] * $value) ?></td>
                            <td class="column-5 text-center"><a href="cart-delete.php?id=<?= $id ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
						</tr>
                        <?php
} ?>

					</table>
				</div>
			</div>

			

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Cart Totals
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
                    <?= number_format(array_sum($hasil)) ?>
					</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<a href="checkout.php">
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Lanjut ke Pembayaran
					</button>
					</a>
				</div>
			</div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>