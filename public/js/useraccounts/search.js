let search = document.getElementById('search');
let table = document.getElementById('users');

// HIDE TABLE
if(search.value == ''){
    table.classList.add('hidden')
}

search.addEventListener('input', (e) => {
    table.classList.remove('hidden')

    if(search.value == ''){
        table.classList.add('hidden')
        console.log('empty value');
    }

});