<?php
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';
require_once 'library/functions.php';
$errorMessage='&nbsp;';
if (isset($_POST['userName'])) {

    if (isset($_POST['Register'])){
        $result = doRegister();
    }else{
        $result = doLogin();

    }

    if ($result != '') {
        $errorMessage = $result;
    }

}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SweetLite User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="include/login.css" rel="stylesheet" type="text/css">

</head>

<body>
<form name="form1" method="post" >
<p></p>
<div align="center">
<table width="919" height="500" border="2">
  <tr>
      <td height="50"><img src="images/home_footer5.jpg" width="905" height="50"></td>
  </tr>
  <tr>
    <th height="401" scope="row"><div align="center">
      <table width="603" height="236" border="1">
          <tr>
            <td width="593" height="25"><h1 class="style4 style5"><span class="style7">SweetLite</span> <span class="style7">User Login</span> </h1></td>
          </tr>
          <tr>
		    <td ><div align="center" class="style8"> <?php echo $errorMessage; ?></div></td>
              </tr>
          <tr>
            <td height="124"><div align="center">
                <table width="590" border="0">
                  <tr>
                    <td width="230"><div align="left" class="style2 style5">Use a valid username and password to login. </div></td>
                    <td width="10">&nbsp;</td>
                    <td width="344"><table width="344" height="100" border="0" bordercolor="#FF0000">
                        <tr>
                          <td width="104"><div align="right" class="style1 style2">User Name </div></td>
                          <td width="8">&nbsp;</td>
                          <td width="218">
                            <input name="userName" type="text" id="userName3" size="30" maxlength="30">
                          </td>
                        </tr>
                        <tr>
                          <td><div align="right" class="style3">Password</div></td>
                          <td>&nbsp;</td>
                          <td><input name="userPass" type="password" id="userPass3" size="30" maxlength="30"></td>
                        </tr>
                        <tr bordercolor="#FFFFFF">
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>

                              <input type="submit" name="Submit" value="Login">
                              <input type="submit" name="Register" value="Register">

                          </td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td> <a href="../index.php">Return to site Home Page</a></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          </table>
      </div></th>
  </tr>
  <tr>
       <td height="20"><img src="images/home_footer5.jpg" width="905" height="20"></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
</form>
</body>
</html>
