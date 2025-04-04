$(document).ready(function () {
	// alert("Strona załadowana!");

	$('#header').delay(3000).slideUp();

	$('#showHideBtn').click(function () {
		$('#listElement').toggle();
	});

	$(document).ready(function () {
		$('#text-color-btn').click(function () {
			const selectedColor = $('#color-select').val();
			$('.holiday-text').css('color', selectedColor);
		});

		$('#background-color-btn').click(function () {
			const selectedColor = $('#color-select').val();
			$('.holiday-text').css('background-color', selectedColor);
		});
	});

	$(document).ready(function () {
		$('#apply-style-one').click(function () {
			$('#greeting').removeClass('style-two').addClass('style-one');
		});

		$('#apply-style-two').click(function () {
			$('#greeting').removeClass('style-one').addClass('style-two');
		});
	});
});
