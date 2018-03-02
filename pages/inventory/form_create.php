<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?f=inventory&p=inventoryStock&action=">Inventory List</a></li>
            <li>Create Inventory</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Create Inventory
    </div>
    <div class="panel-body">
        <form id="form-inventory" action="index.php?f=inventory&p=inventoryStock&action=proAddStock" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Inventory Name *</label>
                        <input type="text" id="INVENTORY_NAME" class="input-block-level validate[required]" name="INVENTORY_NAME" style="width:50%" />
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Serial Number *</label>
                        <input type="text" id="SERIAL_NUMBER" class="input-block-level validate[required]" name="SERIAL_NUMBER" style="width:50%" />
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Inventory Code *</label>
                        <select id="INVENTORY_CODE" name="INVENTORY_CODE" class="input-block-level validate[required]" style="width:50%">
                            <option value="">--Select--</option>
                        <?php 
                            foreach($db->inventoryCode() as $ic) {
                                echo "<option value=".$ic['kode_jenis'].">".$ic['nama_jenis']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="SUPPLIER">Supplier *</label>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control validate[required]" name="SUPPLIER" id="SUPPLIER">
                            <div class="input-group-addon">
                                <a style="cursor: pointer" id="showSupplier" onclick="searchSupplier()">
                                    <i class="glyphicon glyphicon-search"></i>
                                </a>
                                <a style="cursor: pointer" id="showSupplier" onclick="deleteSupplier()">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <input type="hidden" class="form-control validate[required]" name="SUPPLIER_ID" id="SUPPLIER_ID">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Currency *</label>
                        <select id="CURRENCY_ID" name="CURRENCY_ID" class="input-block-level validate[required]" style="width:50%">
                            <option value="">--Select--</option>
                        <?php 
                            foreach($db->currency() as $cur) {
                                echo "<option value=".$cur['currency_id'].">".$cur['currency_code']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Price *</label>
                        <input type="text" id="PRICE" class="input-block-level validate[required]" name="PRICE" style="width:50%" placeholder="Number Only" />
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Quantity *</label>
                        <input type="text" id="QUANTITY" class="input-block-level validate[required]" name="QUANTITY" style="width:50%" placeholder="Number Only" />
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Satuan *</label>
                        <select id="SATUAN" class="input-block-level validate[required]" name="SATUAN" style="width:50%">
                            <option value="">--Select--</option>
                            <?php
                                foreach($db->getSatuan() as $k => $satuan) {
                                    echo "<option value=".$satuan.">".$satuan."</option>";
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
                            <input type="text" class="form-control" name="EXPIRED_DATE" id="EXPIRED_DATE">
                            <div class="input-group-addon">
                                <a style="cursor: pointer" id="showSupplier" onclick="deleteDate()">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <textarea name="DESCRIPTION" id="DESCRIPTION" class="form-control" rows="3" style="width:60%"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Warehouse *</label>
                        <select id="WAREHOUSE_ID" name="WAREHOUSE_ID" class="input-block-level validate[required]" style="width:50%">
                            <option value="">--Select--</option>
                        <?php 
                            foreach($db->warehouse() as $war) {
                                echo "<option value=".$war['warehouse_id'].">".$war['nama_warehouse']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="SAVE" value="Save" />
            </div>
        </form>
    </div>
</div>