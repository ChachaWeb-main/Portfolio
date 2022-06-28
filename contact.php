<?php
session_start();

// エラーメッセージ判定
$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post = filter_input_array(INPUT_POST, $_POST);
  // フォーム送信時にエラーチェック
  if (empty($post['name'])) {
    // 空の場合
    $error['name'] = 'blank';
  } elseif (preg_match("/^[ぁ-んァ-ヶ一ー-龠a-zA-Z0-9]{1,50}+$/u", $post['name'])) {
    // 正規表現に合致する場合(ひらがな・漢字・アルファベット, 1 ~ 50字)
  } else {
    // 正規表現に合致しない場合
    $error['name'] = 'invaild';
  }

  if (empty($post['email'])) {
    // 空の場合
    $error['email'] = 'blank';
  } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'invaild';
  }

  if (preg_match("/^0[-0-9]{9,13}$/", $post['phone'])) {
    // 正規表現に合致する場合
  } else {
    // 正規表現に合致しない場合
    $error['phone'] = 'invaild';
  }

  if (empty($post['message'])) {
    // 空の場合
    $error['message'] = 'blank';
  } elseif (preg_match("/^[ぁ-んァ-ヶ一ー-龠a-zA-Z0-9]{1,250}+$/u", $post['name'])) {
    // 正規表現に合致する場合(ひらがな・漢字・アルファベット, 1 ~ 250字)
  } else {
    // 正規表現に合致しない場合
    $error['message'] = 'invaild';
  }

  // 上記で$errorの配列数カウントが０＝エラーがなければ
  if (count($error) === 0) {
    // エラーがないので確認画面に移動
    $_SESSION['form'] = $post;
    header('Location: confirm.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
  }
}

echo '代入値の確認';
echo '<pre>';
var_dump($error);
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>お問い合わせ | Contact</title>
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
  <!-- header -->
  <header id="header" class="header-wrap">
    <!-- logo -->
    <a href="index.html" class="site-title-header"><img src="./img/title-logo.svg" width="160px" alt="サイトタイトルロゴ"></a>
    <!-- ハンバーガーメニュー -->
    <div class="nav">
      <!-- 表示・非表示を切り替えるチェックボックス -->
      <input id="drawer_input" class="drawer_hidden" type="checkbox">
      <label for="drawer_input" class="drawer_open">
        <span></span>
      </label>
      <nav id="navi" class="nav-content">
        <ul id="page-link" class="nav-list">
          <li><a href="index.html#about">私について</a></li>
          <li><a href="index.html#skills">スキル</a></li>
          <li><a href="index.html#service">サービス</a></li>
          <li><a href="index.html#works">制作物・実績</a></li>
          <div class="contact-show">
            <li>お問い合わせ</li>
          </div>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <div class="section-title">
      <h2 class="en">Contact</h2>
      <p class="jp">お問い合わせ</p>
    </div>
    <div class="contact-wrap">
      <form action="" method="post" novalidate>
        <p class="contact-info">お問い合わせ内容をご入力の上、「確認画面へ」をクリックしてください。</p>
        <table class="contact-table">
          <tr>
            <th>名前 | Name<span class="required">必須 | Required</span></th>
            <td>
              <input size="20" type="text" class="wide" name="name" placeholder="ex).  山田太郎 / Taro Yamada" value="<?php echo htmlspecialchars($post['name']); ?>" />
              <!-- Notice: Undefined index の防止 -->
              <?php if (!empty($error['name'])) : ?>
                <?php if ($error['name'] === 'blank') : ?>
                  <p class="error_msg">※お名前をご記入下さい</p>
                <?php endif; ?>
                <?php if ($error['name'] === 'invaild') : ?>
                    <p class="error_msg">※お名前は50字以内で入力して下さい</p>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>メール | E-mail<span class="required">必須 | Required</span></th>
            <td>
              <input size="30" type="text" class="wide" name="email" placeholder="ex).  example@gmail.com    ※半角英数" value="<?php echo htmlspecialchars($post['email']); ?>" required />
              <?php if (!empty($error['email'])) : ?>
                <?php if ($error['email'] === 'blank') : ?>
                  <p class="error_msg">※メールアドレスをご記入下さい</p>
                <?php endif; ?>
                <?php if ($error['email'] === 'invaild') : ?>
                  <p class="error_msg">※メールアドレスが不正です</p>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>電話番号 | Phone<span class="any">任意 | Any</sapn></th>
            <td>
              <input size="30" type="text" class="wide" name="phone" placeholder="ex).  012-3456-7890   ※半角数字" value="<?php echo htmlspecialchars($post['phone']); ?>" />
              <?php if (!empty($error['phone'])) : ?>
                <?php if ($error['phone'] === 'invaild') : ?>
                  <p class="error_msg">※電話番号は半角数字をご記入下さい</p>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>お問い合わせ内容 | Message<br><br><span class="required last">必須 | Required</span></th>
            <td>
              <textarea name="message" cols="50" rows="5" placeholder="お見積もりは無料で承ります。まずはお気軽にお問い合わせくださいませ。" required><?php echo htmlspecialchars($post['message']); ?></textarea>
              <?php if (!empty($error['message'])) : ?>
                <?php if ($error['message'] === 'blank') : ?>
                  <p class="error_msg">※お問い合わせ内容をご記入下さい</p>
                <?php endif; ?>
                <?php if ($error['message'] === 'invaild') : ?>
                    <p class="error_msg">※５００字以内で入力して下さい</p>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
        </table>

        <div class="box_check">
          <label>
            <input type="checkbox" name="acceptance-714" value="1" aria-invalid="false" class="agree"><span class="check">プライバシーポリシーに同意する</span>
          </label>
        </div>
        <p class="confirm-btn">
          <span><input type="submit" name="confirm" value="確認画面へ" /></span>
        </p>
        <br>
        <br>

      </form>
    </div>
    <br>
    <br>
  </main>

  <footer id="footer" class="footer-wrap">
    <p id="page-top"><a href="#"><span>Page Top</span></a></p>
    <a href="index.html" class="site-logo-footer"><img src="./img/title-logo.svg" width="120px" alt="サイトタイトルロゴ"></a>
    <p class="copyright">&copy;2022 <span>Chacha WEB Create</span></p>
  </footer>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script src="./js/fadein.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>