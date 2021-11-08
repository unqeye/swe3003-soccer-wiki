<!DOCTYPE html>
<html>
    <head>
        <title>선수 정보 - 축구 위키</title>
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
            $p_id = $_GET["p_id"];
            
            $mysqli = mysqli_connect("localhost", "root", "1234", "webdb");
            mysqli_set_charset($mysqli, "utf8");
            
            $result = mysqli_query($mysqli, "SELECT * FROM player WHERE p_id=$p_id");
            $row = mysqli_fetch_row($result);
            $p_fname = $row[1];
            $p_lname = $row[2];
            $p_birthdate = $row[3];
            $position = $row[4];
            $height = $row[5];
            $weight = $row[6];
            $c_id = $row[7];
            $t_id = $row[8];
            $p_until = $row[9];
            
            $result = mysqli_query($mysqli, "SELECT c_name FROM country WHERE c_id=$c_id");
            $row = mysqli_fetch_row($result);
            $c_name = $row[0];
            
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
                            <img src="https://futhead.cursecdn.com/static/img/19/players/<?php echo $p_id; ?>.png" width="auto" height="150">
                        </td>
                        <td>
                            <b>이름</b>
                        </td>
                        <td>
                            <?php
                                if ($c_id == 167) {
                                    echo $p_lname;
                                    echo $p_fname;
                                }
                                else {
                                    echo $p_fname;
                                    echo " ";
                                    echo $p_lname;
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>생년월일</b>
                        </td>
                        <td>
                            <?php echo $p_birthdate; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>포지션</b>
                        </td>
                        <td>
                            <?php echo $position; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>키</b>
                        </td>
                        <td>
                            <?php echo $height; ?> cm
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>몸무게</b>
                        </td>
                        <td>
                            <?php echo $weight; ?> kg
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>국적</b>
                        </td>
                        <td>
                            <b>소속팀</b>
                        </td>
                        <td>
                            <b>계약기간</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href=country_info.php?c_id=<?php echo $c_id; ?>>
                                <img src="https://futhead.cursecdn.com/static/img/19/nations/<?php echo $c_id; ?>.png" width="auto" height="15">
                                <?php echo $c_name; ?>
                            </a>
                        </td>
                        <td>
                            <?php
                                if (!empty($t_name)) {
                                    echo "<a href=team_info.php?t_id=" . $t_id . ">";
                                    echo "<img src='https://futhead.cursecdn.com/static/img/19/clubs/" . $t_id . ".png' width='auto' height='15'>";
                                    echo " " . $t_name;
                                    echo "</a>";
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo $p_until; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
        
        <div style="text-align: center; margin: 10px; margin-top: 20px">
            <button onclick="location.href='player_mod.php?p_id=<?php echo $p_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                수정
            </button>
            <button onclick="location.href='player_del.php?p_id=<?php echo $p_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                삭제
            </button>
            <button onclick="location.href='favorite_new.php?p_id=<?php echo $p_id; ?>'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                관심선수 등록
            </button>
        </div>
    </body>
</html>