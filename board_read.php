<?
    session_save_path("./cookie_value/");
    session_start();
    header("Content-Type: text/html; charset=UTF-8;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>think</title>
</head>
<body>
    <header>
        <div><!--Think!-->
            <a href="./"><img src="#" width="#" height="#" alt="Think"></a>
        </div>
        <div> <!--상단 메뉴 페이지-->
            <ul>
                <li><a href="./">HOME</a></li>
                <li><a href=""><?php
                    if(!empty($_SESSION['id'])){
                        echo "<a href=\"./logout.php\">로그아웃</a>";
                    }else{
                        echo "<a href=\"./login.php\">로그인</a>";
                    }
                ?></a></li>
                <li><a href="./join.php">회원가입</a></li>
            </ul>
        </div>
    </header>
    <article><!--게시글-->
        <div>
        </div>
    </article>
</body>
</html>