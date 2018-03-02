<?php 
    include("../../config/koneksi.php");
    include("../master/SupplierModel.php");
    $db=new SupplierModel();
    $query = $db->supplierProvider();
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-supplier">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">Supplier Name</th>
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
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php 
                            if($data['status'] == 1) {
                                echo "Active"; 
                            }else{
                                echo "Non Active";
                            }
                        ?></td>

                    <td align="center">
                        <a id='<?php echo $data['kode_suplier']; ?>' class="btn btn-primary" title="Select" onclick="selectSupplier(this.id, '<?php echo $data['nama_suplier']; ?>')">Select</a>
                    </td>
                </tr>
        <?php }
                $query->closeCursor();
         ?>
            </tbody>
    </table>
</div>