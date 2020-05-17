<?php
require_once 'core/init.php';
if (!empty($_SESSION['customer'])) {
    header('Location: product.php');
}
$title = 'Register | Kutbi Textile';
$active = 'belanja';
?>

<?php ob_start() ?>
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			Register
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row">
                <div class="col-md-6">
                <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="text" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="">No Telpon</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="text" name="no_telp">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="text" name="alamat">
                        </div>
                        <div class="form-group">
                            <small>Sudah memiliki akun? <a href="login-page.php">Login disini.</a></small>
                        <input style="max-width:100px; min-height:35px" class="float-right flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" name="submit" value="Daftar">
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>
