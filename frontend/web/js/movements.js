$(function (){
    $('.addRecord').click(function () {
        $('#modalAddRecord').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });

    $('.uploadRecord').click(function () {
        $('#modalUpdRecord').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });

    $('.movementsCard').click(function () {
        $('#modalMovement').modal('show').
        find('#modalContent').
        load($(this).attr('value'));
    });
});