<?php
    session_start();
    $_SESSION['SID'] = $_SESSION['SID'] + 1;

    // Redirect to the diary reader
    header("Location: ../Diary/readDiary.php");
?>