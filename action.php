<?
    session_save_path("./cookie_value/");
    session_start();
?>
<?php
    header("Content-Type: text/html; charset=UTF-8;");
    $conn = mysqli_connect('localhost', 'root', 'tmdgns12', 'think');
    $mode = $_REQUEST['mode'];
    
    if(!$conn){
        echo "<script>alert('서버상 문제로 연결이 되지않습니다.');history.back(-1);</script>";
        exit();
    }

    
    if(empty($mode)){
        echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
        exit();
    }else if($mode == "join"){
        $name = $_POST['name'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $password_check = $_POST['password_check'];
        $email = NULL;
        $position = NULL;

        $sql = "
            SELECT id FROM think_member;
        ";
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            if($id == $row['id']){
                echo "<script>alert('중복되는 아이디가 존재합니다.');history.back(-1)</script>";
            }
        }

        if($password !== $password_check){
            echo "<script>alert('입력하신 패스워드가 일치하지 않습니다.');history.back(-1);</script>";
            exit();
        }

        $sql = "
            INSERT INTO think_member(
                name,
                id,
                password,
                email,
                position
            )VALUES(
                '{$name}',
                '{$id}',
                '{$password}',
                '{$email}',
                '{$position}'
            );
        ";
        
        $result = mysqli_query($conn, $sql);
        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('회원가입이 완료되었습니다.');location.href='./login.php';</script>";
        }
    }else if($mode == "login"){
        $id = $_POST['id'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM think_member WHERE id='{$_POST['id']}' and password='{$_POST['password']}';";
        $result = mysqli_query($conn, $sql);
        $row_num = mysqli_num_rows($result);
        if($row_num != 0){
            $row = mysqli_fetch_assoc($result);
            
            
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['password'] = $row['password'];

            echo "<script>location.href='./';</script>";
        }else{
            echo "<script>alert('아이디 혹은 패스워드가 틀렸습니다.');location.href='./login.php'</script>";
            exit();
        }
    }else if($mode == "write"){

        $sql = "INSERT INTO think_board
            (title,description,autor,created,scret_password)
            VALUE
            ('{$_POST['title']}','{$_POST['description']}','{$_SESSION['name']}',NOW(),0); 
        ";

        $result = mysqli_query($conn,$sql);
        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./board.php';</script>";
            exit();
        }
       
    }else if($mode == "modify"){

        $sql = "UPDATE think_board SET title='{$_POST['title']}', description='{$_POST['description']}', created=NOW() WHERE id={$_POST['id']}";
        $result = mysqli_query($conn, $sql);

        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('정상적으로 수정이 완료되었습니다.');location.href='./board.php';</script>";
            exit();
        }
        
    }
?>