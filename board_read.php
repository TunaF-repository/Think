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
            <div><span>Title:</span><?=$row['title'];?></div><hr>
            <div><span>contents:</span><?=$row['description'];?></div><hr>
            <? if(!empty($row["file_real"])){ $file_name=iconv("EUC-KR","UTF-8",$row["file_real"]);?>
                <div><span>File:</span><span><a href="download.php?file=<?=$row["file_real"];?>"><?=$file_name;?></a></span></div><hr>
            <?}?>
            
            <?php
                if($row['autor'] == $_SESSION['id']){
                    echo "<button onclick=\"location.href='./board_modify.php?idx={$_GET['idx']}'\">수정</button>";
                    echo "<button onclick=\"location.href='./action.php?mode=delete&idx={$_GET['idx']}'\">삭제</button>";
                }
            ?>
            <button onclick="location.href='./board.php'">목록</button>
        </div>
    </article>
    <footer><!--비즈니스문의-->
        <div>
        </div>
    </footer>
</body>
</html>