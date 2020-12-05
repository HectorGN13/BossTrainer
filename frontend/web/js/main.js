$("#togglebutton").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
	var $el = $(this).find('svg');
	$el.toggleClass("fa-chevron-left fa-chevron-right");
});

//scroll up
document.getElementById("button-up").addEventListener("click", scrollUp);

function scrollUp() {
	var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
	if (currentScroll > 0){
		window.requestAnimationFrame(scrollUp);
		window.scrollTo(0,currentScroll - (currentScroll / 10));
		buttonUp.style.transform = "scale(0)";
	}
}

 var buttonUp = document.getElementById("button-up");
window.onscroll = function (){
	var scroll = document.documentElement.scrollTop;
	if (scroll > 500) {
		buttonUp.style.transform = "scale(1)";
	} else if(scroll < 500 ) {
		buttonUp.style.transform = "scale(0)";
	}
}