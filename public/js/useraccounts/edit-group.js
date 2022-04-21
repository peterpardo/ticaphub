const specializationContainer = document.getElementById('specialization');
const schoolContainer = document.getElementById('school');
const token = document.getElementById('ticap-token');

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


