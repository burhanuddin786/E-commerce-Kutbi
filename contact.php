<?php $active='kontak';  $title = 'Kontak | Kutbi Textile'; ?>
<?php ob_start() ?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-04.jpg);">
		<h2 class="l-text2 t-center">
			Kontak
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3944.2465087580354!2d115.200492!3d-8.668091!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd24098996b9e03%3A0x4b15cf65074b900!2sToko%20Kutbi%20Textile!5e0!3m2!1sid!2sid!4v1580820733491!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
					</div>
				</div>

				<div class="col-md-6 p-b-30">
					<form class="leave-comment">
						<h4 class="m-text26 p-b-36 p-t-15">
							Hubungi kami
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nama">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Nomor Telepon">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Alamat Email">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Pesan"></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Kirim
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>

<?php include 'template/main.php'; ?>

