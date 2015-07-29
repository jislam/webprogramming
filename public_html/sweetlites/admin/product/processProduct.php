<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addProduct' :
		addProduct();
		break;
		
	case 'modifyProduct' :
		modifyProduct();
		break;
		
	case 'deleteProduct' :
		deleteProduct();
		break;
	
	case 'deleteImage' :
		deleteImage();
		break;
    

	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}


function addProduct()
{
	 $catId       = $_POST['cboCategory'];
 	 $name        = $_POST['txtName'];   
	 $description = $_POST['mtxDescription'];   
	 $price       = str_replace(',', '', (double)$_POST['txtPrice']);  
	 $qty         = (int)$_POST['txtQty'];   
	 $priceid  = $_POST['txtPriceID'];  
	 $publish = $_POST['checkPublish'];   
   	 $discount = $_POST['txtDiscount'];   
	 $coupon = $_POST['txtCoupon'];   
	 $images = uploadProductImage('fleImage', SRV_ROOT . 'images/product/'); 

/*echo "down";
echo $publish;
echo "up:";
die();*/
	 $mainImage = $images['image'];  
	 $thumbnail = $images['thumbnail'];   
	 if($publish=="YES")
	 	{
		$publish="Y";
		}
	else
		{
		$publish="N";
		}
		
	
	
	$sql   = "INSERT INTO product (cat_id, prod_name, prod_desc,prod_price_id, prod_price,prod_publish, prod_qty,
				prod_discount_id,prod_coupon, prod_image, prod_thumbnail, prod_cdate,prod_mdate)
	          VALUES ('$catId', '$name', '$description', '$priceid', '$price', '$publish','$qty','$discount','$coupon',
			   '$mainImage', '$thumbnail', NOW(),NOW())";
	/*$sql   = "INSERT INTO product (cat_id, prod_name,prod_desc,prod_price_id,prod_price,prod_publish )
				 VALUES ('$catId', '$name','$description', '$priceid' ,'$price', '$publish')";*/
	
	$result = dbQuery($sql);
	
	header("Location: index.php?catId=$catId");	
}

/*
	Upload an image and return the uploaded image name 
*/
function uploadProductImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		if ($result) 
		{
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);
			
			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}	
		} else {
			// the product cannot be upload / resized
			echo "the product cannot be upload / resized";
			$imagePath = $thumbnailPath = '';
		}
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

/*
	Modify a product
*/
function modifyProduct()
{ 
	 $priceid  = $_POST['txtPriceID'];  
	 $publish = $_POST['checkPublish'];   
   	 $discount = $_POST['txtDiscount'];   
	 $coupon = $_POST['txtCoupon'];   
	 if($publish=="YES")
	 	{
		$publish="Y";
		}
	else
		{
		$publish="N";
		}
//---------------
	$productId   = (int)$_GET['productId'];	
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
	$description = $_POST['mtxDescription'];
	$price       = str_replace(',', '', $_POST['txtPrice']);
	$qty         = $_POST['txtQty'];
	
	$images = uploadProductImage('fleImage', SRV_ROOT . 'images/product/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];

	// if uploading a new image
	// remove old image
	if ($mainImage != '') {
		_deleteImage($productId);
		
		$mainImage = "'$mainImage'";
		$thumbnail = "'$thumbnail'";
	} else {
		// if we're not updating the image
		// make sure the old path remain the same
		// in the database
		$mainImage = 'prod_image';
		$thumbnail = 'prod_thumbnail';
	}
			
	$sql   = "UPDATE product 
	          SET cat_id = $catId, prod_name = '$name', prod_desc = '$description', prod_price = $price, 
			  prod_price_id = $priceid, prod_discount_id=$discount,prod_coupon=$coupon,prod_publish='$publish',
			      prod_qty = $qty, prod_image = $mainImage, prod_thumbnail = $thumbnail,prod_cdate=NOW(),prod_mdate=NOW()
			  WHERE prod_id = $productId";  

	$result = dbQuery($sql);
	
	header('Location: index.php');			  
}

/*
	Remove a product
*/
function deleteProduct()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
	// remove any references to this product from
	// tbl_order_item and tbl_cart
	/*$sql = "DELETE FROM order_item
	        WHERE prod_id = $productId";
	dbQuery($sql);*/
			
	/*$sql = "DELETE FROM tbl_cart
	        WHERE pd_id = $productId";	
	dbQuery($sql);*/
			
	// get the image name and thumbnail
	$sql = "SELECT prod_image, prod_thumbnail
	        FROM product
			WHERE prod_id = $productId";
			
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);
	
	// remove the product image and thumbnail
	if ($row['prod_image']) {
		unlink(SRV_ROOT . 'images/product/' . $row['prod_image']);
		unlink(SRV_ROOT . 'images/product/' . $row['prod_thumbnail']);
	}
	
	// remove the product from database;
	$sql = "DELETE FROM product 
	        WHERE prod_id = $productId";
	dbQuery($sql);
	
	header('Location: index.php?catId=' . $_GET['catId']);
}


/*
	Remove a product image
*/
function deleteImage()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
	$deleted = _deleteImage($productId);

	// update the image and thumbnail name in the database
	$sql = "UPDATE product
			SET prod_image = '', prod_thumbnail = ''
			WHERE prod_id = $productId";
	dbQuery($sql);		

	header("Location: index.php?view=modify&productId=$productId");
}

function _deleteImage($productId)
{
	// we will return the status
	// whether the image deleted successfully
	$deleted = false;
	
	$sql = "SELECT prod_image, prod_thumbnail 
	        FROM product
			WHERE prod_id = $productId";
	$result = dbQuery($sql) or die('Cannot delete product image. ' . mysql_error());
	
	if (dbNumRows($result)) {
		$row = dbFetchAssoc($result);
		extract($row);
		
		if ($pd_image && $pd_thumbnail) {
			// remove the image file
			$deleted = @unlink(SRV_ROOT . "images/product/$prod_image");
			$deleted = @unlink(SRV_ROOT . "images/product/$prod_thumbnail");
		}
	}
	
	return $deleted;
}




?>