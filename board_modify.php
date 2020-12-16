<?
    session_save_path("./cookie_value/");
    session_start();
    header("Content-Type: text/html; charset=UTF-8;");
?>
<?php
    $conn = mysqli_connect('localhost', 'root', 'tmdgns12', 'think');
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
        <?php
            $sql = "SELECT * FROM think_board WHERE id={$_GET['idx']}";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if(empty($row)){
                echo "<script>alert('내용이 없습니다.');history.back(-1);</script>";
                exit();
            }
            
        ?>
        <div>
            <span>author:<?=$row['autor'];?></span><span>Date:<?=$row['created'];?></span><hr>
            <form action="action.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="mode" value="modify">
                <input type="hidden" name="id" value="<?=$_GET['idx']?>">
                <div><span>Title:</span><input type="text" name="title" value="<?=$row['title']?>"></div><hr>
                <div><span>contents:</span><textarea name="description"><?=$row['description']?></textarea></div><hr>
                <div><span>File:</span>
                <?if(!empty($row["file_real"])){ $file_name=iconv('EUC-KR','UTF-8',$row["file_real"])?>
                    <span>[이미 업로드한 파일]<?=$file_name;?></span><hr>
                <?}?>
                <div><input type="file" name="userfile"></div><hr>
                <input type="submit" value="수정하기">
            </form>
            <button onclick="location.href='./board.php'">뒤로</button>
        </div>
    </article>
    <footer><!--비즈니스문의-->
        <div>
        </div>
    </footer>
</body>
</html>