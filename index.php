<?php
ob_start(); 
session_start();
include_once 'pages/login/Login.php';
include_once 'component/Routes.php';
$session_user = new Login();
$routes = new Routes();

$session_id = $_SESSION['id'];
$session_code = $_SESSION['id_code'];
$session_username = $_SESSION['username'];
$session_jobT = $_SESSION['id_job_title'];
$session_nama = $_SESSION['nama'];
$session_time = $_SESSION['time'];
$session_url = $_SESSION['url'];
//$session_akses = $_SESSION['akses'];

if (!$session_user->get_session()) {
    header("location:login.php");
}

if (!empty($session_id)) {
    $photo = $session_user->getUrlImage($session_id);
    $filename = $session_user->getNameImage($session_id);
}

include('pages/timeout/session_timeout.php');
include('lib/function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/validationEngine.jquery.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="js/jquery-ui/jquery-ui.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet" type="text/css">

    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <style>
        .ui-dialog { 
            z-index: 3000 !important;
            margin-top: 25px;
            /*font-size: 12px;*/
        }
        .ui-widget-overlay .ui-front{
            z-index: 2000 !important;
        }
        .ui-dialog-titlebar, .ui-datepicker-header{
            background: #428bca !important;
            border:none !important;
        }
        .ui-datepicker-month, .ui-datepicker-year{
            color: #000 !important;
        }
    </style>

    <script type="text/javascript">
        
        (function($) {
            $.fn.checkFileType = function(options) {
                var defaults = {
                    allowedExtensions: [],
                    success: function() {},
                    error: function() {}
                };
                options = $.extend(defaults, options);
                return this.each(function() {

                    $(this).on('change', function() {
                        var value = $(this).val(),
                            file = value.toLowerCase(),
                            extension = file.substring(file.lastIndexOf('.') + 1);

                        if ($.inArray(extension, options.allowedExtensions) == -1) {
                            options.error();
                            $(this).focus();
                        } else {
                            options.success();

                        }              
                    });

                }); 
            };

        })($);
            
        $(function() {
            $('.upload').checkFileType({
                allowedExtensions: ['jpeg','jpg', 'png'],
                success: function() {
                },
                error: function() {
                    alert('Error!!! File must .jpg, .jpeg or .png');
                    $('.upload').val('');
                }
            });

        });
    </script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php include('navbar.php'); ?>

        <?php
            if(!empty($_GET['p'])){
                $p = $_GET['p'];
                $f = $_GET['f'];
                $access = $routes->accessRules();
                $jobName = strtolower($session_user->getJobName($session_jobT));
                $pages_dir = 'pages/'.$f;
                $pages = scandir($pages_dir, 0);
                unset($pages[0], $pages[1]);

                if(in_array($p.'.php', $pages) && !empty($access[$jobName])){
                    if(in_array($p, $access[$jobName])) {
                        include($pages_dir.'/'.$p.'.php');
                    }else{
                        include('pages/error_403.php');
                    }
                } else {
                    include('pages/blank.html');
                }
            } else {
                include('pages/dashboard/dashboard.php');
            }
        ?>

    </div>
    <div id="dialog-confirm" title="Warning" style="display:none;">
    <p>
    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These data will be deleted. Are you sure?</p>
    </div>

    <div id="dialog-conf" title="Warning" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to continue this action?</p>
    </div>
    
    <div id="dialog-supplier" title="Warning" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to continue this action?</p>
    </div>

    <div id="dialog-login" title="Warning" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
        </span>Your login session is time out!!</p>
    </div>
    <!-- /#wrapper -->

    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/jquery.maskMoney.min.js"></script>
    <script src="js/jquery.numeric.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.10.9/api/fnReloadAjax.js"></script>

    <script type="text/javascript">
//        window.onload = function() {
//            loadSession();
//        };
//        
//        function loadSession() {
//            var timeOut = '4000';
//            //alert(timeOut);
//            $.ajax({
//                url:'index.php',
//                type: 'GET',
//                data: {TIME:timeOut},
//                success: function() {
//                    
//                }
//            });
//        }
        
        $('#img').tooltip();
    </script>
</body>
</html>
<?php ob_flush(); ?>