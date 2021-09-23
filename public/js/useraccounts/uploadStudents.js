$(document).ready(function() {
    $('#uploadBtn').on('click', function(e){
        e.preventDefault();
        $('#uploadFormaModal').addClass('flex');
        $('#uploadFormaModal').removeClass('hidden');
    })
    $('#closeUploadBtn').on('click', function(e) {
        e.preventDefault();
        $('#uploadFormaModal').addClass('hidden');
        $('#uploadFormaModal').removeClass('flex');
    })
});