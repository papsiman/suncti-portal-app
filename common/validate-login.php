<?php
    session_start();
    require_once "../config.php";
    

    $sql = "SELECT * FROM users WHERE Username='".$_POST['username']."'";
    $users = $conn->query($sql);

    if($users->num_rows > 0){
        $user = $users->fetch_assoc();
        $verify = password_verify($_POST['password'], $user['Password']);
        if($verify){
            $_SESSION["Alive"] = "Alive";
            $_SESSION['CREATED'] = time();
            header("Location: ../ipbx-trunk.php");
        }
        else{
            $_SESSION['error'] = 'Login fail. password not match.';

            $_SESSION["Alive"] = "";
            header("Location: ../index.php");

            // $_SESSION["Alive"] = "Alive";
            // $_SESSION['CREATED'] = time();
            // header("Location: ../ipbx-trunk.php");
        }
    }
    else{
        $_SESSION['error'] = 'Login fail. user not found.';

        $_SESSION["Alive"] = "";
        header("Location: ../index.php");

        // $_SESSION["Alive"] = "Alive";
        // $_SESSION['CREATED'] = time();
        // header("Location: ../ipbx-trunk.php");
    }
?>