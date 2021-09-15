$(document).ready(function() {
    let file = document.getElementById('file');

    $(document).on('submit', '#importUserForm', function(e){
        e.preventDefault();
        console.log(file);
    });

});