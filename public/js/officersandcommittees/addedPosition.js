fetchEvents();

// // FETCH EVENTS - START
function fetchCandidates() {
    $.ajax({
        type: 'GET',
        url: '/fetch-candidates',
        dataType: "json",
        success: function (response) {
            console.log(response.users);
        }
    }
    )}
            // $('tbody').html('');
            // $.each(response.{{ cand }}idates, function (key, item){
            //     let created_at = new Date(item.created_at).toLocaleString();
            //     let updated_at = new Date(item.updated_at).toLocaleString();

            //     $('tbody').append('<tr>\
            //     <td class="px-4 py-3 border">' + item.name + '</td>\
            //     <td class="px-4 py-3 text-ms font-semibold border">' + created_at + '</td>\
            //     <td class="px-4 py-3 text-ms font-semibold border">' + updated_at + '</td>\
            //     <td class="px-4 py-3 text-ms font-semibold border">\
            //         <a href="/events/' + item.id + '" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>\
            //         <button data-id="' + item.id + '" class="removeEventBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>\
            //     </td>\
            //     </tr>')
            // });

              // ADD EVENT - START
              $(document).on('submit', '#addEventForm', function(e){
                e.preventDefault();
        
                console.log($('#event_name').val());
        
                var data = {
                    'event_name': $('#event_name').val(),
                };
        
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        
                $.ajax({
                    type: 'POST',
                    url: '/add-event',
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
                            $('#message').append('<span class="text-green-500">Event added successfully</span>');
                            $('#event_name').val("");
                            fetchEvents();
                        }
                    }
                });
            }); 