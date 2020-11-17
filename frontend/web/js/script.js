$('.navbar-brand img').hover(function(){
    $(this).attr("src", function(index, attr){
        return attr.replace("logoBlanco.png", "logoRojo.png");
    });
}, function(){
    $(this).attr("src", function(index, attr){
        return attr.replace("logoRojo.png", "logoBlanco.png");
    });
});