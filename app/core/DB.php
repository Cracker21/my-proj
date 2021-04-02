<?php
	class DB {
		private $conn;
		private static $inst = null;

		private function __construct() {}
		
		static function get(){
			if(is_null(self::$inst)){
				self::$inst = new self();
				self::$inst->connect();
			}
			return self::$inst;
		}
		private function connect(){
			require ROOT.'/config.php';
			$dbh = new PDO('mysql:host=localhost;dbname=my', $DB_USER, $DB_PASS);
			return $this->conn = $dbh;
		}
		function fetchPr($query, $where){						//подготовленный селект
			$res = $this->conn->prepare($query);
			$res->execute($where);
    		$row = $res->fetch(PDO::FETCH_ASSOC);
    		return $row;
		}

		function fetch($query){									//обычный селект
			$res = $this->conn->query($query);
			$row = $res->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

	}