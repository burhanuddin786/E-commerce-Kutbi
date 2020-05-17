<?php 
require_once '../core/init.php';
include '../template/admin/header.php';

$errors = array();

if (Input::get('submit')) {
    $validation = new Validation();
    $validation = $validation->check(array(
        'email'     => array('required' => true),
        'password'  => array('required' => true),
    ));

    if ($validation->passed()) {
        if ($user->cekEmailExists(Input::get('email'))) {
            if ($user->loginAdmin(Input::get('email'), Input::get('password'))) {
                Session::set('email', Input::get('email'));
                echo '<script>alert("Login Sukses!."); window.location.href="dashboard/index.php"</script>';
            } else {
                echo '<script>alert("Login Gagal! Check email atau password anda!"); window.reload();</script>';
            }
        } else {
            echo '<script>alert("Login Gagal! Check email atau password anda!"); window.reload();</script>';
        }
    } else {
        echo '<script>alert("Login Gagal! Check email atau password anda!"); window.reload();</script>';
    }
}
?>

    <section>
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-4 col-md-4 frameLogin">
                <img src="../assets/img/logo_kutbi" alt="" class="imgLogin rounded mx-auto d-block">
                <form action="login.php" method="POST" class="loginForm">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                    <div class="col-auto">
                        <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                        <label class="form-check-label" for="autoSizingCheck">
                            Remember me
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="login">
                    </div>
                </form>
                <ul class="list-group">
            <?php foreach ($errors as $value) {
    ?>
                <li class="list-group-item list-group-item-danger"><?= $value ?></li>
            <?php
} ?>
</ul>
            </div>
        </div>
        
    </div>
    </section>

<?php include '../template/admin/footer.php'; ?>




