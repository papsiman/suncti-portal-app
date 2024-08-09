<?php
    session_start();

    if(isset($_SESSION["Alive"])){
        if($_SESSION["Alive"] == 'Alive'){
            echo 'True';
        }
    }
    
?>