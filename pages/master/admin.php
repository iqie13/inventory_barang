<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Supplier List</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Supplier List</strong>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <a href="index.php?f=master&p=supplier&action=formAddSupplier" class="btn btn-primary btn-sm">Add</a><hr>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-supplier">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="10%">Supplier Name</th>
                        <th width="10%">Phone</th>
                        <th width="10%">Contact Name</th>
                        <th width="20%">Address</th>
                        <th width="10%">Status</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                while($data = $query->fetch()){
                ?>               
                        <tr class="odd gradeX">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_suplier']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['contact_name']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td><?php 
                                    if($data['status'] == 1) {
                                        echo "Active"; 
                                    }else{
                                        echo "Non Active";
                                    }
                                ?></td>

                            <td align="center">
                                <a href='index.php?f=master&p=supplier&action=formUpdateSupplier&id=<?php echo base64_encode(base64_encode($data['kode_suplier'])); ?>' class="update" title="Update"><i class="glyphicon glyphicon-edit"></i></a>
                                <?php if($data['status'] == 1) { ?>
                                        <a style='cursor:pointer; text-decoration:none;' id='<?php echo $data['kode_suplier']; ?>' onClick="deactiveSupplier(this.id, <?php echo $data['status']; ?>)" title="Non-Actived"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                <?php }else{ ?>
                                        <a style='cursor:pointer; text-decoration:none;' id='<?php echo $data['kode_suplier']; ?>' onClick="deactiveSupplier(this.id, <?php echo $data['status']; ?>)" title="Actived"><i class="glyphicon glyphicon-ok"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                <?php 
                }
                $query->closeCursor();
                ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>