document.addEventListener('alpine:init', () => {
    Alpine.data('sample', () => ({
        init() {
            fetch('/users/schools')
            .then(res => res.json())
            .then(data => {
                this.schools = data;
                console.log(data);
            })
        },
        schools: [],
        async updateSchoolStatus(id){
            console.log("🚀 ~ file: set-invitation.js ~ line 12 ~ Alpine.data ~ id", id)
        }
    }))
})

// // Updates school if it's involved or not
// async function updateSchoolStatus(id) {
//     // let response = await fetch('users/update-school-status', {
//     //     method: 'POST',
//     //     headers: {
//     //         'Content-Type': 'application/json',
//     //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//     //     }
//     // })
// }

// // Fetches all schoools
// async function getSchools () {
//     let response = await fetch('/users/schools');
//     let data = await response.json();
//     return data;
// }

// // Sets the specialization table (must run after page load)
// async function setSpecializationTable () {
//     const schools = await getSchools();
//     const specTable = document.getElementById('specTable');

//     // Loop through schools
//     schools.forEach(school => {
//         // Loop through specializations for each schol
//         school?.specializations.forEach(spec => {
//             const specRow = createSpecRow(school, spec);

//             // Append row to table
//             specTable.appendChild(specRow);
//         });
//     })
// }

// // Creates specialization row
// function createSpecRow(school, spec) {
//     const tr = document.createElement('tr');

//     tr.innerHTML = `
//     <tr class="bg-white border-b">
//         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
//             ${school.name}
//         </td>
//         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
//             ${spec.name}
//         </td>
//         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
//             <button type="button" class="bg-red-500 p-2 rounded text-white hover:bg-red-300" data-id="${spec.id}">
//                 &times;
//             </button>
//         </td>
//     </tr class="bg-white border-b">
//     `
//     return tr;
// }

// // Run after page loads
// window.onload = () => {
//     setSpecializationTable();
// }



