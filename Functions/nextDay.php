<?php
    session_start();
    $_SESSION['diaryDate'] = $_SESSION['diaryDate'] + 1;

    // Redirect to the diary reader
    header("Location: ../Diary/readDiary.php");
?>