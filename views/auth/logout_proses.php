<?php
session_start();

if ($_GET['level'] == 'admin') {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_destroy();
    header("Location: ../../admin/index.php");
} else {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_destroy();
    header("Location: ../../index.php");
}
