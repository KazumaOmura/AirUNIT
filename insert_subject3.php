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

if(isset($_POST['insert'])){

  $riyu = filter_input(INPUT_POST, 'riyu', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  // var_dump($riyu);

  for ($i = 0; $i < count($_POST["riyu"]); $i++){

    // 変数代入 //
    $new_subject_name= $_POST["riyu"][$i];

    $d = preg_split("/,/",$new_subject_name); 

    // UPDATEのSQL作成
    $sql = "INSERT INTO $username (subject_name, subject_type, subject_number, unit_type) VALUES ('$d[0]', '$d[1]', '$d[2]', '$d[3]')";

    // SQL実行
    $res = $mysqli->query($sql);

    // var_dump($res);
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

<div class="hcu_main">



<form method="post">
  <p>科目名</p>
  <input type="text" name="serch_subject_name">
  <p>単位種類</p>
  <select name='serch_unit_type'>
  <option value=''>選択なし</option>
  <option value='必修'>必修</option>
  <option value='選択'>選択</option>
  <option value='自習'>自由</option>
  </select>
</br>
<button type="submit" class="btn btn-default" name="search">検索</button>
</br>
</form>

<?php
if(isset($_POST['search'])){
    ?>
    <table border="1">
    <tr>
      <th class="subject">科目名</th>
      <th class="subject">科目種類</th>
      <th class="subject">単位数</th>
      <th class="subject">単位種類</th>
      <th class="subject">追加</th>
    </tr>
    </table>
    <?php

  $serch_subject_name = $_POST['serch_subject_name'];
  $serch_unit_type = $_POST['serch_unit_type'];












  if($facluty=="情報科学部" && $facluty_detail=="システム工学科" && $enter_year == "2018"){

  // 全選択なしの検索
  if($serch_subject_name == NULL && $serch_unit_type == NULL){
  }

  // 科目名のみの検索
  if($serch_unit_type == NULL){
    $query = "SELECT * FROM basic_subject WHERE subject_name LIKE '%$serch_subject_name%'";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_assoc()) {
      $subject_name = $row['subject_name'];
      $subject_type = $row['subject_type'];
      $subject_number = $row['subject_number'];
      $unit_type = $row['unit_type'];
    ?>

    <form method="post">
      <table border="1">
      <tr>
        <td class="subject"><?php echo $subject_name; ?></td>
        <td class="subject"><?php echo $subject_type; ?></td>
        <td class="subject"><?php echo $subject_number; ?></td>
        <td class="subject"><?php echo $unit_type; ?></td>
        <td class="subject"><input type="checkbox" name="riyu[]" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>"></td>
      </tr>
      </table>
    <?php
    }
    // データベースの切断
    $result->close();
  }
  
// 単位種類のみの検索
if($serch_subject_name == NULL){
  $query = "SELECT * FROM basic_subject WHERE unit_type = '$serch_unit_type'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
                $subject_name = $row['subject_name'];
                $subject_type = $row['subject_type'];
                $subject_number = $row['subject_number'];
                $unit_type = $row['unit_type'];
        ?>

<form method="post">
    <table border="1">
<tr>
  <td class="subject"><?php echo $subject_name; ?></td>
  <td class="subject"><?php echo $subject_type; ?></td>
  <td class="subject"><?php echo $subject_number; ?></td>
  <td class="subject"><?php echo $unit_type; ?></td>
  <td class="subject"><input type="checkbox" name="riyu[]" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>"></td>
</tr>
</table>

    <?php
    }
// データベースの切断
$result->close();
  }

  // 科目名&単位種類の検索
  if($serch_subject_name != NULL && $serch_unit_type != NULL){
    $query = "SELECT * FROM basic_subject WHERE subject_name LIKE '%$serch_subject_name%' AND unit_type = '$serch_unit_type'";
              $result = $mysqli->query($query);
              while ($row = $result->fetch_assoc()) {
                  $subject_name = $row['subject_name'];
                  $subject_type = $row['subject_type'];
                  $subject_number = $row['subject_number'];
                  $unit_type = $row['unit_type'];
          ?>
  
  <form method="post">
      <table border="1">
  <tr>
    <td class="subject"><?php echo $subject_name; ?></td>
    <td class="subject"><?php echo $subject_type; ?></td>
    <td class="subject"><?php echo $subject_number; ?></td>
    <td class="subject"><?php echo $unit_type; ?></td>
    <td class="subject"><input type="checkbox" name="riyu[]" value="<?php echo $subject_name; ?>, <?php echo $subject_type; ?>, <?php echo $subject_number; ?>, <?php echo $unit_type; ?>"></td>
  </tr>
  </table>
  
      <?php
      }
// データベースの切断
$result->close();
    }

  }
}     
?>






















<button type="submit" class="btn btn-default" name="insert" value="1">追加する</button></br>
</form>

<div class="phone_area">
</br></br></br></br>
</div>
</br></br></br></br></br></br></br>

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