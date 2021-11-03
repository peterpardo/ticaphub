$(document).ready(function() {
    $('#openConfModal').on('click', function(e) {
        e.preventDefault();
        $("#confirmationModal").removeClass('hidden');
        $("#confirmationModal").addClass('flex');
    });
    $('#closeConfModal').on('click', function(e) {
        e.preventDefault();
         $("#confirmationModal").removeClass('flex');
         $("#confirmationModal").addClass('hidden');
     });
     $('#submitVote').on('click', function(e) {
         e.preventDefault();
        $('#voteForm').submit();
     });
});