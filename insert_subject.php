<?php
header('Content-Type: text/html; charset=UTF-8');

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








// データベースの切断
$result->close();
?>
 

<!DOCTYPE html>
<html>
<head>
<title>履修済科目一覧｜広島市立大学 履修確認一覧サービス</title>
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

<div class="hcu_main">
<h1>履修済科目一覧</h1> 

<div class="hidden_box">
<label for="label1">表示する</label>
    <input type="checkbox" id="label1"/>
    <div class="hidden_show">

<?php
  $query = "SELECT * FROM ".$username."";
  $result = $mysqli->query($query);
?>
  <table border="1">
    <tr>
      <th class="subject">科目名</th>
      <th class="subject">科目種類</th>
      <th class="subject">単位数</th>
      <th class="subject">単位種類</th>
      <th class="subject">評価</th>
    </tr>
    </table>
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
  $evaluation = $row['evaluation'];

  switch($evaluation){
    case " 選択なし":
    $gpa01;
            break;
    case " 秀":
    $gpa01 = $gpa01 + (4 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $syuu = $syuu + 1;
            break;
    case " 優":
    $gpa01 = $gpa01 + (3 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $yuu = $yuu + 1;
            break;
    case " 良":
    $gpa01 = $gpa01 + (2 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $ryou = $ryou + 1;
            break;
    case " 可":
    $gpa01 = $gpa01 + (1 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $ka = $ka + 1;
            break;
    case " 不可":
    $gpa01 = $gpa01 + (0 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $huka = $huka + 1;
            break;
    case " *不可":
    $gpa01 = $gpa01 + (0 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $asterisk_huka = $asterisk_huka + 1;
    break;
    }

    $gpa03 = $gpa02 / $gpa01;


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

<table border="1">
    <tr>
      <td class="subject"><?php echo $subject_name; ?></td>
      <td class="subject"><?php echo $subject_type; ?></td>
      <td class="subject"><?php echo $subject_number; ?></td>
      <td class="subject"><?php echo $unit_type; ?></td>
      <td class="subject"><?php echo "草"; ?></td>
    </tr>
  </table>
<?php
}
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

$syuu = 0;
$yuu = 0;
$ryou = 0;
$ka = 0;
$huka = 0;
$asterisk_huka = 0;

while ($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $subject_type = $row['subject_type'];
  $subject_number = $row['subject_number'];
  $unit_type = $row['unit_type'];
  $evaluation = $row['evaluation'];

  switch($evaluation){
    case " 選択なし":
    $gpa01;
            break;
    case " 秀":
    $gpa01 = $gpa01 + (4 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $syuu = $syuu + 1;
            break;
    case " 優":
    $gpa01 = $gpa01 + (3 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $yuu = $yuu + 1;
            break;
    case " 良":
    $gpa01 = $gpa01 + (2 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $ryou = $ryou + 1;
            break;
    case " 可":
    $gpa01 = $gpa01 + (1 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $ka = $ka + 1;
            break;
    case " 不可":
    $gpa01 = $gpa01 + (0 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $huka = $huka + 1;
            break;
    case " *不可":
    $gpa01 = $gpa01 + (-1 * $subject_number);
    $gpa02 = $gpa02 + $subject_number;
    $asterisk_huka = $asterisk_huka + 1;
    break;
    }

    $gpa03 = $gpa02 / $gpa01;


  if($subject_type == $sougou && $evaluation != " 不可" && $evaluation != " *不可"){
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

<table border="1">
    <tr>
      <td class="subject"><?php echo $subject_name; ?></td>
      <td class="subject"><?php echo $subject_type; ?></td>
      <td class="subject"><?php echo $subject_number; ?></td>
      <td class="subject"><?php echo $unit_type; ?></td>
      <td class="subject"><?php echo $evaluation; ?></td>
    </tr>
  </table>
<?php
}
}
?>

</div>
</div>

</br>

<a href="insert_evaluation.php"><h4>科目評価情報を追加</h4></a>
<a href="insert_subject2.php"><h4>履修済科目を追加</h4></a>
<a href="delete_subject.php"><h4>履修済科目を削除</h4></a>

</br>

<h2>GPA</h2>
<table border="1">
    <tr>
      <th class="subject"></th>
      <th class="subject">合計数</th>
    </tr>

    <tr>
    <th class="subject">秀</th>
    <td class="subject"><?php echo $syuu; ?></td>
    </tr>

    <tr>
    <th class="subject">優</th>
    <td class="subject"><?php echo $yuu; ?></td>
    </tr>

    <tr>
    <th class="subject">良</th>
    <td class="subject"><?php echo $ryou; ?></td>
    </tr>

    <tr>
    <th class="subject">可</th>
    <td class="subject"><?php echo $ka; ?></td>
    </tr>

    <tr>
    <th class="subject">不可</th>
    <td class="subject"><?php echo $huka; ?></td>
    </tr>

    <tr>
    <th class="subject">*不可</th>
    <td class="subject"><?php echo $asterisk_huka; ?></td>
    </tr>
  </table>

  <h4>GDP = <?php echo "$gpa03";?></h3>
  </br>


<!-- 総合共通科目の出力 - 2020 -->
<?php
if($facluty=="国際学部" && $enter_year == "2020"){
  $query = "SELECT * FROM graduate_international_2020";
  $result = $mysqli->query($query);

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
  }
?>

<h2>GPA</h2>

<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">広島・地域志向科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">初年次演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">14単位以上</td>
    <?php
      if($sougou_all < 14){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 14;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">30単位以上</td>
    <?php
      if($kyoutuu_all < 30){
        $kyoutuu_all = $kyoutuu_all - 30;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位以上</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位以上</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">93単位以上</td>
    <?php
      if($all < 93){
        $unit_all_clear = 0;
        $all = $all - 93;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2020"){
  $query = "SELECT * FROM graduate_information_2020";
  $result = $mysqli->query($query);

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
  }
?>
<h2>取得単位数</h2>

<table border="1">
<tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">広島・地域志向科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">初年次演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">16単位以上</td>
    <?php
      if($sougou_all < 16){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 16;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">33単位</td>
    <?php
      if($kyoutuu_all < 33){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 33;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject" rowspan="2"><?php echo $sennmonnkiso_num + $sennmonn_num; ?>単位</td>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonnkiso_num;
        ?>
        <td class="subject" rowspan="2"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject" rowspan="2">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">95単位</td>
    <?php
      if($all < 95){
        $unit_all_clear = 0;
        $all = $all - 95;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2020"){
  $query = "SELECT * FROM graduate_art_2020";
  $result = $mysqli->query($query);
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
  }
?>
<h2>取得単位数</h2>

<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">広島・地域志向科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">初年次演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成・実践科目</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">18単位以上</td>
    <?php
      if($sougou_all < 18){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 18;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">30単位</td>
    <?php
      if($kyoutuu_all < 30){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 30;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">98単位</td>
    <?php
      if($all < 98){
        $unit_all_clear = 0;
        $all = $all - 98;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>






<!--  総合共通科目の出力 - 2019　-->
<?php
if($facluty=="国際学部" && $enter_year == "2019"){
  $query = "SELECT * FROM graduate_international_2019";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">15単位以上</td>
    <?php
      if($sougou_all < 15){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 15;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">31単位</td>
    <?php
      if($kyoutuu_all < 31){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 31;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">93単位</td>
    <?php
      if($all < 93){
        $unit_all_clear = 0;
        $all = $all - 93;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2019"){
  $query = "SELECT * FROM graduate_information_2019";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">18単位以上</td>
    <?php
      if($sougou_all < 18){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 18;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">33単位</td>
    <?php
      if($kyoutuu_all < 33){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 33;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
    <?php
    $sennmonn_all_num = $sennmonnkiso_num + $sennmonn_num;
    ?>
      <td class="subject" rowspan="2"><?php echo $sennmonn_all_num; ?>単位</td>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_all_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_all_num;
        ?>
        <td class="subject" rowspan="2"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject" rowspan="2">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">93単位</td>
    <?php
      if($all < 93){
        $unit_all_clear = 0;
        $all = $all - 93;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">129単位</td>
    <?php
      if($graduate_all < 129){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 129;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2019"){
  $query = "SELECT * FROM graduate_art_2019";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">18単位以上</td>
    <?php
      if($sougou_all < 18){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 18;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">30単位</td>
    <?php
      if($kyoutuu_all < 30){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 30;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">98単位</td>
    <?php
      if($all < 98){
        $unit_all_clear = 0;
        $all = $all - 98;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>




<!--  総合共通科目の出力 - 2018　-->
<?php
if($facluty=="国際学部" && $enter_year == "2018"){
  $query = "SELECT * FROM graduate_international_2018";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">15単位以上</td>
    <?php
      if($sougou_all < 15){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 15;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">31単位以上</td>
    <?php
      if($kyoutuu_all < 31){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 31;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">93単位以上</td>
    <?php
      if($all < 93){
        $unit_all_clear = 0;
        $all = $all - 93;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2018"){
  $query = "SELECT * FROM graduate_information_2018";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">18単位以上</td>
    <?php
      if($sougou_all < 18){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 18;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">33単位</td>
    <?php
      if($kyoutuu_all < 33){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 33;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
    <?php
    $sennmonn_all_num = $sennmonnkiso_num + $sennmonn_num;
    ?>
      <td class="subject" rowspan="2"><?php echo $sennmonn_all_num; ?>単位</td>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_all_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_all_num;
        ?>
        <td class="subject" rowspan="2"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject" rowspan="2">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">96単位</td>
    <?php
      if($all < 96){
        $unit_all_clear = 0;
        $all = $all - 96;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">129単位</td>
    <?php
      if($graduate_all < 129){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 129;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2018"){
  $query = "SELECT * FROM graduate_art_2018";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">18単位以上</td>
    <?php
      if($sougou_all < 18){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 18;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">30単位</td>
    <?php
      if($kyoutuu_all < 30){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 30;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">98単位</td>
    <?php
      if($all < 98){
        $unit_all_clear = 0;
        $all = $all - 98;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>



<!--  総合共通科目の出力 - 2017　-->
<?php
if($facluty=="国際学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_international_2017";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">16単位以上</td>
    <?php
      if($sougou_all < 16){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 16;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">32単位以上</td>
    <?php
      if($kyoutuu_all < 32){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 32;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">94単位以上</td>
    <?php
      if($all < 94){
        $unit_all_clear = 0;
        $all = $all - 94;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>

<?php
if($facluty=="情報科学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_information_2017";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">18単位以上</td>
    <?php
      if($sougou_all < 18){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 18;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">33単位</td>
    <?php
      if($kyoutuu_all < 33){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 33;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
    <?php
    $sennmonn_all_num = $sennmonnkiso_num + $sennmonn_num;
    ?>
      <td class="subject" rowspan="2"><?php echo $sennmonn_all_num; ?>単位</td>
      <td class="subject" rowspan="2"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_all_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_all_num;
        ?>
        <td class="subject" rowspan="2"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject" rowspan="2">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">96単位</td>
    <?php
      if($all < 96){
        $unit_all_clear = 0;
        $all = $all - 96;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">129単位</td>
    <?php
      if($graduate_all < 129){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 129;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
?>






<?php
if($facluty=="芸術学部" && $enter_year == "2017"){
  $query = "SELECT * FROM graduate_art_2017";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
    $a = $row['総合科目'];
    $b = $row['平和科目'];
    $o = $row['広島科目'];
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
  }
?>
<h2>取得単位数</h2>
  


<table border="1">

    <tr>
      <th class="subject">科目名</th>
      <th class="subject">取得済単位数</th>
      <th class="subject">卒業単位数</th>
      <th class="subject">過不足判定</th>
    </tr>

    <tr>
    <th class="subject">総合科目</th>
      <td class="subject"><?php echo $sougou_num; ?>単位</td>
      <td class="subject"><?php echo $a; ?>単位以上</td>
      <?php
      if($sougou_num < $a){
        $unit_all_clear = 0;
        $a = $a - $sougou_num;
        ?>
        <td class="subject"><?php echo $a; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">広島科目</th>
      <td class="subject"><?php echo $hiroshima_num; ?>単位</td>
      <td class="subject"><?php echo $o; ?>単位以上</td>
      <?php
      if($hiroshima_num < $o){
        $unit_all_clear = 0;
        $o = $o - $hiroshima_num;
        ?>
        <td class="subject"><?php echo $o; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">平和科目</th>
      <td class="subject"><?php echo $heiwa_num; ?>単位</td>
      <td class="subject"><?php echo $b; ?>単位以上</td>
      <?php
      if($heiwa_num < $b){
        $unit_all_clear = 0;
        $b = $b - $heiwa_num;
        ?>
        <td class="subject"><?php echo $b; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目A</th>
      <td class="subject"><?php echo $kyoutuuA_num; ?>単位</td>
      <td class="subject"><?php echo $c; ?>単位以上</td>
      <?php
      if($kyoutuuA_num < $c){
        $unit_all_clear = 0;
        $c = $c - $kyoutuuA_num;
        ?>
        <td class="subject"><?php echo $c; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目B</th>
      <td class="subject"><?php echo $kyoutuuB_num; ?>単位</td>
      <td class="subject"><?php echo $d; ?>単位以上</td>
      <?php
      if($kyoutuuB_num < $d){
        $unit_all_clear = 0;
        $d = $d - $kyoutuuB_num;
        ?>
        <td class="subject"><?php echo $d; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">共通科目C</th>
      <td class="subject"><?php echo $kyoutuuC_num; ?>単位</td>
      <td class="subject"><?php echo $e; ?>単位以上</td>
      <?php
      if($kyoutuuC_num < $e){
        $unit_all_clear = 0;
        $e = $e - $kyoutuuC_num;
        ?>
        <td class="subject"><?php echo $e; ?>単位不足</td>
        <?php
      }else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">演習科目</th>
      <td class="subject"><?php echo $ensyuukamoku_num; ?>単位</td>
      <td class="subject"><?php echo $f; ?>単位</td>
      <?php
      if($ensyuukamoku_num < $f){
        $unit_all_clear = 0;
        $f = $f - $ensyuukamoku_num;
        ?>
        <td class="subject"><?php echo $f; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">キャリア形成</th>
      <td class="subject"><?php echo $kyaria_num; ?>単位</td>
      <td class="subject"><?php echo $g; ?>単位以上</td>
      <?php
      if($kyaria_num < $g){
        $unit_all_clear = 0;
        $g = $g - $kyaria_num;
        ?>
        <td class="subject"><?php echo $g; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合共通科目小計</th>
    <td class="subject"><?php echo $sougou_all; ?>単位</td>
    <td class="subject">19単位以上</td>
    <?php
      if($sougou_all < 19){
        $unit_all_clear = 0;
        $sougou_all = $sougou_all- 19;
        $sougou_all = $sougou_all * -1;
        ?>
        <td class="subject"><?php echo $sougou_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">一般情報処理科目</th>
      <td class="subject"><?php echo $ippanzyouhou_num; ?>単位</td>
      <td class="subject"><?php echo $h; ?>単位</td>
      <?php
      if($ippanzyouhou_num < $h){
        $unit_all_clear = 0;
        $h = $h - $ippanzyouhou_num;
        ?>
        <td class="subject"><?php echo $h; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">保健体育科目</th>
      <td class="subject"><?php echo $hokenn_num; ?>単位</td>
      <td class="subject"><?php echo $i; ?>単位</td>
      <?php
      if($hokenn_num < $i){
        $unit_all_clear = 0;
        $i = $i - $hokenn_num;
        ?>
        <td class="subject"><?php echo $i; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">外国語系科目</th>
      <td class="subject"><?php echo $gaikokugo_num; ?>単位</td>
      <td class="subject"><?php echo $j; ?>単位以上</td>
      <?php
      if($gaikokugo_num < $j){
        $unit_all_clear = 0;
        $j = $j - $gaikokugo_num;
        ?>
        <td class="subject"><?php echo $j; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">全学共通系科目統計</th>
    <td class="subject"><?php echo $kyoutuu_all; ?>単位</td>
    <td class="subject">30単位</td>
    <?php
      if($kyoutuu_all < 30){
        $unit_all_clear = 0;
        $kyoutuu_all = $kyoutuu_all - 30;
        $kyoutuu_all = $kyoutuu_all * -1;
        ?>
        <td class="subject"><?php echo $kyoutuu_all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門基礎科目</th>
      <td class="subject"><?php echo $sennmonnkiso_num; ?>単位</td>
      <td class="subject"><?php echo $k; ?>単位</td>
      <?php
      if($sennmonnkiso_num < $k){
        $unit_all_clear = 0;
        $k = $k - $sennmonnkiso_num;
        ?>
        <td class="subject"><?php echo $k; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">専門科目</th>
      <td class="subject"><?php echo $sennmonn_num; ?>単位</td>
      <td class="subject"><?php echo $l; ?>単位</td>
      <?php
      if($sennmonn_num < $l){
        $unit_all_clear = 0;
        $l = $l - $sennmonn_num;
        ?>
        <td class="subject"><?php echo $l; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">計</th>
    <td class="subject"><?php echo $all; ?>単位</td>
    <td class="subject">98単位</td>
    <?php
      if($all < 98){
        $unit_all_clear = 0;
        $all = $all - 98;
        $all = $all * -1;
        ?>
        <td class="subject"><?php echo $all; ?>単位不足</td>
        <?php
      }
      else{
        ?>
        <td class="subject">単位取得済み</td>
        <?php
      }
      ?>
    </tr>
    <tr>
    <th class="subject">総合計単位数</th>
    <td class="subject"><?php echo $graduate_all; ?>単位</td>
    <td class="subject">128単位</td>
    <?php
      if($graduate_all < 128){
        $unit_all_clear = 0;
        $graduate_all = $graduate_all - 128;
        $graduate_all = $graduate_all * -1;
        ?>
        <td class="subject"><?php echo $graduate_all; ?>単位不足</td>
        <?php
      }
      else{
        if($unit_all_clear == 1){
          ?>
          <td class="subject">卒業見込み</td>
          <?php
        }
        else{
        ?>
        <td class="subject">※条件を満たしていない種類があります。</td>
        <?php
        }
      }
      ?>
    </tr>
  </table>
<?php
}
// データベースの切断
$result->close();
?>

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
</br></br></br></br></br></br></br></br></br>

<div id="footer">
        <a href="https://twitter.com/kazumaaa14"><img src="../images/iconTw_fotter.png" class="sns_img"></a>
        <a href="https://www.instagram.com/kazumaaa14/?hl=ja"><img src="../images/iconInsta_footer.png" class="sns_img"></a>
        <p class="copylight">-  ©︎ 2020 Kazuma Omura  -</p>
</div>
</body>
</html>