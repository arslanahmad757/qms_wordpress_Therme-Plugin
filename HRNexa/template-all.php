<?php
/* 
Template Name: All Queries
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
                                <li class="breadcrumb-item active" aria-current="page">All Queries</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <div class="container-fluid">
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

            <script>
                $(document).ready(function() {
                    // Handle click event of the 'Details' button
                    $('.view-details').click(function() {
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

                        // Handle form submission
                        $('#queryDetails').on('submit', '#updateStatusForm', function(event) {
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
                });
            </script>
            <!-- ============================================================== -->
            <div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- title -->
                            <div class="d-md-flex">
                                <div>
                                    <h4 class="card-title">All Quiries</h4>
                                    <h5 class="card-subtitle"></h5>
                                </div>
                                <div class="ms-auto">
                                    <div class="dl">
                                    </div>
                                </div>
                            </div>
                            <!-- title -->
                        </div>
                        <div class="table-responsive">
                            <?php
                            // Retrieve the global WordPress database object
                            global $wpdb;

                            // Define your table name
                            $table_name = $wpdb->prefix . 'custom_queries';

                            // Query to retrieve 25 records that are not viewed or new
                            $query = $wpdb->prepare("SELECT * FROM $table_name ORDER BY Date DESC");

                            // Execute the query
                            $results = $wpdb->get_results($query);

                            // Check if there are results
                            if ($results) {
                                // Output table headers
                                echo '<table class="table v-middle><thead>';
                                echo '<tr class="bg-light">';
                                echo '<th class="border-top-0 ">Submitter ID</th>';
                                echo '<th class="border-top-0 ">Name</th>';
                                echo '<th class="border-top-0 ">Query Category</th>';
                                echo '<th class="border-top-0 ">Priority Level</th>';
                                echo '<th class="border-top-0 ">Status</th>';
                                echo '<th class="border-top-0 ">Date Submitted</th>';
                                echo '<th class="border-top-0 ">View</th>';
                                echo '</tr></thead><tbody>';

                                // Loop through the results and display them
                                foreach ($results as $result) {
                                    $bg_color = '';
                                    $bg_color = ($result->Viewed == 1) ? "#dee3ed" : ""; // Ternary operator to set background color
                                    echo '<tr style="background-color: ' . $bg_color . ';">';

                                    echo '<td style="background-color: ' . $bg_color . ';">' . $result->QueryID . '</td>';
                                    echo '<td style="background-color: ' . $bg_color . ';">' . $result->EmployeeName . '</td>';
                                    echo '<td style="background-color: ' . $bg_color . ';">' . $result->QueryCategory . '</td>';
                                    // Set label color based on priority level
                                    $label_class = '';
                                    switch ($result->PriorityLevel) {
                                        case 'high':
                                            $label_class = 'label label-danger';
                                            break;
                                        case 'normal':
                                            $label_class = 'label label-warning';
                                            break;
                                        case 'low':
                                            $label_class = 'label label-primary';
                                            break;
                                        default:
                                            $label_class = 'label label-default';
                                            break;
                                    }

                                    // Output priority level with label color
                                    echo '<td style="background-color: ' . $bg_color . ';"><label class="' . $label_class . '">' . $result->PriorityLevel . '</label></td>';

                                    echo '<td style="background-color: ' . $bg_color . ';">' . $result->Status . '</td>';
                                    echo '<td style="background-color: ' . $bg_color . ';">' . $result->Date . '</td>';
                                    echo '<td style="background-color: ' . $bg_color . ';"><button type="button" class="btn btn-primary view-details" data-toggle="modal" data-target="#detailsModal" data-queryid="' . $result->QueryID . '">Details</button></td>';
                                    echo '</tr>';
                                }

                                echo '<tbody></table>';
                            } else {
                                echo 'No records found.';
                            }
                            ?>
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            Developed by <a href="https://www.wrappixel.com"> ByteNexus </a>.
        </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<?php
wp_footer();
?>