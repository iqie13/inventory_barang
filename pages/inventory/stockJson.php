<?php
include_once '../../config/koneksi.php';
include_once 'InventoryModel.php';

$model = new InventoryModel;
$inventory = $model->inventoryProvider();

$dataJson = array();
foreach ($inventory as $p) {
    $dataJson[] = array(
        "ACTION" => $p['id_barang'],
        "nama_barang" => $p['nama_barang'],
        "kode_jenis" => $model->getInventoryCode($p['kode_jenis']),
        "qty_barang" => $p['qty_barang'],
        "currency_id" => $model->getInventoryCurrency($p['currency_id']),
    );
}
echo json_encode(
        array(
            'total' => count($dataJson),
            'rows' => $dataJson,
        )
);