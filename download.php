<?
    header("Content-Type: text/html; charset=UTF-8");
    $upload_path = "./upload";
    $file = $_GET["file"];

    if(empty($file)){
        echo "<script>alert('잘못된 접근이거나 파일 다운로드 실패');history.back(-1);</script>";
        exit();
    }

    $filepath = "{$upload_path}/{$file}";
    
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$file}");

    readfile($filepath);
?>