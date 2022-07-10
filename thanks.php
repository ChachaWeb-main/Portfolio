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
$to = $post['email'];
//メール件名
$subject = "お問い合わせありがとうございます。";
//メッセージ本文を視覚的に見やすく格納（ヒアドキュメント）
$message = <<< EOM
お問い合わせありがとうございます。

以下の内容で承りました。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
【 お名前 】
{$post['name']}

【 メール 】
{$post['email']}

【 電話番号 】
{$post['phone']}

【 お問い合わせ内容 】
{$post['message']}

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
  <title>送信完了 | Successfully sent</title>
  <!-- Viewport マルチデバイス対応のため -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon icon -->
  <link rel="shortcut icon" href="img/programmer.png">
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
    <div class="thanks-container">
      <div class="thanks-title">
        <p>お問い合わせありがとうございました。<br><span class="thanks-en">Thank you for your inquiry.<span></p>
      </div>
      <div class="thanks-text">
        <p>ご入力いただいたメールアドレス宛に、確認メールをお送りいたしましのでご確認ください。</p>
        <p>可能な限り早く折り返しご連絡させていただきますので、</p>
        <p>少々お待ち頂けますと幸いです。</p>
        <p class="thanks-en">Please check the confirmation email to your email address.</p>
        <p class="thanks-en">I will contact you as soon as possible,</p>
        <p class="thanks-en">I’d appreciate if you could wait for a while.</p>
      </div>
      <img src="./img/title-logo.svg" width="200px" alt="サイトタイトルロゴ">
    </div>
</body>
</html>