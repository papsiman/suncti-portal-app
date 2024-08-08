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
    <div>
        
        <?php include 'header.php';?>

        <div class="drawer lg:drawer-open flex flex-row">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-side min-w-72">
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu h-full p-4 bg-white text-xl">
                    <!-- Sidebar content here -->
                    <li class="">
                        <details>
                        <summary class="hover:bg-base-200 hover:text-black">Administrator</summary>
                        <ul>
                            <li><a href="./users.php" alt="" class="hover:bg-base-200 hover:text-black">Users</a></li>
                        </ul>
                    </li>
                    <li><a href="./ipbx-trunk.php" alt="" class="hover:bg-base-200 hover:text-black">Trunks Status</a></li>
                    <li><a href="./ipbx-ext.php" alt="" class="text-orange-700">Extension Status</a></li>
                </ul>
            </div>
            <div class="flex flex-col w-full min-h-[calc(100vh-240px)]">
                <div class="bg-white mx-10 mt-10 mb-5 p-5 rounded-md">
                    <h1 class="text-2xl font-semibold">Extension Status</h1>
                    <div class="flex flex-row gap-4 pt-2">
                        <span>132 online of 633</span>
                        <div class="divider divider-horizontal"></div>
                        <span>2024/08/05 00:00:00</span>
                    </div>
                </div>
                <div class="bg-white mx-10 my-0 p-10 rounded-md">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr class="text-xl">
                                    <th>#</th>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>IP Address</th>
                                    <th>IP Port</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr class="hover:bg-base-200 text-xl">
                                        <th>1</th>
                                        <td>701230</td>
                                        <td>Sitthinon Wirat</td>
                                        <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                        <td>12647</td>
                                        <td><div class="badge badge-success text-white">Not in use</div></td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="hover:bg-base-200 text-xl">
                                        <th>2</th>
                                        <td>701231</td>
                                        <td>Surasak Doungsapol</td>
                                        <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                        <td>12647</td>
                                        <td><div class="badge badge-error text-white">In use</div></td>
                                </tr>
                                <!-- row 3 -->
                                <tr class="hover:bg-base-200 text-xl">
                                        <th>3</th>
                                        <td>701232</td>
                                        <td>Ronnakrit Sriyoung</td>
                                        <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                        <td>12647</td>
                                        <td><div class="badge badge-warning">Ringing</div></td>
                                </tr>
                                 <!-- row 4 -->
                                <tr class="hover:bg-base-200 text-xl">
                                        <th>4</th>
                                        <td>701232</td>
                                        <td>Ronnakrit Sriyoung</td>
                                        <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                        <td>12647</td>
                                        <td><div class="badge badge-ghost">Unavailable</div></td>
                                </tr>

                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>5</th>
                                    <td>701230</td>
                                    <td>Sitthinon Wirat</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-success text-white">Not in use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>6</th>
                                    <td>701231</td>
                                    <td>Surasak Doungsapol</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-error text-white">In use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>7</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-warning">Ringing</div></td>
                                </tr>
                                 <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>8</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-ghost">Unavailable</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>9</th>
                                    <td>701230</td>
                                    <td>Sitthinon Wirat</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-success text-white">Not in use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>10</th>
                                    <td>701231</td>
                                    <td>Surasak Doungsapol</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-error text-white">In use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>11</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-warning">Ringing</div></td>
                                </tr>
                                 <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>12</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-ghost">Unavailable</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>13</th>
                                    <td>701230</td>
                                    <td>Sitthinon Wirat</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-success text-white">Not in use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>14</th>
                                    <td>701231</td>
                                    <td>Surasak Doungsapol</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-error text-white">In use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>15</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-warning">Ringing</div></td>
                                </tr>
                                 <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>16</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-ghost">Unavailable</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>17</th>
                                    <td>701230</td>
                                    <td>Sitthinon Wirat</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-success text-white">Not in use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>18</th>
                                    <td>701231</td>
                                    <td>Surasak Doungsapol</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-error text-white">In use</div></td>
                                </tr>
                                <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>19</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-warning">Ringing</div></td>
                                </tr>
                                 <!-- row Loop -->
                                <tr class="hover:bg-base-200 text-xl">
                                    <th>20</th>
                                    <td>701232</td>
                                    <td>Ronnakrit Sriyoung</td>
                                    <td><a href="http://202.183.135.69" class="underline underline-offset-1 text-orange-700">202.183.135.69</a></td>
                                    <td>12647</td>
                                    <td><div class="badge badge-ghost">Unavailable</div></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
