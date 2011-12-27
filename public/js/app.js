$(document).ready(function () {
	$("#topbar-container").dropdown();
});

$("body").bind("click", function (e) {
    $(".dropdown-toggle").parent("li").removeClass("open");
});

$(".dropdown-toggle").click(function (e) {
	var $li = $(this).parent("li").toggleClass("open");
    return false;
});
