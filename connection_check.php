<?php 
class connection_check extends koneksi {
	public function __construct() {
		parent::__construct();
	}

	public function test() {
        echo $this->conn;
	}
}
?>