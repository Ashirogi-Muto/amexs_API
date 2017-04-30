<?php

	/**
	**model to handle user related DB operations
	*/

	require_once 'Database.php';
	class UserModel{

		public static function registerUser($name, $password, $mail){
			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				//escaping the input characters
				$name = $database->conn->real_escape_string($name);
				$password = $database->conn->real_escape_string($password);
				$mail = $database->conn->real_escape_string($mail);

				//generating md5 string of password
				$passwordMd5 = md5($password);

				// //preparered statements for inserting query
				$insertQuery = "INSERT INTO amexs_users (user_name, user_password, user_mail) VALUES (?,?,?)";

				$prepareInsertQuery = $database->conn->prepare($insertQuery);
				$bindInsertQuery = $prepareInsertQuery->bind_param('sss', $name, $passwordMd5, $mail);

				$executeInsertQuery = $prepareInsertQuery->execute();
				if($executeInsertQuery){
					return json_encode(array('satatus' => 'successful', 'response_text' => 'user registered', 'status_code' => 1));
				}
				else{
					return json_encode(array('satatus' => 'unsuccessful', 'response_text' => 'user not registered ' . mysqli_error($database->conn), 'status_code' => 0));
				}
			}

		}
	}
?>