<?php

namespace WonderWp\Component\CustomFields\Service;

use WonderWp\Component\CustomFields\Definition\CustomFieldsRegistryInterface;
use WonderWp\Component\CustomFields\Exception\CustomFieldsRegistryRegistrationException;
use WonderWp\Component\CustomFields\Response\CustomFieldsRegistryRegistrationResponse;
use WonderWp\Component\CustomFields\Response\CustomFieldsRegistryRegistrationResponseInterface;
use WonderWp\Component\CustomFields\Traits\HasCustomFieldsAutoloader;
use WonderWp\Component\Service\AbstractService;
use WonderWp\Component\Service\Traits\HasAutoloadingCapabilities;

abstract class AbstractCustomFieldsRegistryService extends AbstractService implements CustomFieldsRegistryServiceInterface
{
    use HasAutoloadingCapabilities, HasCustomFieldsAutoloader {
        HasCustomFieldsAutoloader::resolveDiscoveryPaths insteadof HasAutoloadingCapabilities;
    }

    /** @var CustomFieldsRegistryInterface[] */
    protected $fieldsRegistries = [];

    /** @inheritDoc */
    public function getCustomFieldsRegistries(): array
    {
        return $this->fieldsRegistries;
    }

    /** @inheritDoc */
    public function getCustomFieldsRegistry(string $key): ?CustomFieldsRegistryInterface
    {
        return $this->fieldsRegistries[$key] ?? null;
    }

    /** @inheritDoc */
    public function addCustomFieldsRegistry(CustomFieldsRegistryInterface $CustomFieldsRegistry): static
    {
        $this->fieldsRegistries[$CustomFieldsRegistry->getKey()] = $CustomFieldsRegistry;

        return $this;
    }

    /** @inheritDoc */
    public function removeCustomFieldsRegistry(string $key): static
    {
        if (isset($this->fieldsRegistries[$key])) {
            unset($this->fieldsRegistries[$key]);
        }

        return $this;
    }

    /** @inheritDoc */
    public function setCustomFieldsRegitries(array $CustomFieldsRegistries): static
    {
        $this->fieldsRegistries = $CustomFieldsRegistries;

        return $this;
    }

    /** @inheritDoc */
    public function registerCustomFieldsRegistries(): array
    {
        $responses = [];

        foreach ($this->fieldsRegistries as $fieldsRegistry) {
            $responses[$fieldsRegistry->getKey()] = $this->registerCustomFieldsRegistry($fieldsRegistry);
        }

        return $responses;
    }

    /** @inheritDoc */
    public function registerCustomFieldsRegistry(CustomFieldsRegistryInterface $CustomFieldsRegistry): CustomFieldsRegistryRegistrationResponseInterface
    {
        try {
            $result = $CustomFieldsRegistry->register();
            $response = new CustomFieldsRegistryRegistrationResponse(200, CustomFieldsRegistryRegistrationResponseInterface::SUCCESS);
            $response->setRegistrationResult($result);
        } catch (\Exception $e) {
            $errorCode = is_int($e->getCode()) ? $e->getCode() : 500;
            $response = new CustomFieldsRegistryRegistrationResponse($errorCode, CustomFieldsRegistryRegistrationResponseInterface::ERROR);
            $response->setError($e);
        }

        return $response;
    }
}
