<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>

<?php

    // if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['createUsername']))
    // {
    //     func();
    // }

    func();

    function func()
    {
        require_once "../config.php";

        //Validate duplicate data
        $id = $_POST['editUserId'];
        $username = $_POST['editUsername'];
        $password = $_POST['editPassword'];
        $role = $_POST['editRole'];

        //Encrypt Password
        if($password){
            $hash = password_hash($password,  PASSWORD_DEFAULT);
        }
        
        $sql = "SELECT * FROM `users` WHERE Username='".$username."' AND Id != ".$id;
        $users = $conn->query($sql);
        $cntUser = $users->num_rows;

        //Insert data
        if($cntUser == 0) {
            if(!$password){
                $sql = "UPDATE users SET Username='".$username."', Role='".$role."' WHERE Id = ".$id;
                $conn->query($sql);
            }
            else{
                $sql = "UPDATE users SET Username='".$username."', Role='".$role."', Password='".$hash."' WHERE Id = ".$id;
                $conn->query($sql);
            }
            successModal();
        }
        else{
            failModal();
        }
    }

    function successModal(){
        echo '
        <button id="btnOpen" class="btn hidden" onclick="my_modal_1.showModal()">open modal</button>
        <dialog id="my_modal_1" class="modal">
        <div class="modal-box bg-green-200 text-green-500">
            <h3 class="text-lg font-bold">Successfully!</h3>
            <p class="py-4">Update user success.</p>
            <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button id="btnClose" class="btn bg-green-500 text-white w-28">Close</button>
            </form>
            </div>
        </div>
        </dialog>
        <script>
            $(document).ready(function(){

                $("#btnOpen").click();

                $("#btnClose").click(function(){
                    window.location.replace("../users.php");
                });
                
            });
        </script>
        ';
    }

    function failModal(){
        echo '
        <button id="btnOpen" class="btn hidden" onclick="my_modal_1.showModal()">open modal</button>
        <dialog id="my_modal_1" class="modal">
        <div class="modal-box bg-red-200 text-red-500">
            <h3 class="text-lg font-bold">Fail!</h3>
            <p class="py-4">Duplicate username. Please try again.</p>
            <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button id="btnClose" class="btn bg-red-500 text-white">Close</button>
            </form>
            </div>
        </div>
        </dialog>
        <script>
            $(document).ready(function(){

                $("#btnOpen").click();

                $("#btnClose").click(function(){
                    window.location.replace("../users.php");
                });
                
            });
        </script>
        ';
    }

    ?>

</body>
</html>