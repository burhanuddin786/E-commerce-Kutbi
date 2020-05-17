<?php
require_once '../../core/init.php';
if (!Session::exists('email') && !Session::exists('cart_admin')) {
    header('Location: ../index.php');
}
$active = 'pos';

$dataUser = $user->getData('email', Session::get('email'));

?>

<?php ob_start() ?>
  <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
      <div class="container">
        <form action="order.php" method="POST">
        <div class="row">
            <div class="col-md-8">
                
                    <div class="form-row">
                        <div class="col">
                            <label for="">Nama Kasir</label>
                            <input class="form-control" type="text" name="nama" id="" value="<?= $dataUser['nama'] ?>" readonly>
                        </div>
                        <div class="col">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="lunas">Lunas</option>
                                <option value="bon">BON</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-4" id="nama-wrapper">
                        <label for="">Nama Customer</label>
                        <input type="text" name="nama_customer" id="nama" class="form-control">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
               
            </div>
            <div class="col-md-4">
                <table class="table">
                    <thead class="thead-dark">
                        <th>Nama Item</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub. Total</th>
                    </thead>
                    <tbody>
                        <?php foreach (Session::get('cart_admin') as $id => $value) {?>
                        <?php $datas = $produk->getProduk('id', $id) ?>
                        <tr>
                            <td><?= $datas['nama'] ?></td>
                            <td>Rp. <?= number_format($datas['harga']) ?></td>
                            <td><?= $value ?></td>
                            <td>Rp. <?= $hasil[] = $datas['harga'] * $value ?></td>
                        </tr>
                        <?php } ?>
                    <tr>
                        <td><strong>Total:</strong></td>
                        <td colspan="2"></td>
                        <td><strong><?= array_sum($hasil) ?></strong></td>
                        <input type="hidden" name="total" value="<?= array_sum($hasil) ?>">
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
      </div>
    </div>
<?php $content = ob_get_clean() ?>
  <!-- end #content  -->

<?php include '../../template/admin/main.php' ?>