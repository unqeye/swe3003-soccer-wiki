<?php

$m_id = $_POST["m_id"];
if (empty($m_id)) {
    echo "<script language='javascript'>
        alert('고유번호를 입력하세요');
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

$stmt1 = $mysqli->prepare("UPDATE manager SET "
        . "m_birthdate=?, "
        . "c_id=?, "
        . "m_until=? "
        . "WHERE m_id=?");
$stmt1->bind_param("siii", $m_birthdate, $c_id, $m_until, $m_id);
$mod1 = $stmt1->execute();
if ($mod1) {
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
        $mod2 = $stmt2->execute();
        if ($mod2) {
            $stmt3 = $mysqli->prepare("UPDATE team SET m_id=NULL WHERE m_id=?");
            $stmt3->bind_param("i", $m_id);
            $mod3 = $stmt3->execute();
            if ($mod3) {
                $stmt4 = $mysqli->prepare("UPDATE team SET m_id=? WHERE t_id=?");
                $stmt4->bind_param("ii", $m_id, $t_id);
                $mod4 = $stmt4->execute();
                if ($mod4) {
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