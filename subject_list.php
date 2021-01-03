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

    $idid = $_POST["idid"];

        if($_POST["idid"]){ //IDおよびユーザー名の入力有無を確認
            $query = "SELECT * FROM basic_subject_information_2018 WHERE subject_name='.$idid.'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
                $subject_name = $row['subject_name'];
                $subject_type = $row['subject_type'];
                $subject_number = $row['subject_number'];
                $unit_type = $row['unit_type'];
        }
    }
?>