<?php
	/*
	*controller to handle the login process
	*/

	header('Access-Control-Allow-Origin: *');
	class Login{
		private $emailId;
		private $password;

		public function __construct(){//check of the http method is post or not
			if($_SERVER['REQUEST_METHOD'] != 'POST'){
				echo json_encode(array('responseText' => 'Method Not Allowed', 'errorCode' => '405'));
				exit();
			}
		}

		//login mode can be user or admin
		public function loginMethod($loginMode){

		}
	}

	$callLogin = new Login();
	$callLogin->loginMethod();
?>