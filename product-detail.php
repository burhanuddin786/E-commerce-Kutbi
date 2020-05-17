<?php 
require_once 'core/init.php';
$datas = $produk->getProduk('id', Input::get('id'));
$active = 'belanja';
$title = 'Detail Produk | Kutbi Textile';
?>

<?php ob_start() ?>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">

					<div class="slick3">
						<div class="item-slick3" data-thumb="images/thumb-item-01.jpg">
							<div class="wrap-pic-w">
								<img src="produk_image/<?= $datas['foto'] ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?= $datas['nama'] ?>
				</h4>

				<span class="m-text17">
                Rp. <?= number_format($datas['harga']) ?>
				</span>

				<p class="s-text8 p-t-10">
					<?= substr($datas['deskripsi'], 0, 100) ?> ...
				</p>

				<!--  -->
				<form action="cart-request.php" method="GET">
				<div class="p-t-33 p-b-60">
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button id="minus" class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="1">
								<input type="hidden" name="id" value="<?= $datas['id'] ?>">
								<button id="plus" class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                               
                                <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
								</button>
								
							</div>
						</div>
					</div>
				</div>
				</form>

				<div class="p-b-45">
					<span class="s-text8">Categories: </span>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Deskripsi
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?= $datas['deskripsi'] ?>
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Informasi tambahan
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>

			
			</div>
		</div>
	</div>




<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
$(document).ready(function(){
	$('#plus').click(function(){
		var value = parseInt($('.num-product').val()) + 1;
		$('.num-product').val(value);
	});
});
</script>
<?php $scripts = ob_get_clean() ?>

<?php include 'template/main.php'; ?>
