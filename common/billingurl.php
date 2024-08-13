<?php
init();
function init()
{
    require_once "../config.php";

    //Validate duplicate data
    $url = $_POST['url'];

    $sql = "UPDATE config SET value = '".$url."' WHERE name = 'billing'";
    $conn->query($sql);
    return $sql;
}
?>