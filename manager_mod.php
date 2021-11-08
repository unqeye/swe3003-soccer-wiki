<!DOCTYPE html>
<html>
    <head>
        <title>감독 수정 - 축구 위키</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="text-align: center">
        <?php
            session_start();
            if (!isset($_SESSION["u_id"]))
                header("Location: login.php");
            $u_id = $_SESSION["u_id"];
            if (strcmp($u_id, "admin")) {
                echo "<script language='javascript'>
                    alert('관리자 권한이 없습니다.');
                    history.back();
                </script>";
            }
            
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
        
        <form action="manager_mod_submit.php" method="post">
            <div style="margin: 10px;">
                <input type="number"
                       name="m_id"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       readonly="readonly"
                       placeholder="고유번호"
                       value="<?php echo $m_id; ?>"/>
            </div>
            <div style="margin: 10px;">
                <input type="text"
                       name="m_fname"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       readonly="readonly"
                       placeholder="이름"
                       value="<?php echo $m_fname; ?>"/>
            </div>
            <div style="margin: 10px;">
                <input type="text"
                       name="p_lname"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       readonly="readonly"
                       placeholder="성"
                       value="<?php echo $m_lname; ?>"/>
            </div>
            <div style="margin: 10px;">
                <input type="date"
                       name="m_birthdate"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="생년월일"
                       value="<?php echo $m_birthdate; ?>"/>
            </div>
            <div style="margin: 10px;">
                <select name="c_id"
                        style="border: 0px; width: 270px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;">
                    <option value="">국적</option>
                    <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM country");
                        while ($row = mysqli_fetch_row($result)) {
                            if ($c_id == $row[0])
                                echo "<option value='" . $row[0] . "' selected>" . $row[1] . "</option>";
                            else
                                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div style="margin: 10px;">
                <select name="t_id"
                        style="border: 0px; width: 270px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;">
                    <option value="">팀</option>
                    <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM team");
                        while ($row = mysqli_fetch_row($result)) {
                            if ($t_id == $row[0])
                                echo "<option value='" . $row[0] . "' selected>" . $row[1] . "</option>";
                            else
                                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div style="margin: 10px;">
                <input type="number"
                       name="m_until"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="계약기간"
                       value="<?php echo $m_until; ?>"/>
            </div>

            <div class="button" style="margin: 10px; margin-top: 20px;">
                <button type="submit"
                        style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                    감독 수정
                </button>
            </div>
        </form>
    </body>
</html>