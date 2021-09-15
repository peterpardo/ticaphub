$(document).ready(function() {

    fetchPosition();

    // FETCH ALL POSITIONS - START
    function fetchPosition() {
        $.ajax({
            type: 'GET',
            url: '/fetch-positions',
            dataType: "json",
            success: function (response) {
                $('tbody').html('');
                $.each(response.positions, function (key, item){
                    $('tbody').append('<tr>\
                    <td class="px-4 py-3 text-ms font-semibold border">' + item.name + '</td>\
                    <td class="px-4 py-3 text-sm border">\
                        <button data-id="' + item.id + '" class="bg-yellow-400 px-4 py-1 m-0.5 rounded text-white hover:bg-yellow-500">Edit</button>\
                        <button data-id="' + item.id + '" class="removePositionBtn bg-red-400 px-4 py-1 m-0.5 rounded text-white hover:bg-red-500">Delete</button>\
                    </td>\
                    </tr>')
                });

                // // REMOVE POSITION BUTTON - START
                let removePositionBtn = document.querySelectorAll(".removePositionBtn")

                removePositionBtn.forEach((btn) => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        let data = {
                            'position' : btn.dataset.id,
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                        $.ajax({
                            type: 'POST',
                            url: '/delete-position',
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                if(response.status == 400) {
                                    console.log(response);
                                } else {
                                    fetchPosition();
                                }
                            }
                        });
                    });
                });
                // REMOVE POSITION BUTTON - END
            }
        });
    };
    // FETCH ALL POSITIONS - END

    // ADD POSITION - START
    $(document).on('submit', '#addPositionForm', function(e){
        e.preventDefault();
    
        var data = {
            'position': $('#position').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: '/add-position',
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400) {
                    $.each(response.errors, function(key, value){
                        $('#message').append('<span>'+ value + '</span>');
                    });
                } else {
                    $('#message').html("")
                    $('#modal-overlay').addClass('hidden');
                    $('#modal-overlay').removeClass('flex');
                    $('#modal-overlay').find('input').val("");
                    $('#modal-overlay').find('textarea').val("");
                    fetchPosition();
                }
            }
        });

    }); 
    // ADD POSITION - END


});


