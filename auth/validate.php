<?php
include('../assets/db/db.php');

session_start();


if (isset($_SESSION['luxin_user'])) {
    header('location: ../user_pages/');
    exit;
} else {
    header('location: login');
    exit;
}