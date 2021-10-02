$(document).ready(function() {
    const rubricForm = document.getElementById('rubricForm');
    const addCriteriaBtn = document.getElementById('addCriteriaBtn');
    const criteriaList = document.getElementById('criteriaList');
    const nameError = document.getElementById('nameError');
    const criteriaError = document.getElementById('criteriaError');
    const percError = document.getElementById('percError');
    let name = document.getElementById('name');
    let criteria = document.getElementsByName('criteria[]');
    let percentages = document.getElementsByName('percentages[]');
    // ADD CRITERIA INPUT TAG
    $(addCriteriaBtn).on('click', function(e) {
        percError.innerHTML = '';
        nameError.innerHTML = '';
        criteriaError.innerHTML = '';
        e.preventDefault();
        let noError = true;
        for (var i = 0; i < criteria.length; i++) {
            if(criteria[i].value == "" || percentages[i].value == "") {
                criteriaError.innerHTML = `<span class="text-red-500">Please fill up the criteria</span>`;
                noError = false;
            } 
        }
        if(noError) {
            const div = document.createElement('div');
            div.setAttribute('class', 'flex flex-col mx-auto mb-2');
            div.innerHTML = `
                <h1 class="font-semibold mb-2">Criteria</h1>
                <div class="flex">
                    <input type="text" name="criteria[]" id="criteria" class="text-gray-800 flex-1 rounded mr-3" placeholder="Criteria name">
                    <input type="number" name="percentages[]" id="percentages" class="text-gray-800 flex-1 rounded mr-3" placeholder="Criteria percentage">
                    <div>
                        <button class="deleteBtn text-white rounded px-2 py-1 bg-red-500 hover:bg-red-600">&times;</button>
                    </div>
                </div>
            `;
            const deleteBtn = div.querySelector('.deleteBtn');
            deleteBtn.addEventListener('click', (e) => {
                e.preventDefault();
                percError.innerHTML = '';
                nameError.innerHTML = '';
                criteriaError.innerHTML = '';
                e.target.parentElement.parentElement.parentElement.remove();
            });
            criteriaList.appendChild(div);
        }
    });
    // ADD CRITERIA INPUT TAG

    // SUBMIT RUBRIC
    $(rubricForm).on('submit', function(e) {
        e.preventDefault();
        let noError = true;
        let count = 0;
        for (var i = 0; i < criteria.length; i++) {
            if(criteria[i].value == "" || percentages[i].value == "") {
                criteriaError.innerHTML = `<span class="text-red-500">Please fill up the criteria</span>`;
                noError = false;
            } 
            count += parseInt(percentages[i].value);
        }
        if(count != 100) {
            percError.innerHTML = `<span class="text-red-500">Total Percentage is more/less than 100</span>`
            noError = false;
        }
        if(name.value == "") {
            nameError.innerHTML = `<span class="text-red-500">Rubric name is required</span>`;
            noError = false;
        }
        if(noError) {
            rubricForm.submit();
        }
    });
    // SUBMIT RUBRIC
});