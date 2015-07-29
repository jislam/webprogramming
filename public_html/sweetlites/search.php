<?php 
require_once 'library/config.php';
require_once 'include/header.php';
require_once 'library/product-functions.php';
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
					 
						
							<form name="f" method="post" action="search.php" id="search">
			<div><span style="float:left;background:#571919; height:20px; border:#733c40; width:175px; color:#FFCC00;">
			  <input name="search" type="text" style="background:#571919; border: none; width:90px; color:#FFCC00;" value="Gem info..." size="10" onclick="this.value='';" />
			</span> <input type="submit" value="" style="background: url(images/home_search.jpg); border:none; float:left; width:54px; height:20px" 	 />		
			</div>
				  </td>
				  <div class="clear"></div>

			</div>
		</div>
<?php

	$searchItem = $_POST['search'];

	$sql = "SELECT * FROM `product` WHERE prod_name = '$searchItem' ;";

	$result =  dbQuery($sql);
	
	if (dbNumRows($result)>0) {
		while ($row = $result->fetch_assoc()) {
                $pdId = $row['prod_id'];
                $catId = $row['cat_id'];
      	}
        $product = getProductDetail($pdId, $catId);
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="10">
		<tr> 
			<td align="center"><img src="<?php echo $product[0]['prod_image']; ?>" border="0" alt="<?php echo  $product[0]['prod_name']; ?>"></td>
			<td valign="middle">
				<strong><?php echo $product[0]['prod_name']; ?></strong><br>
					Price : <?php echo displayAmount($product[0]['prod_price']); ?><br>
				<?php if ($product[0]['prod_qty'] > 0) { ?>
					<input type="button" name="btnAddToCart" value="Add To Cart &gt;" onClick="window.location.href='<?php echo $product[0]['cart_url']; ?>';" class="addToCartButton">
				<?php } else { 	echo 'Out Of Stock'; } ?>
		    </td>
	 	</tr>
		 <tr align="center">
		  <td colspan="2"><?php echo $product[0]['prod_desc']; ?></td>
		 </tr>
		</table>
<?php
            
	} else{
    	//the product doesn't exist
    	echo 'the product does not exist';
    	header('Location: index.php');
	}
	

	
?>
