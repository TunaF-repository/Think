<?
    session_save_path("./cookie_value/");
    session_start();
?>
<?
    $conn = mysqli_connect("localhost","root","tmdgns12","think");
    $sql = "SELECT id,title,autor,created FROM think_board;";
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Think</title>
</head>
<body>
    <div>
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

        <header> <!--영상-->
            <video width=1000 height="200" autoplay loop muted controls>
                <source src=".\file\KakaoTalk_20201207_212109812.mp4" type="video/mp4">
                video Error
            </video>
        </header>
        
        <section> <!--게시글 목록-->
            <div>
                <div>
                    <div>
                        <fieldset>
                            <legend><a href="./board.php">게시글 목록</a></legend>
                        
                            <ul>
                                <?php
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<li><a href='./board_read.php?idx={$row['id']}'>{$row['title']}</a></li>";
                                    }
                                ?>
                            </ul>
                        </fieldset>
                    </div>
                </div>
            </div>
        </section>
        
        <article> <!--게시글 미리보기-->
            <div>
                <fieldset>
                    <legend>공지사항</legend>
                        <ul>
                            <?php
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<li><a href='./board_read.php?idx={$row['id']}'>{$row['title']}</a></li>";
                                }
                            ?>
                        </ul>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>활동사진</legend>
                    <div>
                        <ul>
                            
                            <?php
                                $list = scandir("./upload");
                                $i=0;
                                while($i < count($list)){
                                    if($list[$i] != '.'){
                                        if($list[$i] != '..'){
                                            if(preg_match("/.jpg\$/i",$list[$i]) || preg_match("/.png\$/i",$list[$i])){
                                                $final_list = iconv("EUC-KR", "UTF-8", $list[$i]);
                                                echo "<li><img src='./upload/{$final_list}' width='100' highet='100'></li>";
                                            }
                                        }
                                    }
                                    $i = $i+1;
                                }
                            ?>
                        </ul>
                    </div>
                </fieldset>
            </div>
        </article>
        
        <aside><!--회원정보-->
            <div>
                <fieldset>
                    <legend>My Page</legend>
                        <?php
                            if(!empty($_SESSION['id'])){
                                echo "<img src='./img/tenor.gif' width='100' height='100' alt='123'>"."<br>"; //회원 프로필 사진
                                echo "이름:".$_SESSION['name']."님"."<br>";
                                echo "직책".":###"."<hr>";
                                echo "<a href=\"./write.php\">게시글 작성</a>"."<br>";
                                echo "<a href=\"./my_writing_list.php\">내 글 목록</a>"."<br>";
                                echo "<a href=\"./cloud.php\">내 클라우드</a>"."<hr>";
                                echo "<a href=\"./advise_account.php\">내 정보</a>"."<br>";
                                echo "<a href=\"./logout.php\">로그아웃</a>"."<br>";
                            }else{
                                echo "<a href=\"./login.php\">로그인</a>";
                            }
                        ?>
                </fieldset>
            </div>
        </aside>
        
        <footer><!--비즈니스문의-->
            <div>
            </div>
        </footer>
    </div>
</body>
</html>
