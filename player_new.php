<!DOCTYPE html>
<html>
    <head>
        <title>선수 등록 - 축구 위키</title>
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
                exit();
            }
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
        ?>
        
        <form action="player_new_submit.php" method="post">
            <div style="margin: 10px;">
                <input type="number"
                       name="p_id"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="고유번호"/>
            </div>
            <div style="margin: 10px;">
                <input type="text"
                       name="p_fname"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="이름"/>
            </div>
            <div style="margin: 10px;">
                <input type="text"
                       name="p_lname"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="성"/>
            </div>
            <div style="margin: 10px;">
                <input type="date"
                       name="p_birthdate"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="생년월일"/>
            </div>
            <div style="margin: auto; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;">
                <input type="radio" name="position" value="" style="display: none" checked>
                <input type="radio" name="position" value="GK">GK
                <input type="radio" name="position" value="DF">DF
                <input type="radio" name="position" value="MF">MF
                <input type="radio" name="position" value="FW">FW
            </div>
            <div style="margin: 10px;">
                <input type="number"
                       name="height"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="키 (cm)"/>
            </div>
            <div style="margin: 10px;">
                <input type="number"
                       name="weight"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="몸무게 (kg)"/>
            </div>
            <div style="margin: 10px;">
                <select name="c_id"
                        style="border: 0px; width: 270px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;">
                    <option value="" selected>국적</option>
                    <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM country");
                        while ($row = mysqli_fetch_row($result))
                            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                    ?>
                </select>
            </div>
            <div style="margin: 10px;">
                <select name="t_id"
                        style="border: 0px; width: 270px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;">
                    <option value="" selected>팀</option>
                    <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM team");
                        while ($row = mysqli_fetch_row($result))
                            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                    ?>
                </select>
            </div>
            <div style="margin: 10px;">
                <input type="number"
                       name="p_until"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="계약기간"/>
            </div>

            <div class="button" style="margin: 10px; margin-top: 20px;">
                <button type="submit"
                        style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                    선수 등록
                </button>
            </div>
        </form>
    </body>
</html>