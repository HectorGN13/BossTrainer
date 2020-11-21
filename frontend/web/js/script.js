$('.navbar-brand img').hover(function(){
    $(this).attr("src", function(index, attr){
        return attr.replace("logoBlanco.png", "logoColoryBlanco.png");
    });
}, function(){
    $(this).attr("src", function(index, attr){
        return attr.replace("logoColoryBlanco.png", "logoBlanco.png");
    });
});