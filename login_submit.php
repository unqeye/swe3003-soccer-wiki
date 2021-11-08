<?php

$u_id = $_POST["u_id"];
$pw = $_POST["pw"];

if ($u_id == NULL) {
    echo "<script language='javascript'>
        alert('아이디를 입력하세요.');
        history.back();
    </script>";
    exit();
}

if ($pw == NULL) {
    echo "<script language='javascript'>
        alert('비밀번호를 입력하세요.');
        history.back();
    </script>";
    exit();
}

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM user WHERE u_id='$u_id' and password='$pw'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    session_start();
    $_SESSION["u_id"] = $u_id;
    if (isset($_SESSION["u_id"])) {
        header("Location: main.php");
    }
    else {
        echo "<script language='javascript'>
            alert('세션 생성 실패');
            history.back();
        </script>";
        exit();
    }
}
else {
    echo "<script language='javascript'>
        alert('아이디와 비밀번호를 확인하세요.');
        history.back();
    </script>";
    exit();
}