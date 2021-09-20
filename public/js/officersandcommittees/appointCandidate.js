$(document).ready(function() {
    fetchCandidates();
    
    // SHOW LIST OF CANDIDATES - START
    function fetchCandidates() {
        $.ajax({
            type: 'GET',
            url: '/fetch-candidates',
            dataType: "json",
            success: function (response) {
                $('#positions').html("");

                users = response.users;

                for(let key in users) {
                    if(users[key].candidate != null) {
                        let id = key.replace(/ /g,"_");

                        $('#positions').append('\
                            <tr class="text-gray-700">\
                                <td class="px-4 py-3 text-ms font-semibold border">'+ users[key].candidate.position.name +'</td>\
                                <td class="px-4 py-3 text-ms font-semibold border">' + users[key].first_name + ' ' + users[key].middle_name + ' ' + users[key].last_name + ' | ' + users[key].student_number + '</td>\
                                <td class="px-4 py-3 text-ms font-semibold border">' + users[key].student_number + '</td>\
                                <td class="px-4 py-3 text-ms font-semibold border">' + users[key].school.name + '</td>\
                                <td class="px-4 py-3 text-ms font-semibold border">' + users[key].userSpecialization.specialization.name + '</td>\
                                <td class="px-4 py-3 text-ms font-semibold border"><button data-position-id="' + users[key].candidate.position_id + '"data-user-id="' + users[key].id + '" class="removeCandidateBtn bg-red-400 px-4 py-1 m-0.5 rounded text-white hover:bg-red-500">&times;</button>\</td>\
                            </tr>'
                        );
                    }
                }

                // REPLACE SPACE WITH UNDERSCORE
                // let id = key.replace(/ /g,"_");

                // // REMOVE CANDIDATE BUTTON - START
                let removeCandidateBtn = document.querySelectorAll(".removeCandidateBtn")

                removeCandidateBtn.forEach((btn) => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        let data = {
                            'user_id' : btn.dataset.userId,
                            'position_id' : btn.dataset.positionId,
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                        $.ajax({
                            type: 'POST',
                            url: '/delete-candidate',
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                if(response.status == 400) {
                                    console.log(response);
                                } else {
                                    fetchCandidates();
                                }
                            }
                        });
                    });
                });
                // REMOVE CANDIDATE BUTTON - END
            }
        });
    };
    // SHOW LIST OF CANDIDATES - END

    // // LIVE SEARCH FOR USERS - START
    // let list = document.querySelector('#search_list');
    // let user_id = document.querySelector('.user_id');
    // let position = document.getElementById('position');
    // let school = document.getElementById('school').value;
    // // let specialization = document.getElementById('specialization').value;

    // $('#search').on('keyup', function() {
    //     let input = $(this).val();

    //     if(input == ""){
    //         $('#search_list').html("");
    //     } else {
    //         $.ajax({
    //             method:"GET",
    //             url:"/search-candidate",
    //             data:{
    //                 'search':input,
    //                 'school':school,
    //             },
    //             success:function(data){
    //                 $('#search_list').html(data);

    //                 list.childNodes.forEach((result) => {
    //                     result.addEventListener('click', (e) => {
    //                         e.preventDefault();

    //                         $('#search').val(result.innerHTML); 
    //                         list.innerHTML = "";

    //                         user_id.value = result.dataset.id;
            
    //                     });
    //                 });
    //             }
    //         });
    //     }
    // });
    // // LIVE SEARCH FOR USERS - END

    // SUBMIT SEARCHED USER - START
    $('#addCandidateForm').on('submit', (e) => {
        e.preventDefault();

        let data = {
            'student_name' : user_id.value,
            'position' : position.value,
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: '/add-candidate',
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400) {
                    console.log(response.status);
                    $.each(response.errors, function(key, value){
                        $('#search_list').html("");
                        $('#errorDiv').html("");
                        $('#errorDiv').append('<span class="inline-block">'+ value + '</span>');
                        $("#search").val('');
                        user_id.value = '';
                    });
                } else {
                    $("#search").val('');
                    $('#errorDiv').html("");
                    position.value = ''
                    user_id.value = '';
                    $('#modal-overlay').addClass('hidden');
                    $('#modal-overlay').removeClass('flex');
                    fetchCandidates();
                }
            }
        });
    });
    // SUBMIT SEARCHED USER - END

    // CLOSE LIVE SEARCH MODAL W/ INPUT CLEAR - START
    closeBtn.addEventListener("click", () => {
        $('#search').val("");
        $('#search_list').html("");
        $('#message').html("");
        $('#position').val("");
        user_id.value = '';
    });
    // CLOSE LIVE SEARCH MODAL W/ INPUT CLEAR - END


});

