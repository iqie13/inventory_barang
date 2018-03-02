<div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="?f=user&p=user&action=">User management</a></li>
                <li>Create User</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create User Account
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
	            <form id="form-user" action="index.php?f=user&p=user&action=proAddUser" method="POST">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Full Name</label>
                            <input type="hidden" id="asdos" class="input-block-level validate[required]" name="ID_KARYAWAN" style="width:25%" readonly />
                            <input type="text" id="nama" class="input-block-level validate[required]" name="NAMA" style="width:25%" readonly />
                            <a style='cursor:pointer; text-decoration:none;' id="opener"><i class="glyphicon glyphicon-search"></i></a>
                            <a style='cursor:pointer; text-decoration:none;' id="delete"><i class="glyphicon glyphicon-trash"></i></a>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username</label>
                                <input type="text" id="username" class="input-block-level validate[required]" name="USERNAME" style="width:25%" />
                                <span id="ok-user"style="display:none"><i class="glyphicon glyphicon-ok" style="color:green"></i></span>
                                <span id="warning-user" style="display:none"><i class="glyphicon glyphicon-remove" style="color:red"></i></span>
                                <span id="loading" style="display:none"><img src="images/loading.gif"></span>
                                <span id="msg"></span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                                <input type="password" id="password" class="input-block-level validate[required,minSize[6]]" name="PASSWORD" style="width:25%" />
                                <span id="ok1"style="display:none"><i class="glyphicon glyphicon-ok" style="color:green"></i></span>
                                <span id="warning1" style="display:none"><i class="glyphicon glyphicon-remove" style="color:red"></i></span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm Password</label>
                                <input type="password" id="con-password" class="input-block-level validate[required,equals[password]]" name="CON_PASSWORD" style="width:25%" />
                                <span id="ok2"style="display:none"><i class="glyphicon glyphicon-ok" style="color:green"></i></span>
                                <span id="warning2" style="display:none"><i class="glyphicon glyphicon-remove" style="color:red"></i></span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                                <input type="text" id="telepon" class="input-block-level validate[required,custom[phone],maxSize[12]]" name="TELEPON" style="width:25%" />
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <input type="text" id="email" class="input-block-level validate[required,custom[email]]" name="EMAIL" style="width:25%" readonly="true" />
                        </div>
<!--	                        <div class="form-group">
                            <label class="col-sm-2 control-label">Privileges</label>
                                <label class="radio-inline">
                                                                <input type="radio" name="HAK_AKSES" id="inlineRadio1" class="validate[required]" value="1"> Admin
                                                        </label>
                                                        <label class="radio-inline">
                                                                <input type="radio" name="HAK_AKSES" id="inlineRadio2" class="validate[required]" value="0"> Asdos
                                                        </label>
                        </div>-->
                        <div class="form-actions">
                                <input type="submit" class="btn btn-primary" name="SAVE" value="Save" />
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