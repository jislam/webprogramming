<?php
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';
require_once 'library/functions.php';

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
								<p>What’s New Here?</p>
				 </div>
				<div class="whiteboxmidlepart">
				<?php
                if (isset($_POST['submit'])) {
                    require_once 'include/result.php';
                }else{
                    if ($pdId) {
                        require_once 'include/productDetail.php';
                    } else if ($catId) {
                        require_once 'include/productList.php';
                    } else {
                        require_once 'include/categoryList.php';
                    }
                }

				?>  
				</div>
			</div>
	  </td>
	  <td width="130" align="center"><?php require_once 'include/miniCart.php'; ?></td>
	 </tr>
	</table>
	</div>
<?php
  include 'include/footer.php'; ?>
 </div>
</body>
</html>
