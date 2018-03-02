<?php
if ($_GET['q'] == 'logout') {
    $session_user->user_logout();
    header("location:login.php", true);
}