$(document).ready(function() {

    fetchSpecialization();

    // FETCH ALL SPECIALIZATIONS - START
    function fetchSpecialization() {
        $.ajax({
            type: 'GET',
            url: '/fetch-specializations',
            dataType: "json",
            success: function (response) {
                $('#specializations').html('');
                $.each(response.specializations, function (key, item){
                    $('#specializations').append('<tr>\
                    <td class="px-4 py-3 text-ms font-semibold border">' + item.name + '</td>\
                    <td class="px-4 py-3 text-sm border">\
                        <button data-id="' + item.id + '" class="editBtn bg-green-400 px-4 py-1 m-0.5 rounded text-white hover:bg-green-500">Edit</button>\
                        <button data-id="' + item.id + '" class="deleteBtn bg-red-400 px-4 py-1 m-0.5 rounded text-white hover:bg-red-500">Delete</button>\
                    </td>\
                    </tr>')
                });

                // DELETE SPECIALIZATION - START
                let deleteBtns = document.querySelectorAll('.deleteBtn')

                deleteBtns.forEach((deleteBtn) => {
                    deleteBtn.addEventListener('click', (e) => {
                        e.preventDefault();

                        console.log(deleteBtn.dataset.id);
                        
                        let data = {
                            'specialization_id' : deleteBtn.dataset.id,
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                        $.ajax({
                            type: 'POST',
                            url: '/delete-specialization',
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                if(response.status == 200) {
                                    fetchSpecialization();
                                }
                            }
                        });
                    });
                });
                // DELETE SPECIALIZATION - END
            }
        });
    };
    // FETCH ALL SPECIALIZATIONS - END

    // ADD SPECIALIZATION - START
    $(document).on('submit', '#addSpecializationForm', function(e){
        e.preventDefault();

        var data = {
            'specialization': $('#specialization').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: '/add-specialization',
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400) {
                    $('#message').html("");
                    $('#message').addClass("text-red-500 text-center");
                    $.each(response.errors, function(key, value){
                        $('#message').append('<span>'+ value + '</span>');
                    });
                } else {
                    $('#message').html("")
                    $('#modal-overlay').addClass('hidden');
                    $('#modal-overlay').removeClass('flex');
                    $('#specialization').val('')
                    fetchSpecialization();
                }
            }
        });

    }); 
    // ADD SPECIALIZATION - START

    // CLEAR SPECIALIZATION INPUT FIELD - START
    closeBtn.addEventListener("click", () => {
        $('#message').html("");
        $('#specialization').val("");
    });
    // CLEAR SPECIALIZATION INPUT FIELD - END
});


