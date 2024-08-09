<?php
    require_once "config.php";
    require_once "common/session-ctl.php";

    if(isset($_SESSION["Alive"])){
        if($_SESSION["Alive"] != "Alive"){
            header("Location: index.php");
        }
    }
    else{
        header("Location: index.php");
    }

    $sql = "SELECT * FROM users ORDER BY Username";
    $users = $conn->query($sql);

?>

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
<body class="bg-base-200">
    <div>
        <?php include 'header.php';?>
        <div class="drawer xl:drawer-open">
            <!-- content -->
            <input id="drawer-leftmenu" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content min-h-[calc(100vh-68px)]">
                <!-- Header -->
                <div class="bg-white m-5 p-5 rounded-md">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="text-2xl font-semibold">Users</h1>
                        <?php
                            if($_SESSION["Role"]=='Admin'){
                                echo '<label id="btnAddNewuser" for="my_modal_1" class="btn btn-sm bg-orange-700 text-white"><i class="fa-solid fa-plus"></i> Add</label>';
                            }
                        ?>
                        <!-- Modal new user -->
                        <input type="checkbox" id="my_modal_1" class="modal-toggle" />
                        <div class="modal" role="dialog">
                            <div class="modal-box">
                                <div class="flex flex-col justify-center px-6 py-6 lg:px-8">
                                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                        <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create user</h2>
                                    </div>
                                    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                                        <a id="btnCloseModalAddUser" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>
                                        <form class="space-y-6" action="common/create-user.php" method="POST" enctype="multipart/form-data">
                                                <div>
                                                    <label for="createUsername" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                                    <div class="mt-2">
                                                        <input id="createUsername" name="createUsername" type="username" placeholder="username" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <label for="createPassword" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input id="createPassword" name="createPassword" type="password" placeholder="password" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <label for="createConfirmPassword" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input id="createConfirmPassword" name="createConfirmPassword" type="password" placeholder="password" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                    <span id='messageConfirmPasswordCreateUser'></span>
                                                </div>
                                                <div>
                                                    <label for="createRole" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                                                    <div class="mt-2">
                                                        <select id="createRole" name="createRole" class="select select-bordered w-full" required>
                                                            <option disabled selected value="">Please select</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="User">User</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button id="btnSubmitCreateUser" type="submit" class="flex w-full justify-center rounded-md bg-orange-700 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <label class="modal-backdrop" for="my_modal_1">Close</label>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="bg-white mx-5 my-0 p-5 rounded-md">
                    <div>
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr class="text-xl">
                                    <th>Actions</th>
                                    <th>Username</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if ($users->num_rows > 0) {
                                        // output data of each row
                                        while($user = $users->fetch_assoc()) {
                                            $btnAction = '
                                                <div class="dropdown">
                                                    <div tabindex="0" role="button" class="btn btn-sm bg-orange-700 text-white m-1">Action</div>
                                                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                                                        <li><a class="btnEditUser" data-id="'.$user['Id'].'" data-user="'.$user['Username'].'" data-role="'.$user['Role'].'">Edit</a></li>
                                                        <li><a class="btnDeleteUser" data-id="'.$user['Id'].'" data-user="'.$user['Username'].'">Delete</a></li>
                                                    </ul>
                                                </div>
                                            ';

                                            echo '
                                                <tr class="hover:bg-base-200 text-xl">
                                                    <th>
                                                        '.($_SESSION["Role"]=='Admin' ? $btnAction : '').'
                                                    </th>
                                                    <td>'.$user['Username'].'</td>
                                                    <td>'.$user['Role'].'</td>
                                                </tr>
                                            ';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal edit user -->
                    <div>
                        <label id="btnModalEditUser" for="my_modal_2" class="btn hidden"></label>
                        <input type="checkbox" id="my_modal_2" class="modal-toggle" />
                        <div class="modal" role="dialog">
                            <div class="modal-box">
                                <div class="flex flex-col justify-center px-6 py-6 lg:px-8">
                                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                        <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit user</h2>
                                    </div>
                                    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                                        <a id="btnCloseModalEditUser" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>
                                        <form class="space-y-6" action="common/update-user.php" method="POST" enctype="multipart/form-data">
                                            <input id="editUserId" name="editUserId" type="text" class="hidden">
                                                <div>
                                                    <label for="editUsername" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                                    <div class="mt-2">
                                                        <input id="editUsername" name="editUsername" type="username" placeholder="username" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <label for="editPassword" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input id="editPassword" name="editPassword" type="password" placeholder="password" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <label for="editConfirmPassword" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input id="editConfirmPassword" name="editConfirmPassword" type="password" placeholder="password" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                    <span id='messageConfirmPasswordEditUser'></span>
                                                </div>
                                                <div>
                                                    <label for="createRole" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                                                    <div class="mt-2">
                                                        <select id="editRole" name="editRole" class="select select-bordered w-full" required>
                                                            <option disabled selected value="">Please select</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="User">User</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="mt-2">
                                                <button id="btnSubmitEditUser" type="submit" class="flex w-full justify-center rounded-md bg-orange-700 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <label class="modal-backdrop" for="my_modal_2">Close</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left menu -->
            <div class="drawer-side">
                <label for="drawer-leftmenu" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu h-full p-4 bg-white text-xl">
                    <!-- Sidebar content here -->
                    <li class="text-white">
                        <details>
                        <summary class="text-orange-700">Administrator</summary>
                        <ul>
                            <li><a href="./users.php" alt="" class="text-orange-700">Users</a></li>
                        </ul>
                    </li>
                    <li><a href="./ipbx-trunk.php" alt="" class="hover:bg-base-200 hover:text-black">Trunk Status</a></li>
                    <li><a href="./ipbx-ext.php" alt="" class="hover:bg-base-200 hover:text-black">Extension Status</a></li>
                </ul>
            </div>
        </div>
    </div>

    <button id="btnOpenDeleteError" class="btn hidden" onclick="my_delete_error.showModal()">open modal</button>
    <dialog id="my_delete_error" class="modal">
    <div class="modal-box bg-red-200 text-red-500">
        <h3 class="text-lg font-bold">Fail!</h3>
        <p class="py-4">Delete user fail. Please try again.</p>
        <div class="modal-action">
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn bg-red-500 text-white">Close</button>
        </form>
        </div>
    </div>
    </dialog>

    <script>

        $(document).ready(function(){

            'use strict'

            // Create new user
            $("#btnAddNewuser").click(function(){
                document.getElementById('createUsername').value = '';
                document.getElementById('createPassword').value = '';
                document.getElementById('createConfirmPassword').value = '';
                $('#messageConfirmPasswordCreateUser').html('');
                document.getElementById('createRole').value = '';
                $("#btnSubmitCreateUser").prop("disabled",true);
            });

            $("#btnCloseModalAddUser").click(function(){
                $("#btnAddNewuser").click();
            });

            $('#createPassword, #createConfirmPassword').on('keyup', function () {
                
                if($('#createPassword').val() == '' && $('#createConfirmPassword').val() == ''){
                    $('#messageConfirmPasswordCreateUser').html('');
                }
                else if ($('#createPassword').val() == $('#createConfirmPassword').val()) {
                    $('#messageConfirmPasswordCreateUser').html('Matching').css('color', 'green');
                    $("#btnSubmitCreateUser").prop("disabled",false);
                } 
                else {
                    $('#messageConfirmPasswordCreateUser').html('Not Matching').css('color', 'red');
                    $("#btnSubmitCreateUser").prop("disabled",true);
                }
            });

            // Edit user

            $(".btnEditUser").click(function(){
                const input = {
                    id: $(this).data('id'),
                    user: $(this).data('user'),
                    role: $(this).data('role')
                }
                document.getElementById('editUserId').value = input.id;
                document.getElementById('editUsername').value = input.user;
                document.getElementById('editPassword').value = '';
                document.getElementById('editConfirmPassword').value = '';
                $('#messageConfirmPasswordEditUser').html('');
                document.getElementById('editRole').value = input.role;
                $("#btnSubmitEditUser").prop("disabled",false);
                $("#btnModalEditUser").click();
            });

            $("#btnCloseModalEditUser").click(function(){
                $("#btnModalEditUser").click();
            });

            $('#editPassword, #editConfirmPassword').on('keyup', function () {
                
                if($('#editPassword').val() == '' && $('#editConfirmPassword').val() == ''){
                    $('#messageConfirmPasswordEditUser').html('');
                    $("#btnSubmitEditUser").prop("disabled",false);
                }
                else if ($('#editPassword').val() == $('#editConfirmPassword').val()) {
                    $('#messageConfirmPasswordEditUser').html('Matching').css('color', 'green');
                    $("#btnSubmitEditUser").prop("disabled",false);
                } else {
                    $('#messageConfirmPasswordEditUser').html('Not Matching').css('color', 'red');
                    $("#btnSubmitEditUser").prop("disabled",true);
                }
            });

            // Delete user
            $('.btnDeleteUser').click(function(){

                if (confirm("Are your sure to delete user = "+$(this).data('user')+"!")) {
                    var ajaxurl = 'common/delete-user.php', 
                    data =  {
                        'id': $(this).data('id')
                    }; 
                    $.ajax({
                        type: 'post', // the method (could be GET btw)
                        url: ajaxurl, // The file where my php code is
                        data: data,
                        success: function(e) { // in case of success get the output, i named data
                            console.log(e);
                            if(e){
                                $('#btnOpenDeleteError').click();
                            }
                            else{
                                location.reload();
                            }
                        }
                    });
                }

                
            });

        });

    </script>

</body>
</html>