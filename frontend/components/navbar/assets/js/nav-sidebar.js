$("#togglebutton").click(function(e) {
    e.preventDefault();
    $("#sidebar").toggleClass("toggled");
    var $el = $(this).find('svg');
    $el.toggleClass("fa-chevron-left fa-chevron-right");
});