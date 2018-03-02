<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['UPDATE'])){
    $ID = base64_decode(base64_decode($_GET['id']));
    $SUPPLIER_NAME = $_POST['SUPPLIER_NAME'];
    $PHONE = $_POST['PHONE'];
    $CONTACT_NAME = $_POST['CONTACT_NAME'];
    $ADDRESS = $_POST['ADDRESS'];
    $STATUS = 1;
    $UPDATE_DATE = date('Y-m-d H:i:s');

    if(!empty($SUPPLIER_NAME) && !empty($PHONE) && !empty($CONTACT_NAME) && !empty($ADDRESS)) {
        $dataSupplier = array(
                ':kode_supplier'=>$ID,
                ':supplier_name'=>$SUPPLIER_NAME,
                ':phone'=>$PHONE,
                ':contact_name'=>$CONTACT_NAME,
                ':address'=>$ADDRESS,
                ':status'=>$STATUS,
                ':update_date'=>$UPDATE_DATE,
        );
        if($db->updateSupplier($dataSupplier)){
            header('Location: index.php?f=master&p=supplier&action=');
        }
    }else{
        $id = base64_encode(base64_encode($id));
        header('Location: index.php?f=master&p=supplier&action=formUpdateSupplier&id='.$id);
        echo "<script>alert('Save data is failed!!');</script>";
    }
}