<?php
if (!defined('WEB_ROOT')) {
	exit;
}
$searchterm = $_POST['userName'];
  
$productsPerRow = 2;
$productsPerPage = 4;

//$productList    = getProductList($catId);
$children = array_merge(array($catId), getChildCategories(NULL, $catId));
$children = ' (' . implode(', ', $children) . ')';

$sql = " SELECT prod_id, prod_name, prod_price, prod_thumbnail, prod_qty, c.cat_id
		FROM product pd, tbl_category c
		WHERE pd.cat_id = c.cat_id AND pd.cat_id IN $children AND prod_name LIKE '%{$searchterm}%'
		ORDER BY prod_name";
$result     = dbQuery(getPagingQuery($sql, $productsPerPage));
$pagingLink = getPagingLink($sql, $productsPerPage, "c=$catId");
$numProduct = dbNumRows($result);

// the product images are arranged in a table. to make sure
// each image gets equal space set the cell width here
$columnWidth = (int)(100 / $productsPerRow);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="20">
<?php 
if ($numProduct > 0 ) {

	$i = 0;
    while($row = $result->fetch_assoc()){

		extract($row);
		if ($prod_thumbnail) {
            $prod_thumbnail = WEB_ROOT . 'images/product/' . $prod_thumbnail;
		} else {
			$$pd_thumbnail = WEB_ROOT . 'images/no-image-small.png';
		}
	
		if ($i % $productsPerRow == 0) {
			echo '<tr>';
		}

		// format how we display the price
		$pd_price = displayAmount($prod_price);
		
		echo "<td width=\"$columnWidth%\" align=\"center\"><a href=\"" . $_SERVER['PHP_SELF'] . "?c=$catId&p=$prod_id" . "\"><img src=\"$prod_thumbnail\" border=\"0\"><br>$prod_name</a><br>Price : $prod_price";

		// if the product is no longer in stock, tell the customer
		if ($prod_qty <= 0) {
			echo "<br>Out Of Stock";
		}
		
		echo "</td>\r\n";
	
		if ($i % $productsPerRow == $productsPerRow - 1) {
			echo '</tr>';
		}
		
		$i += 1;
	}
	
	if ($i % $productsPerRow > 0) {
		echo '<td colspan="' . ($productsPerRow - ($i % $productsPerRow)) . '">&nbsp;</td>';
	}
	
} else {
?>
	<tr><td width="100%" align="center" valign="center">No products in this category</td></tr>
<?php	
}	
?>
</table>
<p align="center"><?php echo $pagingLink; ?></p>