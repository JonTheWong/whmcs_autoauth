<?php
/*
Created by JonTheWong @ Zenith Media Canada - www.zenithmedia.ca
Visit our public repo - https://github.com/JonTheWong/whmcs-autoauth-invoice
*/

require_once 'init.php';

$secretkey = "REPLACE-THIS-PART-WITH-SECRET-KEY"; /* generate a new key for this script */

$email = $_GET['email'];

if (md5($email.$secretkey) != $_GET['zmkey']) {
    die('Visit https://zenithmedia.ca/login/ to login manually');
}

$results = localAPI('GetClients',
    array(
        'search' => $email
    ),
    ''
);

if (count($results['clients']['client']) != 1) {
    die('Link has expired');
}
$userid = $results['clients']['client'][0]['id'];

$results = localAPI('CreateSsoToken',
    array(
        'client_id' => $userid,
        'destination' => 'sso:custom_redirect',
        'sso_redirect_path' => 'viewinvoice.php?id='.$_GET['invoice']
    ),
    ''
);

if ($results['result'] != 'success') {
    die('Link has expired');
}

header("Location: " . $results['redirect_url']);
exit;
?>