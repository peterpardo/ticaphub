$(document).ready(function() {
    const deleteTicapBtns = document.querySelectorAll('.deleteTicapBtn');
    const modal = document.getElementById('deleteTicapModal');
    const closeBtn = document.getElementById('closeDeleteModal');
    const form = document.getElementById('deleteTicapForm');

    // CLOSE DELETE TICAP MODAL
    closeBtn.addEventListener("click", function () {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });

    // DELETE TICAP
    deleteTicapBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            // SHOW DELETE EVENT MODAL
            modal.classList.remove("hidden");
            modal.classList.add("flex");

            // TICAP ID
            const data = {
                'ticap_id' : btn.dataset.id,
            };

            // DELETE TICAP
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type: 'POST',
                    url: '/documentation/delete-ticap',
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 400) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                            window.location.reload();
                        }
                    }
                });
            });
        });
    });

});