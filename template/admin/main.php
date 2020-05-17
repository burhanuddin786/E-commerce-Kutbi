<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="../../assets/css/datatables.min.css">
    <script src="../../assets/js/fontawesome-all.js"></script>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
    
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Kutbi Textile</h3>
                <strong>KT</strong>
            </div>

            <ul class="list-unstyled components">
                <li <?php echo($active == 'dashboard' ? "class='active'" : "") ?>>
                    <a href="index.php">
                        <i class="fas fa-chart-line"></i>
                        Dashboard
                    </a>
                </li>
                <li <?php echo($active == 'masterdata' ? "class='active'" : "") ?>>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-database"></i>
                        Admin
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="admin-table.php">Table Admin</a>
                        </li>
                        <li>
                            <a href="register.php">Register Admin</a>
                        </li>
                    </ul>
                </li>
                <li <?php echo($active == 'produk' ? "class='active'" : "") ?>>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cart-plus"></i>
                        Produk
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="produk-table.php">Table Produk</a>
                        </li>
                        <li>
                            <a href="tambah-produk.php">Tambah Produk</a>
                        </li>
                        <li>
                            <a href="category.php">Kategori</a>
                        </li>
                    </ul>
                </li>
                <li <?php if ($active == 'transaksi') {
    echo "class='active'";
} ?> >
                    <a href="transaksi.php">
                        <i class="fas fa-money-check-alt"></i>
                        Transaksi
                    </a>
                </li>
                <li <?php echo($active == 'pembelian' ? "class='active'" : "") ?>>
                    <a href="#pembelian" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cart-plus"></i>
                        Pembelian
                    </a>
                    <ul class="collapse list-unstyled" id="pembelian">
                        <li>
                            <a href="supplier.php">Pembelian</a>
                        </li>
                        <li>
                            <a href="pembelian-tabel.php">Tabel Pembelian</a>
                        </li>
                    </ul>
                </li>
                <li <?php echo($active == 'customer' ? "class='active'" : "") ?>>
                    <a href="customer-tabel.php">
                        <i class="fas fa-users"></i>
                        Customers
                    </a>
                </li>
                <li <?php echo($active == 'pos' ? "class='active'" : "") ?>>
                    <a href="#pos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cart-plus"></i>
                        POS
                    </a>
                    <ul class="collapse list-unstyled" id="pos">
                        <li>
                            <a href="pos.php">POS</a>
                        </li>
                        <li>
                            <a href="pos-tabel.php">Tabel Transaksi POS</a>
                        </li>
                    </ul>
                </li>
                <li <?php echo($active == 'laporan' ? "class='active'" : "") ?>>
                    <a href="laporan.php">
                        <i class="fas fa-book-open"></i>
                        Laporan
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="../../" class="download text-center"><i class="fas fa-eye"></i> View Website</a>
                </li>
            </ul>
        </nav>
        <!-- for content -->
        
        <?= $content ?>
    
        <!-- end content -->
        </div> 
<footer class="text-center mt-4">
   
    <p> &copy; Kutbi Textile - 2020</p>
   
</footer>


<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/datatables.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            $('.data').DataTable();
        });
</script>
<?= isset($scripts) ? $scripts : ''; ?>
</body>
</html>