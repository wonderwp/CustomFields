<?php

namespace WonderWp\Component\CustomFields\Service;

use WonderWp\Component\CustomFields\Definition\CustomFieldsRegistryInterface;
use WonderWp\Component\CustomFields\Exception\CustomFieldsRegistryRegistrationException;
use WonderWp\Component\CustomFields\Response\CustomFieldsRegistryRegistrationResponseInterface;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;

interface CustomFieldsRegistryServiceInterface extends RegistrableInterface
{
    /**
     * @return CustomFieldsRegistryInterface[]
     */
    public function getCustomFieldsRegistries(): array;

    public function getCustomFieldsRegistry(string $key): ?CustomFieldsRegistryInterface;

    public function addCustomFieldsRegistry(CustomFieldsRegistryInterface $CustomFieldsRegistry): static;

    public function removeCustomFieldsRegistry(string $key): static;

    /**
     * @param CustomFieldsRegistryInterface[] $CustomFieldsRegistries
     */
    public function setCustomFieldsRegitries(array $CustomFieldsRegistries): static;

    /**
     * @return CustomFieldsRegistryRegistrationResponseInterface[]
     * @throws CustomFieldsRegistryRegistrationException
     */
    public function registerCustomFieldsRegistries(): array;

    /**
     * @throws CustomFieldsRegistryRegistrationException
     */
    public function registerCustomFieldsRegistry(CustomFieldsRegistryInterface $CustomFieldsRegistry): CustomFieldsRegistryRegistrationResponseInterface;
}
