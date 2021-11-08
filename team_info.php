<!DOCTYPE html>
<html>
    <?php            
        $t_id = $_GET["t_id"];

        $mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
        mysqli_set_charset($mysqli, "utf8");

        $result = mysqli_query($mysqli, "SELECT * FROM team WHERE t_id=$t_id");
        $row = mysqli_fetch_row($result);
        $t_name = $row[1];
        $l_id = $row[2];
        $m_id = $row[3];
        
        $result = mysqli_query($mysqli, "SELECT l_name FROM league WHERE l_id=$l_id");
        $row = mysqli_fetch_row($result);
        $l_name = $row[0];
        
        $result = mysqli_query($mysqli, "SELECT * FROM manager WHERE m_id=$m_id");
        if (!empty($result)) {
            $row = mysqli_fetch_row($result);
            if ($row[4] == 167)
                $m_name = $row[2] . $row[1];
            else
                $m_name = $row[1] . " " . $row[2];
        }
        
        $result = mysqli_query($mysqli, "SELECT * FROM player WHERE t_id=$t_id");
    ?>
    <head>
        <title><?php echo $t_name; ?> - 축구 위키</title>
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
        
        <div style="text-align: center">
            <img src="https://futhead.cursecdn.com/static/img/19/clubs/<?php echo $t_id?>.png" width="100px" height="auto"><br/>
            <b><?php echo $t_name; ?></b><br/>
            <br/>
            <a href="league_info.php?l_id=<?php echo $l_id; ?>">
                <img src="https://futhead.cursecdn.com/static/img/19/leagues/<?php echo $l_id ?>.png" width="auto" height="15px">
                <?php echo $l_name; ?>
            </a><br/>
            <b>감독 - </b>
            <?php
                if (empty($m_id))
                    echo "<br/>";
                else
                    echo "<a href='manager_info.php?m_id=" . $m_id . "'>" . $m_name . "</a><br/>";
            ?>
        </div>
        <br/>
        <center>
            <table style="text-align: center">
                <tbody>
                    <tr>
                        <td><b>고유번호</b></td>
                        <td><b>이름</b></td>
                        <td><b>생년월일</b></td>
                        <td><b>포지션</b></td>
                        <td><b>키</b></td>
                        <td><b>몸무게</b></td>
                        <td><b>국적</b></td>
                        <td><b>계약기간</b></td>
                    </tr>
                    <?php
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td><a href='player_info.php?p_id=" . $row[0] . "'>";
                                if ($row[7] == 167)
                                    echo $row[2] . $row[1];
                                else
                                    echo $row[1] . " " . $row[2];
                            echo "</a></td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td>" . $row[6] . "</td>";
                            echo "<td><a href='country_info.php?c_id=" . $row[7] . "'>";
                                $c_result = mysqli_query($mysqli, "SELECT c_name FROM country WHERE c_id=$row[7]");
                                $c_row = mysqli_fetch_row($c_result);
                                echo "<img src='https://futhead.cursecdn.com/static/img/19/nations/" . $row[7] . ".png' width='auto' height='15'>";
                                echo " " . $c_row[0];
                            echo "</a></td>";
                            echo "<td>" . $row[9] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </center>
        
        <div style="text-align: center; margin: 10px; margin-top: 20px">
            <button onclick="location.href='team_mod.php?t_id=<?php echo $t_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                수정
            </button>
            <button onclick="location.href='team_del.php?t_id=<?php echo $t_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                삭제
            </button>
        </div>
    </body>
</html>