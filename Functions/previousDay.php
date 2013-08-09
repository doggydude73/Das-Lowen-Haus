<?php
    session_start();
    // Reduce day mod by 1
    $_SESSION['diaryDate'] = $_SESSION['diaryDate'] - 1;

    // Redirect to the diary reader
    header("Location: ../Diary/readDiary.php");
?>