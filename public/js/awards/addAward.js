$(document).ready(function() {
    window.addEventListener('openModal', function() {
        $('#awardFormModal').removeClass('hidden');
        $('#awardFormModal').addClass('flex');
    });
    window.addEventListener('closeModal', function() {
        $('#awardFormModal').removeClass('flex');
        $('#awardFormModal').addClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deleteAwardFormModal').removeClass('flex');
        $('#deleteAwardFormModal').addClass('hidden');
    });
    window.addEventListener('openDeleteModal', function() {
        $('#deleteAwardFormModal').removeClass('hidden');
        $('#deleteAwardFormModal').addClass('flex');
    });
    // ALERTS
    Livewire.on('awardAdded', () => {
        alert('Award successfully added.');
    })
    Livewire.on('awardDeleted', () => {
        alert('Award successfully deleted.');
    })
});