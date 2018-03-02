<div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="?f=user&p=user&action=">User management</a></li>
                <li>Create Staff</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Staff Profile
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form enctype="multipart/form-data" id="form-asdos" action="index.php?f=user&p=user&action=proAddUser" method="POST">
                        <div class="row">
                            <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="npm">Code Number</label>
                                <input type="text" id="npm" class="input-block-level validate[required]" name="NPM" style="width:50%" value="<?php echo $db->randomCode(); ?>" readonly="true" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Firstname</label>
                                    <input type="text" id="firstname" class="input-block-level validate[required]" name="FIRSTNAME" style="width:50%" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lastname</label>
                                    <input type="text" id="lastname" class="input-block-level validate[required]" name="LASTNAME" style="width:50%" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Job Title</label>
                                    <select id="job-title" class="input-block-level validate[required]" name="JOB_TITLE" style="width:50%">
                                        <option value="">--Select--</option>
                                        <?php foreach($db->jobTitle() as $zxc) { ?>
                                                <option value="<?php echo $zxc['id_job_title']; ?>"><?php echo $zxc['nama_job_title']; ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Birth Place</label>
<!--		                            <span class="ui-widget">
                                    <input type="text" id="kota" class="input-block-level validate[required]" name="KOTA_LAHIR" style="width:50%" />
                                </span>-->
                                <select id="kota" class="input-block-level validate[required]" name="KOTA_LAHIR" style="width:50%">
                                    <option value="">--Select--</option>
                                    <?php foreach($db->autoComplete() as $kt) { ?>
                                            <option value="<?php echo $kt['kode_kota']; ?>"><?php echo $kt['nama_kota']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Birthdate</label>
                                    <input type="text" id="tgl-lahir" class="input-block-level validate[required]" name="TGL_LAHIR" style="width:50%" placeholder="Click here" readonly />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Gender</label>
                                    <label class="radio-inline">
                                                                    <input type="radio" name="JNS_KL" id="inlineRadio1" class="validate[required]" value="L"> Laki-laki
                                                            </label>
                                                            <label class="radio-inline">
                                                                    <input type="radio" name="JNS_KL" id="inlineRadio2" class="validate[required]" value="P"> Perempuan
                                                            </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Phone Number</label>
                                    <input type="text" id="phone" class="input-block-level validate[required,custom[phone]]" name="PHONE" style="width:50%" />
                            </div>
                            </div>
                            <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email</label>
                                            <input type="text" id="email" class="input-block-level validate[required,custom[email]]" name="EMAIL" style="width:50%" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Address</label>
                                            <textarea id="address" class="form-control validate[required]" name="ADDRESS" rows="6" style="width:60%"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Join Date</label>
                                            <input type="text" id="join" class="input-block-level validate[required]" name="JOIN" style="width:50%" placeholder="Click here" readonly value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Upload Photo (3x4)</label>
                                            <input type="file" name="upload" id="upload" class="validate[required] upload" />
                                    </div>
                            </div>
                        </div>
                        <div class="form-actions">
                        	<input type="submit" class="btn btn-primary" name="SAVE_KARYAWAN" value="Save" />
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->