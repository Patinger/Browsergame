$( window ).scroll(function() {
	var $this = $(this);
    if ($this.scrollTop()) {
       $('#myTop').attr("class","myTopShow");
    } else {
       $('#myTop').attr("class","myTopHide");
    }
});
$( document ).ready(function() {
	document.oncontextmenu = function() {return false;};
});