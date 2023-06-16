$(document).ready(function() {
    // Hide the success message after 3 seconds
    setTimeout(function() {
        $(".alert-success").fadeOut("slow");
    }, 3000);

    // Hide the fail message after 3 seconds
    setTimeout(function() {
        $(".alert-danger").fadeOut("slow");
    }, 3000);
});
