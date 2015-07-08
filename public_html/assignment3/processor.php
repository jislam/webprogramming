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
	 

<?php

//switch statement to add correct color
$color=$_POST["text_color"];
$text_color="black";
$text_field=$_POST["textField"];
switch ($color) {
  case "green":
    $text_color="green";
    break;
  case "red":
    $text_color="red";
    break;
  case "blue":
   $text_color="blue";
    break;
  default:
  $text_color="black";
    break;
}
//switch statement to add correct Font
  
$fontFamily=$_POST["font_family"];

$font_family="Georgia";
switch ($fontFamily) {
  case "times":
    $font_family="Times New Roman";
    break;
  case "courierNew":
    $font_family="Courier New";
    break;
  case "calibri":
   $font_family="Calibri ";
    break;
  case "comic":
   $font_family="Comic Sans";
    break;
  default:
  $font_family="Georgia";
    break;
}


//switch statement to add correct Font size
  
$fontSize=$_POST["font_size"];
$font_size="medium";
switch ($fontSize) {
  case "l":
    $font_size="34pt";
    break;
  case "m":
    $font_size="24pt";
    break;
  case "s":
   $font_size="14pt";
    break;
  default:
  $font_size="14pt";
    break;
}

//switch statement to add correct Font Weight
  
$fweight=$_POST["font_weight"];
$font_weight="normal";
switch ($fweight) {
  case "normal":
    $font_weight="normal";
    break;
  case "lighter":
    $font_weight="lighter";
    break;
  case "bold":
   $font_weight="bold";
    break;
  default:
  $font_weight="normal";
    break;
}
?>

<div class="display">
<h1> Entered Text with desired Style</h1>
<p style="color:<?php echo $text_color;?>;font-family:<?php echo $font_family;?>;
		font-weight:<?php echo $font_weight;?>;font-size:<?php echo $font_size;?>;">

	<!--
  <?php echo $color;?>:  <?php echo $text_color;?><br/>
 <?php echo $fontFamily;?>:  <?php echo $font_family;?><br/>
 <?php echo $fontSize;?>:  <?php echo $font_size;?><br/>
 <?php echo $fweight;?>:  <?php echo $font_weight;?><br/>
 -->
	<?php echo $text_field;?><br/>
	
</p>  
<hr/>  
  <br/>
   <div class="back"><a href="part1.php"> Go Back to Part 1</a></div>  
  <div class="back"><a href="http://codd.cs.gsu.edu/~jislam2/calendar.php"> Part 2</a></div>
</div>


</body>
</html>
