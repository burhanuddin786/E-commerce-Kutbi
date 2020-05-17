<?php $active='about'; $title = 'Tentang | Kutbi Textile';?>
<?php ob_start() ?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-04.jpg);">
		<h2 class="l-text2 t-center">
			Tentang
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="hov-img-zoom">
						<img src="assets/img/kutbi.jpg" alt="IMG-ABOUT">
					</div>
				</div>

				<div class="col-md-8 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">
						Tentang Kami
					</h3>

					<p class="p-b-28">
					Kutbi Textile merupakan toko kain yang berlokasi di jalan sulawesi no 49, Kota Denpasar, Bali. Toko kami 
					menjual berbagai macam kain untuk kebutuhan upacar agama, undangan, pakaian sehari-hari,dll. Motivasi toko kami
					adalah selalu memberikan yang terbaik kepada konsumen agar konsumen selalu puas dan akan terus berbelanja di toko kami.
					kami selalu mendatangkan barang baru agar konsumen memiliki banyak variasi yang dapat  dipilih dan lebih senang dalam memilih.
					</p>

					<div class="bo13 p-l-29 m-l-9 p-b-10">
						<p class="p-b-11">
							Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn't really do it, they just saw something. It seemed obvious to them after a while.
						</p>

						<span class="s-text7">
							- Steve Job’s
						</span>
					</div>
				</div>
			</div>
		</div>
    </section>

<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>