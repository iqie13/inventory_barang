<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?f=inventory&p=inventoryStock&action=">Inventory List</a></li>
            <li>Detail Inventory</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Detail Inventory</strong>
    </div>
    <div class="panel-body">
        <?php
            $id = base64_decode(base64_decode($_GET['id']));
            $value = $db->selectStock($id);
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr class="success">
                        <td width=15%>Inventory Name</td><td width=1%>:</td><td><?php echo $value['nama_barang']; ?></td>
                </tr>
                <tr>
                        <td width=15%>Serial Number</td><td width=1%>:</td><td><?php echo $value['kode_sn']; ?></td>
                </tr>
                <tr class="success">
                        <td width=15%>Inventory Type</td><td width=1%>:</td><td><?php echo $db->getInventoryCode($value['kode_jenis']); ?></td>
                </tr>
                <tr>
                        <td width=15%>Quantity</td><td width=1%>:</td><td><?php echo $value['qty_barang'] ." ". $value['satuan']; ?></td>
                </tr>
                <tr class="success">
                    <td width=15%>Price</td><td width=1%>:</td><td><?php echo $db->getInventoryCurrency($value['currency_id']) .". ".number_format($value['harga'], 2); ?></td>
                </tr>
                <tr>
                        <td width=15%>Expire date</td><td width=1%>:</td><td><?php echo $value['expired_date']; ?></td>
                </tr>
                <tr>
                        <td width=15%>Supplier</td><td width=1%>:</td><td><?php echo $db->getSupplier($value['kode_suplier']); ?></td>
                </tr>
                <tr>
                        <td width=15%>Warehouse Location</td><td width=1%>:</td><td><?php echo $db->getWarehouse($value['warehouse_id']); ?></td>
                </tr>
                <tr>
                        <td width=15%>Description</td><td width=1%>:</td><td><?php echo $value['description']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>