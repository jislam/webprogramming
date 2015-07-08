<!DOCTYPE html>
<html>
<body>

<h1>PHP Associative  array</h1>

<?php
	$color = array(4=>'white', 6=>'green', 11=>'red');
	$value = $color[4];
	echo "  1st color is $value  <br />";
	
	
	foreach( $color as $data )
	{
	  echo "color is $data <br />";
	}
	
?>

</body>
</html> 