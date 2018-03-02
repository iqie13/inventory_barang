<?php 
    include("SupplierModel.php");
    $db=new SupplierModel();
    $query = $db->supplierProvider();
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <?php 
            if($_GET['action'] == '') { 
                include_once 'admin.php';
            }elseif($_GET['action'] == 'formAddSupplier') {
                include_once 'create.php';
            }elseif($_GET['action'] == 'proAddSupplier') { 
                include_once 'save.php';
            }elseif($_GET['action'] == 'formUpdateSupplier') { 
                include_once 'form_update.php';
            }elseif($_GET['action'] == 'proUpdateSupplier') { 
                include_once 'update.php';
            } 
        ?>
        </div>
    </div>
</div>

<script>
    function noBack(){
        window.history.forward();
    }
        
    $(document).ready(function(){
        $("#form-supplier").validationEngine();
    });
    
    $(document).ready(function() {

        var table = $('#dataTables-supplier').dataTable({
        	"iDisplayLength": 5,
        	"aLengthMenu": [5, 10, 25, 50, 100],
        });
    });
    
    function deactiveSupplier(id, status) {
    	// alert(blok);
        $( "#dialog-supplier" ).dialog({
                resizable: false,
                width:380,
                modal: true,
                buttons: {
                Yes: function() {
                                // alert(val);
                        $.ajax({
                            url : 'index.php?f=master&p=deactiveSupplier',
                            data: {ID:id, STATUS:status},
                            type: 'POST',
                            success : function(data){
                                $( "#dialog-supplier" ).dialog( "close" );
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
</script>