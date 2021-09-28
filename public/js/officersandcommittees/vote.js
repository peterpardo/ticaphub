$(document).ready(function() {
    $('#openConfModal').on('click', function(e) {
        $("#confirmationModal").removeClass('hidden');
        $("#confirmationModal").addClass('flex');
    });
    $('#closeConfModal').on('click', function(e) {
         $("#confirmationModal").removeClass('flex');
         $("#confirmationModal").addClass('hidden');
     });
     $('#submitVote').on('click', function() {
        $('#voteForm').submit();
     });
});