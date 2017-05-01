<?php
	/**
	** controller to handle sign up process
	*/

	header('Access-Control-Allow-Origin: *');
	require_once '../models/ProductModel.php';

	class UploadProduct{

		private $productUniqueId;
		private $productName;
		private $productDescription;
		private $productText;
		private $productPrice;
		private $productImageString;

		public function __construct(){//check of the http method is post or not
			if($_SERVER['REQUEST_METHOD'] != 'POST'){
				echo json_encode(array('responseText' => 'Method Not Allowed', 'errorCode' => '405'));
				exit();
			}
		}

		public function productUploadMethod(){
			$this->productUniqueId = $_POST['product_unique_id'];
			$this->productName = $_POST['product_name'];
			$this->productDescription = $_POST['product_description'];
			$this->productText = $_POST['product_text'];
			$this->productPrice = $_POST['product_price'];
			$this->productImageString = $_POST['product_image'];
			$storeResult = ProductModel::storeProduct($this->productUniqueId, $this->productName, $this->productDescription, $this->productText, $this->productPrice, $this->productImageString);
			echo $storeResult;
		}
	}

	$upload = new UploadProduct();
	$upload->productUploadMethod();
	
?>