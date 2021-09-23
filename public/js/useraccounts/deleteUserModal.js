$(document).ready(function() {
    // DELETE USER MODAL
    window.addEventListener('closeModal', () => {
        $('#modalFormDelete').addClass('hidden');
        $('#modalFormDelete').removeClass('flex');
    });
    window.addEventListener('openModal', () => {
        $('#modalFormDelete').removeClass('hidden');
        $('#modalFormDelete').addClass('flex');
    });
    // RESET USERS MODAL
    window.addEventListener('openResetModal', () => {
        $('#resetFormModal').removeClass('hidden');
        $('#resetFormModal').addClass('flex');
    });
    window.addEventListener('closeResetModal', () => {
        $('#resetFormModal').removeClass('flex');
        $('#resetFormModal').addClass('hidden');
    });
});