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
  $id = $row['id'];
  $username = $row['username'];
  $email = $row['email'];
  $facluty = $row['facluty'];
  $facluty_detail = $row['facluty_detail'];
  $enter_year = $row['enter_year'];
}

if(isset($_POST['insert_evaluation'])){

$evaluation[] = filter_input(INPUT_POST, 'evaluation', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
// var_dump($riyu);

for ($i = 0; $i < count($_POST["evaluation"]); $i++){

  // 変数代入 //
  $new_evaluation= $_POST["evaluation"][$i];

  $d = preg_split("/,/",$new_evaluation); 

  // UPDATEのSQL作成
  $username_timetable = $username;
  $username_timetable .= "timetable";
  $sql = "UPDATE $username_timetable SET evaluation = '$d[4]' WHERE subject_name = '$d[0]' AND subject_year = '$d[5]'";

  // SQL実行
  $res = $mysqli->query($sql);

  // var_dump($res);

  // ユーザーIDからユーザー名を取り出す
$select_unit_type = "NULL";

$query = "SELECT * FROM $username_timetable WHERE unit_type != $select_unit_type AND subject_name = subject_name AND subject_year = subject_year";
$result = $mysqli->query($query);
}

header("Location: insert_subject.php");
}

// データベースの切断
$result->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>履修済科目追加｜広島市立大学 履修確認一覧サービス</title>
<link rel="stylesheet" media="all" href="../css/style.css">
<link rel="stylesheet" media="all" href="css/login_form.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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















<div class="pc_area">
<div class="hcu_main">

<h1>科目評価情報を追加</h1> 
<?php
  $username_timetable = $username;
  $username_timetable .= "timetable";
  
    $query = "SELECT * FROM $username_timetable WHERE NOT subject_number = 0";
  $result = $mysqli->query($query);
?>

  <div class="scroll">
  <table border="1">
    <tr>
      <th class="subject">科目名</th>
      <th class="subject">科目種類</th>
      <th class="subject">単位数</th>
      <th class="subject">単位種類</th>
      <th class="subject">履修年数</th>
      <th class="subject">評価</th>
    </tr>
    </div>
<?php
// 全ての単位を満たす判定変数の初期化
$unit_all_clear = 1;

// 取得単位数情報の取り出し
if($enter_year == "2020"){
$sougou = ' 広島・地域志向科目';
$heiwa = " 平和科目";
$kyoutuuA = " 共通A";
$kyoutuuB = " 共通B";
$kyoutuuC = " 共通C";
$ensyuukamoku = " 初年度演習科目";
$kyaria = " キャリア形成・実践科目";
$ippanzyouhou = " 一般情報処理科目";
$hokenn = " 保健体育科目";
$gaikokugo = " 外国語系科目";
$sennmonnkiso = " 専門基礎科目";
$sennmonn = " 専門科目";

$sougou_num = 0;
$heiwa_num = 0;
$kyoutuuA_num = 0;
$kyoutuuB_num = 0;
$kyoutuuC_num = 0;
$ensyuukamoku_num = 0;
$kyaria_num = 0;
$ippanzyouhou_num = 0;
$hokenn_num = 0;
$gaikokugo_num = 0;
$sennmonnkiso_num = 0;
$sennmonn_num = 0;
$sougou_all = 0;
$kyoutuu_all = 0;
$all = 0;
$graduate_all = 0;


while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  $subject_year = $row['subject_year'];
  $already_evaluation = $row['evaluation'];

  unset($selected00);
  unset($selected01);
  unset($selected02);
  unset($selected03);
  unset($selected04);
  unset($selected05);
  unset($selected06);

  switch($already_evaluation){
    case "":
            $selected00 = 'selected';
            break;
    case " 秀":
            $selected01 = 'selected';
            break;
    case " 優":
            $selected02 = 'selected';
            break;
    case " 良":
            $selected03 = 'selected';
            break;
    case " 可":
            $selected04 = 'selected';
            break;
    case " 不可":
            $selected05 = 'selected';
            break;
    case " *不可":
          $selected06 = 'selected';
    break;
    }

if($subject_type == $sougou){
  $sougou_num = $sougou_num + $subject_number;
}
if($subject_type == $heiwa){
  $heiwa_num = $heiwa_num + $subject_number;
}
if($subject_type == $kyoutuuA){
  $kyoutuuA_num = $kyoutuuA_num + $subject_number;
}
if($subject_type == $kyoutuuB){
  $kyoutuuB_num = $kyoutuuB_num + $subject_number;
}
if($subject_type == $$kyoutuuC){
  $kyoutuuC_num = $kyoutuuC_num + $subject_number;
}
if($subject_type == $ensyuukamoku){
  $ensyuukamoku_num = $ensyuukamoku_num + $subject_number;
}
if($subject_type == $hokenn){
  $hokenn_num = $hokenn_num + $subject_number;
}
if($subject_type == $gaikokugo){
  $gaikokugo_num = $gaikokugo_num + $subject_number;
}
if($subject_type == $sennmonnkiso){
  $sennmonnkiso_num = $sennmonnkiso_num + $subject_number;
}
if($subject_type == $sennmonn){
  $sennmonn_num = $sennmonn_num + $subject_number;
}

//合計単位数の変数初期化
$sougou_all = $sougou_num + $heiwa_num + $kyoutuuA_num + $kyoutuuB_num + $kyoutuuC_num + $ensyuukamoku_num + $kyaria_num ;
$kyoutuu_all = $sougou_all + $ippanzyouhou_num + $hokenn_num + $gaikokugo_num;
$all = $sennmonnkiso_num + $sennmonn_num;
$graduate_all = $kyoutuu_all + $all;

  ?>

    <tr>
      <td class="subject"><?php echo $subject_name; ?></td>
      <td class="subject"><?php echo $subject_type; ?></td>
      <td class="subject"><?php echo $subject_number; ?></td>
      <td class="subject"><?php echo $unit_type; ?></td>

      <?php

switch($subject_year){
    case 20201:
            $subject_year_personal = '2020年 - 前期';
            break;
    case 20202:
    $subject_year_personal = '2020年 - 後期';
            break;
    case 20191:
    $subject_year_personal = '2019年 - 前期';
            break;
    case 20192:
    $subject_year_personal = '2019年 - 後期';
            break;
    case 20181:
    $subject_year_personal = '2018年 - 前期';
            break;
    case 20182:
    $subject_year_personal = '2018年 - 後期';
            break;
    case 20171:
    $subject_year_personal = '2017年 - 前期';
    break;
    case 20172:
    $subject_year_personal = '2017年 - 後期';
    break;
    case 20161:
    $subject_year_personal = '2016年 - 前期';
    break;
    case 20162:
    $subject_year_personal = '2016年 - 後期';
    break;
    }
?>

      <td class="subject"><?php echo $subject_year_personal; ?></td>
      <td class="subject">
      <form method="post">
  <select name='evaluation[]'>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '未選択'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected00" ?>>未選択</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '秀'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected01" ?>>秀</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '優'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected02" ?>>優</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '良'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected03" ?>>良</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected04" ?>>可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected05" ?>>不可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '*不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected06" ?>>*不可</option>
  </select>
  </td>
  </tr>
<?php
}
?>
</br>
<button type="submit" class="btn btn-default" name="insert_evaluation">変更する</button>
</br>
</form>
<?php
}
?>


<?php
// 取得単位数情報の取り出し

if($enter_year == "2019" || $enter_year == "2018" || $enter_year == "2017"){
$sougou = ' 総合科目';
$hiroshima = ' 広島科目';
$heiwa = " 平和科目";
$kyoutuuA = " 共通A";
$kyoutuuB = " 共通B";
$kyoutuuC = " 共通C";
$ensyuukamoku = " 演習科目";
$kyaria = " キャリア形成";
$ippanzyouhou = " 一般情報処理科目";
$hokenn = " 保健体育科目";
$gaikokugo = " 外国語系科目";
$sennmonnkiso = " 専門基礎科目";
$sennmonn = " 専門科目";

$sougou_num = 0;
$hiroshima_num = 0;
$heiwa_num = 0;
$kyoutuuA_num = 0;
$kyoutuuB_num = 0;
$kyoutuuC_num = 0;
$ensyuukamoku_num = 0;
$kyaria_num = 0;
$ippanzyouhou_num = 0;
$hokenn_num = 0;
$gaikokugo_num = 0;
$sennmonnkiso_num = 0;
$sennmonn_num = 0;
$sougou_all = 0;
$kyoutuu_all = 0;
$all = 0;
$graduate_all = 0;

while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  $subject_year = $row['subject_year'];
  $already_evaluation = $row['evaluation'];

  unset($selected00);
  unset($selected01);
  unset($selected02);
  unset($selected03);
  unset($selected04);
  unset($selected05);
  unset($selected06);

  switch($already_evaluation){
    case "":
            $selected00 = 'selected';
            break;
    case " 秀":
            $selected01 = 'selected';
            break;
    case " 優":
            $selected02 = 'selected';
            break;
    case " 良":
            $selected03 = 'selected';
            break;
    case " 可":
            $selected04 = 'selected';
            break;
    case " 不可":
            $selected05 = 'selected';
            break;
    case " *不可":
            $selected06 = 'selected';
    break;
    }

  if($subject_type == $sougou){
    $sougou_num = $sougou_num + $subject_number;
  }
  if($subject_type == $hiroshima){
    $hiroshima_num = $hiroshima_num + $subject_number;
  }
  if($subject_type == $heiwa){
    $heiwa_num = $heiwa_num + $subject_number;
  }
  if($subject_type == $kyoutuuA){
    $kyoutuuA_num = $kyoutuuA_num + $subject_number;
  }
  if($subject_type == $kyoutuuB){
    $kyoutuuB_num = $kyoutuuB_num + $subject_number;
  }
  if($subject_type == $kyoutuuC){
    $kyoutuuC_num = $kyoutuuC_num + $subject_number;
  }
  if($subject_type == $ensyuukamoku){
    $ensyuukamoku_num = $ensyuukamoku_num + $subject_number;
  }
  if($subject_type == $hokenn){
    $hokenn_num = $hokenn_num + $subject_number;
  }
  if($subject_type == $ippanzyouhou){
    $ippanzyouhou_num = $ippanzyouhou_num + $subject_number;
  }
  if($subject_type == $gaikokugo){
    $gaikokugo_num = $gaikokugo_num + $subject_number;
  }
  if($subject_type == $sennmonnkiso){
    $sennmonnkiso_num = $sennmonnkiso_num + $subject_number;
  }
  if($subject_type == $sennmonn){
    $sennmonn_num = $sennmonn_num + $subject_number;
  }

  //合計単位数の変数初期化
$sougou_all = $sougou_num + $hiroshima_num + $heiwa_num + $kyoutuuA_num + $kyoutuuB_num + $kyoutuuC_num + $ensyuukamoku_num + $kyaria_num ;
$kyoutuu_all = $sougou_all + $ippanzyouhou_num + $hokenn_num + $gaikokugo_num;
$all = $sennmonnkiso_num + $sennmonn_num;
$graduate_all = $kyoutuu_all + $all;

  ?>

    <tr>
      <td class="subject"><?php echo $subject_name; ?></td>
      <td class="subject"><?php echo $subject_type; ?></td>
      <td class="subject"><?php echo $subject_number; ?></td>
      <td class="subject"><?php echo $unit_type; ?></td>
      <?php
switch($subject_year){
    case 20201:
            $subject_year_personal = '2020年 - 前期';
            break;
    case 20202:
    $subject_year_personal = '2020年 - 後期';
            break;
    case 20191:
    $subject_year_personal = '2019年 - 前期';
            break;
    case 20192:
    $subject_year_personal = '2019年 - 後期';
            break;
    case 20181:
    $subject_year_personal = '2018年 - 前期';
            break;
    case 20182:
    $subject_year_personal = '2018年 - 後期';
            break;
    case 20171:
    $subject_year_personal = '2017年 - 前期';
    break;
    case 20172:
    $subject_year_personal = '2017年 - 後期';
    break;
    case 20161:
    $subject_year_personal = '2016年 - 前期';
    break;
    case 20162:
    $subject_year_personal = '2016年 - 後期';
    break;
    }
?>

      <td class="subject"><?php echo $subject_year_personal; ?></td>
      <td class="subject">
      <form method="post">
  <select name='evaluation[]'>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo ''; ?>, <?php echo $subject_year; ?>" <?php echo "$selected00" ?>>未選択</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '秀'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected01" ?>>秀</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '優'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected02" ?>>優</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '良'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected03" ?>>良</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected04" ?>>可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected05" ?>>不可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '*不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected06" ?>>*不可</option>
  </select>
  </td>
  </tr>
<?php
}
?>
</table>
</div>
</br>
<button type="submit" class="btn btn-default" name="insert_evaluation">変更する</button>
</br>
  </div>
</form>
<?php
}
?>


<?php
// データベースの切断
$result->close();
?>

</div>
</div>



































<div class="phone_area">
<div class="hcu_main">

<h1>科目評価情報を追加</h1> 
<?php
  $username_timetable = $username;
  $username_timetable .= "timetable";
  
    $query = "SELECT * FROM $username_timetable WHERE NOT subject_number = 0";
  $result = $mysqli->query($query);
?>

  <div class="scroll">
  <table border="1">
    <tr>
      <th class="subject">科目名</th>
      <th class="subject">履修年数</th>
      <th class="subject">評価</th>
    </tr>
    </div>
<?php
// 全ての単位を満たす判定変数の初期化
$unit_all_clear = 1;

// 取得単位数情報の取り出し
if($enter_year == "2020"){
$sougou = ' 広島・地域志向科目';
$heiwa = " 平和科目";
$kyoutuuA = " 共通A";
$kyoutuuB = " 共通B";
$kyoutuuC = " 共通C";
$ensyuukamoku = " 初年度演習科目";
$kyaria = " キャリア形成・実践科目";
$ippanzyouhou = " 一般情報処理科目";
$hokenn = " 保健体育科目";
$gaikokugo = " 外国語系科目";
$sennmonnkiso = " 専門基礎科目";
$sennmonn = " 専門科目";

$sougou_num = 0;
$heiwa_num = 0;
$kyoutuuA_num = 0;
$kyoutuuB_num = 0;
$kyoutuuC_num = 0;
$ensyuukamoku_num = 0;
$kyaria_num = 0;
$ippanzyouhou_num = 0;
$hokenn_num = 0;
$gaikokugo_num = 0;
$sennmonnkiso_num = 0;
$sennmonn_num = 0;
$sougou_all = 0;
$kyoutuu_all = 0;
$all = 0;
$graduate_all = 0;


while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  $subject_year = $row['subject_year'];
  $already_evaluation = $row['evaluation'];

  unset($selected00);
  unset($selected01);
  unset($selected02);
  unset($selected03);
  unset($selected04);
  unset($selected05);
  unset($selected06);

  switch($already_evaluation){
    case "":
            $selected00 = 'selected';
            break;
    case " 秀":
            $selected01 = 'selected';
            break;
    case " 優":
            $selected02 = 'selected';
            break;
    case " 良":
            $selected03 = 'selected';
            break;
    case " 可":
            $selected04 = 'selected';
            break;
    case " 不可":
            $selected05 = 'selected';
            break;
    case " *不可":
          $selected06 = 'selected';
    break;
    }

if($subject_type == $sougou){
  $sougou_num = $sougou_num + $subject_number;
}
if($subject_type == $heiwa){
  $heiwa_num = $heiwa_num + $subject_number;
}
if($subject_type == $kyoutuuA){
  $kyoutuuA_num = $kyoutuuA_num + $subject_number;
}
if($subject_type == $kyoutuuB){
  $kyoutuuB_num = $kyoutuuB_num + $subject_number;
}
if($subject_type == $$kyoutuuC){
  $kyoutuuC_num = $kyoutuuC_num + $subject_number;
}
if($subject_type == $ensyuukamoku){
  $ensyuukamoku_num = $ensyuukamoku_num + $subject_number;
}
if($subject_type == $hokenn){
  $hokenn_num = $hokenn_num + $subject_number;
}
if($subject_type == $gaikokugo){
  $gaikokugo_num = $gaikokugo_num + $subject_number;
}
if($subject_type == $sennmonnkiso){
  $sennmonnkiso_num = $sennmonnkiso_num + $subject_number;
}
if($subject_type == $sennmonn){
  $sennmonn_num = $sennmonn_num + $subject_number;
}

//合計単位数の変数初期化
$sougou_all = $sougou_num + $heiwa_num + $kyoutuuA_num + $kyoutuuB_num + $kyoutuuC_num + $ensyuukamoku_num + $kyaria_num ;
$kyoutuu_all = $sougou_all + $ippanzyouhou_num + $hokenn_num + $gaikokugo_num;
$all = $sennmonnkiso_num + $sennmonn_num;
$graduate_all = $kyoutuu_all + $all;

  ?>

    <tr>
      <td class="subject"><?php echo $subject_name; ?></td>
      <?php

switch($subject_year){
    case 20201:
            $subject_year_personal = '2020年 - 前期';
            break;
    case 20202:
    $subject_year_personal = '2020年 - 後期';
            break;
    case 20191:
    $subject_year_personal = '2019年 - 前期';
            break;
    case 20192:
    $subject_year_personal = '2019年 - 後期';
            break;
    case 20181:
    $subject_year_personal = '2018年 - 前期';
            break;
    case 20182:
    $subject_year_personal = '2018年 - 後期';
            break;
    case 20171:
    $subject_year_personal = '2017年 - 前期';
    break;
    case 20172:
    $subject_year_personal = '2017年 - 後期';
    break;
    case 20161:
    $subject_year_personal = '2016年 - 前期';
    break;
    case 20162:
    $subject_year_personal = '2016年 - 後期';
    break;
    }
?>

      <td class="subject"><?php echo $subject_year_personal; ?></td>
      <td class="subject">
      <form method="post">
  <select name='evaluation[]'>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '未選択'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected00" ?>>未選択</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '秀'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected01" ?>>秀</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '優'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected02" ?>>優</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '良'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected03" ?>>良</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected04" ?>>可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected05" ?>>不可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '*不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected06" ?>>*不可</option>
  </select>
  </td>
  </tr>
<?php
}
?>
</br>
<button type="submit" class="btn btn-default" name="insert_evaluation">変更する</button>
</br>
</form>
<?php
}
?>


<?php
// 取得単位数情報の取り出し

if($enter_year == "2019" || $enter_year == "2018" || $enter_year == "2017"){
$sougou = ' 総合科目';
$hiroshima = ' 広島科目';
$heiwa = " 平和科目";
$kyoutuuA = " 共通A";
$kyoutuuB = " 共通B";
$kyoutuuC = " 共通C";
$ensyuukamoku = " 演習科目";
$kyaria = " キャリア形成";
$ippanzyouhou = " 一般情報処理科目";
$hokenn = " 保健体育科目";
$gaikokugo = " 外国語系科目";
$sennmonnkiso = " 専門基礎科目";
$sennmonn = " 専門科目";

$sougou_num = 0;
$hiroshima_num = 0;
$heiwa_num = 0;
$kyoutuuA_num = 0;
$kyoutuuB_num = 0;
$kyoutuuC_num = 0;
$ensyuukamoku_num = 0;
$kyaria_num = 0;
$ippanzyouhou_num = 0;
$hokenn_num = 0;
$gaikokugo_num = 0;
$sennmonnkiso_num = 0;
$sennmonn_num = 0;
$sougou_all = 0;
$kyoutuu_all = 0;
$all = 0;
$graduate_all = 0;

while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  $subject_year = $row['subject_year'];
  $already_evaluation = $row['evaluation'];

  unset($selected00);
  unset($selected01);
  unset($selected02);
  unset($selected03);
  unset($selected04);
  unset($selected05);
  unset($selected06);

  switch($already_evaluation){
    case "":
            $selected00 = 'selected';
            break;
    case " 秀":
            $selected01 = 'selected';
            break;
    case " 優":
            $selected02 = 'selected';
            break;
    case " 良":
            $selected03 = 'selected';
            break;
    case " 可":
            $selected04 = 'selected';
            break;
    case " 不可":
            $selected05 = 'selected';
            break;
    case " *不可":
            $selected06 = 'selected';
    break;
    }

  if($subject_type == $sougou){
    $sougou_num = $sougou_num + $subject_number;
  }
  if($subject_type == $hiroshima){
    $hiroshima_num = $hiroshima_num + $subject_number;
  }
  if($subject_type == $heiwa){
    $heiwa_num = $heiwa_num + $subject_number;
  }
  if($subject_type == $kyoutuuA){
    $kyoutuuA_num = $kyoutuuA_num + $subject_number;
  }
  if($subject_type == $kyoutuuB){
    $kyoutuuB_num = $kyoutuuB_num + $subject_number;
  }
  if($subject_type == $kyoutuuC){
    $kyoutuuC_num = $kyoutuuC_num + $subject_number;
  }
  if($subject_type == $ensyuukamoku){
    $ensyuukamoku_num = $ensyuukamoku_num + $subject_number;
  }
  if($subject_type == $hokenn){
    $hokenn_num = $hokenn_num + $subject_number;
  }
  if($subject_type == $ippanzyouhou){
    $ippanzyouhou_num = $ippanzyouhou_num + $subject_number;
  }
  if($subject_type == $gaikokugo){
    $gaikokugo_num = $gaikokugo_num + $subject_number;
  }
  if($subject_type == $sennmonnkiso){
    $sennmonnkiso_num = $sennmonnkiso_num + $subject_number;
  }
  if($subject_type == $sennmonn){
    $sennmonn_num = $sennmonn_num + $subject_number;
  }

  //合計単位数の変数初期化
$sougou_all = $sougou_num + $hiroshima_num + $heiwa_num + $kyoutuuA_num + $kyoutuuB_num + $kyoutuuC_num + $ensyuukamoku_num + $kyaria_num ;
$kyoutuu_all = $sougou_all + $ippanzyouhou_num + $hokenn_num + $gaikokugo_num;
$all = $sennmonnkiso_num + $sennmonn_num;
$graduate_all = $kyoutuu_all + $all;

  ?>

    <tr>
      <td class="subject"><?php echo $subject_name; ?></td>
      <?php
switch($subject_year){
    case 20201:
            $subject_year_personal = '2020年 - 前期';
            break;
    case 20202:
    $subject_year_personal = '2020年 - 後期';
            break;
    case 20191:
    $subject_year_personal = '2019年 - 前期';
            break;
    case 20192:
    $subject_year_personal = '2019年 - 後期';
            break;
    case 20181:
    $subject_year_personal = '2018年 - 前期';
            break;
    case 20182:
    $subject_year_personal = '2018年 - 後期';
            break;
    case 20171:
    $subject_year_personal = '2017年 - 前期';
    break;
    case 20172:
    $subject_year_personal = '2017年 - 後期';
    break;
    case 20161:
    $subject_year_personal = '2016年 - 前期';
    break;
    case 20162:
    $subject_year_personal = '2016年 - 後期';
    break;
    }
?>

      <td class="subject"><?php echo $subject_year_personal; ?></td>
      <td class="subject">
      <form method="post">
  <select name='evaluation[]'>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo ''; ?>, <?php echo $subject_year; ?>" <?php echo "$selected00" ?>>未選択</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '秀'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected01" ?>>秀</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '優'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected02" ?>>優</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '良'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected03" ?>>良</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected04" ?>>可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected05" ?>>不可</option>
  <option value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>, <?php echo '*不可'; ?>, <?php echo $subject_year; ?>" <?php echo "$selected06" ?>>*不可</option>
  </select>
  </td>
  </tr>
<?php
}
?>
</table>
</div>
</br>
<button type="submit" class="btn btn-default" name="insert_evaluation">変更する</button>
</br>
  </div>
</form>
<?php
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

</body>
</html>