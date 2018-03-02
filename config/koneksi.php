<?php 
class koneksi {
	protected $dsn = "mysql:dbname=db_inventory;host=127.0.0.1";
	protected $user = "root";
	protected $dbPass = "";
	protected $conn;

	public function __construct() {
		try {
		  	$pdo = new PDO($this->dsn, $this->user, $this->dbPass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
		  	$this->conn = &$pdo;

		 } catch (PDOException $e) {
			  echo "Koneksi ke database gagal: ".$e->getMessage();
			  die();
		 }
	}

	public function __destruct() {
		try {
            $this->conn = null; //Closes connection
        } catch (PDOException $e) {
            file_put_contents("log/dberror.log", "Date: " . date('M j Y - G:i:s') . " ---- Error: " . $e->getMessage().PHP_EOL, FILE_APPEND);
            die($e->getMessage());
        }
	}
}