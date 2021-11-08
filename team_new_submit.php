<?php

$t_id = $_POST["t_id"];
if (empty($t_id)) {
    echo "<script language='javascript'>
        alert('고유번호를 입력하세요');
        history.back();
    </script>";
    exit();
}
$t_name = $_POST["t_name"];
if (empty($t_name)) {
    echo "<script language='javascript'>
        alert('이름을 입력하세요');
        history.back();
    </script>";
    exit();
}
$l_id = $_POST["l_id"];
if (empty($l_id)) {
    echo "<script language='javascript'>
        alert('리그를 선텍하세요');
        history.back();
    </script>";
    exit();
}
/*$m_id = $_POST["m_id"];
if (empty($m_id)) $m_id = null;*/
$m_id = null;

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM team WHERE t_id='$t_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('이미 등록된 팀입니다.');
        history.back();
    </script>";
    exit();
}

$add = mysqli_query($mysqli, "INSERT INTO team VALUES"
        . "('$t_id', '$t_name', '$l_id', '$m_id')");
$stmt = $mysqli->prepare("INSERT INTO team VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $t_id, $t_name, $l_id, $m_id);
$new = $stmt->execute();
if ($new) {
    echo "<script language='javascript'>
        alert('등록 성공');
        history.back();
    </script>";
    exit();
}