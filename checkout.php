<?php
require_once 'core/init.php';
if (empty($_SESSION['cart'])) {
    header('Location: product.php');
}
$title = 'Checkout | Kutbi Textile';
$active = 'belanja';


// Playground
$rajaOngkir = new RajaOngkir();

$provinces = $rajaOngkir->getProvince();
?>

<?php ob_start() ?>
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets/img/banner-03.jpg);">
		<h2 class="l-text2 t-center">
			Checkout
		</h2>
	</section>

	<!-- content page -->
	<section class=" p-t-66 p-b-38">
		<div class="container">
			<div class="row">
                <div class="col-md-6">
                    <?php
                        if (empty($_SESSION['customer'])) {
                            ?>
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
                    <?php
                        } else { ?>
                            <form action="courier.php" method="post">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input style="border:1px solid #e6e6e6 !important" class="form-control" type="text" name="nama" value="<?= Session::get('customer')['nama'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input style="border:1px solid #e6e6e6 !important" class="form-control" type="email" name="email" value="<?= Session::get('customer')['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No Telpon</label>
                                <input style="border:1px solid #e6e6e6 !important" class="form-control" type="text" name="no_telp" value="<?= Session::get('customer')['no_telp'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <select style="border:1px solid #e6e6e6 !important" class="form-control province" name="provinsi">
                                    <option value="0">Pilih Provinsi</option>
                                    <?php
                                        foreach ($provinces as $value) {
                                            ?>
                                        <option value="<?= $value['province_id'] ?>"><?= $value['province'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kota</label>
                                <select style="border:1px solid #e6e6e6 !important" class="form-control city" name="kota">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input style="border:1px solid #e6e6e6 !important" class="form-control" type="text" name="alamat" value="<?= Session::get('customer')['alamat'] ?>">
                            </div>
                            <div class="form-group">
                            <input style="max-width:100px; min-height:35px" class="float-right flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" name="submit" value="Lanjut">
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <h2>Pesanan</h2>
                    <table class="table">
                        <thead>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub. Total</th>
                        </thead>
                        <tbody>
                            <?php foreach (Session::get('cart') as $id => $value) {?>
                            <?php $datas = $produk->getProduk('id', $id) ?>
                            <tr>
                                <td><?= $datas['nama'] ?></td>
                                <td>Rp. <?= number_format($datas['harga']) ?></td>
                                <td><?= $value ?></td>
                                <td>Rp. <?= number_format($hasil[] = $datas['harga'] * $value) ?></td>
                            </tr>
                            <?php } ?>
                        <tr>
                            <td><strong>Total:</strong></td>
                            <td colspan="2"></td>
                            <td><strong><?= number_format(array_sum($hasil)) ?></strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
    </section>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<link rel="stylesheet" href="assets/css/select2.min.css">
<?php $tops = ob_get_clean() ?>

<?php ob_start() ?>
<script src="assets/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    $('.province').select2();

    // $('.city').prop('disabled', 'disabled');

    $('.province').on('change', function (e) {
        var idprovince = $(this).val();
        $('.city').select2({
            ajax: {
                url: 'rajaongkir.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    idprov: idprovince
                },
                processResults: function(response){
                    var res = [];

                    $.each(response, function(key, value){
                        res.push(value);
                    })

                    return {
                        results: res
                    };
                }
            }
        });
        // $.ajax({
        //     type: 'POST',
        //     url: 'rajaongkir.php',
        //     data: {
        //         idprov: idprovince
        //     },
        //     success: function(response){
        //         console.log(response);
                
        //         var res = JSON.parse(response)
        //         var dataCity = [];
        //         $.each(res, function(key, value){
        //             dataCity.push({id: value.city_id, text: value.city_name}) 
        //         })  
        //         $('.city').select2({data: dataCity});

        //         console.log(dataCity);
                
        //     },
        //     error: function(xhr)
        //     {
        //         console.log(xhr);
        //     }
        // });
        
    });

});
</script>
<?php $scripts = ob_get_clean() ?>

<?php include 'template/main.php'; ?>
