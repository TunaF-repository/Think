<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Think_login</title>
</head>
<body>
    <div>Login Page</div>
    <div>
        <form action="./action.php" method="POST">
            <input type="hidden" name="mode" value="login">
            <input type="text" name="id" placeholder="ID" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="로그인"><br>
        </form>
    </div>
    <div>
        <ul>
            <li><a href="">아이디/패스워드 찾기</a></li>
            <li><a href=".\join.php" target="_blank">회원가입</a></li>
        </ul>
    </div>
</body>
</html>