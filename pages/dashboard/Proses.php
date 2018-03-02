<?php

if (version_compare(phpversion(), '5.3.0', '>=') == 1) {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    error_reporting(E_ALL & ~E_NOTICE);
}

class Proses extends koneksi {

	public function __construct() {
		parent::__construct();
	}

	public function birthday() {
		$today = date('m');
		$birth = $this->conn->prepare("select a.fullname, b.nama_job_title, a.tgl_lahir from tblkaryawan a 
										left join tbljobtitle b ON a.id_job_title = b.id_job_title
										where DATE_FORMAT(a.tgl_lahir,'%m') = '$today' limit 10");
		$birth->execute();
		$array = array();
		while ($feed = $birth->fetch()) {
			$newarray = array();
			$newarray['nama'] =$feed['fullname'];
			$newarray['nama_job_title'] =$feed['nama_job_title'];
			$newarray['tgl_lhr'] = $feed['tgl_lahir'];
	       	$array[] = $newarray;
	    }
	    return $array;
	}

	/**public function event() {
		$month = date('m');
		$event = $this->conn->prepare("select a.event_name, a.event_start from event a 
										where DATE_FORMAT(a.event_start,'%m') >= '$month' order by a.event_start asc limit 10");
		$event->execute();
		$array = array();
		while ($feed = $event->fetch()) {
			$newarray = array();
			$newarray['event_name'] =$feed['event_name'];
			$newarray['event_start'] =$feed['event_start'];
	       	$array[] = $newarray;
	    }
	    return $array;
	}

	public function countEvent() {
		$month = date('m');
		$event = $this->conn->prepare("select count(a.event_name) as count from event a where DATE_FORMAT(a.event_start,'%m') >= '$month'");
		$event->execute();
		while ($feed = $event->fetch()) {
			$count =$feed['count'];
	    }
	    return $count;
	}*/

}