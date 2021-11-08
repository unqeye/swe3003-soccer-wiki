<?php

session_start();
if (!isset($_SESSION["u_id"]))
    header("Location: login.php");
$u_id = $_SESSION["u_id"];
if (strcmp($u_id, "admin")) {
    echo "<script language='javascript'>
        alert('관리자 권한이 없습니다.');
        history.back();
    </script>";
    exit();
}

$p_id = $_GET["p_id"];

echo "<script language='javascript'>
        if (confirm('삭제하시겠습니까?'))
            location.href='player_del_submit.php?p_id=" . $p_id . "';" .
        "else
            history.back();
    </script>";