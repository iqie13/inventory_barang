<?php 
    include("InventoryModel.php");
    $db=new InventoryModel();
    $query = $db->inventoryProvider();
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <?php 
            if($_GET['action'] == '') {
                include_once 'admin.php';
            }elseif($_GET['action'] == 'formAddStock') {
                include_once 'form_create.php';
            }elseif($_GET['action'] == 'proAddStock') { 
                include_once 'save.php';
            }elseif($_GET['action'] == 'formUpdateStock') {
                include_once 'form_update.php';
            }elseif($_GET['action'] == 'proUpdateStock') { 
                include_once 'update.php';
            }elseif($_GET['action'] == 'viewStock') { 
                include_once 'view.php';
            } 
        ?>
        </div>
    </div>
</div>

<div id="dialog-show-supplier" title="Supplier List">
    
</div>

<script>
    function noBack(){
        window.history.forward();
    }
        
    $(document).ready(function(){
        $("#form-inventory").validationEngine({
            promptPosition : "bottomLeft"
        });
    });
    
    $(document).ready(function(){
        $("#form-inventory-update").validationEngine({
            promptPosition : "bottomLeft"
        });
    });
    
    $(document).ready(function() {

        var table = $('#dataTables-inventory').dataTable({
        	"iDisplayLength": 20,
        	"aLengthMenu": [20, 40, 60, 80, 100],
        });
    });
    
//    $('#dg').datagrid({
//        url:'pages/transaction/itemJson.php',
//        height: 200,
//        pagination: true,
//        singleSelect: false,
//        selectOnCheck: false,
//        checkOnSelect: true,
//        collapsible: true,
//        rownumbers: true,
//        striped: true,
//        loadMsg: 'Loading...',
//        method: 'POST',
//        nowrap: false,
//        columns:[[
//            {field:'id_barang',title:'Code',width:100},
//            {field:'nama_barang',title:'Name',width:100},
//            {field:'price',title:'Price',width:100,align:'right'}
//        ]]
//    });
    
    $(function() {
        $('#PRICE').maskMoney();
        $("#QUANTITY").numeric();
    })
    
    $(function() {
        $( "#dialog-show-supplier" ).dialog({
            autoOpen: false,
            modal:true,
            width:900,
            show: {
                    //effect: "blind",
                    duration: 500
            },
            hide: {
                    //effect: "explode",
                    duration: 500
            }
        });

    });
    function searchSupplier() {
        $( "#dialog-show-supplier" ).dialog("open");
        $.ajax({
            url:'pages/inventory/supplierList.php',
            success: function(data) {
                $( "#dialog-show-supplier" ).html(data);
            }
        });
    }
    
    function selectSupplier(id, name) {
        $('#SUPPLIER_ID').val(id);
        $('#SUPPLIER').val(name);
        $( "#dialog-show-supplier" ).dialog("close");
    }
    
    $('#EXPIRED_DATE').datepicker({
        showAnim: 'fold',
        showOn: 'focus', 
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '-5:+3',
        onSelect: function (dateText, inst){
            this.focus(); this.blur();this.focus();
        },
    });
    
    function deleteDate() {
        $('#EXPIRED_DATE').val('');
    }
    
    function deleteSupplier() {
        $('#SUPPLIER').val('');
        $('#SUPPLIER_ID').val('');
    }
</script>