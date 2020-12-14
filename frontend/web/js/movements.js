$(function (){
    $('#addRecord').click(function () {
        $('#modalRecord').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });

    $('#uploadRecord').click(function () {
        $('#modalRecord').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });
});