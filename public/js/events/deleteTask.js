$(document).ready(function() {
    const deleteTaskBtns = document.querySelectorAll('.deleteTaskBtn');
    const modal = document.getElementById('modal-overlay');
    const closeBtn = document.querySelector('.close-btn');
    const deleteTaskForm = document.getElementById('deleteTaskForm');

    // CLOSE DELETE EVENT MODAL
    closeBtn.addEventListener("click", function () {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });

    // DELETE TASK
    deleteTaskBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            // SHOW DELETE TASK MODAL
            modal.classList.remove("hidden");
            modal.classList.add("flex");

            // TASK ID
            const data = {
                'task_id' : btn.dataset.id,
            };

            // DELETE TASK
            deleteTaskForm.addEventListener('submit', (e) => {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: $(deleteTaskForm).attr('method'),
                    url: $(deleteTaskForm).attr('action'),
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        alert(response.message);
                        if(response.url == null){
                            window.location.reload();
                        } else {
                            location.href = response.url;
                        }
                    }
                });
            });
            
        });
    });
    // DELETE TASK
});