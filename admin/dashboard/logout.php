<?php
require_once '../../core/init.php';

session_destroy();
echo '<script>alert("Terimakasih!."); window.location.href="../login.php"</script>';
