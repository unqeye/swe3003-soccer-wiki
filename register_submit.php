<?php

$u_id = $_POST["u_id"];
$pw1 = $_POST["pw1"];
$pw2 = $_POST["pw2"];

if ($u_id == NULL) {
    echo "아이디를 입력하세요.<br/>";
    echo "<a href=register.php>뒤로가기</a>";
    exit();
}

if ($pw1 == NULL) {
    echo "비밀번호를 입력하세요.<br/>";
    echo "<a href=register.php>뒤로가기</a>";
    exit();
}

if ($pw2 == NULL) {
    echo "비밀번호 확인을 입력하세요.<br/>";
    echo "<a href=register.php>뒤로가기</a>";
    exit();
}

if ($pw1 != $pw2) {
    echo "비밀번호가 일치하지 않습니다.<br/>";
    echo "<a href=register.php>뒤로가기</a>";
    exit();
}

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM user WHERE u_id='$u_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('중복된 ID가 존재합니다.');
        history.back();
    </script>";
    exit();
}

$register = mysqli_query($mysqli, "INSERT INTO user VALUES ('$u_id', '$pw1')");
if ($register) {
    echo "<script language='javascript'>
        alert('가입 성공');
        location.href='main.php'
    </script>";
    exit();
}