$(document).ready(function() {
    // Hide all tables on page load
    $(".table-toggle-content").hide();

    // When a button is clicked
    $(".table-toggle").click(function() {
        // Hide all tables
        $(".table-toggle-content").hide();

        // Show the corresponding table
        $($(this).data("target")).show();

        // Prevent default link behavior
        return false;
    });
});

function approveAppointment(appointmentId) {
    $.ajax({
        type: "POST",
        url: "approve-appointment.php",
        data: { id: appointmentId },
        success: function() {
            // Reload the current page to reflect the updated status
            location.reload();
        },
        error: function() {
            alert("An error occurred while approving the appointment.");
        }
    });
}