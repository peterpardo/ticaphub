$(document).ready(function() {
    $("#openModal").on("click", function(e) {
        e.preventDefault();
        $('#finalizeModal').addClass('flex');
        $('#finalizeModal').removeClass('hidden');
    });
    $("#closeModal").on("click", function(e) {
        e.preventDefault();
        $('#finalizeModal').addClass('hidden');
        $('#finalizeModal').removeClass('flex');
    });
});