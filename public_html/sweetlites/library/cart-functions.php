<?php
require_once 'config.php';

/*********************************************************
*                 SHOPPING CART FUNCTIONS 
*********************************************************/
 
function addToCart()
{

	// make sure the product id exist
	if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
		$productId = (int)$_GET['p'];
	} else {
		header('Location: index.php');
	}

	// does the product exist ?
    $sql = "SELECT prod_id, prod_qty FROM product WHERE prod_id = $productId; ";

    $result = dbQuery($sql);

	if (dbNumRows($result)>0) {
		// how many of this product we
		// have in stock
            while ($row = $result->fetch_assoc()) {
                $currentStock = $row['prod_qty'];
                	
                if ($currentStock == 0) {
                    // we no longer have this product in stock
                    // show the error message
                    setError('The product you requested is no longer in stock');
                    header('Location: cart.php');
                    exit;
                }
            }
	}else{
    // the product doesn't exist
    	header('Location: cart.php');
	}
	
	// current session id
	$sid = session_id();
	
	// check if the product is already
	// in cart table for this session
	$sql = "SELECT prod_id
	        FROM cart
			WHERE prod_id = $productId AND cart_session_id = '$sid'";
	$result = dbQuery($sql);

	if (dbNumRows($result) == 0) {
		// put the product in cart table
		$sql = "INSERT INTO cart (prod_id, prod_qty, cart_session_id, cart_date)
				VALUES ($productId, 1, '$sid', NOW())";
		$result = dbQuery($sql);
	} else {
		// update product quantity in cart table
		$sql = "UPDATE cart 
		        SET prod_qty = prod_qty + 1
				WHERE cart_session_id = '$sid' AND prod_id = $productId";		
				
		$result = dbQuery($sql);		
	}	
	
	// an extra job for us here is to remove abandoned carts.
	// right now the best option is to call this function here
	deleteAbandonedCart();
	
	header('Location: ' . $_SESSION['shop_return_url']);
}

/*
	Get all item in current session
	from shopping cart table
*/
function getCartContent()
{
    global $conn;

    $sid = session_id();

    $sql = "SELECT ct.cart_id, ct.prod_id, ct.prod_qty, pd.prod_name, pd.prod_price, pd.prod_thumbnail, pd.cat_id
            FROM cart ct, product pd, tbl_category cat WHERE ct.cart_session_id = '$sid'
            AND ct.prod_id = pd.prod_id AND cat.cat_id = pd.cat_id; ";

    $cartContent = array();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($ct_id, $pd_id, $ct_qty, $pd_name, $pd_price, $pd_thumbnail, $cat_id );

    

    while ($stmt->fetch()) {
        // output data of each row


        if ($pd_thumbnail != "") {
            $pd_thumbnail = WEB_ROOT . 'images/product/' . $pd_thumbnail;
        } else {
            $pd_thumbnail = WEB_ROOT . 'images/no-image-small.png';
        }

        $cartContent[] = array(
            'ct_id' => $ct_id,
            'pd_id' => $pd_id,
            'ct_qty' => $ct_qty,
            'pd_name' => $pd_name,
            'pd_price' => $pd_price,
            'pd_thumbnail' => $pd_thumbnail,
            'cat_id' => $cat_id,

        );


    }
	
	return $cartContent;
}

/*
	Remove an item from the cart
*/
function deleteFromCart($cartId = 0)
{
	if (!$cartId && isset($_GET['cid']) && (int)$_GET['cid'] > 0) {
		$cartId = (int)$_GET['cid'];
	}

	if ($cartId) {	
		$sql  = "DELETE FROM cart
				 WHERE cart_id = $cartId";

		$result = dbQuery($sql);
	}
	
	header('Location: cart.php');	
}

/*
	Update item quantity in shopping cart
*/
function updateCart()
{
	$cartId     = $_POST['hidCartId'];
	$productId  = $_POST['hidProductId'];
	$itemQty    = $_POST['txtQty'];
	$numItem    = count($itemQty);
	$numDeleted = 0;
	$notice     = '';
	
	for ($i = 0; $i < $numItem; $i++) {
		$newQty = (int)$itemQty[$i];
		if ($newQty < 1) {
			// remove this item from shopping cart
			deleteFromCart($cartId[$i]);	
			$numDeleted += 1;
		} else {
			// check current stock
			$sql = "SELECT prod_name, prod_qty
			        FROM product 
					WHERE prod_id = {$productId[$i]}";
			$result = dbQuery($sql);
			$row    = dbFetchAssoc($result);
			
			if ($newQty > $row['prod_qty']) {
				// we only have this much in stock
				$newQty = $row['prod_qty'];

				// if the customer put more than
				// we have in stock, give a notice
				if ($row['prod_qty'] > 0) {
					setError('The quantity you have requested is more than we currently have in stock. The number available is indicated in the &quot;Quantity&quot; box. ');
				} else {
					// the product is no longer in stock
					setError('Sorry, but the product you want (' . $row['prod_name'] . ') is no longer in stock');

					// remove this item from shopping cart
					deleteFromCart($cartId[$i]);	
					$numDeleted += 1;					
				}
			} 
							
			// update product quantity
			$sql = "UPDATE cart
					SET prod_qty = $newQty
					WHERE cart_id = {$cartId[$i]}";
				
			dbQuery($sql);
		}
	}
	
	if ($numDeleted == $numItem) {
		// if all item deleted return to the last page that
		// the customer visited before going to shopping cart
		header("Location: $returnUrl" . $_SESSION['shop_return_url']);
	} else {
		header('Location: cart.php');	
	}
	
	exit;
}

function isCartEmpty()
{
	$isEmpty = false;
	
	$sid = session_id();
	$sql = "SELECT cart_id
			FROM cart ct
			WHERE cart_session_id = '$sid'";
	
	$result = dbQuery($sql);
	
	if (dbNumRows($result) == 0) {
		$isEmpty = true;
	}	
	
	return $isEmpty;
}

/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart()
{
	$yesterday = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	$sql = "DELETE FROM cart
	        WHERE cart_date < '$yesterday'";
	dbQuery($sql);		
}

?>