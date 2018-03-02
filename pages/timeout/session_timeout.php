<?php

$_SESSION['start'] = time(); // taking now logged in time
//$time = $_SESSION['TIME'];

    if(!isset($_SESSION['expire'])){
        $_SESSION['expire'] = $_SESSION['start'] + (intval(4000)) ; // ending a session in 3 minutes
    }
    $now = time(); // checking the time now when home page starts

    if($now > $_SESSION['expire'])
    {
        session_destroy(); ?>
        <script>
	        alert("Your login session is time out!!"); 
	        window.open('login.php', '_self');
        </script>
<?php } ?>