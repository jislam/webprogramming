<?php
require_once 'library/config.php';
require_once 'library/cart-functions.php';

require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/functions.php';


$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 0;
$usr_url= WEB_ROOT .'login.php';
if (!defined('WEB_ROOT')) {
    exit;
}

$self = WEB_ROOT . 'index.php';
if (isset($_GET['logout'])) {
    doLogout();
}


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : 'view';
switch ($action) {
	case 'add' :
		addToCart();
		break;
	case 'update' :
		updateCart();
		break;	
	case 'delete' :
		deleteFromCart();
		break;
	case 'view' :
}

$cartContent = getCartContent();
$numItem = count($cartContent);

$pageTitle = 'Shopping Cart';
require_once 'include/header.php';
?>
<div id="wrapper">
	 	<div id="header">
			<div id="topmenu">
				  <td colspan="3">
					 <p>
                      <a href="cart.php?view" target="_blank"><img src="images/button_view_cart.png" width="104" height="33" alt="#" /></a>
                      <a href="checkout.php?step=1" target="_blank"><img src="images/checkout-button-yellow.png" width="104" height="33" alt="#" /></a>

                      <a href="index.php" style="padding:0 1px 0 0;"><img src="images/home_homebutton.jpg" width="104" height="33" alt="#" /></a>
					  <a href="<?php echo $usr_url;?>"><img src="images/home_myacount.jpg" width="104" height="33" alt="#" /></a>
                      <?php  if (isset($_SESSION['plaincart_user_id'])) {
                          ?><a href="<?php echo $self; ?>?logout=true" ><img src="images/button_0.png" width="104" height="33" alt="#" /></a>

                      <?php }?>
					 </p>


                      <form id="search" method="POST" action="">
                          <input type="text" name="terms">&nbsp;<input type="submit" name="submit" class="button" value="Search Product">
                      </form>
				  </td>
				  <div class="clear"></div>

			</div>
		</div>
    <div id="midlecontent">
        <table width="896" border="0" >

            <tr valign="top" >
                <td height="400" id="leftnav">
                    <div class="top">
                        <h1>Categories</h1>
                    </div>
                    <div class="midle" style="padding:10px 0px; width:190px; font-size:11px;">
                        <?php
                        require_once 'include/leftNav.php';
                        ?>
                    </div>
                    <div class="top">
                        <h1>Payment Method</h1>
                    </div>
                    <p style="background:#241f16; width:170px; height:26px; margin:0; padding:8px;">
                        <img src="images/home_paypal.jpg" alt="paypal" title="paypal" style="margin:0; padding:0;" height="26" width="80">
                        <img src="images/home_visa.jpg" alt="visa" title="visa" style="margin:0; padding:0;" height="26" width="39">
                        <img src="images/home_mastercard.jpg" alt="mastercard" title="mastercard" style="margin:0; padding:0;" height="26" width="40">

                    </p>


                </td>
                <td>
                    <div class="right-column">

                        <div class="bottomboxtop">
                            <p>Cart</p>
                        </div>
                        <div class="whiteboxmidlepart">

<?php
// show the error message ( if we have any )
displayError();

if ($numItem > 0 ) {
?>
<form action="<?php echo $_SERVER['PHP_SELF'] . "?action=update"; ?>" method="post" name="frmCart" id="frmCart">
    <table width="100%" border="0" cellspacing="0" cellpadding="20">
 <table  width="100%" border="0" align="center" cellpadding="20" cellspacing="0" class="entryTable" >
  <tr class="entryTableHeader"> 
   <td colspan="2" align="center">Item</td>
   <td align="center">Unit Price</td>
   <td width="75" align="center">Quantity</td>
   <td align="center">Total</td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
 <?php
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$productUrl = "index.php?c=$cat_id&p=$pd_id";
	$subTotal += $pd_price * $ct_qty;
?>
 <tr class="content"> 
  <td width="80" align="center"><a href="<?php echo $productUrl; ?>"><img src="<?php echo $pd_thumbnail; ?>" border="0"></a></td>
  <td><a href="<?php echo $productUrl; ?>"><?php echo $pd_name; ?></a></td>
   <td align="right"><?php echo displayAmount($pd_price); ?></td>
  <td width="75"><input name="txtQty[]" type="text" id="txtQty[]" size="5" value="<?php echo $ct_qty; ?>" class="box" onKeyUp="checkNumber(this);">
  <input name="hidCartId[]" type="hidden" value="<?php echo $ct_id; ?>">
  <input name="hidProductId[]" type="hidden" value="<?php echo $pd_id; ?>">
  </td>
  <td align="right"><?php echo displayAmount($pd_price * $ct_qty); ?></td>
  <td width="75" align="center"> <input name="btnDelete" type="button" id="btnDelete" value="Delete" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF'] . "?action=delete&cid=$ct_id"; ?>';" class="box"> 
  </td>
 </tr>
 <?php
}
?>
 <tr class="content"> 
  <td colspan="4" align="right">Sub-total</td>
  <td align="right"><?php echo displayAmount($subTotal); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
<tr class="content"> 
   <td colspan="4" align="right">Shipping </td>
  <td align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
<tr class="content"> 
   <td colspan="4" align="right">Total </td>
  <td align="right"><?php echo displayAmount($subTotal + $shopConfig['shippingCost']); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>  
 <tr class="content"> 
  <td colspan="5" align="right">&nbsp;</td>
  <td width="75" align="center">
<input name="btnUpdate" type="submit" id="btnUpdate" value="Update Cart" class="box" style="margin: 5px 5px 5px 5px;"></td>
 </tr>
</table>
</form>
<?php
} else {
	
?>
<p>&nbsp;</p><table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr>
  <td><p align="center">You shopping cart is empty</p>
   <p>If you find you are unable to add anything to your cart, please ensure that 
    your internet browser has cookies enabled and that any other security software 
    is not blocking your shopping session.</p></td>
 </tr>
</table>
<?php
}

$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'index.php';
?>
<table width="550" border="0" align="center" cellpadding="10" cellspacing="0" style="margin-top:20px;">
 <tr align="center"> 
  <td><input name="btnContinue" type="button" id="btnContinue" value="&lt;&lt; Continue Shopping" onClick="window.location.href='<?php echo $shoppingReturnUrl; ?>';" class="box"></td>
<?php 
if ($numItem > 0) {
?>  
  <td><input name="btnCheckout" type="button" id="btnCheckout" value="Proceed To Checkout &gt;&gt;" onClick="window.location.href='checkout.php?step=1';" class="box"></td>
<?php
}
?>
                        </div>
                    </div>
                </td>
                <td width="130" align="center"> </td>
	
 </tr>
</table>
    </div>

    <div id="footer">

        <div style="padding-top:20px;font-size:10px">Copyright © 2015 Sweetlites.com, All right reserved.</div>
    </div>
</div>
    <?php
//require_once 'include/footer.php';

?>

</body>
</html>