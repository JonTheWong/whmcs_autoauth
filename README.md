AutoAuth Invoice Auto Login v1<br />
By<br />
Zenith Media Canada<br />
<a href="https://www.zenithmedia.ca/?utm_source=github&utm_medium=code&utm_campaign=code">www.zenithmedia.ca</a><br />

This script is intended to allow your automatic invoice emails from whmcs to include login information.<br />
This will allow your clients to click on a link in your email and automaticly access the lastest invoice.<br />
Script was created with help from http://docs.whmcs.com/AutoAuth & Serg from <br />http://www.whmcsjet.com/autologin-link-in-whmcs-email/ also from the comments of McGuyver http://maxserver.com.br

This script was tested on 5.3.6 General Release (5.3.6-release.1)<br />

To install this script you need to place this file in your root directory of whmcs<br />
then generate a fresh hash5 and enter it in configuration.php in the root of your whmcs directory.<br />
```$autoauthkey = "yourhash5";```<br />
Then add this value to the top of your email template (i recommend the invoicecreated/invoiceoveride1/2/3 and invoicepaymentreminder themplates)<br />
```{assign var='hash' value=$client_email|cat:"same hash 5 as $secret_key in this script"}```<br />
and then add this link anywhere in your template based on your style of choice.<br />
```{$whmcs_url}/eauth.php?email={$client_email}&invoice={$invoice_num}&hash={$hash|md5}```<br />
if you would like to place the link inside of a WORD in your template i'd recommend doing.<br />
```<a href="yourdomain.com/eauth.php?email={$client_email}&invoice={$invoice_num}&hash={$hash|md5}">AUTO INVOICE LOGIN</a>```<br />

Additional information according to WHMCS documentation.<br />
"The timestamp must be within 15 minutes of the server time for the autoauth to be accepted, otherwise the link is considered to be expired"<br />

Based on my testing the links have no expire.. its a new hash per client.. will check security concerns.<br />

Confirmed working with WHMCS version <b>6.1.1</b><br />
Confirmed working with WHMCS version <b>6.2.0</b><br />
Confirmed working with WHMCS version <b>7.0.1</b><br />
Confirmed working with WHMCS version <b>7.2.2</b>

* quick not for version 7 *
Due to security settings, you have to modify configuration.php and add the following code

$smarty_security_policy = array(<br />
    'mail' => array(<br/>
        'php_modifiers' => array(<br />
            'md5',<br />
        ),<br />
    ),<br />
);<br />
