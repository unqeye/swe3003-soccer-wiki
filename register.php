<!DOCTYPE html>
<html>
    <head>
        <title>회원가입 - 축구위키</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="text-align: center">
        <form action="register_submit.php" method="post">
            <div style="margin: 10px;">
                <input type="text"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       name="u_id"
                       placeholder="아이디"/>
            </div>
            <div style="margin: 10px;">
                <input type="password"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       name="pw1"
                       placeholder="비밀번호"/>
            </div>
            <div style="margin: 10px;">
                <input type="password"
                       style="border: 0px; width: 250px; padding: 10px; font-size: 20px; text-align: center; background-color: #D3D3D3;"
                       name="pw2"
                       placeholder="비밀번호 확인"/>
            </div>

            <div style="margin: 10px; margin-top: 20px;">
                <button type="submit"
                        style="border: 0px; width: 170px; padding: 10px; font-size: 20px; background-color: #000080; color: #FFFFFF">
                    회원가입
                </button>
            </div>
        </form>
    </body>
</html>