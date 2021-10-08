$(document).ready(function() {
    $("#openModal").on("click", function(e) {
        e.preventDefault();
        $('#generateResultsModal').addClass('flex');
        $('#generateResultsModal').removeClass('hidden');
    });
    $("#closeModal").on("click", function(e) {
        e.preventDefault();
        $('#generateResultsModal').addClass('hidden');
        $('#generateResultsModal').removeClass('flex');
    });
});