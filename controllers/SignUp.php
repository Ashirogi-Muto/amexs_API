<?php
	/**
	** controller to handle sign up process
	*/

	header('Access-Control-Allow-Origin: *');
	require_once '../models/UserModel.php';

	class SignUp{

		private $name;
		private $mail;
		private $password;

		public function __construct(){//check of the http method is post or not
			if($_SERVER['REQUEST_METHOD'] != 'POST'){
				echo json_encode(array('responseText' => 'Method Not Allowed', 'errorCode' => '405'));
				exit();
			}
		}

		public function signUpMethod(){
			$this->name = $_POST['name'];
			$this->mail = $_POST['mail'];
			$this->password = $_POST['password'];
			$register = UserModel::registerUser($this->name, $this->password, $this->mail);
			echo $register;
		}
	}

	$sign = new SignUp();
	$sign->signUpMethod();
?>