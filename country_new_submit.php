<?php

$c_id = $_POST["c_id"];
$c_name = $_POST["c_name"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM country WHERE c_id='$c_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('이미 등록된 국가입니다.');
        history.back();
    </script>";
    exit();
}

$add = mysqli_query($mysqli, "INSERT INTO country VALUES"
        . "('$c_id', '$c_name')");
if ($add) {
    echo "<script language='javascript'>
        alert('등록 성공');
        history.back();
    </script>";
    exit();
}