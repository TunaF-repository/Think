<?
    session_save_path("./cookie_value/");
    session_start();
?>
<?php
    if(!empty($_SESSION['id'])){
        echo "<script>alert('로그인이 되어 있지 않습니다.');location.href='./login.php';</script>";
        exit();
    }
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
        </div>
    </header>
    <article><!--게시글-->
        <div>
            <h1>Write Page</h1><hr>
        </div>
        <form action="action.php" method="POST">
            <input type="hidden" name="mode" value="write">
            <div>Title</div><input type="text" name="title" placeholder="Title Input" required><br>
            <div>Contents</div><textarea name="description" placeholder="Description Input" required></textarea><br>
            <div>File</div><input type="file" name="userfile"><hr>
            <input type="checkbox" name="secret" value=1>Secret writing<br>
            <input type="submit" value="Write">
        </form>
    </article>
</body>
</html>