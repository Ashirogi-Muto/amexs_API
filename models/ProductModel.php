<?php
	
	/**
	** model to handle product related DB operations
	*/

	require_once 'Database.php';

	class ProductModel{
		
		public static function storeProduct($uniqueId, $productName, $productDescription, $productText, $productPrice, $productImage){

			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				$productInsertQuery = "INSERT INTO amexs_products (amexs_unique_product_id, product_name, product_descrip, product_text, product_price, product_image) VALUES (?,?,?,?,?,?)";
				$prepareProductQuery = $database->conn->prepare($productInsertQuery);
				$prepareProductQuery->bind_param('isssis', $uniqueId, $productName, $productDescription, $productText, $productPrice, $productImage);
				$result = $prepareProductQuery->execute();
				if($result){
					return json_encode(array('status' => 'successful', 'status_code' => 1, 'response_text' => 'product added successfully'));
				}
				else{
					return json_encode(array('status' => 'unsuccessful', 'status_code' => 0, 'response_text' => 'could not add product ' . mysqli_error($database->conn)));
				}
			}
		}

		public static function productFetch(){
			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				$fetchProductQuery = "SELECT * from amexs_products";

				$result = $database->conn->query($fetchProductQuery);

				if($result->num_rows > 0){
					$products = [];
					while ($row = $result->fetch_assoc()) {
    					$products[] = $row;
					}
					return json_encode(array('status' => 'successful', 'response_text' => 'products found', 'status_code' => 1, 'data' => $products));
				}
				else{
					return json_encode(array('status' => 'successful', 'response_text' => 'no products found', 'status_code' => 0));
				}
			}
		}

		public static function singleProductFetch($id){
			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				$fetchSingleQuery = "SELECT p.amexs_unique_product_id. p.product_name, p.product_descrip, p.product_price, p.product_image, c.coupon_unique_id, c.coupon_name, c.coupon_product_id, c.coupon_reduction_value
				FROM amexs_products AS p
				INNER JOIN amexs_coupons AS c
				ON p.amexs_unique_product_id = c.coupon_product_id
				WHERE p.product_id = '$id'";

				$result = $database->conn->query($fetchSingleQuery);
				if($result->num_rows > 0){
					$product = [];
					while ($row = $result->fetch_assoc()) {
    					$product[] = $row;
					}

					return json_encode(array('status' => 'successful', 'response_text' => 'product found', 'status_code' => 1, 'data' => $product));
				}
				else{
					return json_encode(array('status' => 'successful', 'response_text' => 'no products found', 'status_code' => 0));	
				}
			}
		}
	}
?>