<?php
/*
Template Name: CV Form Template
*/
?>
<div id="cv-form-container">
    <div id="thank_you_message" style="display: none; color: red;"><?php echo esc_html( 'Thank you. Our managers will contact you during the day' ); ?></div>
    <form id="cv-form" class="wp-form" method="post" enctype="multipart/form-data">
        <p class="comment-form-author">
            <label for="first_name"><?php _e( 'First Name:', 'textdomain' ); ?></label>
            <input type="text" id="first_name" name="first_name" placeholder="<?php echo esc_attr( __( 'Your name', 'textdomain' ) ); ?>" required>
        </p>
        <p class="comment-form-email">
            <label for="last_name"><?php _e( 'Second Name:', 'textdomain' ); ?></label>
            <input type="text" id="last_name" name="last_name" placeholder="<?php echo esc_attr( __( 'Your second name', 'textdomain' ) ); ?>" required>
        </p>
        <p class="comment-form-email">
            <label for="email"><?php _e( 'E-mail:', 'textdomain' ); ?></label>
            <input type="email" id="email" name="email" placeholder="<?php echo esc_attr( __( 'Your e-mail', 'textdomain') ); ?>" required>
        </p>
        <p class="comment-form-email">
            <label for="cv_file"><?php _e( 'Add File:', 'textdomain' ); ?></label>
            <input type="file" id="cv_file" name="cv_file" accept=".doc,.docx,.pdf" required>
        </p>
        <p class="comment-form-email">
            <input type="checkbox" id="register_user" name="register_user">
            <label for="register_user"><?php _e( 'I would like to receive information about new vacancies by email', 'textdomain' ); ?></label>
        </p>
        <p class="form-submit">
            <input type="submit" name="submit_cv" id="submit_cv" class="submit" value="<?php _e( 'SEND', 'textdomain' ); ?>">
        </p>
    </form>
</div>
