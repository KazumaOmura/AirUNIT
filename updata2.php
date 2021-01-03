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




$answer = $_POST["update"];
if($answer == '1'){

// 変数代入 //
$new_username = $_POST['update_username'];
$new_email = $_POST['update_email'];
$new_facluty = $_POST['update_facluty'];
$new_facluty_detail = $_POST['update_facluty_detail'];
$new_enter_year = $_POST['update_enter_year'];

$query = "SELECT * FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);

// UPDATEのSQL作成
$sql = "UPDATE users SET username = '$new_username', email = '$new_email', facluty = '$new_facluty', facluty_detail = '$new_facluty_detail' ,enter_year = '$new_enter_year' WHERE id = '$id'";

// SQL実行
$res = $mysqli->query($sql);
//var_dump($res);


// RENAMEのSQL作成
$sql = "ALTER TABLE $username RENAME $new_username";

// SQL実行
$res = $mysqli->query($sql);
//var_dump($res);

// テーブルデータの全削除のSQL作成
$sql = "DELETE FROM $new_username";

// SQL実行
$res = $mysqli->query($sql);
//var_dump($res);





$new_username_timetable = $new_username;
$new_username_timetable .= "timetable";

$old_username_timetable = $username;
$old_username_timetable .= "timetable";

// UPDATEのSQL作成
$sql = "UPDATE users SET username = '$new_username', email = '$new_email', facluty = '$new_facluty', facluty_detail = '$new_facluty_detail' ,enter_year = '$new_enter_year' WHERE id = '$id'";

// SQL実行
$res = $mysqli->query($sql);
//var_dump($res);


// RENAMEのSQL作成
$sql = "ALTER TABLE $old_username_timetable RENAME $new_username_timetable";

// SQL実行
$res = $mysqli->query($sql);
//var_dump($res);

// テーブルデータの全削除のSQL作成
$sql = "DELETE FROM $new_username_timetable";

// SQL実行
$res = $mysqli->query($sql);
//var_dump($res);


header("Location: updata3.php");
// データベース切断
$mysqli->close();
}
?>












 
<!DOCTYPE html>
<html>
<head>
<title>プロフィール情報変更｜広島市立大学 履修確認一覧サービス</title>
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
<center>
<h2 class="sub_index">プロフィール情報変更</h2> 
 
<div class="login_contents">
<form method="post">
<div class="form-group">
<h2>名前を変更して下さい。</h2>
<input type="text"  name="update_username" value="<?=htmlspecialchars($username, ENT_QUOTES, 'UTF-8')?>">
</div>
</div>


<div class="login_contents">
<h2>メールアドレスを変更して下さい。</h2>
<input type="text"  name="update_email" value="<?=htmlspecialchars($email, ENT_QUOTES, 'UTF-8')?>">
</div>
</center>

<center>
<div class="login_contents">
<h2>入学年を変更して下さい。</h2>
</center>

<?php
switch($enter_year){
    case 2017:
            $checked12 = 'checked';
            break;
    case 2018:
            $checked13 = 'checked';
            break;
    case 2019:
            $checked14 = 'checked';
            break;
    case 2020:
            $checked15 = 'checked';
    break;
    }
?>

<div class="cp_ipradio">
	<ul>
        <li class="list_item">
		<label>
		<input type="hidden" name="update_enter_year" value="$enter_year">
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_enter_year" value="2017" <?php echo "$checked12" ?>/>
		2017
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_enter_year" value="2018" <?php echo "$checked13" ?>/>
        2018
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_enter_year" value="2019" <?php echo "$checked14" ?>/>
		2019
		</label>
        </li>
        <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_enter_year" value="2020" <?php echo "$checked15" ?>/>
		2020
		</label>
		</li>
	</ul>
</div>

<center>
<div class="login_contents">
<h2>所属学部を変更して下さい。</h2>
</center>

<?php
switch($facluty){
    case "国際学部":
            $checked0 = 'checked';
            break;
    case "情報科学部":
            $checked1 = 'checked';
            break;
    case "芸術学部":
            $checked2 = 'checked';
            break;
    }
?>

<div class="cp_ipradio">
	<ul>
        <li class="list_item">
		<label>
		<input type="hidden" name="update_facluty" value="$facluty">
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty" value="国際学部" <?php echo "$checked0" ?>/>
		国際学部
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty" value="情報科学部" <?php echo "$checked1" ?>/>
        情報科学部
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty" value="芸術学部" <?php echo "$checked2" ?>/>
		芸術学部
		</label>
		</li>
	</ul>
</div>

<center>
<div class="login_contents">
<h2>所属学科・専攻を変更して下さい。</h2>
</center>

<?php
switch($facluty_detail){
    case "配属なし";
            $checked3 = 'checked';
            break;
    case "情報工学科":
            $checked4 = 'checked';
            break;
    case "知能工学科":
            $checked5 = 'checked';
            break;
    case "システム工学科";
            $checked6 = 'checked';
            break;
    case "医用情報科学科":
            $checked7 = 'checked';
            break;
    case "日本画専攻":
            $checked8 = 'checked';
            break;
    case "油絵専攻";
            $checked9 = 'checked';
            break;
    case "彫刻専攻":
            $checked10 = 'checked';
            break;
    case "デザイン工芸学科":
            $checked11 = 'checked';
            break;
}   
?>

<div class="cp_ipradio">
	<ul>
        <li class="list_item">
		<label>
		<input type="hidden" name="update_facluty_detail" value="$facluty_detail">
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="配属なし" <?php echo "$checked3" ?>/>
		配属なし
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="情報工学科" <?php echo "$checked4" ?>/>
    情報工学科
		</label>
		</li>
		<li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="知能工学科" <?php echo "$checked5" ?>/>
		知能工学科
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="システム工学科" <?php echo "$checked6" ?>/>
    システム工学科
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="医用情報科学科" <?php echo "$checked7" ?>/>
    医用情報科学科
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="日本画専攻" <?php echo "$checked8" ?>/>
    日本画専攻
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="油絵専攻" <?php echo "$checked9" ?>/>
    油絵専攻
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="彫刻専攻" <?php echo "$checked10" ?>/>
    彫刻専攻
		</label>
    </li>
    <li class="list_item">
		<label>
		<input type="radio" class="option-input" name="update_facluty_detail" value="デザイン工芸学科" <?php echo "$checked11" ?>/>
    デザイン工芸学科
		</label>
		</li>
	</ul>
</div>

<center>

<button type="submit" class="btn btn-default" name="update" value="1">変更する</button></br>
</form>

</div>
</center>

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