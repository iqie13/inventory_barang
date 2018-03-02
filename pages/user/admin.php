<div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>User Management</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User Management
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                	<a href="index.php?f=user&p=user&action=formAddUser" class="btn btn-primary btn-sm">Add</a><hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-user">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Privileges</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        while($data = $query->fetch()){
                        ?>               
                                <tr class="odd gradeX">
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['nama_karyawan']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['no_telp']; ?></td>
                                    <td><?php echo $data['nama_job_title']; ?></td>
                                    <td>
                                        <?php if($data['active'] == 1) {
                                                echo "<span class='label label-success'>Active</span>";
                                        }else{
                                                echo "<span class='label label-danger'>Blocked</span>";
                                        } ?>
                                    </td>
                                    <td align="center">
                                        <?php if($data['active'] == 1) { ?>
                                                <a style='cursor:pointer; text-decoration:none;' id='<?php echo $data['id_user']; ?>' class="blocked" title="Blocked" onClick='blokir(this.id,<?php echo $data['active']; ?>)'><i class="glyphicon glyphicon-ban-circle"></i></a>
                                        <?php }else{ ?>
                                                <a style='cursor:pointer; text-decoration:none;' id='<?php echo $data['id_user']; ?>' class="actived" title="Actived" onClick='blokir(this.id,<?php echo $data['active']; ?>)'><i class="glyphicon glyphicon-ok"></i></a>
                                        <?php } ?>
                                        <a style='cursor:pointer; text-decoration:none;' id='<?php echo $data['id_user']; ?>' class="delete" title="Delete" onClick='hapus(this.id)'><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                        <?php }
                                $query->closeCursor();
                         ?>
                            </tbody>
                        </table>
                </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Staff List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <a href="index.php?f=user&p=user&action=formAddAsd" class="btn btn-primary btn-sm">Add</a><hr>
                    <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-dsn">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Birth Date</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                            foreach($db->tampilDataKaryawan() as $dsn){
                            ?>               
                                    <tr class="odd gradeX">
                                        <td><?php echo $dsn['fullname']; ?></td>
                                        <td>
                                            <?php 
                                                    $time = strtotime($dsn['tgl_lahir']);
                                                    $date = date('d-M-Y', $time);
                                                    if($dsn['kota_lahir'] != "") {
                                                            echo $db->cityName($dsn['kota_lahir']).", ".$date; 
                                                    }
                                            ?>
                                            </td>
                                        <td width="30%"><?php echo $dsn['alamat']; ?></td>
                                        <td><?php 
                                            if($dsn['status'] == 1) {
                                                    echo "<span class='label label-success'>Active</span>";
                                            }else{
                                                    echo "<span class='label label-danger'>Non-Active</span>";
                                            }
                                        ?></td>
                                        <td align="center">
                                            <a href="index.php?f=user&p=user&num=<?php echo $dsn['id_karyawan']; ?>&action=viewAsd" style='cursor:pointer; text-decoration:none;' class="viewAsd" title="View"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            <a href="index.php?f=user&p=user&num=<?php echo $dsn['id_karyawan']; ?>&action=formEditAsd" title="Update"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <?php if($dsn['status'] == 1) { ?>
                                                    <a style='cursor:pointer; text-decoration:none;' id='<?php echo $dsn['id_karyawan']; ?>' onClick="blokirAsd(this.id, <?php echo $dsn['status']; ?>)" title="Non-Actived"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                            <?php }else{ ?>
                                                    <a style='cursor:pointer; text-decoration:none;' id='<?php echo $dsn['id_karyawan']; ?>' onClick="blokirAsd(this.id, <?php echo $dsn['status']; ?>)" title="Actived"><i class="glyphicon glyphicon-ok"></i></a>
                                            <?php } ?>
                                            </td>
                                    </tr>
                            <?php } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>