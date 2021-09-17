$(document).ready(function() {
    let id = $('#event').val()

    fetchLists();

    // FETCH LISTS - START
    function fetchLists() {
        $.ajax({
            type: 'GET',
            url: `/fetch-lists/${id}`,
            dataType: "json",
            success: function (response) {
                $('tbody').html('');
                $.each(response.lists, function (key, item){
                    let specialization = '';
                    if(item.user.user_program.specialization == null) {
                        specialization = 'admin';
                    } else {
                        specialization = item.user.user_program.specialization.name;
                    }
                    $('tbody').append('<tr>\
                    <td class="px-4 py-3 border">' + item.title + '</td>\
                    <td class="px-4 py-3 text-ms font-semibold border">' + `${item.user.first_name} ${item.user.middle_name} ${item.user.last_name}` + '</td>\
                    <td class="px-4 py-3 text-ms font-semibold border">' + item.user.user_program.school.name + '</td>\
                    <td class="px-4 py-3 text-ms font-semibold border">' +  specialization + '</td>\
                    <td class="px-4 py-3 text-ms font-semibold border">' + `${item.user.first_name} ${item.user.middle_name} ${item.user.last_name}` + '</td>\
                    <td class="px-4 py-3 text-ms font-semibold border">\
                        <a href="/events/'+ item.event_id + '/list/' + item.id + '" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>\
                        <button data-id="' + item.id + '" class="removeListBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>\
                    </td>\
                    </tr>')
                });

                // // REMOVE LIST BUTTON - START
                let removeListBtn = document.querySelectorAll(".removeListBtn")

                removeListBtn.forEach((btn) => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        let data = {
                            'list_id' : btn.dataset.id,
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                        $.ajax({
                            type: 'POST',
                            url: '/delete-list',
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                if(response.status == 200) {
                                    fetchLists();
                                } 
                            }
                        });
                    });
                });
                // REMOVE LIST BUTTON - END
            }
        });
    };
    // FETCH LISTS - END

    // ADD LIST - START
    $(document).on('submit', '#addListForm', function(e){
        e.preventDefault();
        
        console.log($('#title').val());

        var data = {
            'title': $('#title').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/events/${id}`,
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400) {
                    $.each(response.errors, function(key, value){
                        $('#message').html("")
                        $('#message').append('<span class="text-red-500">'+ value + '</span>');
                    });
                } else {
                    console.log(response.message);
                    $('#message').html("")
                    $('#message').append('<span class="text-green-500">Task added successfully</span>');
                    $('#title').val("");
                    fetchLists();
                }
            }
        });
    }); 
    // ADD LIST - DELETE
});