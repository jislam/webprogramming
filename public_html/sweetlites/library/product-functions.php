<?php
require_once 'config.php';

/*********************************************************
*                 PRODUCT FUNCTIONS 
**********************************************************/


/*
	Get detail information of a product
*/
function getProductDetail($pdId, $catId)
{
	global $conn;
	$_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];

	// get the product information from database
	$sql = "SELECT prod_name, prod_desc , prod_price, prod_image, prod_qty
			FROM product
			WHERE prod_id = $pdId";

    $product = array();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($prod_name, $prod_desc, $prod_price, $prod_image, $prod_qty );

    while ($stmt->fetch()) {
        // output data of each row

        if ($prod_image != "") {
            $prod_image = WEB_ROOT . 'images/product/' . $prod_image;
        } else {
            $prod_image = WEB_ROOT . 'images/no-image-small.png';
        }
        $prod_desc = nl2br($prod_desc);
        $cart_url = "cart.php?action=add&p=$pdId";
        $product[] = array(
            'prod_name' => $prod_name,
            'prod_desc' => $prod_desc,
            'prod_price' => $prod_price,
            'prod_image' => $prod_image,
            'prod_qty' => $prod_qty,
            '$prod_image' => $prod_image,
            'cart_url' => $cart_url

        );
    }
	return $product;
}
?>