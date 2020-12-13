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
            <div>
                <a href="./board_write.php">Write</a>
            </div>
            
            <div>
                <?php
                    $conn = mysqli_connect('localhost', 'root', 'tmdgns12', 'think');
                    $sql = "SELECT id,title,description,autor,created,scret_password FROM think_board;";

                    $result = mysqli_query($conn, $sql);?>
                    <table>
                        <thead>
                            <th>No</th>
                            <th>Title</th>
                            <th>author</th>
                            <th>Date</th>
                        </thead>
                        <tody>
                                <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<tr>";
                                        echo "<th>".$row['id']."</th>";
                                        echo "<th><a href='./board_read.php?idx={$row['id']}'>".$row['title']."</a></th>";
                                        echo "<th>".$row['autor']."</th>";
                                        echo "<th>".$row['created']."</th>";
                                        echo "</tr>";
                                    }
                                ?>
                        </tody>
                    </table>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        var_dump($row);
                    }
                ?>
            </div>
            
            <div>
                <form action="keyword_search.php" method="POST">
                    <select><option>ALL</option><option>Title</option><option>Writer</option></select>
                    <input type="text" placeholder="Keyword Input">
                    <input type="submit" value="Seacher">
                </form>
                
            </div>
        </div>
        
    </article>
</body>
</html>