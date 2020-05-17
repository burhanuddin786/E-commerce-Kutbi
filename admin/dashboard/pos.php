<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$produk = new Pos();
$produkClass = new Produk();
// $produkClass->getProduk('id', $id);
$datas = $produk->getAllData('produk');

$i = 1;
$active = 'pos';

// unset($_SESSION['cart_admin']);

?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                    <?php
                        foreach ($datas as $data) {
                            ?>
                        <div class="col-md-4 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="../../produk_image/<?= $data['foto'] ?>" alt="Card image cap">
                            <div class="card-body text-center">
                            <h5 class="card-title text-capitalize">
                            <?= $data['nama'] ?>
                            </h5>
                            <p class="text-dark">
                            Stok: <?= $data['qty'] ?>
                            </p>
                                <form action="cart-request.php" class="text-center mt-4" method="POST">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="number" class="form-control" id="inlineFormInputGroup" value="<?= $data['harga'] ?>" readonly>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Qty</div>
                                        </div>
                                        <input type="qty" name="qty" class="form-control" id="inlineFormInputGroup" min="1" value="1">
                                    </div>
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm form-control">
                                        Tambah ke keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <table class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_SESSION['cart_admin'])) {
                            foreach (Session::get('cart_admin') as $id => $value) {
                                $products = $produkClass->getProduk('id', $id)
                        ?>
                        <tr>
                            <th scope="row" class="text-left"><?= $products['nama'] ?></th>
                            <td><?= $value ?></td>
                            <td><?= $hasil[] =  $products['harga'] * $value ?></td>
                            <td><a href="cart-delete.php?id=<?= $id ?>"><i class="fas fa-trash-alt text-danger"></i></a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr class="table-active">
                            <th colspan="3" class="text-left">Total</th>
                            <th><?= isset($hasil) ? number_format(array_sum($hasil)) : '' ?></th>
                        </tr>
                        <?php
                            if (isset($_SESSION['cart_admin'])) {
                                ?>
                        
                        <tr class="table-light">
                            <th colspan="4" class="text-right">
                                <a href="checkout.php" class="btn btn-primary btn-sm">Checkout</a>
                            </th>
                        </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean() ?>
    <!-- end #content -->
    
 <?php include '../../template/admin/main.php' ?>