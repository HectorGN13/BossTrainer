$("#togglebutton").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    var $el = $(this).find('svg');
    $el.toggleClass("fa-chevron-left fa-chevron-right");
});