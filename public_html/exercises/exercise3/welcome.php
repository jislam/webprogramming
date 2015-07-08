<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>PHP Form</title>
	 <meta name="description" content="jyoti islam's web programming"/>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="./css/program1.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
  $fname='Jyoti';
  $fname = $_POST['fname'];
  $fname = ucfirst($fname); 

  $lname='Islam';
  $lname = $_POST['lname'];
  $lname = ucfirst($lname); 
  
  $phone='4049565618';
  $phone = $_POST['phone'];
  
  $phone= "(".substr($phone, 0, 3).") ".substr($phone, 3, 3)."-".substr($phone,6);
 
?>
<h1> Processed Form Data </h1>
<div class="display">
  First Name:<span> <?php echo $fname;?></span><br/>
  Last Name: <span><?php echo $lname;?></span><br/>
  Phone: <span><?php echo $phone;?></span><br/>
  Hobbies: 
<?php
if(!empty($_POST['check_list'])) {
	if(count($_POST['check_list']) > 3)
	{
		?><div class="error">Please select maximum 3 hobbies.</div><?php
	}
	else{
		?><?php 
		foreach($_POST['check_list'] as $check) {
				?><ul class="points">
						<li><?php echo $check; //echoes the value set in the HTML form for each checked checkbox.
							 //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
							 //in your case, it would echo whatever $row['Report ID'] is equivalent to.
							 ?>
						</li>
				</ul>
				<?php
		}
	}
}
?>
</div>

<div class="back"><a href="index.php"> Go Back</a></div>
	<!-- <form name="TEST" action="index.php" method="post">
		 <fieldset>
			<legend>PHP FORM EXAMPLE</legend>
			<table>
				<tr>
					<td>
						<label for="firstname">First Name:</label> 
					</td>	
					<td>	
						<input type="text" name="fname" size="30" maxlength="255" value="<?php echo $fname ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="lastname">Last Name:</label> 
					</td>	
					<td>	
						<input type="text" name="lname" size="30" maxlength="255" value="<?php echo $lname ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="phone">Phone:</label> 
					</td>	
					<td>	
						<input type="text" name="phone" size="20" maxlength="14" value="<?php echo $phone ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="hobbies">Hobbies:</label>  
					</td>	
					<td>	
						<input type="checkbox" name="hobbies" value="hockey" /> Hockey<br/>
					</td>
				</tr>
				<tr>
					<td></td>	
					<td>	
						<input type="checkbox" name="hobbies" value="travel"/> Travel<br/>
					</td>
				</tr>
				<tr>
					<td></td>	
					<td>
						<input type="checkbox" name="hobbies" value="chess"/> Chess<br/>
					</td>
				</tr>
				<tr>
					<td></td>	
					<td>
						<input type="checkbox" name="hobbies" value="coin"/> Coin Collection<br/>
					</td>
				</tr>
				<tr>	
					<td></td>	
					<td>
						<input type="checkbox" name="hobbies" value="stamp"/> Stamp Collection<br/>
					</td>
				</tr>
				<tr>	
					<td></td>	
					<td>
						<input type="checkbox" name="hobbies" value="shopping"/> Shopping<br/>
					</td>	
				</tr>
				<tr>	
					<td></td>	
					<td class="submit">
						<input type="submit" name="formSubmit" value="Go Back" />
					</td>	
				</tr>
			</table>
		</fieldset>
    </form> -->
</body>
</html>
