@extends(backpack_view('blank'))

@section('content')

<!-- <div class="row">
	<div class="col-lg-6 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-body">
				<span class="card-title">Item Requested</span>
				<canvas id="requestedChart"></canvas>			
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-body">
				<span class="card-title">New Item</span>
				<canvas id="newItemChart"></canvas>	
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button type="button" class="btn text-white" style="background-color: rgb(3,169,244);width: 100%"><span style="font-size: 36px;">4</span><br>New Item Request</button>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button type="button" class="btn text-white" style="background-color: rgb(100,221,23);width: 100%"><span style="font-size: 36px;">1</span><br>Request Ready</button>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button type="button" class="btn text-white" style="background-color: rgb(244,67,54);width: 100%"><span style="font-size: 36px;">2</span><br>Rejected Request</button>
	</div>
</div> -->

<!-- /.row-->
<div class="row">
  <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-primary">
      <div class="card-body pb-0">
        <div class="btn-group float-right">
          <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-settings"></i></button>
          <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
        </div>
        <div class="text-value">3</div>
        <div>New Item Request</div>
      </div>
      <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
        <canvas class="chart" id="card-chart1" height="70"></canvas>
      </div>
    </div>
  </div>
  <!-- /.col-->
  <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-info">
      <div class="card-body pb-0">
        <button class="btn btn-transparent p-0 float-right" type="button"><i class="icon-location-pin"></i></button>
        <div class="text-value">2</div>
        <div>Waiting for approval</div>
      </div>
      <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
        <canvas class="chart" id="card-chart2" height="70"></canvas>
      </div>
    </div>
  </div>
  <!-- /.col-->
  <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-warning">
      <div class="card-body pb-0">
        <div class="btn-group float-right">
          <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-settings"></i></button>
          <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
        </div>
        <div class="text-value">9</div>
        <div>On Process</div>
      </div>
      <div class="chart-wrapper mt-3" style="height:70px;">
        <canvas class="chart" id="card-chart3" height="70"></canvas>
      </div>
    </div>
  </div>
  <!-- /.col-->
  <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-danger">
      <div class="card-body pb-0">
        <div class="btn-group float-right">
          <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-settings"></i></button>
          <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
        </div>
        <div class="text-value">8</div>
        <div>Request Rejected</div>
      </div>
      <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
        <canvas class="chart" id="card-chart4" height="70"></canvas>
      </div>
    </div>
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">Report</h4>
        <div class="small text-muted">January 2020</div>
      </div>
      <!-- /.col-->
      <div class="col-sm-7 d-none d-md-block">
        <button class="btn btn-primary float-right" type="button"><i class="icon-cloud-download"></i></button>
        <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
          <label class="btn btn-outline-secondary">
            <input id="option1" type="radio" name="options" autocomplete="off"> Day
          </label>
          <label class="btn btn-outline-secondary active">
            <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
          </label>
          <label class="btn btn-outline-secondary">
            <input id="option3" type="radio" name="options" autocomplete="off"> Year
          </label>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
    <div class="chart-wrapper" style="height:300px;margin-top:40px;">
      <canvas class="chart" id="main-chart" height="300"></canvas>
    </div>
  </div>
  <div class="card-footer">
    <div class="row text-center">
      <div class="col-sm-12 col-md mb-sm-2 mb-0">
        <div class="text-muted">Office Supplies</div><strong>17 New Item</strong>
        <div class="progress progress-xs mt-2">
          <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-sm-12 col-md mb-sm-2 mb-0">
        <div class="text-muted">Computer Supplies</div><strong>29 New Item</strong>
        <div class="progress progress-xs mt-2">
          <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-sm-12 col-md mb-sm-2 mb-0">
        <div class="text-muted">Canteen Supplies</div><strong>23 New Item</strong>
        <div class="progress progress-xs mt-2">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-sm-12 col-md mb-sm-2 mb-0">
        <div class="text-muted">Business Support Dept</div><strong>Rp. 1.832.500 Expenses</strong>
        <div class="progress progress-xs mt-2">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-sm-12 col-md mb-sm-2 mb-0">
        <div class="text-muted">Cileungsi Warehouse</div><strong>Rp. 242.000</strong>
        <div class="progress progress-xs mt-2">
          <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('after_scripts')

<script type="text/javascript">
	// var ctx = document.getElementById('requestedChart').getContext('2d');
	// var req = new Chart(ctx, {
	//     // The type of chart we want to create
	//     type: 'pie',

	//     // The data for our dataset
	//     data: {
	//         datasets: [{
	// 	        data: [10, 20],
	// 	        backgroundColor: ['rgb(3,169,244)', 'rgb(100,221,23)'],
	// 	    }],

	// 	    // These labels appear in the legend and in the tooltips when hovering different arcs
	// 	    labels: [
	// 	        'Complete',
	// 	        'Incomplete'
	// 	    ],
	//     },

	//     // Configuration options go here
	//     options: {}
	// });
	// var ctx = document.getElementById('newItemChart').getContext('2d');
	// var newitem = new Chart(ctx, {
	//     // The type of chart we want to create
	//     type: 'polarArea',

	//     // The data for our dataset
	//     data: {
	//         datasets: [{
	// 	        data: [10, 20, 30],
	// 	        backgroundColor: ['rgb(244,67,54)', 'rgb(100,221,23)', 'rgb(3,169,244)'],
	// 	    }],

	// 	    // These labels appear in the legend and in the tooltips when hovering different arcs
	// 	    labels: [
	// 	        'Alat Tulis Kantor',
	// 	        'Computer Supplies',
	// 	        'Canteen Supplies'
	// 	    ],
	//     },

	//     // Configuration options go here
	//     options: {}
	// });

	// Disable the on-canvas tooltip
	Chart.defaults.global.pointHitDetectionRadius = 1;
	// Chart.defaults.global.tooltips.enabled = false;
	Chart.defaults.global.tooltips.mode = 'index';
	Chart.defaults.global.tooltips.position = 'nearest';
	// Chart.defaults.global.tooltips.custom = CustomTooltips; // eslint-disable-next-line no-unused-vars

	var cardChart1 = new Chart($('#card-chart1'), {
	  type: 'line',
	  data: {
	    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	    datasets: [{
	      label: 'My First dataset',
	      backgroundColor: getStyle('--primary'),
	      borderColor: 'rgba(255,255,255,.55)',
	      data: [65, 59, 84, 84, 51, 55, 40]
	    }]
	  },
	  options: {
	    maintainAspectRatio: false,
	    legend: {
	      display: false
	    },
	    scales: {
	      xAxes: [{
	        gridLines: {
	          color: 'transparent',
	          zeroLineColor: 'transparent'
	        },
	        ticks: {
	          fontSize: 2,
	          fontColor: 'transparent'
	        }
	      }],
	      yAxes: [{
	        display: false,
	        ticks: {
	          display: false,
	          min: 35,
	          max: 89
	        }
	      }]
	    },
	    elements: {
	      line: {
	        borderWidth: 1
	      },
	      point: {
	        radius: 4,
	        hitRadius: 10,
	        hoverRadius: 4
	      }
	    }
	  }
	}); // eslint-disable-next-line no-unused-vars

	var cardChart2 = new Chart($('#card-chart2'), {
	  type: 'line',
	  data: {
	    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	    datasets: [{
	      label: 'My First dataset',
	      backgroundColor: getStyle('--info'),
	      borderColor: 'rgba(255,255,255,.55)',
	      data: [1, 18, 9, 17, 34, 22, 11]
	    }]
	  },
	  options: {
	    maintainAspectRatio: false,
	    legend: {
	      display: false
	    },
	    scales: {
	      xAxes: [{
	        gridLines: {
	          color: 'transparent',
	          zeroLineColor: 'transparent'
	        },
	        ticks: {
	          fontSize: 2,
	          fontColor: 'transparent'
	        }
	      }],
	      yAxes: [{
	        display: false,
	        ticks: {
	          display: false,
	          min: -4,
	          max: 39
	        }
	      }]
	    },
	    elements: {
	      line: {
	        tension: 0.00001,
	        borderWidth: 1
	      },
	      point: {
	        radius: 4,
	        hitRadius: 10,
	        hoverRadius: 4
	      }
	    }
	  }
	}); // eslint-disable-next-line no-unused-vars

	var cardChart3 = new Chart($('#card-chart3'), {
	  type: 'line',
	  data: {
	    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	    datasets: [{
	      label: 'My First dataset',
	      backgroundColor: 'rgba(255,255,255,.2)',
	      borderColor: 'rgba(255,255,255,.55)',
	      data: [78, 81, 80, 45, 34, 12, 40]
	    }]
	  },
	  options: {
	    maintainAspectRatio: false,
	    legend: {
	      display: false
	    },
	    scales: {
	      xAxes: [{
	        display: false
	      }],
	      yAxes: [{
	        display: false
	      }]
	    },
	    elements: {
	      line: {
	        borderWidth: 2
	      },
	      point: {
	        radius: 0,
	        hitRadius: 10,
	        hoverRadius: 4
	      }
	    }
	  }
	}); // eslint-disable-next-line no-unused-vars

	var cardChart4 = new Chart($('#card-chart4'), {
	  type: 'bar',
	  data: {
	    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April'],
	    datasets: [{
	      label: 'My First dataset',
	      backgroundColor: 'rgba(255,255,255,.2)',
	      borderColor: 'rgba(255,255,255,.55)',
	      data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98, 34, 84, 67, 82]
	    }]
	  },
	  options: {
	    maintainAspectRatio: false,
	    legend: {
	      display: false
	    },
	    scales: {
	      xAxes: [{
	        display: false,
	        barPercentage: 0.6
	      }],
	      yAxes: [{
	        display: false
	      }]
	    }
	  }
	}); // eslint-disable-next-line no-unused-vars

	var mainChart = new Chart($('#main-chart'), {
	  type: 'line',
	  data: {
	    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S'],
	    datasets: [{
	      label: 'Computer Supplies',
	      backgroundColor: hexToRgba(getStyle('--info'), 10),
	      borderColor: getStyle('--info'),
	      pointHoverBackgroundColor: '#fff',
	      borderWidth: 2,
	      data: [165, 180, 70, 69, 77, 57, 125, 165, 172, 91, 173, 138, 155, 89, 50, 161, 65, 163, 160, 103, 114, 185, 125, 196, 183, 64, 137, 95, 112, 175]
	    }, {
	      label: 'Office Supplies',
	      backgroundColor: 'transparent',
	      borderColor: getStyle('--success'),
	      pointHoverBackgroundColor: '#fff',
	      borderWidth: 2,
	      data: [92, 97, 80, 100, 86, 97, 83, 98, 87, 98, 93, 83, 87, 98, 96, 84, 91, 97, 88, 86, 94, 86, 95, 91, 98, 91, 92, 80, 83, 82]
	    }, {
	      label: 'Expenses',
	      backgroundColor: 'transparent',
	      borderColor: getStyle('--danger'),
	      pointHoverBackgroundColor: '#fff',
	      borderWidth: 1,
	      borderDash: [8, 5],
	      data: [65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65]
	    }]
	  },
	  options: {
	    maintainAspectRatio: false,
	    legend: {
	      display: false
	    },
	    scales: {
	      xAxes: [{
	        gridLines: {
	          drawOnChartArea: false
	        }
	      }],
	      yAxes: [{
	        ticks: {
	          beginAtZero: true,
	          maxTicksLimit: 5,
	          stepSize: Math.ceil(250 / 5),
	          max: 250
	        }
	      }]
	    },
	    elements: {
	      point: {
	        radius: 0,
	        hitRadius: 10,
	        hoverRadius: 4,
	        hoverBorderWidth: 3
	      }
	    }
	  }
	});
</script>

@stop