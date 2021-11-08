<!DOCTYPE html>
<html>
    <head>
        <title>로그인 - 축구위키</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="text-align: center">
        <form action="login_submit.php" method="post">
            <div style="margin: 10px;">
                <input type="text"
                       name="u_id"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="아이디"/>
            </div>
            <div style="margin: 10px">
                <input type="password"
                       name="pw"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       placeholder="비밀번호"/>
            </div>

            <div style="margin: 10px; margin-top: 20px;">
                <button type="submit"
                        style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                    로그인
                </button>
            </div>
        </form>
        
        <div style="margin: 10px;">
            <button onclick="location.href='register.php'"
                    style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                회원가입
            </button>
        </div>
    </body>
</html>