$(document).ready(function() {
    const form = document.getElementById('panelistForm')
    const addBtn = document.getElementById('addBtn');
    const panelists = document.getElementsByName('panelists[]');
    const table = document.getElementById('panelistTable');
    const message = document.getElementById('message');
    const spec = document.getElementById('spec');
    const specMsg = document.getElementById('specMsg');

    addBtn.addEventListener('click', (e) => {
        e.preventDefault();
        message.innerHTML = '';
        let noError = true;
        let chosenPanelists = [];
        panelists.forEach((p) => {
            chosenPanelists.push(p.value);
            if(p.value == "") { 
                message.innerHTML = `<span class="text-red-500">Panelist must not be empty</span>`
                noError = false;
            }
        });
        if(noError) {
            fetchPanelists(chosenPanelists);
        }
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let noError = true;
        if(spec.value == "") {
            specMsg.innerHTML = `<span class="text-red-500">Specialization must not be empty</span>`
            noError = false;
        } 
        panelists.forEach((p) => {
            if(p.value == "") { 
                message.innerHTML = `<span class="text-red-500">Panelist must not be empty</span>`
                noError = false;
            }
        });
        if(noError) {
            form.submit();
        }
    });

    
    // ADD SELECT TAGS FOR PANELISTS
    function fetchPanelists(chosenPanelists) {
        $.ajax({
            type: 'GET',
            url: '/fetch-panelists',
            dataType: "json",
            success: function (response) {
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const select = document.createElement('select')
                const option = document.createElement('option');

                select.setAttribute('name' , 'panelists[]');
                select.setAttribute('class' , 'w-full rounded my-2');
                option.setAttribute('value', "");
                option.innerText = "--select panelist--";
                td2.innerHTML = `
                    <a class="removeBtn inline-block cursor-pointer bg-red-500 hover:bg-red-600 rounded text-white px-2 py-2">remove</a>
                `;

                select.appendChild(option);
                td1.appendChild(select);
                tr.appendChild(td1); 
                tr.appendChild(td2);

                $.each(response.panelists, function (key, item){
                    if(!chosenPanelists.includes(`${item.id}`)) {
                        let opt = document.createElement('option');
                        opt.setAttribute('value', item.id);
                        opt.innerText = `${item.first_name} ${item.middle_name} ${item.last_name}`;
                        select.appendChild(opt);
                    }
                });

                table.append(tr);

                const deleteBtn = td2.querySelector('.removeBtn');
                deleteBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.target.parentElement.parentElement.remove();
                });
            }
        });
    };

});