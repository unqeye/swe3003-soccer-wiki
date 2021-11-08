<?php

session_start();
if (!isset($_SESSION["u_id"]))
    header("Location: login.php");
$u_id = $_SESSION["u_id"];

$p_id = $_GET["p_id"];

echo "<script language='javascript'>
        if (confirm('삭제하시겠습니까?'))
            location.href='favorite_del_submit.php?p_id=" . $p_id . "';" .
        "else
            history.back();
    </script>";