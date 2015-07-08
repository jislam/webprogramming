<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Text Editor</title>
	 <meta name="description" content="jyoti islam's web programming"/>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="./css/program1.css" rel="stylesheet" type="text/css" />
</head>
<body>
	 
	
	<div class="mainbar">
		<div class="topbar">
			<h1>Choose your favorite style and see the result on your desired text </h1>
		</div>
		<form action="processor.php" method="post">
			<div class="leftbar">
				<div class="special">Please enter your desired <span>Text</span>: </div>
			
				<p> 
					<textarea rows="25" cols="69" name="textField"> 

					</textarea>

				</p>
			</div>
		<div class="rightbar">
			<div class="special">Please choose your desired <span>Font</span>: </div>
				<input name="font_family" value="calibri" checked="checked" type="radio"/>Calibri
				<br/>
				<input name="font_family" value="times" type="radio"/>Times New Roman
				<br/>
				<input name="font_family" value="courierNew" type="radio"/>Courier New
				<br/>
				<input name="font_family" value="comic" type="radio"/>Comic Sans
				<br/>

			<hr/>
			
			<div class="special">Please choose your desired <span>Text Size</span>: </div>
				<input name="font_size" value="s" type="radio"/>14pt
				<br/>
				<input name="font_size" value="m" checked="checked" type="radio"/>24pt
				<br/>
				<input name="font_size" value="l" type="radio"/>34pt
				<br/>
			<hr/>
			
			<div class="special">Please choose your desired <span>Font Weight</span>: </div>
				<input name="font_weight" value="normal" type="radio"/>Normal
				<br/>
				<input name="font_weight" value="lighter" type="radio"/>Lighter
				<br/>
				<input name="font_weight" value="bold" checked="checked" type="radio"/>Bold
				<br/>
		
			<hr/>
			
			<div class="special">Please choose your desired <span>Text Color</span>: </div>
				<input name="text_color" value="red" type="radio"/>Red
				<br/>
				<input name="text_color" value="blue" checked="checked" type="radio"/>Blue
				<br/>
				<input name="text_color" value="green" type="radio"/>Green
				<br/>
			<hr/>
			<p class="submit">
				<input name="submit" value="Apply" type="submit"/>
			</p>
		</div>

	</form>
		<div class="back"><a href="http://codd.cs.gsu.edu/~jislam2/calendar.php"> Part 2</a></div>
	</div>
	
</body>
</html>
