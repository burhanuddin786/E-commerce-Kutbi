<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$active = 'dashboard';

$dashboard = new Dashboard();

$pembelian = $dashboard->getAllData('pembelian');
$totalPembelian = count($pembelian);

$pendingStatus = $dashboard->getStatusPending();
$pendingStatus = count($pendingStatus);

$totalProduk = $dashboard->getAllData('produk');
$totalProduk = count($totalProduk);

$statictic = $dashboard->pembelianStatictic();
$statictic = json_encode($statictic);

?>

<?php ob_start() ?>
  <div id="content" class="mb-4">
    <?php include '../../template/admin/nav-admin.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
              <div class="card-header text-center">Total Order</div>
              <div class="card-body text-center">
                <i class="fas fa-money-bill mb-3" style="font-size: 40px;"></i>
                <h5 class="card-title"><?= $totalPembelian ?> Order</h5>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
              <div class="card-header">Order Pending</div>
              <div class="card-body">
                <i class="fas fa-info-circle mb-3" style="font-size:40px;"></i>
                <h5 class="card-title"><?= $pendingStatus ?> Pending</h5>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-center">
          <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
              <div class="card-header">Total Produk</div>
              <div class="card-body">
                <i class="fas fa-tshirt mb-3" style="font-size:40px;"></i>
                <h5 class="card-title"><?= $totalProduk ?> Produk</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-primary">
                Grafik Penjualan
              </div>
              <div class="card-body">
              <canvas id="firstChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $content = ob_get_clean() ?>
  <!-- end #content  -->


<?php ob_start() ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
<?php $tops = ob_get_clean() ?>

<?php ob_start() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script>

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

var data = '<?php echo $statictic ?>';
data = JSON.parse(data);
var date = Object.keys(data);
var total = Object.values(data);

var ctx = document.getElementById('firstChart');
var firstChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: date,
        datasets: [{
            label: 'Total Transaksi',
            data: total,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            borderWidth: 2,
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                        return number_format(value);
                    }
                }
            }]
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
            }
        }
    }
    }
});
</script>
<?php $scripts = ob_get_clean() ?>

<?php include '../../template/admin/main.php' ?>