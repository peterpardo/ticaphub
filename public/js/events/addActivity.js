$(document).ready(function() {
    const addActivityForm = document.getElementById('addActivityForm');
    let activityError = document.getElementById('activityError');
    const activityList = document.getElementById('activityList');
    const task = document.getElementById('task');
    const fileContainer = document.getElementById('fileContainer');
    const moveTaskForm = document.getElementById('moveTaskForm');
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
                            <li><a href="/download-event-file/${files[key].name}" class="hover:text-blue-600 text-blue-500">${files[key].name}</a></li>
                        </ul>`
                    );
                }
            }
        });
    };
    // FETCH FILES

    // MOVE TASK
    moveTaskForm.addEventListener('submit', (e) => {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: $(moveTaskForm).attr('action'),
            method: $(moveTaskForm).attr('method'),
            data: new FormData(moveTaskForm),
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == 400){
                    modal.classList.add('hidden');
                    // moveTaskError.innerHTML = '';
                    let err = response.errors;
                    for(let key in err) {
                        alert(err[key]);
                    }
                } else {
                    location.href = response.url;
                }
            }
        });
    });
    // MOVE TASK
});