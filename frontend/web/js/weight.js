$(function (){
    $('#addProgress').click(function () {
        $('#modalAddProgress').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });
});