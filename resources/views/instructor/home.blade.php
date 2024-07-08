@extends('instructor.layouts.app')
@section('title', 'Intructor dashboard')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Students <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $studentToday }}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $studentPercentToday }}%</span> <span
                                            class="text-muted small pt-2 ps-1">{{ $studentPercentToday > 0 ? 'increase' : 'decrease' }}</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>${{ $revenueToday }}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $revenuePercentToday }}%</span> <span
                                            class="text-muted small pt-2 ps-1">{{ $revenuePercentToday > 0 ? 'increase' : 'decrease'  }}</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('instructor.home', ['type' => 'today']) }}">Today</a></li>
                                    <li><a class="dropdown-item" href="{{ route('instructor.home', ['type' => 'month']) }}">This Month</a></li>
                                    <li><a class="dropdown-item" href="{{ route('instructor.home', ['type' => 'year']) }}">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/{{ $type }}</span></h5>

                                <!-- Line Chart -->
                                <canvas id="reportsChart"></canvas>

                                <script type="module">
                                var ctx = document.getElementById('reportsChart').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: {!! $studentReportLabel !!},
                                        datasets: [{
                                            label: 'Total student',
                                            data: {!! $studentReportData !!},
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Selling </h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Preview</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Sold</th>
                                            {{-- <th scope="col">Revenue</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topSells as $sell)
                                            <tr>
                                                <th scope="row"><a href="#"><img src="{{ $sell->poster_url }}" alt=""></a>
                                                </th>
                                                <td><a href="#" class="text-primary fw-bold">{{ $sell->title }}</a></td>
                                                <td>${{ $sell->totalRevenue }}</td>
                                                <td class="fw-bold">{{ $sell->totalUsers }}</td>
                                            </tr>
                                        @endforeach
                                      
                                  
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Recent 10 Activity Order</h5>

                        <div class="activity">
                            @foreach ($enrollmentRecent as $recent)
                            <div class="activity-item d-flex">
                                <div class="activite-label">{{ calculateTimeDifference($recent->created_at) }}</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                   User '{{ $recent->user->username }}' has bought course <b>{{ $recent->title }}</b>
                                </div>
                            </div><!-- End activity item-->  
                            @endforeach

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->
@endsection