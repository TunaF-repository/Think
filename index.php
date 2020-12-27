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
    <link type="text/css" rel="stylesheet" href="./css/index1.css">
    <title>Think</title>
</head>
<body >
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

    <nav><!--영상-->
        <div id="nav_list">
            <ul>
                <li><a href="#">소개</a></li>
                <li><a href="#">멤버</a></li>
                <li><a href="#">활동</a></li>
                <li><a href="#">QnA</a></li>
            </ul>
        </div>
        <div id="nav_view">
            <!--
            <video width="100%" height="300px" autoplay loop muted controls>
                <source src=".\file\KakaoTalk_20201207_212109812.mp4" type="video/mp4">
                video Error
            </video>
                -->
        </div>
    </nav>
    <div id='content'>
        <section> <!--게시글 목록-->
            <ul>
                <li><a href="#">공지사항</a></li>
                <li><a href="#">게시글</a></li>
            </ul>
        </section>
        
        <article> <!--게시글 미리보기-->
            <fieldset class="main">
                <legend><a href="#">공지사항</a></legend>
                    <ul>
                        <?php
                            $result = mysqli_query($conn,$sql);
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $count++;
                                if($count > 8) break;
                                echo "<li><a href='./board_read.php?idx={$row['id']}'>{$row['title']}</a></li>";
                            }
                        ?>
                    </ul>
            </fieldset>
            <fieldset class="main_image">
                <legend><a href="#">활동사진</a></legend>
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
                                            echo "<li><img src='./upload/{$final_list}'></li>";
                                        }
                                    }
                                }
                                $i = $i+1;
                            }
                        ?>
                    </ul>
                </div>
            </fieldset>
        </article>
        
        <aside><!--회원정보-->
            <fieldset id="my_page">
                <legend>내 정보</legend>
                    <?php
                        if(!empty($_SESSION['id'])){
                            echo "<img src='./img/tenor.gif'alt='123'>"."<br>"; //회원 프로필 사진
                            echo "<div>"."이름:".$_SESSION['name']."님"."<br>"."</div>";
                            echo "<div>"."직책".":###"."<hr>"."</div>";
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
            <fieldset id="board_list">
                <legend><a href="./board.php">게시글 목록</legend>
            
                <ul>
                    <?php
                        $result = mysqli_query($conn,$sql);
                        $count=0;
                        while($row = mysqli_fetch_assoc($result)){
                            $count++;
                            if($count > 5) break;
                            echo "<li><a href='./board_read.php?idx={$row['id']}'>{$row['title']}</a></li>";
                        }
                    ?>
                </ul>
            </fieldset>
        </aside>
    </div>
    <footer><!--비즈니스문의-->
        <div>
            이메일 : Think@Think.com
        </div>
        <div>
            연락처: Just Think it
        </div>
        <div>
            주소: Think
        </div>
    </footer>
</body>
</html>
