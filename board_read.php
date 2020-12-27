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
    <link type="text/css" rel="stylesheet" href="./css/board_read.css">
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
        
        <?php
            $sql = "SELECT * FROM think_board WHERE id={$_GET['idx']}";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if(empty($row)){
                echo "<script>alert('내용이 없습니다.');history.back(-1);</script>";
                exit();
            }
            
        ?>

        <h1>Write Page</h1>
        <div>
           <hr>
        </div>

        <div id="board_read">
            <span>author: <?=$row['autor'];?></span>
            <span>Date: <?=$row['created'];?></span>
            <div class="title">
                <span id="title">제목</span>
                <div>
                    <?=$row['title'];?>
                </div>
            </div>
            
            <div class="contents">
                <div>내용</div>
                <div id="textarea">
                    <?=$row['description'];?>
                </div>
            </div>

            <div class="sub_menu">
                <? if(!empty($row["file_real"])){ $file_name=iconv("EUC-KR","UTF-8",$row["file_real"]);?>
                    <div>
                        <div id="File">File</div>
                        <div id="File_contents"><a href="download.php?file=<?=$row["file_real"];?>"><?=$file_name;?></a></div>
                    </div>
                <?}?>

                <div class="submit">
                    <?php
                        if($row['autor'] == $_SESSION['id']){
                            echo "<button onclick=\"location.href='./board_modify.php?idx={$_GET['idx']}'\">수정</button>";
                            echo "<button onclick=\"location.href='./action.php?mode=delete&idx={$_GET['idx']}'\">삭제</button>";
                        }
                    ?>
                    <button onclick="location.href='./board.php'">목록</button>
                </div>
            </div>
        </div>
    </article>
</body>
</html>