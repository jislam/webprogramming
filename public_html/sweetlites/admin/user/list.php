<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$sql = " SELECT user_id, user_name, user_email, user_phone FROM user ORDER BY user_name ";
$result = dbQuery($sql);

?> 
<p>&nbsp;</p>
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>User Name</td>
   <td width="120">Email</td>
   <td width="120">Phone</td>
   <td width="150">Change Password</td>
   <td width="70">Delete</td>
  </tr>
<?php
while($row = $result->fetch_assoc()){
	extract($row);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $user_name; ?></td>
   <td width="120" align="center"><?php echo $user_email; ?></td>
   <td width="120" align="center"><?php echo $user_phone; ?></td>
   <td width="150" align="center"><a href="javascript:changePassword(<?php echo $user_id; ?>);">Change Password</a></td>
   <td width="70" align="center"><a href="javascript:deleteUser(<?php echo $user_id; ?>);">Delete</a></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddUser" type="button" id="btnAddUser" value="Add User" class="bluebox" onClick="addUser()"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>