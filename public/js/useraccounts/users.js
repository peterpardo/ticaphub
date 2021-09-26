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
    // USER MODAL
    window.addEventListener('openUserModal', () => {
        $('#userFormModal').addClass('hidden');
        $('#userFormModal').removeClass('flex');
    });
    window.addEventListener('closeUserModal', () => {
        $('#userFormModal').removeClass('hidden');
        $('#userFormModal').addClass('flex');
    });
    // STUDENT MODAL
    window.addEventListener('closeStudentModal', () => {
        $('#studentFormModal').addClass('hidden');
        $('#studentFormModal').removeClass('flex');
    });
    window.addEventListener('openStudentModal', () => {
        $('#studentFormModal').removeClass('hidden');
        $('#studentFormModal').addClass('flex');
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
    // ALERTS
    Livewire.on('userUpdated', () => {
        alert('User successfully updated.');
    })
    Livewire.on('userDeleted', () => {
        alert('User successfully deleted.');
    })
});