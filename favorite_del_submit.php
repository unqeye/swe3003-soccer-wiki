<?php

session_start();
if (!isset($_SESSION["u_id"]))
    header("Location: login.php");
$u_id = $_SESSION["u_id"];

$p_id = $_GET["p_id"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$stmt = $mysqli->prepare("DELETE FROM favorite WHERE u_id=? and p_id=?");
$stmt->bind_param("ii", $u_id, $p_id);
$del = $stmt->execute();
if ($del) {
    echo "<script language='javascript'>
        alert('삭제 성공');
        location.href='favorite_list.php'
    </script>";
    exit();
}
else {
    echo "<script language='javascript'>
        alert('삭제 실패');
        location.href='favorite_list.php'
    </script>";
    exit();
}