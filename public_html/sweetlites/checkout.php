<?php
require_once 'library/config.php';

require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';
require_once 'library/functions.php';
require_once 'library/checkout-functions.php';

$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];

$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 0;

require_once 'include/header.php';
$usr_url= WEB_ROOT .'login.php';

$cart= WEB_ROOT .'cart.php';

if (!defined('WEB_ROOT')) {
    exit;
}

$self = WEB_ROOT . 'index.php';
if (isset($_GET['logout'])) {
    doLogout();
}
?>
<div id="wrapper">
	 	<div id="header">
			<div id="topmenu">
				  <td colspan="3">
					 <p>
                      <a href="#" target="_blank"><img src="images/button_view_cart.png" width="104" height="33" alt="#" /></a>
                      <a href="#" target="_blank"><img src="images/checkout-button-yellow.png" width="104" height="33" alt="#" /></a>

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
								<p>What's New Here?</p>
				 </div>
				<div class="whiteboxmidlepart">

<?php
if (isCartEmpty()) {
	// the shopping cart is still empty
	// so checkout is not allowed
	header('Location: cart.php');
} else if (isset($_GET['step']) && (int)$_GET['step'] > 0 && (int)$_GET['step'] <= 3) {
	$step = (int)$_GET['step'];

	$includeFile = '';
	if ($step == 1) {
		$includeFile = 'shippingAndPaymentInfo.php';
		$pageTitle   = 'Checkout - Step 1 of 2';
	} else if ($step == 2) {
		$includeFile = 'checkoutConfirmation.php';
		$pageTitle   = 'Checkout - Step 2 of 2';
	} else if ($step == 3) {
		$orderId     = saveOrder();
		$orderAmount = getOrderAmount($orderId);
		
		$_SESSION['orderId'] = $orderId;
		
		// our next action depends on the payment method
		// if the payment method is COD then show the 
		// success page but when paypal is selected
		// send the order details to paypal
		if ($_POST['hidPaymentMethod'] == 'cod') {

            session_unset();
            header('Location: success.php');

			exit;
		} 
		else if($_POST['hidPaymentMethod'] == 'card') {

            session_unset();
            header('Location: success.php');

			exit;
		}
		
		else {

            session_unset();
			$includeFile = 'paypal/payment.php';

		}
	}
} else {
	// missing or invalid step number, just redirect
	header('Location: index.php');
}

require_once 'include/header.php';
?>
<script language="JavaScript" type="text/javascript" src="library/checkout.js"></script>
<?php
require_once "include/$includeFile";
//require_once 'include/footer.php';
?>

    <div id="footer">

        <div style="padding-top:20px;font-size:10px">Copyright � 2015 Sweetlites.com, All right reserved.</div>
    </div>
</div>
</body>
</html>