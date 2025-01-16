<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
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
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/message.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/img/kanna_fav.png" />
    <!-- Add these links in the <head> section of your HTML -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

</head>

<body>
    <!-- Loading overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div>Loading...</div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="success-modal">
        <div class="success-content">
            <p>Response sent successfully!</p>
            <button id="closeSuccessBtn">Close</button>
        </div>
    </div>

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->

        @include('admin.navbar')

        <!-- dashboard -->
        <div class="container-fluid page-body-wrapper">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="contact-messages">
                        <!-- Data will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Dialog -->
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Respond to Message</h2>
                <button id="closeModalBtn">&times;</button>
            </div>
            <div class="modal-body">
                <form id="responseForm">
                    <input type="hidden" id="messageId" name="messageId">
                    <div>
                        <label for="response">Response:</label>
                        <textarea id="response" name="response" rows="4" style="width: 100%;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="sendResponseBtn" type="button">Send</button>
                <button id="closeModalBtnFooter" type="button">Close</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/message.js') }}"></script>
</body>

</html>
