<?php

$t_id = $_GET["t_id"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$stmt = $mysqli->prepare("DELETE FROM team WHERE t_id=?");
$stmt->bind_param("i", $t_id);
$del = $stmt->execute();
if ($del) {
    echo "<script language='javascript'>
        alert('삭제 성공');
        location.href='league_list.php'
    </script>";
    exit();
}
else {
    echo "<script language='javascript'>
        alert('삭제 실패');
        location.href='team_info.php?t_id=" . $t_id . "'" .
    "</script>";
    exit();
}