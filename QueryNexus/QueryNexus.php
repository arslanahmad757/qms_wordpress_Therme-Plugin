<?php
/*
Plugin Name: QueryNexus
Plugin URI: http://yourwebsite.com
Description: This plugin manages queries submitted by users to HR.
Version: 1.0
Author: 
Author URI: http://QueryNexus.com
License: GPL2
*/
// to avoid users to access our code
if (!defined('ABSPATH')) {
    die("can't access");
}
// Define constants
define('CUSTOM_QUERY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CUSTOM_QUERY_PLUGIN_URL', plugin_dir_url(__FILE__));
// Define table name
global $wpdb;
define('CUSTOM_QUERY_TABLE_1', $wpdb->prefix . 'custom_queries');

// Enqueue jQuery Slim
function enqueue_jquery_slim()
{
    wp_enqueue_script('jquery-slim', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array(), '3.5.1', false);
}
add_action('wp_enqueue_scripts', 'enqueue_jquery_slim');

function enqueue_custom_css()
{
    wp_enqueue_style('custom-css', plugin_dir_path(__FILE__) . 'style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_css');

// Enqueue Bootstrap CSS
function enqueue_bootstrap_css()
{
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_css');

// Enqueue Bootstrap JS
function enqueue_bootstrap_js()
{
    wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', array('jquery'), '2.11.8', true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js', array('jquery', 'popper-js'), '5.3.2', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_js');

add_action('admin_menu', 'register_my_custom_menu_page');

function register_my_custom_menu_page()
{
    add_menu_page(
        'Get Started', // Page title
        'QueryNexus', // Menu title
        'manage_options', // Capability required to access the page
        'custom-plugin-settings', // Menu slug
        'custom_plugin_settings_page', // Callback function to display the page content
        'dashicons-admin-generic', // Icon URL or name (optional)
        30 // Position of the menu item in the admin menu
    );
}

function custom_plugin_settings_page()
{
?>
    <div class="container">

        <div class="row justify-content-center mt-5">
            <!-- Logo -->
            <div class="col-md-6 text-center" style="display:flex;justify-content:center;align-items:center;">
                <img src="<?php echo plugin_dir_url(__FILE__) . 'logo_2_tr.png'; ?>" alt="Plugin Logo" style="width:20rem;" class="">
            </div>
        </div>
        <style>
            .upper {
                display: flex;
                justify-content: center;
                margin-top: 4rem;
            }

            .upper>.col-md-6 {
                width: 50%;
            }

            .input-group {
                display: flex;
                flex-wrap: nowrap;
                align-items: center;
                width: 100%;
            }

            .input-group-append {
                display: flex;
            }

            .btn {
                display: inline-block;
                font-weight: 400;
                color: #212529;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                background-color: transparent;
                border: 1px solid transparent;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                cursor: pointer;
            }

            .btn-primary {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:hover {
                color: #fff;
                background-color: #0069d9;
                border-color: #0062cc;
            }

            .form-control {
                display: block;
                width: 100%;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .form-control:read-only {
                background-color: #e9ecef;
                opacity: 1;
            }
        </style>
        <div class="row justify-center mt-4 upper">
            <!-- Shortcode Field -->
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="shortcodeField" class="form-control" value="[custom_query_form]" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="copyShortcode()">Copy</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <!-- Steps to Use Plugin -->
            <div class="col-md-6">
                <h1>Steps to Use the Plugin:</h1>
                <ol>
                    <li>
                        <h2>Step 1: </h2>
                        <h2>Go to<b>Appearence>Widgets</b></h2>
                    </li>
                    <div class="col-md-6 text-center" style="display:flex;justify-content:center;align-items:center;">
                        <img src="<?php echo plugin_dir_url(__FILE__) . 'step1.png'; ?>" alt="Plugin Logo" style="width:50rem;" class="">
                    </div>
                    <li>
                        <h2>Step 2: </h2>
                        <h2>Search for<b>QueryNexus Widget</b></h2>
                    </li>
                    <div class="col-md-6 text-center" style="display:flex;justify-content:center;align-items:center;">
                        <img src="<?php echo plugin_dir_url(__FILE__) . 'step2.png'; ?>" alt="Plugin Logo" style="width:50rem;" class="">
                    </div>
                    <li>
                        <h2>Step 1: </h2>
                        <h2>Hurry<b>You Get it!</b></h2>
                    </li>
                    <div class="col-md-6 text-center" style="display:flex;justify-content:center;align-items:center;">
                        <img src="<?php echo plugin_dir_url(__FILE__) . 'step3.png'; ?>" alt="Plugin Logo" style="width:50rem;" class="">
                    </div>
                </ol>
            </div>
        </div>
    </div>

    <script>
        // Function to copy shortcode to clipboard
        function copyShortcode() {
            var shortcodeField = document.getElementById("shortcodeField");
            shortcodeField.select();
            document.execCommand("copy");
            alert("Shortcode copied to clipboard!");
        }
    </script>
<?php
}

// Add custom roles and capabilities
function custom_query_plugin_activate()
{
    add_role('hr', 'HR', array(
        'read' => true, // HR can view content
        'edit_posts' => true, // HR can edit posts
        'delete_posts' => true, // HR can delete posts
    ));

    add_role('employee', 'Employee', array(
        'read' => true, // Employees can view content
    ));

    // create queries table on activation
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = CUSTOM_QUERY_TABLE_1;

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        QueryID bigint(20) NOT NULL AUTO_INCREMENT,
        EmployeeName varchar(255) NOT NULL,
        Email varchar(255) NOT NULL,
        QueryCategory varchar(255) NOT NULL,
        Description text NOT NULL,
        PriorityLevel varchar(20) NOT NULL,
        Status VARCHAR(20) NOT NULL DEFAULT 'Pending',
        Viewed TINYINT(1) NOT NULL DEFAULT 0,
        Date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (QueryID)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'custom_query_plugin_activate');

// Remove custom roles and capabilities upon deactivation
function custom_query_plugin_deactivate()
{
    remove_role('hr');
    remove_role('employee');

    // delete table 
    global $wpdb;
    $table_name = CUSTOM_QUERY_TABLE_1;
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
register_deactivation_hook(__FILE__, 'custom_query_plugin_deactivate');

function custom_query_submission_form_shortcode()
{
    $output = '';

    // Check if the form is submitted
    if (isset($_POST['submit_query'])) {
        // Retrieve form data
        $employeeName = sanitize_text_field($_POST['employeeName']);
        $email = sanitize_email($_POST['email']);
        $queryCategory = sanitize_text_field($_POST['queryCategory']);
        $description = sanitize_textarea_field($_POST['description']);
        $priorityLevel = sanitize_text_field($_POST['priorityLevel']);

        // $status = sanitize_text_field($_POST['status']);
        // $viewed = isset($_POST['viewed']) ? 1 : 0;
        // $date = sanitize_text_field($_POST['date']);

        // Validate form data
        $errors = array();

        if (empty($employeeName)) {
            $errors[] = 'Please enter employee name.';
        }

        if (empty($email) || !is_email($email)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (empty($queryCategory)) {
            $errors[] = 'Please select query category.';
        }

        if (empty($description)) {
            $errors[] = 'Please enter query description.';
        }

        if (empty($priorityLevel)) {
            $errors[] = 'Please select priority level.';
        }

        // If no errors, save data to database
        if (empty($errors)) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'custom_queries';

            $data = array(
                'EmployeeName' => $employeeName,
                'Email' => $email,
                'QueryCategory' =>  $queryCategory,
                'Description' => $description,
                'PriorityLevel' => $priorityLevel,
            );

            $wpdb->insert($table_name, $data);

            // Send email to the submitter
            $to = $email;
            $subject = 'Your query has been recorded';
            $message = 'Dear ' . $employeeName . ', your query has been successfully recorded.';
            $headers = array('Content-Type: text/html; charset=UTF-8');

            // Send the email
            wp_mail($to, $subject, $message, $headers);

            // Display success message
            $output .= '<div class="alert alert-success" role="alert">Query submitted successfully!</div>';
        } else {
            // Display error messages
            $output .= '<div class="alert alert-danger" role="alert">';
            foreach ($errors as $error) {
                $output .= '<p>' . $error . '</p>';
            }
            $output .= '</div>';
        }
    }

    // Display the form
    $output .= '<div class="container mt-5">';
    $output .= '<h2 class="mb-4">Query Form</h2>';
    $output .= '<form method="post">';
    $output .= '<div class="form-group">';
    $output .= '<label for="employeeName">Employee Name</label>';
    $output .= '<input type="text" class="form-control" id="employeeName" name="employeeName" required>';
    $output .= '</div>';
    $output .= '<div class="form-group">';
    $output .= '<label for="email">Email</label>';
    $output .= '<input type="email" class="form-control" id="email" name="email" required>';
    $output .= '</div>';
    $output .= '<div class="form-group">';
    $output .= '<label for="queryCategory">Query Category</label>';
    $output .= '<select class="form-control" id="queryCategory" name="queryCategory" required>';
    $output .= '<option value="">Select Query Category</option>';
    $output .= '<option value="Leaves">Leaves</option>';
    $output .= '<option value="Payroll">Payroll</option>';
    $output .= '<option value="Performance">Performance</option>';
    $output .= '<option value="Relations">Relations</option>';
    $output .= '<option value="Training">Training</option>';
    $output .= '<option value="Policy">Policy</option>';
    $output .= '<option value="Health">Health</option>';
    $output .= '<option value="Hiring">Hiring</option>';
    $output .= '<option value="Rewards">Rewards</option>';
    $output .= '</select>';
    $output .= '</div>';
    $output .= '<div class="form-group">';
    $output .= '<label for="description">Description</label>';
    $output .= '<textarea class="form-control" id="description" name="description" rows="3" required></textarea>';
    $output .= '</div>';
    $output .= '<div class="form-group">';
    $output .= '<label for="priorityLevel">Priority Level</label>';
    $output .= '<select class="form-control" id="priorityLevel" name="priorityLevel" required>';
    $output .= '<option value="">Select Priority Level</option>';
    $output .= '<option value="low">Low</option>';
    $output .= '<option value="normal">Normal</option>';
    $output .= '<option value="high">High</option>';
    $output .= '</select>';
    $output .= '</div>';

    // Define the image source using plugin_dir_url
    // $image_src = plugin_dir_url(__FILE__) . 'cap1.png';

    // Concatenate the image source with the rest of your HTML output
    // $output .= '<img src="' . $image_src . '" alt="Plugin Logo" style="width:5rem;" class="">';

    $output .= '<button type="submit" name="submit_query" class="btn btn-primary">Submit</button>';
    $output .= '</form>';
    $output .= '</div>';


    return $output;
}
add_shortcode('custom_query_form', 'custom_query_submission_form_shortcode');


class Query_Nexus_Widget extends WP_Widget
{
    // Constructor function
    public function __construct()
    {
        parent::__construct(
            'query_nexus_widget', // Base ID of your widget
            'Query Nexus Widget', // Name of the widget
            array('description' => 'Query Nexus Widget') // Widget description
        );
    }

    // Widget frontend display
    public function widget($args, $instance)
    {
        // $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget']; // Output the HTML before the widget

        // if (!empty($title)) {
        //     echo $args['before_title'] . $title . $args['after_title'];
        // }

        echo do_shortcode('[custom_query_form ]');

        echo $args['after_widget']; // Output the HTML after the widget
    }
}

// Register the widget
function qw_register_query_widget()
{
    register_widget('Query_Nexus_Widget');
}
add_action('widgets_init', 'qw_register_query_widget');


?>