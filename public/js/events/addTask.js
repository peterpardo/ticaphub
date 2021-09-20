$(document).ready(function() {
    // ADD TASK
    const addTaskForm = document.getElementById('addTaskForm');
    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const event = document.getElementById('event');
    const list = document.getElementById('list');
    const message = document.getElementById('message');
    const searchList = document.getElementById('searchList');
    const member = document.getElementById('member');
    const tagContainer = document.getElementById('tagContainer');
    const memberError = document.getElementById('memberError');
    const taskLists = document.getElementById('taskLists');

    fetchTasks();

    addTaskForm.addEventListener('submit', (e) => {
        e.preventDefault();

        let tags = document.querySelectorAll('.tag');
        let members = [];

        // RETRIEVE ALL USER ID
        tags.forEach((tag) => {
            members.push(tag.dataset.id);
        });

        let data = {
            'title' : title.value,
            'description' : description.value,
            'members' : members,
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: `/events/${event.value}/list/${list.value}`,
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400) {
                    $.each(response.errors, function(key, value){
                        searchList.innerHTML = ""
                        message.innerHTML = "";
                        message.innerHTML = 
                        `<span class="inline-block text-red-500">${value}</span>`;
                    });
                } else {
                    message.innerHTML = "";
                    message.innerHTML =
                    `<span class="inline-block text-green-500">${response.message}</span>`;
                    title.value = "";
                    description.value = "";
                    tagContainer.innerHTML = "";

                    fetchTasks();

                    setTimeout(function(){
                        message.innerHTML = '';
                    }, 2000);
                }
            }
        });
    
    });
    // ADD TASK

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
                    
                    searchList.innerHTML = data;
                    searchList.childNodes.forEach((result) => {
                        memberError.textContent = '';
                        result.addEventListener('click', (e) => {
                            e.preventDefault();
                            searchList.innerHTML = "";
                            member.value = "";
                            let user_id= result.dataset.id;
                            let user= result.innerHTML;

                            // CHECK IF TAG EXISTS
                            checkIfTagExists(user_id, user);
            
                        });
                    });
                }
            });
        }
    });
    // // LIVE SEARCH FOR USERS

    // CREATE TAG
    function createTag(id, user) {
        const div = document.createElement('div');
        div.setAttribute('class', 'tag bg-blue-100 inline-flex items-center text-sm rounded mt-2 mr-1 overflow-hidden');
        div.setAttribute('data-id', id);
        div.innerHTML = 
        `<span class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1" x-text="tag">${user}</span>
        <button class="deleteTagBtn w-6 h-8 inline-block align-middle text-gray-500 bg-blue-200 focus:outline-none">
          <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"/></svg>
        </button>`;

        const deleteTagBtn = div.querySelector('.deleteTagBtn');
        deleteTagBtn.addEventListener('click', deleteTag);

        tagContainer.append(div);
    }
    // CREATE TAG

    // CHECK IF TAG EXISTS
    function checkIfTagExists(id, user){
        let tags = document.querySelectorAll('.tag');
        let memberInserted = false;

        tags.forEach((tag) => {
            if(id == tag.dataset.id){
                memberError.textContent = "Member already inserted";
                memberInserted = true;
            } 
        });
        
        if(!memberInserted){ createTag(id, user); }
    }
    // CHECK IF TAG EXISTS

    // DELETE TAG
    function deleteTag(e){
        const element = e.currentTarget.parentElement;
        element.remove();
    }
    // DELETE TAG

    // FETCH TASK
    function fetchTasks() {
        $.ajax({
            type: 'GET',
            url: `/fetch-tasks/${list.value}`,
            dataType: "json",
            success: function (response) {
                tasks = response.tasks
                taskLists.innerHTML = '';
                for(let key in tasks){
                    let created_at = new Date(tasks[key].created_at).toLocaleString();

                    $(taskLists).append(`
                        <tr>
                            <td class="px-4 py-3 border">${tasks[key].title}</td>
                            <td class="px-4 py-3 border">${tasks[key].description}</td>
                            <td class="px-4 py-3 border">${tasks[key].task_creator.first_name} ${tasks[key].task_creator.middle_name} ${tasks[key].task_creator.last_name}</td>
                            <td class="px-4 py-3 border">${created_at}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <a href="/events/${event.value}/list/${list.value}/task/${tasks[key].id}" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>
                                <button data-id="${tasks[key].id}" class="removeTaskBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                    `);
                }

                // // REMOVE TASK BUTTON
                let removeTaskBtn = document.querySelectorAll(".removeTaskBtn")

                removeTaskBtn.forEach((btn) => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        let data = {
                            'task_id' : btn.dataset.id,
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                        $.ajax({
                            type: 'POST',
                            url: '/delete-task',
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                if(response.status == 200) {
                                    message.innerHTML = "";
                                    message.innerHTML =
                                    `<span class="inline-block text-green-500">${response.message}</span>`;
                                    title.value = "";
                                    description.value = "";
                                    tagContainer.innerHTML = "";

                                    fetchTasks();

                                    setTimeout(function(){
                                        message.innerHTML = '';
                                    }, 2000);
                                } 

                            }
                        });
                    });
                });
                // REMOVE TASK BUTTON
            }
        });
    };
    // FETCH TASK


});