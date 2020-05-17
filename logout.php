<?php

require_once 'core/init.php';

unset($_SESSION['customer']);
unset($_SESSION['cart']);

echo '<script>alert("Terimakasih"); window.location.href="index.php"</script>';
