$(function (){
   $('#restorePassLink').click(function () {
       $('#modalPass').modal('show').
       find('#modalContent').
       load($(this).attr('value'));
   });

    $('#restoreVerificationEmail').click(function () {
        $('#modalEmail').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });
});