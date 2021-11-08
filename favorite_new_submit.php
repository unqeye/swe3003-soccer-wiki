<?php

session_start();
if (!isset($_SESSION["u_id"]))
    header("Location: login.php");
$u_id = $_SESSION["u_id"];

$p_id = $_POST["p_id"];
$memo = $_POST["memo"];

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM favorite WHERE u_id='$u_id' and p_id='$p_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('이미 등록된 선수입니다.');
        history.back();
    </script>";
    exit();
}

$add = mysqli_query($mysqli, "INSERT INTO favorite VALUES"
        . "('$u_id', '$p_id', '$memo')");
if ($add) {
    echo "<script language='javascript'>
        alert('등록 성공');
        history.back();
    </script>";
    exit();
}