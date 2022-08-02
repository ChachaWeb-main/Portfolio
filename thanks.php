<?php 
  session_start();

  if (!isset($_SESSION['form'])) {
      header('Location: contact.php');
  } else {
      $post = $_SESSION['form'];
  }

  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  # 送信先アドレス = 相手方
  $to = $post['email'];
  # メール件名
  $subject = $post['name']. " 様,". " お問い合わせありがとうございます。" . "Dear. ". $post['name']. " , Thank you for your inquiry." ;
  # メッセージ本文を視覚的に見やすく格納（ヒアドキュメント）
  $message = <<< EOM
  お問い合わせありがとうございます。
  Thank you for your inquiry.

  以下の内容で承りました。
  I accepted with the following contents.
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  【 お名前 | Your Name 】
      {$post['name']}

  【 メール | E-mail 】
      {$post['email']}

  【 電話番号 | Phone Number 】
      {$post['phone']}

  【 お問い合わせ内容 | Contents of inquiry 】
      {$post['message']}

  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  Chacha WEB Create
    佐々木 大輔 (チャチャ)
    Daisuke Sasaki (Chacha)
  EOM;
  # 送信元 = 自身
  $headers = "From: chacha.forba.634@gmail.com";

  # メール送信設定
  // var_dump($to, $subject, $message, $headers);
  // exit();
  mb_send_mail($to, $subject, $message, $headers);

  # 最後にセッション(入力データ)を消去
  unset($_SESSION['form']);
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
      <div class="thanks-wrap">
        <div class="thanks-title">
          <p>お問い合わせありがとうございました。<br><span class="thanks-en">Thank you for your inquiry.<span></p>
        </div>
        <div class="thanks-text">
          <p>ご入力いただいたメールアドレス宛に、確認メールをお送りいたしましのでご確認ください。</p>
          <p>※ 場合によって迷惑フォルダに届く可能性もございますのでご了承くださいませ</p>
          <p>可能な限り早く折り返しご連絡させていただきますので、</p>
          <p>少々お待ち頂けますと幸いです。</p>
          <p class="thanks-en">Please check the confirmation email to your email address.</p>
          <p class="thanks-en">※ There is the possibility to receive in the spam/junk folder in some cases.</p>
          <p class="thanks-en">I will contact you as soon as possible,</p>
          <p class="thanks-en">I’d appreciate if you could wait for a while.</p>
        </div>
        <img src="./img/title-logo.svg" width="200px" alt="サイトタイトルロゴ">
      </div>
      <div class="btn-to-top">
        <a href="./index.html" class="return"><span>トップへ戻る | Return to top</span></a>
      </div>
    </div>
</body>
</html>