<?php 
include("Proses.php");
$db=new Proses();

$birth = $db->birthday();
//$event = $db->event();
//$coEvent = $db->countEvent();
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bullhorn fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $coEvent ?></div>
                            <div>Event are on going!</div>
                        </div>
                    </div>
                </div>
                <a href="?f=event&p=event&action=">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>New Tasks!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>New Orders!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>Support Tickets!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-bullhorn"></i> On Going Event
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php if(!empty($event)) { ?>
                    <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Start Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach ($event as $k => $data) { 
                                        ?>
                                            <tr>
                                                <td><?php echo $data['event_name']; ?></td>
                                                <td>
                                                    <?php 
                                                        $str = strtotime($data['event_start']);
                                                        $date = date('d F Y',$str);
                                                        echo $date; 
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{ ?>
                                <i>No event at this month</i>
                        <?php 
                            }
                        ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-gift"></i> Staff Birthdays - <?php echo date('F'); ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <?php if(!empty($birth)) { ?>
                    <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Job Title</th>
                                            <th>Birthday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach ($birth as $k => $data) { 
                                        ?>
                                            <tr>
                                                <td><?php echo $data['nama']; ?></td>
                                                <td><?php echo $data['nama_job_title']; ?></td>
                                                <td>
                                                    <?php 
                                                        $str = strtotime($data['tgl_lhr']);
                                                        $date = date('d F',$str);
                                                        echo $date; 
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{ ?>
                                <i>No birthday at this month</i>
                        <?php 
                            }
                        ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
            <!-- /.panel -->
            
            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<script src="js/jquery-1.11.0.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<!-- <script src="js/plugins/morris/morris.min.js"></script> -->
<!-- <script src="js/plugins/morris/morris-data.js"></script> -->