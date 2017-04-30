<?php

	/*
	*	Class to make connection to the database
	*/
	require_once '../includes/db_config.php';

	global $database;
	class Database{
		
		public $conn;
		public function openDbConnection(){ //open the database connection
			$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($this->conn->connect_errorno){
				echo "Not Connected " . mysql_error($this->conn);
				return false;
			}
			else{
				return true;
			}
		}
	}	
?>