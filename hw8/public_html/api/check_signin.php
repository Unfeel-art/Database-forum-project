<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $cur = basename($_SERVER['PHP_SELF']);
    header("Location: /~achernii/signin_page.php?error=unauthorized&redirect=$cur");
    exit;
}
?>