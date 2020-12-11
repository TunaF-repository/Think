<?
    session_save_path("./cookie_value/");
    session_start();
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
                <li><a href="/think">HOME</a></li>
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
                <form action="./board_write.php" method="GET">
                    <button name="mode" value="write">Write</button>
                </form>
            </div>
            <div>
                <table border="1">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                        </tr>
                        <tr>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                        </tr>
                        <tr>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                            <td>aaaaa</td>
                        </tr>
                    </tbody>
                </table>
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