<?php
// this starts the session
session_start();

// echo variable from the session, we set this on our other page
//echo $_SESSION['name'];

 include 'conn.php' ; 
 
 
	
	$min = $_REQUEST['min'];

	$max = $_REQUEST['max'];

	$start = $_REQUEST['start'];
	if($start==NULL){
		$start = 0;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sweetlites.com</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
a:hover {
	color: #000000;
}
a:active {
	color: #000000;
}
.style1 {color: #000000}
.style3 {
	color: #000000;
	font-size: 16px;
	font-weight: bold;
}
.style4 {font-size: 12px}
-->
</style></head>

<body>
 <div id="wrapper">
 		<div id="header">
					<div id="topmenu">

		   		    <?php include('mod_topmenu.php');?>

			<div class="clear"></div>
			</div>
			<form name="f" method="post" action="search.php">
			<div id="search"><span style="float:left;background:#571919; height:20px; border:#733c40; width:175px">Gem Info..
			
			    <input name="search" type="text" style="background:#571919; border: none; width:90px"/></span> <input type="submit" value="" style="background: url(images/home_search.jpg); border:none; float:left; width:54px; height:20px"	 />		
			
				<div class="clear"></div>
			  </div>
		  </form>
		</div>
		<div id="midlecontent">
        		<div id="left-column">
				 		<div class="top">
							<h1>Category</h1>
						</div>
						
						<div class="midle">
								<? include 'cat_menu.php' ; ?>
						</div>
						
						<div class="top">
							<h1>Price Range</h1>
						</div>
				  <div class="midle" style="padding:10px 2px; width:190px; font-size:11px;">
				  <form name="form" method="post" action="search_prod.php">
				  <div>
				  
						  <label style="margin-left:5px;">Category
						  <select name="s_cat_id" class="input">
						  <option selected disabled>Select One</option>
						  <? $t = "select * from category"; 
				  			$q = mysql_query($t);
							if(mysql_num_rows($q)>0){
								while($r=mysql_fetch_array($q)){
									$op_cat_name = $r['cat_name'];
									$op_id_cat = $r['cat_id'];
				  		?>
						    <option value="<? echo $op_id_cat ?>"><? echo $op_cat_name ?></option>
							<? }
								} ?>
					      </select>
						  </label></div>
						  <br/>
						  <div align="center" style="margin-top:10px;">
						  <input name="min" type="text" style="width:60px" class="input"/>
					  <label style="color:#FFFFFF">-To-
						  <input type="text" name="max"style="width:60px" class="input" />
				    </label></div>
					<input type="submit" value="" style="background:url(images/home_btnclickhere.jpg) no-repeat left top; width:106px; height:23px; margin:15px 0 0 33px; border:none;" />
					
				</form>	
				  </div>
				  <div style="background:url(images/home_bottomnew.jpg) no-repeat left top; width:191px; height:8px;
				  margin:0; padding:0;">
				  </div>
				  <div style="width:191px; height:auto; width:191px; margin:15px 0 0 0; padding:0;">
				  	
					<div><img src="images/home_payment-top.jpg" /></div>
					<div style="background:#262118; width:190px; height:auto; text-align:center; margin:0; padding:0">
					
				          <p style="background:#241f16; width:170px; height:26px; margin:0; padding:8px;">
						  <a href="#"><img src="images/home_paypal.jpg" height="26" width="80" alt="#" style="margin:0; padding:0; border:none" /></a>
						  <a href="#"><img src="images/home_visa.jpg" height="26" width="39" alt="#" style="margin:0; padding:0; border:none"/></a>
						  <a href="#"><img src="images/home_mastercard.jpg" height="26" width="40" alt="#" style="margin:0; padding:0; border:none"/></a>
						  
						  </p>
					
					</div>
					<div style="background:url(images/home_paymentbottom.jpg) no-repeat left top; height:11px; width:190px; margin:0; padding:0;">
					</div>
				  </div>
<!--						<div class="midlepricerange">
							<form method="post" action="">
							 <span style="float:left; font-size:12px; margin:0; padding:2px 0 0 0;">Category</span><span style="float:right; width:115px; margin:0;padding:0;">
							    <select name="toppings" style="width:105px; border:1px solid #423a2b; background-color:#262118" >
                                  <option value="mushrooms">mushrooms </option>
                                  <option value="greenpeppers">green peppers </option>
                                  <option value="onions">onions </option>
                                  <option value="tomatoes">tomatoes </option>
                                  <option value="olives">olives </option>
                                </select></span>
								<fieldset>
								<input type="text" />
								
								</fieldset>-->
<!--								<div class="clear"></div>
							 
						</form>-->
						<!--</div>-->
				</div>
				<div id="right-column">

					<div class="bottombox">
						<div class="bottomboxtop">
							<p>Search Result</p>
						</div>
						<div id="whiteboxmidlepart">
						<? 
						$s_cat_id = $_REQUEST['s_cat_id'];
						$t = "select * from category where cat_id = '$s_cat_id' " ;
						$q = mysql_query($t);
						$r = mysql_fetch_array($q);
						$s_cat_name = $r['cat_name'];
						
						$t="select * from product where cat_id='$s_cat_id' ";
						if(strlen($min)>0){
							$s1 = "and retail_price>='$min' ";
							$t = $t.$s1;
						}
						if(strlen($max)>0){
							$s2 = "and retail_price<='$max' ";
							$t = $t.$s2;
						}
							$s3 = "and published='true' order by prod_id";
							$t = $t.$s3;
							$q=mysql_query($t);
							$k=0;
							$total = mysql_num_rows($q);
							$st = $start+1;
							if($start+9<$total){
								$end = $start+9;
							}
							else {
								$end = $total;
							}
							if($total==0){ ?>
								<div align="center"><span class="style3"><? echo "Sorry, no match found" ;?></span></div>
						<?	} else { ?>
							<div align="center"><span class="style1"><strong><? echo $total ;?> Match found, Showing <? echo $st?> to <? echo $end ?></strong></span></div>
						<? }
							if($total>0){
								while($r=mysql_fetch_array($q)){
									$prod_id[$k] = $r['prod_id'];
									$prod_name[$k] = $r['prod_name'];
									$sub_cat_id[$k] = $r['sub_cat_id'];
									$prod_desc[$k] = $r['prod_desc'];
									$retail_price[$k] = $r['retail_price'];
									
									$t1 = "select * from image where prod_id = '$prod_id[$k]'";
										$q1 = mysql_query($t1);
										if(mysql_num_rows($q1)>0){
											while($r1=mysql_fetch_array($q1)){
												if($r1['image1']){
													$image[$k] = $r1['image1'];
												}
												else if($r1['image2']){
													$image[$k] = $r1['image2'];
												}
												else if($r1['image3']){
													$image[$k] = $r1['image3'];
												}
												else {
													$image[$k] = $r1['image4'];
												}
								
											}
										}
									
									$k++;
								}
							}
						?>
							<table width="630" height="247" border="0" cellpadding="0" cellspacing="0" align="center">
<? for($l=$start;$l<$start+9;$l+=3){ ?>			
  <tr>
  <? if($prod_id[$l]!=NULL){ ?>
    <td width="212" height="175" align="center"><a href="singleproductdetail.php?prod_id=<? echo $prod_id[$l] ?>&cat_name=<? echo $s_cat_name ?>&cat_id=<? echo $s_cat_id ?>"><img src="<? echo $image[$l] ?>" width="156" height="152" alt="" /></a></td>
	<? } 
	else {?>
		<td width="212" height="175" align="center"></td>
	<? } ?>
	 <? if($prod_id[$l+1]!=NULL){ ?>
    	<td width="208" align="center"><a href="singleproductdetail.php?prod_id=<? echo $prod_id[$l+1] ?>&cat_name=<? echo $s_cat_name ?>&cat_id=<? echo $s_cat_id ?>"><img src="<? echo $image[$l+1] ?>" width="156" height="152" alt="" /></a></td>
	<? }
		else { ?>
			<td width="212" height="175" align="center"></td>
		<? } ?>
	<? if($prod_id[$l+2]!=NULL){ ?>
    <td width="210" align="center"><a href="singleproductdetail.php?prod_id=<? echo $prod_id[$l+2] ?>&cat_name=<? echo $s_cat_name ?>&cat_id=<? echo $s_cat_id ?>"><img src="<? echo $image[$l+2] ?>" width="156" height="152" alt="" /></a></td>
	<? } 
	else {?>
		<td width="212" height="175" align="center"></td>
	<? } ?>
  </tr>
  <tr>
    <td height="18" align="left"><p style=" padding-left:50px;color:#52758a; font:12px Arial; font-weight:bold; width:150px"><? echo $prod_name[$l] ?></p></td>
    <td><p style=" padding-left:50px;color:#52758a; font:12px Arial; font-weight:bold; width:150px"><? echo $prod_name[$l+1] ?></p></td>
    <td><p style=" padding-left:50px;color:#52758a; font:12px Arial; font-weight:bold; width:150px"><? echo $prod_name[$l+2] ?></p></td>
  </tr>
  <tr>
    <? if($prod_id[$l]!=NULL){ ?>
    <td height="27" align="left"><div align="center"><span class="style1"><strong><span class="style4">Price:$<? echo $retail_price[$l] ?></span></strong></span></div></td>
	<? } else { ?>
	<td height="27" align="left"><div align="center"></div></td>
	<? } ?>
	<? if($prod_id[$l+1]!=NULL){ ?>
    	<td align="left"><div align="center"><span class="style1"><strong><span class="style4">Price:$<? echo $retail_price[$l+1] ?></span></strong></span></div></td>
	<? } else { ?>
	<td height="27" align="left"><div align="center"></div></td>
	<? } ?>
	<? if($prod_id[$l+2]!=NULL){ ?>
    	<td align="left"><div align="center"><span class="style1"><strong><span class="style4">Price:$<? echo $retail_price[$l+2] ?></span></strong></span></div></td>
	<? } else { ?>
	<td height="27" align="left"><div align="center"></div></td>
	<? } ?>
  </tr>
   <? } ?>
  <tr>
    <td height="27" align="left"><p style="padding-left:50px;color:#2d2d2d; font:12px Arial; font-weight:bold; width:150px">&nbsp;</p></td>
	<? if($start>0){
			$temp = $start;
			$temp = $temp-9; ?>
    		<td align="left"><p style="padding-left:50px;color:#2d2d2d; font:15px Arial; font-weight:bold; width:150px"><a href="search_prod.php?start=<? echo $temp1 ?>&s_cat_id=<? echo $s_cat_id ?>&min=<? echo $min ?>&max=<? echo $max ?>"> Previous Page </a></p></td>
	<? } else { ?>
		<td align="left"><p style="padding-left:50px;color:#2d2d2d; font:12px Arial; font-weight:bold; width:150px"></p></td>
		<? } ?>	
	<? if($start+9<$total){
	$temp1 = $start;
	$temp1 = $temp1+9; ?> 
	<td align="left"><p style="padding-left:50px;color:#2d2d2d; font:15px Arial; font-weight:bold; width:150px"><a href="search_prod.php?start=<? echo $temp1 ?>&s_cat_id=<? echo $s_cat_id ?>&min=<? echo $min ?>&max=<? echo $max ?>">Next Page</a></p></td>
   
	<? } 
	else { ?>
	
		 <td align="left"><p style="padding-left:50px;color:#2d2d2d; font:12px Arial; font-weight:bold; width:150px">&nbsp;</p></td>
	<? } ?>
  </tr>
 
</table>
</div>
				
						<div id="whiteboxbottompart">
						</div>
					</div>
				</div>
				
	   
	            <div class="clear"></div>
	    </div>
		
		
 </div>
 <? include 'footer.php' ; ?>
</body>
</html>
