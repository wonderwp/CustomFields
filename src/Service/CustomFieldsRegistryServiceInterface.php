<?php

namespace WonderWp\Component\CustomFields\Service;

use WonderWp\Component\CustomFields\Definition\CustomFieldsRegistryInterface;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;

interface CustomFieldsRegistryServiceInterface extends RegistrableInterface
{
    /**
     * @return CustomFieldsRegistryInterface[]
     */
    public function getCustomFieldsRegistries(): array;

    /**
     * @param string $key
     * @return CustomFieldsRegistryInterface|null
     */
    public function getCustomFieldsRegistry(string $key): ?CustomFieldsRegistryInterface;

    /**
     * @param CustomFieldsRegistryInterface $CustomFieldsRegistry
     * @return $this
     */
    public function addCustomFieldsRegistry(CustomFieldsRegistryInterface $CustomFieldsRegistry): static;

    /**
     * @param string $key
     * @return $this
     */
    public function removeCustomFieldsRegistry(string $key): static;

    /**
     * @param CustomFieldsRegistryInterface[] $CustomFieldsRegistrys
     * @return $this
     */
    public function setCustomFieldsRegitries(array $CustomFieldsRegistries): static;

    /**
     * Register all CustomFieldsRegistrys
     *
     * @return CustomFieldsRegistryRegistrationResponseInterface[]
     * @throws CustomFieldsRegistryRegistrationException
     */
    public function registerCustomFieldsRegistries(): array;

    /**
     * Register a CustomFieldsRegistry
     *
     * @param CustomFieldsRegistryInterface $CustomFieldsRegistry
     * @return CustomFieldsRegistryRegistrationResponseInterface
     * @throws CustomFieldsRegistryRegistrationException
     */
    public function registerCustomFieldsRegistry(CustomFieldsRegistryInterface $CustomFieldsRegistry): CustomFieldsRegistryRegistrationResponseInterface;
}
