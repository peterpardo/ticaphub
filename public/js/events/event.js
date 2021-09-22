$(document).ready(function() {
    const deleteEventBtns = document.querySelectorAll('.deleteEventBtn');
    const modal = document.getElementById('modal-overlay');
    const closeBtn = document.querySelector('.close-btn');
    const deleteEventForm = document.getElementById('deleteEventForm');
    
    // CLOSE DELETE EVENT MODAL
    closeBtn.addEventListener("click", function () {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });

    // DELETE EVENT
    deleteEventBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            // SHOW DELETE EVENT MODAL
            modal.classList.remove("hidden");
            modal.classList.add("flex");

            // EVENT ID
            const data = {
                'event_id' : btn.dataset.id,
            };

            // DELETE EVENT
            deleteEventForm.addEventListener('submit', (e) => {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type: 'POST',
                    url: '/events/delete-event',
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        alert(response.message);
                        window.location.reload();
                    }
                });
            });
            
        });
    });
    // DELETE EVENT

    // $(document).on('submit', '#addEventForm', function(e){
    //     e.preventDefault();

    //     console.log($('#event_name').val());

    //     var data = {
    //         'event_name': $('#event_name').val(),
    //     };

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         type: 'POST',
    //         url: '/add-event',
    //         data: data,
    //         dataType: "json",
    //         success: function (response) {
    //             if(response.status == 400) {
    //                 $.each(response.errors, function(key, value){
    //                     $('#message').html("")
    //                     $('#message').append('<span class="text-red-500">'+ value + '</span>');
    //                 });
    //             } else {
    //                 console.log(response.message);
    //                 $('#message').html("")
    //                 $('#message').append('<span class="text-green-500">Event added successfully</span>');
    //                 $('#event_name').val("");
    //                 fetchEvents();
    //             }
    //         }
    //     });
    // }); 

    // fetchEvents();

    // // // FETCH EVENTS - START
    // function fetchEvents() {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/fetch-event',
    //         dataType: "json",
    //         success: function (response) {
    //             console.log(response.events);

    //             $('tbody').html('');
    //             $.each(response.events, function (key, item){
    //                 let created_at = new Date(item.created_at).toLocaleString();
    //                 let updated_at = new Date(item.updated_at).toLocaleString();

    //                 $('tbody').append('<tr>\
    //                 <td class="px-4 py-3 border">' + item.name + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">' + created_at + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">' + updated_at + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">\
    //                     <a href="/events/' + item.id + '" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>\
    //                     <button data-id="' + item.id + '" class="removeEventBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>\
    //                 </td>\
    //                 </tr>')
    //             });

    //             // // REMOVE EVENT BUTTON - START
    //             let removeEventBtn = document.querySelectorAll(".removeEventBtn")

    //             removeEventBtn.forEach((btn) => {
    //                 btn.addEventListener('click', (e) => {
    //                     e.preventDefault();
                        
    //                     let data = {
    //                         'event_id' : btn.dataset.id,
    //                     };

    //                     $.ajaxSetup({
    //                         headers: {
    //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                         }
    //                     });
                    
    //                     $.ajax({
    //                         type: 'POST',
    //                         url: '/delete-event',
    //                         data: data,
    //                         dataType: "json",
    //                         success: function (response) {
    //                             if(response.status == 400) {
    //                                 console.log(response);
    //                             } else {
    //                                 fetchEvents();
    //                             }
    //                         }
    //                     });
    //                 });
    //             });
    //             // REMOVE EVENT BUTTON - END
    //         }
    //     });
    // };
    // // // FETCH EVENTS - END

    // // ADD EVENT - START
    // $(document).on('submit', '#addEventForm', function(e){
    //     e.preventDefault();

    //     console.log($('#event_name').val());

    //     var data = {
    //         'event_name': $('#event_name').val(),
    //     };

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

        // $.ajax({
        //     type: 'POST',
        //     url: '/add-event',
        //     data: data,
        //     dataType: "json",
        //     success: function (response) {
        //         if(response.status == 400) {
        //             $.each(response.errors, function(key, value){
        //                 $('#message').html("")
        //                 $('#message').append('<span class="text-red-500">'+ value + '</span>');
        //             });
        //         } else {
        //             console.log(response.message);
        //             $('#message').html("")
        //             $('#message').append('<span class="text-green-500">Event added successfully</span>');
        //             $('#event_name').val("");
        //             fetchEvents();
        //         }
        //     }
        // });
    // }); 
    // // ADD EVENT - DELETE
});