<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
  header("Location: index.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);

if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $id = $row['id'];
  $username = $row['username'];
  $email = $row['email'];
  $enter_year = $row['enter_year'];
  $facluty = $row['facluty'];
  $facluty_detail = $row['facluty_detail'];
}

$final_time = date("Y/m/d - M (D) H:i:s");

// UPDATEのSQL作成
$sql = "UPDATE users SET final_time = '$new_username' WHERE id = '$id'";

// SQL実行
$res = $mysqli->query($sql);

// テーブルを作成するSQLを作成
$sqli = 'CREATE TABLE IF NOT EXISTS '.$username.'(
	id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	subject_name VARCHAR(255),
	subject_type VARCHAR(255),
	subject_number INT(255),
  unit_type VARCHAR(255),
  evaluation VARCHAR(255)
) engine=innodb default charset=utf8';

// SQL実行
$res = $mysqli->query($sqli);

$username_timetable = $username;
$username_timetable .= "timetable";

// テーブルを作成するSQLを作成
$sqli = 'CREATE TABLE IF NOT EXISTS '.$username_timetable.'(
	id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	subject_name VARCHAR(255),
	subject_type VARCHAR(255),
	subject_number INT(255),
  unit_type VARCHAR(255),
  timetable_num INT(255),
  subject_year INT(255),
  evaluation VARCHAR(255)
) engine=innodb default charset=utf8';

// SQL実行
$res = $mysqli->query($sqli);

// データベースの切断
$result->close();
?>







<!DOCTYPE HTML>
<html lang="ja">
<head>
<link rel="stylesheet" media="all" href="../css/style.css">
<link rel="stylesheet" media="all" href="css/login_form.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>マイページ｜広島市立大学 履修確認一覧サービス</title>

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
<a href="https://kazufolio.com/airunit/index.php"><img src="images/air_unit.png"></a>
  <a href="logout.php?logout" class="btn-gradient-3d-simple"><center><b>ログアウト</b></center></a>
  <a href="home.php" class="btn-gradient-3d-orange"><center><b>ホーム</b></center></a>
</div>
<div class="login_information">
<div class="hcu_header_left">
<p><?php echo $username; ?>さん（<?php echo $facluty; ?><?php echo $facluty_detail; ?>）</p>
</div>
</div>
<div class="phone_area">
</br></br></br></br>
</div>
</br></br></br></br></br></br>




<center>
<div class="login_contents">
<form method="post">
  <!-- <h1>PROFILE</h1>
  <h2 class="sub_index">プロフィール</h2> -->
</center>

<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
  header("Location: index.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);

$result = $mysqli->query($query);
if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $username = $row['username'];
  $email = $row['email'];
  $enter_year = $row['enter_year'];
  $facluty = $row['facluty'];
  $facluty_detail = $row['facluty_detail'];
}
  // データベースの切断
$result->close();
?>

<div class="hcu_main">
  <div class="news_unit">
<h4>運営からのお知らせ</h4>
<img src="images/hcu4.png"><a href="news/01.php">本サービスについて</a></br>
<img src="images/hcu4.png"><a href="news/02.php">単位数自動計算サービスの追加について - 2020/6/10</a></br>
<img src="images/hcu4.png"><a href="news/03.php">教科検索機能追加のお知らせ - 2020/8/21</a></br>
<img src="images/hcu4.png"><a href="news/04.php">GPA計算機能追加のお知らせ - 2020/9/17</a></br>
<img src="images/hcu4.png"><a href="news/05.php">全ユーザ参加可能型チャットページ追加のお知らせ - 2020/9/17</a>
</div>
</div>

<div class="hcu_side">
  <div class="airunit_service">
  <h4>各種サービス</h4>
  <ul>
  <li><img src="images/hcu5.png"><a href="chat.php">ユーザーチャット</a></li>
    <li><img src="images/hcu5.png"><a href="subject_select.php">履修可能科目</a></li>
    <li><img src="images/hcu5.png"><a href="insert_subject.php">履修済科目</a></li>
    <li><img src="images/hcu5.png"><a href="graduate.php">卒業要件</a></li>
    <li><img src="images/hcu5.png"><a href="timetable_index.php">時間割</a></li>
    <li><img src="images/hcu5.png"><a href="updata.php">情報登録・変更</a></li>
  </ul>
  </div>
  </div>

  <div class="hcu_side">
  <div class="hcu_page">
  <h4>広島市立大学公式ページ</h4>
  <ul>
    <li><img src="images/hcu5.png"><a href="https://www.hiroshima-cu.ac.jp">広島市立大学</a></li>
    <li><img src="images/hcu5.png"><a href="https://www.hiroshima-cu.ac.jp/peace_j/">広島平和研究所</a></li>
    <li><img src="images/hcu5.png"><a href="https://www.lib.hiroshima-cu.ac.jp">附属図書館</a></li>
    <li><img src="images/hcu5.png"><a href="http://call.lang.hiroshima-cu.ac.jp/lang/">語学センター</a></li>
    <li><img src="images/hcu5.png"><a href="http://www.ipc.hiroshima-cu.ac.jp">情報処理センター</a></li>
    <li><img src="images/hcu5.png"><a href="http://museum.hiroshima-cu.ac.jp/index.cgi/ja?page=Home">芸術資料館</a></li>
    <li><img src="images/hcu5.png"><a href="https://www.hiroshima-cu.ac.jp/facility/content0006/">社会連携センター</a></li>
    <li><img src="images/hcu5.png"><a href="http://rsw.office.hiroshima-cu.ac.jp/OpenSyllabus/">シラバス</a></li>
  </ul>
  </div>
  </div>

  <div class="hcu_side">
  <div class="hcu_page2">
  <h4>学習システム</h4>
  <ul>
    <li><img src="images/hcu5.png"><a href="https://ichipol.hiroshima-cu.ac.jp/uniprove_pt/UnLoginAction">いちぽる</a></li>
    <li><img src="images/hcu5.png"><a href="https://webclass.ipc.hiroshima-cu.ac.jp/">WebClass</a></li>
    <li><img src="images/hcu5.png"><a href="https://www.hiroshima-cu.ac.jp/lang/private/gakunai/intensive/intensive.htm">e-learning・CALL</a></li>
    <li><img src="images/hcu5.png"><a href="http://rsw.office.hiroshima-cu.ac.jp/OpenSyllabus/">シラバス</a></li>
  </ul>
  </div>

</div>

</br></br></br></br></br></br></br></br></br>

<div id="footer">
        <a href="https://twitter.com/kazumaaa14"><img src="../images/iconTw_fotter.png" class="sns_img"></a>
        <a href="https://www.instagram.com/kazumaaa14/?hl=ja"><img src="../images/iconInsta_footer.png" class="sns_img"></a>
        <p class="copylight">-  ©︎ 2020 Kazuma Omura  -</p>
        
<div>
</body>
</html>
