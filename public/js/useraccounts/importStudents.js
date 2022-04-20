const specializationContainer = document.getElementById('specialization-container');
const schoolContainer = document.getElementById('school-container');
const uploadForm = document.getElementById('upload-student-form');
const token = document.getElementById('ticap-token');
const submitBtnDiv = document.getElementById('submit-btn-div');
const spinner = document.getElementById('loading-spinner');

// Listen for changes in the school input
schoolContainer.addEventListener('change', () => {
    // Returns the specializations of the chosen school
    fetch('/get-specializations', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token.getAttribute('content'),
            'Content-Type': 'application/json;charset=utf-8',
        },
        body: JSON.stringify({ 'schoolId':  schoolContainer.value }),
    })
    .then(response => response.json())
    .then(specializations => {
        // Remove previous specializations when user changes school
        // Exclude the first option
        let containerLength = specializationContainer.children.length;
        while (containerLength > 1) {
            containerLength--;
            specializationContainer.removeChild(specializationContainer.children[containerLength]);
        }

        // Loop through the specializations of the selected school
        specializations.forEach(specialization => {
            // Get the specialization name and id
            const specializationName = specialization['name'];
            const specializationId = specialization['id'];

            // create an option tag
            // set value to specialization id
            // set content to specialization name
            const option = document.createElement('option');
            option.setAttribute('value', specializationId);
            option.textContent = specializationName;

            // Append option to the specialization container
            specializationContainer.append(option);
        });
    });
});

// Submit Form
uploadForm.addEventListener('submit', e => {
    e.preventDefault();
    // Hide submit button
    submitBtnDiv.classList.add('hidden');

    // Show spinner
    spinner.classList.remove('hidden');
    spinner.classList.add('flex');

    uploadForm.submit();
});


