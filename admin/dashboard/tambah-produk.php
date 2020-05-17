<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$datas = $produk->getAllData('kategori');
$errors     = array();
if (Input::get('submit')) {
    $validation = new Validation();
    $validation = $validation->check(array(
        'nama'      => array(
                        'required' => true,
                        'min'      => 3,
                        'max'      => 100
                        ),
        'harga'     => array(
                        'required' => true,
                        'min'      => 1,
                        'max'      => 25
                        ),
        'deskripsi' => array(
                        'required' => true,
                        'min'      => 5
                        ),
        'qty'       => array(
                        'required' => true,
                        )
    ));

    if ($validation->passed()) {
        $file = $_FILES['foto']['name'];
        $loc  = $_FILES['foto']['tmp_name'];
        move_uploaded_file($loc, "../../produk_image/".$file);
        $data = array(
            'nama'          => Input::get('nama'),
            'harga'         => Input::get('harga'),
            'id_kategori'   => Input::get('kategori'),
            'deskripsi'     => Input::get('deskripsi'),
            'foto'          => $file,
            'qty'           => Input::get('qty'),
        );
    
        $produk->addProduk($data);

        echo "<script>alert('Produk sukses di tambah.'); window.location.href='produk-table.php'</script>";
    } else {
        $errors = $validation->errors();
        echo "<script>alert('Produk gagal di tambah.'); window.reload();</script>";
    }
}
$active = 'produk';
?>

<?php ob_start() ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
    <div class="container">
        <div class="row">
        <div class="frameForm offset-md-2 col-md-8">
            <h2 class="text-center uppercase">Tambah Produk</h2>
            <form action="tambah-produk.php" class="mb-4" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input class="form-control" type="text" name="nama">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input class="form-control" type="number" name="harga">
                </div>
                <div class="form-group">
                    <!-- <label for="">Kategori</label>
                    <input class="form-control" type="text" name="kategori"> -->
                    <select class="custom-select" name="kategori">
                        <option selected>Pilih Kategori</option>
                        <?php foreach ($datas as $kat) {
    ?>
                            <option value=<?= $kat['id'] ?>><?= $kat['nama'] ?></option>
                        <?php
} ?>
                       
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Qty</label>
                    <input class="form-control" type="number" name="qty">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Gambar</label>
                    <input class="form-control" type="file" name="foto">
                </div>
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Tambah">
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