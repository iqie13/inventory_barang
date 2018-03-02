<?php
include("proses.php");
$db=new proses();

$id = $_POST['ID'];
$blok = $_POST['BLOK'];
if($blok == 1) {
	$status = 0;
	$db->blokirUser($id, $status);
}else{
	$status = 1;
	$db->blokirUser($id, $status);
}