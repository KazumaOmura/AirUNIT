<?php

ob_start();
session_start();
if( isset($_SESSION['user']) != "") {
  header("Location: home.php");
}
include_once 'dbconnect.php';

// ログインボタンがクリックされたときに下記を実行
if(isset($_POST['login'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
  
    // クエリの実行
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $mysqli->query($query);
    if (!$result) {
      print('クエリーが失敗しました。' . $mysqli->error);
      $mysqli->close();
      exit();
    }
  
    // パスワード(暗号化済み）とユーザーIDの取り出し
    while ($row = $result->fetch_assoc()) {
      $db_hashed_pwd = $row['password'];
      $id = $row['id'];
    }
  
    // データベースの切断
    $result->close();
  
    // ハッシュ化されたパスワードがマッチするかどうかを確認
    if (password_verify($password, $db_hashed_pwd)) {
      $_SESSION['user'] = $id;
      header("Location: home.php");
      exit;
    } else { ?>
      <div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
    <?php }
  }
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<link rel="stylesheet" media="all" href="../css/style.css">
<link rel="stylesheet" media="all" href="css/login_form.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>広島市立大学 履修確認一覧サービス</title>
<link rel="stylesheet" href="style.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>

<div class="hcu_header">
<div class="hcu_header_left">
<p>広島市立大学単位確認サービス</p>
</div>
<div class="pc_area">
<div class="hcu_header_right">
<p>日常のひと手間をラクにするサービス</p>
</div>
</div>
</div>

<header>
<nav class="hhh">
<div class="hcu_header2">
  <a href="https://kazufolio.com/login/index.php"><img src="images/air_unit.png"></a>
  <a href="login.php" class="btn-gradient-3d-simple"><center><b>ログイン</b></center></a>
  <a href="register.php" class="btn-gradient-3d-orange"><center><b>新規登録</b></center></a>
</div>
</nav>
</header>

<script src="../js/aaa.js"></script>

<div class="hcu_header3">
  <img src="images/hcu_header.png">
</div>

<div class="hcu_main_index">
<center>
<h2 class="hcu_main_h2"><b>サービス内容</b></h2>
<p class="hcu_main_p">Air UNITは広島市立大学の学生向けに開発されたサービスです。</br>
大学生活を送る中で不便に感じた単位システムについて解決します。</p>
  <div class="hcu_main_detail1">
  <img src="images/hcu1.png">
  <h2 class="hcu_main_detail_h2">履修可能講義</h2>
  <p class="hcu_main_detail_p">学部・学科・専攻に加えて入学年度によってそれぞれ履修できる講義は異なります。
  大学の公式HPでは学生HANDBOOKで確認しますが、このサービスでは登録情報に応じて講義を一覧で表示します。</p>
  </div>
  <div class="hcu_main_detail2">
  <img src="images/hcu2.png">
  <h2 class="hcu_main_detail_h2">履修講義登録</h2>
  <p class="hcu_main_detail_p">これまで履修した講義を登録できます。いちぽるにログインすることなく今現在の履修状況を確認することができます。</p>
  </div>
  <div class="hcu_main_detail3">
  <img src="images/hcu3.png">
  <h2 class="hcu_main_detail_h2">卒業単位確認</h2>
  <p class="hcu_main_detail_p">今現在の履修状況を科目種類別に単位数を計算して一覧で確認できます。
    これによって種類別の単位数の計算が簡単になります。</p>
  </div>
</cetner>
</div>

</br>

<div id="footer">
        <a href="https://twitter.com/kazumaaa14"><img src="../images/iconTw_fotter.png" class="sns_img"></a>
        <a href="https://www.instagram.com/kazumaaa14/?hl=ja"><img src="../images/iconInsta_footer.png" class="sns_img"></a>
        <p class="copylight">-  ©︎ 2020 Kazuma Omura  -</p>
        
<div>

</div>
</body>
</html>