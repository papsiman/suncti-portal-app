<?php
    session_start();
    if(isset($_SESSION["Alive"])){
        $_SESSION["Alive"] = "";
        $_SESSION["Role"] = '';
        header("Location: index.php");
    }
    else{
        header("Location: index.php");
    }
?>