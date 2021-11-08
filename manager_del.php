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

$m_id = $_GET["m_id"];

echo "<script language='javascript'>
        if (confirm('삭제하시겠습니까?'))
            location.href='manager_del_submit.php?m_id=" . $m_id . "';" .
        "else
            history.back();
    </script>";