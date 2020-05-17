<?php
require_once 'core/init.php';
$datas = $produk->getAllData('produk');
$data2 = $produk->getAllData('kategori');
$title = 'Produk | Kutbi Textile';
$active = 'belanja';

if (isset($_GET['q'])) {
	$datas = $produk->searchProduct(Input::get('q'));
}

?>

<?php ob_start() ?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			KUTBI TEXTILE
		</h2>
		<p class="m-text13 t-center">
			Bahan &amp; Kualitas Terbaik
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Kategori
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="" class="s-text13 active1">
									Semua
								</a>
							</li>
							<?php foreach ($data2 as $kat) {
    ?>
							<li class="p-t-4">
								<a href="kategori.php?id=<?= $kat['id'] ?>" class="s-text13 active1">
									<?= $kat['nama'] ?>
								</a>
							</li>
							 <?php
} ?>	
						</ul>

						<!--  -->
						

						<div class="search-product pos-relative bo4 of-hidden">
							<form action="" method="GET">
								<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="q" placeholder="Cari Produk...">
								<button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
									<i class="fs-12 fa fa-search" aria-hidden="true"></i>
								</button>
							</form>

						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<!-- <option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option> -->
								</select>
							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Harga</option>
									<option>Rp.0.00 - Rp. 50.00</option>
								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							<!-- Showing 1–12 of 16 results -->
						</span>
					</div>

					<!-- Product -->
					<div class="row">
					<?php if(count($datas) != 0) : ?>
						<?php foreach ($datas as $data) : ?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img style="max-width:720px; max-height:960px;" src="produk_image/<?= $data['foto'] ?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												<a href="cart-request.php?id=<?= $data['id'] ?>&qty=1" style="color:#FFF;">Add to Cart</a>
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php?id=<?= $data['id'] ?>" class="block2-name dis-block s-text3 p-b-5">
										<?= $data['nama'] ?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										Rp. <?= number_format($data['harga']) ?>
									</span>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					<?php else: ?>	
					<h3 class="text-center">Produk tidak ditemukan....</h3>					
					<?php endif; ?>						
					</div>

					<!-- Pagination -->
					<!-- <div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div> -->
				</div>
			</div>
		</div>
	</section>

<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>