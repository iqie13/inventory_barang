<div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="?f=user&p=user&action=">User management</a></li>
                <li>Change Photo</li>
            </ol>
        </div>
    </div>
    <div class="row">
	<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Change Photo
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <form enctype="multipart/form-data" id="form-upload" action="index.php?f=user&p=user&action=proAddUser" method="POST">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <?php if(!empty($photo)) { ?>
                                            <img src='<?php echo $photo; ?>' alt="User Avatar" class="img-thumbnail img-change"/>
                                    <?php }else{ ?>
                                            <img src='files/no-photo.jpg' alt="User Avatar" class="img-thumbnail img-change"/>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <span style="float:left;width:40%">
                                        <input type="file" name="IMAGE" id="image" class="validate[required] upload file" />
                                        <input type="hidden" name="CODE" id="url" class="validate[required]" value="<?php echo $session_code; ?>" />
                                    </span>
                                    <span style="float:left">
                                        <input type="submit" class="btn btn-primary btn-xs" name="SAVE_PHOTO" value="Upload" />
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
	        </div>
	    </div>
        </div>
    </div>