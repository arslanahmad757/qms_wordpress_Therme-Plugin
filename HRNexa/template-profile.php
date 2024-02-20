<?php
/* 
Template Name: Profile Page
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
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
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
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
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
                    <h4 class="page-title">Profile Page</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-7">

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30"> <img src=" <?php echo $profile_image ?>" class="rounded-circle" width="150" />
                                <h4 class="card-title m-t-10"><?php echo $first_name . $last_name ?></h4>
                                <h6 class="card-subtitle"><?php echo $nickname ?></h6>
                                <div class="row text-center justify-content-md-center">
                                    <?php echo $bio ?>
                                </div>
                            </center>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body"> <small class="text-muted">Email address </small>
                            <h6><?php echo $email ?></h6>

                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe width="100%" height="150" id="gmap_canvas" src="https://maps.google.com/maps?q=Sargdha&t=&z=14&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://online.stopwatch-timer.net/pomodoro-timer">tomato timer</a><br><a href="https://www.calc-calc.com/">calculator</a><br>
                                    <style>
                                        .mapouter {
                                            position: relative;
                                            text-align: right;
                                            height: 150px;
                                            width: 300px;
                                        }
                                    </style><a href="https://www.ongooglemaps.com">map box</a>
                                    <style>
                                        .gmap_canvas {
                                            overflow: hidden;
                                            background: none !important;
                                            height: 150px;
                                            width: 300px;
                                        }
                                    </style>
                                </div>
                            </div>
                            <small class="text-muted p-t-30 db">Social Profile</small>
                            <br />
                            <button class="btn btn-circle"style="background-color:#0c0f38;"><i class="fab fa-facebook-f"style="color:#fff;"></i></button>
                            <button class="btn btn-circle"style="background-color:#0c0f38;"><i class="fab fa-twitter"style="color:#fff;"></i></button>
                            <button class="btn btn-circle"style="background-color:#0c0f38;"><i class="fab fa-youtube"style="color:#fff;"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <form id="profile-update-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="first-name">First Name</label>
                                                <input type="text" class="form-control" id="first-name" name="first_name" value="<?php echo esc_attr($first_name); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="last-name">Last Name</label>
                                                <input type="text" class="form-control" id="last-name" name="last_name" value="<?php echo esc_attr($last_name); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="bio">Bio</label>
                                                <textarea class="form-control" id="bio" name="bio"><?php echo esc_textarea($bio); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo esc_attr($email); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="profile-image">Profile Image</label>
                                                <input type="file" class="form-control-file" id="profile-image" name="profile_image">
                                            </div>
                                            <div class="form-group">
                                                <label for="nickname">Nickname</label>
                                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo esc_attr($nickname); ?>">
                                            </div>
                                            <input type="hidden" name="action" value="update_user_profile">
                                            <?php wp_nonce_field('update_user_profile_nonce', 'update_user_profile_nonce_field'); ?>
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

        
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
          </div>
        <footer class="footer text-center">
            Developed by <a href="https://www.wrappixel.com"> ByteNexus </a>.
        </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->

<?php
wp_footer();
?>