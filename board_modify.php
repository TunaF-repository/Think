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
    <link type="text/css" rel="stylesheet" href="./css/board_modify.css">
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
        <h1>Modify Page</h1>
        <div>
           <hr>
        </div>

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
            <form action="action.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="mode" value="modify">
                <input type="hidden" name="id" value="<?=$_GET['idx']?>">

                <div class="title">
                    <span>제목</span>
                    <input type="text" name="title" value="<?=$row['title']?>" required>
                </div>

                <div class="contents">
                    <div>내용</div>
                    <textarea name="description" required><?=$row['description']?></textarea>
                </div>

                <div class="sub_menu">
                    <?if(!empty($row["file_real"])){ $file_name=iconv('EUC-KR','UTF-8',$row["file_real"])?>
                        <hr><span>[이미 업로드한 파일]<?=$file_name;?></span><hr>
                    <?}?>
                    <div>File</div>
                    <div class="file"><input type="file" name="userfile"></div><hr>
                    
                    <div class="submit">
                        <input type="submit" value="수정하기">
                    </div>
                </div>                
            </form>
            <button onclick="location.href='./board.php'">뒤로가기</button>
        </div>
    </article>
</body>
</html>