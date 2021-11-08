<?php

$m_id = $_GET["m_id"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$stmt = $mysqli->prepare("DELETE FROM manager WHERE m_id=?");
$stmt->bind_param("i", $m_id);
$del = $stmt->execute();
if ($del) {
    echo "<script language='javascript'>
        alert('삭제 성공');
        location.href='manager_list.php'
    </script>";
    exit();
}
else {
    echo "<script language='javascript'>
        alert('삭제 실패');
        location.href='manager_info.php?m_id=" . $m_id . "'" .
    "</script>";
    exit();
}