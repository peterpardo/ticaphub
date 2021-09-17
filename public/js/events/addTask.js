$(document).ready(function() {
    let eventId = $('#event').val()
    let listId = $('#list').val()

    // fetchLists();

    // // FETCH LISTS - START
    // function fetchLists() {
    //     $.ajax({
    //         type: 'GET',
    //         url: `/fetch-lists/${id}`,
    //         dataType: "json",
    //         success: function (response) {
    //             $('tbody').html('');
    //             $.each(response.lists, function (key, item){
    //                 let specialization = '';
    //                 if(item.user.user_program.specialization == null) {
    //                     specialization = 'admin';
    //                 } else {
    //                     specialization = item.user.user_program.specialization.name;
    //                 }
    //                 $('tbody').append('<tr>\
    //                 <td class="px-4 py-3 border">' + item.title + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">' + `${item.user.first_name} ${item.user.middle_name} ${item.user.last_name}` + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">' + item.user.user_program.school.name + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">' +  specialization + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">' + `${item.user.first_name} ${item.user.middle_name} ${item.user.last_name}` + '</td>\
    //                 <td class="px-4 py-3 text-ms font-semibold border">\
    //                     <a href="/events/'+ item.event_id + '/list/' + item.id + '" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>\
    //                     <button data-id="' + item.id + '" class="removeListBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>\
    //                 </td>\
    //                 </tr>')
    //             });

    //             // // REMOVE LIST BUTTON - START
    //             let removeListBtn = document.querySelectorAll(".removeListBtn")

    //             removeListBtn.forEach((btn) => {
    //                 btn.addEventListener('click', (e) => {
    //                     e.preventDefault();
                        
    //                     let data = {
    //                         'list_id' : btn.dataset.id,
    //                     };

    //                     $.ajaxSetup({
    //                         headers: {
    //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                         }
    //                     });
                    
    //                     $.ajax({
    //                         type: 'POST',
    //                         url: '/delete-list',
    //                         data: data,
    //                         dataType: "json",
    //                         success: function (response) {
    //                             if(response.status == 200) {
    //                                 fetchLists();
    //                             } 
    //                         }
    //                     });
    //                 });
    //             });
    //             // REMOVE LIST BUTTON - END
    //         }
    //     });
    // };
    // // FETCH LISTS - END

    // ADD LIST - START
    $(document).on('submit', '#addTaskForm', function(e){
        e.preventDefault();
        
        console.log($('#title').val());
        console.log($('#description').val());
        console.log($('#').val());

        var data = {
            'title': $('#title').val(),
            'description': $('#description').val(),
            'member': $('#member').val(),
        };

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // $.ajax({
        //     type: 'POST',
        //     url: `/events/${id}`,
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
        //             $('#message').append('<span class="text-green-500">Task added successfully</span>');
        //             $('#title').val("");
        //             fetchLists();
        //         }
        //     }
        // });
    }); 
    // ADD LIST - DELETE

      // LIVE SEARCH FOR USERS - START
      $('#search').on('keyup', function() {
          let input = $(this).val();

          console.log(input);
  
          if(input == ""){
              $('#searchList').html("");
          } else {
              $.ajax({
                  method:"GET",
                  url:"/search-member",
                  data:{
                      'search':input,
                  },
                  success:function(data){
                      $('#searchList').html(data);
  
                      list.childNodes.forEach((result) => {
                          result.addEventListener('click', (e) => {
                              e.preventDefault();
  
                              $('#search').val(result.innerHTML); 
                              list.innerHTML = "";
  
                              user_id.value = result.dataset.id;
              
                          });
                      });
                  }
              });
          }
      });
      // LIVE SEARCH FOR USERS - END






    // // ADD MEMBER BUTTON - START
    // let addBtn = document.getElementById('addMemberBtn');
    // let container = document.getElementById('membersContainer');

    // addBtn.addEventListener('click', (e) => {
    //     e.preventDefault();
        
    //     let div = document.createElement('div');
    //     div.innerHTML = `
    //     <input type="text" class="rounded mb-2"/>
    //     <button class="removeMember py-1 px-4 rounded text-white bg-red-500 hover:bg-red-600">&times;</button>
    //     `;
    //     container.appendChild(div);
    //     console.log(div);

    // });
    // // ADD MEMBER BUTTON - START
});