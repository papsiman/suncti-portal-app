<?php
    session_start();

    $_SESSION["Alive"] = "Alive";
    $_SESSION['CREATED'] = time();
    header("Location: ../ipbx-trunk.php");
    
?>