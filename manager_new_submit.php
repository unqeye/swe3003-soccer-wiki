<?php

$m_id = $_POST["m_id"];
if (empty($m_id)) {
    echo "<script language='javascript'>
        alert('고유번호를 입력하세요');
        history.back();
    </script>";
    exit();
}
$m_fname = $_POST["m_fname"];
if (empty($m_fname)) {
    echo "<script language='javascript'>
        alert('이름을 입력하세요');
        history.back();
    </script>";
    exit();
}
$m_lname = $_POST["m_lname"];
if (empty($m_lname)) {
    echo "<script language='javascript'>
        alert('성을 입력하세요');
        history.back();
    </script>";
    exit();
}
$m_birthdate = $_POST["m_birthdate"];
if (empty($m_birthdate)) $m_birthdate = null;
$c_id = $_POST["c_id"];
if (empty($c_id)) {
    echo "<script language='javascript'>
        alert('국적을 선택하세요');
        history.back();
    </script>";
    exit();
}
$t_id = $_POST["t_id"];
if (empty($t_id)) $t_id = null;
$m_until = $_POST["m_until"];
if (empty($m_until)) $m_until = null;

$mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
mysqli_set_charset($mysqli, "utf8");

$check = "SELECT * FROM manager WHERE m_id='$m_id'";
$result = $mysqli->query($check);
if ($result->num_rows != 0) {
    echo "<script language='javascript'>
        alert('이미 등록된 감독입니다.');
        history.back();
    </script>";
    exit();
}

$stmt1 = $mysqli->prepare("INSERT INTO manager VALUES (?, ?, ?, ?, ?, ?);");
$stmt1->bind_param("isssii", $m_id, $m_fname, $m_lname, $m_birthdate, $c_id, $m_until);
$new1 = $stmt1->execute();
if ($new1) {
    if (empty($t_id)) {
        echo "<script language='javascript'>
            alert('등록 성공');
            location.href='manager_info.php?m_id=" . $m_id . "'" .
        "</script>";
        exit();
    }
    else {
        $stmt2 = $mysqli->prepare("UPDATE manager SET m_until=NULL WHERE m_id=(SELECT m_id FROM team WHERE t_id=? and m_id!=?)");
        $stmt2->bind_param("ii", $t_id, $m_id);
        $new2 = $stmt2->execute();
        if ($new2) {
            $stmt3 = $mysqli->prepare("UPDATE team SET m_id=NULL WHERE m_id=?");
            $stmt3->bind_param("i", $m_id);
            $new3 = $stmt3->execute();
            if ($new3) {
                $stmt4 = $mysqli->prepare("UPDATE team SET m_id=? WHERE t_id=?");
                $stmt4->bind_param("ii", $m_id, $t_id);
                $new4 = $stmt4->execute();
                if ($new4) {
                    echo "<script language='javascript'>
                        alert('등록 성공');
                        location.href='manager_info.php?m_id=" . $m_id . "'" .
                    "</script>";
                    exit();
                }
                else {
                    echo "<script language='javascript'>
                        alert('등록 실패');
                        history.back();
                    </script>";
                    exit();
                }
            }
            else {
                echo "<script language='javascript'>
                    alert('등록 실패');
                    history.back();
                </script>";
                exit();
            }
        }
        else {
            echo "<script language='javascript'>
                alert('등록 실패');
                history.back();
            </script>";
            exit();
        }
    }
}
else {
    echo "<script language='javascript'>
        alert('등록 실패');
        history.back();
    </script>";
    exit();
}