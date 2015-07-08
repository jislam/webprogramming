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
							<li  class="active"><a href="iq_gen.php">Win a Coupon</a></li>
						</ul>
	</div> <!-- navigation div ends -->
	
	<div id="mainbar"><!-- mainbar div starts -->
			 
	
		<form action="iq.php" method="post" class="dataform">
		
			<h6> Take the IQ Test and win a coupon FREE!!! <br/> <br/> <br/>IQ Test </h6>
	
	
<ol class="list">
	Please enter your age now <input type="text" name="age" size="2"><br/><br/>
	Below are the 10 questions for this IQ Test. Answer as honestly as you can.

	<br/><br />
	<li>
	What is the approximate shape of orange fruit, it starts with "r". <br/>
		<input type="text" name="T1" size="30">
	</li>
	<br />

	<li>
	What is the product of 5 and 3? <br/><input type="text" name="T2" size="30">
	</li>
	<br />

	<li>
	If I have 3 apples and 12 mangoes, how many fruits do I have?  <br/>
	<input type="text" name="T3" size="30">
	</li>
	<br />

	<li>
	Which one of the five is least like the other ones?<br/>
			<input name="T4" value="0" type="radio"> Potato 
			<input name="T4" value="0" type="radio"> Corn 
			<input name="T4" value="7" type="radio"> Apple 
			<input name="T4" value="0" type="radio"> Carrot 
			<input name="T4" value="0" type="radio"> Bean <br/>
	</li>
	<br />

	<li>
	If some snuggs are smuggs, and all smuggs are slugs, then some snuggs are definitely slugs. This statement is:<br/>
		<input name="T5" value="7" type="radio"> True 
		<input name="T5" value="0" type="radio"> False 
		<input name="T5" value="0" type="radio"> Neither   <br/>
	</li>
	<br />

	<li>
	Please enter the missing number: 3, 6, 18, 72, ?<br/>
      <input name="T6" value="0" type="radio">144 
      <input name="T6" value="0" type="radio">214 
      <input name="T6" value="0" type="radio">272 
      <input name="T6" value="7" type="radio">360 
      <input name="T6" value="0" type="radio">432<br/>
	</li>
	<br />

	<li>
	Please find the figure continuing the series: <br/>
      <img src="./images/image070.jpg" height="150" width="152">&nbsp;&nbsp;&nbsp;<img src="./images/image071.jpg" height="156" width="166"> <br/>
      <input name="T7" value="0" type="radio"> a  
      <input name="T7" value="7" type="radio"> b  
      <input name="T7" value="0" type="radio"> c  
      <input name="T7" value="0" type="radio"> d 
      <input name="T7" value="0" type="radio"> none of the above <br/>
	</li>
	<br />

	<li>
	We have 5 die, 4 of these die are the same, the fifth is not. Find it!  <br/>
	
      <img src="./images/image08.jpg" height="124" width="475"><br/>
      <input name="T8" value="0" type="radio"> a 
      <input name="T8" value="0" type="radio"> b 
      <input name="T8" value="0" type="radio"> c 
      <input name="T8" value="7" type="radio"> d 
      <input name="T8" value="0" type="radio"> e<br/>
	</li>
	<br />

	<li>
	A spy is trying to send a secret message, we're trying to decode his message, we need your help!<br/>
					If (shnoppy droppy groppy) means (mission dangerously executed)<br/>
					And (swappy trappy droppy) means (abort mission immediately)<br/>
					And (drippy groppy wippy) means (plan executed successfully)<br/>
					Then what does "shnoppy" mean? <br/>
			   <input name="T9" value="0" type="radio"> mission<br/>
			  <input name="T9" value="7" type="radio"> dangerously<br/>
			  <input name="T9" value="0" type="radio"> executed<br/>
			  <input name="T9" value="0" type="radio"> abort<br/>
			  <input name="T9" value="0" type="radio"> successfully<br/>
	</li>
	<br />

	<li>
	I'm a male. If Albert's son is my son's father, what is the relationship between Albert and me?<br/>
      <input name="T10" value="0" type="radio">he is my brother<br/>
      <input name="T10" value="0" type="radio">he is my uncle<br/>
      <input name="T10" value="7" type="radio">he is my father<br/>
      <input name="T10" value="0" type="radio">he is my sister<br/>
      <input name="T10" value="0" type="radio">he is not related to me<br/>
	</li>

	<br />
	<ul class="generic">
		<li>
			<input type="submit" value="Compute my IQ now!">

		</li>
	</ul>
	<br />
</ol>


		</form>		
	</div> <!-- mainbar div ends -->
	 
	<div id="footer"> <!-- footer div starts -->
		<p>&copy; Copyright 2015 | DEALS </p>
	</div> <!-- footer div ends -->
</body>
</html>
