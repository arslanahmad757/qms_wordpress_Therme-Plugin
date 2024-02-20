<?php
ob_start();

function theme_enqueue_styles()
{
    // -----------------> Theme Style and Js Files<-----------------//
    // style
    wp_enqueue_style('style.css', get_stylesheet_uri("style.css"));
    // wp-css
    wp_enqueue_style('stylecss', get_template_directory_uri() . '/css/style.css');
    // bootstrap css
    wp_enqueue_style('bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css');
    // css
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/style.css');
    // responsive css
    wp_enqueue_style('responsivecss', get_template_directory_uri() . '/css/responsive.css');
    // Scrollbar Custom CSS
    wp_enqueue_style('scrollbar-css', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.min.css');

    // jquery.min.js
    wp_enqueue_script('jquery-min', get_template_directory_uri() . "/js/jquery.min.js", array(), '1.1', true);
    // popper.min.js
    wp_enqueue_script('popper-min', get_template_directory_uri() . "/js/popper.min.js", array(), '1.1', true);
    // bootstrap.min.js
    wp_enqueue_script('bootstrap-min', get_template_directory_uri() . "/js/bootstrap.bundle.min.js", array(), '1.1', true);
    // jquery-3.0.0.min.js
    wp_enqueue_script('jquery3-min', get_template_directory_uri() . "/js/jquery-3.0.0.min.js", array(), '1.1', true);
    // js/plugin.js
    wp_enqueue_script('pluginjs', get_template_directory_uri() . "/js/plugin.js", array(), '1.1', true);

    //jquery.mCustomScrollbar.concat.min.js
    wp_enqueue_script('mCustomScrollbar', get_template_directory_uri() . "/js/jquery.mCustomScrollbar.concat.min.js", array(), '1.1', true);
    // custom js
    wp_enqueue_script('custom-js', get_template_directory_uri() . "/js/custom.js", array(), '1.1', true);
    // ajax-jquery
    // wp_enqueue_script('ajax', get_template_directory_uri() . '/fancybox/2.1.5/jquery.fancybox.min.js');

    // style.css content
    // Enqueue Google Fonts
    wp_enqueue_style('rajdhani-font', 'https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700');
    wp_enqueue_style('poppins-font', 'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
    wp_enqueue_style('baloo-chettan-font', 'https://fonts.googleapis.com/css?family=Baloo+Chettan&display=swap');
    wp_enqueue_style('swipper', 'https://unpkg.com/swiper/swiper-bundle.min.css');


    // Enqueue other CSS files
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css');
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
    wp_enqueue_style('icomoon', get_template_directory_uri() . '/css/icomoon.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('meanmenu', get_template_directory_uri() . '/css/meanmenu.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css//owl.carousel.min.css');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css');
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui.css');
    wp_enqueue_style('nice-select', get_template_directory_uri() . '/css/nice-select.css');

    // -----------------> Dashboard Style and Js Files<-----------------
    // <!-- Custom CSS -->
    wp_enqueue_style('dash-style', get_template_directory_uri() . '/assets/libs/chartist/dist/chartist.min.css');
    // style.css
    wp_enqueue_style('style-css', get_template_directory_uri() . '/dist/css/style.css');
    wp_enqueue_style('style-css', get_template_directory_uri() . '/dist/css/style.min.css');
    wp_enqueue_style('style-dash.css', get_stylesheet_uri("dash-style.css"));


    // jqeury
    wp_enqueue_script('dash-jquery-min', get_template_directory_uri() . "/assets/libs/jquery/dist/jquery.min.js", array(), '1.1', true);
    // Bootstrap tether Core JavaScript
    wp_enqueue_script('dash-Bootstrap-1', get_template_directory_uri() . "/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js", array(), '1.1', true);
    wp_enqueue_script('dash-Bootstrap-2', get_template_directory_uri() . "/dist/js/app-style-switcher.js", array(), '1.1', true);
    // <!--Wave Effects -->
    wp_enqueue_script('dash-waves', get_template_directory_uri() . "/dist/js/waves.js", array(), '1.1', true);
    // <!--Menu sidebar -->
    wp_enqueue_script('sidebarmenu', get_template_directory_uri() . "/dist/js/sidebarmenu.js", array(), '1.1', true);
    // custom js
    wp_enqueue_script('dash-Bootstrap-custom', get_template_directory_uri() . "/dist/js/custom.js", array(), '1.1', true);
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Add action to handle form submission
add_action('admin_post_update_user_profile', 'update_user_profile');
add_action('admin_post_nopriv_update_user_profile', 'update_user_profile');

function update_user_profile()
{
    // Verify nonce
    if (isset($_POST['update_user_profile_nonce_field']) && wp_verify_nonce($_POST['update_user_profile_nonce_field'], 'update_user_profile_nonce')) {
        // Get current user ID
        $user_id = get_current_user_id();

        // Update user information
        if (!empty($_POST['first_name'])) {
            wp_update_user(array('ID' => $user_id, 'first_name' => sanitize_text_field($_POST['first_name'])));
        }

        if (!empty($_POST['last_name'])) {
            wp_update_user(array('ID' => $user_id, 'last_name' => sanitize_text_field($_POST['last_name'])));
        }

        if (!empty($_POST['bio'])) {
            update_user_meta($user_id, 'description', sanitize_textarea_field($_POST['bio']));
        }

        if (!empty($_POST['email'])) {
            wp_update_user(array('ID' => $user_id, 'user_email' => sanitize_email($_POST['email'])));
        }

        // Update profile image
        if (!empty($_FILES['profile_image']['tmp_name'])) {
            $profile_image_url = media_handle_upload('profile_image', 0);
            update_user_meta($user_id, 'profile_image', $profile_image_url);
        }

        // Update nickname
        if (!empty($_POST['nickname'])) {
            wp_update_user(array('ID' => $user_id, 'nickname' => sanitize_text_field($_POST['nickname'])));
        }

        // Redirect user after update
        wp_redirect($_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // If nonce verification fails, show an error or handle it accordingly
        wp_die('Security check');
    }
}

// register primary and footer menus
register_nav_menus(array(
    'primary' => __('Primary Menu'),
    'footer' => __('Footer Menu'),
));

function my_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Contact Area', 'my-theme' ),
        'id'            => 'contact-area',
        'description'   => esc_html__( 'Add widgets here to display in the contact area.', 'my-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'my_theme_widgets_init' );


// edit form
add_action('wp_ajax_update_query_status', 'update_query_status');
add_action('wp_ajax_nopriv_update_query_status', 'update_query_status'); // For non-authenticated users

function update_query_status()
{
    // Check if the queryID is set and not empty
    if (isset($_POST['queryID']) && !empty($_POST['queryID'])) {
        // Retrieve the queryID from the POST data
        $queryID = $_POST['queryID'];

        // Retrieve the record details from the database
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_queries';
        $Viewed = 1;
        $query_details = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE QueryID = %d", $queryID));
        // Prepare the SQL update query
        $sql = $wpdb->prepare("
    UPDATE $table_name
    SET Viewed = %s
    WHERE QueryID = %d
", $Viewed, $queryID);

        // Execute the SQL update query
        $wpdb->query($sql);
        if ($query_details) {
            // Output the details in HTML format
            echo '<form id="updateStatusForm">';
            echo '<div class="form-group">';
            echo '<label for="Description">Description:</label></br>';
            echo '<textarea disabled="true" name="Description">' . $query_details->Description . '</textarea></br>';
            echo '<label for="status">Status:</label>';
            echo '<select class="form-control" id="status" name="status">';
            echo '<option value="Pending" ' . ($query_details->Status == 'Pending' ? 'selected' : '') . '>Pending</option>';
            echo '<option value="Solved" ' . ($query_details->Status == 'Solved' ? 'selected' : '') . '>Solved</option>';
            echo '</select>';
            echo '</div>';
            echo '<input type="hidden" name="queryID" value="' . $queryID . '">';
            echo '<button type="submit" class="btn btn-primary">Update Status</button>';
            echo '</form>';
        } else {
            echo 'No details found for the selected query.';
        }
    } else {
        echo 'Invalid request.';
    }

    // Always remember to exit after processing
    wp_die();
}
// Localize script for AJAX URL
function enqueue_custom_scripts()
{
    wp_enqueue_script('your-script-handle', '/js/jquery.min.js', array('jquery'), null, true);
    wp_localize_script('your-script-handle', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


// submit updated form
add_action('wp_ajax_update_query_status_submit', 'update_query_status_submit');
add_action('wp_ajax_nopriv_update_query_status_submit', 'update_query_status_submit'); // For non-authenticated users

function update_query_status_submit()
{
    // Retrieve form data
    $query_id = $_POST['queryID'];
    $status = $_POST['status'];

    global $wpdb;
    $table_name = 'wp_custom_queries'; // Replace 'your_table_name' with your actual table name

    // Prepare the SQL update query
    $sql = $wpdb->prepare("
    UPDATE $table_name
    SET Status = %s
    WHERE QueryID = %d
", $status, $query_id);

    // Execute the SQL update query
    $wpdb->query($sql);

    // Update status field in the database
    update_post_meta($query_id, 'status', $status);

    // You can return a success message if needed
    echo 'Status updated successfully';

    // Always remember to exit after processing
    wp_die();
}


// live search bar
add_action('wp_ajax_filter_queries', 'filter_queries');
add_action('wp_ajax_nopriv_filter_queries', 'filter_queries');

function filter_queries()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_queries';
    $search_text = $_POST['search_text'];

    // Query to retrieve filtered records based on employee name
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE EmployeeName LIKE %s", '%' . $wpdb->esc_like($search_text) . '%');
    $results = $wpdb->get_results($query);

    // Check if there are results
    if ($results) {
        echo '<table class="table v-middle"><thead>';
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

        echo '</tbody></table>';
    } else {
        echo 'No records found.';
    }
    wp_die();
}


// report name wise
add_action('wp_ajax_process_download_request', 'process_download_request');
add_action('wp_ajax_nopriv_process_download_request', 'process_download_request');

function process_download_request()
{
    // Assuming you are receiving 'name' via POST method
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';

    global $wpdb;
    $my_tab = 'custom_queries';
    $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$my_tab} WHERE EmployeeName ={$name}");

    if ($results === false) {
        // Query failed, display error message
        wp_send_json_error(array('message' => $wpdb->last_error));
    } else {
        // Generate CSV content
        $csv_content = "QueryID,EmployeeName,Email,QueryCategory,Description,PriorityLevel,Status,Viewed,Date\n"; // CSV header
        foreach ($results as $row) {
            // Escape special characters in the data and concatenate them into CSV format
            $csv_content .= $row->QueryID . ',' .
                '"' . esc_csv($row->EmployeeName) . '",' . // Enclose text fields with quotes and escape special characters
                '"' . esc_csv($row->Email) . '",' .
                '"' . esc_csv($row->QueryCategory) . '",' .
                '"' . esc_csv($row->Description) . '",' .
                '"' . esc_csv($row->PriorityLevel) . '",' .
                '"' . esc_csv($row->Status) . '",' .
                $row->Viewed . ',' .
                $row->Date . "\n"; // Add more columns as needed
        }

        // Set headers for file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="download.csv"');

        // Output CSV content
        echo $csv_content;
    }

    // Terminate script execution after download
    exit;
}

// Function to escape CSV data
function esc_csv($data)
{
    // Escape double quotes with another double quote
    $data = str_replace('"', '""', $data);
    return $data;
}

// report datetime
add_action('wp_ajax_process_date_range_download_request', 'process_date_range_download_request');
add_action('wp_ajax_nopriv_process_date_range_download_request', 'process_date_range_download_request');

function process_date_range_download_request()
{
    // Get start and end dates from the AJAX request
    $start_date = isset($_POST['start_date']) ? sanitize_text_field($_POST['start_date']) : '';
    $end_date = isset($_POST['end_date']) ? sanitize_text_field($_POST['end_date']) : '';

    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_queries';

    // Query to fetch data between the provided date range
    $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE Date >= %s AND Date <= %s", $start_date, $end_date));

    if ($results === false) {
        // Query failed, display error message
        wp_send_json_error(array('message' => $wpdb->last_error));
    } else {
        // Generate CSV content
        $csv_content = "QueryID,EmployeeName,Email,QueryCategory,Description,PriorityLevel,Status,Viewed,Date\n"; // CSV header
        foreach ($results as $row) {
            // Escape special characters in the data and concatenate them into CSV format
            $csv_content .= $row->QueryID . ',' .
                '"' . esc_csv2($row->EmployeeName) . '",' . // Enclose text fields with quotes and escape special characters
                '"' . esc_csv2($row->Email) . '",' .
                '"' . esc_csv2($row->QueryCategory) . '",' .
                '"' . esc_csv2($row->Description) . '",' .
                '"' . esc_csv2($row->PriorityLevel) . '",' .
                '"' . esc_csv2($row->Status) . '",' .
                $row->Viewed . ',' .
                $row->Date . "\n"; // Add more columns as needed
        }

        // Set headers for file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="download.csv"');

        // Output CSV content
        echo $csv_content;
    }

    // Terminate script execution after download
    exit;
}

// Function to escape CSV data
function esc_csv2($data)
{
    // Escape double quotes with another double quote
    $data = str_replace('"', '""', $data);
    return $data;
}


// Customize API 
function theme_customize_register($wp_customize)
{

    // Change Navbar 
    $wp_customize->add_section('header_section', array(
        'title' => __('Header Settings', 'HRNexa'),
        'priority' => 30,
    ));

    // change the logo image
    $wp_customize->add_setting('logo_image', array(
        'default' => '',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'customize_logo_image', array(
        'label' => __('Change Logo', 'HRNexa'),
        'section' => 'header_section',
        'settings' => 'logo_image',
        'type' => 'image',
    )));

    // change Hero heading
    $wp_customize->add_setting('hero_heading', array(
        'default' => 'Moto applications design',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_hero_heading', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'header_section',
        'settings' => 'hero_heading',
        'type' => 'text',
    )));

    // change Hero para-1
    $wp_customize->add_setting('hero_para1', array(
        'default' => 'Free Multipurpose Responsive',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_hero_hero_para1', array(
        'label' => __('Change Mini heading One', 'HRNexa'),
        'section' => 'header_section',
        'settings' => 'hero_para1',
        'type' => 'text',
    )));

    // change Hero para-2
    $wp_customize->add_setting('hero_para2', array(
        'default' => 'Landing Page 2019',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_hero_hero_para2', array(
        'label' => __('Change Mini heading Two', 'HRNexa'),
        'section' => 'header_section',
        'settings' => 'hero_para2',
        'type' => 'text',
    )));

    // hero button text
    $wp_customize->add_setting('hero_btn_text', array(
        'default' => 'Get Started',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_hero_btn_text', array(
        'label' => __('Change Button Text', 'HRNexa'),
        'section' => 'header_section',
        'settings' => 'hero_btn_text',
        'type' => 'text',
    )));

    // change hero button link
    $wp_customize->add_setting('hero_btn_link', array(
        'default' => 'localhost/qms',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_hero_btn_link', array(
        'label' => __('Change Button Link', 'HRNexa'),
        'section' => 'header_section',
        'settings' => 'hero_btn_link',
        'type' => 'text',
    )));

    // Features Section----------------------------------->
    $wp_customize->add_section('feature_section', array(
        'title' => __('Features Settings', 'HRNexa'),
        'priority' => 40,
    ));

    // change Hero heading
    $wp_customize->add_setting('feature_heading', array(
        'default' => 'Feature Of ',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_feature_heading', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'feature_section',
        'settings' => 'feature_heading',
        'type' => 'text',
    )));

    // change Hero paragraph
    $wp_customize->add_setting('feature_para', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate v',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_feature_para', array(
        'label' => __('Change Paragraph', 'HRNexa'),
        'section' => 'feature_section',
        'settings' => 'feature_para',
        'type' => 'text',
    )));

    // steps Section---------------------------------------------->$_COOKIE
    //  Section----------------------------------->
    $wp_customize->add_section('steps_section', array(
        'title' => __('Steps Settings', 'HRNexa'),
        'priority' => 40,
    ));

    // change steps heading1
    $wp_customize->add_setting('steps_heading_upper', array(
        'default' => 'Amezing this',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_steps_heading1', array(
        'label' => __('Change Upper Heading', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_heading_upper',
        'type' => 'text',
    )));

    // change steps heading2
    $wp_customize->add_setting('steps_heading_below', array(
        'default' => 'application and features',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_steps_heading2', array(
        'label' => __('Change Heading Purple', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_heading_below',
        'type' => 'text',
    )));

    // change steps step1
    $wp_customize->add_setting('steps_step1', array(
        'default' => 'You can understand Easy',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_step1', array(
        'label' => __('Change Step 1 Text', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_step1',
        'type' => 'text',
    )));

    // change steps step2
    $wp_customize->add_setting('steps_step2', array(
        'default' => 'Good design of application',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_step2', array(
        'label' => __('Change Step 2 Text', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_step2',
        'type' => 'text',
    )));

    // change step paragraph
    $wp_customize->add_setting('steps_paragraph', array(
        'default' => 'ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_step_paragraph', array(
        'label' => __('Change Paragraph', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_paragraph',
        'type' => 'text',
    )));

    // steps button text
    $wp_customize->add_setting('steps_btn_text', array(
        'default' => 'Read More',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_steps_btn_text', array(
        'label' => __('Change Button Text', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_btn_text',
        'type' => 'text',
    )));

    // change steps button link
    $wp_customize->add_setting('steps_btn_link', array(
        'default' => 'localhost/qms',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_steps_btn_link', array(
        'label' => __('Change Button Link', 'HRNexa'),
        'section' => 'steps_section',
        'settings' => 'steps_btn_link',
        'type' => 'text',
    )));

    // review
    // Review Section---------------------------------------------->$_COOKIE
    $wp_customize->add_section('review_section', array(
        'title' => __('Reviews Section', 'HRNexa'),
        'priority' => 50,
    ));

    // change steps heading
    $wp_customize->add_setting('review_heading_upper', array(
        'default' => 'what is say ',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_review_heading', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'review_section',
        'settings' => 'review_heading_upper',
        'type' => 'text',
    )));

    // change steps paragraph
    $wp_customize->add_setting('review_paragraph', array(
        'default' => 'nostrud exercitation ullamco laboris nisi ut aliquip e ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_review_text', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'review_section',
        'settings' => 'review_paragraph',
        'type' => 'text',
    )));

    // contact form
    $wp_customize->add_section('review_section', array(
        'title' => __('Reviews Section', 'HRNexa'),
        'priority' => 50,
    ));

    // change review heading
    $wp_customize->add_setting('review_heading_upper', array(
        'default' => 'Request a',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_review_heading', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'review_section',
        'settings' => 'review_heading_upper',
        'type' => 'text',
    )));

    // change review paragraph
    $wp_customize->add_setting('review_paragraph', array(
        'default' => 'nostrud exercitation ullamco laboris nisi ut aliquip e ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_review_text', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'review_section',
        'settings' => 'review_paragraph',
        'type' => 'text',
    )));

    // change review number 1
    $wp_customize->add_setting('review_number1', array(
        'default' => '#(+1)1234567890#',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_review_no1', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'review_section',
        'settings' => 'review_number1',
        'type' => 'text',
    )));

    // change review number 2
    $wp_customize->add_setting('review_number2', array(
        'default' => '#(+1)1234567890#',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_review_no2', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'review_section',
        'settings' => 'review_number2',
        'type' => 'text',
    )));

    // footer
     $wp_customize->add_section('footer_section', array(
        'title' => __('Footer Section', 'HRNexa'),
        'priority' => 70,
    ));

    // change footer heading
    $wp_customize->add_setting('footer_heading_upper', array(
        'default' => 'Free Multipurpose Responsive Landing Page 2019',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_footer_heading', array(
        'label' => __('Change Heading', 'HRNexa'),
        'section' => 'footer_section',
        'settings' => 'footer_heading_upper',
        'type' => 'text',
    )));

    // change footer paragraph
    $wp_customize->add_setting('footer_paragraph', array(
        'default' => 'amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip e ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'customize_footer_text', array(
        'label' => __('Change Paragraph', 'HRNexa'),
        'section' => 'footer_section',
        'settings' => 'footer_paragraph',
        'type' => 'text',
    )));

}
add_action('customize_register', 'theme_customize_register');
