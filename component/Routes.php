<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Routes extends koneksi {
    /*
     * Rules for login account
     */
    public function accessRules() {
        return array(
            'administrator'=>array(
                'user' => array ('admin', 'allProcess', 'blokiraAsd', 'blokirUser', 'changePhoto', 'deleteUser', 'proses', 'staffCreate', 'update', 'user', 'userCreate', 'usernameValid', 'viewStaff'),
                'dashboard' => array('dashboard', 'Proses'),
                'inventory' => array('admin', 'data_grid', 'form_create', 'form_update', 'InventoryModel', 'inventoryStock', 'save', 'stockJson', 'supplierList', 'update', 'view'),
                'login' => array('Login', 'logout'),
                'master' => array('admin', 'create', 'deactiveSupplier', 'form_update', 'save', 'supplier', 'SupplierModel', 'update'),
            ),
            'staff'=>array(
                'dashboard','supplier','inventoryStock','order', 'logout'
            ),
        );
    }
}