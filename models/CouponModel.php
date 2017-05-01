<?php
	
	/**
	** model to handle coupon related DB operations
	*/

	require_once 'Database.php';

	class CouponModel{
		
		public static function storeCoupon($couponId, $couponName, $couponProductId, $reductionValue){
			$database = new Database();
			$dbConnect = $database->openDbConnection();
			if($dbConnect){
				$couponInsertQuery = "INSERT INTO amexs_coupons (coupon_unique_id, coupon_name, coupon_product_id, coupon_reduction_value) VALUES (?,?,?,?)";
				$preparecouponQuery = $database->conn->prepare($couponInsertQuery);
				$preparecouponQuery->bind_param('sssi', $couponId, $couponName, $couponProductId, $reductionValue);
				$result = $preparecouponQuery->execute();
				if($result){
					return json_encode(array('status' => 'successful', 'status_code' => 1, 'response_text' => 'coupon added successfully'));
				}
				else{
					return json_encode(array('status' => 'unsuccessful', 'status_code' => 0, 'response_text' => 'could not add coupon ' . mysqli_error($database->conn)));
				}
			}
		}
	}
?>