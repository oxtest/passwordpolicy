<?php
/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @category      module
 * @package       passwordpolicy
 * @author        OXID Professional services
 * @link          http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2012
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
    "id"          => "oxpspasswordpolicy",
    "title"       => "Password Policy",
    "description" => "Password validation, strength visualization and expiry rules",
    "thumbnail"   => "out/pictures/picture.png",
    "version"     => "0.7.2",
    "author"      => "OXID Professional Services",
    "url"         => "http://www.oxid-sales.com",
    "email"       => "info@oxid-esales.com",
    "extend"      => array(
        "oxcmp_user"       => "oxps/passwordpolicy/components/oxpspasswordpolicyuser",
        "account_password" => "oxps/passwordpolicy/controllers/oxpspasswordpolicyaccountpassword",
        "forgotpwd"        => "oxps/passwordpolicy/controllers/oxpspasswordpolicyforgotpwd",
        "register"         => "oxps/passwordpolicy/controllers/oxpspasswordpolicyregister",
        "user"             => "oxps/passwordpolicy/controllers/oxpspasswordpolicycheckoutuser",
    ),
    "files"       => array(
        "oxpspasswordpolicymodule"  => "oxps/passwordpolicy/components/oxpspasswordpolicymodule.php",
        "oxpspasswordpolicy"        => "oxps/passwordpolicy/controllers/oxpspasswordpolicy.php",
        "oxpspasswordpolicyattempt" => "oxps/passwordpolicy/models/oxpspasswordpolicyattempt.php",
        'admin_oxpspasswordpolicy'  => 'oxps/passwordpolicy/controllers/admin/admin_oxpspasswordpolicy.php',
    ),
    "templates"   => array(
        "passwordpolicyaccountblocked.tpl" => "oxps/passwordpolicy/views/pages/passwordpolicyaccountblocked.tpl",
        "admin_oxpspasswordpolicy.tpl"     => "oxps/passwordpolicy/views/admin/admin_oxpspasswordpolicy.tpl",
    ),
    'blocks'      => array(
        array(
            'template' => 'form/user_checkout_registration.tpl',
            'block'    => 'passwordpolicy_strengthindicator',
            'file'     => 'views/blocks/passwordpolicystrengthindicator.tpl',
        ),
        array(
            'template' => 'form/forgotpwd_change_pwd.tpl',
            'block'    => 'passwordpolicy_strengthindicator',
            'file'     => 'views/blocks/passwordpolicystrengthindicator.tpl',
        ),
        array(
            'template' => 'form/user_password.tpl',
            'block'    => 'passwordpolicy_strengthindicator',
            'file'     => 'views/blocks/passwordpolicystrengthindicator.tpl',
        ),
        array(
            'template' => 'form/register.tpl',
            'block'    => 'passwordpolicy_strengthindicator',
            'file'     => 'views/blocks/passwordpolicystrengthindicator.tpl',
        ),
    ),
    'settings'    => array(
        array( 'name' => 'iMaxAttemptsAllowed', 'type'=>'int', value => 3),
        array( 'name' => 'iTrackingPeriod', 'type'=>'int', value => 60),
        array( 'name' => 'blAllowUnblock', 'type'=>'bool', value => false),
        array( 'name' => 'iMinPasswordLength', 'type'=>'int', value => 6),
        array( 'name' => 'iGoodPasswordLength', 'type'=>'int', value => 12),
        array( 'name' => 'iMaxPasswordLength', 'type'=>'int', value => 100),
        array( 'name' => 'aPasswordRequirements', 'type'=>'aarr', value => array(
          'digits'=>true,
          'capital'=>true,
          'special'=>true
        ))
    ),
    'events'      => array(
        'onActivate'   => 'OxpsPasswordPolicyModule::onActivate',
        'onDeactivate' => 'OxpsPasswordPolicyModule::onDeactivate',
    ),
);
