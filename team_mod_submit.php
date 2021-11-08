<?php

$t_id = $_POST["t_id"];
if (empty($t_id)) {
    echo "<script language='javascript'>
        alert('고유번호를 입력하세요');
        history.back();
    </script>";
    exit();
}
$t_name = $_POST["t_name"];
if (empty($t_name)) {
    echo "<script language='javascript'>
        alert('이름을 입력하세요');
        history.back();
    </script>";
    exit();
}
$l_id = $_POST["l_id"];
if (empty($l_id)) {
    echo "<script language='javascript'>
        alert('리그를 선텍하세요');
        history.back();
    </script>";
    exit();
}
/*$m_id = $_POST["m_id"];
if (empty($m_id)) $m_id = null;*/

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$stmt = $mysqli->prepare("UPDATE team SET "
        . "t_name=?, "
        . "l_id=? "
        . "WHERE t_id=?");
$stmt->bind_param("sii", $t_name, $l_id, $t_id);
$mod = $stmt->execute();
if ($mod) {
    echo "<script language='javascript'>
        alert('수정 성공');
        location.href='team_info.php?t_id=" . $t_id . "'" .
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