<?php

if (version_compare(phpversion(), '5.3.0', '>=') == 1) {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    error_reporting(E_ALL & ~E_NOTICE);
}

class InventoryModel extends koneksi {

	public function __construct() {
		parent::__construct();
	}
        
        public function inventoryProvider() {
            $query = $this->conn->prepare("select a.* from tblbarang a");
            $query->execute();
            return $query;
	}
        
        public function saveInventory($dataInventory) {
            $save = $this->conn->prepare("insert into tblbarang (nama_barang, kode_sn, kode_jenis, qty_barang, satuan, expired_date, currency_id, harga, kode_suplier, description, warehouse_id, create_id, create_date) 
                                          values (:inventory_name, :serial_number, :inventory_code, :quantity, :satuan, :expired_date, :currency_id, :price, :supplier_id, :description, :warehouse_id, :create_id, :create_date)");
            $save->execute($dataInventory);
            return $save;
	}
        
        public function selectStock($id) {
            $query = $this->conn->prepare("select a.* from tblbarang a where a.id_barang = ".$id);
            $query->execute();
            $data = $query->fetch();
            return $data;
	}
        
        public function updateInventory($dataSupplier) {
            $update = $this->conn->prepare("update tblbarang set "
                    . "nama_barang=:inventory_name, "
                    . "kode_sn=:serial_number, "
                    . "kode_jenis=:inventory_code, "
                    . "qty_barang=:quantity, "
                    . "satuan=:satuan, "
                    . "expired_date=:expired_date, "
                    . "currency_id=:currency_id, "
                    . "harga=:price, "
                    . "kode_suplier=:supplier_id, "
                    . "description=:description, "
                    . "warehouse_id=:warehouse_id, "
                    . "update_id=:update_id, "
                    . "update_date=:update_date "
                    . "where id_barang = :inventory_id");
            $update->execute($dataSupplier);
            return $update;
        }
        
        public function deactiveSupplier($id, $statusSupplier) {
            $blok = $this->conn->prepare("update tblsuplier set status = '$statusSupplier' where kode_suplier = $id");
            $blok->execute();
        }
        
        public function getInventoryCode($id) {
            $query = $this->conn->prepare("select a.* from tbljnsbarang a where a.kode_jenis = ".$id);
            $query->execute();
            $data = $query->fetch();
            
            return $data['nama_jenis'];
        }
        
        public function getInventoryCurrency($id) {
            $query = $this->conn->prepare("select a.* from tblcurrency a where a.currency_id = ".$id);
            $query->execute();
            $data = $query->fetch();
            
            return $data['currency_code'];
        }
        
        public function inventoryCode() {
            $query = $this->conn->prepare("select a.* from tbljnsbarang a order by kode_jenis asc");
            $query->execute();
            
            return $query;
        }
        
        public function currency() {
            $query = $this->conn->prepare("select a.* from tblcurrency a order by currency_id asc");
            $query->execute();
            
            return $query;
        }
        
        public function getSatuan() {
            return array(
                'Dus',
                'Pcs',
                'Liter',
                'Kg',
                'Ons',
                'Packs'
            );
        }
        
        public function supplier() {
            $query = $this->conn->prepare("select a.* from tblsuplier a order by kode_suplier asc");
            $query->execute();
            
            return $query;
        }
        
        public function warehouse() {
            $query = $this->conn->prepare("select a.* from tblwarehouse a order by warehouse_id asc");
            $query->execute();
            
            return $query;
        }
        
        public function getSupplier($id) {
            $query = $this->conn->prepare("select a.* from tblsuplier a where a.kode_suplier = ".$id);
            $query->execute();
            $data = $query->fetch();
            
            return $data['nama_suplier'];
        }
        
        public function getWarehouse($id) {
            $query = $this->conn->prepare("select a.* from tblwarehouse a where a.warehouse_id = ".$id);
            $query->execute();
            $data = $query->fetch();
            
            return $data['nama_warehouse'];
        }
}