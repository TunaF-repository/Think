<?
    session_save_path("./cookie_value/");
    session_start();
    header("Content-Type: text/html; charset=UTF-8;");
?>
<?php
    if(empty($_SESSION['id'])){
        echo "<script>alert('로그인이 되어 있지 않습니다.');location.href='./login.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/board_write.css">
    <title>think</title>
</head>
<body>
    <header>
        <!--Think!-->
        <a href="./index.php">Think</a>
        
        <div id="top_list"> <!--상단 메뉴 페이지-->
            <ul>
                <li><a href="./">HOME</a></li>
                <li><a href=""><?php
                    if(!empty($_SESSION['id'])){
                        echo "<a href=\"./logout.php\">logout</a>";
                    }else{
                        echo "<a href=\"./login.php\">login</a>";
                    }
                ?></a></li>
                <li><a href="./join.php">join</a></li>
            </ul>
        </div>
    </header>

    <article><!--게시글-->
        <h1>Write Page</h1>
        <div>
           <hr>
        </div>
        <div>
            <form action="action.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="mode" value="write">
                <div class="title">
                    <span>제목</span>
                    <input type="text" name="title" required>
                </div>
                
                <div class="contents">
                    <div>내용</div>
                    <textarea name="description" required></textarea>
                </div>
                <div class="sub_menu">
                    <div>File</div>
                    <input type="file" name="userfile"><br>
                    <div class="submit">
                        <input type="submit" value="Write">
                    </div>
                </div>
            </form>
        </div>
    </article>
</body>
</html>