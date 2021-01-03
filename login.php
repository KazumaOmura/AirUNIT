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
<header>
            <div class="pc_area">
                    <nav class="menu">
                            <!-- <img src="image/header_logo.png" class="header_logo"> -->
                        <ul class="menu_list">
                            <li><a href="https://kazufolio.com">Home</a></li>
                            <li><a href="#profile">About</a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="https://kazufolio.com/blog/">Blog</a></li>
                            <li><a href="https://www.instagram.com/kazumaaa14/?hl=ja" target="_blank">Photo</a></li>
                            <!-- <li><a href="works.html"><img src ="images/works.png" class="index_smallphoto">Works</a></li> -->
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            
                <div class="phone_area">
                        <div id="nav-drawer">
                                <input id="nav-input" type="checkbox" class="nav-unshown">
                                <label id="nav-open" for="nav-input"><span></span></label>
                                <label class="nav-unshown" id="nav-close" for="nav-input"></label>
                                <div id="nav-content">
                                    <ul class="menu_list_phone">
                                        <li><a href="https://kazufolio.com">Home</a></li>
                                        <li><a href="#profile">About</a></li>
                                        <li><a href="#portfolio">Portfolio</a></li>
                                        <li><a href="https://kazufolio.com/blog/">Blog</a></li>
                                        <li><a href="https://www.instagram.com/kazumaaa14/?hl=ja" target="_blank">Photo</a></li>
                                        <!-- <li><a href="works.html"><img src ="images/works.png" class="index_smallphoto">Works</a></li> -->
                                        <li><a href="#contact">Contact</a></li>
                                    </ul>
                                </div>
                        </div>
                </div>
    
    
    <script src="js/fixed.js"></script>
    <script src="js/show.js"></script>
    </header>

<div class="hcu_main_index">
<center>
<div class="login_contents">
<form method="post">
  <h1 class="sub_index"><b>Air UNITにログイン<b></h1>
  <div class="form-group">
    <h2>メールアドレス</h2>
    <input type="email"  class="form-control" name="email" required />
  </div>
  <div class="form-group">
    <h2>パスワード</h2>
    <input type="password" class="form-control" name="password" required />
  </div>
  <button type="submit" class="btn btn-default" name="login">ログイン</button></br>
</form>
</div>
</center>
</div>

</br></br></br></br></br></br></br></br></br>

</body>
<footer>
<div id="footer">
        <a href="https://twitter.com/kazumaaa14"><img src="../images/iconTw_fotter.png" class="sns_img"></a>
        <a href="https://www.instagram.com/kazumaaa14/?hl=ja"><img src="../images/iconInsta_footer.png" class="sns_img"></a>
        <p class="copylight">-  ©︎ 2020 Kazuma Omura  -</p>
        
<div>
</footer>
</html>