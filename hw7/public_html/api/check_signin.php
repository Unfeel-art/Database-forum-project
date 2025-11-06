<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $cur = basename($_SERVER['PHP_SELF']);
    header("Location: /~achernii/signin.html?error=unauthorized&redirect=$cur");
    exit;
}
?>