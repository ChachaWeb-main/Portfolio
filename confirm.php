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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // メールを送信する
  $to = 'chacha.forba.634@gmail.com';
  $from = $post['email'];
  $subject = 'CahcahWebCreateにお問い合わせが届きました';
  $body = <<<EOT
名前： {$post['name']}
メールアドレス： {$post['email']}
電話番号： {$post['phone']}
内容：
{$post['message']}
EOT;
  // 実際の送信はサーバーアップしないとできないため var_dumpで値をチェック
  var_dump($body);
  exit();
  // メール送信設定
  // mb_send_mail($to, $subject, $body, "From: {$form}");
  // セッションを消してお礼画面へ
  unset($_SESSION['form']);
  header('Location: thanks.php');
  exit();
}
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
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Sansita+Swashed:wght@600&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/style-rwd.css">
</head>

<body>
  <form action="" method="POST">
    <div class="confirm-con">
      <h1>お問い合わせ内容確認</h1>
      <p>お問い合わせ内容はこちらで宜しいでしょうか？<br>よろしければ「送信」ボタンをクリックして下さい。</p>

      <div class="confirm-wrap">
        <table class="confirm-table">
          <tr>
            <th><span class="input-item">お名前</span></th>
            <td>
              <p class="display-item-name"><?php echo htmlspecialchars($post['name']); ?></p>
            </td>
          </tr>
          <tr>
            <th><span class="input-item">メールアドレス</span></th>
            <td>
              <p class="display-item-mail"><?php echo htmlspecialchars($post['email']); ?></p>
            </td>
          </tr>
          <tr>
            <th><span class="input-item">電話番号</span></th>
            <td>
              <p class="display-item-phone"><?php echo htmlspecialchars($post['phone']); ?></p>
            </td>
          </tr>
          <tr>
            <th><span class="input-item">お問い合わせ内容</span></th>
            <td>
              <p class="display-item"><?php echo nl2br(htmlspecialchars($post['message'])); ?></p>
            </td>
          </tr>
        </table>
      </div>

      <div class="confirm-return-btn">
        <a class="return" href="contact.php"><span>内容を修正</span></a>
      </div>
      <button type="submit">
        <div class="svg-wrapper">
          <svg class="move" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
            <path fill="none" d="M0 0h24v24H0z"></path>
            <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
            </path>
          </svg>
        </div>
        <span class="send">送信</span>
      </button>
    </div>
  </form>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script src="./js/main.js"></script>
</body>
</html>