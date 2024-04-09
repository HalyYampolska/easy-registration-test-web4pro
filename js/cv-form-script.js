// Thank you and redirect logic

jQuery(document).ready(function ($) {
    $('#cv-form').submit(function (e) {
        e.preventDefault(); // Stop form submission by default
        var formData = new FormData(this);
        formData.append('action', 'handle_cv_form_submission'); // Add action to process form on the server

        $.ajax({
            type: 'POST',
            url: ajaxurl, // Using the ajaxurl variable by WordPress
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#thank_you_message').show(); // Display "Thank You!"
                setTimeout(function () {
                    window.location.href = home_url; // Redirect the user after 3 seconds
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
