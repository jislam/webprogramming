<?php
require_once '../library/config.php';
require_once './library/functions.php';

checkUser();

$content = 'main.php';

$pageTitle = 'SweetLite Admin';
$script = array();

require_once 'include/template.php';
?>
