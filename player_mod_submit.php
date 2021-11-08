<?php

$p_id = $_POST["p_id"];
if (empty($p_id)) {
    echo "<script language='javascript'>
        alert('고유번호를 입력하세요');
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

$stmt = $mysqli->prepare("UPDATE player SET "
        . "p_birthdate=?, "
        . "position=?, "
        . "height=?, "
        . "weight=?, "
        . "t_id=?, "
        . "p_until=? "
        . "WHERE p_id=?");
$stmt->bind_param("ssiiiii", $p_birthdate, $position, $height, $weight, $t_id, $p_until, $p_id);
$mod = $stmt->execute();
if ($mod) {
    echo "<script language='javascript'>
        alert('수정 성공');
        location.href='player_info.php?p_id=" . $p_id . "'" .
    "</script>";
    exit();
}
else {
    echo "<script language='javascript'>
        alert('수정 실패');
        history.back();
    </script>";
    exit();
}