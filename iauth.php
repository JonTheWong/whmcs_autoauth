<?php
/*
Created by JonTheWong @ Zenith Media Canada - www.zenithmedia.ca
Visit our public repo - https://github.com/JonTheWong/whmcs-autoauth-invoice
*/

$whmcsurl = "https://www.zenithmedia.ca/portal/dologin.php"; /* replace with your url */
$autoauthkey = "REPLACE-WITH-SYSTEM-KEY"; /* same as in configuration.php */
$secretkey = "REPLACE-THIS-PART-WITH-SECRET-KEY"; /* generate a new key for this script */

if (md5($_GET['email'].$secretkey) != $_GET['zmkey'])
die('Visit https://www.zenithmedia.ca/login/ to login manually');

$email = $_GET['email'];
$timestamp = time();
$hash = sha1($email.$timestamp.$autoauthkey);
$goto = "viewinvoice.php?id=".$_GET['invoice'];

$url = $whmcsurl."?email=$email&timestamp=$timestamp&hash=$hash&goto=".urlencode($goto);
header("Location: $url");
exit;
?>
