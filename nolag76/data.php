        </div><script src="js/jquery.min.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/metisMenu.min.js"></script><script src="js/raphael.min.js"></script><script src="../js/Chart.min.js"></script><script src="js/startmin.js"></script>
    </body>
</html>
<?php 
  $grafik = mysqli_query($kon, "SELECT COUNT(jumlah) as jumlah,jenisny FROM detail GROUP BY jenisny");

  $jenisny = []; $jumlah = [];
  while($baris=mysqli_fetch_array($grafik)){
    $jenisny[] = (string)$baris['jenisny']; $jumlah[] = (integer)$baris['jumlah'];
  } 
?>
<script>
  $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057', fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#statistik')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : <?php echo json_encode($jenisny); ?>,
      datasets: [
        {
          backgroundColor: '#333333', borderColor : '#337ab7',
          data           : <?php echo json_encode($jumlah); ?>
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode, intersect: intersect
      },
      hover              : {
        mode     : mode, intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          gridLines: {
            display : true, lineWidth : '4px', color : 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,
            callback: function (value, index, values) {
              if (value >= 1) {
                value /= 1
              }
              return + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
</script>
<script>
  $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#mostly')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : <?php echo json_encode($bulan1); ?>,
      datasets: [
        {
          backgroundColor: '#337ab7', borderColor : '#333333',
          data           : <?php echo json_encode($total1); ?>
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode, intersect: intersect
      },
      hover              : {
        mode     : mode, intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{ display: false, gridLines: { 
          display : false, lineWidth : '4px', color : 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,
            callback: function (value, index, values) {
              if (value >= 1) {
                value /= 1
              }
              return value + 'x'
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
</script>
