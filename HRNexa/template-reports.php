<?php
/* 
Template Name: Reports Page
*/
wp_head(); 
if ( ! current_user_can( 'administrator' ) && ! current_user_can( 'hr' ) ) {
    // If the user is not an administrator or hr, redirect them to the home page or any other page
    wp_redirect( home_url() );
    exit;
}
?>
<?php
// Access current user information
$current_user = wp_get_current_user();

// Check if user is logged in
if ($current_user->exists()) {
    // Access user information
    $first_name = $current_user->first_name;
    $last_name = $current_user->last_name;
    $profile_image = get_avatar_url($current_user->ID); // Get the URL of the user's profile picture
    $bio = get_user_meta($current_user->ID, 'description', true); // Get the user's bio from user meta
    $email = $current_user->user_email;
    $nickname = $current_user->user_nicename;
}
?>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md" style="background:#0c0f38;">
            <div class="navbar-header" data-logobg="skin5" style="background:#0c0f38; display: flex; justify-content: center;">
                <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
                    <b class="logo-icon">
                    <img style="border-radius:10px;width:3rem;" src="<?php echo get_template_directory_uri(); ?>/images/New.png" alt="homepage" class="light-logo" />
                    </b>
                </a>
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            </div>
        </nav>
    </header>



    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <!-- User Profile-->
                    <li>
                        <!-- User Profile-->
                        <div class="container d-flex flex-column justify-content-center align-items-center mt-4">
                            <img src="<?php echo $profile_image; ?>" alt="users" class="rounded-circle" width="80" />
                            <h5 class="m-b-0 user-name font-medium"><?php echo $first_name; ?></h5>
                            <span class="m-b-0 user-email font-medium"><?php echo $email; ?></span>
                        </div>
                        <!-- End User Profile-->
                    </li>
                    </li>
                    <!-- User Profile-->
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="https://localhost/qms/dashboard/" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="https://localhost/qms/profiles/" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="https://localhost/qms/all-queries/" aria-expanded="false"><i class="mdi mdi-border-all"></i><span class="hide-menu">All Queries</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="https://localhost/qms/reports/" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Reports</span></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Live Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="detailsModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Query Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" id="queryDetails">
                        <!-- Details will be loaded here via AJAX -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                // Handle click event of the 'Details' button
                $(document).on('click', '.view-details', function() {
                    var queryID = $(this).data('queryid');
                    // AJAX call to fetch the details of the selected record
                    $.ajax({
                        url: ajax_object.ajax_url, // WordPress AJAX URL
                        type: 'POST',
                        data: {
                            action: 'update_query_status', // AJAX action name
                            queryID: queryID
                        },
                        success: function(response) {
                            $('#queryDetails').html(response);
                        },
                        error: function(xhr, status, error) {
                            // Display an error message
                            $('#queryDetails').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                        }
                    });
                });

                // Handle form submission
                $(document).on('submit', '#updateStatusForm', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    var formData = $(this).serialize(); // Serialize form data

                    // AJAX call to update status field
                    $.ajax({
                        url: ajax_object.ajax_url, // WordPress AJAX URL
                        type: 'POST',
                        data: formData + '&action=update_query_status_submit', // Additional action for form submission
                        success: function(response) {
                            // Display success message or handle response
                            $('#queryDetails').html("Status Changed");
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Display an error message
                            console.error(error);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $(document).ready(function() {
                    // Handle keyup event of the search input
                    $('#searchInput').on('keyup', function() {
                        var searchText = $(this).val(); // Get input value
                        // AJAX call to retrieve filtered data
                        $.ajax({
                            url: ajax_object.ajax_url, // WordPress AJAX URL
                            type: 'POST',
                            data: {
                                action: 'filter_queries', // AJAX action name
                                search_text: searchText // Pass the search text
                            },
                            success: function(response) {
                                // Update the table with filtered data
                                $('.table-responsive').html(response);
                            },
                            error: function(xhr, status, error) {
                                // Display an error message
                                console.error(error);
                            }
                        });
                    });
                });

            });
        </script>

        <div class="container-fluid">
            <div class="row">

                <script>
                    jQuery(document).ready(function($) {
                        $('#downloadForm').submit(function(event) {
                            event.preventDefault(); // Prevent form submission
                            var name = $('#inputName').val();
                            $.ajax({
                                url: ajax_object.ajax_url, // WordPress AJAX URL
                                type: 'POST',
                                data: {
                                    action: 'process_download_request', // AJAX action name
                                    name: name
                                },
                                success: function(response) {
                                    // Trigger file download
                                    var blob = new Blob([response], {
                                        type: 'text/csv'
                                    });
                                    var link = document.createElement('a');
                                    link.href = window.URL.createObjectURL(blob);
                                    link.download = 'download.csv';
                                    link.click();
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6">
                        <form id="downloadForm" action="" method="get" class="row">
                            <div class="col-md-8 mb-3">
                                <input type="text" id="inputName" name="name" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <button type="submit" class="btn btn-success w-100" id="downloadButton"><i class="fas fa-download  mr-2"></i>Download</button>
                            </div>
                        </form>
                    </div>
                </div>


                <script>
                    jQuery(document).ready(function($) {
                        $('#downloadButton2').click(function() {
                            var startDate = $('#start_date').val();
                            var endDate = $('#end_date').val();
                            // AJAX request to process and download data
                            $.ajax({
                                url: ajax_object.ajax_url, // WordPress AJAX URL
                                type: 'POST',
                                data: {
                                    action: 'process_date_range_download_request', // AJAX action name
                                    start_date: startDate,
                                    end_date: endDate
                                },
                                success: function(response) {
                                    // Trigger file download
                                    var blob = new Blob([response], {
                                        type: 'text/csv'
                                    });
                                    var link = document.createElement('a');
                                    link.href = window.URL.createObjectURL(blob);
                                    link.download = 'download.csv';
                                    link.click();
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        });
                    });
                </script>

                <div class="row">
                    <form action="" method="get" class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" class="form-control" name="start_date">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" class="form-control" name="end_date">
                            </div>
                            <div class="col-md-4">
                                <label for="downloadButton2">Download</label>
                                <button type="button" class="btn btn-success w-100 mb-3" id="downloadButton2" name="downloadButton2"><i class="fas fa-download mr-2"></i>Download</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- title -->
                            <div class="d-md-flex">
                                <div>
                                    <h4 class="card-title">Live Search</h4>
                                    <h5 class="card-subtitle"></h5>
                                </div>
                            </div>

                            <!-- Search bar -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search by employee name">
                            </div>


                        </div>
                        <div class="table-responsive">
                            <!-- Your PHP code goes here -->

                            <!-- Your PHP code goes here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer text-center">
    Developed by <a href="https://www.wrappixel.com"> ByteNexus </a>.
</footer>
</div>

</div>
<?php
wp_footer();
?>