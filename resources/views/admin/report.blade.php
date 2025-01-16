<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kanna Dentist Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- LarapexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $chart->cdn() !!} <!-- Load chart's required CDN -->
    <!-- Custom styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <style>
        /* Custom styling for the chart */
        #chart {
            width: 100%;
            height: 70vh; /* 70% of the viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- Main Content Wrapper -->
    <div class="container-scroller">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Body Content -->
        <div class="container-fluid page-body-wrapper">
            <div class="row">
                <div class="col-12">
                    <h2>Appointments Report</h2>
                    <!-- Display the chart -->
                    <div id="chart">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>

            <!-- Other content like tables -->
            <div class="table-container">
                <!-- You can add your table here -->
            </div>
        </div>
    </div>

    <!-- Render the chart script -->
    {!! $chart->script() !!}
</body>

</html>
