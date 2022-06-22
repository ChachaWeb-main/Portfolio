'use strict';

// ============== サイトサクセス時のアニメーション ===============
// ライブラリを使用（ProgressBar.js というローディング時の数字のカウントアップとプログレスバーを表示）
var bar = new ProgressBar.Line(splash_text, {
  easing: "easeInOut", //アニメーション効果linear、easeIn、easeOut、easeInOutが指定可能
  duration: 1500, //時間指定(1000＝1秒)
  strokeWidth: 0.2, //進捗ゲージの太さ
  color: "#555", //進捗ゲージのカラー
  trailWidth: 0.2, //ゲージベースの線の太さ
  trailColor: "#bbb", //ゲージベースの線のカラー
  text: {
    style: {
      //中央配置
      position: "absolute",
      left: "50%",
      top: "50%",
      padding: "0",
      margin: "-30px 0 0 0", //バーより上に配置
      transform: "translate(-50%,-50%)", "font-size": "2rem",
      color: "#fff"
    },
    autoStyleContainer: false //自動付与のスタイルを切る
  },
  step: function (state, bar) {
    bar.setText(Math.round(bar.value() * 100) + " %"); //テキストの数値
  }
});
// アニメーションスタート
bar.animate(1.0, function () { // バーを描画する割合を指定します 1.0 なら100%まで描画します
  $("#splash").delay(1000).fadeOut(1200); //アニメーションが終わったら#splashエリアをフェードアウト
});

// ============== 各セクション ふわっと下から ===============
function fadeInDisplay() {
  const windowHeight = $(window).height();
  const scroll = $(window).scrollTop();
  $('.under-fadein').each(function () {
    const targetPosition = $(this).offset().top;
    if (scroll > targetPosition - windowHeight + 100) {
      $(this).addClass("add-fadein");
    }
  });
}
// リロード時、スクロール前でもアクション実行されるように
fadeInDisplay();
$(window).scroll(function () {
  fadeInDisplay();
});


// =============== aboutセクション 浮き出る表示のアクション ===============
// リロード時、スクロール前でもアクション実行されるように
// aboutFadeInDisplay ();

// $(window).scroll(function () {
//   aboutFadeInDisplay ();
// });
// // 関数化
// function aboutFadeInDisplay () {
//   const windowHeight = $(window).height();
//   const scroll = $(window).scrollTop();
//   $('.js-img').each(function () {
//     const targetPosition = $(this).offset().top;
//     if (scroll > targetPosition - windowHeight + 100) {
//       $(this).addClass("is-fadein");
//     }
//   });
//   $('.js-author').each(function () {
//     const targetPosition = $(this).offset().top;
//     if (scroll > targetPosition - windowHeight + 100) {
//       $(this).addClass("is-fadein");
//     }
//   });
// }