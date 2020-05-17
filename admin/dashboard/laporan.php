<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$customer = new Customer();

$datas = $customer->getAllData('customer');

$i = 1;
$active = 'laporan';

// echo '<pre>';
// print_r($datas);
// die;
// echo '</pre>';

?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                <form action="laporan-pdf.php" method="GET">
                <div class="form-row">
                    <div class="col">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" name="start" id="">
                    </div>
                    <div class="col">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" name="to" id="">
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean() ?>
    <!-- end #content -->
    
 <?php include '../../template/admin/main.php' ?>