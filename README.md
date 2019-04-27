# WHMCS Auto Auth
## By JonTheWong from Zenith Media Canada
[www.zenithmedia.ca](https://www.zenithmedia.ca/?utm_source=github&utm_medium=code&utm_campaign=code)

### Intro
This script was made to allow end users of WHMCS to login to their accounts automaticlly.
You would add the provided code into your email templates and create a temporary link for your clients to access their invoices, quotes and general login.

Script was created with the help of [Serg](http://www.whmcsjet.com/autologin-link-in-whmcs-email/) & [McGuyver](http://maxserver.com.br) and the great documentation of [WHMCS - AutoAuth](http://docs.whmcs.com/AutoAuth) & [WHMCS - Security Policy](https://docs.whmcs.com/Smarty_Security_Policy)

### Confirmed working with WHMCS
We have tested this script with the following versions.
* **5.3.6**
* **6.1.1**
* **6.2.0**
* **7.0.1**
* **7.2.2**
* **7.5.2** - Confirmed by [thomashoeky](https://github.com/thomashoeky)
* **7.6** - Confirmed by [thomashoeky](https://github.com/thomashoeky)
* **7.7.1-release.1** - Confirmed by [thomashoeky](https://github.com/thomashoeky) & [JonTheWong](https://github.com/JonTheWong)


## Installation

To install this script you need to place all files in your root directory of WHMCS

`example: /home/user/public_html/domain/whmcs/`

Generate a hash and enter it in configuration.php above the last **?>**

`$autoauthkey = "REPLACE-WITH-SYSTEM-KEY";`

Also include it into the script.

You can generate a hash using; `openssl rand -hex 32` on linux.

Then add this value to the top of your email template;

`{assign var='hash' value=$client_email|cat:"REPLACE-THIS-PART-WITH-SECRET-KEY"}`

Then add this link anywhere in your email template.

Login Auth: `{$whmcs_url}lauth.php?email={$client_email}&zmkey={$hash|md5}`

Invoice Auth: `{$whmcs_url}iauth.php?email={$client_email}&invoice={$invoice_num}&zmkey={$hash|md5}`

Quote Auth:
`{$whmcs_url}qauth.php?email={$client_email}&quote={$quote_number}&zmkey={$zmkey|md5}`

## Notes
**Quick not for version 7+**

Due to security settings, you have to modify configuration.php and add the following code to the bottom, above the last **?>**

```
$smarty_security_policy = array(
    'mail' => array(
        'php_modifiers' => array(
            'md5',
            'time',
            'sha1',
            'urlencode',
            'header',

        ),
    ),
);
```

## Known Bugs

Additional information according to WHMCS documentation.

>The timestamp must be within 15 minutes of the server time for the autoauth to be accepted, otherwise the link is considered to be expired

Based on my testing the links do no expire.

Based on the above code, when we make a request using the l/e/qauth.php links it redirects to the $url and that generates a new timestamp + hash. But this does not expire?
How can it expire if the hash is based on a timestamp, changing it everytime.

The initial email+secretkey hash is constant.. include timestamp in that generation?

&timestamp={time()} is possible with above security policy.
