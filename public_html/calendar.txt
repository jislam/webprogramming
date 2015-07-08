<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Calendar</title>
	 <meta name="description" content="jyoti islam's web programming"/>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="calendar.css" rel="stylesheet" type="text/css" />
</head>
<body>
	 
<?PHP
date_default_timezone_set('America/New_York');
$date = date('Y/m/d g:i:s A');

//taking a timestamp converts it to hh am pm format
function get_hour_string($timestamp){
 	
	$timeStr="";
	if($timestamp>=12&&$timestamp<=23){
		$timeStr.=$timestamp-12;
		if(($timestamp-12)==0){
			$timeStr=12;
		}
		$timeStr.=" p.m.";
	}elseif($timestamp==0){
		$timeStr.=12;
		$timeStr.=" a.m.";
	}else{
	$timeStr.=$timestamp;
	$timeStr.=" a.m.";
	}
	return $timeStr;
}

$time=date("g").":".date("i")." ".date("a");
$hourCounter=0;
$startHour=date("G");
$hours_to_show=12;
?>
<div class="container">
<h1> Calendar</h1>
        <h2>Current Date/Time: <?php echo $date;?></h2>
		
		<table class="zebrastrip">
			<tr >
						<th>Time</th><th>Jyoti</th><th>Shrada</th><th>Shafin</th><th>Susan</th>
			</tr>
			<?php
			
				for($count=1;$count<=$hours_to_show;$count++){
					$timedata = get_hour_string(date("G", strtotime('+'.$hourCounter.' hours')));
				?>
					<tr>
						<td><?php  echo $timedata;?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				<?php
				 //increase hour for next loop iteration
				$startHour++;
				$hourCounter++;
			}
			?>
		</table>
		
		<br/>
		
		  <div class="back"><a href="http://codd.cs.gsu.edu/~jislam2/assignment3/part1.php"> Part 1</a></div> 
		
</div>


</body>
</html>
