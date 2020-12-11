<?php
    session_save_path("./cookie_value/");
    session_start();

    session_destroy();
    echo "<script>location.href='./';</script>";
?>