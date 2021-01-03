<?php

session_start();
if(isset($_SESSION['user']) != "") {
  // ログイン済みの場合はリダイレクト
  header("Location: index.php");
}
// DBとの接続
include_once 'dbconnect.php';

// signupがPOSTされたときに下記を実行
if(isset($_POST['signup'])) {

  $username = $mysqli->real_escape_string($_POST['username']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $facluty = $mysqli->real_escape_string($_POST['facluty']);
  $facluty_detail = $mysqli->real_escape_string($_POST['facluty_detail']);
  $enter_year = $mysqli->real_escape_string($_POST['enter_year']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);

      // クエリの実行
      $query = "SELECT username FROM users";
      $result = $mysqli->query($query);

      while ($row = $result->fetch_assoc()){
        $old_username = $row['username'];

        if($old_username == $username){
          ?>
          <div class="alert alert-danger" role="alert">既に同じユーザー名で登録されています。別のユーザー名を入力してください。</div>
          <?php
          header("Location: error_username.html");
          exit;
        }
      }

      // クエリの実行
      $query = "SELECT email FROM users";
      $result = $mysqli->query($query);

      while ($row = $result->fetch_assoc()){
        $old_email = $row['email'];

        if($old_email == $email){
          ?>
          <div class="alert alert-danger" role="alert">既に同じメールアドレスで登録されています。別のユーザー名を入力してください。</div>
          <?php
          header("Location: error_email.html");
          exit;
        }
      }

      $final_time = date("Y/m/d - M (D) H:i:s");

  // POSTされた情報をDBに格納する
  $query = "INSERT INTO users(username,email,facluty,facluty_detail,enter_year,final_time,password) VALUES('$username','$email','$facluty','$facluty_detail','$enter_year','$final_time','$password')";

  if($mysqli->query($query)) {  ?>
    <div class="alert alert-success" role="alert">登録しました</div>
    <div class="success_login">ログインページは<a href="index.php">こちら</a></div>
    <?php
    header("Location: success_register.html");
    exit;
  } 
    
  else { ?>
    <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
    <?php
    header("Location: error.html");
    exit;
  }
}

?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<link rel="stylesheet" media="all" href="../css/style.css">
<link rel="stylesheet" media="all" href="css/login_form.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>新規会員登録｜広島市立大学 履修確認一覧サービス</title>
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

<div class="hcu_header2">
<a href="https://kazufolio.com/login/index.php"><img src="images/air_unit.png"></a>
  <a href="login.php" class="btn-gradient-3d-simple"><center><b>ログイン</b></center></a>
  <a href="register.php" class="btn-gradient-3d-orange"><center><b>新規登録</b></center></a>
</div>

</br></br></br></br></br></br></br></br></br></br>

<div id="box_login">

<div class="hcu">
<center>
<div class="login_contents">
<form method="post">
  <h1 class="sub_index">Air UNITに新規登録</h1>
  <div class="form-group">
  <h2>ユーザー名</h2>
    <input type="text" class="form-control" name="username" required />
  </div>
  </div>
</center>


<center>
<div class="login_contents">
<h2>入学年</h2>
</center>
<div class="cp_ipradio">
	<ul>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="enter_year" value="2017" checked>
		2017
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="enter_year" value="2018">
		2018
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="enter_year" value="2019">
    2019
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="enter_year" value="2020">
		2020
		</label>
		</li>
	</ul>
</div>

<center>
<div class="login_contents">
<h2>所属学部</h2>
</center>
<div class="cp_ipradio">
	<ul>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty" value="国際学部" checked>
		国際学部
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty" value="情報科学部">
    情報科学部
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty" value="芸術学部">
		芸術学部
		</label>
		</li>
	</ul>
</div>


<center>
<div class="login_contents">
<h2>所属学科・専攻</h2>
</center>
<div class="cp_ipradio">
	<ul>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="配属なし" checked>
		配属なし
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="情報工学科">
    情報工学科
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="知能工学科">
		知能工学科
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="システム工学科">
    システム工学科
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="医用情報科学科">
    医用情報科学科
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="日本画専攻">
    日本画専攻
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="油絵専攻">
    油絵専攻
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="彫刻専攻">
    彫刻専攻
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="facluty_detail" value="デザイン工芸学科">
    デザイン工芸学科
		</label>
		</li>
	</ul>
</div>


<center>
<form method="post" action="mail.php">
<div class="login_contents">
  <div class="form-group">
  <h2>メールアドレス</br></h2><p>※大学メールでの登録を推奨します。</p>
    <input type="email"  class="form-control" name="email" required />
  </div>
  <div class="form-group">
  <h2>パスワード</h2>
    <input type="password" class="form-control" name="password" min="5" required />
  </div>
  <button type="submit" class="btn btn-default" name="signup">新規会員登録</button>
</form>
</div>
</div>
</center>
</div>

</br></br></br></br></br></br></br></br></br></br></br></br></br></br>

</div>
</body>
<footer>
<div id="footer">
        <a href="https://twitter.com/kazumaaa14"><img src="../images/iconTw_fotter.png" class="sns_img"></a>
        <a href="https://www.instagram.com/kazumaaa14/?hl=ja"><img src="../images/iconInsta_footer.png" class="sns_img"></a>
        <p class="copylight">-  ©︎ 2020 Kazuma Omura  -</p>
        
<div>
</footer>
</html>