<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Inventory List</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Inventory List</strong>
    </div>
    <div class="panel-body">
        <a href="index.php?f=inventory&p=inventoryStock&action=formAddStock" class="btn btn-primary btn-sm">Add</a><hr>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-inventory">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Inventory Name</th>
                        <th width="15%">Inventory Code</th>
                        <th width="10%">QTY Stock</th>
                        <th width="10%">Currency</th>
                        <th width="10%">Prices</th>
                        <th width="10%">Expired</th>
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
                            <td><?php echo $data['nama_barang']; ?></td>
                            <td><?php echo $db->getInventoryCode($data['kode_jenis']); ?></td>
                            <td><?php echo $data['qty_barang']; ?></td>
                            <td><?php echo $db->getInventoryCurrency($data['currency_id']); ?></td>
                            <td><?php echo $data['harga']."/".$data['satuan']; ?></td>
                            <td><?php 
                            if($data['expired_date'] !== '0000-00-00') {
                                echo $data['expired_date'];
                            }else{
                                echo 'No Expired';
                            }
                            ?></td>

                            <td align="center">
                                <a href='index.php?f=inventory&p=inventoryStock&action=viewStock&id=<?php echo base64_encode(base64_encode($data['id_barang'])); ?>' class="update" title="View"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href='index.php?f=inventory&p=inventoryStock&action=formUpdateStock&id=<?php echo base64_encode(base64_encode($data['id_barang'])); ?>' class="update" title="Update"><i class="glyphicon glyphicon-edit"></i></a>
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