﻿<!DOCTYPE html>
<html>
    <head>
        <title>리그 정보 - 축구 위키</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php            
            session_start();
            if (!isset($_SESSION["u_id"]))
                header("Location: login.php");
            $u_id = $_SESSION["u_id"];
        ?>
        
        <div style="text-align: right">
            <b><?php echo $u_id; ?>님 환영합니다.</b>
            <a href=logout.php>로그아웃</a>
        </div>
        
        <div style="text-align: center; margin: 10px; margin-bottom: 30px">
            <button onclick="location.href='main.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                메인
            </button>
            <button onclick="location.href='country_list.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                국가 목록
            </button>
            <button onclick="location.href='league_list.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                리그/팀 목록
            </button>
            <button onclick="location.href='manager_list.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                감독 목록
            </button>
            <button onclick="location.href='player_list.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                선수 목록
            </button>
            <button onclick="location.href='favorite_list.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                관심선수 목록
            </button>
            <button onclick="location.href='player_search.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                선수 검색
            </button>
        </div>
        
        <?php
            $l_id = $_GET["l_id"];
            
            $mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
            mysqli_set_charset($mysqli, "utf8");
            
            $result = mysqli_query($mysqli, "SELECT l_name FROM league WHERE l_id=$l_id");
            $row = mysqli_fetch_row($result);
            $l_name = $row[0];
            
            $result = mysqli_query($mysqli, "SELECT * FROM team WHERE l_id=$l_id");
        ?>
        
        <div style="text-align: center">
            <img src="https://futhead.cursecdn.com/static/img/19/leagues/<?php echo $l_id ?>.png" width="100px" height="auto"><br/>
            <b><?php echo $l_name; ?></b><br/>
            <br/>
        </div>
        <center>
            <table style="text-align: center">
                <tbody>
                    <tr>
                        <td><b>고유번호</b></td>
                        <td><b>이름</b></td>
                        <td><b>감독</b></td>
                    </tr>
                    <?php
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td><a href='team_info.php?t_id=" . $row[0] . "'>";
                                echo "<img src='https://futhead.cursecdn.com/static/img/19/clubs/" . $row[0] . ".png' width='auto' height='15'>";
                                echo " " . $row[1];
                            echo "</a></td>";
                            if (empty($row[3]))
                                echo "<td></td>";
                            else {
                                echo "<td><a href='manager_info.php?m_id=" . $row[3] . "'>";
                                    $m_result = mysqli_query($mysqli, "SELECT * FROM manager WHERE m_id=$row[3]");
                                    $m_row = mysqli_fetch_row($m_result);
                                    if ($m_row[4] == 167)
                                        echo $m_row[2] . $m_row[1];
                                    else
                                        echo $m_row[1] . " " . $m_row[2];
                                echo "</a></td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </center>
    </body>
</html>