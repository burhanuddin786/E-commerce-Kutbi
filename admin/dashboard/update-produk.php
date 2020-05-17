<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$errors     = array();
$datas = $produk->getProduk('id', Input::get('id'));

if (Input::get('submit')) {
    $file = $_FILES['foto']['name'];
    $loc  = $_FILES['foto']['tmp_name'];
    $dataWithFoto = array(
        'nama'          => Input::get('nama'),
        'foto'          => $file,
        'harga'         => Input::get('harga'),
        // 'hpp'           => Input::get('hpp'),
        'qty'           => Input::get('qty'),
        'deskripsi'     => Input::get('deskripsi'),
        'id_kategori'   => Input::get('kategori')
    );
    $dataNoFoto = array(
        'nama'          => Input::get('nama'),
        'harga'         => Input::get('harga'),
        // 'hpp'         => Input::get('hpp'),
        'qty'           => Input::get('qty'),
        'deskripsi'     => Input::get('deskripsi'),
        'id_kategori'   => Input::get('kategori')
    );
    if (!empty($loc)) {
        move_uploaded_file($loc, "../../produk_image/".$file);
        $produk->updateProduk($dataWithFoto, Input::get('id'));
    } else {
        $produk->updateProduk($dataNoFoto, Input::get('id'));
    }

    echo "<script>alert('Data Sukses di Ubah.'); window.location.href='produk-table.php'</script>";
}

$active = 'produk';
?>

<?php ob_start() ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
    <div class="container">
        <div class="row">
        <div class="frameForm offset-md-2 col-md-8">
            <h2 class="text-center uppercase">Edit Produk</h2>
            <form action="update-produk.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $datas['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input class="form-control" type="text" name="nama" value="<?= $datas['nama'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input class="form-control" type="number" name="harga" value="<?= $datas['harga'] ?>">
                </div>
                <div class="form-group">
                    <label for="">HPP</label>
                    <input class="form-control" readonly type="number" name="hpp" value="<?= $datas['hpp'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <input class="form-control" type="text" name="kategori" value="<?= $datas['id_kategori'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Qty</label>
                    <input class="form-control" type="text" name="qty" value="<?= $datas['qty'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="10"><?= $datas['deskripsi'] ?></textarea>
                </div>
                <div class="form-group">
                    <img src="../../produk_image/<?= $datas['foto'] ?>" style="max-width:250px;">
                </div>
                <div class="form-group">
                    <label for="">Ganti Gambar</label>
                    <input class="form-control" type="file" name="foto" value="<?= $datas['foto'] ?>">
                </div>
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Ubah">
            </form>
            <?php foreach ($errors as $value) {
    ?>
                <li><?= $value ?></li>
            <?php
} ?>
        </div>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean() ?>

<?php include '../../template/admin/main.php' ?>