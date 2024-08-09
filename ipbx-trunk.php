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

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body class="bg-base-200">
    <div class="">

        <?php include 'header.php';?>

        <div class="drawer xl:drawer-open">
            <!-- content -->
            <input id="drawer-leftmenu" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <div class="bg-white m-5 p-5 rounded-md">
                    <h1 class="text-2xl font-semibold">Trunks Status</h1>
                    <div class="flex flex-row gap-4 pt-2">
                        <span>2 online of 2</span>
                        <div class="divider divider-horizontal"></div>
                        <span>2024/08/05 00:00:00</span>
                    </div>
                </div>
                <div class="bg-white mx-5 my-0 p-5 rounded-md">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr class="text-xl">
                                    <th>#</th>
                                    <th>Number</th>
                                    <th>IP Address</th>
                                    <th>Port</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr class="hover:bg-base-200 hover:text-black text-xl">
                                    <th>1</th>
                                    <td>audiocodes_sbc</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>80</td>
                                    <td><div class="badge badge-success text-white">Not in use</div></td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="hover:bg-base-200 hover:text-black text-xl">
                                    <th>2</th>
                                    <td>audiocodes_sbc_vm</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>80</td>
                                    <td><div class="badge badge-error text-white">In use</div></td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="hover:bg-base-200 hover:text-black text-xl">
                                    <th>3</th>
                                    <td>audiocodes_sbc_vm_2</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>80</td>
                                    <td><div class="badge badge-ghost">Unavailable</div></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- left menu -->
            <div class="drawer-side">
                <label for="drawer-leftmenu" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu h-full p-4 bg-white text-xl">
                    <!-- Sidebar content here -->
                    <li>
                        <details>
                        <summary class="hover:bg-base-200 hover:text-black">Administrator</summary>
                        <ul>
                            <li><a href="./users.php" alt="" class="hover:bg-base-200 hover:text-black">Users</a></li>
                        </ul>
                    </li>
                    <li><a href="./ipbx-trunk.php" alt="" class="text-orange-700">Trunk Status</a></li>
                    <li><a href="./ipbx-ext.php" alt="" class="hover:bg-base-200 hover:text-black">Extension Status</a></li>
                </ul>
            </div>
        </div>

    </div>
</body>

</html>
