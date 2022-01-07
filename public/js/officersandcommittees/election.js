$(document).ready(function() {
    window.addEventListener('openConfModal', function() {
        $('#confirmationModal').addClass('flex');
        $('#confirmationModal').removeClass('hidden');
    });
    window.addEventListener('closeConfModal', function() {
        $('#confirmationModal').removeClass('flex');
        $('#confirmationModal').addClass('hidden');
    });
    window.addEventListener('openUpdateElectionModal', function() {
        $('#updateElectionModal').addClass('flex');
        $('#updateElectionModal').removeClass('hidden');
    });
    window.addEventListener('closeUpdateElectionModal', function() {
        $('#updateElectionModal').removeClass('flex');
        $('#updateElectionModal').addClass('hidden');
    });
});