$(document).ready(function() {
    $("#openModal").on("click", function(e) {
        e.preventDefault();
        $('#confirmGradesModal').addClass('flex');
        $('#confirmGradesModal').removeClass('hidden');
    });
    $("#closeModal").on("click", function(e) {
        e.preventDefault();
        $('#confirmGradesModal').addClass('hidden');
        $('#confirmGradesModal').removeClass('flex');
    });
});