<?php
	class DB{
		private $conn;
		private $dbname;
		private $user;
		private $pass;

		function __construct($dbname,$user,$pass){
			$this->dbname = $dbname;
			$this->user = $user;
			$this->pass = $pass;
			$this->connect();
		}
		function connect(){
			$dbh = new PDO('mysql:host=localhost;dbname='.$this->dbname, $this->user, $this->pass);
			return $this->conn = $dbh;
		}
		function fetch($query, $where){
			$res = $this->conn->prepare($query);
			$res->execute($where);
    		$row = $res->fetch(PDO::FETCH_ASSOC);
    		return $row;
		}

	}