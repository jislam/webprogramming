<!DOCTYPE html>
<html>
<body>

<h1>PHP Array and foreach</h1>

<?php
	$color = array('red', 'green', 'blue');
	
	?>
	<ul>
		<?php
		foreach( $color as $data )
		{
		  ?><li><?php echo "$data "; ?></li>
		<?php
		}
		?>	</ul>

</body>
</html> 