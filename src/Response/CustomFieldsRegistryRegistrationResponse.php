<?php

namespace WonderWp\Component\CustomFields\Response;

use WonderWp\Component\Response\AbstractResponse;

class CustomFieldsRegistryRegistrationResponse extends AbstractResponse implements CustomFieldsRegistryRegistrationResponseInterface
{
    protected mixed $registrationResult = null;

    public function getRegistrationResult(): mixed
    {
        return $this->registrationResult;
    }

    public function setRegistrationResult(mixed $registrationResult): void
    {
        $this->registrationResult = $registrationResult;
    }
}
