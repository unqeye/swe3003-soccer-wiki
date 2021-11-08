<!DOCTYPE html>
<html>
    <head>
        <title>관심선수 목록 - 축구 위키</title>
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
            
            $result = mysqli_query($mysqli, "SELECT * FROM favorite WHERE u_id='$u_id'");
        ?>
        
        <center>
            <table style="text-align: center">
                <tbody>
                    <tr>
                        <td><b>고유번호</b></td>
                        <td><b>이름</b></td>
                        <td><b>메모</b></td>
                    </tr>
                    <?php
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td><a href='player_info.php?p_id=" . $row[1] . "'>";
                                $p_result = mysqli_query($mysqli, "SELECT * FROM player WHERE p_id=$row[1]");
                                $p_row = mysqli_fetch_row($p_result);
                                if ($p_row[7] == 167)
                                    echo $p_row[2] . $p_row[1];
                                else
                                    echo $p_row[1] . " " . $p_row[2];
                            echo "</a></td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td><a href='favorite_del.php?p_id=" . $row[1] . "'>삭제</a></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </center>
    </body>
</html>