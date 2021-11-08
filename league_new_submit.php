<?php

$l_id = $_POST["l_id"];
$l_name = $_POST["l_name"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM league WHERE l_id='$l_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('이미 등록된 리그입니다.');
        history.back();
    </script>";
    exit();
}

$add = mysqli_query($mysqli, "INSERT INTO league VALUES"
        . "('$l_id', '$l_name')");
if ($add) {
    echo "<script language='javascript'>
        alert('등록 성공');
        history.back();
    </script>";
    exit();
}