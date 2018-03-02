<?php

if (version_compare(phpversion(), '5.3.0', '>=') == 1) {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    error_reporting(E_ALL & ~E_NOTICE);
}

session_start();
include('pages/login/Login.php');
$user = new Login();
/**if ($user->get_session()) { ?>
	 <script>
	 	alert("Username and Password are wrong or your account has been blocked!!"); 
	 	window.open('login.html', '_self');
	 </script>
<?php }**/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$login = $user->loginProcess($_POST['username'], $_POST['password'], $_POST['g-recaptcha-response']);
	if ($login)
	{
		// Login Success
		header("location:index.php");
	}else{ 
		$user->loginFailed($_POST['username'], $_POST['password'], $_POST['g-recaptcha-response']);
	}
}