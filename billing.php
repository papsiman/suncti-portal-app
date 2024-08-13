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

    $sql = "SELECT * FROM config where name='billing'";
    $datas = $conn->query($sql);
    if($datas->num_rows > 0){
        $data = $datas->fetch_assoc();
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="bg-base-200">

    <?php include 'header.php';?>

    <div class="drawer xl:drawer-open">
            <!-- content -->
            <input id="drawer-leftmenu" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content min-h-[calc(100vh-68px)]">
                <div class="bg-white m-5 p-5 rounded-md">
                    <h1 class="text-2xl font-semibold">Billing</h1>
                </div>
                <div class="bg-white mx-5 my-0 p-5 rounded-md">
                    <input id="url" type="text" placeholder="Billing URL" value="<?php echo $data['value']?>" class="input input-bordered w-full max-w-xl" /> 
                    <button id="btnDelete" type="submit" class="btn btn-error text-white">Delete</button>
                    <button id="btnSave" type="submit" class="btn btn-primary">Save</button>
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
                    <li><a href="./billing.php" alt="" class="text-orange-700">Billing</a></li>
                    <li><a href="./ipbx-trunk.php" alt="" class="hover:bg-base-200 hover:text-black">Trunk Status</a></li>
                    <li><a href="./ipbx-ext.php" alt="" class="hover:bg-base-200 hover:text-black">Extension Status</a></li>
                </ul>
            </div>
        </div>

    <script>

    $(document).ready(function(){

        $('#btnSave').click(function(){
            var ajaxurl = 'common/billingurl.php', 
            data =  {'url': $(document.getElementById('url')).val()};
            $.ajax({
                type: 'post', // the method (could be GET btw)
                url: ajaxurl, // The file where my php code is
                data: data,
                success: function(e) { // in case of success get the output, i named data
                    if(e){
                        alert.log(e);
                    }
                    else{
                        alert('Save success');
                        location.reload();
                    }
                }
            });
        });

        $('#btnDelete').click(function(){
            var ajaxurl = 'common/billingurl.php', 
            data =  {'url': ''};
            $.ajax({
                type: 'post', // the method (could be GET btw)
                url: ajaxurl, // The file where my php code is
                data: data,
                success: function(e) { // in case of success get the output, i named data
                    if(e){
                        alert.log(e);
                    }
                    else{
                        alert('Delete success');
                        location.reload();
                    }
                }
            });
        });
           
    });

    </script>

</body>
</html>