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


if(isset($_POST['insert'])){
  ////テーブルデータ全削除
  $username_timetable = $username;
  $username_timetable .= "timetable";

  // テーブルデータの全削除のSQL作成
  $sql = "DELETE FROM $username_timetable WHERE subject_year = 20181";

  // SQL実行
  $res = $mysqli->query($sql);
  // var_dump($res);


  ////テーブルデータ挿入
  $timetable = filter_input(INPUT_POST, 'timeunit', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

  for ($i = 0; $i < count($_POST["timeunit"]); $i++){

    // 変数代入 //
    $new_subject_name= $_POST["timeunit"][$i];

    $d = preg_split("/,/",$new_subject_name); 

    // UPDATEのSQL作成
    $sql = "INSERT INTO $username_timetable (subject_name, subject_type, subject_number, unit_type, timetable_num, subject_year) VALUES ('$d[0]', '$d[1]', '$d[2]', '$d[3]', '$d[4]', '$d[5]')";

    // SQL実行
    $res = $mysqli->query($sql);
    // var_dump($res);
  }



$evaluation[] = filter_input(INPUT_POST, 'evaluation', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
// var_dump($riyu);
  
for ($i = 0; $i < count($_POST["evaluation"]); $i++){
  
  // 変数代入 //
  $new_evaluation= $_POST["evaluation"][$i];
  
  $e = preg_split("/,/",$new_evaluation); 
  
  // UPDATEのSQL作成
  $sql = "UPDATE $username_timetable SET evaluation = '$e[1]' WHERE timetable_num = '$e[0]' AND subject_year = '$e[2]'";
  
  // SQL実行
  $res = $mysqli->query($sql);
  var_dump($res);
  
}

// データベースの切断
$result->close();
  header("Location: timetable-20181_all.php");

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
<h2>2020年-前期 時間割</h2>
<form method="post">
<table border="1">
    <tr>
      <th class="subject"></th>
      <th class="subject">月曜日</th>
      <th class="subject">火曜日</th>
      <th class="subject">水曜日</th>
      <th class="subject">木曜日</th>
      <th class="subject">金曜日</th>
      <th class="subject">土曜日</th>
    </tr>





    <?php
  $time_num_2 = 1;
?>


    <form method="post">
    <?php
for($time_num = 1; $time_num < 7; $time_num++){
?>

    <tr>
    <th class="subject"><?php echo $time_num; ?>限</th>
    <?php
for($i = 1; $i < 7; $i++){
?>
    <td>
    <select name="timeunit[]" style="width: 50px">
    <option class="subject" value=", NULL, NULL, NULL, <?php echo $i; ?><?php echo $time_num; ?>, 20181"></option>














    <?php
if($facluty=="国際学部" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_international_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>
  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM international_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="配属なし" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_information_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="情報工学科" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_information_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_enginnering_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="知能工学科" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_information_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_intelligence_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="システム工学科" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_information_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_system_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="医用情報科学科" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_information_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_medical_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_art_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="日本画専攻" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_art_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_japanese_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="油絵専攻" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_art_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_oil_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="彫刻専攻" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_art_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_sculpture_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="デザイン工学科" && $enter_year == "2017"){

$query = "SELECT * FROM basic_subject_art_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_design_subject_2017";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>




<?php
if($facluty=="国際学部" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_international_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM international_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="配属なし" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_information_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="情報工学科" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_information_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_enginnering_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="知能工学科" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_information_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_intelligence_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="システム工学科" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_information_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_system_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="医用情報科学科" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_information_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_medical_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_art_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="日本画専攻" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_art_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_japanese_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="油絵専攻" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_art_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_oil_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="彫刻専攻" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_art_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_sculpture_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="デザイン工学科" && $enter_year == "2018"){

$query = "SELECT * FROM basic_subject_art_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_design_subject_2018";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>



<?php
if($facluty=="国際学部" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_international_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM international_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="配属なし" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_information_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="情報工学科" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_information_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_enginnering_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="知能工学科" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_information_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_intelligence_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="システム工学科" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_information_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_system_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="医用情報科学科" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_information_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_medical_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_art_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="日本画専攻" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_art_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_japanese_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="油絵専攻" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_art_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_oil_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="彫刻専攻" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_art_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_sculpture_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="デザイン工学科" && $enter_year == "2019"){

$query = "SELECT * FROM basic_subject_art_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_design_subject_2019";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>



<?php
if($facluty=="国際学部" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_international_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM international_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="配属なし" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_information_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="情報工学科" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_information_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_enginnering_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="知能工学科" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_information_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_intelligence_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="システム工学科" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_information_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_system_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="情報科学部" && $facluty_detail=="医用情報科学科" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_information_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM information_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM information_medical_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_art_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="日本画専攻" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_art_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_japanese_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="油絵専攻" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_art_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_oil_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="彫刻専攻" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_art_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_sculpture_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>











<?php
if($facluty=="芸術学部" && $facluty_detail=="デザイン工学科" && $enter_year == "2020"){

$query = "SELECT * FROM basic_subject_art_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

  <?php
}
?>
</p>

<?php

$query = "SELECT * FROM art_basic_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}


$query = "SELECT * FROM art_design_subject_2020";
$result = $mysqli->query($query);

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  ?>

  <option class="subject" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo $i; ?><?php echo $time_num; ?>, 20181"><?php echo $subject_name; ?></option>

<?php
}
}
?>














































































</select>
</td>

<?php
}
?>
</tr>



    <tr>
    <th class="subject">評定</th>
    <?php
for($n = 1; $n < 7; $n++){
?>
<td>
<select name='evaluation[]'>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '未選択'; ?>, 20181" <?php echo "$selected00" ?>></option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '複数科目'; ?>, 20181" <?php echo "$selected00" ?>>同名称科目</option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '秀'; ?>, 20181" <?php echo "$selected01" ?>>秀</option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '優'; ?>, 20181" <?php echo "$selected02" ?>>優</option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '良'; ?>, 20181" <?php echo "$selected03" ?>>良</option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '可'; ?>, 20181" <?php echo "$selected04" ?>>可</option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '不可'; ?>, 20181" <?php echo "$selected05" ?>>不可</option>
  <option value="<?php echo $n; ?><?php echo $time_num_2; ?>, <?php echo '*不可'; ?>, 20181" <?php echo "$selected06" ?>>*不可</option>
  </select>
  </td>
  

<?php
}
?>

</tr>



<?php
$time_num_2++;
}
?>
</form>
</table>
<p>※実験・ターム科目の場合は評価欄で「複数科目」を設定してください。</p></br>
<p>(例) 実験が3時間分ある場合→3限実験:秀・4限実験:複数科目・5限実験:複数科目</p></br>
<button type="submit" class="btn btn-default" name="insert" value="1">追加する</button></br>

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
