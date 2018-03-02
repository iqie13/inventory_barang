            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form" style="text-align:top">
                                <span class="chat-img pull-left">
                                    <?php if(empty($photo)){ ?>
                                        <a href="index.php?f=user&p=user&action=changePhoto" id="img" data-toggle="tooltip" data-placement="right" title="Change Photo">
                                            <img src='files/no-photo.jpg' alt="User Avatar" class="img-thumbnail usr-img" />
                                        </a>
                                    <?php }else{ ?>
                                        <a href="index.php?f=user&p=user&action=changePhoto" id="img" data-toggle="tooltip" data-placement="right" title="Change Photo">
                                            <img src='<?php echo $photo; ?>' alt="User Avatar" class="img-thumbnail usr-img"/>
                                        </a>
                                    <?php } ?>
                                </span>
                                <span class="usr-panel">
                                    <b style="font-size:14px;"><?php echo ucfirst($session_nama); ?></b><br />
                                    Level : <b><?php echo $session_user->getJobName($session_jobT); ?></b><br />
                                    Last Login : <br />
                                    <?php echo $session_time; ?>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="?f=dashboard&p=dashboard"><i class="glyphicon glyphicon-home"></i> Dashboard</a>
                        </li>
                        <?php if($session_jobT == 1) { ?>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-user"></i> HR Management<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="?f=user&p=user&action="><i class="glyphicon glyphicon-lock"></i> Employee Management</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php } ?>
						<?php if($session_jobT == 1 || $session_jobT == 2) { ?>
							<li>
								<a href="#"><i class="glyphicon glyphicon-folder-open"></i> Master<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="?f=master&p=supplier&action="><i class="glyphicon glyphicon-book"></i> Supplier</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="glyphicon glyphicon-briefcase"></i> Warehouse<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="?f=inventory&p=inventoryStock&action="><i class="glyphicon glyphicon-compressed"></i> Inventory Stock</a>
									</li>
								</ul>
							</li>
						<?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->