<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = WEB_ROOT . 'admin/index.php';
?>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?php echo WEB_ROOT;?>admin/include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>library/common.js"></script>
<?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
	}
}
?>

<style type="text/css">
<!--
.style2 {color: #660000}
-->
</style>
</head>
<body>
<table width="919" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr height="50">
    <td height="50" colspan="2"><img src="<?php echo WEB_ROOT; ?>admin/include/home_footer5.jpg" width="920" height="50"></td>
  </tr>
  <tr>
    <td  width="150" height="356" valign="top" ><h4 class="graybox style2">Administration</h4>
      <a href="<?php echo WEB_ROOT; ?>admin/" class="leftnav">Home</a>
	  <a href="<?php echo WEB_ROOT; ?>admin/user/" class="leftnav">Manage User</a> 
 	  <a href="<?php echo WEB_ROOT; ?>admin/category/" class="leftnav">Category</a>
	  <a href="<?php echo WEB_ROOT; ?>admin/product/" class="leftnav">Product </a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/order/?status=Paid" class="leftnav">Order</a> 
    <a href="<?php echo $self; ?>?logout" class="leftnav">Logout</a>    </td>
    <td width="600" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>
<?php
require_once $content;	 
?>
          </td>
        </tr>
      </table></td>
  </tr>
   <tr height="20">
    <td height="20" colspan="2"><img src="<?php echo WEB_ROOT; ?>admin/include/home_footer5.jpg" width="920" height="20"></td>
  </tr>
</table>
<p align="center" class="style_link">Copyright &copy; <?php echo date('Y'); ?> 
Sweetlites</p>
</body>
</html>
