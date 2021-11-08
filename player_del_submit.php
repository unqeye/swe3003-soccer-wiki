<?php

$p_id = $_GET["p_id"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$stmt = $mysqli->prepare("DELETE FROM player WHERE p_id=?");
$stmt->bind_param("i", $p_id);
$del = $stmt->execute();
if ($del) {
    echo "<script language='javascript'>
        alert('삭제 성공');
        location.href='player_list.php'
    </script>";
    exit();
}
else {
    echo "<script language='javascript'>
        alert('삭제 실패');
        location.href='player_info.php?p_id=" . $p_id . "'" .
    "</script>";
    exit();
}