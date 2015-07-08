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

	<form name="TEST" action="welcome.php" method="post">
		 <fieldset>
			<legend>PHP FORM EXAMPLE</legend>
			<table>
				<tr>
					<td>
						<label >First Name:</label> 
					</td>	
					<td>	
						<input type="text" name="fname" size="30" maxlength="255" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Last Name:</label> 
					</td>	
					<td>	
						<input type="text" name="lname" size="30" maxlength="255" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Phone:</label> 
					</td>	
					<td>	
						<input type="text" name="phone" size="20" maxlength="14" />
					</td>
				</tr>
					
				<tr>
					<td>
						<label>Hobbies:</label>  
					</td>	
					<td>	
						<input type="checkbox" name="check_list[]" value="Hockey"/> Hockey<br/>
					</td>
				</tr>
				<tr>
					<td></td>	
					<td>	
						<input type="checkbox" name="check_list[]" value="Travel"/> Travel<br/>
					</td>
				</tr>
				<tr>
					<td></td>	
					<td>
						<input type="checkbox" name="check_list[]" value="Chess"/> Chess<br/>
					</td>
				</tr>
				<tr>
					<td></td>	
					<td>
						<input type="checkbox" name="check_list[]" value="Coin Collection"/> Coin Collection<br/>
					</td>
				</tr>
				<tr>	
					<td></td>	
					<td>
						<input type="checkbox" name="check_list[]" value="Stamp Collection"/> Stamp Collection<br/>
					</td>
				</tr>
				<tr>	
					<td></td>	
					<td>
						<input type="checkbox" name="check_list[]" value="Shopping"/> Shopping<br/>
					</td>	
				</tr>
				<tr>	
					<td></td>	
					<td class="submit">
						<input type="submit" name="submit" value="Submit" />
					</td>	
				</tr>
			</table>
		</fieldset>
    </form>
</body>
</html>
