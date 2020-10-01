@include('layouts.app')
<html>
<head>

</head>
@yield('sidebar')
<body>
    <main class="dash-content">
        <div class="container-fluid">
            <div class="row dash-row">
                <div class="col-xl-4">
                    <div class="stats stats-primary">
                        <h3 class="stats-title"> Orders </h3>
                        <div class="stats-content">
                            <div class="stats-icon">
                                <i class="fas fa-badge-check"></i>
                            </div>
                            <div class="stats-data">
                            <div class="stats-number">{{$count}}</div>
                                <div class="stats-change">
                                    
                                    <span class="stats-timeframe">Orders Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="stats stats-success ">
                        <h3 class="stats-title"> Revenue </h3>
                        <div class="stats-content">
                            <div class="stats-icon">
                                <i class="fas fa-cart-arrow-down"></i>
                            </div>
                            <div class="stats-data">
                            <div class="stats-number">{{$totalEarned}} <b>RS</b></div>
                                <div class="stats-change">
                                    
                                    <span class="stats-timeframe">Total Money Earned</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="stats stats-danger">
                        <h3 class="stats-title"> Ratings </h3>
                        <div class="stats-content">
                            <div class="stats-icon">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="stats-data">
                            <div class="stats-number">{{$getratings}}/5</div>
                            <span class="stats-timeframe">Average Ratings</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card spur-card">
                        <div class="card-header">
                            <div class="spur-card-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="spur-card-title"> This Weeks Orders </div>
                            <div class="spur-card-menu">
                                <div class="dropdown show">
                                    <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body spur-card-body-chart">
                            <canvas id="spurChartjsBar"></canvas>
                            <script>
                                var ctx = document.getElementById("spurChartjsBar").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                        datasets: [{
                                            label: 'Blue',
                                            data: [12, 19, 3, 5, 2],
                                            backgroundColor: window.chartColors.primary,
                                            borderColor: 'transparent'
                                        }]
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card spur-card">
                        <div class="card-header">
                            <div class="spur-card-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="spur-card-title"> Notifications </div>
                        </div>
                        <div class="card-body ">
                            <div class="notifications">
                                <a href="#!" class="notification">
                                    <div class="notification-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <div class="notification-text">New comment</div>
                                    <span class="notification-time">21 days ago</span>
                                </a>
                                <a href="#!" class="notification">
                                    <div class="notification-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <div class="notification-text">New comment</div>
                                    <span class="notification-time">21 days ago</span>
                                </a>
                                <a href="#!" class="notification">
                                    <div class="notification-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <div class="notification-text">New comment</div>
                                    <span class="notification-time">21 days ago</span>
                                </a>
                                <div class="notifications-show-all">
                                    <a href="#!">Show all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>