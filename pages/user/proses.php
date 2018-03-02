<?php

if (version_compare(phpversion(), '5.3.0', '>=') == 1) {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    error_reporting(E_ALL & ~E_NOTICE);
}

class proses extends koneksi {

	public function __construct() {
		parent::__construct();
	}

	public function tampilData() {
		//$query = $this->conn->prepare("select * from tbluser");
                $query = $this->conn->prepare("select a.* from dataUser a");
		$query->execute();
		return $query;
	}

	public function tampilDataKaryawan() {
		$sql = $this->conn->prepare("select a.* from tblkaryawan a ORDER BY a.fullname ASC");
		$sql->execute();
		return $sql;
	}
        
        public function cityName($id) {
            $sql = $this->conn->prepare("select a.nama_kota from tblkota a where kode_kota = ".$id);
            $sql->execute();
            
            foreach($sql as $k) {
                return $k['nama_kota'];
            }
        }

	public function autoComplete() {
            $data = $this->conn->prepare("select kode_kota, nama_kota from tblkota order by nama_kota ASC");
            $data->execute();
            
            return $data;
	}

	public function saveUser($dataUser) {
		$save = $this->conn->prepare("insert into tbluser (id_karyawan,username,password,email,no_telp,active,create_id,create_date) 
                                                            values (:id_karyawan,:username,:password,:email,:telpon,:active,:create_id,:create_date)");
		$save->execute($dataUser);
	}

	public function deleteUser($id) {
		$delete = $this->conn->prepare("delete from admin where id = $id");
		$delete->execute();
	}

	public function blokirUser($id, $status) {
		$blok = $this->conn->prepare("update tbluser set active = '$status' where id_user = $id");
		$blok->execute();
		
		$this->deleteFailed($id);
	}
	
	public function deleteFailed($id) {
		$delete = $this->conn->prepare("delete from tblfailed where id_user = $id");
		$delete->execute();
	}

	public function blokirAsd($id, $status) {
		$date = date('Y-m-d');
		$blok = $this->conn->prepare("update tblkaryawan set status = '$status', out_date = '$date' where id_karyawan = $id");
		$blok->execute();
	}

	public function saveKaryawan($dataKaryawan) {
		$save = $this->conn->prepare("insert into tblkaryawan (id_code, firstname, lastname, fullname, kota_lahir, tgl_lahir, gender, no_telp, email, alamat, status, id_job_title, join_date, create_id, create_date) 
										values (:no_id, :firstname, :lastname, :name, :ttl, :tgl_lhr, :jk, :no_telp, :email, :alamat, :status, :jobTitle, :join_date, :create_id, :create_date)");
		$save->execute($dataKaryawan);
		return $this->conn->lastInsertId();
	}

	public function saveUpload($dataUpload) {
		$upload = $this->conn->prepare("insert into tblphotokaryawan (id_karyawan, filename, url, tgl_upload) 
										values (:id_karyawan, :filename, :url, :tgl_upload)");
		$upload->execute($dataUpload);
	}

	public function cekPhoto($id) {
		$cekP = $this->conn->prepare("select * from tblphotokaryawan where id_karyawan = $id");
		$cekP->execute();
		$count = $cekP->rowCount();
		return $count;
	}

	public function editPhoto($id, $nama_file, $tmp_file, $url) {
		$count = $this->cekPhoto($id);
		$tanggal = date('Y-m-d H:i:s');

		if($count == 1) {
			$upload = $this->conn->prepare("update tblphotokaryawan set filename='$nama_file', url='$url', tgl_upload='$tanggal' where id_karyawan = '$id'");
			$upload->execute();
		}else{
			$upload = $this->conn->prepare("insert into tblphotokaryawan(id_karyawan, filename, url, tgl_upload) 
										values ('$id', '$nama_file', '$url', '$tanggal')");
			$upload->execute();
		}
	}

	public function viewProfile($id) {
            $view = $this->conn->prepare("select 
                                        a.id_karyawan,
                                        a.id_code, 
                                        a.fullname,
                                        a.firstname,
                                        a.lastname, 
                                        a.kota_lahir, 
                                        a.tgl_lahir, 
                                        a.gender, 
                                        a.no_telp, 
                                        a.email, 
                                        a.alamat, 
                                        a.status, 
                                        a.id_job_title,
                                        a.join_date, 
                                        a.out_date,
                                        b.url
                                        from tblkaryawan a
                                        left join tblphotokaryawan b ON b.id_karyawan = a.id_karyawan
                                        where a.id_karyawan=".$id);
            $view->execute();
            $array = array();
            while ($feed = $view->fetch()) {
                $newarray = array();
                $newarray['id_karyawan'] =$feed['id_karyawan'];
                $newarray['id_code'] =$feed['id_code'];
                $newarray['url'] =$feed['url'];
                $newarray['kota_lahir'] =$feed['kota_lahir'];
                $newarray['fullname'] =$feed['fullname'];
                $newarray['firstname'] =$feed['firstname'];
                $newarray['lastname'] =$feed['lastname'];
                $newarray['tgl_lahir'] =$feed['tgl_lahir'];
                $newarray['gender'] =$feed['gender'];
                $newarray['no_telp'] =$feed['no_telp'];
                $newarray['email'] =$feed['email'];
                $newarray['alamat'] =$feed['alamat'];
                $newarray['status'] =$feed['status'];
                $newarray['id_job_title'] =$feed['id_job_title'];
                $newarray['join_date'] =$feed['join_date'];
                $newarray['out_date'] =$feed['out_date'];
                $array[] = $newarray;
	    }
	    return $array;
	}

	public function editKaryawan($data) {
		// print_r($data);
		// exit();
		$id_karyawan = $data[':id_karyawan'];
		$id_code = $data[':id_code'];
		$firstname = $data[':firstname'];
		$lastname = $data[':lastname'];
		$nama = $data[':fullname'];
		$jobTitle = $data[':jobTitle'];
		$ttl = $data[':kota_lahir'];
		$tgl_lhr = $data[':tgl_lhr'];
		$jk = $data[':gender'];
		$no_telp = $data[':phone'];
		$email = $data[':email'];
		$alamat = $data[':address'];
		$join_date = $data[':join'];
		$out_date = $data[':out'];
		$update_id = $data[':update_id'];
		$update_date = $data[':update_date'];

		$edit = $this->conn->prepare("update tblkaryawan set 
                                                id_code = '$id_code', 
                                                firstname = '$firstname',
                                                lastname = '$lastname',
                                                fullname = '$nama',
                                                kota_lahir = '$ttl',
                                                tgl_lahir = '$tgl_lhr',
                                                gender = '$jk',
                                                no_telp = '$no_telp',
                                                email = '$email',
                                                alamat = '$alamat',
                                                id_job_title = '$jobTitle',
                                                join_date = '$join_date',
                                                out_date = '$out_date',
                                                update_id = '$update_id',
                                                update_date = '$update_date'
                                                where id_karyawan = '$id_karyawan'");
		$edit->execute();
                return $edit;
	}

	public function userValid($username) {
		$valid = $this->conn->prepare("select a.username from tbluser a where username = '$username'");
		$valid->execute();
		$count = $valid->rowCount();
		return $count;
	}

	public function jobTitle() {
		$job = $this->conn->prepare("select a.id_job_title, a.nama_job_title from tbljobtitle a");
		$job->execute();
		return $job;
	}
        
        public function jobTitleName($id) {
		$job = $this->conn->prepare("select a.id_job_title, a.nama_job_title from tbljobtitle a where a.id_job_title = ".$id);
		$job->execute();
                $data = $job->fetch();
		return $data['nama_job_title'];
	}
        
        public function randomCode()
        {
            $YEAR = date('Y');
            $MONTH = date('m');
            $NUMB_1 = rand(0, 9);
            $NUMB_2 = rand(0, 9);
            $NUMB_3 = rand(0, 9);
            $NUMB_4 = rand(0, 9);

            $CHAR_1 = ($NUMB_1 < 4) ? rand(1, 10) : $NUMB_1;
            $CHAR_2 = ($NUMB_2 <= 5) ? rand(1, 10) : $NUMB_2;
            $CHAR_3 = ($NUMB_3 <= 6) ? rand(1, 10) : $NUMB_3;
            $CHAR_4 = ($NUMB_1 > 3) ? rand(1, 10) : $NUMB_1;
            $CHAR_5 = ($NUMB_2 >= 7) ? rand(1, 10) : $NUMB_2;
            $CHAR_6 = ($NUMB_3 >= 8) ? rand(1, 10) : $NUMB_3;

            $TRAN = $MONTH.$YEAR .'.'. $CHAR_1 . $CHAR_2 . $CHAR_3 . '.' .
                    $CHAR_4 . $CHAR_5 . $CHAR_6 . $NUMB_4;

            return $TRAN;
        }

}