
$(document).ready(function () {
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
        $('#deleteListModal').addClass('flex');
        $('#deleteListModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deleteListModal').removeClass('flex');
        $('#deleteListModal').addClass('hidden');
    });
    // FORM MODAL
    window.addEventListener('openModal', function() {
        $('#listFormModal').addClass('flex');
        $('#listFormModal').removeClass('hidden');
    });
    window.addEventListener('closeModal', function() {
        $('#listFormModal').removeClass('flex');
        $('#listFormModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('listDeleted', function() {
        alert('List successfully deleted.');
    });
    Livewire.on('listUpdated', function() {
        alert('List successfully updated.');
    });
    Livewire.on('listAdded', function() {
        alert('List successfully added.');
    });
    Livewire.on('taskDeleted', function() {
        alert('Task successfully deleted.');
    });
});




// $(document).ready(function() {
//     const deleteListBtns = document.querySelectorAll('.deleteListBtn');
//     const modal = document.getElementById('modal-overlay');
//     const closeBtn = document.querySelector('.close-btn');
//     const deleteListForm = document.getElementById('deleteListForm');

//     // CLOSE DELETE EVENT MODAL
//     closeBtn.addEventListener("click", function () {
//         modal.classList.add("hidden");
//         modal.classList.remove("flex");
//     });

//     // DELETE EVENT
//     deleteListBtns.forEach((btn) => {
//         btn.addEventListener('click', (e) => {
//             e.preventDefault();

//             // SHOW DELETE LIST MODAL
//             modal.classList.remove("hidden");
//             modal.classList.add("flex");

//             // EVENT ID
//             const data = {
//                 'list_id' : btn.dataset.id,
//             };

//             // DELETE LIST
//             deleteListForm.addEventListener('submit', (e) => {
//                 e.preventDefault();

//                 $.ajaxSetup({
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     }
//                 });
    
//                 $.ajax({
//                     type: $(deleteListForm).attr('method'),
//                     url: $(deleteListForm).attr('action'),
//                     data: data,
//                     dataType: "json",
//                     success: function (response) {
//                         // RELOAD PAGE
//                         alert(response.message);
//                         window.location.reload();
//                     }
//                 });
//             });
            
//         });
//     });
//     // DELETE EVENT

// });