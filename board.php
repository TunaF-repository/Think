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
    <link type="text/css" rel="stylesheet" href="./css/board.css">
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
    <div id="content">
        <section> <!--게시글 목록-->
            <ul>
                <li><a href="#">공지사항</a></li>
                <li><a href="#">게시글</a></li>
            </ul>
        </section>
        <article><!--게시글-->
            <div id="menu_board">
                <div id="write_button">
                    <a href="./board_write.php">Write</a>
                </div>
                <div id="search">
                    <form action="./board.php" method="POST">
                        <select name="option"><option value="board_title">Title</option><option value="board_write">Writer</option></select>
                        <input type="text" name="search" placeholder="Keyword Input">
                        <input type="submit" value="Search">
                    </form>
                </div>
            </div>
            <div id="board">
                <?php
                    $conn = mysqli_connect('localhost', 'root', 'tmdgns12', 'think');
                    $page = $_GET['page'];
                    $sql = "SELECT id,title,description,autor,created,scret_password FROM think_board;";

                    $result = mysqli_query($conn, $sql);
                    $total_article = mysqli_num_rows($result);
                    
                    $view_article = 20;
                    if(!$page)$page=1;
                    $start=$view_article*($page-1);

                    $sql = "SELECT id,title,description,autor,created,scret_password FROM think_board limit {$start}, {$view_article};";
                    $result = mysqli_query($conn, $sql);
                ?>
                    <table>
                        <thead>
                            <th>No</th>
                            <th id="title">Title</th>
                            <th>author</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                                <?php
                                    if(empty($_POST['search'])){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo "<tr>";
                                            echo "<th>".$row['id']."</th>";
                                            echo "<th><a href='./board_read.php?idx={$row['id']}'>".$row['title']."</a></th>";
                                            echo "<th>".$row['autor']."</th>";
                                            echo "<th>".$row['created']."</th>";
                                            echo "</tr>";
                                        }
                                    }else{
                                        if($_POST['option'] == 'board_title'){
                                            $sql = "SELECT id,title,description,autor,created,scret_password FROM think_board WHERE title LIKE '{$_POST['search']}%' limit {$start}, {$view_article};";
                                            $result = mysqli_query($conn,$sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<th>".$row['id']."</th>";
                                                echo "<th><a href='./board_read.php?idx={$row['id']}'>".$row['title']."</a></th>";
                                                echo "<th>".$row['autor']."</th>";
                                                echo "<th>".$row['created']."</th>";
                                                echo "</tr>";
                                            }
                                        }else if($_POST['option'] == 'board_write'){
                                            $sql = "SELECT id,title,description,autor,created,scret_password FROM think_board WHERE autor LIKE '{$_POST['search']}%'limit {$start}, {$view_article};";
                                            $result = mysqli_query($conn,$sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<th>".$row['id']."</th>";
                                                echo "<th><a href='./board_read.php?idx={$row['id']}'>".$row['title']."</a></th>";
                                                echo "<th>".$row['autor']."</th>";
                                                echo "<th>".$row['created']."</th>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    
                                ?>
                        </tbody>
                    </table>
                    <div id="page_list">
                        <?php
                            $total_page = ceil($total_article/$view_article);
                            if($page%10){
                                $start_page = $page-$page%10+1;
                            }else{
                                $start_page = $page-9;
                            }
                            $end_page=$start_page+10;

                            
                            /*이전그룹*//*처음페이지*/
                            if($page!=1){
                                echo "<span class='page_button'><a href='./board.php?page=1'>처음으로</a></span>";
                                $prev_group = $start_page-1;
                                if($prev_group < 1){
                                    $prev_group = 1;
                                }
                                echo "<span class='page_button'><a href='./board.php?page={$prev_group}'>이전</a></span>";
                            }else{
                                echo "<span class='page_button'>처음으로</span>";
                            }
                            
                            /*page리스트*/
                            for($i=$start_page; $i<$end_page; $i++){
                                if($i>$total_page) break;
                                if($page==$i){
                                    echo "<span class='now'>{$i}</span>";
                                }else{
                                    echo "<span class='page_number'><a href='./board.php?page={$i}'>{$i}</a></span>";
                                }
                            }

                            /*다음그룹*/ /*마지막페이지*/
                            if($page!=$total_page){
                                $next_group = $end_page;
                                if($next_group>$total_page){
                                    $next_group = $total_page;
                                }
                                echo "<span class='page_button'><a href='./board.php?page={$next_group}'>다음</a></span>";
                                echo "<span class='page_button'><a href='./board.php?page={$total_page}'>끝으로</a></span>";
                            }else{
                                echo "<span class='page_button'>끝으로</span>";
                            }
                        ?>
                    </div>
            </div>
            
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
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $count++;
                            if($count>5) break; 
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