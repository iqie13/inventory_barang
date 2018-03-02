<?php
if(isset($_POST['SAVE'])){
    $pass = md5($_POST['PASSWORD']);
    $username = $_POST['USERNAME'];
    $id_karyawan = $_POST['ID_KARYAWAN'];
    $nama = $_POST['NAMA'];
    $email = $_POST['EMAIL'];
    $telpon = $_POST['TELEPON'];
    //$akses = $_POST['HAK_AKSES'];
    $active = '1';
    $create_date = date('Y-m-d H:i:s');

    if(!empty($pass) && !empty($username) && !empty($id_karyawan) && !empty($nama) && !empty($email) && !empty($telpon)) {
            $dataUser = array(
                    ':username'=>$username,
                    ':password'=>$pass,
                    ':id_karyawan'=>$id_karyawan,
                    ':email'=>$email,
                    ':telpon'=>$telpon,
                    ':active'=>$active,
                    ':create_id'=>$session_id,
                    ':create_date'=>$create_date,
            );
            $db->saveUser($dataUser);
?>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="?f=user&p=user&action=">User management</a></li>
                <li>Staff Update</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detail User Account
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr class="success">
                                    <td width=15%>No ID/NPM</td><td width=1%>:</td><td><?php echo $_POST['ID_KARYAWAN']; ?></td>
                            </tr>
                            <tr>
                                    <td width=15%>Nama Lengkap</td><td width=1%>:</td><td><?php echo $_POST['NAMA']; ?></td>
                            </tr>
                            <tr class="success">
                                    <td width=15%>Username</td><td width=1%>:</td><td><?php echo $_POST['USERNAME']; ?></td>
                            </tr>
                            <tr>
                                    <td width=15%>Password</td><td width=1%>:</td><td><?php echo $pass; ?></td>
                            </tr>
                            <tr class="success">
                                    <td width=15%>Email</td><td width=1%>:</td><td><?php echo $_POST['EMAIL']; ?></td>
                            </tr>
                            <tr>
                                    <td width=15%>Telepon</td><td width=1%>:</td><td><?php echo $_POST['TELEPON']; ?></td>
                            </tr>
    <!--                                                    <tr class="success">
                                <td width=15%>Hak Akses</td><td width=1%>:</td><td><?php //echo $_POST['HAK_AKSES']; ?></td>
                        </tr>-->
                        </table><hr>
                        <span style="float:right;padding-right:25px;">
                                <a href="index.php?f=user&p=user&action=" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> OK</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
     </div>
<?php }else{ ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-danger">
                Your request is failed, field can not be empty! Please try again.
            </div>
        </div>
    </div>
<?php }
//========================= Proses Add Karyawan ================================
}elseif(isset($_POST['SAVE_KARYAWAN'])) {
    $npm = $_POST['NPM'];
    $firstname = $_POST['FIRSTNAME'];
    $lastname = $_POST['LASTNAME'];
    $name = $_POST['FIRSTNAME']." ".$_POST['LASTNAME'];
    $jobTitle = $_POST['JOB_TITLE'];
    $kota_lahir = $_POST['KOTA_LAHIR'];
    $tgl_lhr = $_POST['TGL_LAHIR'];
    $gender = $_POST['JNS_KL'];
    $phone = $_POST['PHONE'];
    $email = $_POST['EMAIL'];
    $address = $_POST['ADDRESS'];
    $join = $_POST['JOIN'];
    $create_date = date('Y-m-d H:i:s');
    $nama_file = $_FILES['upload']['name'];
    $ukuran = $_FILES['upload']['size'];
    $tmp_file = $_FILES['upload']['tmp_name'];


    $uploadDir = "files/fp-asdos/$npm/";
    $url = $uploadDir.$nama_file;

    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if(!empty($nama_file) && $ukuran <= 2048000) {
        $dataKaryawan = array(
                ':no_id'=>$npm,
                ':firstname'=>$firstname,
                ':lastname'=>$lastname,
                ':name'=>$name,
                ':jobTitle'=>$jobTitle,
                ':ttl'=>$kota_lahir,
                ':tgl_lhr'=>$tgl_lhr,
                ':jk'=>$gender,
                ':no_telp'=>$phone,
                ':email'=>$email,
                ':alamat'=>$address,
                ':status'=>'1',
                ':join_date'=>$join,
                ':create_id'=>$session_id,
                ':create_date'=>$create_date,
                );
            $save = $db->saveKaryawan($dataKaryawan);
            if($save){
                move_uploaded_file($tmp_file,$url);
                $dataUpload = array(
                                    ':id_karyawan'=>$save,
                                    ':filename'=>$nama_file,
                                    ':url'=>$url,
                                    ':tgl_upload'=>$create_date,
                                    );
                $db->saveUpload($dataUpload);

            }
?>
        <script>alert('Your data has been save.');</script>
        <script>document.location.href='index.php?f=user&p=user&action=';</script><?php
    }else{ 
?>
        <script>alert('File is failed or file is too large!!');</script>
        <script>document.location.href='index.php?f=user&p=user&action=formAddAsd';</script>
<?php 
    }
//========================= Proses Edit Photo ================================
}elseif(isset($_POST['SAVE_PHOTO'])) {
        $nama_file = $_FILES['IMAGE']['name'];
        $tmp_file = $_FILES['IMAGE']['tmp_name'];
        $ukuran = $_FILES['IMAGE']['size'];
        $code = $_POST['CODE'];

        $uploadDir = "files/fp-asdos/$code/";
        $url = $uploadDir.$nama_file;

        if(!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if(!empty($nama_file) && $ukuran <= 2048000){ 
                unlink($photo);
                move_uploaded_file($tmp_file,$url);
                $db->editPhoto($session_id, $nama_file, $tmp_file, $url);
        ?>
                <script>alert('Your image has been change.');</script>
                <script>document.location.href='index.php?f=user&p=user&action=changePhoto';</script>
<?php }else{ ?>
        <script>alert('Please select image to upload!!');</script>
        <script>document.location.href='index.php?f=user&p=user&action=changePhoto';</script>
<?php }
//========================= Proses Edit Karyawan ================================
}elseif(isset($_POST['EDIT_ASDOS'])) {
        $id_karyawan = $_POST['ID_KARYAWAN'];
        $id_code = $_POST['ID_CODE'];
        $firstname = $_POST['FIRSTNAME'];
        $lastname = $_POST['LASTNAME'];
        $name = $_POST['FIRSTNAME']." ".$_POST['LASTNAME'];
        $jobTitle = $_POST['JOB_TITLE'];
        $kota_lahir = $_POST['KOTA_LAHIR'];
        $tgl_lhr = $_POST['TGL_LAHIR'];
        $gender = $_POST['JNS_KL'];
        $phone = $_POST['PHONE'];
        $email = $_POST['EMAIL'];
        $address = $_POST['ADDRESS'];
        $join = $_POST['JOIN'];
        $out = $_POST['OUT'];
        $update_date = date('Y-m-d H:i:s');
        $url_old = $_POST['URL'];
        $nama_file = $_FILES['UPLOAD']['name'];
        $ukuran = $_FILES['UPLOAD']['size'];
        $tmp_file = $_FILES['UPLOAD']['tmp_name'];

        if(empty($nama_file)) {
            $dataEdit = array(
                            ':id_karyawan'=>$id_karyawan,
                            ':id_code'=>$id_code,
                            ':firstname'=>$firstname,
                            ':lastname'=>$lastname,
                            ':fullname'=>$name,
                            ':jobTitle'=>$jobTitle,
                            ':kota_lahir'=>$kota_lahir,
                            ':tgl_lhr'=>$tgl_lhr,
                            ':gender'=>$gender,
                            ':phone'=>$phone,
                            ':email'=>$email,
                            ':address'=>$address,
                            ':join'=>$join,
                            ':out'=>$out,
                            ':update_id'=>$session_id,
                            ':update_date'=>$update_date
                    );
            $db->editKaryawan($dataEdit); 
?>
            <script>alert('Your data is updated.');</script>
            <script>document.location.href='index.php?f=user&p=user&num=<?php echo $id_karyawan; ?>&action=viewAsd';</script>
<?php }else{
        $dataEdit = array(
                        ':id_karyawan'=>$id_karyawan,
                        ':id_code'=>$id_code,
                        ':firstname'=>$firstname,
                        ':lastname'=>$lastname,
                        ':fullname'=>$name,
                        ':jobTitle'=>$jobTitle,
                        ':kota_lahir'=>$kota_lahir,
                        ':tgl_lhr'=>$tgl_lhr,
                        ':gender'=>$gender,
                        ':phone'=>$phone,
                        ':email'=>$email,
                        ':address'=>$address,
                        ':join'=>$join,
                        ':out'=>$out,
                        ':update_id'=>$session_id,
                        ':update_date'=>$update_date
                        );
        if($db->editKaryawan($dataEdit)) {

            $uploadDir = "files/fp-asdos/$id_code/";
            $url = $uploadDir.$nama_file;

            if(!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if($ukuran <= 2048000){ 
                unlink($url_old);
                move_uploaded_file($tmp_file,$url);
                $db->editPhoto($id_karyawan, $nama_file, $tmp_file, $url);
?>
                <script>alert('Your data is updated.');</script>
                <script>document.location.href='index.php?f=user&p=user&num=<?php echo $id_karyawan; ?>&action=viewAsd';</script>
<?php 
            }
        }
    }
}