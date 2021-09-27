$(document).ready(function() {
    window.addEventListener('openConfModal', function() {
        $('#confirmationModal').addClass('flex');
        $('#confirmationModal').removeClass('hidden');
    });
    window.addEventListener('closeConfModal', function() {
        $('#confirmationModal').removeClass('flex');
        $('#confirmationModal').addClass('hidden');
    });
});