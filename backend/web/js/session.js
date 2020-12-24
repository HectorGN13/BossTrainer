$(function () {
    $('#addSession').click(function () {
        $('#modalAddSession').modal('show').find('#modalContent1').load($(this).attr('value'));
    });

    $('.uploadSession').click(function () {
        $('#modalUpdSession').modal('show').find('#modalContent2').load($(this).attr('value'));
    });
});