'use strict';

// ============== 各セクション ふわっと下から ===============
// 関数化
function fadeInDisplay() {
  const windowHeight = $(window).height();
  const scroll = $(window).scrollTop();
  $('.fadein-under').each(function () {
    const targetPosition = $(this).offset().top;
    if (scroll > targetPosition - windowHeight + 100) {
      $(this).addClass("fadein-add");
    }
  });
}
// リロード時、スクロール前でもアクション実行されるように
fadeInDisplay();

$(function() {
  $(window).scroll(function () {
    fadeInDisplay();
  });
});
