<?php

declare(strict_types=1);

namespace OxidProfessionalServices\PasswordPolicy\Api;

use DivineOmega\PasswordExposed\PasswordExposedChecker;
use Enzoic\Enzoic;
use OxidProfessionalServices\PasswordPolicy\Core\PasswordPolicyConfig;

/**
 * Class PasswordCheck
 * @package OxidProfessionalServices\PasswordPolicy\Api
 */
class PasswordCheck
{
    private PasswordPolicyConfig $config;
    private Enzoic $enzoicApiCon;
    private PasswordExposedChecker $haveIBeenPwned;

    /**
     * PasswordCheck constructor.
     */
    public function __construct(PasswordPolicyConfig $config, PasswordExposedChecker $haveIBeenPwned)
    {
        $this->config = $config;
        $this->enzoicApiCon = new Enzoic($this->config->getAPIKey(), $this->config->getSecretKey());
        $this->haveIBeenPwned = $haveIBeenPwned;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function isPasswordKnown(string $username, string $password): bool
    {
        if ($this->config->getHaveIBeenPwnedNeeded() && $this->haveIBeenPwned->passwordExposed($password) == "exposed") {
            return true;
        } elseif ($this->config->getEnzoicNeeded() &&  ($this->enzoicApiCon->checkPassword($password) !== null || $this->enzoicApiCon->checkCredentials($username, $password))) {
            return true;
        }
        return false;
    }

}