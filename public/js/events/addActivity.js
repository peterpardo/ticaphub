$(document).ready(function() {
    const addActivityForm = document.getElementById('addActivityForm');
    const fileContainer = document.getElementById('fileContainer');
    // const task = document.getElementById('task');
    // let activityError = document.getElementById('activityError');
    // const activityList = document.getElementById('activityList');
    // const moveTaskForm = document.getElementById('moveTaskForm');
    // const addMemberBtn = document.getElementById("addMemberBtn");
    // const addMemberModal = document.getElementById("addMemberModal");
    // const addMemberCloseBtn = document.getElementById("addMemberCloseBtn");
    // const searchList = document.getElementById('searchList');
    // const memberError = document.getElementById('memberError');
    // const member = document.getElementById('member');
    // const memberContainer = document.getElementById('memberContainer');
    // const message = document.getElementById('message');

    // // ADD MEMBER MODAL
    // addMemberBtn.addEventListener("click", function () {
    //     addMemberModal.classList.remove("hidden");
    //     addMemberModal.classList.add("flex");
    //     fetchMembers();
    // });

    // addMemberCloseBtn.addEventListener("click", function () {
    //     addMemberModal.classList.add("hidden");
    //     addMemberModal.classList.remove("flex");
    //     window.location.reload(true);
    // });
    // // ADD MEMBER MODAL

    // const moveTaskError = document.getElementById('moveTaskError');

    fetchActivities();
    fetchFiles();

    // ADD ACTIVITY
    addActivityForm.addEventListener('submit', (e) => {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: $(addActivityForm).attr('action'),
            method: $(addActivityForm).attr('method'),
            data: new FormData(addActivityForm),
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == 400) {
                    activityError.innerHTML = "";
                    $.each(response.errors, function(key, value){
                        activityError.innerHTML = value;
                    });

                    setTimeout(function(){
                        activityError.innerHTML = '';
                    }, 2000);
                }else{
                    $(addActivityForm)[0].reset();
                    alert(response.message);
                    fetchActivities();
                    fetchFiles();
                }
            }
        });
    });
    // ADD ACTIVITY

    // FETCH ACTIVITY 
    function fetchActivities() {
        $.ajax({
            type: 'GET',
            url: `/fetch-activity/${task.value}`,
            dataType: "json",
            success: function (response) {
                activities = response.activities;
                activityList.innerHTML = '';
                for(let key in activities){
                    let created_at = new Date(activities[key].created_at).toLocaleString();
                    // CREATE ACTIVITY CONTAINER
                    const activityContainer = document.createElement('div');
                    activityContainer.setAttribute('class', 'activityContainer p-1 border border-gray-300 rounded my-3');
                    activityContainer.innerHTML = `
                        <h1 class="font-semibold border-b border-black">${activities[key].user.first_name} ${activities[key].user.last_name} <span>${created_at}</span></h1>
                        <p class="p-2">${activities[key].description}</p>
                        <ul class="fileList list-disc list-inside"></ul>
                    `;
                    const fileList = activityContainer.querySelector('.fileList');
                    if(activities[key].files.length >= 1){
                        for(let k in activities[key].files){
                            $(fileList).append(
                                `<li><a href="/download-event-file/${activities[key].files[k].name}" class="hover:text-blue-600 text-blue-500">${activities[key].files[k].name}</a></li>`
                            );
                        }
                    }
                    activityList.appendChild(activityContainer);
                }
            }
        });
    };
    // FETCH ACTIVITY

    // FETCH FILES
    function fetchFiles() {
        $.ajax({
            type: 'GET',
            url: `/fetch-files/${task.value}`,
            dataType: "json",
            success: function (response) {
                files = response.files;
                fileContainer.innerHTML = '';
                for(let key in files){
                    // CREATE FILE LIST
                    $(fileContainer).append(
                        `<ul class="list-disc list-inside">
                            <li><a href="/event-files/${files[key].path}" class="hover:text-blue-600 text-blue-500">${files[key].name}</a></li>
                        </ul>`
                    );
                }
            }
        });
    };
    // FETCH FILES

    // // MOVE TASK
    // moveTaskForm.addEventListener('submit', (e) => {
    //     e.preventDefault();

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         url: $(moveTaskForm).attr('action'),
    //         method: $(moveTaskForm).attr('method'),
    //         data: new FormData(moveTaskForm),
    //         dataType: "json",
    //         processData: false,
    //         contentType: false,
    //         success: function (response) {
    //             if(response.status == 400){
    //                 modal.classList.add('hidden');
    //                 // moveTaskError.innerHTML = '';
    //                 let err = response.errors;
    //                 for(let key in err) {
    //                     alert(err[key]);
    //                 }
    //             } else {
    //                 location.href = response.url;
    //             }
    //         }
    //     });
    // });
    // // MOVE TASK

     // LIVE SEARCH FOR USERS
     $('#member').on('keyup', function() {
        let input = $(this).val();

        if(input == ""){
            searchList.innerHTML = "";
        } else {
            $.ajax({
                method:"GET",
                url:"/search-member",
                data:{
                    'member':member.value,
                },
                success:function(data){
                    
                    // DISPLAY SEARCH LIST
                    searchList.innerHTML = data;
                    searchList.childNodes.forEach((result) => {
                        memberError.textContent = '';

                        // ADD MEMBER TO TASK
                        result.addEventListener('click', (e) => {
                            e.preventDefault();
                            searchList.innerHTML = "";
                            member.value = "";

                            // CREATE CONTAINER FOR MEMBERS
                            const memberDiv = document.createElement('div');
                            memberDiv.setAttribute('class', 'memberDiv');
                            memberDiv.innerHTML = result.innerHTML;
                            // DELETE MEMBER BTN
                            const deleteBtn = document.createElement('button');
                            deleteBtn.setAttribute('class' , 'deleteMemberBtn text-white bg-red-500 hover:bg-red-600 rounded px-2 ml-2');
                            deleteBtn.setAttribute('data-id' , result.dataset.id);
                            deleteBtn.innerHTML = '&times;';
                            memberDiv.appendChild(deleteBtn);
                            // APPEND MEMBER TO THE CONTAINER
                            memberContainer.appendChild(memberDiv);

                            // ADD MEMBER TO THE TASK
                            let data = {
                                'officer' : deleteBtn.dataset.id,
                            };

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type: 'POST',
                                url: `/add-officer-to-task/${task.value}`,
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    // if(response.status == 200) {
                                    //     message.innerHTML = "";
                                    //     message.innerHTML =
                                    //     `<span class="inline-block text-green-500">${response.message}</span>`;

                                    //     fetchMembers();

                                    //     setTimeout(function(){
                                    //         message.innerHTML = '';
                                    //     }, 2000);
                                    // } 

                                }
                            });
            
                        });
                    });
                }
            });
        }
    });
    // LIVE SEARCH FOR USERS

    // // FETCH MEMBER
    // function fetchMembers() {
    //     $.ajax({
    //         type: 'GET',
    //         url: `/fetch-members/${task.value}`,
    //         dataType: "json",
    //         success: function (response) {
    //             console.log(response.members);
    //             members = response.members
    //             memberContainer.innerHTML = '';
    //             for(let key in members) {
    //                  // CREATE CONTAINER FOR MEMBERS
    //                  const memberDiv = document.createElement('div');
    //                  memberDiv.setAttribute('class', 'memberDiv');
    //                  memberDiv.innerHTML = `
    //                     <span class="font-semibold">${members[key].first_name} ${members[key].middle_name} ${members[key].last_name}</span> | ${members[key].school.name} | ${members[key].user_specialization.specialization.name}
    //                  `;
    //                  // DELETE MEMBER BTN
    //                  const deleteBtn = document.createElement('button');
    //                  deleteBtn.setAttribute('class' , 'deleteMemberBtn text-white bg-red-500 hover:bg-red-600 rounded px-2 ml-2');
    //                  deleteBtn.setAttribute('data-id' , members[key].id);
    //                  deleteBtn.innerHTML = '&times;';
    //                  memberDiv.appendChild(deleteBtn);

    //                  deleteBtn.addEventListener('click', deleteMemberBtn);

    //                  memberContainer.appendChild(memberDiv);
    //             }
    //         }
    //     });
    // };
    // // FETCH MEMBER

    // // DELETE MEMBER
    // function deleteMemberBtn(e){
    //     e.preventDefault();

    //     let data = {
    //         'officer' : e.target.dataset.id,
    //     };

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    
    //     $.ajax({
    //         type: 'POST',
    //         url: `/delete-officer-from-task/${task.value}`,
    //         data: data,
    //         dataType: "json",
    //         success: function (response) {
    //             if(response.status == 200) {
    //                 message.innerHTML = "";
    //                 message.innerHTML =
    //                 `<span class="inline-block text-green-500">${response.message}</span>`;

    //                 fetchMembers();

    //                 setTimeout(function(){
    //                     message.innerHTML = '';
    //                 }, 2000);
    //             } 

    //         }
    //     });
    // }
    // // DELETE MEMBER

    // // ADD MEMBER FUNCTION
    // function addMember(e) {
    //     e.preventDefault();
    //     console.log(e.target);
    // }
    // // ADD MEMBER FUNCTION
});