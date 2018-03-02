<?php 
    include("../../config/koneksi.php");
    include("SupplierModel.php");
    $db=new SupplierModel();
    $query = $db->supplierProvider();
    
    $requestData= $_REQUEST;
    $dataJson = array();
    while($data = $query->fetch()){
            $aa = array();
            $aa[] = $data['kode_suplier'];
            $aa[] = $data['nama_suplier'];
            $aa[] = $data['alamat'];
            $aa[] = $data['status'];
            
            $dataJson[] = $aa;
    }
    
    $json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => '',  // total number of records
			"recordsFiltered" => '', // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $dataJson   // total data array
			);
    
    echo json_encode($json_data);
?>