<?php
    session_start();
    // Reduce day mod by 1
    $_SESSION['SID'] = $_SESSION['SID'] - 1;

    // Redirect to the diary reader
    header("Location: ../Diary/readDiary.php");
?>