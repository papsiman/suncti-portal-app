<?php
    session_start();
    if(isset($_SESSION["Alive"])){
        $_SESSION["Alive"] = "";
        header("Location: index.php");
    }
    else{
        header("Location: index.php");
    }
?>