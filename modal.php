<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>


    <button class="btn" onclick="my_modal_1.showModal()">open modal</button>
    <dialog id="my_modal_1" class="modal">
    <div class="modal-box bg-green-200 text-green-500">
        <h3 class="text-lg font-bold">Successfully!</h3>
        <p class="py-4">Insert new user success.</p>
        <div class="modal-action">
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn btnClose bg-green-500 text-white w-28">Close</button>
        </form>
        </div>
    </div>
    </dialog>

    <button class="btn" onclick="my_modal_2.showModal()">open modal</button>
    <dialog id="my_modal_2" class="modal">
    <div class="modal-box bg-red-200 text-red-500">
        <h3 class="text-lg font-bold">Fail!</h3>
        <p class="py-4">Alredy had user in system. Please try again.</p>
        <div class="modal-action">
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn btnClose bg-red-500 text-white">Close</button>
        </form>
        </div>
    </div>
    </dialog>
    

    <script>

        $(document).ready(function(){

            $('.btnClose').click(function(){
                window.location.replace("users.php");
            });
            
        });

    </script>

</body>
</html>