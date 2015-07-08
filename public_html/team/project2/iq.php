<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>  DEALS </title>
	 <meta name="description" content="jyoti islam's web programming"/>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="./css/front.css" rel="stylesheet" type="text/css" />
	<link href="./css/program1.css" rel="stylesheet" type="text/css" />
	<link href="./css/iq.css" rel="stylesheet" type="text/css" />
</head>
<body>
	
	
	<div id="header"> <!-- header div starts -->
			<h1>  DEALS</h1>
			<p>  YOUR GREAT LITTLE COUPON BOOK... </p>
			
	</div><!-- header div ends -->
	
	<div id="navigation"> <!-- navigation div starts -->
					<ul>
							<li><a href="index.html">Home</a></li>
							<li ><a href="attractions.html">Attractions</a></li>
							<li ><a href="flowers.html">Gifts & Flowers</a></li>
							<li ><a href="tech.html">Tech Products</a></li>
							<li ><a href="recipe.html">Dining</a></li>
							<li ><a href="movie.html">Movie Tickets</a></li>
							<li ><a href="independenceday.html">Independence Day Sale</a></li>
							<li class="active" ><a href="iq_gen.php">Win a Coupon</a></li>
						</ul>
	</div> <!-- navigation div ends -->
	
	<div id="mainbar"><!-- mainbar div starts -->
			 
<?php

//Initialize variables

  $T1 = $_POST['T1'];

  $T2 = $_POST['T2'];

  $T3 = $_POST['T3'];

  $T4 = $_POST['T4'];

  $T5 = $_POST['T5'];

  $T6 = $_POST['T6'];

  $T7 = $_POST['T7'];

  $T8 = $_POST['T8'];

  $T9 = $_POST['T9'];

  $T10 = $_POST['T10'];

   $empty=strlen($_POST['age']);

   if ($empty==0)

   {

   	echo 'You forgot to enter your age. Press back. Thanks.';

   }

   else

   {

   	$chronologicalage = $_POST['age'];

   }


   //1

   if($T1 == 'round')

   {

   	$TS1 = 3;

   }

   else

   {

   	$TS1 = 0;

   }

   //2

   if($T2 ==15)

   {

   	$TS2 = 3;

   }

   else

   {

   	$TS2 = 0;

   }

   //3

   if($T3 == 15)

   {

   	$TS3 = 3;

   }

   else

   {

   	$TS3 = 0;

   }

   //4

   if($T4 == "7")

   {

   	$TS4 = 3;

   }

   else

   {

   	$TS4 = 0;

   }

   //5

   if($T5 == "7")

   {

   	$TS5 = 3;

   }

   else

   {

   	$TS5 = 0;

   }

   //6

   if($T6 == "7")

   {

   	$TS6 = 3;

   }

   else

   {

   	$TS6 = 0;

   }

   //7

   if($T7 =="7")

   {

   	$TS7 = 4;

   }

   else

   {

   	$TS7 = 0;

   }

   //8

   if($T8 == "7")

   {

   	$TS8 = 4;

   }

   else

   {

   	$TS8 = 0;

   }

   //9

   if($T9 =="7")

   {

   	$TS9 = 4;

   }

   else

   {

   	$TS9 = 0;

   }

   //10

   if($T10 == "7")

   {

   	$TS10 = 30;

   }

   else

   {

   	$TS10 = 0;

   }

//Total mental age scores

$mentalage= $TS1 + $TS2+ $TS3+ $TS4+ $TS5+ $TS6+ $TS7+ $TS8+ $TS9+ $TS10;
	if($chronologicalage !=0){
		$IQ= ($mentalage/$chronologicalage)*100;
	}
if($IQ >160){
		$IQ= 160;
}
?>
		<div class="iqresult">
			<?php
				echo "<br />Hi, your IQ is:"." ".round($IQ,0);

				echo "<br />";

				echo "<br /> Here is a gift for you!!<br /><br /><br /><br />"

			?>	
		<?php
			if($IQ >=160){?>
				<img class="iqcoupon" src="./images/amazon.gif" >
			<?php
			}
			elseif($IQ >=100 && $IQ<160){?>
				<img class="iqnormal" src="./images/imax1.jpg" >
			<?php
			}
			else{?>
				 <img class="iqcoupon" src="./images/macys.gif" >
			<?php
			}
		?>
		
		</div>
	</div> <!-- mainbar div ends -->
	 
	<div id="footer"> <!-- footer div starts -->
		<p>&copy; Copyright 2015 | DEALS </p>
	</div> <!-- footer div ends -->
</body>
</html>