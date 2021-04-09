<?php
	class DB {
		public $pdo;
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
			$this->pdo = $dbh;
		}
		function fetchPr($query, $data){						//подготовленный селект
			$res = $this->pdo->prepare($query);
			$res->execute($data);
    		$row = $res->fetch(PDO::FETCH_ASSOC);
    		return $row;
		}

		function fetch($query){									//обычный селект
			$res = $this->pdo->query($query);
			$row = $res->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

		function insPr($query, $data){
			$res = $this->pdo->prepare($query);
			$res->execute($data);
		}

	}