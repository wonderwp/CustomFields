<?php

namespace WonderWp\Component\CustomFields\Service;

use WonderWp\Component\CustomFields\Definition\CustomFieldsRegistryInterface;
use WonderWp\Component\Service\AbstractService;

abstract class AbstractCustomFieldsRegistryService extends AbstractService implements CustomFieldsRegistryServiceInterface
{
    /** @var CustomFieldsRegistryInterface[] */
    protected $fieldsRegistries = [];

    //========================================================================================================//
    // Getters and Setters
    //========================================================================================================//

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
        $this->fieldsRegistries[$taxonomy->getKey()] = $taxonomy;
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
        $this->fieldsRegistries = $fields;
        return $this;
    }

    //========================================================================================================//
    // Registration methods
    //========================================================================================================//

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
        return $response;
    }
}
