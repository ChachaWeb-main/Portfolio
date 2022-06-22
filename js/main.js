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


// ============== sendボタン アクション
$('button').click(function () {
  $('svg.move').css('transform', 'translateX(4em) rotate(45deg)')
});
$('button').mouseleave(function () {
  $('svg.move').css('transform', 'translateX(0)')
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

