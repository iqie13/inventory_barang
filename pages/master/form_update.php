<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = base64_decode(base64_decode($_GET['id']));
$show = $db->selectSupplier($id);
?>
<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?f=master&p=supplier&action=">Supplier List</a></li>
            <li>Update Supplier</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Create Supplier
    </div>
    <div class="panel-body">
        <form id="form-supplier" action="index.php?f=master&p=supplier&action=proUpdateSupplier&id=<?php echo base64_encode(base64_encode($id)); ?>" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">Supplier Name *</label>
                <input type="text" id="SUPPLIER_NAME" class="input-block-level validate[required]" name="SUPPLIER_NAME" style="width:25%" value="<?php echo $show['nama_suplier'] ?>" />
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone *</label>
                <input type="text" id="PHONE" class="input-block-level validate[required]" name="PHONE" style="width:25%" value="<?php echo $show['phone'] ?>" />
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Contact Name *</label>
                <input type="text" id="CONTACT_NAME" class="input-block-level validate[required]" name="CONTACT_NAME" style="width:25%" value="<?php echo $show['contact_name'] ?>" />
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address *</label>
                <textarea name="ADDRESS" id="ADDRESS" class="form-control validate[required]" rows="3" style="width:50%"><?php echo $show['alamat'] ?></textarea>
            </div>
            <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="UPDATE" value="Update" />
            </div>
        </form>
    </div>
</div>