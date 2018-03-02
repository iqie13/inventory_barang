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
                Staff Profile Update
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <?php 
                $npm = $_GET['num'];
                // echo "aaaaaaaaaa".$_GET['num']; 
                $view = $db->viewProfile($npm);
                //print "<pre>".print_r($view, 1)."</pre>";
                foreach($view as $d => $vals){
                        if($vals['tgl_lahir'] != "0000-00-00") {
                                $str = strtotime($vals['tgl_lahir']); 
                                $birthDate = date('Y-m-d',$str);
                        }else{
                                $birthDate = "";
                        }

                        if($vals['join_date'] != "0000-00-00") {
                                $jo = strtotime($vals['join_date']);
                                $join = date('Y-m-d', $jo);
                        }else{
                                $join = "";
                        }
                        if($vals['out_date'] != "0000-00-00") {
                                $od = strtotime($vals['out_date']);
                                $out = date('Y-m-d',$od);
                        }else{
                                $out = "";
                        }
                        if(!empty($vals['id_code'])) {
                            $id_code = $vals['id_code'];
                        }else{
                            $id_code = $db->randomCode();
                        }
            ?>
                <form enctype="multipart/form-data" id="form-asdos" action="index.php?f=user&p=user&action=proAddUser" method="POST">
                    <div class="row">
                            <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="npm">ID Number</label>
                                <input type="text" id="npm" class="input-block-level validate[required]" name="ID_CODE" value="<?php echo $id_code;?>" style="width:50%" readonly />
                                    <input type="hidden" id="id" name="ID_KARYAWAN" value="<?php echo $vals['id_karyawan']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Firstname</label>
                                    <input type="text" id="firstname" class="input-block-level validate[required]" name="FIRSTNAME" value="<?php echo $vals['firstname']; ?>" style="width:50%" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lastname</label>
                                    <input type="text" id="lastname" class="input-block-level validate[required]" name="LASTNAME" value="<?php echo $vals['lastname']; ?>" style="width:50%" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Job Title</label>
                                    <select id="job-title" class="input-block-level validate[required]" name="JOB_TITLE" style="width:50%">
                                        <option value="">--Select--</option>
                                        <?php foreach($db->jobTitle() as $jt) { ?>
                                                <option value="<?php echo $jt['id_job_title']; ?>"
                                                <?php if($jt['id_job_title'] == $vals['id_job_title']) {
                                                                echo "selected";
                                                        }?>
                                                ><?php echo $jt['nama_job_title']; ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Birth Place</label>
                                <span class="ui-widget">
                                    <select id="kota" class="input-block-level validate[required]" name="KOTA_LAHIR" style="width:50%">
                                    <option value="">--Select--</option>
                                        <?php foreach($db->autoComplete() as $kt) { ?>
                                                <option value="<?php echo $kt['kode_kota']; ?>"
                                                <?php 
                                                    if($kt['kode_kota'] == $vals['kota_lahir']) {
                                                        echo "selected";
                                                    }
                                                ?>        
                                                ><?php echo $kt['nama_kota']; ?></option>
                                        <?php } ?>
                                    </select>
                                    </span>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Birthdate</label>
                                    <input type="text" id="tgl-lahir" class="input-block-level validate[required]" name="TGL_LAHIR" style="width:50%" placeholder="Click here" value="<?php echo $birthDate; ?>" readonly />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Gender</label>
                                    <label class="radio-inline">
                                                                    <input type="radio" name="JNS_KL" id="inlineRadio1" class="validate[required]" value="L" 
                                                                    <?php if($vals['gender'] == 'L'){ ?>
                                                                                    checked 
                                                                    <?php } ?> /> Laki-laki
                                                            </label>
                                                            <label class="radio-inline">
                                                                    <input type="radio" name="JNS_KL" id="inlineRadio2" class="validate[required]" value="P" 
                                                                    <?php if($vals['gender'] == 'P'){ ?>
                                                                                    checked 
                                                                    <?php } ?> /> Perempuan
                                                            </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Phone Number</label>
                                    <input type="text" id="phone" class="input-block-level validate[required,custom[phone]]" name="PHONE" value="<?php echo $vals['no_telp']; ?>" style="width:50%" />
                            </div>
                            </div>
                            <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email</label>
                                            <input type="text" id="email" class="input-block-level validate[required,custom[email]]" name="EMAIL" value="<?php echo $vals['email']; ?>" style="width:50%" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Address</label>
                                            <textarea id="address" class="form-control validate[required]" name="ADDRESS" rows="6" style="width:60%"><?php echo $vals['alamat']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Join Date</label>
                                            <input type="text" id="join" class="input-block-level validate[required]" name="JOIN" style="width:50%" placeholder="Click here" value="<?php echo $join; ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Out Date</label>
                                            <input type="text" id="out" class="input-block-level" name="OUT" style="width:50%" placeholder="Click here" value="<?php echo $out; ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                            <label class="col-sm-4 control-label">Upload Photo (3x4)</label>
                                        <?php if(!empty($vals['url'])) { ?>
                                                            <img src='<?php echo $vals['url']; ?>' alt="User Avatar" class="img-thumbnail img-edit"/>
                                                                            <input type="hidden" name="URL" value="<?php echo $vals['url']; ?>" />
                                                    <?php }else{ ?>
                                                                            <img src='files/no-photo.jpg' alt="User Avatar" class="img-thumbnail img-edit"/>
                                                    <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"></label>
                                            <input type="file" name="UPLOAD" id="upload" class="upload" />
                                    </div>
                            </div>
                    </div>
                    <div class="form-actions">
                            <input type="submit" class="btn btn-primary" name="EDIT_ASDOS" value="Save" />
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>