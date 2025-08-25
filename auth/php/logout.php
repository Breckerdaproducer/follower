<?php
include_once "../../assets/db/db.php";
session_start();
if (isset($_SESSION['luxin_user'])) {

    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if (isset($logout_id)) {



        unset($_SESSION['luxin_user']);

        header("location: ../login");

    } else {
        header("location: ../../dashboard");
    }
} else {
    header("location: ../login");
}

?>