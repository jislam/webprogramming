<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

// get product info
$sql = "SELECT pd.cat_id, prod_name, prod_desc,prod_price_id, prod_price,prod_publish,prod_discount_id,
prod_coupon, prod_qty, prod_image, prod_thumbnail
        FROM product pd, tbl_category cat
		WHERE pd.prod_id = $productId AND pd.cat_id = cat.cat_id";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        extract($row);
        // get category list
        $sqlQuery = "SELECT cat_id, parent_id, cat_name
                     FROM tbl_category where cat_publish='Y'
		              ORDER BY cat_id";
        $resultC = dbQuery($sqlQuery);
        $categories = array();
        if ($resultC->num_rows > 0) {
            $data = array();
            while ($rowC = $resultC->fetch_assoc()) {
                $id = $rowC['cat_id'];
                $parentId = $rowC['parent_id'];
                $name = $rowC['cat_name'];

                if ($parentId == 0) {
                    $categories[$id] = array('name' => $name, 'children' => array());
                } else {
                    $categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);
                }
            }
        }

    }
}

//echo '<pre>'; print_r($categories); echo '</pre>'; exit;

// build combo box options
$list = '';
foreach ($categories as $key => $value) {
	$name     = $value['name'];
	$children = $value['children'];
	
	$list .= "<optgroup label=\"$name\">"; 
	
	foreach ($children as $child) {
		$list .= "<option value=\"{$child['id']}\"";
		
		if ($child['id'] == $cat_id) {
			$list .= " selected";
		}
		$list .= ">{$child['name']}</option>";
	}
	
	$list .= "</optgroup>";
}
?> 
<form action="processProduct.php?action=modifyProduct&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <p align="center" class="formTitle">Modify Product</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- Choose Category --</option>
<?php
	echo $list;
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">Product Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" value="<?php echo $prod_name; ?>" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"> <textarea name="mtxDescription" cols="70" rows="10" class="box" id="mtxDescription"><?php echo $prod_desc; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Price ID</td>
   <td class="content"><input name="txtPriceID" type="text" class="box" id="txtPriceID" value="<?php echo $prod_price_id; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr> 
  <tr> 
   <td width="150" class="label">Price</td>
   <td class="content"><input name="txtPrice" type="text" class="box" id="txtPrice" value="<?php echo $prod_price; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Qty In Stock</td>
   <td class="content"><input name="txtQty" type="text" class="box" id="txtQty" value="<?php echo $prod_qty;  ?>" size="10" maxlength="10"> </td>
  </tr>
   <tr> 
   <td width="150" class="label">Discount ID </td>
   <td class="content"><input name="txtDiscount" type="text" class="box" id="txtDiscount" value="<?php echo $prod_discount_id;  ?>" size="10" maxlength="10"> </td>
  </tr>
   <tr> 
   <td width="150" class="label">Coupon ID </td>
   <td class="content"><input name="txtCoupon" type="text" class="box" id="txtCoupon" value="<?php echo $prod_coupon;  ?>" size="10" maxlength="10"> </td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box">
<?php
	if ($prod_thumbnail != '') {
?>
    <br>
    <img src="<?php echo WEB_ROOT . PRODUCT_IMAGE_DIR . $prod_thumbnail; ?>"> &nbsp;&nbsp;<a href="javascript:deleteImage(<?php echo $productId; ?>);">Delete 
    Image</a> 
    <?php
	}
?>    
    </td>
  </tr>
  <tr> 
   <td width="150" class="label">Publish</td>
    <td class="content">
      <select name="checkPublish" id="checkPublish">
        <option selected>YES</option>
        <option>NO</option>
      </select></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Modify Product" onClick="checkAddProductForm();" class="bluebox">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="bluebox">  
 </p>
</form>