$(document).ready(function() {
    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const addTaskForm = document.getElementById('addTaskForm');
    const searchList = document.getElementById('searchList');
    const member = document.getElementById('member');
    const tagContainer = document.getElementById('tagContainer');
    const memberError = document.getElementById('memberError');
    const committee = document.getElementById('committee');
    const message = document.getElementById('message');

     // ADD TASK FORM
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
            url: `/committee/${committee.value}/add-task`,
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400) {
                    searchList.innerHTML = ""
                    message.innerHTML = "";
                    $.each(response.errors, function(key, value){    
                        message.innerHTML += 
                        `<span class="inline-block text-red-500">${value}</span>`;
                    });
                } else {
                    alert(response.message);
                    location.href = response.url;
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
                url:"/search-committee",
                data:{
                    'member':member.value,
                    'committee':committee.value,
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
        `<span class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1">${user}</span>
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
                setTimeout(function(){
                    memberError.innerHTML = '';
                }, 2000);
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
});