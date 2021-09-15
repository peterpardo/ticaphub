$(document).ready(function() {
    $("#invitationForm").submit(function(){
        if ($('input:checkbox').filter(':checked').length < 1){
            $('#message').append('Please pick at least one school');
            return false;
        }
    });
});