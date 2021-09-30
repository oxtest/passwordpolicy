<?php

/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @category  translations
 * @package   passwordpolicy
 * @author    OXID Professional services
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2013
 */

$sLangName = "English";

$aLang = array(
    'charset' => 'UTF-8',
    'oxpspasswordpolicy' => 'Password Policy',
    'SHOP_MODULE_oxpspasswordpolicyMinPasswordLength' => "Minimum length",
    'HELP_SHOP_MODULE_oxpspasswordpolicyMinPasswordLength' => 'Min passwort length. Should be greater then 8.',
    'SHOP_MODULE_GROUP_passwordpolicy' => 'Password strength settings',
    'SHOP_MODULE_oxpspasswordpolicyGoodPasswordLength' => 'Good length',
    'HELP_SHOP_MODULE_oxpspasswordpolicyGoodlength' => 'Recommended, strong password length. Should be greater than 12.',
    'SHOP_MODULE_GROUP_passwordpolicy_requirements' => 'Required symbols',
    'SHOP_MODULE_oxpspasswordpolicyDigits' => 'Digits (0...9)',
    'SHOP_MODULE_oxpspasswordpolicyUpperCase' => 'Capital (UPPERCASE) letters (A...Z)',
    'SHOP_MODULE_oxpspasswordpolicyLowerCase'   => 'Lowercase letters (a...z)',
    'SHOP_MODULE_oxpspasswordpolicySpecial' => 'Special characters (!,@#$%^&*?_~()-)',
    'SHOP_MODULE_GROUP_passwordpolicy_api' => 'Leaked passwords',
    'SHOP_MODULE_oxpspasswordpolicyAPI' => 'Check leaked passwords',
    'SHOP_MODULE_oxpspasswordpolicyHaveIBeenPwned' => 'HaveIBeenPwned',
    'SHOP_MODULE_oxpspasswordpolicyEnzoic' => 'Enzoic',
    'SHOP_MODULE_oxpspasswordpolicyEnzoicAPIKey' => 'Enzoic API key',
    'SHOP_MODULE_oxpspasswordpolicyEnzoicSecretKey' => 'Enzoic secret key',
    'SHOP_MODULE_GROUP_passwordpolicy_admin' => "Admin settings",
    'SHOP_MODULE_oxpspasswordpolicyadmin' => "Activate security features for admin users",
    'oxpspasswordpolicy_EnzoicError401' => 'Your entered Enzoic api/secret key is not valid.',
    'oxpspasswordpolicy_EnzoicError0' => 'There was an error connecting to the Enzoic service. Please try again later.',
    'oxpspasswordpolicy_EnzoicError500' => 'An unexpected error ocurred. Please try again later.',
    'OXPS_PASSWORDPOLICY_INVALIDADMINUSERS' => 'To use this feature, all admins must have a valid mail address. The following admins have an invalid mail address:',
    'SHOP_MODULE_GROUP_passwordpolicy_ratelimiting' => 'Rate-limiting settings',
    'SHOP_MODULE_oxpspasswordpolicyRateLimiting' => 'Active',
    'SHOP_MODULE_oxpspasswordpolicyRateLimitingDrivers' => 'Drivers',
    'SHOP_MODULE_oxpspasswordpolicyRateLimitingDrivers_Redis' => 'Redis',
    'SHOP_MODULE_oxpspasswordpolicyRateLimitingDrivers_Predis' => 'Predis',
    'SHOP_MODULE_oxpspasswordpolicyRateLimitingDrivers_Memcached' => 'Memcached',
    'SHOP_MODULE_oxpspasswordpolicyRateLimitingDrivers_APCu' => 'APCu',
    'SHOP_MODULE_oxpspasswordpolicyRateLimitingLimit' => 'Login attemps per minute',
    'SHOP_MODULE_oxpspasswordpolicyMemcachedHost' => 'Memcached Host',
    'SHOP_MODULE_oxpspasswordpolicyMemcachedPort' => 'Memcached Port',
    'SHOP_MODULE_GROUP_passwordpolicy_twofactor' => '2FA Authentification',
    'SHOP_MODULE_oxpspasswordpolicyTOTP' => 'Activate 2FA'
);
