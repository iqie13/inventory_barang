<?php
include('config/koneksi.php'); 

class Login extends koneksi {

	public function __construct() {
		parent::__construct();
	}

	public function LoginProcess($username, $password, $captcha) {
		$pass = md5($password);
		$cek = $this->conn->prepare("CALL loginProcess(:user, :pass)");
		$cek->bindParam(':user', $username, PDO::PARAM_STR, 4000);
		$cek->bindParam(':pass', $pass, PDO::PARAM_STR, 4000);
		// $cek = $this->conn->prepare("select a.asdos_id, a.username, a.password, a.email,a.blokir, b.nama, c.url from admin a
		// 								left join asdos b ON a.asdos_id = b.no_id
		// 								left join fp_asdos c ON a.asdos_id = c.asdos_id
		// 								where a.username = '$username' OR a.email = '$username' AND a.password = '$pass'");
		$cek->execute();
		$data = $cek->fetch();
		$row = $cek->rowCount();

//		 print "<pre>".print_r($data, 1)."</pre>";
//		 exit();
		if(($row > 0) && ($data['status'] == 1) && ($data['active'] == 1)) {
                    if(!$captcha) {
                        $_SESSION['login'] = true;
			return false;
                    }else{
                        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=YOUR SECRET KEY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
                        if($response.success==false)
                        {
                          echo '<h2>You are spammer ! Get the @$%K out</h2>';
                        }else{
                            $_SESSION['login'] = true;
                            $_SESSION['id'] = $data['id_karyawan'];
                            $_SESSION['id_code'] = $data['id_code'];
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['id_job_title'] = $data['id_job_title'];
                            $_SESSION['nama'] = $data['nama_karyawan'];
                            $_SESSION['url'] = $data['url'];
                            //$_SESSION['akses'] = $data['hak_akses'];
                            $_SESSION['time'] = date('d-M-y h:i A');

                            $id = $data['id_user'];
                            $waktu = date('Y-m-d H:i:s');
                            $cek = null;
                            $this->dataLogin($id, $waktu);
                            $this->deleteFailed($id);
                            return true;
                        }
                    }
		}else{
			$_SESSION['login'] = true;
			return false;
		}
	}

	public function dataLogin($id, $waktu) {

		$log = $this->conn->prepare("insert into tblloglogin (id_user, tgl_login) values('$id','$waktu')");
		$log->execute();
	}

	public function get_session() {
		
		return $_SESSION['login'];
	}
	
	public function loginFailed($username, $password, $captcha) {
		$cek = $this->conn->prepare("CALL failed(:user)");
		$cek->bindParam(':user', $username, PDO::PARAM_STR, 4000);
		$cek->execute();
		$data = $cek->fetch();
		$id_user = $data['id_user'];
		$user = $data['username'];
		$active = $data['active'];
		$waktu = date('Y-m-d H:i:s');
		$cek = null;
		if(!empty($id_user) && $captcha) {
                    $fail = $this->conn->prepare("select count(id_user) as count, date_format(date_time,'%d-%m-%Y') as date_time from tblfailed where id_user = $id_user and date_format(date_time, '%d-%m-%Y') = date_format(now(),'%d-%m-%Y')");
                    $fail->execute();
                    $f = $fail->fetch();
                    $cou = $f['count'];
                    $date = date('d-M-y', strtotime($f['date_time']));
                    $now = date('d-M-y');
                    $fail = null;
                    if(!empty($data) && $cou < '2' && $active == '1') {
                            $log = $this->conn->prepare("insert into tblfailed (id_user, username, date_time) values('$id_user','$user','$waktu')");
                            $log->execute();
                            ?>
                                    <script>
                                            alert("Username and Password are wrong!!"); 
                                            window.open('login.php', '_self');
                                    </script>
                            <?php
                    }elseif(!empty($data) && $cou > '1' && $active == '1'){
                            $log = $this->conn->prepare("update tbluser set active = '0' where id_user = $id_user");
                            $log->execute();
                            ?>
                                    <script>
                                            alert("Your account is blocked!!"); 
                                            window.open('login.php', '_self');
                                    </script>
                            <?php
                    }elseif(!empty($data) && $active == '0'){
                            ?>
                                    <script>
                                            alert("Your account is blocked!!"); 
                                            window.open('login.php', '_self');
                                    </script>
                            <?php
                    }
		}elseif(empty($id_user)) {
			?>
				<script>
					alert("Username can not be exist!!"); 
					window.open('login.php', '_self');
				</script>
			<?php
		}elseif(empty($username) && empty($password)) {
			?>
				<script>
					alert("Username and Password can not be empty!!"); 
					window.open('login.php', '_self');
				</script>
			<?php
                }elseif(!empty($id_user) && !$captcha){
                ?>
                        <script>
                            alert('Please input captcha'); 
                            window.open('login.php', '_self');
                        </script>
                <?php
                }
	}
	
	public function deleteFailed($id) {
		$delete = $this->conn->prepare("delete from tblfailed where id_user = $id");
		$delete->execute();
	}

	public function user_logout()
	{
		$_SESSION['login'] = false;
		session_destroy();
	}

	public function getUrlImage($id) {
		$url = $this->conn->prepare("select url from tblphotokaryawan where id_karyawan = $id");
		$url->execute();
		while($feed = $url->fetch()) {
			$photo = $feed['url'];
		}
		if(!empty($photo)){
			return $photo;
		}else{
			return false;
		}
	}
        
	public function getNameImage($id) {
		$url = $this->conn->prepare("select filename from tblphotokaryawan where id_karyawan = $id");
		$url->execute();
		while($feed = $url->fetch()) {
			$photo = $feed['filename'];
		}
		if(!empty($photo)){
			return $photo;
		}else{
			return false;
		}
	}
        
        public function getJobName($id) {
		$job = $this->conn->prepare("select a.id_job_title, a.nama_job_title from tbljobtitle a where a.id_job_title = ".$id);
		$job->execute();
                $data = $job->fetch();
		return $data['nama_job_title'];
	}

	public function __destruct() {
		parent::__destruct();
	}
}