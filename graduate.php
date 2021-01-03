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

<!DOCTYPE HTML>
<html lang="ja">
<head>
<link rel="stylesheet" media="all" href="../css/style.css">
<link rel="stylesheet" media="all" href="css/login_form.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>履修可能科目一覧｜広島市立大学 履修確認一覧サービス</title>
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

<div class="hcu_main">
<center>
<div class="login_contents">
<form method="post">
  <!-- <h1>PROFILE</h1>
  <h2 class="sub_index">プロフィール</h2> -->

<!-- 総合共通科目の出力 - 2020 -->
<?php
if($facluty=="国際学部" && $enter_year == "2020"){
  $query = "SELECT * FROM graduate_international_2020";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['広島・地域志向科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['初年次演習科目'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
    <tr>
    <th class="subject">広島・地域志向科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">初年次演習科目</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">14単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">30単位以上</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">93単位以上</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2020"){
  $query = "SELECT * FROM graduate_information_2020";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['広島・地域志向科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['初年次演習科目'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
    <tr>
    <th class="subject">広島・地域志向科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">初年次演習科目</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">16単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">33単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">95単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2020"){
  $query = "SELECT * FROM graduate_art_2020";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['広島・地域志向科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['初年次演習科目'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
    <tr>
    <th class="subject">広島・地域志向科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">初年次演習科目</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">18単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">30単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">98単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>






<!--  総合共通科目の出力 - 2019　-->
<?php
if($facluty=="国際学部" && $enter_year == "2019"){
  $query = "SELECT * FROM graduate_international_2019";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">15単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">31単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">93単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2019"){
  $query = "SELECT * FROM graduate_information_2019";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">18単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">33単位</td>
    </tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">93単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2019"){
  $query = "SELECT * FROM graduate_art_2019";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">18単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">30単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">98単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>










<!--  総合共通科目の出力 - 2018　-->
<?php
if($facluty=="国際学部" && $enter_year == "2018"){
  $query = "SELECT * FROM graduate_international_2018";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">15単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">31単位以上</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">93単位以上</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2018"){
  $query = "SELECT * FROM graduate_information_2018";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">18単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">33単位</td>
    </tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">96単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2018"){
  $query = "SELECT * FROM graduate_art_2018";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">18単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">30単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">98単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>



<!--  総合共通科目の出力 - 2017　-->
<?php
if($facluty=="国際学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_international_2017";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">16単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">32単位以上</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">94単位以上</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_information_2017";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">18単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">33単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">96単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_art_2017";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <th class="subject">総合共通科目小計</th>
      <td class="subject">19単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
      <td class="subject">30単位</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">計</th>
      <td class="subject">98単位</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_art_2017";
  $result = $mysqli->query($query);
?>
<h2>卒業必要単位数</h2>
  
<?php
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $a = $row['総合科目'];
  $o = $row['広島科目'];
  $b = $row['平和科目'];
  $c = $row['共通A'];
  $d = $row['共通B'];
  $e = $row['共通C'];
  $f = $row['基礎演習'];
  $g = $row['キャリア形成'];
  $h = $row['一般情報処理科目'];
  $i = $row['保健体育科目'];
  $j = $row['外国語系科目'];
  $k = $row['専門基礎科目'];
  $l = $row['専門科目'];
  $m = $row['卒業必要単位数'];
  ?>

<table border="1">
<tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $a; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $o; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $b; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $c; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $d; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $e; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">基礎演習</th>
      <td class="subject"><?php echo $f; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $g; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $h; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $i; ?>単位</td>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $j; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $k; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $l; ?>単位以上</td>
    </tr>
    <tr>
    <th class="subject">卒業必要単位数</th>
      <td class="subject"><?php echo $m; ?>単位</td>
    </tr>
    
  </table>
<?php
}
}
?>
<?php
// データベースの切断
$result->close();
?>
</div>
</div>

<div class="hcu_side">
  <div class="airunit_service">
  <h4>各種サービス</h4>
  <ul>
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
</div>

</br></br></br></br></br></br></br></br></br>

<div id="footer">
        <a href="https://twitter.com/kazumaaa14"><img src="../images/iconTw_fotter.png" class="sns_img"></a>
        <a href="https://www.instagram.com/kazumaaa14/?hl=ja"><img src="../images/iconInsta_footer.png" class="sns_img"></a>
        <p class="copylight">-  ©︎ 2020 Kazuma Omura  -</p>
</div>
</div>
</body>
</html>
