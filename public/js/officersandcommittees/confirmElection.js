$(document).ready(function() {
    // CONFIRMATION MODAL
    window.addEventListener('openConfModal', function() {
        $('#confirmationModal').addClass('flex');
        $('#confirmationModal').removeClass('hidden');
    });
    window.addEventListener('closeConfModal', function() {
        $('#confirmationModal').removeClass('flex');
        $('#confirmationModal').addClass('hidden');
    });
    // NEW ELECTION MODAL
    window.addEventListener('openNewElectionModal', function() {
        $('#newElectionModal').addClass('flex');
        $('#newElectionModal').removeClass('hidden');
    });
    window.addEventListener('closeNewElectionModal', function() {
        $('#newElectionModal').removeClass('flex');
        $('#newElectionModal').addClass('hidden');
    });
});