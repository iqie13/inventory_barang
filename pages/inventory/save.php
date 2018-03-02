<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['SAVE'])) {
    $INVENTORY_NAME = $_POST['INVENTORY_NAME'];
    $SERIAL_NUMBER = $_POST['SERIAL_NUMBER'];
    $INVENTORY_CODE = $_POST['INVENTORY_CODE'];
    $SUPPLIER_ID = $_POST['SUPPLIER_ID'];
    $CURRENCY_ID = $_POST['CURRENCY_ID'];
    $PRICE = $_POST['PRICE'];
    $QUANTITY = $_POST['QUANTITY'];
    $SATUAN = $_POST['SATUAN'];
    if(!empty($_POST['EXPIRED_DATE'])) {
        $EXPIRED_DATE = date('Y-m-d',  strtotime($_POST['EXPIRED_DATE']));
    }else{
        $EXPIRED_DATE = '0000-00-00'; 
    }
    $DESCRIPTION = $_POST['DESCRIPTION'];
    $WAREHOUSE_ID = $_POST['WAREHOUSE_ID'];

    $dataInventory = array(
        ':inventory_name'=>$INVENTORY_NAME,
        ':serial_number'=>$SERIAL_NUMBER,
        ':inventory_code'=>$INVENTORY_CODE,
        ':supplier_id'=>$SUPPLIER_ID,
        ':currency_id'=>$CURRENCY_ID,
        ':price'=>str_replace(',', '', $PRICE),
        ':quantity'=>$QUANTITY,
        ':satuan'=>$SATUAN,
        ':expired_date'=>$EXPIRED_DATE,
        ':description'=>$DESCRIPTION,
        ':warehouse_id'=>$WAREHOUSE_ID,
        ':create_id'=>$session_id,
        ':create_date'=>date('Y-m-d'),
    );

    if($db->saveInventory($dataInventory)) {
        header('Location: index.php?f=inventory&p=inventoryStock&action=');
    }
}