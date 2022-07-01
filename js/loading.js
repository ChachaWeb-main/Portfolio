'use strict';

/* ※他のfadeinに干渉して？フワッと表示が作動しないためこの別ファイルへ */

// ============== サイトサクセス時のローディングアニメーション ===============
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