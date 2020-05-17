<?php
require_once 'core/init.php';
if (!empty($_SESSION['customer'])) {
    header('Location: product.php');
}
$title = 'Login | Kutbi Textile';
$active = '';
?>

<?php ob_start() ?>
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			Login
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input style="border:1px solid #e6e6e6 !important" class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group">
                        <input style="max-width:100px; min-height:35px" class="float-right flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" name="submit" value="Login">
                        </div>
                        <small>Belum punya akun? Silahkan daftar <a href="register-customer.php">disini.</a></small>
                    </form>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>
<?php include 'template/main.php'; ?>
