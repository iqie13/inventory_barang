<?php
// this is a script to deactive supplier

include("SupplierModel.php");
$db=new SupplierModel();

$id = $_POST['ID'];
$status = $_POST['STATUS'];
if($status == 1) {
	$statusSupplier = 0;
	$db->deactiveSupplier($id, $statusSupplier);
}else{
	$statusSupplier = 1;
	$db->deactiveSupplier($id, $statusSupplier);
}