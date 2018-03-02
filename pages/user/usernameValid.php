<?php

include ("../../config/koneksi.php");
include("proses.php");
$db=new proses();

$username = $_POST['username'];

if(!empty($username)) {
	$cek = $db->userValid($username);
	echo $cek;
}else{
	echo "null";
}