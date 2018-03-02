<?php 
    $id = base64_decode(base64_decode($_GET['id']));
    $value = $db->selectStock($id); 
?>
<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?f=inventory&p=inventoryStock&action=">Inventory List</a></li>
            <li>Update Inventory</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Update Inventory
    </div>
    <div class="panel-body">
        <form id="form-inventory-update" action="index.php?f=inventory&p=inventoryStock&action=proUpdateStock" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Inventory Name *</label>
                        <input type="text" id="INVENTORY_NAME" class="input-block-level validate[required]" name="INVENTORY_NAME" style="width:50%" value="<?php echo $value['nama_barang']; ?>" />
                        <input type="hidden" id="INVENTORY_ID" class="input-block-level validate[required]" name="INVENTORY_ID" style="width:50%" value="<?php echo $value['id_barang']; ?>" />
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Serial Number *</label>
                        <input type="text" id="SERIAL_NUMBER" class="input-block-level validate[required]" name="SERIAL_NUMBER" style="width:50%" value="<?php echo $value['kode_sn']; ?>" />
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Inventory Code *</label>
                        <select id="INVENTORY_CODE" name="INVENTORY_CODE" class="input-block-level validate[required]" style="width:50%">
                            <option value="">--Select--</option>
                        <?php 
                            foreach($db->inventoryCode() as $ic) {
                                echo "<option value='".$ic['kode_jenis']."' ";
                                if($ic['kode_jenis'] == $value['kode_jenis']) {
                                    echo "selected='true'";
                                }
                                echo ">".$ic['nama_jenis']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="SUPPLIER">Supplier *</label>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control validate[required]" name="SUPPLIER" id="SUPPLIER" value="<?php echo $db->getSupplier($value['kode_suplier']); ?>">
                            <div class="input-group-addon">
                                <a style="cursor: pointer" id="showSupplier" onclick="searchSupplier()">
                                    <i class="glyphicon glyphicon-search"></i>
                                </a>
                                <a style="cursor: pointer" id="showSupplier" onclick="deleteSupplier()">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <input type="hidden" class="form-control validate[required]" name="SUPPLIER_ID" id="SUPPLIER_ID" value="<?php echo $value['kode_suplier']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Currency *</label>
                        <select id="CURRENCY_ID" name="CURRENCY_ID" class="input-block-level validate[required]" style="width:50%">
                            <option value="">--Select--</option>
                        <?php 
                            foreach($db->currency() as $cur) {
                                echo "<option value='".$cur['currency_id']."' ";
                                if($cur['currency_id'] == $value['currency_id']) {
                                    echo "selected='true'";
                                }
                                echo ">".$cur['currency_code']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Price *</label>
                        <input type="text" id="PRICE" class="input-block-level validate[required]" name="PRICE" style="width:50%" placeholder="Number Only" value="<?php echo number_format($value['harga'], 2); ?>" />
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Quantity *</label>
                        <input type="text" id="QUANTITY" class="input-block-level validate[required]" name="QUANTITY" style="width:50%" placeholder="Number Only" value="<?php echo $value['qty_barang']; ?>" />
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Satuan *</label>
                        <select id="SATUAN" class="input-block-level validate[required]" name="SATUAN" style="width:50%">
                            <option value="">--Select--</option>
                            <?php
                                foreach($db->getSatuan() as $k => $satuan) {
                                    echo "<option value='".$satuan."' ";
                                    if($satuan == $value['satuan']) {
                                        echo "selected='true'";
                                    }
                                    echo ">".$satuan."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="EXPIRED_DATE">Expired Date </label>
                        <div class="input-group col-sm-6">
                            <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                            </div>
                            <input type="text" class="form-control" name="EXPIRED_DATE" id="EXPIRED_DATE" value="<?php if($value['expired_date'] != '0000-00-00') { echo date('d-m-Y',  strtotime($value['expired_date'])); } ?>">
                            <div class="input-group-addon">
                                <a style="cursor: pointer" id="showSupplier" onclick="deleteDate()">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description *</label>
                        <textarea name="DESCRIPTION" id="DESCRIPTION" class="form-control validate[required]" rows="3" style="width:60%"><?php echo $value['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Warehouse *</label>
                        <select id="WAREHOUSE_ID" name="WAREHOUSE_ID" class="input-block-level validate[required]" style="width:50%">
                            <option value="">--Select--</option>
                        <?php 
                            foreach($db->warehouse() as $ware) {
                                echo "<option value='".$ware['warehouse_id']."' ";
                                if($ware['warehouse_id'] == $value['warehouse_id']) {
                                    echo "selected='true'";
                                }
                                echo ">".$ware['nama_warehouse']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="UPDATE" value="Update" />
            </div>
        </form>
    </div>
</div>