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
        $id = $_POST['id'];

        $sql = "DELETE FROM users WHERE Id = ".$id;
        $conn->query($sql);
    }

    function successModal(){
        echo '
        <button id="btnOpen" class="btn hidden" onclick="my_modal_1.showModal()">open modal</button>
        <dialog id="my_modal_1" class="modal">
        <div class="modal-box bg-green-200 text-green-500">
            <h3 class="text-lg font-bold">Successfully!</h3>
            <p class="py-4">Delete user success.</p>
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
            <p class="py-4">Delete user fail. Please try again.</p>
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
