<?php

if (version_compare(phpversion(), '5.3.0', '>=') == 1) {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    error_reporting(E_ALL & ~E_NOTICE);
}

class SupplierModel extends koneksi {

	public function __construct() {
		parent::__construct();
	}
        
        public function supplierProvider() {
            $query = $this->conn->prepare("select a.* from tblsuplier a");
            $query->execute();
            return $query;
	}
        
        public function saveSupplier($dataSupplier) {
            $save = $this->conn->prepare("insert into tblsuplier (nama_suplier,alamat,phone,contact_name,status,create_date) 
                                                        values (:supplier_name,:address,:phone,:contact_name,:status,:create_date)");
            $save->execute($dataSupplier);
            return $save;
	}
        
        public function selectSupplier($id) {
            $query = $this->conn->prepare("select a.* from tblsuplier a where a.kode_suplier = ".$id);
            $query->execute();
            $data = $query->fetch();
            return $data;
	}
        
        public function updateSupplier($dataSupplier) {
            $update = $this->conn->prepare("update tblsuplier set nama_suplier=:supplier_name, alamat=:address, phone=:phone, contact_name=:contact_name, status=:status, update_date=:update_date where kode_suplier = :kode_supplier");
            $update->execute($dataSupplier);
            return $update;
        }
        
        public function deactiveSupplier($id, $statusSupplier) {
            $blok = $this->conn->prepare("update tblsuplier set status = '$statusSupplier' where kode_suplier = $id");
            $blok->execute();
        }
}