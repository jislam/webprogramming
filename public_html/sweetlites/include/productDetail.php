<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$product = getProductDetail($pdId, $catId);

// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url

?> 
<table width="100%" border="0" cellspacing="0" cellpadding="10">
 <tr> 
  <td align="center"><img src="<?php echo $product[0]['prod_image']; ?>" border="0" alt="<?php echo  $product[0]['prod_name']; ?>"></td>
  <td valign="middle">
<strong><?php echo $product[0]['prod_name']; ?></strong><br>
Price : <?php echo displayAmount($product[0]['prod_price']); ?><br>
<?php
// if we still have this product in stock
// show the 'Add to cart' button
if ($product[0]['prod_qty'] > 0) {
?>
<input type="button" name="btnAddToCart" value="Add To Cart &gt;" onClick="window.location.href='<?php echo $product[0]['cart_url']; ?>';" class="addToCartButton">
<?php
} else {
	echo 'Out Of Stock';
}
?>
  </td>
 </tr>
 <tr align="center">
  <td colspan="2"><?php echo $product[0]['prod_desc']; ?></td>
 </tr>
</table>
