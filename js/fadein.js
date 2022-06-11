'use strict';

// ============== サイトサクセス時のアニメーション
$(function() {
	setTimeout(function(){
		$('.fadeIn img').fadeIn(1000);
	},200);
	setTimeout(function(){
		$('.fadeIn').fadeOut(1000);
	},3000);
});

// ============== 各セクション ふわっと下から
$(window).scroll(function () {
	const windowHeight = $(window).height();
	const scroll = $(window).scrollTop();
	$('.under-fadein').each(function () {
		const targetPosition = $(this).offset().top;
		if (scroll > targetPosition - windowHeight + 100) {
			$(this).addClass("is-fadein");
		}
	});
});