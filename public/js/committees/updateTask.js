$(document).ready(function() {
    const searchList = document.getElementById('searchList');
    const member = document.getElementById('member');
    const memberList = document.getElementById('memberList');
    const memberError = document.getElementById('memberError');
    const task = document.getElementById('task');
    const committee = document.getElementById('committee');
    const message = document.getElementById('message');
    fetchMembers();
    $('#updateTaskForm').on('submit', function(e) {
        e.preventDefault();
        // GET ALL USER ID
        const members = [];
        const memberContainers = document.querySelectorAll('.memberContainer');
        memberContainers.forEach((member) => {
            members.push(member.dataset.id);
        }); 
        let data = {
            'title' : $('#title').val(),
            'description' : $('#description').val(),
            'status' : $('#status').val(),
            'members' : members,
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: $('#updateTaskForm').attr('method'),
            url: $('#updateTaskForm').attr('action'),
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
                    alert(response.message);
                    window.location.href = response.url;
                }
            }
        });
    });

    // LIVE SEARCH FOR USERS
    $('#member').on('keyup', function() {
        let input = $(this).val();
        if(input == ""){
            searchList.innerHTML = '';
        } else {
            $.ajax({
                method:"GET",
                url:"/search-committee",
                data:{
                    'member':member.value,
                    'committee':committee.value,
                },
                success:function(data){
                    // DISPLAY SEARCH LIST
                    searchList.innerHTML = data;
                    searchList.childNodes.forEach((result) => {
                        // memberError.textContent = '';
                        // ADD MEMBER TO TASK
                        result.addEventListener('click', (e) => {
                            e.preventDefault();
                            searchList.innerHTML = "";
                            member.value = "";
                            const user_id = result.dataset.id;
                            const user = result.innerHTML;
                            checkIfMemberExist(user_id, user); 
                        });
                    });
                }
            });
        }
    });
    // LIVE SEARCH FOR USERS

    // FETCH MEMBER
    function fetchMembers() {
        $.ajax({
            type: 'GET',
            url: `/fetch-committee/${task.value}`,
            dataType: "json",
            success: function (response) {
                members = response.members
                memberList.innerHTML = '';
                for(let key in members) {
                     // CREATE CONTAINER FOR MEMBERS
                     const memberContainer = document.createElement('div');
                     memberContainer.setAttribute('class', 'memberContainer px-2 py-1 bg-white rounded inline-block w-4/5 m-0.5');
                     memberContainer.setAttribute('data-id' , members[key].id);
                     memberContainer.innerHTML = `
                        <span class="font-semibold">${members[key].first_name} ${members[key].middle_name} ${members[key].last_name}</span> 
                     `;
                     // DELETE MEMBER BTN
                     const deleteBtn = document.createElement('button');
                     deleteBtn.setAttribute('class' , 'deleteMemberBtn text-white bg-red-500 hover:bg-red-600 rounded px-2 ml-2');
                     deleteBtn.innerHTML = '&times;';
                     memberContainer.appendChild(deleteBtn);
                     deleteBtn.addEventListener('click', deleteMemberBtn);
                    memberList.appendChild(memberContainer);
                }
            }
        });
    };
    // FETCH MEMBER

    // DELETE MEMBER
    function deleteMemberBtn(e){
        e.preventDefault();
        e.target.parentElement.remove();
    }
    // DELETE MEMBER

    // CHECK IF MEMBER EXISTS
    function checkIfMemberExist(id, user){
        let members = document.querySelectorAll('.memberContainer');
        let memberInserted = false;
        members.forEach((member) => {
            if(id == member.dataset.id){
                memberError.textContent = "Member already included";
                setTimeout(function(){
                    memberError.innerHTML = '';
                }, 2000);
                memberInserted = true;
            } 
        });
        if(!memberInserted){ addMember(id, user); }
    }
    // CHECK IF MEMBER EXISTS

    // ADD MEMBER
    function addMember(id, user) {
        // CREATE CONTAINER FOR MEMBERS
        const memberContainer = document.createElement('div');
        memberContainer.setAttribute('class', 'memberContainer px-2 py-1 bg-white rounded inline-block m-0.5');
        memberContainer.setAttribute('data-id' , id);
        memberContainer.innerHTML = user;
        // DELETE MEMBER BTN
        const deleteBtn = document.createElement('a');
        deleteBtn.setAttribute('class' , 'deleteMemberBtn inline-block  text-white bg-red-500 hover:bg-red-600 rounded px-2 ml-2');
        deleteBtn.innerHTML = '&times;';
        memberContainer.appendChild(deleteBtn);
        // APPEND MEMBER TO THE CONTAINER
        memberList.appendChild(memberContainer);
    }
    // ADD MEMBER
});