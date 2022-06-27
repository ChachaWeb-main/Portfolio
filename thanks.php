<?php 
session_start();

// 直リンクアクセスであれば、戻す!
if (!isset($_SESSION['form'])) {
    header('Location: contact.php');
} else {
    $post = $_SESSION['form'];
}

//メールの日本語設定
mb_language("Japanese");
mb_internal_encoding("UTF-8");

//送信先アドレス = 相手方
$to = $_POST['email'];
//メール件名
$subject = "お問い合わせありがとうございます。";
//メッセージ本文を視覚的に見やすく格納（ヒアドキュメント）
$message = <<< EOM
お問い合わせありがとうございます。

以下の内容で承りました。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
【 お名前 】
{$_POST['name']}

【 メール 】
{$_POST['email']}

【 電話番号 】
{$_POST['phone']}

【 お問い合わせ内容 】
{$_POST['message']}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOM;
//送信元 = 自身
$headers = "From: chacha.forba.634@gmail.com";
//メール送信設定
mb_send_mail($to, $subject, $message, $headers);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Chacha WEB Create</title>
  <meta description="駆け出しWEBコーダー Chacha のポートフォリオサイトです。些細なご相談でも大丈夫です。お気軽にご連絡ください。">
  <!-- Viewport マルチデバイス対応のため -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon icon -->
  <link rel="shortcut icon" href="img/programmer.png">
  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <!-- Google fonts Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Sansita+Swashed:wght@600&display=swap"
    rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/style-rwd.css">
</head>
<body>
    <div class="container">
        <div class="thanks-msg">
            <p>お問い合わせありがとうございました。</p><br>
            <p>ご入力いただいたメールアドレス宛に、確認メールをお送りいたしましのでご確認ください。</p><br>
            <p>可能な限り早く折り返しご連絡させていただきますので</p><br>
            <p>少々お待ち頂けますと幸いです。</p><br>
            <p>今後ともどうぞよろしくお願いいたします。 </p><br>
            <img src="./img/title-logo.svg" width="120px" alt="サイトタイトルロゴ">
            <!-- <img src="./img/icon.png"> -->
        </div>
    </div>
</body>
</html>