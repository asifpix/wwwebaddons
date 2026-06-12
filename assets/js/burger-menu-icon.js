(function ($) {
	$(document).ready(function () {
		let offCanvasMenu = $("#wwwa-off-canvas-menu");
		$(".header-burger-btn").on("click", function (e) {
			$(this).toggleClass("burger--active");
			offCanvasMenu.toggleClass("active");
			$("#wwwa-off-canvas-menu-wrapper").toggleClass("active");
			$("body").toggleClass("no-scroll");
		});
		$(".wwwa-off-canvas-menu-wrapper").on("click", function (e) {
			$(".header-burger-btn").removeClass("burger--active");
			offCanvasMenu.removeClass("active");
			$(this).removeClass("active");
			$("body").removeClass("no-scroll");
			e.stopPropagation();
		});
	});
})(jQuery);
