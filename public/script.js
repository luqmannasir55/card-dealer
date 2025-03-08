jQuery(document).ready(function () {

    // Enable button only when input is valid
    jQuery("#numPeople").on("input", function () {
        let value = parseInt(jQuery(this).val(), 10);
        jQuery("#dealCards").prop("disabled", isNaN(value) || value < 0);
    });

    // Handle button click
    jQuery("#dealCards").on("click", function () {
        let numPeople = parseInt(jQuery("#numPeople").val(), 10);

        // Validate input
        if (isNaN(numPeople) || numPeople < 0) {
            jQuery("#output").html('<p class="error-message">Input value does not exist or is invalid.</p>');
            return;
        }

        // Show loading animation
        jQuery(".loading").show();
        jQuery("#output").empty();

        // Send AJAX request to backend
        jQuery.ajax({
            url: "deal-cards",
            type: "GET",
            data: { n: numPeople },
            success: function (response) {
                jQuery(".loading").hide();
                jQuery("#output").html(response);
            },
            error: function (xhr) {
                jQuery(".loading").hide();
                jQuery("#output").html(`<p class="error-message">`+xhr.responseText+`</p>`);
            }
        });
    });
    
});
