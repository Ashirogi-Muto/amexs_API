<?php
	/**
	**
	controller to fetch a single product
	*/
	header('Access-Control-Allow-Origin: *');	

	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE);

	require_once '../models/ProductModel.php';

	class FetchSingleProduct
	{
		private $productId;
		public function __construct(){//check of the http method is GET or not
			if($_SERVER['REQUEST_METHOD'] != 'GET'){
				echo json_encode(array('responseText' => 'Method Not Allowed', 'errorCode' => '405'));
				exit();
			}
		}

		public function fetchSingle(){
			$this->productId = $_POST['id'];
			$product = ProductModel::singleProductFetch($this->productId);
			echo $product;
		}

	}

	$single = new FetchSingleProduct();
	$single->fetchSingle();
?>