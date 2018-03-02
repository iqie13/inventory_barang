<?php
include("proses.php");
$db=new proses();

$id = $_POST['id'];
$db->deleteUser($id);