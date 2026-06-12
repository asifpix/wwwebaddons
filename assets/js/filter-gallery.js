(function ($) {
	$(window).on("load", function () {
		$(".wwwa-filter-gallery-grid").each(function () {
			let $grid = $(this).isotope({
				itemSelector: ".gallery-item",
				percentPosition: true,
			});

			let $wrapper = $(this).closest(".wwwa-filter-gallery-wrapper");

			$wrapper.find(".wwwa-filter-buttons button").on("click", function () {
				$wrapper.find("button").removeClass("active");

				$(this).addClass("active");

				let filter = $(this).attr("data-filter");

				$grid.isotope({
					filter: filter,
				});
			});
		});
	});
})(jQuery);
