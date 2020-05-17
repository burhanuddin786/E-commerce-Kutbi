<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$active = 'pembelian';

$belanja = new Belanja();

$products = $belanja->getproduct();

$datas = $belanja->getAllPembelianById(Input::get('id'));

if (Input::get('submit')) {
    $update = $belanja->updatePembelian(
        [
        'no_faktur' => Input::get('no_faktur'),
        'tanggal' => Input::get('tanggal'),
        'id_produk' => Input::get('produk'),
        'qty' => Input::get('qty'),
        'harga' => Input::get('harga'),
        'total' => Input::get('total'),
        ],
        Input::get('id')
    );

    echo "<script>alert('Data Sukses di Ubah.'); window.location.href='pembelian-tabel.php'</script>";
}

?>

<?php ob_start() ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
    <div class="container">
        <div class="row">
        <div class="frameForm offset-md-2 col-md-8">
            <h2 class="text-center uppercase">Pembelian</h2>
            <form action="" class="mb-4" method="POST">
                <div class="form-group">
                    <label for="">No Faktur</label>
                    <input class="form-control" type="text" name="no_faktur" value="<?= $datas[0]['no_faktur'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Pembelian</label>
                    <input class="form-control" type="date" name="tanggal" value="<?= date('Y-m-d', strtotime($datas[0]['tanggal'])) ?>">
                </div>
                <div class="form-group">
                    <label for="">Produk</label>
                    <select class="custom-select" name="produk">
                        <?php
                            foreach ($products as $product) {
                                ?>
                        <option <?= $product['id'] == $datas[0]['id_produk'] ? 'selected' : '' ?>  value="<?= $product['id'] ?>"><?= $product['nama'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input class="form-control" type="number" id="harga" name="harga" value="<?= $datas[0]['harga'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Qty</label>
                    <input class="form-control" type="number" id="qty" name="qty" value="<?= $datas[0]['qty'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Total</label>
                    <input class="form-control" type="number" id="total" name="total" value="<?= $datas[0]['total'] ?>" readonly>
                </div>
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Tambah">
            </form>
        </div>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
$(document).ready(function() {
    // var qty = $('#qty');
    // var harga = $('#harga');

    $('#qty').on('input', function(){
        var harga = $('#harga').val();
        var qty = $(this).val();
        var total = parseInt(qty) * parseInt(harga)
        
        $('#total').val(total);
    })
});
</script>
<?php $scripts = ob_get_clean() ?>

<?php include '../../template/admin/main.php' ?>