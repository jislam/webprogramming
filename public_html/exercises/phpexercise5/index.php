<!DOCTYPE html>
<html>
<body>

<h1>PHP Array.splice()</h1>

<?php
	$mainarray = array(1,2,3,4,5);
    foreach( $mainarray as $data )
    {
         echo "$data ";
    }

 echo "new array: <br/> ";
    array_splice($mainarray, 3, 0, "$");

    foreach( $mainarray as $data )
    {
        echo "$data ";
    }
	?>

</body>
</html> 