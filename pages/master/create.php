<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?f=master&p=supplier&action=">Supplier List</a></li>
            <li>Create Supplier</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Create Supplier
    </div>
    <div class="panel-body">
        <form id="form-supplier" action="index.php?f=master&p=supplier&action=proAddSupplier" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">Supplier Name *</label>
                <input type="text" id="SUPPLIER_NAME" class="input-block-level validate[required]" name="SUPPLIER_NAME" style="width:25%" />
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone *</label>
                <input type="text" id="PHONE" class="input-block-level validate[required]" name="PHONE" style="width:25%" />
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Contact Name *</label>
                <input type="text" id="CONTACT_NAME" class="input-block-level validate[required]" name="CONTACT_NAME" style="width:25%" />
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address *</label>
                <textarea name="ADDRESS" id="ADDRESS" class="form-control validate[required]" rows="3" style="width:50%"></textarea>
            </div>
            <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="SAVE" value="Save" />
            </div>
        </form>
    </div>
</div>