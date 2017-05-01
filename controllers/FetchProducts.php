<?php
	/**
	** controller to fetch products
	*/
	header('Access-Control-Allow-Origin: *');
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE);

	require_once '../models/ProductModel.php';

	class FetchProducts{

		public function __construct(){//check of the http method is GET or not
			if($_SERVER['REQUEST_METHOD'] != 'GET'){
				echo json_encode(array('responseText' => 'Method Not Allowed', 'errorCode' => '405'));
				exit();
			}
		}

		public function fetchAllProducts(){
			$products = ProductModel::productFetch();
			echo $products;
		}
	}

	$fetch = new FetchProducts();
	$fetch->fetchAllProducts();
?>