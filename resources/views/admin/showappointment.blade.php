<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kanna Dentist Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css2/style.css') }}">
    <!-- Custom CSS for the page -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin/appointment.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('/assets/img/kanna_fav.png') }}" />
</head>

<body>
    <!-- Loading overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div>Loading...</div>
    </div>

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <div class="table-container">
                <select id="doctor-filter">
                    <option value="" disabled selected>Filter by Doctor</option>
                    <option value="Dr. Walter White">Dr. Walter White</option>
                    <option value="Dr. Sarah Jhonson">Dr. Sarah Jhonson</option>
                    <option value="Dr. William Anderson">Dr. William Anderson</option>
                    <option value="Dr. Amanda Jepson">Dr. Amanda Jepson</option>
                </select>

                <select id="status-filter">
                    <option value="" disabled selected>Filter by Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Canceled">Canceled</option>
                </select>

                <button id="reset-filters-btn" class="btn btn-secondary">Reset Filters</button>
                <a href="{{ route('appointments.exportPDF') }}" class="btn btn-secondary cursor-pointer">
                    Export to PDF
                </a>
                <table>
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Name Doctor</th>
                            <th>Service</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Proof</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $appoint)
                            <tr id="appointment-{{ $appoint->id }}" data-doctor="{{ $appoint->doctor }}"
                                data-status="{{ $appoint->status }}">
                                <td>{{ $appoint->name }}</td>
                                <td>{{ $appoint->email }}</td>
                                <td>{{ $appoint->phone }}</td>
                                <td>{{ $appoint->appointment_date }}</td>
                                <td>{{ $appoint->doctor }}</td>
                                <td>{{ $appoint->services }}</td>
                                <td>{{ $appoint->message }}</td>
                                <td>
                                    <span id="status-{{ $appoint->id }}"
                                        class="status {{ $appoint->status === 'Accepted' ? 'status-accepted' : ($appoint->status === 'Canceled' ? 'status-canceled' : 'status-pending') }}">
                                        {{ $appoint->status }}
                                    </span>
                                </td>
                                <td>
                                    @if ($appoint->proof)
                                        <a href="{{ asset('storage/' . $appoint->proof) }}" target="_blank">View Proof</a>
                                    @else
                                        No Proof Uploaded
                                    @endif
                                </td>
                                <td>
                                    @if ($appoint->status === 'pending')
                                        <button id="accept-btn-{{ $appoint->id }}"
                                            class="btn btn-success action-button accept-btn"
                                            data-id="{{ $appoint->id }}">Accept</button>
                                        <button id="cancel-btn-{{ $appoint->id }}"
                                            class="btn btn-danger action-button cancel-btn"
                                            data-id="{{ $appoint->id }}">Cancel</button>
                                    @else
                                        <button class="btn btn-success action-button disabled">Accept</button>
                                        <button class="btn btn-danger action-button disabled">Cancel</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/admin/appointment.js') }}"></script>

    <!-- End custom js for this page -->
</body>

</html>
