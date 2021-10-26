<?php

namespace OxidProfessionalServices\PasswordPolicy\TwoFactorAuth;

use OTPHP\TOTP;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\ConfigFile;
use OxidEsales\Eshop\Core\Exception\UserException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidProfessionalServices\PasswordPolicy\Core\PasswordPolicyConfig;
use OxidProfessionalServices\PasswordPolicy\Factory\PasswordPolicyRateLimiterFactory;
use RateLimit\Exception\LimitExceeded;
use RateLimit\Rate;

class PasswordPolicyTOTP extends Base
{
    /**
     * @return string returns dataUrl for QrCode
     */
    public function getTOTPQrUrl(): string
    {
        $sessionsecret = $this->decryptSecret(Registry::getSession()->getVariable('otp_secret'));
        $otp = TOTP::create($sessionsecret);
        $secret = $otp->getSecret();
        $user = $this->getUser();
        Registry::getSession()->setVariable('otp_secret', $this->encryptSecret($secret));
        $otp->setLabel($user->oxuser__oxusername->value);
        $otp->setIssuer(Registry::getConfig()->getActiveShop()->getFieldData('oxname'));
        return $otp->getProvisioningUri();
    }

    /**
     * @param string $secret
     * @param string $auth
     * @throws UserException
     */
    public function verifyOTP(string $secret, string $auth, $user = null)
    {
        $container = ContainerFactory::getInstance()->getContainer();
        $passwordpolicyConfig = $container->get(PasswordPolicyConfig::class);
        if ($passwordpolicyConfig->isRateLimiting()) {
            $driverName = $passwordpolicyConfig->getSelectedDriver();
            $rateLimiter = (new PasswordPolicyRateLimiterFactory())->getRateLimiter($driverName)->getLimiter();
            // checks whether rate limit is exceeded
            try {
                $rateLimiter->limit($secret, Rate::perMinute(5));
            } catch (LimitExceeded $exception) {
                throw oxNew(UserException::class, 'OXPS_PASSWORDPOLICY_RATELIMIT_TWOFACTOR_EXCEEDED');
            }
        }
        $totp = TOTP::create($secret);
        if (!$totp->verify($auth, null, 1) || $this->isOTPUsed($user, $auth)) {
            throw oxNew(UserException::class, 'OXPS_PASSWORDPOLICY_TWOFACTORAUTH_ERROR_WRONGOTP');
        }
    }

    public function isOTPUsed($user, string $auth): bool
    {
        $otp = $user->oxuser__oxpsotp->value;
        if($otp == $auth)
        {
            throw oxNew(UserException::class, 'OXPS_PASSWORDPOLICY_TWOFACTORAUTH_ERROR_USEDOTP');
        }
        return false;
    }
    /**
     * @param $secret
     * @return false|string returns encrypted string or false when key in config file is not set
     * @throws \OxidEsales\EshopCommunity\Core\Exception\FileException
     */
    public function encryptSecret($secret)
    {
        $file = oxNew(ViewConfig::class)->getModulePath('oxpspasswordpolicy') . 'twofactor.config.inc.php';
        $twofactorconfig = new ConfigFile($file);
        if (!$twofactorconfig->isVarSet('key')) {
            return false;
        }
        $key = base64_decode($twofactorconfig->getVar('key'));
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($secret, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    /**
     * @param $secret
     * @return false|string
     * @throws \OxidEsales\EshopCommunity\Core\Exception\FileException
     */
    public function decryptSecret($secret)
    {
        $file = oxNew(ViewConfig::class)->getModulePath('oxpspasswordpolicy') . 'twofactor.config.inc.php';
        $twofactorconfig = new \OxidEsales\EshopCommunity\Core\ConfigFile($file);
        $key = base64_decode($twofactorconfig->getVar('key'));
        list($encrypted_data, $iv) = explode('::', base64_decode($secret), 2);
        $result = openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
        return $result?: null;
    }
}