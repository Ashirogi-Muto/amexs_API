<?php
	/**
	** controller to handle sign up process
	*/

	header('Access-Control-Allow-Origin: *');
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE);
	require_once '../models/CouponModel.php';

	class UploadCoupon{

		private $couponUniqueId;
		private $couponName;
		private $couponProductId;
		private $couponReductionValue;		

		public function __construct(){//check of the http method is post or not
			if($_SERVER['REQUEST_METHOD'] != 'POST'){
				echo json_encode(array('responseText' => 'Method Not Allowed', 'errorCode' => '405'));
				exit();
			}
		}

		public function couponUploadMethod(){
			$this->couponUniqueId = $_POST['unique_id'];
			$this->couponName = $_POST['coupon_name'];
			$this->couponProductId = $_POST['coupon_product_id'];
			$this->couponReductionValue = $_POST['reduction_value'];
			$storeResult = CouponModel::storeCoupon($this->couponUniqueId, $this->couponName, $this->couponProductId, $couponReductionValue);
			echo $storeResult;
		}
		
	}

	$upload = new UploadCoupon();
	$upload->couponUploadMethod();
	
?>