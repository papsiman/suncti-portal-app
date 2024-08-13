<?php
session_start();
require_once "config.php";

$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
}

$sql = "SELECT * FROM config where name='billing'";
$configs = $conn->query($sql);
if ($configs->num_rows > 0) {
    $config = $configs->fetch_assoc();
}

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suncti</title>

  <link rel="icon" href="./public/favicon.ico" type="image/x-icon">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="min-h-screen">

  <div class="">

    <div class="navbar h-[84px] bg-base-200 px-10">
        <div class="flex-1">
            <img src="./public/suncti_logo_2013-removebg.png" alt="" class="w-[128px]" />
        </div>
    </div>

    <div class="w-full max-w-7xl mx-auto md:h-[calc(100vh-255px)] py-10 md:py-0">
        <div class="w-full h-full flex flex-col md:flex-row justify-between items-center px-4 lg:px-2 gap-4 md:gap-8">
            <div class="w-full md:w-1/2 flex flex-col justify-start items-start gap-4">
                <div class="btn rounded-xl">
                    ****
                </div>
                <span class="text-2xl md:text-4xl lg:text-6xl font-semibold">We offers consultants and Operate of the <span class="text-red-700">Microsoft Team</span>.</span>
                <span class="text-normal md:text-xl">More than sixteen years our experiances.</span>
            </div>
            <div class="w-full md:w-1/2 mockup-window bg-base-300 border pb-20">

                <div class="w-full flex flex-col md:flex-row justify-center items-center md:items-stretch gap-4 px-4 lg:px-0">

                    <!-- Monitoring -->
                    <label id="Monitoring" for="my_modal_1" class="relative my_modal_1 w-full md:w-40 h-40 cursor-pointer hover:scale-105 rounded-xl bg-[#242526]">
                        <div class="absolute w-full h-full flex justify-center items-center">
                            <h2 class="card-title text-red-500"><i class="fa-solid fa-phone"></i> Monitoring</h2>
                        </div>
                        <div class="absolute w-full">
                            <div class="bg-fixed card w-full h-full flex justify-center items-center rounded-md"
                                style="background-image: url('./public/card-bg-1.png');background-size: 64px; background-repeat:repeat;opacity:0.1;"
                            ></div>
                        </div>
                    </label>

                    <!-- IPBX -->
                    <a href="<?php echo $monitoringUrl; ?>" class='relative w-full md:w-40 h-40 cursor-pointer hover:scale-105 rounded-xl bg-[#242526]'>
                        <div class="absolute w-full h-full flex justify-center items-center">
                            <h2 class="card-title text-red-500"><i class="fa-solid fa-chart-line"></i> IPBX</h2>
                        </div>
                        <div class="absolute w-full">
                            <div class="bg-fixed card w-full h-full flex justify-center items-center rounded-md"
                                style="background-image: url('./public/card-bg-1.png');background-size: 64px; background-repeat:repeat;opacity:0.1;"
                            ></div>
                        </div>
                    </a>

                    <!-- Dashboard -->
                    <?php
                        if ($config['value'] != '') {
                            echo '
                            <a href="' . $config['value'] . '" class="relative w-full md:w-40 h-40 cursor-pointer hover:scale-105 rounded-xl bg-[#242526]">
                               <div class="absolute w-full h-full flex justify-center items-center">
                                   <h2 class="card-title text-red-500"><i class="fa-solid fa-chart-line"></i> Billing</h2>
                               </div>
                               <div class="absolute w-full">
                                   <div class="bg-fixed card w-full h-full flex justify-center items-center rounded-md"
                                       style="background-image: url("./public/card-bg-1.png");background-size: 64px; background-repeat:repeat;opacity:0.1;"
                                   ></div>
                               </div>
                           </a>
                           ';
                        }
                    ?>

                    <input type="checkbox" id="my_modal_1" class="modal-toggle" />
                    <div class="modal" role="dialog">
                        <div class="modal-box">
                            <div class="flex min-h-full flex-col justify-center px-6 py-6 lg:px-8">
                                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
                                </div>

                                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                                    <form class="space-y-6" action="common/validate-login.php" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                            <div class="mt-2">
                                                <input id="username" name="username" type="username" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex items-center justify-between">
                                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                            </div>
                                            <div class="mt-2">
                                                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        <div>
                                            <button type="submit" class="flex w-full justify-center rounded-md bg-orange-700 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                                        </div>
                                        <div class="flex justify-center text-red-700">
                                            <span><?php echo $error; ?></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <label class="modal-backdrop" for="my_modal_1">Close</label>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#Monitoring').click(function(){
                $.ajax({
                    url: './common/validate-session.php'
                 })
                 .done(function(e){
                    console.log(e);
                    if(e == 'True'){
                        window.location.replace('ipbx-trunk.php');
                    }
                 });
            });
        });
    </script>

    <?php include 'footer.php';?>

  </div>

</body>
<?php
if ($error) {
    $_SESSION['error'] = '';
    echo '
            <script>
                $(document).ready(function(){
                    "use strict"
                    $(".my_modal_1").click();
                });
            </script>
        ';
}
?>
</html>
