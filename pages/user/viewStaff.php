<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="?f=user&p=user&action=">User management</a></li>
            <li>View Staff</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                View Staff Profile
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <?php 
                $id = $_GET['num'];
                // echo "aaaaaaaaaa".$_GET['num']; 
                $view = $db->viewProfile($id);
                //print "<pre>".print_r($view, 1)."</pre>";
                foreach($view as $d => $vals){
                    if($vals['tgl_lhr'] != "0000-00-00") {
                            $str = strtotime($vals['tgl_lahir']); 
                            $birthDate = $db->cityName($vals['kota_lahir']).", ".date('d-M-Y',$str);
                    }else{
                            $birthDate = "-";
                    }

                    if($vals['join_date'] != "0000-00-00") {
                            $jo = strtotime($vals['join_date']);
                            $join = date('d-M-Y', $jo);
                    }else{
                            $join = "-";
                    }
                    if($vals['out_date'] != "0000-00-00") {
                            $od = strtotime($vals['out_date']);
                            $out = date('d-M-Y',$od);
                    }else{
                            $out = "-";
                    }

                    if($vals['jk'] == 'L') {
                            $gen = "Male";
                    }else{
                            $gen = "Female";
                    }

                    if($vals['status'] == 1) {
                            $stat = "<span class='label label-success'>Active</span>";
                    }else{
                            $stat = "<span class='label label-danger'>Non-Active</span>";
                    }
            ?>
                    <a href="index.php?f=user&p=user&action=" class="btn btn-primary btn-sm">Back</a>
                    <a href="index.php?f=user&p=user&num=<?php echo $id; ?>&action=formEditAsd" class="btn btn-success btn-sm">Edit</a><hr>
                    <div class="col-xs-3">
                                    <div class="form-group">
                                            <?php if(!empty($vals['url'])) { ?>
                                                    <img src='<?php echo $vals['url']; ?>' alt="User Avatar" class="img-thumbnail img-change"/>
                                            <?php }else{ ?>
                                                                    <img src='files/no-photo.jpg' alt="User Avatar" class="img-thumbnail img-change"/>
                                            <?php } ?>
                                    </div>
                    </div>
                    <div class="col-xs-9">
                        <table class="table table-striped">
                                <tr>
                                        <td width="20%">Full Name</td><td width="1%">:</td><td><?php echo $vals['fullname']; ?></td>
                                </tr>
                                <tr>
                                        <td width="20%">Job Title</td><td width="1%">:</td><td><?php echo $db->jobTitleName($vals['id_job_title']); ?></td>
                                </tr>
                                <tr>
                                        <td>Birth Date</td><td>:</td><td><?php echo $birthDate ?></td>
                                </tr>
                                <tr>
                                        <td>Gender</td><td>:</td><td><?php echo $gen; ?></td>
                                </tr>
                                <tr>
                                        <td>Phone</td><td>:</td><td><?php echo $vals['no_telp']; ?></td>
                                </tr>
                                <tr>
                                        <td>Email</td><td>:</td><td><?php echo $vals['email']; ?></td>
                                </tr>
                                <tr>
                                        <td>Address</td><td>:</td><td><?php echo $vals['alamat']; ?></td>
                                </tr>
                                <tr>
                                        <td>Status</td><td>:</td><td><?php echo $stat; ?></td>
                                </tr>
                                <tr>
                                        <td>Join Date</td><td>:</td><td><?php echo $join; ?></td>
                                </tr>
                                <tr>
                                        <td>Resign</td><td>:</td><td><?php echo $out; ?></td>
                                </tr>
                        </table>
                    </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>