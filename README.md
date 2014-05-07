AutoAuth Invoice Auto Login v1

This script is intended to allow your automatic invoice emails from whmcs to include login information.
This will allow your clients to click on a link in your email and automaticly access the lastest invoice.
Script was created with help from http://docs.whmcs.com/AutoAuth & Serg from http://www.whmcsjet.com/autologin-link-in-whmcs-email/ also from the comments of McGuyver http://maxserver.om.br/


Zenith Media Canada
www.zenithmedia.ca

This script was tested on 5.3.6 General Release (5.3.6-release.1)

To install this script you need to place this file in your root directory of whmcs
then generate a fresh hash5 and enter it in configuration.php in the root of your whmcs directory.
<code>$autoauthkey = "yourhash5";</code>
Then add this value to the top of your email template (i recommend the invoicecreated/invoiceoveride1/2/3 and invoicepaymentreminder themplates)
{assign var='hash' value=$client_email|cat:"same hash 5 as $secret_key in this script"}
and then add this link anywhere in your template based on your style of choice.
{$whmcs_url}/eauth.php?email={$client_email}&invoice={$invoice_num}&hash={$hash|md5}
if you would like to place the link inside of a WORD in your template i'd recommend doing.
<code><a href="yourdomain.com/eauth.php?email={$client_email}&invoice={$invoice_num}&hash={$hash|md5}">AUTO INVOICE LOGIN</a></code>

Additional information according to WHMCS documentation.
"The timestamp must be within 15 minutes of the server time for the autoauth to be accepted, otherwise the link is considered to be expired"

version 2 will strive to allow a longer delay, maybe 24 hours..
