<?php

include("proses.php");
$db=new proses();
$query = $db->tampilData();
$auto = $db->autoComplete();
 
?>

<div id="page-wrapper">
<?php 
    if($_GET['action'] == '') { 
    //======================== Halaman Utama Karyawan ==========================
        include_once "admin.php";
    }elseif($_GET['action'] == 'formAddUser') { 
    //============================ Form Add User ===============================
        include_once "userCreate.php";
    }elseif($_GET['action'] == 'formAddAsd') {
    //=========================== Form Add Karyawan ============================
        include_once "staffCreate.php";
    }elseif($_GET['action'] == 'changePhoto') {
    //============================= Change Photo ===============================
        include_once 'changePhoto.php';
    }elseif($_GET['action'] == 'viewAsd') {
    //============================= View Karyawan ==============================
        include_once 'viewStaff.php';
    }elseif($_GET['action'] == 'formEditAsd') { 
    //======================== Form Edit Karyawan ==============================
        include_once 'update.php'; 
    }elseif($_GET['action'] == 'proAddUser') {
    //========================= Proses Add User ================================
        include_once 'allProcess.php';
    } 
?>
</div>


<div id="dialog" title="Employee">
    <?php // echo $session_jobT; ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-pop">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                        <?php
                        foreach($db->tampilDataKaryawan() as $abc){
                        ?>               
                                <tr class="odd gradeX">
                                    <td><?php echo $abc['fullname']; ?></td>
                                    <td><?php echo $abc['no_telp']; ?></td>
                                    <td><?php echo $abc['email']; ?></td>
                                    <td><?php echo $db->jobTitleName($abc['id_job_title']); ?></td>
                                    <td align="center">
                                        <a id="<?php echo $abc['id_karyawan']; ?>" class="btn btn-primary btn-xs" onClick="select(this.id,'<?php echo $abc['fullname']; ?>', '<?php echo $abc['no_telp']; ?>', '<?php echo $abc['email']; ?>')">select</a>
                                        </td>
                                </tr>
                        <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
	// var $j = jQuery.noConflict();
    $(document).ready(function() {

        var table = $('#dataTables-user').dataTable({
        	"iDisplayLength": 5,
        	"aLengthMenu": [5, 10, 25, 50, 100],
        });
    });

    function hapus(val) {
        $( "#dialog-confirm" ).dialog({
			resizable: false,
			width:350,
			modal: true,
			buttons: {
			Yes: function() {
					// alert(val);
					$.ajax({
	                url : 'index.php?f=user&p=deleteUser',
	                data: {id : val},
	                type: 'POST',
	                success : function(data){
	                    $( "#dialog-confirm" ).dialog( "close" );
	                    location.reload();                 
	                }
	            });
			},
			No: function() {
				$( this ).dialog( "close" );
				}
			}
		});
    }

    function blokir(id,blok) {
    	// alert(blok);
        $( "#dialog-conf" ).dialog({
			resizable: false,
			width:380,
			modal: true,
			buttons: {
			Yes: function() {
					// alert(val);
					$.ajax({
	                url : 'index.php?f=user&p=blokirUser',
	                data: {ID:id, BLOK:blok},
	                type: 'POST',
	                success : function(data){
	                    $( "#dialog-conf" ).dialog( "close" );
	                    location.reload();                 
					},
					error : function() {
						alert('Error');
					}
	            });
			},
			No: function() {
				$( this ).dialog( "close" );
				}
			}
		});
    }

    function blokirAsd(id,blok) {
    	// alert(blok);
        $( "#dialog-conf" ).dialog({
			resizable: false,
			width:380,
			modal: true,
			buttons: {
			Yes: function() {
					// alert(val);
					$.ajax({
	                url : 'index.php?f=user&p=blokirAsd',
	                data: {ID:id, BLOK:blok},
	                type: 'POST',
	                success : function(data){
	                    $( "#dialog-conf" ).dialog( "close" );
	                    location.reload();                 
	                }
	            });
			},
			No: function() {
				$( this ).dialog( "close" );
				}
			}
		});
    }

    jQuery(document).ready(function() {
        jQuery('#dataTables-dsn').dataTable({
        	"iDisplayLength": 10,
        	"aLengthMenu": [5, 10, 25, 50, 100],
        });
    });

    jQuery(document).ready(function() {
        jQuery('#dataTables-pop').dataTable({
        	"iDisplayLength": 5,
        	"aLengthMenu": [5, 10, 25, 50, 100],
        });
    });

    var arrNama = <?php echo json_encode($auto); ?>;
	  $(document).ready(function() { 
	        $("#kota").autocomplete({
	          source: arrNama
	        });
	  });

	$(function() {
		$( "#dialog" ).dialog({
			autoOpen: false,
			modal:true,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#opener" ).click(function() {
	         $( "#dialog" ).dialog( "open" );
		});
	});

	$( "#delete" ).click(function() {
        $('#asdos').val('');
    	$('#nama').val('');
	});

	$( "#con-password" ).keyup(function() {
        var pass1 = $('#password').val();
        var pass2 = $('#con-password').val();
    	if(pass1 != pass2){
    		$('#warning1').show('500');
    		$('#warning2').show('500');
    		$('#ok1').hide();
    		$('#ok2').hide();
    	}else{
    		$('#warning1').hide();
    		$('#warning2').hide();
    		$('#ok1').show('500');
    		$('#ok2').show('500');
    	}
	});

	function select(id,nama, telp, email) {
            // alert(val);
            $( "#dialog" ).dialog( "close" );
            $('#asdos').val(id);
            $('#nama').val(nama);
            $('#telepon').val(telp);
            $('#email').val(email);
	 }

	 $('#tgl-lahir').datepicker({
        showAnim: 'fold',
        showOn: 'focus', 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '-35:+1',
        onSelect: function (dateText, inst){
            this.focus(); this.blur();this.focus();
        },
        // onClose: function( selectedDate ){
        //     jQuery( '#dateTo' ).datepicker( "option", "minDate", selectedDate );
        // }
    });

	 $('#join').datepicker({
        showAnim: 'fold',
        showOn: 'focus', 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '-5:+3',
        onSelect: function (dateText, inst){
            this.focus(); this.blur();this.focus();
        },
    });

	 $('#out').datepicker({
        showAnim: 'fold',
        showOn: 'focus', 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '-5:+3',
        onSelect: function (dateText, inst){
            this.focus(); this.blur();this.focus();
        },
    });

	 $(document).ready(function() {
	 	$('#username').change(function() {
	 		$('#loading').show();
	 		var username = $('#username').val();

	 		$.ajax({
	 			url : 'pages/user/usernameValid.php',
	 			type : 'POST',
	 			data : {username : username},
	 			success : function(data) {
	 				if(data == '1') {
	 					$('#loading').hide();
	 					$('#ok-user').hide();
	 					$('#warning-user').show();
	 					$('#msg').html('Username has been use');
	 					$('#username').val('');
	 					console.log(data);
	 				}else if(data == '0'){
	 					$('#loading').hide();
	 					$('#ok-user').show();
	 					$('#warning-user').hide();
	 					$('#msg').html('');
	 					console.log(data);
	 				}else if(data == 'null'){
	 					$('#loading').hide();
	 					$('#msg').html('');
	 				}
	 			}
	 		});
	 	})
	 });

	 window.history.forward(); 
     function noBack(){
            window.history.forward();
        }
        
        $(document).ready(function(){
            $("#form-user").validationEngine({
                promptPosition : "bottomLeft"
            });
    });

    function noBack(){
            window.history.forward();
        }
        
        $(document).ready(function(){
            $("#form-asdos").validationEngine();
    });

    function noBack(){
            window.history.forward();
        }
        
        $(document).ready(function(){
            $("#form-upload").validationEngine();
    });
</script>