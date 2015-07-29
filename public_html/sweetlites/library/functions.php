<?php

/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function checkUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['plaincart_user_id'])) {
		header('Location: ' . WEB_ROOT . '');
		exit;
	}
	
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}

function doRegister()
{
    $userName = $_POST['userName'];
    $password = $_POST['userPass'];

    // if we found an error save the error message in this variable
    $errorMessage = '';

    // first, make sure the username & password are not empty
    if ($userName == '') {
        $errorMessage = 'You must enter your username';
    } else if ($password == '') {
        $errorMessage = 'You must enter the password';
    }

    /*
    // the password must be at least 6 characters long and is
    // a mix of alphabet & numbers
    if(strlen($password) < 6 || !preg_match('/[a-z]/i', $password) ||
    !preg_match('/[0-9]/', $password)) {
      //bad password
    }
    */
    // check if the username is taken
    $sql = "SELECT user_name
	        FROM user
			WHERE user_name = '$userName'";
    $result = dbQuery($sql);

    if (dbNumRows($result) == 1) {
        $errorMessage = "Username already taken. Choose another one";
    } else {
        $sql   = "INSERT INTO user (user_name, user_pass)
		          VALUES ('$userName', PASSWORD('$password'))";

        $result = dbQuery($sql);
        $errorMessage = "Registration Successful. Please login";


    }
    return $errorMessage;
}
/*
	
*/
function doLogin()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$userName = $_POST['userName'];
	$password = $_POST['userPass'];
	
	// first, make sure the username & password are not empty
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($password == '') {
		$errorMessage = 'You must enter the password';
	} else {
		// check the database and see if the username and password combo do match
		/*$sql = "SELECT user_id
		        FROM user
				WHERE user_name = '$userName' AND user_pass = PASSWORD('$password')";*/
				$sql = "SELECT user_id
		        FROM user
				WHERE user_name = '$userName' AND user_pass = PASSWORD('$password')";

		$result = dbQuery($sql);
	
		if ($result->num_rows == 1) {

            while ($row = $result->fetch_assoc()) {
                $admin_id = $row['user_id'];
                $_SESSION['plaincart_user_id'] = $admin_id;


                // now that the user is verified we move on to the next page
                // if the user had been in the admin pages before we move to
                // the last page visited
                if (isset($_SESSION['user_login_return_url'])) {
                    header('Location: ' . $_SESSION['user_login_return_url']);
                    exit;
                } else {
                    header('Location: index.php');
                    exit;
                }
            }//end of while
        }//end of if
        else {
            $errorMessage = 'Wrong username or password';
        }

	}
	return $errorMessage;
}

/*
	Logout a user
*/
/**
 *
 */
function doLogout()
{

    if (isset($_SESSION['plaincart_user_id'])) {
		unset($_SESSION['plaincart_user_id']);
     //   echo $_SESSION['plaincart_user_id'];
	}
		
	header('Location: index.php');
	exit;
}


/*
	Generate combo box options containing the categories we have.
	if $catId is set then that category is selected
*/

?>