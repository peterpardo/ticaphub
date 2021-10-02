$(document).ready(function() {
    // SET RUBRIC MODAL
    window.addEventListener('openRubricModal', function() {
        $('#setRubricModal').addClass('flex');
        $('#setRubricModal').removeClass('hidden');
    });
    window.addEventListener('closeRubricModal', function() {
        $('#setRubricModal').removeClass('flex');
        $('#setRubricModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('rubricAssigned', function() {
        alert('Rubric successfully assigned.');
    });
});