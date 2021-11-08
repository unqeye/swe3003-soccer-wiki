<!DOCTYPE html>
<html>
    <head>
        <title>감독 목록 - 축구 위키</title>
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
            $mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
            mysqli_set_charset($mysqli, "utf8");
            
            $result = mysqli_query($mysqli, "SELECT * FROM manager");
        ?>
        
        <center>
            <table style="text-align: center">
                <tbody>
                    <tr>
                        <td><b>고유번호</b></td>
                        <td><b>이름</b></td>
                        <td><b>생년월일</b></td>
                        <td><b>국적</b></td>
                        <td><b>소속팀</b></td>
                        <td><b>계약기간</b></td>
                    </tr>
                    <?php
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td><a href='manager_info.php?m_id=" . $row[0] . "'>";
                                if ($row[4] == 167)
                                    echo $row[2] . $row[1];
                                else
                                    echo $row[1] . " " . $row[2];
                            echo "</a></td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td><a href='country_info.php?c_id=" . $row[4] . "'>";
                                $c_result = mysqli_query($mysqli, "SELECT c_name FROM country WHERE c_id=$row[4]");
                                $c_row = mysqli_fetch_row($c_result);
                                echo "<img src='https://futhead.cursecdn.com/static/img/19/nations/" . $row[4] . ".png' width='auto' height='15'>";
                                echo " " . $c_row[0];
                            echo "</a></td>";
                            $t_result = mysqli_query($mysqli, "SELECT * FROM team WHERE m_id=$row[0]");
                            $t_row = mysqli_fetch_row($t_result);
                            if (empty($t_row))
                                echo "<td></td>";
                            else {
                                echo "<td><a href='team_info.php?t_id=" . $t_row[0] . "'>";
                                    echo "<img src='https://futhead.cursecdn.com/static/img/19/clubs/" . $t_row[0] . ".png' width='auto' height='15'>";
                                    echo " " . $t_row[1];
                                echo "</a></td>";
                            }
                            echo "<td>" . $row[5] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </center>
    </body>
</html>