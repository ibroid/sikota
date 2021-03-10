<div id="content">
  <?php Components::load('panel') ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Dashboard</h3>
        </div>
        <div class="panel-body">
          <canvas id="lineChart"></canvas>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var ctx = document.getElementById('lineChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
      datasets: [{
          label: 'Delegasi Masuk',
          data: [142, 97, 119, 110, 129, 97],
          borderColor: "rgb(255,153,51)",
          borderWidth: 1,
          fill: false,
        },
        {
          label: 'Delegasi Keluar',
          data: [152, 102, 111, 120, 97, 118],
          borderColor: "rgb(0,244,151)",
          borderWidth: 1,
          fill: false,
        }
      ]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: 'Data Statistic Jumlah Delegasi Per Bulan'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Bulan'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Nilai'
          }
        }]
      }
    }
  });
</script>