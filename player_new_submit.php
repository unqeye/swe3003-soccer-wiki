<?php

$p_id = $_POST["p_id"];
if (empty($p_id)) {
    echo "<script language='javascript'>
        alert('고유번호를 입력하세요');
        history.back();
    </script>";
    exit();
}
$p_fname = $_POST["p_fname"];
if (empty($p_fname)) {
    echo "<script language='javascript'>
        alert('이름을 입력하세요');
        history.back();
    </script>";
    exit();
}
$p_lname = $_POST["p_lname"];
if (empty($p_lname)) {
    echo "<script language='javascript'>
        alert('성을 입력하세요');
        history.back();
    </script>";
    exit();
}
$p_birthdate = $_POST["p_birthdate"];
if (empty($p_birthdate)) $p_birthdate = null;
$position = $_POST["position"];
if (empty($position)) $position = null;
$height = $_POST["height"];
if (empty($height)) $height = null;
$weight = $_POST["weight"];
if (empty($weight)) $weight = null;
$c_id = $_POST["c_id"];
if (empty($c_id)) {
    echo "<script language='javascript'>
        alert('국적을 선택하세요');
        history.back();
    </script>";
    exit();
}
$t_id = $_POST["t_id"];
if (empty($t_id)) $t_id = null;
$p_until = $_POST["p_until"];
if (empty($p_until)) $p_until = null;

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM player WHERE p_id='$p_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('이미 등록된 선수입니다.');
        history.back();
    </script>";
    exit();
}

$stmt = $mysqli->prepare("INSERT INTO player VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssiiiii", $p_id, $p_fname, $p_lname, $p_birthdate, $position, $height, $weight, $c_id, $t_id, $p_until);
$new = $stmt->execute();
if ($new) {
    echo "<script language='javascript'>
        alert('등록 성공');
        location.href='player_info.php?p_id=" . $p_id . "'" .
    "</script>";
    exit();
}
else {
    echo "<script language='javascript'>
        alert('등록 실패');
        history.back();
    </script>";
    exit();
}