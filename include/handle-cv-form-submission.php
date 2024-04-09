<?php
/**
 * Form fields logic 
 */

 function handle_cv_form_submission() {
    if ( isset( $_POST['action'] ) && $_POST['action'] == 'handle_cv_form_submission' ) {
        // Form validation
        if ( isset( $_POST['first_name'] ) && isset( $_POST['last_name'] ) && isset( $_POST['email'] ) && isset( $_FILES['cv_file'] ) ) {
            $first_name = sanitize_text_field( $_POST['first_name'] );
            $last_name = sanitize_text_field( $_POST['last_name'] );
            $email = sanitize_email( $_POST['email'] );

            // File upload processing
            $upload_dir = wp_upload_dir();
            $file_name = $_FILES['cv_file']['name'];
            $file_tmp_name = $_FILES['cv_file']['tmp_name'];
            $file_type = $_FILES['cv_file']['type'];
            $file_size = $_FILES['cv_file']['size'];
            $allowed_types = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf');

            if ( in_array( $file_type, $allowed_types ) && $file_size < 5000000 ) { // Max size: 5 МБ
                $file_path = $upload_dir['path'] . '/' . $file_name;
                if ( move_uploaded_file( $file_tmp_name, $file_path ) ) {
                    // Sending e-mail to the admin
                    $to = get_option( 'admin_email' );
                    $subject = 'New Challenger';
                    $message = 'Name: ' . $first_name . "\n" .
                        'Last Name: ' . $last_name . "\n" .
                        'Email: ' . $email . "\n" .
                        'Added CV: ' . $file_name;
                    wp_mail( $to, $subject, $message );

                    // Checking if a checkbox is selected
                    if ( isset( $_POST['register_user'] ) && $_POST['register_user'] === 'on' ) {
                        // User registration
                        $user_id = wp_create_user( $email, wp_generate_password(), $email );

                        if ( is_wp_error( $user_id ) ) {
                            // Displaying an error message when registering a user
                            return 'Error: ' . esc_html( $user_id->get_error_message() );
                        } else {
                            // User successfully registered
                            return 'You are one of the first candidates for the position';
                        }
                    }

                    // Returning a successful form submission message
                    return '<script>document.getElementById("thank_you_message").style.display = "block"; setTimeout(function(){ window.location.href = "' . home_url() . '"; }, 3000);</script>';
                } else {
                    return '<p>File download error.</p>';
                }
            } else {
                return '<p>Error loading file. You can upload files in .doc, .docx, .pdf formats. The file size must not exceed 5 MB.</p>';
            }
        } else {
            return '<p>All fields are required.</p>';
        }
    }
}

// Connecting a function to an AJAX hook
add_action( 'wp_ajax_handle_cv_form_submission', 'handle_cv_form_submission' );
add_action( 'wp_ajax_nopriv_handle_cv_form_submission', 'handle_cv_form_submission' );
