<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['SAVE'])){
    $SUPPLIER_NAME = $_POST['SUPPLIER_NAME'];
    $PHONE = $_POST['PHONE'];
    $CONTACT_NAME = $_POST['CONTACT_NAME'];
    $ADDRESS = $_POST['ADDRESS'];
    $STATUS = 1;
    $CREATE_DATE = date('Y-m-d H:i:s');

    if(!empty($SUPPLIER_NAME) && !empty($PHONE) && !empty($CONTACT_NAME) && !empty($ADDRESS)) {
        $dataSupplier = array(
                ':supplier_name'=>$SUPPLIER_NAME,
                ':phone'=>$PHONE,
                ':contact_name'=>$CONTACT_NAME,
                ':address'=>$ADDRESS,
                ':status'=>$STATUS,
                ':create_date'=>$CREATE_DATE,
        );
        if($db->saveSupplier($dataSupplier)){
            header('Location: index.php?f=master&p=supplier&action=');
        }
    }else{
        header('Location: index.php?f=master&p=supplier&action=proAddSupplier');
        echo "<script>alert('Save data is failed!!');</script>";
    }
}