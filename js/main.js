'use strict';


// =============== ページ内リンク先、追従するヘッダー分の高さを引いて適切な場所へスクロール ================
// (CSSで scroll-behavior: smooth; でもスームズスクロール可能だが飛び先がズレる、動きブレる)
$('#page-link a[href*="#"]').click(function () {
	var elmHash = $(this).attr('href');  //ページ内リンクのHTMLタグhrefから、リンクされているエリアidの値を取得
	var pos = $(elmHash).offset().top - 70;  //idの上部の距離からHeaderの高さを引いた値を取得
	$('body,html').animate({ scrollTop: pos }, 600);  //取得した位置にスクロール。数値が大きくなるほどゆっくりスクロール
	return false;
});


// =============== ハンバーガーメニュー, リンク先に飛ぶと同時にハンバーガーメニューを消す ===============
$(function () {
  // idがpage-linkの中のa要素がクリックされた時
  $('#page-link a').on('click', function () {
    // drawer_inputのチェックをオフにする
    $("#drawer_input").prop("checked", false);
  });
});


// ================ スキルアイコン ホバー時に表示されるアクション ===============
// $('.icon-hover').hover(
// 	function () {  // 子要素の「.text-contents」の要素を取得し、text-activeクラスをつける
// 		$(this).find('skill-name').addClass('text-active');
// 	},
// 	function () {  // 子要素の「.text-contents」の要素を取得し、text-activeクラスを外す
// 		$(this).find('skill-name').removeClass('text-active');
// 	}
// );


// =============== price 料金一覧 モーダル表示 ==============
$(function () {
  $('.show-modal').click(function () {
    $('#price-modal').fadeIn();
  });
  $('.close-modal').click(function () {
    $('#price-modal').fadeOut();
  });
});


// =============== wroksセクション カルーセル 自動スライド ===============
$(function () {
  /* ---------【必要な変数を定義】*/
  // スライドリストの合計幅を計算→CSSでエリアに代入
  let width = $('.carousel-list').outerWidth(true);  // .carousel-listの1枚分の幅
  let length = $('.carousel-list').length;  // .carousel-listの数
  let slideArea = width * length;  // レール全体幅 = スライド1枚の幅 × スライド合計数
  $('.carousel-area').css('width', slideArea);  // カルーセルレールに計算した合計幅を指定
  //  スライド現在値と最終スライド
  let slideCurrent = 0;  // スライド現在値（1枚目のスライド番号としての意味も含む）
  let lastCurrent = $('.carousel-list').length - 1;  // スライドの合計数＝最後のスライド番号
  /* ----------【スライドの動き方 + ページネーションに関する関数定義】*/
  // スライドの切り替わりを「changeslide」として定義
  function changeslide() {
    $('.carousel-area').stop().animate({  // stopメソッドを入れることでアニメーション1回毎に止める
      left: slideCurrent * -width  // 代入されたスライド数 × リスト1枚分の幅を左に動かす
    });
    // ページネーションの変数を定義（＝スライド現在値が必要）
    let pagiNation = slideCurrent + 1;  // nth-of-typeで指定するため0に＋1をする
    $('.pagination-circle').removeClass('target');  // targetクラスを削除
    $(".pagination-circle:nth-of-type(" + pagiNation + ")").addClass('target');  // 現在のボタンにtargetクラスを追加
  };
  /* -----------【自動スライド切り替えのタイマー関数定義】*/
  let Timer;
  // 一定時間毎に処理実行する「startTimer」として関数を定義
  function startTimer() {
    // 変数Timerに下記関数内容を代入する
    Timer = setInterval(function () {  // setInterval・・・指定した時間ごとに関数を実行
      if (slideCurrent === lastCurrent) {  // 現在のスライドが最終スライドの場合
        slideCurrent = 0;
        changeslide();  // スライド初期値の値を代入して関数実行（初めのスライドに戻す）
      } else {
        slideCurrent++;
        changeslide();  // そうでなければスライド番号を増やして（次のスライドに切り替え）関数実行
      };
    }, 3000);  // 上記動作を3秒毎に
  }
  /* ---------- 「startTimer」関数を止める「stopTimer」関数を定義 */
  /* （何故か？ => 例えば1枚目から2枚目へ2.9秒時点でボタンクリックでスライド送りした場合、2枚目は0.1秒で即3枚目に移動してしまうため） */
  function stopTimer() {
    clearInterval(Timer); // clearInterval・・・setIntervalで設定したタイマーを取り消す
  }
  // 自動スライド切り替えタイマー実行
  startTimer();
  /* ----------【ボタンクリック時関数を呼び出し】*/
  // NEXTボタン
  $('.js-btn-next').click(function () {
    // 動いているタイマーをストップして再度タイマーを動かし直す（こうしないとページ送り後の秒間隔がズレる）
    stopTimer();
    startTimer();
    if (slideCurrent === lastCurrent) {  // 現在のスライドが最終スライドの場合
      slideCurrent = 0;
      changeslide();  // スライド初期値の値を代入して関数実行（初めのスライドに戻す）
    } else {
      slideCurrent++;
      changeslide();  // そうでなければスライド番号を増やして（次のスライドに切り替え）関数実行
    };
  });
  // BACKボタン
  $('.js-btn-back').click(function () {
    // 動いているタイマーをストップして再度タイマーを動かし直す（こうしないとページ送り後の時間間隔がズレる）
    stopTimer();
    startTimer();
    if (slideCurrent === 0) {  // 現在のスライドが初期スライドの場合
      slideCurrent = lastCurrent;
      changeslide();  // 最終スライド番号を代入して関数実行（最後のスライドに移動）
    } else {
      slideCurrent--;
      changeslide();  // そうでなければスライド番号を減らして（前のスライドに切り替え）関数実行
    };
  });
});




// =============== ページトップリンク アクション ===============
// スクロールした際の動きの関数
function PageTopAnime() {
  var scroll = $(window).scrollTop();
  if (scroll >= 1000){// 上から指定数値スクロールしたら
    $('#page-top').removeClass('DownMove');// #page-topについているDownMoveというクラス名を除く
    $('#page-top').addClass('UpMove');// #page-topについているUpMoveというクラス名を付与
  }else{
    if($('#page-top').hasClass('UpMove')){// すでに#page-topにUpMoveというクラス名がついていたら
      $('#page-top').removeClass('UpMove');// UpMoveというクラス名を除き
      $('#page-top').addClass('DownMove');// DownMoveというクラス名を#page-topに付与
    }
  }
}
// クリックした際の設定
$('#page-top').click(function () {
	var scroll = $(window).scrollTop();  // スクロール値を取得
  if(scroll > 0){
		$(this).addClass('floatAnime');  // クリックしたらfloatAnimeというクラス名が付与
		$('body,html').animate({
			scrollTop: 0
		}, 1000,function(){  // スクロールの速さ。数字が大きくなるほど遅くなる
			$('#page-top').removeClass('floatAnime');  // 上までスクロールしたらfloatAnimeというクラス名を除く
		}); 
  }
	return false;  // リンク自体の無効化
});
// 画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function () {
	PageTopAnime();  /* スクロールした際の動きの関数を呼ぶ*/
});
// ページが読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {
  PageTopAnime();  /* スクロールした際の動きの関数を呼ぶ*/
});

