<?php

	/**
	**model to handle user related DB operations
	*/

	require_once 'Database.php';

	class UserModel{

		public static function adminLogin($id, $password){
			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				$id = $database->conn->real_escape_string($id);
				$password = $database->conn->real_escape_string($password);
				$passwordMd5 = md5($password);
				$fetchAdminQuery = "SELECT admin_id, admin_name from amexs_admin WHERE admin_id = ? AND admin_password = ?";
				$prepareFetchAdminQuery = $database->conn->prepare($fetchAdminQuery);

				$bindFetchAdminQuery = $prepareFetchAdminQuery->bind_param('is', $id, $passwordMd5);
				if($prepareFetchAdminQuery->execute()){
					$prepareFetchAdminQuery->bind_result($adminId, $adminName);
					$prepareFetchAdminQuery->fetch();
					if($adminId != null || $adminName != null){
						$adminArray = [
						'admin_name' => $adminName,
						'admin_id' => $adminId
						];
						return json_encode(array('status' => 'successful', 'response_text' => 'user found', 'data' => $adminArray, 'status_code' => 1));
					}
					else{
						return json_encode(array('status' => 'successful', 'response_text' => 'no user found', 'status_code' => 0));
					}
					// if($result->num_rows > 0){
					// 	var_dump($id);
					// 	var_dump($name);
					// 	// $adminArray = $result->fetch_object();						
					// 	// return json_encode(array('status' => 'successful', 'response_text' => 'user found', 'data' => $adminArray, 'status_code' => 1));
					// }
					// if($result->num_rows == 0){
					// 	
					// 	// return json_encode(array('status' => 'successful', 'response_text' => 'no user found', 'status_code' => 0));
					// }
				}

			}
		}


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



		public static function userLogin($mail, $password){
			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				$mail = $database->conn->real_escape_string($mail);
				$password = $database->conn->real_escape_string($password);
				$passwordMd5 = md5($password);

				$fetchUserQuery = "SELECT user_id, user_name from amexs_users WHERE user_mail = ? AND user_password = ?";

				$prepareFetchUserQuery = $database->conn->prepare($fetchUserQuery);

				$bindFetchUserQuery = $prepareFetchUserQuery->bind_param('ss', $mail, $passwordMd5);

				if($prepareFetchUserQuery->execute()){
					$result = $prepareFetchUserQuery->bind_result($id, $name);
					$prepareFetchUserQuery->fetch();
					if($id != null && $name != null){
						$userArray = [
							'user_name' => $name,
							'user_id' => $id
						];
						return json_encode(array('status' => 'successful', 'response_text' => 'user found', 'data' => $userArray, 'status_code' => 1));
					}
					else{
						return json_encode(array('status' => 'successful', 'response_text' => 'no user found', 'status_code' => 0));
					}
				}
				
			}
		}
	}
?>