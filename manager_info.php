<!DOCTYPE html>
<html>
    <head>
        <title>감독 정보 - 축구 위키</title>
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
            $m_id = $_GET["m_id"];
            
            $mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
            mysqli_set_charset($mysqli, "utf8");
            
            $result = mysqli_query($mysqli, "SELECT * FROM manager WHERE m_id=$m_id");
            $row = mysqli_fetch_row($result);
            $m_fname = $row[1];
            $m_lname = $row[2];
            $m_birthdate = $row[3];
            $c_id = $row[4];
            $m_until = $row[5];
            
            $result = mysqli_query($mysqli, "SELECT c_name FROM country WHERE c_id=$c_id");
            $row = mysqli_fetch_row($result);
            $c_name = $row[0];
            
            $result = mysqli_query($mysqli, "SELECT t_id FROM team WHERE m_id=$m_id");
            $row = mysqli_fetch_row($result);
            $t_id = $row[0];
            if (!empty($t_id)) {
                $result = mysqli_query($mysqli, "SELECT t_name FROM team WHERE t_id=$t_id");
                $row = mysqli_fetch_row($result);
                $t_name = $row[0];
            }
            else
                $t_name = null;
        ?>
        
        <center>
            <table style="text-align: center">
                <tbody>
                    <tr>
                        <td rowspan="5">
                            <img src="http://fo4.dn.nexoncdn.co.kr/live/externalAssets/common/managers/heads_staff_<?php echo $m_id; ?>.png" width="auto" height="150">
                        </td>
                        <td>
                            <b>이름</b>
                        </td>
                        <td>
                            <?php
                                if ($c_id == 167)
                                    echo $m_lname . $m_fname;
                                else
                                    echo $m_fname . " " . $m_lname;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>생년월일</b>
                        </td>
                        <td>
                            <?php echo $m_birthdate; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>국적</b>
                        </td>
                        <td>
                            <a href=country_info.php?c_id=<?php echo $c_id; ?>>
                                <img src="https://futhead.cursecdn.com/static/img/19/nations/<?php echo $c_id; ?>.png" width="auto" height="15">
                                <?php echo $c_name; ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>소속팀</b>
                        </td>
                        <?php
                            if (empty($t_id))
                                echo "<td></td>";
                            else {
                                echo "<td><a href='team_info.php?t_id=" . $t_id . "'>";
                                    echo "<img src='https://futhead.cursecdn.com/static/img/19/clubs/" . $t_id . ".png' width='auto' height='15'>";
                                    echo " " . $t_name;
                                echo "</a></td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <b>계약기간</b>
                        </td>
                        <td>
                            <?php echo $m_until; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
        
        <div style="text-align: center; margin: 10px;">
            <button onclick="location.href='manager_mod.php?m_id=<?php echo $m_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                수정
            </button>
            <button onclick="location.href='manager_del.php?m_id=<?php echo $m_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                삭제
            </button>
        </div>
    </body>
</html>